<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Regulation extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }

     public function get_all_where($where = null)
     {
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
               $this->db->like('caption', $where['search']);
               unset($where['search']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          $results       = $this->db->get('peraturan')->result();
          return $results;
     }

     public function get_all_where_count($where = null)
     {
          if (!empty($where['search'])) {
               $this->db->like('caption', $where['search']);
          }

          unset($where['limits']);
          unset($where['starts']);
          unset($where['orders']);
          unset($where['dirs']);
          unset($where['search']);

          if (!empty($where)) {
               $this->db->where($where);
          }

          $results       = $this->db->count_all_results('peraturan');
          return $results;
     }
}
