<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Profil extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url','xss','slug');
        $this->load->model('M_profil','profil');
        $this->load->model('M_data','model');
        if($this->session->userdata('status') != "login" || $this->session->userdata('level') != 'admin' ){
			redirect(base_url("Front"));
        }
    }

 
    public function ajax_edit($id)
    {
        $data = $this->profil->get_by_id($id);
        echo json_encode($data);
    }
 
 
    public function ajax_update()
    {
        $this->_validate();
       
        $data = array(
                'alamat' => htmlentities($this->input->post('alamat')),
                'telepon' => htmlentities($this->input->post('telepon')),
                'visi' => htmlentities($this->input->post('visi')),
                'misi' => htmlentities($this->input->post('misi')),
                'sambutan' => htmlentities($this->input->post('sambutan')),
                'gambaran_umum' => htmlentities($this->input->post('gambaran_umum')),
                'tugas_fungsi' => htmlentities($this->input->post('tugas_fungsi')),
                'sejarah' => htmlentities($this->input->post('sejarah')),
                'struktur_organisasi' => htmlentities($this->input->post('struktur_organisasi')),
               
        
        );

        $where = array(
            'id' => htmlentities($this->input->post('id'))
        );
        $insert = $this->profil->update($where,$data);
        echo json_encode(array("status" => TRUE));
  
        
    }
 
 
 
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('alamat') == '')
        {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Data alamat harus di isi';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
}