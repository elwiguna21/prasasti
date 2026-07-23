<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faqs extends MY_Controller
{
     public $user_auth;

     public function __construct()
     {
          parent::__construct();
          $this->load->helper('url', 'xss');
          $this->load->model('M_faq', 'faq');
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
          $data['title']    = 'FAQ';
          $data['employee'] = $this->user_auth;

          $this->backend('v2/backend/data_faq', $data);
     }

     public function ajax_list()
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/backend/dashboards');
          }
          $list  = $this->faq->get_datatables();
          $data  = array();
          $no    = $_POST['start'];
          $nomor = 1;
          foreach ($list as $faq) {
               $no++;
               $row   = array();
               $row[] = $nomor++;
               $row[] = $faq->pertanyaan;
               $row[] = $faq->jawaban;
               $row[] = '<div class="d-flex"><a class="btn btn-primary btn-xs sharp me-1" href="javascript:void(0)" title="Edit" onclick="edit_faq(\'' . $faq->id . '\')"><i class="fas fa-pencil-alt"></i></a><a class="btn btn-danger btn-xs sharp" href="javascript:void(0)" title="Hapus" onclick="delete_faq(\'' . $faq->id . '\')"><i class="fas fa-trash"></i></a></div>';
               $data[] = $row;
          }

          $output = array(
               "draw"            => $_POST['draw'],
               "recordsTotal"    => $this->faq->count_all(),
               "recordsFiltered" => $this->faq->count_filtered(),
               "data"            => $data,
          );
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
               'jawaban'    => htmlentities($this->input->post('jawaban'))
          );
          $this->faq->save($data);
          echo json_encode(array("status" => TRUE));
     }

     public function ajax_update()
     {
          $this->_validate();
          $data = array(
               'pertanyaan' => htmlentities($this->input->post('pertanyaan')),
               'jawaban'    => htmlentities($this->input->post('jawaban'))
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
          $data['inputerror']   = array();
          $data['status']       = TRUE;

          if ($this->input->post('pertanyaan') == '') {
               $data['inputerror'][]   = 'pertanyaan';
               $data['error_string'][] = 'Data pertanyaan harus di isi';
               $data['status']         = FALSE;
          }

          if ($data['status'] === FALSE) {
               echo json_encode($data);
               exit();
          }
     }
}
