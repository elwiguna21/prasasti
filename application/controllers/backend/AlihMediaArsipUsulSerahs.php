<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AlihMediaArsipUsulSerahs extends MY_Controller
{
     public $user_auth;
     private $jenis_arsip = 'usul_serah';

     public function __construct()
     {
          parent::__construct();
          $this->load->helper('url', 'xss');
          $this->load->model('v2/Berkas', 'berkas');
          $this->load->model('M_data', 'model');
          $this->load->model('v2/Employee', 'employee');
          $this->load->model('v2/User', 'user_model');
          $this->load->model('v2/BeritaAcara', 'berita_acara');
          $this->load->model('v2/Monitoring', 'monitoring');
          $this->load->library('upload');

          $this->berkas->set_jenis_arsip($this->jenis_arsip);

          if (empty($this->session->userdata('next-uid')) && empty($this->session->userdata('next-role'))) {
               show_error('Not Authorize! Please signin again.', 403);
               die;
          } else {
               $uid      = $this->encryption->decrypt($this->session->userdata('next-uid'));
               $uname    = $this->session->userdata('next-uname');

               // Coba ambil dari tabel employee (untuk operator/ASN)
               $user = $this->employee->get_single_where(
                    array('user.id' => $uid, 'user.username' => $uname)
               );

               // Fallback: ambil dari tabel user langsung (untuk admin, verifikator_lkd, dll)
               if (empty($user)) {
                    $user = $this->user_model->get_single_where(
                         array('user.id' => $uid, 'user.username' => $uname)
                    );
               }

               if (empty($user)) {
                    redirect('v2/authentications/signout');
               }

               $this->user_auth = $user;
               $this->user_auth->avatar = base_url('assets/v3/backend/images/avatar/user-dummy.jpg');
          }
     }

     public function index()
     {
          // Ambil daftar SKPD (company) untuk dropdown filter
          $this->db->select('id, name as nama_skpd');
          $this->db->from('company');
          $this->db->where('deleted_at', null);
          $this->db->order_by('name', 'ASC');
          $data['list_skpd'] = $this->db->get()->result();

          // Ambil tahun
          $data['years'] = $this->db->query("SELECT DISTINCT(tahun) as name FROM berkas WHERE deleted_at IS NULL AND jenis_arsip = 'usul_serah' ORDER BY tahun DESC")->result();

          // Statistik berkas
          $base_where = array(
               'jenis_arsip' => $this->jenis_arsip,
               'deleted_at'  => null,
          );

          // Total semua arsip usul serah
          $data['total_arsip'] = $this->db->where($base_where)->count_all_results('berkas');

          // Sudah diverifikasi (verifikasi_status = Y)
          $where_verif = array_merge($base_where, array('verifikasi_status' => 'Y'));
          $data['total_diverifikasi'] = $this->db->where($where_verif)->count_all_results('berkas');

          // Menunggu TTE (verifikasi Y, tte belum Y)
          $this->db->where($where_verif);
          $this->db->where('(tte_status IS NULL OR tte_status != \'Y\')', null, false);
          $data['total_menunggu_tte'] = $this->db->count_all_results('berkas');

          // Sudah di TTE
          $where_tte = array_merge($base_where, array('tte_status' => 'Y'));
          $data['total_tte'] = $this->db->where($where_tte)->count_all_results('berkas');

          $data['title']    = 'Alih Media Arsip Usul Serah';
          $data['employee'] = $this->user_auth;
          $this->backend('v2/backend/data_alih_media_arsip_usul_serah', $data);
     }

     public function tambah()
     {
          $this->load->model('v2/Klasifikasi', 'klasifikasi');
          $data['klasifikasi'] = $this->klasifikasi->get_all();
          $data['title']    = 'Tambah Alih Media Arsip Usul Serah';
          $data['employee'] = $this->user_auth;
          $this->backend('v2/backend/form_alih_media_arsip_usul_serah', $data);
     }

     public function detail($id)
     {
          $berkas = $this->berkas->get_by_id($id);
          if (empty($berkas)) {
               show_404();
          }

          // Load helper TTE
          $this->load->helper('tte');
          $filepath = FCPATH . 'assets/upload/berkas/' . (!empty($berkas->tte_dokumen) ? $berkas->tte_dokumen : $berkas->file);
          if (file_exists($filepath)) {
               $verify_tte = verifikasi_tte($filepath);
               if ($verify_tte['has_tte'] && $verify_tte['jumlah_signature'] > 0) {
                    $data['verify_tte'] = $verify_tte['detail'];
               } else {
                    $data['verify_tte'] = array();
               }
          } else {
               $data['verify_tte'] = array();
          }

          $data['title']       = 'Detail Alih Media Arsip Usul Serah';
          $data['employee']    = $this->user_auth;
          $data['berkas']      = $berkas;
          $data['role']        = $this->session->userdata('next-role');
          $data['monitorings'] = $this->monitoring->get_all_where(array('monitoring.berkas' => $id));
          $this->backend('v2/backend/detail_alih_media_arsip_usul_serah', $data);
     }

     /**
      * Kepala LKD: Halaman list dokumen siap TTE
      */
     public function tanda_tangan()
     {
          $data['title']    = 'Tanda Tangan Elektronik';
          $data['employee'] = $this->user_auth;
          $data['role']     = $this->session->userdata('next-role');
          $this->backend('v2/backend/tanda_tangan_usul_serah', $data);
     }

     /**
      * Kepala LKD: DataTables AJAX — list berkas siap TTE
      * Filter: verifikasi_status = Y && (tte_status IS NULL OR tte_status != 'Y')
      */
     public function ajax_tte_list()
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          $draw   = $this->input->post('draw');
          $start  = $this->input->post('start') ?? 0;
          $length = $this->input->post('length') ?? 10;
          $search = $this->input->post('search')['value'] ?? '';

          $this->db->select('berkas.*');
          $this->db->from('berkas');
          $this->db->where('berkas.jenis_arsip', $this->jenis_arsip);
          $this->db->where('berkas.verifikasi_status', 'Y');  // Tampilkan semua yg sudah terverifikasi
          $this->db->where('berkas.deleted_at', null);

          if (!empty($search)) {
               $this->db->group_start();
               $this->db->like('berkas.kode_klsf', $search);
               $this->db->or_like('berkas.uraian_informasi_arsip', $search);
               $this->db->or_like('berkas.unit_kerja_pencipta', $search);
               $this->db->group_end();
          }

          $totalFiltered = $this->db->count_all_results('', false);

          $this->db->limit($length, $start);
          $list = $this->db->get()->result();

          // Total keseluruhan tanpa filter search
          $totalAll = $this->db->where(array(
               'jenis_arsip'       => $this->jenis_arsip,
               'verifikasi_status' => 'Y',
               'deleted_at'        => null,
          ))->count_all_results('berkas');

          $rows = array();
          $no   = (int)$start + 1;
          foreach ($list as $item) {
               $detailUrl = base_url('v2/backend/alih_media_arsip_usul_serah/detail/' . $item->id);

               // Badge status penandatanganan
               if (($item->tte_status ?? null) === 'Y') {
                    $statusBadge = '<span class="badge badge-success light px-2 py-1">'
                         . '<i class="fas fa-check-circle me-1"></i>sudah_ditandatangani'
                         . '</span>';
               } else {
                    $statusBadge = '<span class="badge badge-warning light px-2 py-1">'
                         . '<i class="fas fa-clock me-1"></i>menunggu_tandatangan'
                         . '</span>';
               }

               $rows[] = array(
                    $no++,
                    htmlspecialchars($item->kode_klsf ?? '-'),
                    htmlspecialchars($item->uraian_informasi_arsip ?? '-'),
                    htmlspecialchars($item->unit_kerja_pencipta ?? '-'),
                    htmlspecialchars($item->tahun ?? '-'),
                    $statusBadge,
                    '<a href="' . $detailUrl . '" class="btn btn-info btn-xs" title="Detail">
                     <i class="fas fa-eye"></i>
                </a>',
               );
          }

          echo json_encode(array(
               'draw'            => (int)$draw,
               'recordsTotal'    => $totalAll,
               'recordsFiltered' => $totalFiltered,
               'data'            => $rows,
          ));
     }

     /**
      * Penilai: Penilaian berkas (Setujui / Tolak)
      * Mengisi kolom penilaian_arsip_statis = Y (disetujui) atau N (ditolak)
      */
     public function ajax_penilaian($id)
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          $aksi = $this->input->post('aksi'); // 'disetujui' atau 'ditolak'
          $alasan = $this->input->post('alasan');
          $nilai = ($aksi === 'disetujui') ? 'Y' : 'N';

          $this->berkas->update_by_id($id, array(
               'penilaian_arsip_statis' => $nilai,
               'penilaian_user'         => $this->encryption->decrypt($this->session->userdata('next-uid')),
               'penilaian_tanggal'      => date('Y-m-d H:i:s'),
          ));

          $monitoring_msg = ($aksi === 'disetujui')
               ? 'Berkas disetujui oleh Penilai dan diteruskan ke Verifikator LKD.'
               : 'Berkas ditolak oleh Penilai.';

          if ($aksi === 'ditolak' && !empty($alasan)) {
               $monitoring_msg .= ' Alasan: ' . htmlspecialchars($alasan);
          }

          $this->monitoring->insert_entry(array(
               'berkas'  => $id,
               'title'   => ($aksi === 'disetujui') ? 'process' : 'reject',
               'message' => $monitoring_msg,
               'user'    => $this->encryption->decrypt($this->session->userdata('next-uid')),
          ));

          echo json_encode(array(
               'status' => TRUE,
               'pesan'  => ($aksi === 'disetujui')
                    ? 'Berkas berhasil disetujui dan dilanjutkan ke Verifikator LKD.'
                    : 'Berkas ditolak.',
          ));
     }

     /**
      * Verifikator LKD: Verifikasi berkas
      * Mengisi kolom verifikasi_status = Y (terverifikasi) atau N (ditolak)
      */
     public function ajax_verifikasi($id)
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          $berkas = $this->berkas->get_by_id($id);
          if (empty($berkas) || ($berkas->penilaian_arsip_statis ?? null) !== 'Y') {
               echo json_encode(array('status' => FALSE, 'pesan' => 'Berkas belum disetujui oleh Penilai.'));
               return;
          }

          $aksi  = $this->input->post('aksi'); // 'terverifikasi' atau 'ditolak'
          $alasan = $this->input->post('alasan');
          $nilai = ($aksi === 'terverifikasi') ? 'Y' : 'N';

          $update_data = array(
               'verifikasi_status'  => $nilai,
               'verifikasi_user'    => $this->encryption->decrypt($this->session->userdata('next-uid')),
               'verifikasi_tanggal' => date('Y-m-d H:i:s'),
          );

          if ($aksi === 'ditolak' && !empty($alasan)) {
               $update_data['verifikasi_message'] = $alasan;
          }

          $monitoring_msg = ($aksi === 'terverifikasi')
               ? 'Berkas diverifikasi dan diteruskan ke Kepala LKD untuk ditandatangani.'
               : 'Berkas ditolak oleh Verifikator LKD.';

          if ($aksi === 'ditolak' && !empty($alasan)) {
               $monitoring_msg .= ' Alasan: ' . htmlspecialchars($alasan);
          }

          $pesan_sukses = 'Berkas berhasil diverifikasi dan dilanjutkan ke Kepala LKD.';

          // Cek TTE jika aksi adalah verifikasi/terverifikasi
          if ($aksi === 'terverifikasi') {
               $filepath = FCPATH . 'assets/upload/berkas/' . $berkas->file;
               if (file_exists($filepath)) {
                    // Load helper TTE
                    $this->load->helper('tte');
                    $verify_tte = verifikasi_tte($filepath);
                    if ($verify_tte['has_tte'] && count($verify_tte) > 0) {
                         $update_data['tte_status']   = 'Y';
                         $update_data['tte_dokumen']  = $berkas->file;
                         $update_data['tte_message']  = $verify_tte['detail'][0]['signature_field'] . ' - ' . $verify_tte['detail'][0]['signer_name'];
                         $monitoring_msg              = 'Arsip telah diverifikasi dan dokumen telah memiliki Tandatangan Elektronik (TTE) oleh ' . $verify_tte['detail'][0]['signer_name'];
                         $pesan_sukses                = 'Berkas berhasil diverifikasi dan terdeteksi sudah memiliki TTE.';
                    }
               }
          }

          $this->berkas->update_by_id($id, $update_data);

          $this->monitoring->insert_entry(array(
               'berkas'  => $id,
               'title'   => ($aksi === 'terverifikasi') ? 'process' : 'reject',
               'message' => $monitoring_msg,
               'user'    => $this->encryption->decrypt($this->session->userdata('next-uid')),
          ));

          echo json_encode(array(
               'status' => TRUE,
               'pesan'  => ($aksi === 'terverifikasi')
                    ? $pesan_sukses
                    : 'Berkas ditolak oleh Verifikator LKD.',
          ));
     }

     /**
      * Kepala LKD: Tanda Tangan Elektronik (TTE)
      * Memvalidasi passphrase, generate image TTE, lalu kirim ke BSrE
      */
     public function ajax_tte($id)
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          $berkas = $this->berkas->get_by_id($id);
          if (empty($berkas) || ($berkas->verifikasi_status ?? null) !== 'Y') {
               echo json_encode(array('status' => FALSE, 'pesan' => 'Berkas belum diverifikasi oleh Verifikator LKD.'));
               return;
          }

          // Ambil data employee yang sedang login
          $uid = $this->encryption->decrypt($this->session->userdata('next-uid'));
          $emp = $this->db->get_where('employee', array('user' => $uid))->row();
          $nik = !empty($emp) ? trim($emp->nik ?? '') : '';

          $passphrase = trim($this->input->post('passphrase'));

          if (empty($nik)) {
               echo json_encode(array('status' => FALSE, 'pesan' => 'NIK belum terdaftar di data profil Anda. Silakan hubungi Administrator.'));
               return;
          }
          if (empty($passphrase)) {
               echo json_encode(array('status' => FALSE, 'pesan' => 'Passphrase tidak boleh kosong.'));
               return;
          }

          // Pastikan file PDF ada
          $path_pdf = FCPATH . 'assets/upload/berkas/' . $berkas->file;
          if (!file_exists($path_pdf)) {
               echo json_encode(array('status' => FALSE, 'pesan' => 'File PDF berkas tidak ditemukan di server.'));
               return;
          }

          // Load helper TTE
          $this->load->helper('tte');

          // Cek apakah dokumen sudah memiliki TTE. Jika belum, tambahkan watermark.
          $cek_tte = verifikasi_tte($path_pdf);
          $pdf_to_sign = $path_pdf;
          if (empty($cek_tte['has_tte'])) {
               $this->load->library('pdf_watermark');
               $watermarked_pdf = FCPATH . 'assets/upload/berkas/watermarked_' . $berkas->file;
               $success = $this->pdf_watermark->set_watermark($path_pdf, $watermarked_pdf);
               if (!$success) {
                    echo json_encode(array('status' => FALSE, 'pesan' => 'Gagal membuat watermark pada dokumen.'));
                    return;
               }
               $pdf_to_sign = $watermarked_pdf;
          }

          // ── Generate Image TTE ──
          $this->load->library('ImageTTD');

          $nama_lengkap = !empty($emp->fullname) ? $emp->fullname : '-';
          $nip_pegawai  = !empty($emp->nip) ? $emp->nip : '-';
          $jabatan      = !empty($emp->jabatan) ? $emp->jabatan : '-';

          // Link QR = URL halaman publik verifikasi dokumen (tanpa login)
          $linkQR = base_url('v2/frontend/verifikasi_dokumen/index/' . $berkas->id);

          // Generate image TTE (base64 PNG)
          $image_ttd_base64 = $this->imagettd->generate(
               $nama_lengkap,
               $nip_pegawai,
               $jabatan,
               $linkQR,
               date('Y-m-d')
          );

          // Simpan image TTE ke file sementara
          $image_ttd_dir = FCPATH . 'assets/upload/berkas/image_ttd/';
          if (!is_dir($image_ttd_dir)) {
               mkdir($image_ttd_dir, 0755, true);
          }
          $file_image_ttd = $image_ttd_dir . 'ttd_image_' . $uid . '_' . time() . '.png';
          $fp = fopen($file_image_ttd, 'w+');
          fputs($fp, base64_decode($image_ttd_base64));
          fclose($fp);

          // ── Siapkan data specimen (posisi + image) ──
          $data_specimen = null;
          $tte_posisi = null;

          if (!empty($berkas->tte_posisi)) {
               $tte_posisi_data = json_decode($berkas->tte_posisi, true);

               if (!empty($tte_posisi_data)) {
                    // Konversi koordinat canvas → PDF points
                    // PDF.js: canvas_px = pdf_points * scale, jadi pdf_points = canvas_px / scale
                    // PDF coordinate system: origin di bottom-left, Y naik ke atas
                    // Canvas coordinate system: origin di top-left, Y turun ke bawah
                    $canvas_w = !empty($tte_posisi_data['canvas_w']) ? (float)$tte_posisi_data['canvas_w'] : 1;
                    $canvas_h = !empty($tte_posisi_data['canvas_h']) ? (float)$tte_posisi_data['canvas_h'] : 1;
                    $scale    = !empty($tte_posisi_data['scale'])    ? (float)$tte_posisi_data['scale']    : 1;

                    $px_x = (float)($tte_posisi_data['x'] ?? 0);
                    $px_y = (float)($tte_posisi_data['y'] ?? 0);
                    $px_w = (float)($tte_posisi_data['width'] ?? 200);
                    $px_h = (float)($tte_posisi_data['height'] ?? 73);

                    // Konversi langsung: canvas pixels / scale = PDF points
                    $xAxis  = $px_x / $scale;
                    $width  = $px_w / $scale;
                    $height = $px_h / $scale;

                    // Flip Y: PDF origin bottom-left, canvas origin top-left
                    $pdf_page_h = $canvas_h / $scale;
                    $yAxis = $pdf_page_h - ($px_y / $scale) - $height;

                    $data_specimen = [
                         'page'      => (int) ($tte_posisi_data['page'] ?? 1),
                         'xAxis'     => round($xAxis, 2),
                         'yAxis'     => round($yAxis, 2),
                         'width'     => round($width, 2),
                         'height'    => round($height, 2),
                         'image_ttd' => $file_image_ttd
                    ];
               }
          }

          // Fallback: jika tidak ada posisi, tetap gunakan image TTE di posisi default
          if (empty($data_specimen)) {
               $data_specimen = [
                    'page'      => 1,
                    'xAxis'     => 50,
                    'yAxis'     => 50,
                    'width'     => 200,
                    'height'    => 80,
                    'image_ttd' => $file_image_ttd
               ];
          }

          // Nama file output
          $output_filename = 'tte_' . time() . '_' . $berkas->id . '.pdf';
          $output_dir      = FCPATH . 'assets/upload/berkas';

          // Panggil API BSrE dengan data specimen (image TTE)
          $result = tanda_tangan_cloud(
               $pdf_to_sign,
               $output_dir,
               $nik,
               $passphrase,
               $output_filename,
               $linkQR,
               null,               // tte_posisi (tidak digunakan, sudah ada di data_specimen)
               $data_specimen      // data specimen dengan image TTE
          );

          // Hapus file image TTE sementara
          if (file_exists($file_image_ttd)) {
               @unlink($file_image_ttd);
          }

          if (isset($watermarked_pdf)) {
               @unlink($watermarked_pdf);
          }

          if ($result['error']) {
               // Catat log TTE gagal
               $this->db->insert('log_tte', array(
                    'user'        => $uid,
                    'ip_address'  => $this->input->ip_address(),
                    'signed'      => date('Y-m-d H:i:s'),
                    'action'      => 'sign',
                    'status'      => 'failed',
                    'description' => 'Gagal TTE berkas ID #' . $id . ' - ' . $result['message'],
               ));

               echo json_encode(array(
                    'status' => FALSE,
                    'pesan'  => $result['message'],
               ));
               return;
          }

          // Sukses — update status di database
          $this->berkas->update_by_id($id, array(
               'tte_status'   => 'Y',
               'tte_tanggal'  => date('Y-m-d H:i:s'),
               'tte_user'     => $uid,
               'tte_dokumen'  => $result['file_ttd'],
          ));

          // Catat log TTE
          $this->db->insert('log_tte', array(
               'user'        => $uid,
               'ip_address'  => $this->input->ip_address(),
               'signed'      => date('Y-m-d H:i:s'),
               'action'      => 'sign',
               'status'      => 'success',
               'description' => 'TTE dokumen berkas ID #' . $id . ' (' . ($berkas->uraian_informasi_arsip ?? '') . ') - File: ' . $result['file_ttd'],
          ));

          // Catat monitoring TTE
          $emp_for_mon = $this->db->get_where('employee', array('user' => $uid))->row();
          $this->monitoring->insert_entry(array(
               'berkas'  => $id,
               'title'   => 'done',
               'message' => 'Berkas berhasil ditandatangani secara elektronik oleh ' . (!empty($emp_for_mon->fullname) ? $emp_for_mon->fullname : 'Kepala LKD') . '.',
               'user'    => $uid,
          ));

          echo json_encode(array(
               'status' => TRUE,
               'pesan'  => $result['message'],
          ));
     }

     /**
      * PHP Proxy: Stream PDF inline (Full Bypass IDM)
      * Mengubah metode streaming dengan full bypass IDM: tidak ada ekstensi di URL,
      * tidak ada keyword "pdf" di URL, dan dikirim sebagai tipe text/plain murni.
      */
     public function baca_dokumen($id)
     {
          $berkas = $this->berkas->get_by_id($id);
          if (empty($berkas)) {
               show_404();
               return;
          }

          // Cek TTE otomatis di dalam proxy
          if (($berkas->tte_status ?? null) === 'Y' && !empty($berkas->tte_dokumen)) {
               $filepath = FCPATH . 'assets/upload/berkas/' . $berkas->tte_dokumen;
          } elseif (!empty($berkas->file)) {
               $filepath = FCPATH . 'assets/upload/berkas/' . $berkas->file;
          } else {
               show_404();
               return;
          }

          if (!file_exists($filepath)) {
               show_404();
               return;
          }

          // Bersihkan semua level output buffer CI
          while (ob_get_level() > 0) {
               ob_end_clean();
          }

          // Stream PDF inline untuk dicustom via AJAX PDF.js
          // Bypass IDM Mutlak: Kirim sebagai text polos
          header('Content-Type: text/plain');
          header('Content-Length: ' . filesize($filepath));
          header('Cache-Control: private, max-age=0, must-revalidate');
          header('Pragma: public');
          header('X-Content-Type-Options: nosniff');

          readfile($filepath);
          exit;
     }


     public function ajax_list()
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          $filter_skpd    = $this->input->post('filter_skpd');
          $filter_status  = $this->input->post('filter_status');
          $filter_tahun   = $this->input->post('filter_tahun');
          $search_keyword = $this->input->post('search_keyword');

          $this->berkas->set_jenis_arsip($this->jenis_arsip);
          $this->berkas->set_filter_skpd($filter_skpd);
          $this->berkas->set_filter_status($filter_status);
          $this->berkas->set_filter_tahun($filter_tahun);
          if (!empty($search_keyword)) {
               $this->berkas->set_search($search_keyword);
          }
          $list  = $this->berkas->get_datatables();
          $data  = array();
          $nomor = $_POST['start'] + 1;

          foreach ($list as $item) {
               // Badge status flow
               $penilaian = $item->penilaian_arsip_statis ?? null;
               $verifikasi = $item->verifikasi_status ?? null;
               $tte = $item->tte_status ?? null;

               $is_ditolak_verifikator = ($verifikasi === 'N' && !empty($item->verifikasi_user));

               if ($tte === 'Y') {
                    $badge = '<span class="badge badge-success">Sudah Ditandatangani</span>';
               } elseif ($verifikasi === 'Y') {
                    $badge = '<span class="badge badge-info">Menunggu Tandatangan</span>';
               } elseif ($is_ditolak_verifikator) {
                    $badge = '<span class="badge badge-danger">Ditolak Verifikator</span>';
               } elseif ($penilaian === 'Y') {
                    $badge = '<span class="badge badge-primary">Menunggu Verifikasi</span>';
               } elseif ($penilaian === 'N') {
                    $badge = '<span class="badge badge-danger">Ditolak Penilai</span>';
               } else {
                    $badge = '<span class="badge badge-warning light">Menunggu Penilaian</span>';
               }

               $row   = array();
               $row[] = $nomor++;
               $row[] = $item->kode_klsf ?? '-';
               $row[] = $item->uraian_informasi_arsip ?? '-';
               $row[] = $item->tahun ?? '-';
               $row[] = $item->jumlah ? number_format($item->jumlah) . ' dok' : '-';
               $row[] = $item->tanggal ?? '-';
               $row[] = $badge;

               // Logika untuk menampilkan tombol Edit dan Hapus (Hanya jika belum disetujui / ditolak)
               // Hanya role operator yang memiliki aksi edit dan hapus
               $btn_edit = '';
               $btn_delete = '';
               $role = $this->session->userdata('next-role');

               if ($role === 'operator') {
                    if ($penilaian === null || $penilaian === 'N' || $is_ditolak_verifikator) {
                         $btn_edit = '<a class="btn btn-primary btn-xs sharp" href="javascript:void(0)" title="Edit" onclick="edit_data(\'' . $item->id . '\')"><i class="fas fa-pencil-alt"></i></a>';
                         $btn_delete = '<a class="btn btn-danger btn-xs sharp" href="javascript:void(0)" title="Hapus" onclick="delete_data(\'' . $item->id . '\')"><i class="fas fa-trash"></i></a>';
                    }
               }

               $row[] = '<div class="d-flex gap-1">'
                    . '<a class="btn btn-info btn-xs sharp" href="' . base_url('v2/backend/alih_media_arsip_usul_serah/detail/' . $item->id) . '" title="Detail"><i class="fas fa-eye"></i></a>'
                    . $btn_edit
                    . $btn_delete
                    . '</div>';
               $data[] = $row;
          }

          echo json_encode(array(
               "draw"            => $_POST['draw'],
               "recordsTotal"    => $this->berkas->count_all(),
               "recordsFiltered" => $this->berkas->count_filtered(),
               "data"            => $data,
          ));
     }

     /**
      * Verifikasi TTE pada file PDF yang sudah diupload (temp)
      * Dipanggil via AJAX setelah upload PDF berhasil di Step 2
      */
     public function ajax_verify_tte()
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          $filename = $this->input->post('filename');
          if (empty($filename)) {
               echo json_encode(array('status' => FALSE, 'message' => 'Nama file tidak ditemukan.'));
               return;
          }

          // Path file temp yang sudah diupload
          $path_pdf = FCPATH . 'assets/upload/berkas/temp/' . $filename;
          if (!file_exists($path_pdf)) {
               echo json_encode(array('status' => FALSE, 'message' => 'File PDF temp tidak ditemukan.'));
               return;
          }

          // Load helper TTE
          $this->load->helper('tte');

          // Panggil fungsi verifikasi TTE
          $result = verifikasi_tte($path_pdf);

          echo json_encode(array(
               'status'           => TRUE,
               'has_tte'          => $result['has_tte'],
               'message'          => $result['message'],
               'detail'           => $result['detail'],
               'jumlah_signature' => $result['jumlah_signature'] ?? 0,
          ));
     }

     public function ajax_add()
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          // Pastikan folder upload ada
          if (!is_dir('./assets/upload/berkas/')) {
               mkdir('./assets/upload/berkas/', 0755, true);
          }

          $data = array(
               'jenis_arsip'            => $this->jenis_arsip,
               'kode_klsf'              => htmlentities($this->input->post('kode_klsf')),
               'uraian_informasi_arsip' => htmlentities($this->input->post('uraian_informasi_arsip')),
               'tahun'                  => (int) $this->input->post('tahun'),
               'jumlah'                 => (int) $this->input->post('jumlah'),
               'tanggal'                => date('d-m-Y'),
               'deskripsi'              => htmlentities($this->input->post('keterangan')),
               'nomor_skpd'             => htmlentities($this->input->post('nomor_skpd')),
               'unit_kerja_pencipta'    => htmlentities($this->input->post('unit_kerja_pencipta')),
               'tte_posisi'             => $this->input->post('tte_posisi'),
               'user'                   => $this->encryption->decrypt($this->session->userdata('next-uid')),
               'verifikator'            => 'LKD',
               'verifikasi_status'      => 'N',
          );

          // Jika dokumen sudah memiliki TTE BSrE, kosongkan tte_posisi (step 3 di-skip)
          $has_existing_tte = $this->input->post('has_existing_tte');
          if ($has_existing_tte === 'Y') {
               $data['tte_posisi'] = '';
          }

          // Upload PDF final
          if (!empty($_FILES['file_pdf']['name'])) {
               $config['upload_path']   = './assets/upload/berkas/';
               $config['allowed_types'] = 'pdf';
               $config['encrypt_name']  = TRUE;
               $this->upload->initialize($config);

               if ($this->upload->do_upload('file_pdf')) {
                    $upload_data  = $this->upload->data();
                    $data['file'] = $upload_data['file_name'];
               } else {
                    echo json_encode(array('status' => FALSE, 'message' => $this->upload->display_errors('', '')));
                    return;
               }
          }

          $insert_id = $this->berkas->save($data);
          if ($insert_id) {
               $monitoring = array(
                    'berkas'  => $insert_id,
                    'title'   => 'start',
                    'message' => 'Arsip baru berhasil dibuat dan menunggu penilaian.',
                    'user'    => $this->encryption->decrypt($this->session->userdata('next-uid')),
               );
               $this->monitoring->insert_entry($monitoring);
               echo json_encode(array('status' => TRUE));
          } else {
               $db_error = $this->db->error();
               echo json_encode(array('status' => FALSE, 'message' => 'Gagal menyimpan ke database. Error: ' . ($db_error['message'] ?? 'Unknown error')));
          }
     }

     /**
      * Upload PDF sementara untuk preview posisi TTE di Step 3.
      * Mengembalikan URL file temp ke JavaScript.
      */
     public function ajax_upload_pdf()
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          if (!is_dir('./assets/upload/berkas/temp/')) {
               mkdir('./assets/upload/berkas/temp/', 0755, true);
          }

          $config['upload_path']   = './assets/upload/berkas/temp/';
          $config['allowed_types'] = 'pdf';
          $config['encrypt_name']  = TRUE;
          $this->upload->initialize($config);

          if ($this->upload->do_upload('file_pdf')) {
               $upload_data = $this->upload->data();
               echo json_encode(array(
                    'status'   => TRUE,
                    'url'      => base_url('assets/upload/berkas/temp/' . $upload_data['file_name']),
                    'filename' => $upload_data['file_name'],
               ));
          } else {
               echo json_encode(array('status' => FALSE, 'message' => $this->upload->display_errors('', '')));
          }
     }

     public function edit($id)
     {
          if ($this->session->userdata('next-role') !== 'operator') {
               show_error('Akses ditolak. Hanya operator yang dapat mengedit data ini.', 403);
          }

          $berkas = $this->berkas->get_by_id($id);
          if (empty($berkas)) {
               show_404();
          }

          // Cek apakah masih bisa diedit
          if (($berkas->penilaian_arsip_statis === 'Y' && $berkas->verifikasi_status !== 'N') || $berkas->tte_status === 'Y') {
               show_error('Berkas ini sudah tidak dapat diedit karena sedang dalam proses verifikasi atau sudah ditandatangani.', 403);
          }

          $this->load->model('v2/Klasifikasi', 'klasifikasi');
          $data['klasifikasi'] = $this->klasifikasi->get_all();

          $data['title']    = 'Edit Alih Media Arsip Usul Serah';
          $data['employee'] = $this->user_auth;
          $data['berkas']   = $berkas;
          $this->backend('v2/backend/form_edit_alih_media_arsip_usul_serah', $data);
     }

     public function ajax_update($id)
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          if ($this->session->userdata('next-role') !== 'operator') {
               echo json_encode(array('status' => FALSE, 'message' => 'Akses ditolak. Hanya operator yang dapat mengedit.'));
               return;
          }

          $berkas = $this->berkas->get_by_id($id);
          if (empty($berkas)) {
               echo json_encode(array('status' => FALSE, 'message' => 'Berkas tidak ditemukan.'));
               return;
          }

          if (($berkas->penilaian_arsip_statis === 'Y' && $berkas->verifikasi_status !== 'N') || $berkas->tte_status === 'Y') {
               echo json_encode(array('status' => FALSE, 'message' => 'Berkas ini sudah tidak dapat diedit.'));
               return;
          }

          $data = array(
               'kode_klsf'              => htmlentities($this->input->post('kode_klsf')),
               'uraian_informasi_arsip' => htmlentities($this->input->post('uraian_informasi_arsip')),
               'tahun'                  => (int) $this->input->post('tahun'),
               'jumlah'                 => (int) $this->input->post('jumlah'),
               'tanggal'                => null,
               'deskripsi'              => htmlentities($this->input->post('keterangan')),
               'unit_kerja_pencipta'    => htmlentities($this->input->post('unit_kerja_pencipta')),
               'tte_posisi'             => $this->input->post('tte_posisi'),

               // Reset status penilaian dan verifikasi jika diedit (hanya jika sebelumnya ditolak atau sedang proses)
               'penilaian_arsip_statis' => null,
               'penilaian_user'         => null,
               'penilaian_tanggal'      => null,
               'verifikasi_status'      => 'N',
               'verifikasi_user'        => null,
               'verifikasi_tanggal'     => null,
          );

          // Upload PDF final jika ada perubahan
          if (!empty($_FILES['file_pdf']['name'])) {
               $config['upload_path']   = './assets/upload/berkas/';
               $config['allowed_types'] = 'pdf';
               $config['encrypt_name']  = TRUE;
               $this->upload->initialize($config);

               if ($this->upload->do_upload('file_pdf')) {
                    $upload_data  = $this->upload->data();
                    $data['file'] = $upload_data['file_name'];

                    // Hapus file lama jika ada
                    if (!empty($berkas->file) && file_exists('./assets/upload/berkas/' . $berkas->file)) {
                         @unlink('./assets/upload/berkas/' . $berkas->file);
                    }
               } else {
                    echo json_encode(array('status' => FALSE, 'message' => $this->upload->display_errors('', '')));
                    return;
               }
          }

          $this->berkas->update_by_id($id, $data);

          $monitoring = array(
               'berkas'  => $id,
               'title'   => 'process',
               'message' => 'Arsip telah diperbarui oleh operator dan menunggu penilaian kembali.',
               'user'    => $this->encryption->decrypt($this->session->userdata('next-uid')),
          );
          $this->monitoring->insert_entry($monitoring);

          echo json_encode(array('status' => TRUE));
     }

     public function ajax_edit($id)
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }
          $data = $this->berkas->get_by_id($id);
          echo json_encode($data);
     }

     public function ajax_delete($id)
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          if ($this->session->userdata('next-role') !== 'operator') {
               echo json_encode(array('status' => FALSE, 'message' => 'Akses ditolak. Hanya operator yang dapat menghapus.'));
               return;
          }

          $this->berkas->delete_by_id($id);
          echo json_encode(array("status" => TRUE));
     }

     // =========================================================================
     // MODUL BERITA ACARA SERAH TERIMA (BAST)
     // =========================================================================

     public function berita_acara()
     {
          $data['title']    = 'Berita Acara Alih Media Usul Serah';
          $data['employee'] = $this->user_auth;
          $this->backend('v2/backend/data_berita_acara_usul_serah', $data);
     }

     public function ajax_list_berita_acara()
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          $list  = $this->berita_acara->get_datatables();
          $data  = array();
          $nomor = $_POST['start'] + 1;

          foreach ($list as $item) {
               $row   = array();
               $row[] = $nomor++;
               $row[] = htmlspecialchars($item->name ?? '-');
               $row[] = date('d-m-Y H:i', strtotime($item->created_at));
               $row[] = '<div class="d-flex gap-1">'
                    . '<a class="btn btn-info btn-xs sharp" href="' . base_url('v2/backend/alih_media_arsip_usul_serah/detail_berita_acara/' . $item->id) . '" title="Detail">'
                    . '<i class="fas fa-eye"></i></a>'
                    . '<a class="btn btn-danger btn-xs sharp" href="javascript:void(0)" title="Hapus" onclick="delete_berita_acara(\'' . $item->id . '\')">'
                    . '<i class="fas fa-trash"></i></a>'
                    . '</div>';
               $data[] = $row;
          }

          echo json_encode(array(
               "draw"            => $_POST['draw'],
               "recordsTotal"    => $this->berita_acara->count_all(),
               "recordsFiltered" => $this->berita_acara->count_filtered(),
               "data"            => $data,
          ));
     }

     public function tambah_berita_acara()
     {
          $data['title']    = 'Tambah Berita Acara Usul Serah';
          $data['employee'] = $this->user_auth;
          $this->backend('v2/backend/form_berita_acara_usul_serah', $data);
     }

     public function ajax_add_berita_acara()
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          if (!is_dir('./assets/upload/berita_acara/')) {
               mkdir('./assets/upload/berita_acara/', 0755, true);
          }

          $uid  = $this->encryption->decrypt($this->session->userdata('next-uid'));

          $data = array(
               'name'       => htmlentities($this->input->post('name')),
               'company'    => 0, // default
               'user'       => $uid,
               'created_at' => date('Y-m-d H:i:s'),
          );

          if (!empty($_FILES['file_pdf']['name'])) {
               $config['upload_path']   = './assets/upload/berita_acara/';
               $config['allowed_types'] = 'pdf';
               $config['encrypt_name']  = TRUE;
               $this->upload->initialize($config);

               if ($this->upload->do_upload('file_pdf')) {
                    $upload_data      = $this->upload->data();
                    $data['document'] = $upload_data['file_name'];
               } else {
                    echo json_encode(array('status' => FALSE, 'pesan' => $this->upload->display_errors('', '')));
                    return;
               }
          } else {
               echo json_encode(array('status' => FALSE, 'pesan' => 'File PDF wajib diunggah.'));
               return;
          }

          $this->berita_acara->save($data);
          echo json_encode(array('status' => TRUE));
     }

     public function detail_berita_acara($id)
     {
          $berita_acara = $this->berita_acara->get_by_id($id);
          if (empty($berita_acara)) {
               show_404();
          }

          // Ambil berkas-berkas yang sudah terhubung
          $linked_berkas = $this->berita_acara->get_linked_berkas($id);

          $data['title']         = 'Detail Berita Acara (BAST)';
          $data['employee']      = $this->user_auth;
          $data['berita_acara']  = $berita_acara;
          $data['linked_berkas'] = $linked_berkas;

          // Ambil daftar berkas usul_serah yang sudah TTE dan belum masuk BAST ini
          $this->db->select('id, uraian_informasi_arsip, unit_kerja_pencipta, kode_klsf');
          $this->db->from('berkas');
          $this->db->where('jenis_arsip', $this->jenis_arsip);
          $this->db->where('tte_status', 'Y');
          $this->db->where('deleted_at', null);

          // Keluarkan berkas yang sudah masuk ke BAST ini
          if (!empty($linked_berkas)) {
               $linked_ids = array_column($linked_berkas, 'id');
               $this->db->where_not_in('id', $linked_ids);
          }

          $data['available_berkas'] = $this->db->get()->result();

          $this->backend('v2/backend/detail_berita_acara_usul_serah', $data);
     }

     public function ajax_link_berkas()
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          $berita_acara_id = $this->input->post('berita_acara_id');
          $berkas_ids      = $this->input->post('berkas_ids'); // berupa array of id berkas

          if (empty($berkas_ids)) {
               echo json_encode(array('status' => FALSE, 'pesan' => 'Tidak ada dokumen yang dipilih.'));
               return;
          }

          foreach ($berkas_ids as $berkas_id) {
               $this->berita_acara->save_detail(array(
                    'berita_acara' => $berita_acara_id,
                    'berkas'       => $berkas_id
               ));
          }

          echo json_encode(array('status' => TRUE, 'pesan' => 'Dokumen berhasil ditautkan ke Berita Acara.'));
     }

     public function ajax_unlink_berkas($berita_acara_id, $berkas_id)
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }
          $this->berita_acara->delete_detail($berita_acara_id, $berkas_id);
          echo json_encode(array('status' => TRUE));
     }

     public function ajax_delete_berita_acara($id)
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }
          $this->berita_acara->delete_by_id($id);
          echo json_encode(array("status" => TRUE));
     }
     public function export_excel()
     {
          $filter_skpd    = $this->input->get('filter_skpd');
          $filter_status  = $this->input->get('filter_status');
          $filter_tahun   = $this->input->get('filter_tahun');
          $search_keyword = $this->input->get('search_keyword');

          $this->berkas->set_jenis_arsip($this->jenis_arsip);
          if (!empty($filter_skpd) && $filter_skpd != 'all') {
               $this->berkas->set_filter_skpd($filter_skpd);
          }
          if (!empty($filter_status) && $filter_status != 'all') {
               $this->berkas->set_filter_status($filter_status);
          }
          if (!empty($filter_tahun) && $filter_tahun != 'all') {
               $this->berkas->set_filter_tahun($filter_tahun);
          }
          if (!empty($search_keyword)) {
               $this->berkas->set_search($search_keyword);
          }

          $_POST['length'] = -1;
          $_POST['start'] = 0;
          if (!isset($_POST['search'])) {
               $_POST['search'] = array('value' => '');
          }
          if (!empty($search_keyword)) {
               $_POST['search']['value'] = $search_keyword;
          }

          $list = $this->berkas->get_datatables();

          include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
          $objPHPExcel = new PHPExcel();
          $objPHPExcel->getProperties()->setCreator("Prasasti")
               ->setLastModifiedBy("Prasasti")
               ->setTitle("Export Data Arsip Usul Serah")
               ->setSubject("Arsip Usul Serah")
               ->setDescription("Data Arsip Usul Serah")
               ->setKeywords("arsip")
               ->setCategory("arsip");

          $sheet = $objPHPExcel->setActiveSheetIndex(0);
          $sheet->setCellValue('A1', 'No');
          $sheet->setCellValue('B1', 'SKPD/Pencipta');
          $sheet->setCellValue('C1', 'Kode Klasifikasi');
          $sheet->setCellValue('D1', 'Uraian Informasi Arsip');
          $sheet->setCellValue('E1', 'Tahun');
          $sheet->setCellValue('F1', 'Jumlah (Dok)');
          $sheet->setCellValue('G1', 'Status Verifikasi');

          // styling header
          $sheet->getStyle('A1:G1')->getFont()->setBold(true);

          $row = 2;
          $no = 1;
          foreach ($list as $item) {
               $penilaian = $item->penilaian_arsip_statis ?? null;
               $verifikasi = $item->verifikasi_status ?? null;
               $tte = $item->tte_status ?? null;
               $is_ditolak_verifikator = ($verifikasi === 'N' && !empty($item->verifikasi_user));

               if ($tte === 'Y') {
                    $status = 'Sudah Ditandatangani';
               } elseif ($verifikasi === 'Y') {
                    $status = 'Menunggu Tandatangan';
               } elseif ($is_ditolak_verifikator) {
                    $status = 'Ditolak Verifikator';
               } elseif ($penilaian === 'Y') {
                    $status = 'Menunggu Verifikasi';
               } elseif ($penilaian === 'N') {
                    $status = 'Ditolak Penilai';
               } else {
                    $status = 'Menunggu Penilaian';
               }

               $sheet->setCellValue('A' . $row, $no++);
               $sheet->setCellValue('B' . $row, $item->unit_kerja_pencipta);
               $sheet->setCellValueExplicit('C' . $row, $item->kode_klsf, PHPExcel_Cell_DataType::TYPE_STRING);
               $sheet->setCellValue('D' . $row, $item->uraian_informasi_arsip);
               $sheet->setCellValue('E' . $row, $item->tahun);
               $sheet->setCellValue('F' . $row, $item->jumlah);
               $sheet->setCellValue('G' . $row, $status);

               $row++;
          }

          foreach (range('A', 'G') as $columnID) {
               $sheet->getColumnDimension($columnID)->setAutoSize(true);
          }

          $filename = "Export_Arsip_Usul_Serah_" . date('Ymd_His') . ".xlsx";

          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header('Content-Disposition: attachment;filename="' . $filename . '"');
          header('Cache-Control: max-age=0');

          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
          $objWriter->setPreCalculateFormulas(false);
          ob_end_clean();
          $objWriter->save('php://output');
          exit;
     }
     public function export_pdf()
     {
          $filter_skpd    = $this->input->get('filter_skpd');
          $filter_status  = $this->input->get('filter_status');
          $filter_tahun   = $this->input->get('filter_tahun');
          $search_keyword = $this->input->get('search_keyword');

          $this->berkas->set_jenis_arsip($this->jenis_arsip);
          if (!empty($filter_skpd) && $filter_skpd != 'all') {
               $this->berkas->set_filter_skpd($filter_skpd);
          }
          if (!empty($filter_status) && $filter_status != 'all') {
               $this->berkas->set_filter_status($filter_status);
          }
          if (!empty($filter_tahun) && $filter_tahun != 'all') {
               $this->berkas->set_filter_tahun($filter_tahun);
          }
          if (!empty($search_keyword)) {
               $this->berkas->set_search($search_keyword);
          }

          $_POST['length'] = -1;
          $_POST['start'] = 0;
          if (!isset($_POST['search'])) {
               $_POST['search'] = array('value' => '');
          }
          if (!empty($search_keyword)) {
               $_POST['search']['value'] = $search_keyword;
          }

          $data_berkas = $this->berkas->get_datatables();
          $data['data_berkas'] = $data_berkas;

          $html = $this->load->view('v2/backend/pdf_alih_media_arsip_usul_serah', $data, TRUE);

          require_once FCPATH . 'vendor/autoload.php';
          try {
               $mpdf = new \Mpdf\Mpdf([
                    'orientation' => 'L',
                    'format' => 'A4',
                    'margin_top' => 15,
                    'margin_left' => 15,
                    'margin_right' => 15,
                    'margin_bottom' => 15
               ]);
               $mpdf->WriteHTML($html);
               $filename = "Export_Arsip_Usul_Serah_" . date('Ymd_His') . ".pdf";
               $mpdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
          } catch (\Mpdf\MpdfException $e) {
               show_error($e->getMessage());
          }
     }
}
