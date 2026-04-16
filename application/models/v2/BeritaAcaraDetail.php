<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BeritaAcaraDetail extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function get_all_where($where = null)
	{
		$this->db->where('berita_acara_detail.deleted_at', null);

		if (!empty($where['search'])) {
			$this->db->group_start();
			$this->db->like('berkas.uraian_informasi_arsip', $where['search']);
			$this->db->or_like('berkas.kode_klsf', $where['search']);
			$this->db->or_like('berkas.unit_kerja_pencipta', $where['search']);
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
			$this->db->order_by('berita_acara_detail.id', 'desc');
		}

		if (!empty($where)) {
			$this->db->where($where);
		}

		$this->db->select('
		berita_acara_detail.id, 
		berita_acara.id as berita_acara_id, berita_acara.name as berita_acara_name, 
		berkas.id as berkas_id, berkas.uraian_informasi_arsip as berkas_uraian_informasi_arsip,
		berkas.unit_kerja_pencipta as berkas_unit_kerja_pencipta, berkas.kode_klsf as berkas_kode_klsf
		');
		$this->db->join('berita_acara', 'berita_acara.id = berita_acara_detail.berita_acara', 'left');
		$this->db->join('berkas', 'berkas.id = berita_acara_detail.berkas', 'left');
		return $this->db->get('berita_acara_detail')->result();

	}

	public function get_all_where_count($where = null)
	{
		$this->db->where('berita_acara_detail.deleted_at', null);

		if (!empty($where['search'])) {
			$this->db->group_start();
			$this->db->like('berkas.uraian_informasi_arsip', $where['search']);
			$this->db->or_like('berkas.kode_klsf', $where['search']);
			$this->db->or_like('berkas.unit_kerja_pencipta', $where['search']);
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

		$this->db->select(' 
		berita_acara_detail.id,
		berita_acara.name as berita_acara_name, 
		berkas.id as berkas_id, berkas.uraian_informasi_arsip as berkas_uraian_informasi_arsip,
		berkas.unit_kerja_pencipta as berkas_unit_kerja_pencipta, berkas.kode_klsf as berkas_kode_klsf
		');
		$this->db->join('berita_acara', 'berita_acara.id = berita_acara_detail.berita_acara', 'left');
		$this->db->join('berkas', 'berkas.id = berita_acara_detail.berkas', 'left');
		return $this->db->count_all_results('berita_acara_detail');
	}

	public function get_single_where($where = null)
	{
		$this->db->where('berita_acara_detail.deleted_at', null);

		if (!empty($where['search'])) {
			$this->db->group_start();
			$this->db->like('berkas.uraian_informasi_arsip', $where['search']);
			$this->db->or_like('berkas.kode_klsf', $where['search']);
			$this->db->or_like('berkas.unit_kerja_pencipta', $where['search']);
			$this->db->group_end();
			unset($where['search']);
		}

		if (!empty($where)) {
			$this->db->where($where);
		}

		return $this->db->get('berita_acara_detail')->row();
	}

	public function insert_entry($data)
	{
		if (empty($data)) {
			return false;
		}

		return $this->db->insert('berita_acara_detail', $data);
	}

	public function insert_batch_entry($data)
	{
		if (empty($data)) {
			return false;
		}

		$this->db->trans_start();
		$this->db->insert_batch('berita_acara_detail', $data);
		$this->db->trans_complete();

		return true;
	}

	public function update_entry($data, $where)
	{
		if (empty($where)) {
			return false;
		}

		$data['updated_at'] = date('Y-m-d H:i:s');
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update('berita_acara_detail');
		return $this->db->affected_rows();
	}

	public function delete_entry($where)
	{
		if (empty($where)) {
			return false;
		}

		$data['deleted_at']      = date('Y-m-d H:i:s');
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update('berita_acara_detail');
		return $this->db->affected_rows();
	}
}