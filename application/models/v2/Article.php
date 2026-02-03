<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }

     public function get_all_where($where = null)
     {
          if (!empty($where['limits'])) {
               $this->db->limit($where['limits']);
               unset($where['limits']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          $this->db->order_by('idartikel', 'desc');
          $results   = $this->db->get('artikel')->result();
          return $results;
     }
}
