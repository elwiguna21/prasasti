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
          $this->db->where('deleted_at is null');

          if (!empty($where)) {
               $this->db->where($where);
          }

          // return $this->db->get('employee')->row();
          $result   = $this->db->get('employee')->row();
          if (!empty($result)) {
               $result->company    = $this->db->get_where('company', array('id' => $result->company))->row();
          }
          return $result;
     }
}
