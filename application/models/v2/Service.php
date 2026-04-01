<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }

     public function get_single_where($where = null)
     {
          $this->db->where('deleted_at', null);

          if (!empty($where['search'])) {
               $this->db->like('code', $where['search']);
               $this->db->or_like('email', $where['search']);
               $this->db->or_like('phone', $where['search']);
               unset($where['search']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->get('repair')->row();
     }

     public function get_all_where($where = null)
     {
          $this->db->where('deleted_at', null);

          if (!empty($where['search'])) {
               $this->db->like('code', $where['search']);
               $this->db->or_like('email', $where['search']);
               unset($where['search']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->get('repair')->result();
     }

     public function get_all_where_count($where = null)
     {
          $this->db->where('deleted_at', null);

          if (!empty($where['search'])) {
               $this->db->like('code', $where['search']);
               $this->db->or_like('email', $where['search']);
               unset($where['search']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->count_all_results('repair');
     }

     public function insert_entry($data)
     {
          return $this->db->insert('repair', $data);
     }
}
