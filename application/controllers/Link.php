<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Link extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url','xss');
        $this->load->model('M_link','link');
        if($this->session->userdata('status') != "login" || $this->session->userdata('level') != 'admin' ){
			redirect(base_url("Front"));
        }
    }

    public function ajax_list()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('Front');
        }
        $list = $this->link->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor=1;
        foreach ($list as $link) {
            $no++;
            $row = array();
            $row[] = $nomor++;
            $row[] = $link->judul;
            $row[] = $link->link; 
           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_link('."'".$link->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_link('."'".$link->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->link->count_all(),
                        "recordsFiltered" => $this->link->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->link->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'judul' => htmlentities($this->input->post('judul')),
                'link' => htmlentities($this->input->post('link'))
               
            );
        $insert = $this->link->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
       
            $data = array(
                'judul' => htmlentities($this->input->post('judul')),
                'link' => htmlentities($this->input->post('link'))
                
            );
        
        $this->link->update(array('id' => htmlentities($this->input->post('id'))), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->link->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
 
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('judul') == '')
        {
            $data['inputerror'][] = 'judul';
            $data['error_string'][] = 'Data judul harus di isi';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
}