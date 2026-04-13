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
          $user          = $this->user->get_single_where(array('username' => $username, 'password' => hashing_password('sha512', $password, KEY_ENCRYPT)));
          if (empty($user)) {
               $this->session->set_flashdata(array('status' => 500, 'message' => 'Pengguna tidak dapat ditemukan!'));
               redirect('v2/authentications');
          }

          $this->session->set_userdata('next-uid', $user->id);
          $this->session->set_userdata('next-uname', $user->username);
          $this->session->set_userdata('next-role', $user->role);
          $this->session->set_userdata('next-state', 'logged_in');
          redirect('v2/dashboards');
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

     public function reset_pwds()
     {
          $new_pwd       = 'Sumedang123#';
          $new_pwd_hash  = hashing_password('sha512', $new_pwd, KEY_ENCRYPT);

          $this->db->set('password', $new_pwd_hash);
          $this->db->where('role', 'operator');
          $reset_op      = $this->db->update('user');

          $this->db->set('password', hashing_password('sha512', 'Sumedang2020@', KEY_ENCRYPT));
          $this->db->where(array('username' => 'Admin', 'role' => 'admin'));
          $reset_adm     = $this->db->update('user');

          if ($reset_op && $reset_adm) {
               echo true;
          } else {
               echo false;
          }
     }
}
