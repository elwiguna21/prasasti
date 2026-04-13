<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GuideArchieve extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	public function get_all_where($where = null)
	{
		if (!empty($where['search'])) {
			$this->db->group_start();
			$this->db->like('caption', $where['search']);
			$this->db->group_end();
			unset($where['search']);
		}

		if (!empty($where['limits']) or !empty($where['starts'])) {
			$this->db->limit($where['limits'], $where['starts']);
			unset($where['limits']);
			unset($where['starts']);
		}

		if (!empty($where)) {
			$this->db->where($where);
		}

		$this->db->order_by('id', 'desc');
		$results = $this->db->get('guide_arsip')->result();
		if (!empty($results)) {
			foreach ($results as $res) {
				$res->id = $this->encryption->encrypt($res->id);
			}
		}

		return $results;
	}

	public function get_single_where($where = null)
	{
		if (!empty($where)) {
			$this->db->where($where);
		}

		return $this->db->get('guide_arsip')->row();
	}

	public function get_all_where_count($where = null)
	{
		// $this->db->where('deleted_at', null);

		if (!empty($where['search'])) {
			$this->db->group_start();
			$this->db->like('caption', $where['search']);
			$this->db->group_end();
			unset($where['search']);
		}

		unset($where['limits']);
		unset($where['starts']);

		if (!empty($where)) {
			$this->db->where($where);
		}

		return $this->db->count_all_results('guide_arsip');
	}
}
