<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Archieves extends MY_Controller
{
	public $user_auth = null;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('v2/Employee', 'employee');
		$this->load->model('v2/User', 'user_model');
		$this->load->model('v2/Archieve', 'archieve');
		$this->load->model('v2/Monitoring', 'monitoring');
		$this->load->model('v2/Company', 'company');
		$this->load->model('v2/GuideArchieve', 'guide_archieve');
		$this->load->model('v2/Inventory', 'inventory');
		$this->load->model('M_guide_arsip', 'guide_arsip');
		$this->load->model('M_data', 'model');

//		if (empty($this->session->userdata('next-uid')) && empty($this->session->userdata('next-role'))) {
//			show_error('Not Authorize! Please signin again.', 403);
//			die;
//		} else {
//			$uid = $this->encryption->decrypt($this->session->userdata('next-uid'));
//			$uname = $this->session->userdata('next-uname');
//
//			// Coba ambil dari tabel employee (untuk operator/ASN)
//			$user = $this->employee->get_single_where(
//				   array('user.id' => $uid, 'user.username' => $uname)
//			);
//
//			// Fallback: ambil dari tabel user langsung (untuk admin, verifikator_lkd, dll)
//			if (empty($user)) {
//				$user = $this->user_model->get_single_where(
//					   array('user.id' => $uid, 'user.username' => $uname)
//				);
//			}
//
//			if (empty($user)) {
//				redirect('v2/authentications/signout');
//			}
//
//			$this->user_auth = $user;
//			$this->user_auth->avatar = base_url('assets/v3/backend/images/avatar/user-dummy.jpg');
//		}
		if (!empty($this->session->userdata('next-uid')) and !empty($this->session->userdata('next-role'))) {
			$uid = $this->encryption->decrypt($this->session->userdata('next-uid'));
			$uname = $this->session->userdata('next-uname');

			// Coba ambil dari tabel employee (untuk operator/ASN)
			$user = $this->employee->get_single_where(
				   array('user.id' => $uid, 'user.username' => $uname)
			);
			if (!empty($user)) {
				$this->user_auth = $user;
				$this->user_auth->avatar = base_url('assets/v3/backend/images/avatar/user-dummy.jpg');
			}
		}
	}


	// ====== FRONTEND ======
	public function index()
	{
		$data['title']      = 'Arsip Statis';

		$data['companies']  = $this->company->get_all_where();

		$search             = $this->input->get('title');
		$limits             = 12;
		$pages              = (!empty($this->input->get('pages'))) ? ($this->input->get('pages') - 1) * $limits : 0;
		$company            = $this->input->get('company');

		$where              = array(
			   'limits'        => $limits,
			   'starts'        => $pages,
			'berkas.penilaian_arsip_statis'    => 'Y'
		);

//		$where['berkas.penilaian_arsip_statis']   = 'Y';

		if (!empty($search)) {
			$where['search']              = $search;
		}

		if (!empty($company)) {
			$where['berkas.nomor_skpd']   = $company;
		}

		$this->load->library('pagination');
		$config['per_page']           = $where['limits'];
		$config['base_url']           = base_url('v2/archieves');
		$config['total_rows']         = $this->archieve->get_all_where_count($where);
		$this->pagination->initialize($config);

		$data['archieves']            = $this->archieve->get_all_where($where);
		$data['archieves_total']      = $config['total_rows'];
		$data['pagination']           = $this->pagination->create_links();

		// echo json_encode($data);
		// die;
		$this->frontend('v2/frontend/archieves/static', $data);
	}

	public function detail()
	{
		$data['title']      = 'Detail Arsip';

		$archieve           = $this->encryption->decrypt($this->input->get('archieve'));
		$company            = $this->input->get('company');

		if (empty($archieve)) {
			show_error('Mohon pilih arsip terlebih dahulu! Silahkan coba kembali.');
			die;
		}

		$archieves          = $this->archieve->get_single_where(array('berkas.id' => $archieve, 'berkas.nomor_skpd' => $company));
		if (empty($archieve)) {
			show_error('Data tidak dapat ditemukan! Silahkan coba kembali.');
			die;
		}

		$data['archieve']   = $archieves;

//		 echo json_encode($data);
//		 die;
		$this->frontend('v2/frontend/archieves/detail', $data);
	}

	public function inventory()
	{
		$data['title']      = 'Inventaris Arsip';
		$data['companies']  = $this->company->get_all_where();

		$this->frontend('v2/frontend/archieves/inventory', $data);
	}

	public function inventory_detail()
	{
		if (empty($_GET)) {
			redirect('v2/archieves/inventory');
		}

		$data['title']      = 'Detail Inventaris Arsip';

		$id                 = $this->encryption->decrypt($this->input->get('archieve'));
		$klasifikasi        = $this->input->get('kode');
		$skpd               = $this->input->get('company');

		if (empty($id) or empty($skpd)) {
			show_error('Mohon pilih arsip terlebih dahulu! Silahkan coba kembali.');
			die;
		}

		$where              = array(
			   'berkas.id'           => $id,
			   'berkas.nomor_skpd'   => $skpd
		);

		if (!empty($klasifikasi)) {
			$where['berkas.kode_klsf'] = $klasifikasi;
		}

		$archieve           = $this->archieve->get_single_where($where);
		if (empty($archieve)) {
			show_error('Terjadi kesalahan saat mencari data arsip...');
			die;
		}

		$data['archieve']   = $archieve;

//		echo json_encode($data); die;

		$this->frontend('v2/frontend/archieves/detail_inventory', $data);
	}

	public function guide()
	{
		$data['title']      = 'Guide Arsip';

		$search             = $this->input->get('title');
		$limits             = 12;
		$pages              = (!empty($this->input->get('pages'))) ? ($this->input->get('pages') - 1) * $limits : 0;

		$where              = array(
			   'limits'        => $limits,
			   'starts'        => $pages
		);

		if (!empty($search)) {
			$where['search']         = $search;
		}

		$this->load->library('pagination');
		$config['per_page']           = $where['limits'];
		$config['base_url']           = base_url('v2/archieves/guide');
		$config['total_rows']         = $this->guide_archieve->get_all_where_count($where);
		$this->pagination->initialize($config);

		$data['guides']            = $this->guide_archieve->get_all_where($where);
		$data['guides_total']      = $config['total_rows'];
		$data['pagination']           = $this->pagination->create_links();

		$this->frontend('v2/frontend/archieves/guide', $data);
	}

	public function get_guide_json()
	{
		if ($this->input->method() != 'post') {
			echo json_encode(array('status' => 403, 'message' => 'Cant access this request!'));
			die;
		}

		$id       = $this->input->post('guide');
		$file     = $this->input->post('file');

		if (empty($_POST)) {
			echo json_encode(array('status' => 403, 'message' => 'Please select data first!'));
			die;
		}

		$where    = array(
			   'id'      => $this->encryption->decrypt($id),
			   'file'    => $file
		);

		$guide         = $this->guide_archieve->get_single_where($where);
		if (empty($guide)) {
			echo json_encode(array('status' => 404, 'message' => 'Dokumen guide arsip tidak dapat ditemukan!', 'data' => null));
		} else {
			echo json_encode(array('status' => 200, 'message' => 'Dokumen guide arsip berhasil ditemukan', 'data' => $guide));
		}
	}

	public function get_inventories_json()
	{
		if ($this->input->method() != 'post') {
			show_error('Post Request Only!', 405);
			die;
		}

		$columns        = array(
			   0 => 'id',
			   1 => 'kode_klsf',
			   2 => 'indek',
			   3 => 'tahun',
			   4 => 'nomor_skpd',
			   5 => 'jenis_arsip',
		);

		$limit      = $this->input->post('length');
		$start      = $this->input->post('start');
		$order      = (!empty($this->input->post('order'))) ? $columns[$this->input->post('order')[0]['column']] : "id";
		$dir        = (!empty($this->input->post('order'))) ? $this->input->post('order')[0]['dir'] : "asc";
		$search     = $this->input->post('search');
		$company    = $this->input->post('company');

		$where      = array(
			   'starts'    => $start,
			   'limits'    => $limit,
			   'orders'    => 'berkas.' . $order,
			   'dirs'      => $dir,
		);

		if (!empty($company)) {
			$where['berkas.nomor_skpd'] = $company;
		}

		$total_rows         = $this->archieve->get_all_where_count($where);
		$total_filtered     = $total_rows;

		if (!empty($search)) {
			$where['search']    = $search;
			$total_filtered     = $this->archieve->get_all_where_count($where);
		}

		$data               = array();
		$archieves          = $this->archieve->get_all_where($where);
		if (!empty($archieves)) {
			foreach ($archieves as $archieve) {
				$nested['id']                 = $this->encryption->encrypt($archieve->id);
				$nested['klasifikasi']        = $archieve->kode_klsf ?? '-';
				$nested['indeks']             = $archieve->indek ?? '-';
				$nested['tahun']              = $archieve->tahun ?? '-';
				$nested['skpd']               = (!empty($archieve->name)) ? $archieve->name : (!empty($archieve->unit_kerja_pencipta) ? $archieve->unit_kerja_pencipta : '-');
				if ($archieve->jenis_arsip == 'vital') {
					$nested['jenis']    = 'Arsip Vital';
				} else if ($archieve->jenis_arsip == 'usul_serah') {
					$nested['jenis']    = 'Arsip Usul Serah';
				} else {
					$nested['jenis']    = '-';
				}

				$params                       = array(
					   'archieve'          => $nested['id'],
					   'code'              => $nested['klasifikasi'],
					   'company'           => $archieve->nomor_skpd
				);
				$nested['actions']            = '<a class="site-button radius-md" href="' . base_url("v2/inventory/detail?") . http_build_query($params) . '"><i class="ti-eye"></i></a>';

				$data[]             = $nested;
			}
		}

		$json_data = array(
			   "draw"              => intval($this->input->post('draw')),
			   "recordsTotal"      => intval($total_rows),
			   "recordsFiltered"   => intval($total_filtered),
			   "data"              => $data,
		);

		echo json_encode($json_data);
	}

	// ====== BACKEND ======
	public function vital_list()
	{
		if (empty($this->user_auth) or $this->session->userdata('next-state') != 'logged_in') {
			show_error('Not Authorize!', 401);
			die;
		}

		$data['title'] = 'Daftar Arsip Vital';
		$data['employee'] = $this->user_auth;

		$kondisi_arsip = "(jenis_arsip = 'vital' OR jenis_arsip IS NULL)";
		$where[$kondisi_arsip] = NULL;
		if ($this->session->userdata('next-role') != 'admin') {
			$where['nomor_skpd'] = $this->user_auth->no_company;
		} else {
			$where['nomor_skpd !='] = null;
		}

		$data['total_archieves'] = $this->archieve->get_all_where_count($where);
		$where['verifikasi_status'] = 'Y';
		$where["tte_status IN ('N', 'R')"] = null;
		$data['total_verification'] = $this->archieve->get_all_where_count($where);
		unset($where['verifikasi_status']);
		unset($where["tte_status IN ('N', 'R')"]);
		$where['tte_status'] = 'Y';
		$data['total_signed'] = $this->archieve->get_all_where_count($where);
		$where['tte_status'] = 'N';
		$data['total_unsigned'] = $this->archieve->get_all_where_count($where);

		$this->backend('v2/backend/archieves/vital/index', $data);
	}

	public function vital_add()
	{
		if (empty($this->user_auth) or $this->session->userdata('next-state') != 'logged_in') {
			show_error('Not Authorize!', 401);
			die;
		}

		$data['title'] = 'Tambah Arsip Vital';
		$data['employee'] = $this->user_auth;

		$this->backend('v2/backend/archieves/vital/add', $data);
	}

	public function vital_save()
	{
		if (empty($this->user_auth) && $this->session->userdata('next-state') != 'logged_in') {
			show_error('Not Authorize!', 401);
			die;
		} else if ($this->user_auth->user_role != 'operator') {
			show_error('Anda tidak dapat mengakses halaman ini!', 401);
			die;
		}

		if ($this->input->method() != 'post') {
			show_error('Maaf permintaan anda tidak dapat kami layani!', 405);
			die;
		} else if (!$this->input->is_ajax_request()) {
			redirect('v2/dashboards');
		}

		if (!is_dir('./assets/upload/berkas/')) {
			mkdir('./assets/upload/berkas/', 0755, true);
		}

		$data = array(
			   'jenis_arsip' => 'vital',
			   'kode_klsf' => htmlentities($this->input->post('kode_klsf')),
			   'indek' => htmlentities($this->input->post('indeks')),
			   'uraian_informasi_arsip' => htmlentities($this->input->post('uraian_informasi_arsip')),
			   'tahun' => (int)$this->input->post('tahun'),
			   'jumlah' => (int)$this->input->post('jumlah'),
			   'tanggal' => htmlentities($this->input->post('tanggal')),
			   'deskripsi' => htmlentities($this->input->post('keterangan')),
			   'nomor_skpd' => $this->user_auth->no_company,
			   'unit_kerja_pencipta' => htmlentities($this->input->post('unit_kerja_pencipta')),
			   'lokasi_sampul' => $this->input->post('lokasi_sampul'),
			   'lokasi_berkas' => $this->input->post('lokasi_berkas'),
			   'lokasi_box' => $this->input->post('lokasi_box'),
			   'lokasi_rak' => $this->input->post('lokasi_rak'),
			   'ruang_penyimpanan' => $this->input->post('ruang_penyimpanan'),
			   'tte_posisi' => $this->input->post('tte_posisi'),
			   'user' => $this->encryption->decrypt($this->user_auth->user_id),
			   'verifikator' => 'SKPD',
			   'verifikasi_status' => 'N',
		);

		if (!empty($_FILES['file_pdf']['name'])) {
			$config['upload_path'] = './assets/upload/berkas/';
			$config['allowed_types'] = 'pdf';
			$config['encrypt_name'] = TRUE;
			$this->upload->initialize($config);

			if ($this->upload->do_upload('file_pdf')) {
				$upload_data = $this->upload->data();
				$data['file'] = $upload_data['file_name'];
			} else {
				echo json_encode(array('status' => false, 'message' => "Terjadi kesalahan saat menyimpan dokumen: " . $this->upload->display_errors('', '')));
				die;
			}
		}

		$save = $this->archieve->insert_entry($data);
		if ($save and $save > 0) {
			$monitoring = array(
				   'berkas' => $save,
				   'title' => 'start',
				   'message' => 'Arsip baru berhasil dibuat dan menunggu verifikasi.',
				   'user' => $this->encryption->decrypt($this->session->userdata('next-uid'))
			);
			$this->monitoring->insert_entry($monitoring);
			echo json_encode(array('status' => true, 'message' => 'Data arsip baru berhasil disimpan.'));
			die;
		} else {
			echo json_encode(array('status' => false, 'message' => 'Data arsip baru gagal disimpan! Silahkan coba kembali.'));
			die;
		}
	}

	public function vital_detail()
	{
		if (empty($this->user_auth) && $this->session->userdata('next-state') != 'logged_in') {
			show_error('Not Authorize!', 401);
			die;
		}
		// else if ($this->session->userdata('next-role') != 'operator') {
		//      show_error('Anda tidak dapat mengakses halaman ini!', 401);
		//      die;
		// }

		$id       = $this->encryption->decrypt($_GET['archieve']);
		$company  = $_GET['company'];
		if (empty($id) or empty($company)) {
			show_error('Mohon pilih arsip terlebih dahulu!', 500);
			die;
		}

		$data['title'] = 'Detail Arsip Vital';
		$archieve = $this->archieve->get_single_where(array('berkas.id' => $id, 'berkas.nomor_skpd' => $company));
		if (empty($archieve)) {
			show_error('Terjadi kesalahan saat mencari data! Silahkan coba kembali', 500);
			die;
		} else {
			$archieve->id = $this->encryption->encrypt($archieve->id);
		}

		$data['archieve'] = $archieve;
		$data['employee'] = $this->user_auth;
		$data['monitorings'] = $this->monitoring->get_all_where(array('monitoring.berkas' => $id));

		// echo json_encode($data);
		// die;
		$this->backend('v2/backend/archieves/vital/detail', $data);
	}

	public function vital_reject()
	{
		if (empty($this->user_auth) && $this->session->userdata('next-state') != 'logged_in') {
			show_error('Not Authorize!', 401);
			die;
		} else if (!in_array($this->user_auth->user_role, array('verifikator_skpd', 'kepala_skpd'))) {
			show_error('Anda tidak dapat mengakses halaman ini!', 401);
			die;
		}

		if ($this->input->method() != 'post') {
			show_error('Maaf permintaan anda tidak dapat kami layani!', 405);
			die;
		}

		$where = array(
			   'id' => $this->encryption->decrypt($this->input->post('archieve')),
			   'nomor_skpd' => $this->input->post('company')
		);

		if ($this->user_auth->user_role == 'verifikator_skpd') {
			$data = array(
				   'verifikasi_status' => 'R',
				   'verifikasi_user' => $this->encryption->decrypt($this->user_auth->user_id),
				   'verifikasi_tanggal' => date('Y-m-d H:i:s'),
				   'verifikasi_message' => $this->input->post('description')
			);
		} else if ($this->user_auth->user_role == 'kepala_skpd') {
			$data = array(
				   'tte_status' => 'R',
				   'tte_user' => $this->encryption->decrypt($this->user_auth->user_id),
				   'tte_tanggal' => date('Y-m-d H:i:s'),
				   'tte_message' => $this->input->post('description')
			);
		}

		$update = $this->archieve->update_entry($data, $where);
		if ($update > 0) {
			$monitoring = array(
				   'berkas' => $where['id'],
				   'title' => 'reject',
				   'user' => $this->encryption->decrypt($this->user_auth->user_id)
			);
			if ($this->user_auth->user_role == 'verifikator_skpd') {
				$monitoring['message'] = 'Pengajuan arsip ditolak oleh verifikator.';
			} else if ($this->user_auth->user_role == 'kepala_skpd') {
				$monitoring['message'] = 'Arsip ditolak untuk ditandatangani.';
			}
			$this->monitoring->insert_entry($monitoring);
			$this->session->set_flashdata(array('status' => 200, 'message' => 'Arsip berhasil ditolak oleh Anda.'));
		} else {
			$this->session->set_flashdata(array('status' => 500, 'message' => 'Arsip gagal ditolak oleh Anda! Silahkan coba kembali.'));
		}

		$params = array('archieve' => $this->input->post('archieve'), 'company' => $this->input->post('company'));
		redirect('v2/backend/alih_media_arsip_vital/detail?' . http_build_query($params));
	}

	public function vital_signed()
	{
		if (empty($this->user_auth) && $this->session->userdata('next-state') != 'logged_in') {
			show_error('Not Authorize!', 401);
			die;
		} else if (!in_array($this->user_auth->user_role, array('kepala_skpd'))) {
			show_error('Anda tidak dapat mengakses halaman ini!', 401);
			die;
		}

		$params = array('archieve' => $this->input->post('archieve'), 'company' => $this->input->post('company'));

		if ($this->input->method() != 'post' or empty($_POST['passphrase']) or empty($this->user_auth->nik)) {
			if (empty($this->user_auth->nik)) {
				$this->session->set_flashdata(array('status' => 500, 'message' => 'Maaf, mohon lengkapi NIK pada profil Anda atau hubungi Administrator.'));
			} else {
				$this->session->set_flashdata(array('status' => 500, 'message' => 'Maaf, mohon isi Passphrase terlebih dahulu! Silahkan coba kembali.'));
			}
			redirect('v2/backend/alih_media_arsip_vital/detail?' . http_build_query($params));
		}

		$where = array(
			   'berkas.id' => $this->encryption->decrypt($this->input->post('archieve')),
			   'berkas.nomor_skpd' => $this->input->post('company')
		);
		$archieve = $this->archieve->get_single_where($where);
		$path_pdf = FCPATH . 'assets/upload/berkas/' . $archieve->file;
		if (empty($archieve)) {
			$this->session->set_flashdata(array('status' => 500, 'message' => 'Arsip tidak dapat ditemukan! Silahkan coba kembali.'));
			redirect('v2/backend/alih_media_arsip_vital/detail?' . http_build_query($params));
		} else if (!file_exists($path_pdf)) {
			$this->session->set_flashdata(array('status' => 500, 'message' => 'Dokumen pada arsip tidak ditemukan! Silahkan coba kembali.'));
			redirect('v2/backend/alih_media_arsip_vital/detail?' . http_build_query($params));
		} else if ($archieve->verifikasi_status != 'Y') {
			$this->session->set_flashdata(array('status' => 500, 'message' => 'Arsip belum diverifikasi! Silahkan hubungi verifikator.'));
			redirect('v2/backend/alih_media_arsip_vital/detail?' . http_build_query($params));
		}

		$passphrase = trim($this->input->post('passphrase'));

		// Load helper TTE
		$this->load->helper('tte');

		// ── Generate Image TTE ──
		$this->load->library('ImageTTD');

		$nama_lengkap = !empty($this->user_auth->fullname) ? $this->user_auth->fullname : '-';
		$nip_pegawai = !empty($this->user_auth->nip) ? $this->user_auth->nip : '-';
		$jabatan = !empty($this->user_auth->jabatan) ? $this->user_auth->jabatan : '-';

		// Link QR = URL halaman publik verifikasi dokumen (tanpa login)
		$linkQR = base_url('v2/frontend/verifikasi_dokumen/index/' . $archieve->id);

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
		$file_image_ttd = $image_ttd_dir . 'ttd_image_' . $this->encryption->decrypt($this->user_auth->user_id) . '_' . time() . '.png';
		$fp = fopen($file_image_ttd, 'w+');
		fputs($fp, base64_decode($image_ttd_base64));
		fclose($fp);

		// ── Siapkan data specimen (posisi + image) ──
		$data_specimen = null;
		$tte_posisi = null;

		if (!empty($archieve->tte_posisi)) {
			$tte_posisi_data = json_decode($archieve->tte_posisi, true);

			if (!empty($tte_posisi_data)) {
				// Konversi koordinat canvas → PDF points
				// PDF.js: canvas_px = pdf_points * scale, jadi pdf_points = canvas_px / scale
				// PDF coordinate system: origin di bottom-left, Y naik ke atas
				// Canvas coordinate system: origin di top-left, Y turun ke bawah
				$canvas_w = !empty($tte_posisi_data['canvas_w']) ? (float)$tte_posisi_data['canvas_w'] : 1;
				$canvas_h = !empty($tte_posisi_data['canvas_h']) ? (float)$tte_posisi_data['canvas_h'] : 1;
				$scale = !empty($tte_posisi_data['scale']) ? (float)$tte_posisi_data['scale'] : 1;

				$px_x = (float)($tte_posisi_data['x'] ?? 0);
				$px_y = (float)($tte_posisi_data['y'] ?? 0);
				$px_w = (float)($tte_posisi_data['width'] ?? 200);
				$px_h = (float)($tte_posisi_data['height'] ?? 73);

				// Konversi langsung: canvas pixels / scale = PDF points
				$xAxis = $px_x / $scale;
				$width = $px_w / $scale;
				$height = $px_h / $scale;

				// Flip Y: PDF origin bottom-left, canvas origin top-left
				$pdf_page_h = $canvas_h / $scale;
				$yAxis = $pdf_page_h - ($px_y / $scale) - $height;

				$data_specimen = [
					   'page' => (int)($tte_posisi_data['page'] ?? 1),
					   'xAxis' => round($xAxis, 2),
					   'yAxis' => round($yAxis, 2),
					   'width' => round($width, 2),
					   'height' => round($height, 2),
					   'image_ttd' => $file_image_ttd
				];
			}
		}

		// Fallback: jika tidak ada posisi, tetap gunakan image TTE di posisi default
		if (empty($data_specimen)) {
			$data_specimen = [
				   'page' => 1,
				   'xAxis' => 50,
				   'yAxis' => 50,
				   'width' => 200,
				   'height' => 80,
				   'image_ttd' => $file_image_ttd
			];
		}

		// Nama file output
		$output_filename = 'tte_' . time() . '_' . $archieve->id . '.pdf';
		$output_dir = FCPATH . 'assets/upload/berkas';

		// Panggil API BSrE dengan data specimen (image TTE)
		$result = tanda_tangan_cloud(
			   $path_pdf,
			   $output_dir,
			   $this->user_auth->nik,
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
				   'user' => $this->session->userdata('next-uid'),
				   'ip_address' => $this->input->ip_address(),
				   'signed' => date('Y-m-d H:i:s'),
				   'action' => 'sign',
				   'status' => 'failed',
				   'description' => 'Gagal TTE berkas ID #' . $archieve->id . ' - ' . $result['message'],
			));

			$this->session->set_flashdata(array('status' => 500, 'message' => "Maaf, terjadi kesalahan saat proses TTE! " . $result['message']));
			redirect('v2/backend/alih_media_arsip_vital/detail?' . http_build_query($params));
		}

		// Sukses — update status di database
		$update = $this->archieve->update_entry(array(
			   'tte_status' => 'Y',
			   'tte_tanggal' => date('Y-m-d H:i:s'),
			   'tte_user' => $this->encryption->decrypt($this->user_auth->user_id),
			   'tte_dokumen' => $result['file_ttd'],
		), array('id' => $archieve->id, 'nomor_skpd' => $archieve->nomor_skpd));

		if ($update > 0) {
			// Catat log TTE
			$this->db->insert('log_tte', array(
				   'user' => $this->encryption->decrypt($this->user_auth->user_id),
				   'ip_address' => $this->input->ip_address(),
				   'signed' => date('Y-m-d H:i:s'),
				   'action' => 'sign',
				   'status' => 'success',
				   'description' => 'TTE dokumen berkas ID #' . $archieve->id . ' (' . ($archieve->uraian_informasi_arsip ?? '') . ') - File: ' . $result['file_ttd'],
			));

			$monitoring = array(
				   'berkas' => $archieve->id,
				   'title' => 'done',
				   'message' => "Arsip berhasil di TTE oleh {$this->user_auth->fullname}.",
				   'user' => $this->encryption->decrypt($this->user_auth->user_id)
			);
			$this->monitoring->insert_entry($monitoring);

			$this->session->set_flashdata(array('status' => 200, 'message' => 'Dokumen arsip berhasil di TTE oleh Anda.'));
		} else {
			$this->session->set_flashdata(array('status' => 200, 'message' => "Dokumen arsip gagal di TTE oleh Anda! {$result['message']}"));
		}

		redirect('v2/backend/alih_media_arsip_vital/detail?' . http_build_query($params));
	}

	public function get_archieves_vital_json()
	{
		if (empty($this->user_auth) && $this->session->userdata('next-state') != 'logged_in') {
			show_error('Not Authorize!', 401);
			die;
		}

		if ($this->input->method() != 'post') {
			show_error('Maaf permintaan anda tidak dapat kami layani!', 405);
			die;
		}

		$columns = array(
			   0 => 'id',
			   1 => 'kode_klsf',
			   3 => 'tahun',
			   4 => 'jumlah',
			   5 => 'tanggal',
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = (!empty($this->input->post('order'))) ? $columns[$this->input->post('order')[0]['column']] : "id";
		$dir = (!empty($this->input->post('order'))) ? $this->input->post('order')[0]['dir'] : "asc";
		// $search     = (!empty($this->input->post('search')['value'])) ? $this->input->post('search')['value'] : null;
		$search = $this->input->post('search');
		$company = $this->input->post('company');

		$where = array(
			   'starts' => $start,
			   'limits' => $limit,
			   'orders' => $order,
			   'dirs' => $dir,
		);

		$kondisi_arsip = "(berkas.jenis_arsip = 'vital' OR berkas.jenis_arsip IS NULL)";
		$where[$kondisi_arsip] = NULL;

		switch ($this->session->userdata('next-role')) {
			case 'operator':
				$where['berkas.nomor_skpd'] = $this->user_auth->no_company;
				break;
			case 'verifikator_opd':
				$where['berkas.nomor_skpd'] = $this->user_auth->no_company;
				$where['berkas.verifikator'] = 'SKPD';
				$where['berkas.verifikasi_status !='] = null;
				break;
			case 'kepala_skpd':
				$where['berkas.nomor_skpd'] = $this->user_auth->no_company;
				// $kondisi_tte_status                       = "(berkas.tte_status = 'Y' OR berkas.tte_status = 'N' OR berkas.tte_status IS NULL)";
				// $where[$kondisi_tte_status]               = NULL;
				$where['berkas.tte_status !='] = null;
				$where['berkas.verifikasi_status'] = 'Y';
				break;
			default:
				$where['berkas.nomor_skpd !='] = null;
				// $where['berkas.tte_status']               = 'Y';
				break;
		}

		if (!empty($company)) {
			$where['berkas.nomor_skpd'] = $company;
		}

		$total_rows = $this->archieve->get_all_where_count($where);
		$total_filtered = $total_rows;

		if (!empty($search)) {
			$where['search'] = $search;
			$total_filtered = $this->archieve->get_all_where_count($where);
		}

		$data = array();
		$archieves = $this->archieve->get_all_where($where);
		if (!empty($archieves)) {
			foreach ($archieves as $archieve) {
				if ($archieve->verifikasi_status == 'R') {
					$status_color = 'warning';
					$status_name = 'Verifikasi Ditolak';
				} else if ($archieve->verifikasi_status == 'Y' and ($archieve->tte_status == 'N' or $archieve->tte_status == null)) {
					$status_color = 'info';
					$status_name = 'Menunggu Ditandatangan';
				} else if ($archieve->tte_status == 'R') {
					$status_color = 'danger';
					$status_name = 'Tandatangan Ditolak';
				} else if ($archieve->tte_status == 'Y') {
					$status_color = 'success';
					$status_name = 'Sudah Ditandatangani';
				} else {
					$status_color = 'primary';
					$status_name = 'Menunggu Diverifikasi';
				}

				$archieve->id = $this->encryption->encrypt($archieve->id);
				$params = array('archieve' => $archieve->id, 'company' => $archieve->nomor_skpd);
				$btn_detail = '<a href="' . base_url('v2/alih_media_arsip_vital/detail?') . http_build_query($params) . '" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>';
				// $btn_delete    = '<a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp btn-delete" data-archieve="' . $archieve->id . '" data-company="' . $archieve->nomor_skpd . '"><i class="fa fa-trash"></i></a>';

				$action = '<div class="d-flex">' . $btn_detail . '</div>';

				$nested['klasifikasi'] = '<a href="' . base_url('v2/alih_media_arsip_vital/detail?') . http_build_query($params) . '" class="text-primary">' . $archieve->kode_klsf ?? '-' . '</a>';
				$nested['deskripsi'] = (!empty($archieve->uraian_informasi_arsip)) ? $archieve->uraian_informasi_arsip : (!empty($archieve->deskripsi) ? $archieve->deskripsi : '-');
				$nested['tahun'] = $archieve->tahun;
				$nested['jumlah'] = (!empty($archieve->jumlah)) ? $archieve->jumlah . ' dok' : '-';
				$nested['tanggal'] = tgl_indo(date('Y-m-d', strtotime($archieve->tanggal))) ?? '-';
				$nested['status'] = '<span class="badge light badge-' . $status_color . '"><i class="fa fa-circle text-' . $status_color . ' me-1"></i> ' . $status_name . '</span>';
				if ($this->user_auth->user_role == 'admin') {
					$nested['company'] = $archieve->name;
				}
				$nested['action'] = $action;

				$data[] = $nested;
			}
		}

		$json_data = array(
			   "draw" => intval($this->input->post('draw')),
			   "recordsTotal" => intval($total_rows),
			   "recordsFiltered" => intval($total_filtered),
			   "data" => $data,
		);

		echo json_encode($json_data);
	}

	public function upload_pdf_temp()
	{
		if (empty($this->user_auth) and $this->session->userdata('next-state') != 'logged_in') {
			show_error('Not Authorize!', 401);
			die;
		}

		if (!$this->input->is_ajax_request()) {
			redirect('v2/alih_media_arsip_vital');
		}

		if (!is_dir('./assets/upload/berkas/temp/')) {
			mkdir('./assets/upload/berkas/temp/', 0755, true);
		}

		$config['upload_path'] = './assets/upload/berkas/temp/';
		$config['allowed_types'] = 'pdf';
		$config['encrypt_name'] = TRUE;
		$this->upload->initialize($config);

		if ($this->upload->do_upload('file_pdf')) {
			$upload_data = $this->upload->data();
			echo json_encode(array(
				   'status' => TRUE,
				   'url' => base_url('assets/upload/berkas/temp/' . $upload_data['file_name']),
				   'filename' => $upload_data['file_name'],
			));
		} else {
			echo json_encode(array('status' => FALSE, 'message' => $this->upload->display_errors('', '')));
		}
	}

	public function view_pdf()
	{
		if (empty($this->user_auth) or $this->session->userdata('next-state') != 'logged_in') {
			show_error('Not Authorize!', 401);
			die;
		}

		if (empty($_GET['archieve'])) {
			redirect('v2/alih_media_arsip_vital');
		}

		$archieve = $this->archieve->get_single_where(array('berkas.id' => $this->encryption->decrypt($_GET['archieve'])));
		if (empty($archieve) || empty($archieve->file)) {
			show_404();
			return;
		}

		$paths = [
			   './assets/upload/berkas/' . $archieve->file,
			   './assets/upload/' . $archieve->file,
		];

		$filepath = null;
		foreach ($paths as $path) {
			if (file_exists($path)) {
				$filepath = $path;
				break;
			}
		}

		if (empty($filepath)) {
			show_404();
			return;
		}
		// $filepath = FCPATH . 'assets/upload/berkas/' . $archieve->file;
		// if (!file_exists($filepath)) {
		//      show_404();
		//      return;
		// }

		// Bersihkan semua level output buffer CI
		while (ob_get_level() > 0) {
			ob_end_clean();
		}

		// Stream PDF inline — IDM tidak intercept karena URL tanpa .pdf
		header('Content-Type: application/pdf');
		header('Content-Disposition: inline; filename="' . $archieve->file . '"');
		header('Content-Length: ' . filesize($filepath));
		header('Cache-Control: private, max-age=0, must-revalidate');
		header('Pragma: public');
		header('X-Content-Type-Options: nosniff');

		readfile($filepath);
		exit;
	}

	public function vital_delete()
	{
		if (empty($this->user_auth) && $this->session->userdata('next-state') != 'logged_in') {
			echo json_encode(array('status' => 401, 'message' => 'Not Authorize!'));
//			show_error('Not Authorize!', 401);
			die;
		}

		if ($this->input->method() != 'post') {
			echo json_encode(array('status' => 405, 'message' => 'Maaf permintaan anda tidak dapat kami layani!'));
			die;
		}

		if (empty($_POST)) {
			echo json_encode(array('status' => 403, 'message' => 'Mohon pilih arsip terlebih dahulu! Silahkan coba kembali.'));
			die;
		}

		$archieve = $this->archieve->get_single_where(
			   array(
					 'berkas.id' => $this->encryption->decrypt($_POST['archieve']),
					 'berkas.nomor_skpd' => $_POST['company']
			   )
		);
		if (empty($archieve)) {
			echo json_encode(array('status' => 404, 'message' => 'Arsip tidak dapat ditemukan! Silahkan coba kembali.'));
			die;
		}

		$delete = $this->archieve->delete_entry(array('id' => $archieve->id, 'nomor_skpd' => $archieve->nomor_skpd));
		if ($delete > 0) {
			$paths = [
				   './assets/upload/berkas/' . $archieve->file,
				   './assets/upload/' . $archieve->file,
			];

			foreach ($paths as $path) {
				if (file_exists($path)) {
					unlink($path);
					break;
				}
			}

			echo json_encode(array('status' => 200, 'message' => 'Arsip berhasil dihapus.'));
			die;
		} else {
			echo json_encode(array('status' => 500, 'message' => 'Arsip gagal dihapus! Silahkan coba kembali.'));
		}
	}

	public function vital_verification()
	{
		if (empty($this->user_auth) && $this->session->userdata('next-state') != 'logged_in') {
			echo json_encode(array('status' => 401, 'message' => 'Not Authorize!'));
//			show_error('Not Authorize!', 401);
			die;
		}

		if ($this->input->method() != 'post') {
			echo json_encode(array('status' => 405, 'message' => 'Maaf permintaan anda tidak dapat kami layani!'));
			die;
		}

		if (empty($_POST)) {
			echo json_encode(array('status' => 403, 'message' => 'Mohon pilih arsip terlebih dahulu! Silahkan coba kembali.'));
			die;
		}

		$archieve = $this->archieve->get_single_where(
			   array(
					 'berkas.id' => $this->encryption->decrypt($_POST['archieve']),
					 'berkas.nomor_skpd' => $_POST['company']
			   )
		);
		if (empty($archieve)) {
			echo json_encode(array('status' => 404, 'message' => 'Arsip tidak dapat ditemukan! Silahkan coba kembali.'));
			die;
		}

		$data = array(
			   'verifikasi_status' => 'Y',
			   'verifikasi_user' => $this->encryption->decrypt($this->user_auth->user_id),
			   'verifikasi_tanggal' => date('Y-m-d H:i:s'),
			   'tte_status' => 'N'
		);

		$verification = $this->archieve->update_entry($data, array('id' => $archieve->id, 'nomor_skpd' => $archieve->nomor_skpd));
		if ($verification > 0) {
			$monitoring = array(
				   'berkas' => $archieve->id,
				   'title' => 'process',
				   'message' => 'Arsip telah diverifikasi dan diteruskan ke Kepala SKPD untuk ditandatangani.',
				   'user' => $this->encryption->decrypt($this->user_auth->user_id)
			);
			$this->monitoring->insert_entry($monitoring);
			echo json_encode(array('status' => 200, 'message' => 'Arsip berhasil diverifikasi oleh Anda'));
			die;
		} else {
			echo json_encode(array('status' => 500, 'message' => 'Arsip gagal diverifikasi oleh Anda! Silahkan coba kembali.'));
			die;
		}
	}

	public function vital_resend()
	{
		if (empty($this->user_auth) && $this->session->userdata('next-state') != 'logged_in') {
			echo json_encode(array('status' => 401, 'message' => 'Not Authorize!'));
//			show_error('Not Authorize!', 401);
			die;
		}

		if ($this->input->method() != 'post' or !in_array($this->user_auth->user_role, array('operator', 'verifikator_skpd'))) {
			echo json_encode(array('status' => 405, 'message' => 'Maaf permintaan anda tidak dapat kami layani!'));
			die;
		}

		if (empty($_POST)) {
			echo json_encode(array('status' => 403, 'message' => 'Mohon pilih arsip terlebih dahulu! Silahkan coba kembali.'));
			die;
		}

		$archieve = $this->archieve->get_single_where(
			   array(
					 'berkas.id' => $this->encryption->decrypt($_POST['archieve']),
					 'berkas.nomor_skpd' => $_POST['company']
			   )
		);
		if (empty($archieve)) {
			echo json_encode(array('status' => 404, 'message' => 'Arsip tidak dapat ditemukan! Silahkan coba kembali.'));
			die;
		}

		if ($this->user_auth->user_role == 'operator') {
			$data = array(
				   'verifikasi_status' => 'N',
			);
		} else if ($this->user_auth->user_role == 'verifikator_skpd') {
			$data = array(
				   'tte_status' => 'N',
			);
		}


		$resend = $this->archieve->update_entry($data, array('id' => $archieve->id, 'nomor_skpd' => $archieve->nomor_skpd));
		if ($resend > 0) {
			$monitoring = array(
				   'berkas' => $archieve->id,
				   'title' => 'start',
				   'user' => $this->encryption->decrypt($this->user_auth->user_id)
			);
			if ($this->user_auth->user_role == 'operator') {
				$monitoring['message'] = 'Arsip dikirim ulang untuk diverifikasi.';
			} else if ($this->user_auth->user_role == 'verifikator_skpd') {
				$monitoring['message'] = 'Arsip dikirim ulang untuk ditandatangan.';
			}
			$this->monitoring->insert_entry($monitoring);
			echo json_encode(array('status' => 200, 'message' => 'Arsip berhasil di kirim ulang oleh Anda'));
			die;
		} else {
			echo json_encode(array('status' => 500, 'message' => 'Arsip gagal di kirim ulang oleh Anda! Silahkan coba kembali.'));
			die;
		}
	}

	public function guide_list()
	{
		if (empty($this->user_auth) or $this->user_auth->user_role != 'admin') {
			show_error('Not Authorize!', 401);
			die;
		}

		$data['title']    = 'Guide Arsip';
		$data['employee'] = $this->user_auth;

		$this->backend('v2/backend/data_guide_arsip', $data);
	}

	public function guide_list_ajax()
	{
		if (empty($this->user_auth) or $this->user_auth->user_role != 'admin') {
			echo json_encode(array('status' => 401, 'message' => 'Not Authorize!'));
			die;
		}

		if (!$this->input->is_ajax_request()) {
			redirect('v2/backend/dashboards');
		}
		$list  = $this->guide_arsip->get_datatables();
		$data  = array();
		$no    = $_POST['start'];
		$nomor = 1;
		foreach ($list as $item) {
			$no++;
			$row   = array();
			$row[] = $nomor++;
			$row[] = $item->caption;
			$row[] = '<div class="d-flex"><a class="btn btn-primary btn-xs sharp me-1" href="javascript:void(0)" title="Edit" onclick="edit_data(\'' . $item->id . '\')"><i class="fas fa-pencil-alt"></i></a><a class="btn btn-danger btn-xs sharp" href="javascript:void(0)" title="Hapus" onclick="delete_data(\'' . $item->id . '\')"><i class="fas fa-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
			   "draw"            => $_POST['draw'],
			   "recordsTotal"    => $this->guide_arsip->count_all(),
			   "recordsFiltered" => $this->guide_arsip->count_filtered(),
			   "data"            => $data,
		);
		echo json_encode($output);
	}

	public function guide_edit($id)
	{
		if (empty($this->user_auth) or $this->user_auth->user_role != 'admin') {
			echo json_encode(array('status' => 401, 'message' => 'Not Authorize!'));
			die;
		}

		$data = $this->guide_arsip->get_by_id($id);
		echo json_encode($data);
	}

	public function guide_add()
	{
		if (empty($this->user_auth) or $this->user_auth->user_role != 'admin') {
			echo json_encode(array('status' => 401, 'message' => 'Not Authorize!'));
			die;
		}

		$this->_validate();
		$data = array(
			   'caption' => htmlentities($this->input->post('judul')),
		);

		$config['upload_path']   = './assets/upload/';
		$config['allowed_types'] = 'pdf';
		$config['encrypt_name']  = TRUE;

		$this->upload->initialize($config);
		if (!empty($_FILES['file']['name'])) {
			if ($this->upload->do_upload('file')) {
				$gbr = $this->upload->data();
				$data['file'] = $gbr['file_name'];
				$this->guide_arsip->save($data);
				echo json_encode(array("status" => TRUE));
				die;
			} else {
				echo json_encode(array('status' => false, 'message' => 'Upload dokumen gagal!'));
				die;
			}
		} else {
			echo json_encode(array('status' => false, 'message' => 'file tidak dapat ditemukan!'));
		}
	}

	public function guide_update()
	{
		if (empty($this->user_auth) or $this->user_auth->user_role != 'admin') {
			echo json_encode(array('status' => 401, 'message' => 'Not Authorize!'));
			die;
		}

		$this->_validate();
		$data = array(
			   'caption' => htmlentities($this->input->post('judul')),
		);

		$where = array(
			   'id' => htmlentities($this->input->post('id'))
		);
		$fileold = htmlentities($this->input->post('fileold'));

		$config['upload_path']   = './assets/upload/';
		$config['allowed_types'] = 'pdf';
		$config['encrypt_name']  = TRUE;

		$this->upload->initialize($config);
		if (!empty($_FILES['file']['name'])) {
			if ($this->upload->do_upload('file')) {
				@unlink("./assets/upload/" . $fileold);
				$gbr = $this->upload->data();
				$data['file'] = $gbr['file_name'];
				$this->guide_arsip->update($where, $data);
			}
		} else {
			$data['file'] = $fileold;
			$this->guide_arsip->update($where, $data);
		}
		echo json_encode(array("status" => TRUE));
	}

	public function guide_delete($id)
	{
		if (empty($this->user_auth) or $this->user_auth->user_role != 'admin') {
			echo json_encode(array('status' => 401, 'message' => 'Not Authorize!'));
			die;
		}

		$table = 'guide_arsip';
		$where = array('id' => $id);
		$query = $this->model->getone($table, $where);
		foreach ($query as $x) {
			$file = $x->file;
		}
		@unlink("./assets/upload/" . $file);
		$this->model->hapus($table, $where);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror']   = array();
		$data['status']       = TRUE;

		if ($this->input->post('judul') == '') {
			$data['inputerror'][]   = 'judul';
			$data['error_string'][] = 'Data judul harus di isi';
			$data['status']         = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}
