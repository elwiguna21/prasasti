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
          $this->db->where('repair.deleted_at', null);

          if (!empty($where['search'])) {
               $this->db->like('code', $where['search']);
               $this->db->or_like('email', $where['search']);
               $this->db->or_like('phone', $where['search']);
               unset($where['search']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          $this->db->select('repair.*, employee.fullname as employee_fullname');
          $this->db->join('employee', 'repair.verification_user = employee.user', 'left');
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

          if (!empty($where['limits']) or !empty($where['starts'])) {
               $this->db->limit($where['limits'], $where['starts']);
               unset($where['limits']);
               unset($where['starts']);
          }

          if (!empty($where['dirs']) or !empty($where['orders'])) {
               $this->db->order_by($where['orders'], $where['dirs']);
               unset($where['orders']);
               unset($where['dirs']);
          } else {
               $this->db->order_by('id', 'desc');
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

          unset($where['limits']);
          unset($where['starts']);
          unset($where['orders']);
          unset($where['dirs']);

          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->count_all_results('repair');
     }

     public function insert_entry($data)
     {
          return $this->db->insert('repair', $data);
     }

     public function update_entry($data, $where)
     {
          if (empty($where)) {
               return false;
          }

          $data['updated_at']      = date('Y-m-d H:i:s');
          $this->db->where($where);
          return $this->db->update('repair', $data);
     }
}
