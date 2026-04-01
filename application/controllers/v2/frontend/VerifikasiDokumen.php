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
            $data['title']  = 'Dokumen Tidak Ditemukan';
            $data['berkas'] = null;
        } else {
            $data['title']  = 'Verifikasi Dokumen Elektronik';
            $data['berkas'] = $berkas;

            // Ambil data penanda tangan jika sudah di-TTE
            if (!empty($berkas->tte_user)) {
                $data['penandatangan'] = $this->db->get_where('users', ['username' => $berkas->tte_user])->row();
            }
        }

        $this->frontend('v2/frontend/verifikasi_dokumen', $data);
    }
}
