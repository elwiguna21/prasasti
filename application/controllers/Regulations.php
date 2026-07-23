<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Regulations extends MY_Controller
{
     public $user_auth = null;

     public function __construct()
     {
          parent::__construct();
          $this->load->model('v2/Regulation', 'regulation');
          $this->load->model('v2/Employee', 'employee');
          $this->load->model('M_peraturan', 'peraturan');
          $this->load->model('M_data', 'model');

          if (!empty($this->session->userdata('next-uid')) and !empty($this->session->userdata('next-role'))) {
               $uid = $this->encryption->decrypt($this->session->userdata('next-uid'));
               $uname = $this->session->userdata('next-uname');

               // Coba ambil dari tabel employee (untuk operator/ASN)
               $user = $this->employee->get_single_where(
                    array('user.id' => $uid, 'user.username' => $uname)
               );
               if (!empty($user)) {
                    $this->user_auth = $user;
                    $this->user_auth->avatar = base_url('assets/v3/backend/images/avatar/user-dummy.jpg');
               }
          }
     }

     public function index()
     {
          $data['title'] = 'Daftar Peraturan / Regulasi';

          $this->frontend_new('v2/frontend/regulation', $data);
     }

     public function get_regulations_json()
     {
          if ($this->input->method() != 'post') {
               show_error('Post Request Only!', 405);
               die;
          }

          $columns = array(
               0 => 'id',
               1 => 'caption',
          );

          $limit = $this->input->post('length');
          $start = $this->input->post('start');
          $order = (!empty($this->input->post('order'))) ? $columns[$this->input->post('order')[0]['column']] : "id";
          $dir = (!empty($this->input->post('order'))) ? $this->input->post('order')[0]['dir'] : "asc";
          $search = (!empty($this->input->post('search')['value'])) ? $this->input->post('search')['value'] : null;

          $where = array(
               'starts' => $start,
               'limits' => $limit,
               'orders' => $order,
               'dirs' => $dir,
          );

          $total_rows = $this->regulation->get_all_where_count($where);
          $total_filtered = $total_rows;

          if (!empty($search)) {
               $where['search'] = $search;
               $total_filtered = $this->regulation->get_all_where_count($where);
          }

          $data = array();
          $regulations = $this->regulation->get_all_where($where);
          if (!empty($regulations)) {
               foreach ($regulations as $regulation) {
                    //				if (file_exists('./assets/upload/' . $regulation->file)) {
                    //					$regulation->file = base_url('assets/upload/') . $regulation->file;
                    //				} else {
                    //					$regulation->file = 'javascript:void(0);';
                    //				}

                    $nested['id']       = $regulation->id;
                    $nested['title']    = $regulation->caption;

                    if (file_exists('./assets/upload/' . $regulation->file)) {
                         $nested['document'] = '<div class="text-center"><a class="btn btn-primary btn-sm" href="' . base_url('assets/upload/') . $regulation->file . '" target="_blank"><i class="ti ti-file-download me-2"></i> Download</a></div>';
                    } else {
                         $nested['document'] = '<div class="text-center"><button class="btn btn-outline-danger btn-sm" type="button"><i class="ti ti-file-alert"></i> Download</button></div>';
                    }

                    $data[] = $nested;
               }
          }

          $json_data = array(
               "draw" => intval($this->input->post('draw')),
               "recordsTotal" => intval($total_rows),
               "recordsFiltered" => intval($total_filtered),
               "data" => $data,
          );

          echo json_encode($json_data);
     }

     public function list()
     {
          if (empty($this->user_auth) or $this->user_auth->user_role != 'admin') {
               show_error('Not Authorize!', 403);
               die;
          }

          $data['title']    = 'Peraturan';
          $data['employee'] = $this->user_auth;

          $this->backend('v2/backend/data_peraturan', $data);
     }

     public function ajax_list()
     {
          if (empty($this->user_auth) or $this->user_auth->user_role != 'admin') {
               echo json_encode(array('status' => 403, 'message' => 'Not Authorize!'));
               die;
          }

          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }
          $list  = $this->peraturan->get_datatables();
          $data  = array();
          $no    = $_POST['start'];
          $nomor = 1;
          foreach ($list as $peraturan) {
               $no++;
               $row   = array();
               $row[] = $nomor++;
               $row[] = $peraturan->caption;
               $row[] = '<div class="d-flex"><a class="btn btn-primary btn-xs sharp me-1" href="javascript:void(0)" title="Edit" onclick="edit_peraturan(\'' . $peraturan->id . '\')"><i class="fas fa-pencil-alt"></i></a><a class="btn btn-danger btn-xs sharp" href="javascript:void(0)" title="Hapus" onclick="delete_peraturan(\'' . $peraturan->id . '\')"><i class="fas fa-trash"></i></a></div>';
               $data[] = $row;
          }

          $output = array(
               "draw"            => $_POST['draw'],
               "recordsTotal"    => $this->peraturan->count_all(),
               "recordsFiltered" => $this->peraturan->count_filtered(),
               "data"            => $data,
          );
          echo json_encode($output);
     }

     public function ajax_edit($id)
     {
          if (empty($this->user_auth) or $this->user_auth->user_role != 'admin') {
               echo json_encode(array('status' => 403, 'message' => 'Not Authorize!'));
               die;
          }

          $data = $this->peraturan->get_by_id($id);
          echo json_encode($data);
     }

     public function ajax_add()
     {
          if (empty($this->user_auth) or $this->user_auth->user_role != 'admin') {
               echo json_encode(array('status' => 403, 'message' => 'Not Authorize!'));
               die;
          }

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
                    $this->peraturan->save($data);
                    echo json_encode(array("status" => TRUE));
               }
          }
     }

     public function ajax_update()
     {
          if (empty($this->user_auth) or $this->user_auth->user_role != 'admin') {
               echo json_encode(array('status' => 403, 'message' => 'Not Authorize!'));
               die;
          }

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
                    $this->peraturan->update($where, $data);
               }
          } else {
               $data['file'] = $fileold;
               $this->peraturan->update($where, $data);
          }
          echo json_encode(array("status" => TRUE));
     }

     public function ajax_delete($id)
     {
          if (empty($this->user_auth) or $this->user_auth->user_role != 'admin') {
               echo json_encode(array('status' => 403, 'message' => 'Not Authorize!'));
               die;
          }

          $table = 'peraturan';
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
