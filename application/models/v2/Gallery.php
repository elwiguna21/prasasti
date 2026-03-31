<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }

     public function get_all_where($where = null)
     {
          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->get('galeri')->result();
     }
}
