<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Visitor_model extends CI_Model
{
    private $table = 'visitor_logs';

    public function log_visitor()
    {
        // Don't log if running from CLI
        if (is_cli()) {
            return;
        }

        $this->load->library('user_agent');

        $ip_address = $this->input->ip_address();
        $user_agent = $this->agent->agent_string();
        $page_url = current_url();
        $visit_date = date('Y-m-d');

        // Cek apakah IP ini sudah tercatat hari ini
        $this->db->where('ip_address', $ip_address);
        $this->db->where('visit_date', $visit_date);
        $query = $this->db->get($this->table);

        if ($query->num_rows() == 0) {
            $data = array(
                'ip_address' => $ip_address,
                'user_agent' => $user_agent,
                'page_url' => $page_url,
                'visit_date' => $visit_date,
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert($this->table, $data);
        }
    }

    public function get_total_visitors()
    {
        return $this->db->count_all($this->table);
    }

    public function get_today_visitors()
    {
        $this->db->where('visit_date', date('Y-m-d'));
        return $this->db->count_all_results($this->table);
    }

    public function get_this_month_visitors()
    {
        $this->db->like('visit_date', date('Y-m'));
        return $this->db->count_all_results($this->table);
    }

    public function get_chart_data($days = 7)
    {
        // Mendapatkan data X hari terakhir
        $this->db->select('visit_date as date, COUNT(id) as count');
        $this->db->from($this->table);
        $this->db->where('visit_date >=', date('Y-m-d', strtotime("-$days days")));
        $this->db->group_by('visit_date');
        $this->db->order_by('visit_date', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
