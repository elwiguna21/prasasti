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
               $user                    = $this->user->get_single_where(
                    array(
                         'id'           => $this->encryption->decrypt($this->session->userdata('next-uid')),
                         'username'     => $this->session->userdata('next-uname')
                    )
               );

               if (!empty($user) && $user->role != 'admin') {
                    $this->employee_auth = $this->employee->get_single_where(array(
                         'company'      => $user->company,
                         'user'         => $this->encryption->decrypt($user->id)
                    ));
               } else {
                    $this->employee_auth               = new stdClass();
                    $this->employee_auth->fullname     = 'Admin';
               }
               $this->employee_auth->avatar     = base_url('assets/v3/backend/images/avatar/user-dummy.jpg');
          }
     }

     public function index()
     {
          $data['title']      = 'Dashboard';
          $data['employee']   = $this->employee_auth;

          $this->backend('v2/backend/dashboard', $data);
     }
}
