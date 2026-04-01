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
          if (!empty($where['search'])) {
               $this->db->like('judul', $where['search']);
               unset($where['search']);
          }

          if (!empty($where['limits']) or !empty($where['starts'])) {
               $this->db->limit($where['limits'], $where['starts']);
               unset($where['limits']);
               unset($where['starts']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          $this->db->order_by('idartikel', 'desc');
          $results   = $this->db->get('artikel')->result();
          return $results;
     }

     public function get_all_where_count($where = null)
     {
          if (!empty($where['limits']) or !empty($where['starts'])) {
               unset($where['limits']);
               unset($where['starts']);
          }

          if (!empty($where['search'])) {
               $this->db->like('judul', $where['search']);
               unset($where['search']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->count_all_results('artikel');
     }

     public function get_single_where($where = null)
     {
          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->get('artikel')->row();
     }
}
