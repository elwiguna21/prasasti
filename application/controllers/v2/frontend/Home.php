<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('v2/Banner', 'banner');
          $this->load->model('v2/Newslatter', 'news');
          $this->load->model('v2/Article', 'article');
     }

     public function index()
     {
          $data['title']      = 'Beranda';
          $data['banners']    = $this->banner->get_all_where();

          $data['news']            = $this->news->get_all_where(array('limits' => 8));
          $data['articles']        = $this->article->get_all_where(array('limits' => 8));

          // echo json_encode($data);
          // die;
          $this->frontend('v2/frontend/home', $data);
     }
}
