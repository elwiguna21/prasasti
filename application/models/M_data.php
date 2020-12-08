<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_data extends CI_Model {
 
    var $table = 'berkas';
    var $column_order = array('tanggal','tahun',null); //set column field database for datatable orderable
    var $column_search = array('indek','tahun','kode_klsf','unit_kerja_pencipta'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('tanggal' => 'DESC'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        $this->db->order_by('tanggal','DESC');
       
    }
 
    function get_datatables()
    {
        $this->db->where('nomor_skpd',$this->session->userdata('nomor_skpd'));
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->db->where('nomor_skpd',$this->session->userdata('nomor_skpd'));
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->where('nomor_skpd',$this->session->userdata('nomor_skpd'));
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    function simpandata($data)
    {
        return $this->db->insert('berkas', $data);
    }

    function getone($table,$where){		
        return $this->db->get_where($table,$where)->result();
    }

    public function update($data, $where)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    function hapus($table,$where){		
        return $this->db->delete($table,$where);
    }

    public function updateakun($data, $where)
    {
        $this->db->update('skpd', $data, $where);
        return $this->db->affected_rows();
    }

}