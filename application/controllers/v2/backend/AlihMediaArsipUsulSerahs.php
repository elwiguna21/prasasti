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
      * Admin: Penilaian berkas (Setujui / Tolak)
      * Mengisi kolom penilaian_arsip_statis = Y (disetujui) atau N (ditolak)
      */
     public function ajax_penilaian($id)
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }

          $aksi = $this->input->post('aksi'); // 'disetujui' atau 'ditolak'
          $nilai = ($aksi === 'disetujui') ? 'Y' : 'N';

          $this->berkas->update_by_id($id, array(
               'penilaian_arsip_statis' => $nilai,
               'penilaian_user'         => $this->encryption->decrypt($this->session->userdata('next-uid')),
               'penilaian_tanggal'      => date('Y-m-d H:i:s'),
          ));

          $monitoring_msg = ($aksi === 'disetujui')
               ? 'Berkas disetujui oleh Admin dan diteruskan ke Verifikator LKD.'
               : 'Berkas ditolak oleh Admin.';
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
               echo json_encode(array('status' => FALSE, 'pesan' => 'Berkas belum disetujui oleh Admin.'));
               return;
          }

          $aksi  = $this->input->post('aksi'); // 'terverifikasi' atau 'ditolak'
          $nilai = ($aksi === 'terverifikasi') ? 'Y' : 'N';

          $this->berkas->update_by_id($id, array(
               'verifikasi_status'  => $nilai,
               'verifikasi_user'    => $this->encryption->decrypt($this->session->userdata('next-uid')),
               'verifikasi_tanggal' => date('Y-m-d H:i:s'),
          ));

          $monitoring_msg = ($aksi === 'terverifikasi')
               ? 'Berkas diverifikasi dan diteruskan ke Kepala LKD untuk ditandatangani.'
               : 'Berkas ditolak oleh Verifikator LKD.';
          $this->monitoring->insert_entry(array(
               'berkas'  => $id,
               'title'   => ($aksi === 'terverifikasi') ? 'process' : 'reject',
               'message' => $monitoring_msg,
               'user'    => $this->encryption->decrypt($this->session->userdata('next-uid')),
          ));

          echo json_encode(array(
               'status' => TRUE,
               'pesan'  => ($aksi === 'terverifikasi')
                    ? 'Berkas berhasil diverifikasi dan dilanjutkan ke Kepala LKD.'
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
               $path_pdf,
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
      * PHP Proxy: Stream PDF inline tanpa ekstensi .pdf di URL
      * URL: v2/backend/alih_media_arsip_usul_serah/view_pdf/{id}
      * Tujuan: IDM tidak bisa intercept karena URL tidak mengandung .pdf
      */
     public function view_pdf($id)
     {
          $berkas = $this->berkas->get_by_id($id);
          if (empty($berkas) || empty($berkas->file)) {
               show_404();
               return;
          }

          $filepath = FCPATH . 'assets/upload/berkas/' . $berkas->file;
          if (!file_exists($filepath)) {
               show_404();
               return;
          }

          // Bersihkan semua level output buffer CI
          while (ob_get_level() > 0) {
               ob_end_clean();
          }

          // Stream PDF inline — IDM tidak intercept
          header('Content-Type: application/pdf');
          header('Content-Disposition: inline; filename="dokumen"');
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
          $search_keyword = $this->input->post('search_keyword');

          $this->berkas->set_jenis_arsip($this->jenis_arsip);
          $this->berkas->set_filter_skpd($filter_skpd);
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

               if ($tte === 'Y') {
                    $badge = '<span class="badge badge-success">Sudah Ditandatangani</span>';
               } elseif ($verifikasi === 'Y') {
                    $badge = '<span class="badge badge-info">Menunggu Tandatangan</span>';
               } elseif ($penilaian === 'Y') {
                    $badge = '<span class="badge badge-primary">Menunggu Verifikasi</span>';
               } elseif ($penilaian === 'N') {
                    $badge = '<span class="badge badge-danger">Ditolak</span>';
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
               $row[] = '<div class="d-flex gap-1">'
                    . '<a class="btn btn-info btn-xs sharp" href="' . base_url('v2/backend/alih_media_arsip_usul_serah/detail/' . $item->id) . '" title="Detail">'
                    . '<i class="fas fa-eye"></i></a>'
                    . '<a class="btn btn-primary btn-xs sharp" href="javascript:void(0)" title="Edit" onclick="edit_data(\'' . $item->id . '\')">'
                    . '<i class="fas fa-pencil-alt"></i></a>'
                    . '<a class="btn btn-danger btn-xs sharp" href="javascript:void(0)" title="Hapus" onclick="delete_data(\'' . $item->id . '\')">'
                    . '<i class="fas fa-trash"></i></a>'
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
               'tanggal'                => htmlentities($this->input->post('tanggal')),
               'deskripsi'              => htmlentities($this->input->post('keterangan')),
               'nomor_skpd'             => htmlentities($this->input->post('nomor_skpd')),
               'unit_kerja_pencipta'    => htmlentities($this->input->post('unit_kerja_pencipta')),
               'tte_posisi'             => $this->input->post('tte_posisi'),
               'user'                   => $this->encryption->decrypt($this->session->userdata('next-uid')),
               'verifikator'            => 'LKD',
               'verifikasi_status'      => 'N',
          );

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
          }
          echo json_encode(array('status' => TRUE));
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
}
