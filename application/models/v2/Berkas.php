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
    var $search_keyword = null;
    var $filter_status = null;
    var $filter_tahun = null;

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

    public function set_search($keyword)
    {
        $this->search_keyword = $keyword;
    }

    public function set_filter_status($status)
    {
        $this->filter_status = $status;
    }

    public function set_filter_tahun($tahun)
    {
        $this->filter_tahun = $tahun;
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
            $this->db->where('berkas.nomor_skpd', $this->filter_skpd);
        }

        if ($this->filter_tahun !== null && $this->filter_tahun !== '') {
            $this->db->where('berkas.tahun', $this->filter_tahun);
        }

        if ($this->filter_status !== null && $this->filter_status !== '') {
            if ($this->filter_status == 'verify_waiting') {
                $this->db->where("berkas.penilaian_arsip_statis = 'Y' AND (berkas.verifikasi_status IS NULL OR berkas.verifikasi_status != 'Y' AND berkas.verifikasi_status != 'N')");
            } else if ($this->filter_status == 'verify_done') {
                $this->db->where("berkas.verifikasi_status", 'Y');
            } else if ($this->filter_status == 'verify_reject') {
                $this->db->where("berkas.verifikasi_status", 'N');
                $this->db->where("berkas.verifikasi_user IS NOT NULL");
            } else if ($this->filter_status == 'tte_waiting') {
                $this->db->where("berkas.verifikasi_status", 'Y');
                $this->db->where("(berkas.tte_status IS NULL OR berkas.tte_status != 'Y' AND berkas.tte_status != 'N')");
            } else if ($this->filter_status == 'tte_done') {
                $this->db->where("berkas.tte_status", 'Y');
            } else if ($this->filter_status == 'tte_reject') {
                $this->db->where("berkas.tte_status", 'N');
            } else if ($this->filter_status == 'penilaian_waiting') {
                $this->db->where("(berkas.penilaian_arsip_statis IS NULL OR berkas.penilaian_arsip_statis != 'Y' AND berkas.penilaian_arsip_statis != 'N')");
            } else if ($this->filter_status == 'penilaian_reject') {
                $this->db->where("berkas.penilaian_arsip_statis", 'N');
            }
        }

        $i = 0;
        $search_value = !empty($this->search_keyword) ? $this->search_keyword
            : (isset($_POST['search']['value']) ? $_POST['search']['value'] : '');
        foreach ($this->column_search as $item) {
            if ($search_value) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $search_value);
                } else {
                    $this->db->or_like($item, $search_value);
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
            $this->db->where('berkas.nomor_skpd', $this->filter_skpd);
        }
        if ($this->filter_tahun !== null && $this->filter_tahun !== '') {
            $this->db->where('berkas.tahun', $this->filter_tahun);
        }
        if ($this->filter_status !== null && $this->filter_status !== '') {
            if ($this->filter_status == 'verify_waiting') {
                $this->db->where("berkas.penilaian_arsip_statis = 'Y' AND (berkas.verifikasi_status IS NULL OR berkas.verifikasi_status != 'Y' AND berkas.verifikasi_status != 'N')");
            } else if ($this->filter_status == 'verify_done') {
                $this->db->where("berkas.verifikasi_status", 'Y');
            } else if ($this->filter_status == 'verify_reject') {
                $this->db->where("berkas.verifikasi_status", 'N');
                $this->db->where("berkas.verifikasi_user IS NOT NULL");
            } else if ($this->filter_status == 'tte_waiting') {
                $this->db->where("berkas.verifikasi_status", 'Y');
                $this->db->where("(berkas.tte_status IS NULL OR berkas.tte_status != 'Y' AND berkas.tte_status != 'N')");
            } else if ($this->filter_status == 'tte_done') {
                $this->db->where("berkas.tte_status", 'Y');
            } else if ($this->filter_status == 'tte_reject') {
                $this->db->where("berkas.tte_status", 'N');
            } else if ($this->filter_status == 'penilaian_waiting') {
                $this->db->where("(berkas.penilaian_arsip_statis IS NULL OR berkas.penilaian_arsip_statis != 'Y' AND berkas.penilaian_arsip_statis != 'N')");
            } else if ($this->filter_status == 'penilaian_reject') {
                $this->db->where("berkas.penilaian_arsip_statis", 'N');
            }
        }
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->select('berkas.*, 
                           pembuat.fullname as operator_name, 
                           penilai.fullname as penilai_name, 
                           verifikator.fullname as verifikator_name, 
                           signer.fullname as signer_name');
        $this->db->from($this->table);
        $this->db->join('employee as pembuat', 'pembuat.user = berkas.user', 'left');
        $this->db->join('employee as penilai', 'penilai.user = berkas.penilaian_user', 'left');
        $this->db->join('employee as verifikator', 'verifikator.user = berkas.verifikasi_user', 'left');
        $this->db->join('employee as signer', 'signer.user = berkas.tte_user', 'left');
        $this->db->where('berkas.id', $id);
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
