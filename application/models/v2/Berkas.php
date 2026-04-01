<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas extends CI_Model
{
    var $table        = 'berkas';
    var $column_order = array('tanggal', 'nomor_skpd', 'kode_klsf', 'indek', 'uraian_informasi_arsip', 'jumlah', 'unit_kerja_pencipta', 'tahun', null);
    var $column_search = array('tanggal', 'nomor_skpd', 'kode_klsf', 'indek', 'uraian_informasi_arsip', 'unit_kerja_pencipta');
    var $order        = array('id' => 'desc');
    var $jenis_arsip  = null;
    var $filter_skpd  = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function set_jenis_arsip($jenis)
    {
        $this->jenis_arsip = $jenis;
    }

    public function set_filter_skpd($skpd)
    {
        $this->filter_skpd = $skpd;
    }

    private function _get_datatables_query()
    {
        // Select kolom yang membedakan dengan id dari tabel lain
        $this->db->select('berkas.*, company.name as nama_skpd_inputter');
        $this->db->from($this->table);
        $this->db->join('user', 'berkas.verifikasi_user = user.id', 'left');
        $this->db->join('company', 'user.company = company.id', 'left');
        
        $this->db->where('berkas.deleted_at', null);

        if ($this->jenis_arsip !== null) {
            $this->db->where('berkas.jenis_arsip', $this->jenis_arsip);
        }

        if ($this->filter_skpd !== null && $this->filter_skpd !== '') {
            $this->db->where('company.id', $this->filter_skpd);
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if (isset($_POST['search']['value']) && $_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        $this->db->join('user', 'berkas.verifikasi_user = user.id', 'left');
        $this->db->join('company', 'user.company = company.id', 'left');
        
        $this->db->where('berkas.deleted_at', null);
        
        if ($this->jenis_arsip !== null) {
            $this->db->where('berkas.jenis_arsip', $this->jenis_arsip);
        }
        if ($this->filter_skpd !== null && $this->filter_skpd !== '') {
            $this->db->where('company.id', $this->filter_skpd);
        }
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function save($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function update_by_id($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, array('deleted_at' => date('Y-m-d H:i:s')));
    }
}
