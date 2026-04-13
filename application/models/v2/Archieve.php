<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Archieve extends CI_Model
{
     public function __construct()
     {
          parent::__construct();
          date_default_timezone_set("Asia/Jakarta");
     }

     public function get_all_where($where = null)
     {
          $this->db->where('berkas.deleted_at', null);

          if (!empty($where['search'])) {
			$this->db->group_start();
               $this->db->like('berkas.indek', $where['search']);
               $this->db->or_like('berkas.deskripsi', $where['search']);
               $this->db->or_like('berkas.kode_klsf', $where['search']);
			$this->db->group_end();
               unset($where['search']);
          }

          if (!empty($where['limits']) or !empty($where['starts'])) {
               $this->db->limit($where['limits'], $where['starts']);
               unset($where['limits']);
               unset($where['starts']);
          }

          if (!empty($where['dirs']) or !empty($where['orders'])) {
               $this->db->order_by($where['orders'], $where['dirs']);
               unset($where['orders']);
               unset($where['dirs']);
          } else {
               $this->db->order_by('berkas.id', 'desc');
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          $this->db->select('berkas.*, company.name');
          $this->db->join('company', 'company.no_company = berkas.nomor_skpd', 'left');
          return $this->db->get('berkas')->result();
     }

     public function get_single_where($where = null)
     {
          $this->db->where('berkas.deleted_at', null);

          if (!empty($where)) {
               $this->db->where($where);
          }

          $this->db->select('berkas.*, company.name');
          $this->db->join('company', 'company.no_company = berkas.nomor_skpd', 'left');
          // $this->db->join('employee', 'employee.user = berkas.tte_user', 'left');
          // return $this->db->get('berkas')->row();
          $result = $this->db->get('berkas')->row();
          if (!empty($result)) {
               $result->creator              = $this->db->get_where('employee', array('user' => $result->user))->row();
               if (!empty($result->creator)) {
                    unset($result->creator->id);
                    unset($result->creator->user);
               }
               if (in_array($result->verifikasi_status, ['Y', 'R'])) {
                    $result->verificator     = $this->db->get_where('employee', array('user' => $result->verifikasi_user))->row();
                    unset($result->verificator->id);
                    unset($result->verificator->user);
               } else {
                    $result->verificator     = null;
               }

               if (in_array($result->tte_status, ['Y', 'R'])) {
                    $result->signer          = $this->db->get_where('employee', array('user' => $result->tte_user))->row();
                    unset($result->signer->id);
                    unset($result->signer->user);
               } else {
                    $result->signer          = null;
               }
          }

          return $result;
     }

     public function get_all_where_count($where = null)
     {
          $this->db->where('deleted_at', null);

          if (!empty($where['search'])) {
	          $this->db->group_start();
               $this->db->like('indek', $where['search']);
               $this->db->or_like('kode_klsf', $where['search']);
               $this->db->or_like('deskripsi', $where['search']);
	          $this->db->group_end();
               unset($where['search']);
          }

          unset($where['limits']);
          unset($where['starts']);
          unset($where['orders']);
          unset($where['dirs']);

          if (!empty($where)) {
               $this->db->where($where);
          }

          return $this->db->count_all_results('berkas');
     }

     public function get_all_where_skpd_group($where = null)
     {
          $this->db->where('berkas.deleted_at', null);
          $this->db->where('berkas.nomor_skpd !=', null);

          if (!empty($where['search'])) {
	          $this->db->group_start();
               $this->db->like('berkas.indek', $where['search']);
               $this->db->or_like('berkas.deskripsi', $where['search']);
               // $this->db->or_like('deskripsi', $where['search']);
	          $this->db->group_end();
               unset($where['search']);
          }

          if (!empty($where['groupBy'])) {
               $this->db->group_by($where['groupBy']);
               unset($where['groupBy']);
          }

          if (!empty($where['orderBy'])) {
               $this->db->order_by($where['orderBy'], $where['orderDir']);
               unset($where['orderBy']);
               unset($where['orderDir']);
          }

          if (!empty($where)) {
               $this->db->where($where);
          }

          // $this->db->select('COUNT(id) as total, nomor_skpd');
          $this->db->select('
            COUNT(berkas.id) as total,
            company.name as name,
            company.no_company
        ');
          $this->db->from('berkas');
          $this->db->join('company', 'berkas.nomor_skpd = company.no_company', 'left');
          $results  = $this->db->get()->result();

          // Inisialisasi array kosong
          $label_skpd = [];
          $jumlah_berkas = [];

          if (!empty($results)) {
               foreach ($results as $res) {
                    if ($res->name != null) {
                         $label_skpd[] = $res->name;      // Array berisi string nama
                         $jumlah_berkas[] = (int)$res->total; // Array berisi integer jumlah
                    }
               }
          }

          // Gabungkan dalam satu variable untuk dikirim ke view atau JSON
          $data['labels'] = $label_skpd;
          $data['datasets'] = $jumlah_berkas;

          return $data;
     }

     public function insert_entry($data)
     {
          $this->db->insert('berkas', $data);
          return $this->db->insert_id();
     }

     public function update_entry($data, $where)
     {
          if (empty($data) or empty($where)) {
               return false;
          }

          $data['updated_at']      = date('Y-m-d H:i:s');
          $this->db->set($data);
          $this->db->where($where);
          $this->db->update('berkas');
          return $this->db->affected_rows();
     }

     public function delete_entry($where)
     {
          if (empty($where)) {
               return false;
          }

          $data['updated_at']      = date('Y-m-d H:i:s');
          $data['deleted_at']      = date('Y-m-d H:i:s');
          $this->db->where($where);
          $this->db->update('berkas', $data);
          return $this->db->affected_rows();
     }
}
