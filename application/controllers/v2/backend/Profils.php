<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profils extends MY_Controller {

    public $user_auth;

    public function __construct() {
        parent::__construct();
        $this->load->model('M_profil', 'profil');
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

    public function index() {
        $data['title'] = 'Profil';
        $data['employee'] = $this->user_auth;
        $this->backend('v2/backend/data_profil', $data);
    }

    public function ajax_list() {
        if (!$this->input->is_ajax_request()) {
            redirect('v2/backend/dashboards');
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
            $row[] = '<div class="d-flex"><a class="btn btn-primary btn-xs sharp me-1" href="javascript:void(0)" title="Edit" onclick="edit_profil('."'".$profil->id."'".')"><i class="fas fa-pencil-alt"></i></a>
                  <a class="btn btn-danger btn-xs sharp" href="javascript:void(0)" title="Hapus" onclick="delete_profil('."'".$profil->id."'".')"><i class="fas fa-trash"></i></a></div>';

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

    public function ajax_edit($id) {
        $data = $this->profil->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
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

    public function ajax_update() {
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

    public function ajax_delete($id) {
        $profil = $this->profil->get_by_id($id);
        if ($profil->file_struktur_organisasi && file_exists('assets/upload/' . $profil->file_struktur_organisasi)) {
            unlink('assets/upload/' . $profil->file_struktur_organisasi);
        }

        $this->profil->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload() {
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

    private function _validate() {
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
