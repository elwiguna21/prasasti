<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profiles extends MY_Controller
{
     public function __construct()
     {
          parent::__construct();
          // $this->load->model('v2/Banner', 'banner');
          // $this->load->model('v2/Newslatter', 'news');
          $this->load->model('M_profil', 'profil');
          $this->load->model('v2/Profile', 'profile');
          $this->load->model('v2/Employee', 'employee');

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
          $data['title'] = 'Sambutan';
          $this->frontend('v2/frontend/profiles/index', $data);
     }

     public function vision()
     {
          $data['title'] = 'Visi & Misi';

          $data['profile'] = $this->profile->get_single_where(null, 'profil');
          // echo json_encode($data);
          // die;
          // $this->frontend('v2/frontend/profiles/vision', $data);
          $this->frontend_new('v2/frontend/profiles/vision', $data);
     }

     public function about()
     {
          $data['title'] = 'Gambaran Umum';

          $data['profile'] = $this->profile->get_single_where(null, 'profil');
          // echo json_encode($data);
          // die;
          $this->frontend_new('v2/frontend/profiles/about', $data);
     }

     public function jobdesc()
     {
          $data['title'] = 'Tugas dan Fungsi';
          $data['profile'] = $this->profile->get_single_where(null, 'profil');

          $this->frontend_new('v2/frontend/profiles/jobdesc', $data);
     }

     public function history()
     {
          $data['title'] = 'Tugas dan Fungsi';
          $data['profile'] = $this->profile->get_single_where(null, 'profil');

          $this->frontend_new('v2/frontend/profiles/history', $data);
     }

     public function structure()
     {
          $data['title'] = 'Struktur Organisasi';
          $data['profile'] = $this->profile->get_single_where(null, 'profil');

          $this->frontend_new('v2/frontend/profiles/structure', $data);
     }

     public function list()
     {
          $data['title'] = 'Profil';
          $data['employee'] = $this->user_auth;
          $this->backend('v2/backend/data_profil', $data);
     }

     public function ajax_list()
     {
          if (!$this->input->is_ajax_request()) {
               redirect('v2/dashboards');
          }
          $list = $this->profil->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $profil) {
               $no++;
               $row = array();
               $row[] = $no;
               $row[] = $profil->alamat;
               $row[] = $profil->telepon;

               // Action
               $row[] = '<div class="d-flex"><a class="btn btn-primary btn-xs sharp me-1" href="javascript:void(0)" title="Edit" onclick="edit_profil(' . "'" . $profil->id . "'" . ')"><i class="fas fa-pencil-alt"></i></a>
                  <a class="btn btn-danger btn-xs sharp" href="javascript:void(0)" title="Hapus" onclick="delete_profil(' . "'" . $profil->id . "'" . ')"><i class="fas fa-trash"></i></a></div>';

               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->profil->count_all(),
               "recordsFiltered" => $this->profil->count_filtered(),
               "data" => $data,
          );
          echo json_encode($output);
     }

     public function ajax_edit($id)
     {
          $data = $this->profil->get_by_id($id);
          echo json_encode($data);
     }

     public function ajax_add()
     {
          $this->_validate();

          $data = array(
               'alamat' => $this->input->post('alamat'),
               'telepon' => $this->input->post('telepon'),
               'visi' => $this->input->post('visi'),
               'misi' => $this->input->post('misi'),
               'sambutan' => $this->input->post('sambutan'),
               'gambaran_umum' => $this->input->post('gambaran_umum'),
               'tugas_fungsi' => $this->input->post('tugas_fungsi'),
               'sejarah' => $this->input->post('sejarah'),
               'struktur_organisasi' => $this->input->post('struktur_organisasi'),
          );

          if (!empty($_FILES['file_struktur_organisasi']['name'])) {
               $upload = $this->_do_upload();
               $data['file_struktur_organisasi'] = $upload;
          }

          $this->profil->save($data);
          echo json_encode(array("status" => TRUE));
     }

     public function ajax_update()
     {
          $this->_validate();
          $data = array(
               'alamat' => $this->input->post('alamat'),
               'telepon' => $this->input->post('telepon'),
               'visi' => $this->input->post('visi'),
               'misi' => $this->input->post('misi'),
               'sambutan' => $this->input->post('sambutan'),
               'gambaran_umum' => $this->input->post('gambaran_umum'),
               'tugas_fungsi' => $this->input->post('tugas_fungsi'),
               'sejarah' => $this->input->post('sejarah'),
               'struktur_organisasi' => $this->input->post('struktur_organisasi'),
          );

          if (!empty($_FILES['file_struktur_organisasi']['name'])) {
               $upload = $this->_do_upload();
               $data['file_struktur_organisasi'] = $upload;

               // Delete old file
               $old_file = $this->input->post('fileold');
               if ($old_file && file_exists('assets/upload/' . $old_file)) {
                    unlink('assets/upload/' . $old_file);
               }
          }

          $this->profil->update(array('id' => $this->input->post('id')), $data);
          echo json_encode(array("status" => TRUE));
     }

     public function ajax_delete($id)
     {
          $profil = $this->profil->get_by_id($id);
          if ($profil->file_struktur_organisasi && file_exists('assets/upload/' . $profil->file_struktur_organisasi)) {
               unlink('assets/upload/' . $profil->file_struktur_organisasi);
          }

          $this->profil->delete_by_id($id);
          echo json_encode(array("status" => TRUE));
     }

     private function _do_upload()
     {
          $config['upload_path']   = './assets/upload/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['max_size']      = 5120; // 5MB
          $config['file_name']     = round(microtime(true) * 1000);

          $this->load->library('upload', $config);

          if (!$this->upload->do_upload('file_struktur_organisasi')) {
               $data['inputerror'][] = 'file_struktur_organisasi';
               $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', '');
               $data['status'] = FALSE;
               echo json_encode($data);
               exit();
          }
          return $this->upload->data('file_name');
     }

     private function _validate()
     {
          $data = array();
          $data['error_string'] = array();
          $data['inputerror'] = array();
          $data['status'] = TRUE;

          if ($this->input->post('alamat') == '') {
               $data['inputerror'][] = 'alamat';
               $data['error_string'][] = 'Alamat harus diisi';
               $data['status'] = FALSE;
          }

          if ($data['status'] === FALSE) {
               echo json_encode($data);
               exit();
          }
     }
}
