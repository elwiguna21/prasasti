<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }

     public function get_all_where($where = null, $table)
     {
          if (!empty($where['limits']) or !empty($where['starts'])) {
               $this->db->limit($where['limits'], $where['starts']);
               unset($where['limits']);
               unset($where['starts']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->get($table)->result();
     }

     public function get_single_where($where = null, $table)
     {
          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->get($table)->row();
     }
}
