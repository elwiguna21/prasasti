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
          $this->db->where('service.deleted_at', null);

          if (!empty($where['search'])) {
               $this->db->like('service.code', $where['search']);
               $this->db->or_like('service.email', $where['search']);
               $this->db->or_like('service.phone', $where['search']);
               unset($where['search']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          $this->db->select('service.*, employee.fullname as employee_fullname');
          $this->db->join('employee', 'service.verification_user = employee.user', 'left');
          return $this->db->get('service')->row();
     }

     public function get_all_where($where = null)
     {
          $this->db->where('deleted_at', null);

          if (!empty($where['search'])) {
               $this->db->like('code', $where['search']);
               $this->db->or_like('fullname', $where['search']);
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

          return $this->db->get('service')->result();
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

          return $this->db->count_all_results('service');
     }

     public function insert_entry($data)
     {
          return $this->db->insert('service', $data);
     }

     public function update_entry($data, $where)
     {
          if (empty($where)) {
               return false;
          }

          $data['updated_at']      = date('Y-m-d H:i:s');
          $this->db->where($where);
          return $this->db->update('service', $data);
     }

	public function delete_entry($where)
	{
		if (empty($where)) {
			return false;
		}

		$data['deleted_at']      = date('Y-m-d H:i:s');
		$this->db->where($where);
		$this->db->update('service', $data);
		return $this->db->affected_rows();
	}
}
