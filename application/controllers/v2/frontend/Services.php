<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends MY_Controller
{
     public function __construct()
     {
          parent::__construct();
     }

     public function index()
     {
          $data['title']      = 'Layanan';

          $this->frontend('v2/frontend/home', $data);
     }
}
