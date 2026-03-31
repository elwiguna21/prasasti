<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboards extends MY_Controller
{
     public $employee_auth, $user_auth;
     public function __construct()
     {
          parent::__construct();
          $this->load->model('v2/User', 'user');
          $this->load->model('v2/Employee', 'employee');

          if (empty($this->session->userdata('next-uid')) && empty($this->session->userdata('next-role'))) {
               show_error('Not Authorize! Please signin again.', 403);
               die;
          } else {
               $user                    = $this->employee->get_single_where(
                    array(
                         'user.id'           => $this->encryption->decrypt($this->session->userdata('next-uid')),
                         'user.username'     => $this->session->userdata('next-uname')
                    )
               );

               if (empty($user)) {
                    redirect('v2/authentications/signout');
               }

               $this->user_auth              = $user;
               $this->user_auth->avatar      = base_url('assets/v3/backend/images/avatar/user-dummy.jpg');
          }
     }

     public function index()
     {
          $data['title']      = 'Dashboard';
          $data['employee']   = $this->user_auth;

          $this->backend('v2/backend/dashboard', $data);
     }

     public function archieves()
     {
          $data['title']      = 'Daftar Arsip';
          $data['employee']   = $this->user_auth;

          $this->backend('v2/backend/archieves/static/index', $data);
     }

     public function add_static_archieves()
     {
          $data['title']      = 'Tambah Arsip Statis';
          $data['employee']   = $this->user_auth;

          $this->backend('v2/backend/archieves/static/add', $data);
     }
}
