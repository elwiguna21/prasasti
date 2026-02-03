<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Artikel extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url','xss','slug');
        $this->load->model('M_artikel','artikel');
        $this->load->model('M_data','model');
        if($this->session->userdata('status') != "login" || $this->session->userdata('level') != 'admin' ){
			redirect(base_url("Front"));
        }
    }

    public function ajax_list()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('Front');
        }
        $list = $this->artikel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor=1;
        foreach ($list as $artikel) {
            $isi = substr($artikel->isi,0,100);
            $no++;
            $row = array();
            $row[] = $nomor++;
            $row[] = $artikel->judul;
            $row[] = $artikel->tanggal; 
            $row[] = $isi; 
           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_artikel('."'".$artikel->idartikel."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_artikel('."'".$artikel->idartikel."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->artikel->count_all(),
                        "recordsFiltered" => $this->artikel->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->artikel->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                
                'judul' => htmlentities($this->input->post('judul')),
                'slug' => slug(htmlentities($this->input->post('judul'))),
                'tanggal' => DATE('d-m-Y'),
                'isi' => htmlentities($this->input->post('isi'))
               
            );
            $config['upload_path'] = './assets/upload/'; //path folder
            $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
     
            $this->upload->initialize($config);
            if(!empty($_FILES['file']['name']))
            {
                if ($this->upload->do_upload('file'))
                {
                  
                $gbr = $this->upload->data();
                $data['gambar']=$gbr['file_name'];
                
                     $insert = $this->artikel->save($data);
                     echo json_encode(array("status" => TRUE));
                }
    
            
            }
            
    }   
 
    public function ajax_update()
    {
        $this->_validate();
       
        $data = array(
                'judul' => htmlentities($this->input->post('judul')),
                'slug' => slug(htmlentities($this->input->post('judul'))),
                'isi' => htmlentities($this->input->post('isi'))
        
        );

        $where = array(
            'idartikel' => htmlentities($this->input->post('idartikel'))
        );
        $fileold= htmlentities($this->input->post('fileold'));

        $config['upload_path'] = './assets/upload/'; //path folder
        $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nant
 
        $this->upload->initialize($config);
        if(!empty($_FILES['file']['name']))
        {
            if ($this->upload->do_upload('file'))
            {
            unlink("./assets/upload/".$fileold);
            $gbr = $this->upload->data();
            $data['gambar']=$gbr['file_name'];
            
            $insert = $this->artikel->update($where,$data);
                
            }

        }
        else
        {
            $data['gambar']=$fileold;
            $insert = $this->artikel->update($where,$data);
            
        }
        echo json_encode(array("status" => TRUE));
  
        
    }
 
    public function ajax_delete($id)
    {
        $table = 'artikel' ;
        $where = array(
            'idartikel' => $id
        );
        $query = $this->model->getone($table,$where);
        foreach($query as $x){
            $file = $x->gambar;
        }
        unlink("./assets/upload/".$file);
        $hapus = $this->model->hapus($table,$where);

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