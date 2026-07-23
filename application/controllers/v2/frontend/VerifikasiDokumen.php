<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VerifikasiDokumen extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('v2/Berkas', 'berkas');
	}

	/**
	 * Halaman publik verifikasi dokumen TTE
	 * URL: /v2/frontend/verifikasi_dokumen/index/{id}
	 */
	public function index($id = null)
	{
		if (empty($id)) {
			show_404();
			return;
		}

		$berkas = $this->berkas->get_by_id($id);
		if (empty($berkas)) {
			$data['title'] = 'Dokumen Tidak Ditemukan';
			$data['berkas'] = null;
		} else {
			// Ambil data penanda tangan jika sudah di-TTE
			if (!empty($berkas->tte_user)) {
				$data['penandatangan'] = $this->db->get_where('employee', ['user' => $berkas->tte_user])->row();
				if (!empty($data['penandatangan'])) {
					$data['penandatangan']->id = $this->encryption->encrypt($data['penandatangan']->id);
					$data['penandatangan']->nik = $this->encryption->encrypt($data['penandatangan']->nik);
					$data['penandatangan']->company = $this->encryption->encrypt($data['penandatangan']->company);
					$data['penandatangan']->user = $this->encryption->encrypt($data['penandatangan']->user);
				}
			}

			$berkas->id = $this->encryption->encrypt($berkas->id);
			$berkas->user = $this->encryption->encrypt($berkas->user);
			$berkas->verifikasi_user = $this->encryption->encrypt($berkas->verifikasi_user);
			$berkas->tte_user = $this->encryption->encrypt($berkas->tte_user);
			$data['title'] = 'Verifikasi Dokumen Elektronik';
			$data['berkas'] = $berkas;
		}

//	   echo json_encode($data);die;

		$this->frontend('v2/frontend/verifikasi_dokumen', $data);
	}
}
