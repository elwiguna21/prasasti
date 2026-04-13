<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }

     public function get_all_where($where = null)
     {
          if (!empty($where['search'])) {
               $this->db->like('caption', $where['search']);
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

          return $this->db->get('inventaris_arsip')->result();
     }

     public function get_single_where($where = null)
     {
          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->get('inventaris_arsip')->row();
     }

     public function get_all_where_count($where = null)
     {
          if (!empty($where['search'])) {
               $this->db->like('caption', $where['search']);
               unset($where['search']);
          }

          unset($where['limits']);
          unset($where['starts']);

          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->count_all_results('inventaris_arsip');
     }
}
