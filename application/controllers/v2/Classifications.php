<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classifications extends MY_Controller
{
     public $user_auth;

     public function __construct()
     {
          parent::__construct();
          $this->load->model('v2/Klasifikasi', 'klasifikasi');
          $this->load->model('v2/Employee', 'employee');

          if (empty($this->session->userdata('next-uid')) && empty($this->session->userdata('next-role'))) {
               show_error('Not Authorize! Please signin again.', 403);
               die;
          } else {
               $user = $this->employee->get_single_where(
                    array(
                         'user.id'       => $this->encryption->decrypt($this->session->userdata('next-uid')),
                         'user.username' => $this->session->userdata('next-uname')
                    )
               );

               if (empty($user)) {
                    redirect('v2/authentications/signout');
               }

               $this->user_auth = $user;
               $this->user_auth->avatar = base_url('assets/v3/backend/images/avatar/user-dummy.jpg');
          }
     }

     public function index()
     {
          $data['title']      = 'Daftar Kode Klasifikasi';
          $data['employee']   = $this->user_auth;

          echo json_encode($data);
     }

     public function get_classifications_json()
     {
          if ($this->input->method() != 'post') {
               http_response_code(405);
               show_error('Post Request Only!', 405);
               echo json_encode(array('status' => 405, 'message' => 'Post Request Only!'));
               die;
          }

          $search     = $this->input->post('search');
          // $page       = (!empty($this->input->post('page'))) ? $this->input->post('page') : 1;
          $page       = $this->input->post('page');

          $where      = array(
               'limits'    => '20',
               'starts'    => $page,
               'orders'    => 'id',
               'dirs'      => 'asc',
          );

          if (!empty($search)) {
               $where['search']      = $search;
          }

          $classifications              = $this->klasifikasi->get_all_where($where);

          if (!empty($classifications)) {
               foreach ($classifications as $classification) {
                    $classification->id     = $classification->kode_gabungan;
                    $classification->text  = $classification->kode_gabungan . ' - ' . $classification->nama;
               }
               $data['results']            = $classifications;
               $data['pagination']         = true;
          } else {
               $data['results']            = null;
               $data['pagination']         = false;
          }

          $data['totalRows']              = $this->klasifikasi->get_all_where_count($where);

          echo json_encode($data);
     }
}
