<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LogsTte extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }

     public function insert_entry($data)
     {
          if (empty($data)) {
               return false;
          }

          return $this->db->insert('log_tte', $data);
     }

     public function get_all_where($where = null)
     {
          $this->db->where('deleted_at', null);

          if (!empty($where['limits']) or !empty($where['starts'])) {
               if (!empty($where['starts'])) {
                    $this->db->limit($where['limits'], $where['starts']);
               } else {
                    $this->db->limit($where['limits']);
               }
               unset($where['limits']);
               unset($where['starts']);
          }

          if (!empty($where['orders']) or !empty($where['dirs'])) {
               $this->db->order_by($where['orders'], $where['dirs']);
               unset($where['orders']);
               unset($where['dirs']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          $this->db->order_by('id', 'desc');
          $results = $this->db->get('log_tte')->result();
          if (!empty($results)) {
               foreach ($results as $result) {
                    $result->id         = $this->encryption->encrypt($result->id);
                    $result->user       = $this->db->select('email, fullname, jabatan')->where(['id' => $result->user])->get('employee')->row();
                    // $result->user->id   = $this->encryption->encrypt($result->user->id);
                    // $result->user  = $this->encryption->encrypt($result->user->user);
               }
          }
          return $results;
     }

     public function get_all_where_count($where = null)
     {
          $this->db->where('deleted_at', null);

          unset($where['limits']);
          unset($where['starts']);
          unset($where['orders']);
          unset($where['dirs']);

          if (!empty($where['search'])) {
               $this->db->like('ip_address', $where['search']);
               $this->db->or_like('description', $where['search']);
               $this->db->or_like('signed', $where['search']);
               unset($where['search']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->count_all_results('log_tte');
     }
}
