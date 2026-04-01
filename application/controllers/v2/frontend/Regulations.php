<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Regulations extends MY_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('v2/Regulation', 'regulation');
     }

     public function index()
     {
          $data['title']      = 'Daftar Peraturan / Regulasi';

          $this->frontend('v2/frontend/regulation', $data);
     }

     public function get_regulations_json()
     {
          if ($this->input->method() != 'post') {
               show_error('Post Request Only!', 405);
               die;
          }

          $columns        = array(
               0 => 'id',
               1 => 'caption',
          );

          $limit      = $this->input->post('length');
          $start      = $this->input->post('start');
          $order      = (!empty($this->input->post('order'))) ? $columns[$this->input->post('order')[0]['column']] : "id";
          $dir        = (!empty($this->input->post('order'))) ? $this->input->post('order')[0]['dir'] : "asc";
          $search     = (!empty($this->input->post('search')['value'])) ? $this->input->post('search')['value'] : null;

          $where      = array(
               'starts'    => $start,
               'limits'    => $limit,
               'orders'    => $order,
               'dirs'      => $dir,
          );

          $total_rows         = $this->regulation->get_all_where_count($where);
          $total_filtered     = $total_rows;

          if (!empty($search)) {
               $where['search']    = $search;
               $total_filtered     = $this->regulation->get_all_where_count($where);
          }

          $data               = array();
          $regulations        = $this->regulation->get_all_where($where);
          if (!empty($regulations)) {
               foreach ($regulations as $regulation) {
                    if (file_exists('./assets/upload/' . $regulation->file)) {
                         $regulation->file   = base_url('assets/upload/') . $regulation->file;
                    } else {
                         $regulation->file   = 'javascript:void(0);';
                    }

                    $nested['id']       = $regulation->id;
                    $nested['title']    = $regulation->caption;
                    $nested['document'] = '<a class="site-button radius-no" href="' . $regulation->file . '" target="_blank"><i class="ti-download me-2"></i> Download</a>';

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
}
