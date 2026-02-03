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
          $this->db->where('deleted_at is null');

          if (!empty($where)) {
               $this->db->where($where);
          }

          $result   = $this->db->get('user')->row();
          if (!empty($result)) {
               $result->id         = $this->encryption->encrypt($result->id);
               $result->password   = "SECRET";
               if ($result->role != 'admin') {
                    $result->company    = $this->db->get_where('company', array('id' => $result->company, 'deleted_at' => null));
               }
          }

          return $result;
     }
}
