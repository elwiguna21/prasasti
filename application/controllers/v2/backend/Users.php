<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
     public function __construct()
     {
          parent::__construct();
     }

     public function index()
     {
          $data['title']      = 'Daftar Pengguna';

          $this->backend('v2/backend/users', $data);
     }
}
