<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BeritaAcara extends CI_Model
{
    var $table        = 'berita_acara';
    var $column_order = array('name', 'document', 'created_at', null);
    var $column_search = array('name', 'document');
    var $order        = array('id' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Jakarta');
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $this->db->where('deleted_at', null);
        
        // Kita spesifikkan kondisi jika diperlukan nanti (misal membedakan BAST usul serah dengan yg lain)
        // Namun saat ini tidak ada kolom khusus, kita bisa asumsikan semua di tabel ini.

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
        $this->db->where('deleted_at', null);
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

    // --- FUNGSI UNTUK RELASI KE BERKAS (berita_acara_detail) ---

    /**
     * Mengambil daftar berkas yang sudah terhubung dengan suatu Berita Acara
     */
    public function get_linked_berkas($berita_acara_id)
    {
        $this->db->select('berkas.*, berita_acara_detail.id as detail_id');
        $this->db->from('berkas');
        $this->db->join('berita_acara_detail', 'berita_acara_detail.berkas = berkas.id');
        $this->db->where('berita_acara_detail.berita_acara', $berita_acara_id);
        $this->db->where('berita_acara_detail.deleted_at', null);
        $this->db->order_by('berkas.created_at', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Menambahkan relasi dokumen ke BAST (berita_acara_detail)
     */
    public function save_detail($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('berita_acara_detail', $data);
        return $this->db->insert_id();
    }

    /**
     * Menghapus secara permanen dari detail (atau soft delete)
     */
    public function delete_detail($berita_acara_id, $berkas_id)
    {
        $this->db->where('berita_acara', $berita_acara_id);
        $this->db->where('berkas', $berkas_id);
        // Bisa hard delete karena ini hanya tabel relasi
        $this->db->delete('berita_acara_detail');
    }
}
