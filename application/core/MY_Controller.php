<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          // if ($this->config->item('maintenance_mode') == TRUE) {
          //      redirect(base_url('error_docs/maintenance.html'));
          // }
     }

     public function backend($content, $data = NULL)
     {
          $data['header']     = $this->load->view('v2/templates/backend/header', $data, true);
          $data['content']    = $this->load->view($content, $data, true);
          $data['footer']     = $this->load->view('v2/templates/backend/footer', $data, true);

          $this->load->view('v2/templates/backend/index', $data);
     }

     public function frontend($content, $data = null)
     {
          $data['header']     = $this->load->view('v2/templates/frontend/header', $data, true);
          $data['content']    = $this->load->view($content, $data, true);
          $data['footer']     = $this->load->view('v2/templates/frontend/footer', $data, true);

          $this->load->view('v2/templates/frontend/index', $data);
     }
}
