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

    function arsip_get()
    {
        $arsip = $this->model->getdata('skpd');

        $data['status'] = true;
        $data['data'] = $arsip;
        if (isset($arsip)) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No users were found'
            ], 404);
        }
    }

    function profil_get()
    {
        $arsip = $this->model->getdata('profil');

        $data['status'] = true;
        $data['data'] = $arsip;
        if (isset($arsip)) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No users were found'
            ], 404);
        }
    }

    function berita_get()
    {
        $arsip = $this->model->getdata('berita');

        $data['status'] = true;
        $data['data'] = $arsip;
        if (isset($arsip)) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No users were found'
            ], 404);
        }
    }
}
