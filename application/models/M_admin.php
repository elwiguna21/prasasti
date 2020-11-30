<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_admin extends CI_Model {
 
    var $table = 'berkas';
    var $column_order = array('tanggal','tahun',null); //set column field database for datatable orderable
    var $column_search = array('indek','tahun','kode_klsf','nama_skpd','unit_kerja_pencipta'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('tanggal' => 'DESC'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
       
        // $this->db->join('skpd','berkas.nomor_skpd = skpd.nomor_skpd','inner');
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
        
       
    }
 
    function get_datatables()
    {
        $this->db->order_by('tanggal','DESC');
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
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

    function getone2($table,$where){		
        return $this->db->get_where($table,$where)->row();
    }

    function getdata($table){		
        return $this->db->get($table)->result();
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

    function getverifikasi()
    {		 
        $this->db->select('COUNT(id) as total');
        $this->db->where('ruang_penyimpanan !=',null);
        return $this->db->get('berkas');
    }

    function getperskpd()
    {		 
        $query="SELECT skpd.nama_skpd as skpd, count(berkas.id) as jml from berkas inner join skpd on berkas.nomor_skpd=skpd.nomor_skpd group by berkas.nomor_skpd";
        return  $this->db->query($query)->result();
    }


    function simpandata2($data)
    {
        return $this->db->insert_batch('berkas', $data);
    } 
    public function upload_file($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './assets/upload';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '10048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}

}