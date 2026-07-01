<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klasifikasi extends CI_Model
{
     public function get_all()
     {
          $this->db->order_by('kode_gabungan', 'ASC');
          return $this->db->get('klasifikasi')->result();
     }
}
