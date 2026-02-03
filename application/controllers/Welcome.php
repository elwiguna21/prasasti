<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{


     function __construct()
     {
          parent::__construct();
          redirect('v2/frontend/home');
     }

     public function index()
     {
          redirect('Front');
     }
}
