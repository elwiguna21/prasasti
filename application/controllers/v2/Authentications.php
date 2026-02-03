<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentications extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->library('Recaptcha');
     }

     public function index()
     {
          if (!empty($this->session->userdata('next-uid')) && !empty($this->session->userdata('next-role'))) {
               redirect('v2');
          }

          $this->load->view('v2/login');
     }

     public function signin()
     {
          if (!empty($this->session->userdata('next-uid')) && !empty($this->session->userdata('next-role'))) {
               redirect('v2');
          }

          if (empty($_POST)) {
               show_error('Please fill a form sign in!', 403);
               die;
          }

          $username      = trim(htmlentities($this->input->post('username')));
          $password      = trim(htmlentities($this->input->post('password')));

          $this->load->model('v2/User', 'user');
          $user          = $this->user->get_single_where(array('username' => $username, 'password' => md5($password)));
          if (empty($user)) {
               $this->session->set_flashdata(array('status' => 500, 'message' => 'Pengguna tidak dapat ditemukan!'));
               redirect('v2/authentications');
          }

          $this->session->set_userdata('next-uid', $user->id);
          $this->session->set_userdata('next-uname', $user->username);
          $this->session->set_userdata('next-role', $user->role);
          $this->session->set_userdata('next-state', 'logged_in');
          redirect('v2/backend/dashboards');
     }

     public function signout()
     {
          $data_session  = array(
               'next-uid',
               'next-role',
          );
          $this->session->unset_userdata($data_session);
          session_destroy();
          redirect('v2/authentications');
     }
}
