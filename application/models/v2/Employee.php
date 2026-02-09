<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }

     public function get_single_where($where = null)
     {
          $this->db->select('employee.*, company.id AS company_id, company.no_company AS company_no, company.name AS company_name, company.address AS company_address, company.email AS company_email, company.phone AS company_phone, user.id AS user_id, user.username AS user_username, user.password AS user_password, user.role AS user_role');
          $this->db->where('employee.deleted_at', null);

          if (!empty($where['search'])) {
               $this->db->like('employee.fullname', $where['search']);
               $this->db->or_like('employee.email', $where['search']);
               $this->db->like('company.name', $where['search']);
               $this->db->like('user.username', $where['search']);
          }

          unset($where['search']);

          if (!empty($where)) {
               $this->db->where($where);
          } else {
               return null;
          }

          $this->db->join('company', 'company.id = employee.company', 'left');
          $this->db->join('user', 'user.id = employee.user', 'left');
          $result   = $this->db->get('employee')->row();
          if (!empty($result)) {
               $result->id              = $this->encryption->encrypt($result->id);
               $result->company_id      = $this->encryption->encrypt($result->company_id);
               $result->user_id         = $this->encryption->encrypt($result->user_id);
               $result->user_password   = 'SECRET';
               unset($result->company);
               unset($result->user);
          }
          return $result;
     }

     public function insert_entry($data)
     {
          $this->db->insert('employee', $data);
          return $this->db->insert_id();
     }

     public function update_entry($data, $where)
     {
          if (empty($where)) {
               return false;
          }

          $data['updated_at']      = date('Y-m-d H:i:s');
          $this->db->where($where);
          return $this->db->update('employee', $data);
     }

     public function delete_entry($where)
     {
          if (empty($where)) {
               return false;
          }

          $data['deleted_at']      = date('Y-m-d H:i:s');
          $this->db->where($where);
          return $this->db->update('employee', $data);
     }
}
