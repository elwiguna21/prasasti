<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klasifikasi extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }
     public function get_all()
     {
          $this->db->order_by('kode_gabungan', 'ASC');
          return $this->db->get('klasifikasi')->result();
     }

     public function get_all_where($where = null)
     {
          if (!empty($where['limits']) or !empty($where['starts'])) {
               $this->db->limit($where['limits'], $where['starts']);
               unset($where['limits']);
               unset($where['starts']);
          }

          if (isset($where['orders']) && isset($where['dirs'])) {
               $this->db->order_by($where['orders'], $where['dirs']);
               unset($where['orders']);
               unset($where['dirs']);
          }

          if (!empty($where['search'])) {
               $this->db->like('nama', $where['search']);
               $this->db->or_like('kode_gabungan', $where['search']);
               unset($where['search']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->get('klasifikasi')->result();
     }

     public function get_all_where_count($where = null)
     {
          if (!empty($where['limits']) or !empty($where['starts'])) {
               unset($where['limits']);
               unset($where['starts']);
          }

          if (!empty($where['orders']) or !empty($where['dirs'])) {
               unset($where['orders']);
               unset($where['dirs']);
          }

          if (!empty($where['search'])) {
               $this->db->like('nama', $where['search']);
               $this->db->or_like('kode_gabungan', $where['search']);
               unset($where['search']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->count_all_results('klasifikasi');
     }
}
