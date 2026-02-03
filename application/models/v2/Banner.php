<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Banner extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }

     public function get_all_where($where = null)
     {
          if (!empty($where)) {
               $this->db->where($where);
          }

          $results  = $this->db->get('banner')->result();
          if (!empty($results)) {
               foreach ($results as $res) {
                    $res->file     = 'https://sisemar.sumedangkab.go.id/assets/upload/' . $res->file;
               }
          }

          return $results;
     }
}
