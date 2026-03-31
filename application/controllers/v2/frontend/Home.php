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
          $this->load->model('v2/Archieve', 'archieve');
          $this->load->model('v2/Company', 'company');
     }

     public function index()
     {
          $data['title']      = 'Beranda';

          $data['archieve_total']       = $this->archieve->get_all_where_count();
          $data['archieve_vital']       = $this->archieve->get_all_where_count(array('jenis_arsip' => 'vital'));
          $data['archieve_usul']        = $this->archieve->get_all_where_count(array('jenis_arsip' => 'usul_serah'));

          $data['archieve_arr']         = $this->archieve->get_all_where_skpd_group(array('groupBy' => 'company.no_company', 'orderBy' => 'company.no_company', 'orderDir' => 'asc'));
          // $data['company_arr']          = $this->company->get_all_where(array('orderBy' => 'no_company', 'orderDir' => 'asc'));

          // echo json_encode($data);
          // die;
          $data['banners']              = $this->banner->get_all_where(array('limits' => 8));

          $data['news']                 = $this->news->get_all_where(array('limits' => 8));
          $data['articles']             = $this->article->get_all_where(array('limits' => 8));
          $this->frontend('v2/frontend/home', $data);
     }
}
