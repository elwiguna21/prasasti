<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Akun extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url','xss');
        $this->load->model('M_akun','akun');
        if($this->session->userdata('status') != "login" || $this->session->userdata('level') != 'admin' ){
			redirect(base_url("Front"));
        }
    }

 
    public function ajax_list()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('Web');
        }
        $list = $this->akun->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor=1;
        foreach ($list as $akun) {
            $no++;
            $row = array();
            $row[] = $nomor++;
            $row[] = $akun->nomor_skpd;
            $row[] = $akun->nama_skpd;
            $row[] = $akun->alamat_skpd;
            $row[] = $akun->nama_operator;
            $row[] = $akun->kontak_operator;
            $row[] = $akun->username;
           
           
            //add html for action
            $row[] = '<a  href="javascript:void(0)" title="Edit" onclick="edit_akun('."'".$akun->id_skpd."'".')"><span class="badge badge-info">
            Edit</span></a>
                  <a href="javascript:void(0)" title="Hapus" onclick="delete_akun('."'".$akun->id_skpd."'".')"><span class="badge badge-danger">
                  Hapus</span></a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->akun->count_all(),
                        "recordsFiltered" => $this->akun->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->akun->get_by_id($id);
       // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'nomor_skpd' => htmlentities($this->input->post('nomor_skpd')),
                'nama_skpd' => htmlentities($this->input->post('nama_skpd')),
                'alamat_skpd' => htmlentities($this->input->post('alamat_skpd')),
                'nama_operator' => htmlentities($this->input->post('nama_operator')),
                'kontak_operator' => htmlentities($this->input->post('kontak_operator')),
                'username' => htmlentities($this->input->post('username')),
                'password' => md5(htmlentities($this->input->post('password')))

            );
           
        $insert = $this->akun->save($data);
        echo json_encode(array("status" => TRUE));
        }
 
    public function ajax_update()
    {
        $this->_validate();
        $id = array('id_skpd' => htmlentities($this->input->post('id_skpd')));
        if($this->input->post('password') != null){
        $data = array(
                'nomor_skpd' => htmlentities($this->input->post('nomor_skpd')),
                'nama_skpd' => htmlentities($this->input->post('nama_skpd')),
                'alamat_skpd' => htmlentities($this->input->post('alamat_skpd')),
                'nama_operator' => htmlentities($this->input->post('nama_operator')),
                'kontak_operator' => htmlentities($this->input->post('kontak_operator')),
                'username' => htmlentities($this->input->post('username')),
                'password' => md5(htmlentities($this->input->post('password')))
            );
        }else {
            $data = array(
                'nomor_skpd' => htmlentities($this->input->post('nomor_skpd')),
                'nama_skpd' => htmlentities($this->input->post('nama_skpd')),
                'alamat_skpd' => htmlentities($this->input->post('alamat_skpd')),
                'nama_operator' => htmlentities($this->input->post('nama_operator')),
                'kontak_operator' => htmlentities($this->input->post('kontak_operator')),
                'username' => htmlentities($this->input->post('username')),
            );
        }
        $this->akun->update($id, $data);
        echo json_encode(array("status" => TRUE));
       
    }
 
    public function ajax_delete($id)
    {
        $this->akun->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
 
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('username') == '')
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Data username harus di isi';
            $data['status'] = FALSE;
        }
 
      
 
       
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
}