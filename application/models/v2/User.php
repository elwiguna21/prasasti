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
          $this->db->select('company.*, company.id AS company_id, employee.*, employee.id AS employee_id, user.*');
          $this->db->where('user.deleted_at', null);

          if (!empty($where['search'])) {
               $this->db->like('user.username', $where['search']);
               $this->db->or_like('employee.fullname', $where['search']);
               // $this->db->or_like('employee.email', $where['search']);
               unset($where['search']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          $this->db->join('employee', 'employee.user = user.id', 'left');
          $this->db->join('company', 'company.id = user.company', 'left');
          $result   = $this->db->get('user')->row();
          if (!empty($result)) {
               $result->id         = $this->encryption->encrypt($result->id);
               $result->password   = "SECRET";
               if (!empty($result->role)) {
                    $result->role       = explode(';', $result->role);
               } else {
                    $result->role       = null;
               }
               unset($result->employee_id, $result->user);
          }

          return $result;
     }

     public function get_all_where($where = null)
     {
          $this->db->where('user.deleted_at', NULL);

          if (!empty($where['limits']) or !empty($where['starts'])) {
               $this->db->limit($where['limits'], $where['starts']);
               unset($where['limits'], $where['starts']);
          }

          if (!empty($where['orders']) or !empty($where['dirs'])) {
               $this->db->order_by($where['orders'], $where['dirs']);
               unset($where['orders'], $where['dirs']);
          }

          if (!empty($where['search'])) {
               $this->db->group_start();
               $this->db->like('user.username', $where['search']);
               $this->db->or_like('e.fullname', $where['search']);
               $this->db->group_end();
               unset($where['search']);
          }

          if (!empty($where['role'])) {
               $this->_apply_roles_filter($where['role']);
               unset($where['role']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          $this->db->select('e.*, e.id AS e_id, c.*, c.id AS c_id, user.*');
          $this->db->join('employee e', 'e.user = user.id', 'left');
          $this->db->join('company c', 'c.id = user.company', 'left');
          $results       = $this->db->get('user')->result();
          if (!empty($results)) {
               foreach ($results as $res) {
                    $res->id            = $this->encryption->encrypt($res->id);
                    $res->password      = 'SECRET';
                    // $res->company       = $this->db->get_where('company', array('id' => $res->company))->row();
                    // $res->employee      = $this->db->get_where('employee', array('user' => $this->encryption->decrypt($res->id)))->row();
               }
          }

          return $results;
     }

     public function get_all_where_count($where = null)
     {
          $this->db->where('user.deleted_at', NULL);

          if (!empty($where['search'])) {
               $this->db->group_start();
               $this->db->like('user.username', $where['search']);
               $this->db->or_like('e.fullname', $where['search']);
               $this->db->group_end();
          }

          unset($where['limits'], $where['starts'], $where['orders'], $where['dirs'], $where['search']);

          // if (!empty($where['role'])) {
          //      $this->_apply_roles_filter($where['role']);
          //      unset($where['role']);
          // }
          if (isset($where['role'])) {
               $this->_apply_roles_filter($where['role'], 'include');
               unset($where['role']);
          }

          if (isset($where['role !='])) {
               $this->_apply_roles_filter($where['role !='], 'exclude');
               unset($where['role !=']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          $this->db->join('employee e', 'e.user = user.id', 'left');
          $results       = $this->db->count_all_results('user');
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

     private function _apply_roles_filter($roles, $type = 'include')
     {
          $roles_key = is_array($roles) ? $roles : explode(',', $roles);
          $roles_key     = array_filter(array_map('trim', $roles_key));

          if (!empty($roles_key) && is_array($roles_key)) {

               // 1. WAJIB gunakan group_start() agar kondisi OR ini dikurung 
               //    dan tidak merusak WHERE lain (seperti deleted_at = null)
               $this->db->group_start();

               foreach ($roles_key as $index => $role) {
                    // 2. Escape string untuk keamanan dari SQL Injection
                    $safe_role = $this->db->escape_str($role);

                    if ($type === 'exclude') {
                         // LOGIKA EXCLUDE (!=)
                         // Kata tidak boleh ditemukan (FIND_IN_SET = 0)
                         // Digabungkan dengan AND secara default oleh CI karena (Bukan A DAN Bukan B)
                         $condition = "FIND_IN_SET('$safe_role', REPLACE(user.role, ';', ',')) = 0";

                         $this->db->where($condition, NULL, FALSE);
                    } else {
                         // LOGIKA INCLUDE (=)
                         // Kata harus ditemukan (FIND_IN_SET > 0)
                         // Digabungkan dengan OR karena (Adalah A ATAU Adalah B)
                         $condition = "FIND_IN_SET('$safe_role', REPLACE(user.role, ';', ',')) > 0";

                         if ($index === 0) {
                              $this->db->where($condition, NULL, FALSE);
                         } else {
                              $this->db->or_where($condition, NULL, FALSE);
                         }
                    }
               }

               // 4. Tutup kurung
               $this->db->group_end();
          }
     }
}
