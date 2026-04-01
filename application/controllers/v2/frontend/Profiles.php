<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profiles extends MY_Controller
{
     public function __construct()
     {
          parent::__construct();
          // $this->load->model('v2/Banner', 'banner');
          // $this->load->model('v2/Newslatter', 'news');
          $this->load->model('v2/Profile', 'profile');
     }

     public function index()
     {
          $data['title']      = 'Sambutan';
          $this->frontend('v2/frontend/profiles/index', $data);
     }

     public function vision()
     {
          $data['title']      = 'Visi & Misi';

          $data['profile']    = $this->profile->get_single_where(null, 'profil');
          // echo json_encode($data);
          // die;
          $this->frontend('v2/frontend/profiles/vision', $data);
     }

     public function about()
     {
          $data['title']      = 'Gambaran Umum';

          $data['profile']    = $this->profile->get_single_where(null, 'profil');
          // echo json_encode($data);
          // die;
          $this->frontend('v2/frontend/profiles/about', $data);
     }

     public function jobdesc()
     {
          $data['title']      = 'Tugas dan Fungsi';
          $data['profile']    = $this->profile->get_single_where(null, 'profil');

          $this->frontend('v2/frontend/profiles/jobdesc', $data);
     }

     public function history()
     {
          $data['title']      = 'Tugas dan Fungsi';
          $data['profile']    = $this->profile->get_single_where(null, 'profil');

          $this->frontend('v2/frontend/profiles/history', $data);
     }

     public function structure()
     {
          $data['title']      = 'Struktur Organisasi';
          $data['profile']    = $this->profile->get_single_where(null, 'profil');

          $this->frontend('v2/frontend/profiles/structure', $data);
     }
}
