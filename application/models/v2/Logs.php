<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logs extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	public function insert_entry($data)
	{
		if (empty($data)) {
			return false;
		}

		return $this->db->insert('logs', $data);
	}

	public function get_all_where($where = null)
	{
		$this->db->where('deleted_at', null);

		if (!empty($where['limits']) or !empty($where['starts'])) {
			if (!empty($where['starts'])) {
				$this->db->limit($where['limits'], $where['starts']);
			} else {
				$this->db->limit($where['limits']);
			}
			unset($where['limits']);
			unset($where['starts']);
		}

		if (!empty($where)) {
			$this->db->where($where);
		}

		$this->db->order_by('id', 'desc');
		$results = $this->db->get('logs')->result();
		if (!empty($results)) {
			foreach ($results as $result) {
				$result->id    = $this->encryption->encrypt($result->id);
				$result->user    = $this->encryption->encrypt($result->user);
			}
		}
		return $results;
	}
}