<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MateriPaparans extends MY_Controller
{
     public $user_auth;

     public function __construct()
     {
          parent::__construct();
          $this->load->helper('url', 'xss', 'slug');
          $this->load->model('M_materi_paparan', 'materi_paparan');
          $this->load->model('M_data', 'model');
          $this->load->model('v2/Employee', 'employee');

          if (empty($this->session->userdata('next-uid')) && empty($this->session->userdata('next-role'))) {
               show_error('Not Authorize! Please signin again.', 403);
               die;
          } else {
               $user = $this->employee->get_single_where(
                    array(
                         'user.id'       => $this->encryption->decrypt($this->session->userdata('next-uid')),
                         'user.username' => $this->session->userdata('next-uname')
                    )
               );

               if (empty($user)) {
                    redirect('v2/authentications/signout');
               }

               $this->user_auth = $user;
               $this->user_auth->avatar = base_url('assets/v3/backend/images/avatar/user-dummy.jpg');
          }
     }

     public function index()
     {
          $data['title']    = 'Materi/Paparan';
          $data['employee'] = $this->user_auth;

          $this->backend('v2/backend/data_materi_paparan', $data);
     }

     public function ajax_list()
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }
          $list  = $this->materi_paparan->get_datatables();
          $data  = array();
          $no    = $_POST['start'];
          $nomor = 1;
          foreach ($list as $item) {
               $no++;
               $row   = array();
               $row[] = $nomor++;
               $row[] = $item->caption;
               $row[] = '<div class="d-flex"><a class="btn btn-primary btn-xs sharp me-1" href="javascript:void(0)" title="Edit" onclick="edit_data(\'' . $item->id . '\')"><i class="fas fa-pencil-alt"></i></a><a class="btn btn-danger btn-xs sharp" href="javascript:void(0)" title="Hapus" onclick="delete_data(\'' . $item->id . '\')"><i class="fas fa-trash"></i></a></div>';
               $data[] = $row;
          }

          $output = array(
               "draw"            => $_POST['draw'],
               "recordsTotal"    => $this->materi_paparan->count_all(),
               "recordsFiltered" => $this->materi_paparan->count_filtered(),
               "data"            => $data,
          );
          echo json_encode($output);
     }

     public function ajax_edit($id)
     {
          $data = $this->materi_paparan->get_by_id($id);
          echo json_encode($data);
     }

     public function ajax_add()
     {
          $this->_validate();
          $data = array(
               'caption' => htmlentities($this->input->post('judul')),
          );

          $config['upload_path']   = './assets/upload/';
          $config['allowed_types'] = 'pdf';
          $config['encrypt_name']  = TRUE;

          $this->upload->initialize($config);
          if (!empty($_FILES['file']['name'])) {
               if ($this->upload->do_upload('file')) {
                    $gbr = $this->upload->data();
                    $data['file'] = $gbr['file_name'];
                    $this->materi_paparan->save($data);
                    echo json_encode(array("status" => TRUE));
               }
          }
     }

     public function ajax_update()
     {
          $this->_validate();
          $data = array(
               'caption' => htmlentities($this->input->post('judul')),
          );

          $where = array(
               'id' => htmlentities($this->input->post('id'))
          );
          $fileold = htmlentities($this->input->post('fileold'));

          $config['upload_path']   = './assets/upload/';
          $config['allowed_types'] = 'pdf';
          $config['encrypt_name']  = TRUE;

          $this->upload->initialize($config);
          if (!empty($_FILES['file']['name'])) {
               if ($this->upload->do_upload('file')) {
                    @unlink("./assets/upload/" . $fileold);
                    $gbr = $this->upload->data();
                    $data['file'] = $gbr['file_name'];
                    $this->materi_paparan->update($where, $data);
               }
          } else {
               $data['file'] = $fileold;
               $this->materi_paparan->update($where, $data);
          }
          echo json_encode(array("status" => TRUE));
     }

     public function ajax_delete($id)
     {
          $table = 'materi_paparan';
          $where = array('id' => $id);
          $query = $this->model->getone($table, $where);
          foreach ($query as $x) {
               $file = $x->file;
          }
          @unlink("./assets/upload/" . $file);
          $this->model->hapus($table, $where);
          echo json_encode(array("status" => TRUE));
     }

     private function _validate()
     {
          $data = array();
          $data['error_string'] = array();
          $data['inputerror']   = array();
          $data['status']       = TRUE;

          if ($this->input->post('judul') == '') {
               $data['inputerror'][]   = 'judul';
               $data['error_string'][] = 'Data judul harus di isi';
               $data['status']         = FALSE;
          }

          if ($data['status'] === FALSE) {
               echo json_encode($data);
               exit();
          }
     }
}
