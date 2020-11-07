<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Faq extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url','xss');
        $this->load->model('M_faq','faq');
        if($this->session->userdata('status') != "login" || $this->session->userdata('level') != 'admin' ){
			redirect(base_url("Front"));
        }
    }

    public function ajax_list()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('Front');
        }
        $list = $this->faq->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor=1;
        foreach ($list as $faq) {
            $no++;
            $row = array();
            $row[] = $nomor++;
            $row[] = $faq->pertanyaan;
            $row[] = $faq->jawaban; 
           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_faq('."'".$faq->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_faq('."'".$faq->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->faq->count_all(),
                        "recordsFiltered" => $this->faq->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->faq->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'pertanyaan' => htmlentities($this->input->post('pertanyaan')),
                'jawaban' => htmlentities($this->input->post('jawaban'))
               
            );
        $insert = $this->faq->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
       
            $data = array(
                'pertanyaan' => htmlentities($this->input->post('pertanyaan')),
                'jawaban' => htmlentities($this->input->post('jawaban'))
                
            );
        
        $this->faq->update(array('id' => htmlentities($this->input->post('id'))), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->faq->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
 
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('pertanyaan') == '')
        {
            $data['inputerror'][] = 'pertanyaan';
            $data['error_string'][] = 'Data pertanyaan harus di isi';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
}