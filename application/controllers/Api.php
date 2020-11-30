<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('M_admin', 'model');
    }

    function berkas_post()
    {
        $gembok = "b0926b7cd30e00c8bb76d2ed3f0d9c8f";
        $key = $this->post('key');
        $id_berkas = $this->post('id_berkas');

        if ($gembok == $key) {
            // $id = $this->get('id');
            // $arsip = $this->model->getdata('berkas');
            $this->db->select('berkas.id,berkas.tanggal,berkas.kode_klsf,berkas.indek,berkas.deskripsi,berkas.tahun,berkas.unit_kerja_pencipta,berkas.file,berkas.lokasi_sampul,berkas.lokasi_berkas,berkas.lokasi_box,berkas.lokasi_rak,berkas.keterangan_tk_perkembangan,berkas.ruang_penyimpanan,skpd.nama_skpd,skpd.alamat_skpd,skpd.nama_operator,skpd.kontak_operator');
            $this->db->select('berkas.tanggal');
            $this->db->join('skpd', 'berkas.nomor_skpd = skpd.id_skpd');
            if ($id_berkas != null) {
                $this->db->where("berkas.id", $id_berkas);
            }
            $data_arsip = $this->db->get('berkas')->result_array();

            $data['status'] = true;
            $data['data'] = $data_arsip;
            if (isset($data_arsip)) {
                $this->response($data, 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No users were found'
                ], 404);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Wrong key'
            ], 404);
        }
    }
}
