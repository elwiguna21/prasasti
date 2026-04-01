<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{



     public function __construct()
     {
          parent::__construct();
          $this->load->model('M_login_admin');
          $this->load->library('session');
          $this->load->library('Recaptcha');
     }

     public function index()
     {

          $this->load->view('login');
     }

     function do_login()
     {

          $recaptcha = $this->input->post('g-recaptcha-response');
          $response = $this->recaptcha->verifyResponse($recaptcha);
          $username = trim(htmlentities($this->input->post('username')));
          $password = trim(htmlentities($this->input->post('password')));
          $where = array(
               'username' => $username,
               'password' => md5($password)
          );


          if ($response['success'] == TRUE) {
               $this->session->unset_userdata('kode_captcha');
               $cek = $this->M_login_admin->cek_login("t_admin", $where)->num_rows();
               if ($cek > 0) {

                    $data_session = array(
                         'nama' => $username,
                         'status' => "login",
                         'nomor_skpd' => null,
                         'level' => "admin"
                    );

                    $this->session->set_userdata($data_session);

                    redirect("Panel");
               } elseif ($cek == 0) {
                    $query = $this->M_login_admin->cek_login("skpd", $where);
                    $exist = $query->num_rows();
                    if ($exist > 0) {
                         foreach ($query->result() as $data) {
                              $nomor_skpd = $data->nomor_skpd;
                              $nama_operator = $data->nama_operator;
                              $nama_skpd = $data->nama_skpd;
                         }
                         $data_session = array(
                              'nama' => $nama_operator,
                              'status' => "login",
                              'skpd' => $nama_skpd,
                              'level' => 'user',
                              'nomor_skpd' => $nomor_skpd

                         );

                         $this->session->set_userdata($data_session);

                         redirect(base_url("Dashboard"));
                    } else {
                         redirect("Admin");
                    }
               } else {
                    redirect("Admin");
               }
          } else {
               redirect("Admin");
          }
     }


     function logout()
     {
          $this->session->unset_userdata('status');
          $this->session->unset_userdata('nama');
          $this->session->sess_destroy();
          redirect("Admin");
     }
}
