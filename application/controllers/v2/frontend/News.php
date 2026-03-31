<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends MY_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('v2/Article', 'article');
          $this->load->model('v2/Newslatter', 'newslatter');
     }

     public function index()
     {
          $search             = $this->input->get('keyword');
          $limits             = 6;
          $pages              = (!empty($this->input->get('pages'))) ? ($this->input->get('pages') - 1) * $limits : 0;

          $where              = array(
               'limits'        => $limits,
               'starts'        => $pages
          );

          if (!empty($search)) {
               $where['search']         = $search;
          }

          $this->load->library('pagination');
          $config['per_page']           = $where['limits'];
          $config['base_url']           = base_url('v2/frontend/news');
          $config['total_rows']         = $this->newslatter->get_all_where_count($where);
          $this->pagination->initialize($config);

          $data['newslatters']          = $this->newslatter->get_all_where($where);
          $data['newslatters_total']    = $config['total_rows'];
          $data['pagination']           = $this->pagination->create_links();

          $data['newslatters_last']     = $this->newslatter->get_all_where(array('limits' => 3));
          $data['articles_last']        = $this->article->get_all_where(array('limits' => 3));

          $data['title']                = 'Berita';

          $this->frontend('v2/frontend/news/index', $data);
     }

     public function detail()
     {
          $slug          = $this->input->get('slug');
          if (empty($slug)) {
               redirect('v2/frontend/news');
          }

          $newslatter         = $this->newslatter->get_single_where(array('slug' => $slug));
          if (empty($newslatter)) {
               show_404();
               die;
          }

          if (file_exists('./assets/upload/' . $newslatter->gambar)) {
               $newslatter->gambar      = base_url('assets/upload/' . $newslatter->gambar);
          } else {
               $newslatter->gambar      = base_url('assets/v3/frontend/images/blog/default/thum1.jpg');
          }

          $data['newslatter']           = $newslatter;
          $data['title']                = 'Detail Berita - ' . $newslatter->judul;

          $data['newslatters_last']     = $this->newslatter->get_all_where(array('limits' => 3));
          $data['articles_last']        = $this->article->get_all_where(array('limits' => 3));

          $this->frontend('v2/frontend/news/detail', $data);
     }

     public function articles()
     {
          $search             = $this->input->get('keyword');
          $limits             = 6;
          $pages              = (!empty($this->input->get('pages'))) ? ($this->input->get('pages') - 1) * $limits : 0;

          $where              = array(
               'limits'        => $limits,
               'starts'        => $pages
          );

          if (!empty($search)) {
               $where['search']         = $search;
          }

          $this->load->library('pagination');
          $config['per_page']           = $where['limits'];
          $config['base_url']           = base_url('v2/frontend/news/articles');
          $config['total_rows']         = $this->article->get_all_where_count($where);
          $this->pagination->initialize($config);

          $data['articles']             = $this->article->get_all_where($where);
          $data['articles_total']       = $config['total_rows'];
          $data['pagination']           = $this->pagination->create_links();

          $data['articles_last']        = $this->article->get_all_where(array('limits' => 3));
          $data['title']                = 'Artikel';

          $data['news_last']            = $this->newslatter->get_all_where(array('limits' => 3));

          $this->frontend('v2/frontend/news/article', $data);
     }

     public function articles_detail()
     {
          $slug               = $this->input->get('slug');
          if (empty($slug)) {
               redirect('v2/frontend/news/articles');
          }

          $article            = $this->article->get_single_where(array('slug' => $slug));
          if (empty($article)) {
               show_404();
               die;
          }

          if (file_exists('./assets/upload/' . $article->gambar)) {
               $article->gambar    = base_url('assets/upload/') . $article->gambar;
          } else {
               $article->gambar    = base_url('assets/v3/frontend/images/blog/default/thum1.jpg');
          }

          $data['article']         = $article;
          $data['articles_last']   = $this->article->get_all_where(array('limits' => 3));
          $data['title']           = 'Detail Artikel - ' . $article->judul;
          // echo json_encode($data);
          // die;

          $this->frontend('v2/frontend/news/article_detail', $data);
     }
}
