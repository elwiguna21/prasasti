<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }

     public function get_all_where($where = null)
     {
          $this->db->where('monitoring.deleted_at is null');

          if (!empty($where)) {
               $this->db->where($where);
          }

          $this->db->select('monitoring.*, employee.fullname as employee_fullname');
          $this->db->join('employee', 'employee.user = monitoring.user', 'left');
          $this->db->order_by('monitoring.id', 'desc');
          $results  = $this->db->get('monitoring')->result();
          if (!empty($results)) {
               foreach ($results as $result) {
                    $result->id    = $this->encryption->encrypt($result->id);
                    unset($result->user);
               }
          }
          return $results;
     }
     public function insert_entry($data)
     {
          return $this->db->insert('monitoring', $data);
     }
}
