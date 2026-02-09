<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }

     public function get_single_where($where = null)
     {
          $this->db->select('user.*, company.id AS company_id, company.no_company AS company_no, company.name AS company_name, company.address AS company_address, company.phone AS company_phone, company.email AS company_email');
          $this->db->where('user.deleted_at', null);

          if (!empty($where['search'])) {
               $this->db->like('user.username', $where['search']);
               // $this->db->or_like('employee.fullname', $where['search']);
               // $this->db->or_like('employee.email', $where['search']);
          }
          unset($where['search']);

          if (!empty($where)) {
               $this->db->where($where);
          }

          $this->db->join('company', 'company.id = user.company', 'left');
          $result   = $this->db->get('user')->row();
          if (!empty($result)) {
               $result->id         = $this->encryption->encrypt($result->id);
               $result->password   = "SECRET";
          }

          return $result;
     }

     public function get_all_where($where = null)
     {
          $this->db->where(array(
               'deleted_at' => null,
          ));

          if (!empty($where['limits']) or !empty($where['starts'])) {
               $this->db->limit($where['limits'], $where['starts']);
               unset($where['limits']);
               unset($where['starts']);
          }

          if (!empty($where['orders']) or !empty($where['dirs'])) {
               $this->db->order_by($where['orders'], $where['dirs']);
               unset($where['orders']);
               unset($where['dirs']);
          }

          if (!empty($where['search'])) {
               $this->db->like('username', $where['search']);
               unset($where['search']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          $results       = $this->db->get('user')->result();
          if (!empty($results)) {
               foreach ($results as $res) {
                    $res->id            = $this->encryption->encrypt($res->id);
                    $res->password      = 'SECRET';
                    $res->company       = $this->db->get_where('company', array('id' => $res->company))->row();
                    $res->employee      = $this->db->get_where('employee', array('user' => $this->encryption->decrypt($res->id)))->row();
               }
          }

          return $results;
     }

     public function get_all_where_count($where = null)
     {
          $this->db->where(array('deleted_at' => null));

          // if (!empty($where['limits']) and !empty($where['starts'])) {
          // $this->db->limit($where['limits'], $where['starts']);
          // }

          if (!empty($where['search'])) {
               $this->db->like('name', $where['search']);
               $this->db->or_like('code', $where['search']);
          }

          unset($where['limits']);
          unset($where['starts']);
          unset($where['orders']);
          unset($where['dirs']);
          unset($where['search']);

          if (!empty($where)) {
               $this->db->where($where);
          }

          $results       = $this->db->get('user')->num_rows();
          return $results;
     }

     public function insert_entry($data)
     {
          $this->db->insert('user', $data);
          return $this->db->insert_id();
     }

     public function update_entry($data, $where)
     {
          if (empty($where)) {
               return false;
          }

          $data['updated_at']      = date('Y-m-d H:i:s');
          $this->db->where($where);
          return $this->db->update('user', $data);
     }

     public function delete_entry($where)
     {
          if (empty($where)) {
               return false;
          }

          $data['deleted_at']      = date('Y-m-d H:i:s');
          $this->db->where($where);
          return $this->db->update('user', $data);
     }
}
