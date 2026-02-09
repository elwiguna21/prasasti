<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }

     public function get_all_where($where = null)
     {
          $this->db->order_by('name', 'asc');
          $this->db->where('deleted_at is null');

          if (!empty($where['search'])) {
               $this->db->like('name', $where['search']);
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

          $results  = $this->db->get('company')->result();
          return $results;
     }

     public function get_all_where_count($where = null)
     {
          $this->db->where('deleted_at is null');

          if (!empty($where['search'])) {
               $this->db->like('name', $where['search']);
               unset($where['search']);
          }

          unset($where['limits']);
          unset($where['starts']);

          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->get('company')->num_rows();
     }

     public function get_single_where($where = null)
     {
          $this->db->where('deleted_at is null');

          if (!empty($where)) {
               $this->db->where($where);
          }

          $result   = $this->db->get('company')->row();
          if (!empty($result)) {
               $result->id    = $this->encryption->encrypt($result->id);
          }

          return $result;
     }
}
