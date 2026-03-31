<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galleries extends MY_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('v2/Gallery', 'gallery');
     }

     public function index()
     {
          $data['title']      = 'Galeri';

          $galleries          = $this->gallery->get_all_where();
          if (!empty($galleries)) {
               foreach ($galleries as $gallery) {
                    if (file_exists('./assets/upload/' . $gallery->file)) {
                         $gallery->file      = base_url('assets/upload/') . $gallery->file;
                    } else {
                         $gallery->file      = base_url('assets/v3/frontend/images/portfolio/image_1.jpg');
                    }
               }
          }

          $data['galleries']       = $galleries;

          $this->frontend('v2/frontend/gallery', $data);
     }
}
