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

          // Visitor Logging
          // Attempt to load the model and log if table exists (avoids error if table not yet created)
          if ($this->db->table_exists('visitor_logs')) {
               $this->load->model('v2/Visitor_model', 'visitor_model');
               $this->visitor_model->log_visitor();
          }
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

     public function frontend_new($content, $data = null)
     {
          if ($this->db->table_exists('visitor_logs')) {
               $this->load->model('v2/Visitor_model', 'visitor_model');
               $data['visitor_stats'] = [
                    'today' => $this->visitor_model->get_today_visitors(),
                    'month' => $this->visitor_model->get_this_month_visitors(),
                    'total' => $this->visitor_model->get_total_visitors()
               ];
          } else {
               $data['visitor_stats'] = ['today' => 0, 'month' => 0, 'total' => 0];
          }

          $data['header']     = $this->load->view('v2/templates/frontend/header', $data, true);
          $data['content']    = $this->load->view($content, $data, true);
          $data['footer']     = $this->load->view('v2/templates/frontend/footer', $data, true);

          $this->load->view('v2/templates/frontend/index', $data);
     }
}
