<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Dashboard extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->helper('url', 'xss');
          $this->load->model('M_data', 'model');
          if ($this->session->userdata('nomor_skpd') == null || $this->session->userdata('status') != "login") {
               redirect(base_url("Front"));
          }
     }

     public function index()
     {

          $this->load->view('Admin/home');
     }

     public function arsip()
     {
          if (isset($_POST['simpan'])) {
               $data = array(
                    'tanggal' => DATE('d-m-Y H:i:s'),
                    'nomor_skpd' => $this->session->userdata('nomor_skpd'),
                    'kode_klsf' => htmlentities($this->input->post('kode_klsf')),
                    'indek' => htmlentities($this->input->post('indek')),
                    'deskripsi' => htmlentities($this->input->post('deskripsi')),
                    'tahun' => htmlentities($this->input->post('tahun')),
                    'unit_kerja_pencipta' => htmlentities($this->input->post('unit_kerja_pencipta'))

               );

               $config['upload_path'] = './assets/data/'; //path folder
               $config['allowed_types'] = 'rar|zip|pdf'; //type yang dapat diakses bisa anda sesuaikan
               $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

               $this->upload->initialize($config);
               if (!empty($_FILES['file']['name'])) {
                    if ($this->upload->do_upload('file')) {

                         $gbr = $this->upload->data();
                         $data['file'] = $gbr['file_name'];

                         $insert = $this->model->simpandata($data);
                         if ($insert) {
                              $this->session->set_flashdata('SUCCESS', 'Yes berhasil input data');
                         } else {
                              $this->session->set_flashdata('GAGAL', 'Yah gagal input data');
                         }
                         redirect(base_url("Dashboard/arsip"));
                    }
               }
          }

          $this->load->view('Admin/arsip');
     }


     function arsipdetail($id = true)
     {
          $table = 'berkas';
          $where = array(
               'id' => $id
          );
          $data['detail'] = $this->model->getone($table, $where);
          $this->load->view('Admin/arsipdetail', $data);
     }

     public function ajax_list()
     {
          if (!$this->input->is_ajax_request()) {
               redirect('Front');
          }
          $lists = $this->model->get_datatables();
          $data = array();
          $no = $_POST['start'];
          $nomor = 1;
          foreach ($lists as $list) {
               $no++;
               $row = array();
               $row[] = $nomor++;
               $row[] = $list->kode_klsf;
               $row[] = $list->indek;
               $row[] = $list->tahun;
               $row[] = $list->unit_kerja_pencipta;


               //add html for action
               $row[] = '<a href="' . base_url() . 'Dashboard/arsipdetail/' . $list->id . '" title="Detail"><i class="fa fa-search" aria-hidden="true"></i></a> |
            <a href="' . base_url() . 'Dashboard/arsipedit/' . $list->id . '" title="Edit"><i class="fa fa-check" aria-hidden="true"></i></a> |
            <a href="' . base_url() . 'Dashboard/arsiphapus/' . $list->id . '" title="hapus"  onclick="return confirm(' . "'Anda yakin mau menghapus item ini ?'" . ')"><i class="fa fa-trash" aria-hidden="true"></i></a>
            ';

               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->model->count_all(),
               "recordsFiltered" => $this->model->count_filtered(),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function arsipedit($id = true)
     {
          $table = 'berkas';
          $where = array(
               'id' => $id
          );
          $data['berkas'] = $this->model->getone($table, $where);
          $this->load->view('Admin/arsip2', $data);
     }

     public function arsipupdate()
     {
          if (isset($_POST['update'])) {
               $data = array(

                    'kode_klsf' => htmlentities($this->input->post('kode_klsf')),
                    'indek' => htmlentities($this->input->post('indek')),
                    'deskripsi' => htmlentities($this->input->post('deskripsi')),
                    'tahun' => htmlentities($this->input->post('tahun')),
                    'unit_kerja_pencipta' => htmlentities($this->input->post('unit_kerja_pencipta'))

               );

               $where = array(
                    'id' => htmlentities($this->input->post('id'))
               );
               $fileold = htmlentities($this->input->post('fileold'));

               $config['upload_path'] = './assets/data/'; //path folder
               $config['allowed_types'] = 'rar|zip|pdf'; //type yang dapat diakses bisa anda sesuaikan
               $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

               $this->upload->initialize($config);
               if (!empty($_FILES['file']['name'])) {
                    if ($this->upload->do_upload('file')) {
                         unlink("./assets/data/" . $fileold);
                         $gbr = $this->upload->data();
                         $data['file'] = $gbr['file_name'];

                         $insert = $this->model->update($data, $where);
                         if ($insert) {
                              $this->session->set_flashdata('SUCCESS', 'Yes berhasil input data');
                         } else {
                              $this->session->set_flashdata('GAGAL', 'Yah gagal input data');
                         }
                         redirect(base_url("Dashboard/arsip"));
                    }
               } else {

                    $data['file'] = $fileold;
                    $insert = $this->model->update($data, $where);
                    if ($insert) {
                         $this->session->set_flashdata('SUCCESS', 'Yes berhasil update data');
                    } else {
                         $this->session->set_flashdata('GAGAL', 'Yah gagal update data');
                    }
                    redirect(base_url("Dashboard/arsip"));
               }
          }
     }


     function arsiphapus($id = true)
     {
          $table = 'berkas';
          $where = array(
               'id' => $id
          );
          $query = $this->model->getone($table, $where);
          foreach ($query as $x) {
               $file = $x->file;
          }
          unlink("./assets/data/" . $file);
          $hapus = $this->model->hapus($table, $where);
          if ($hapus) {

               redirect(base_url("Dashboard/arsip"));
          }
     }

     function akun()
     {
          $table = 'skpd';
          $where = array(
               'nomor_skpd' => $this->session->userdata('nomor_skpd')
          );
          $data['akun'] = $this->model->getone($table, $where);
          $this->load->view('Admin/akun', $data);
     }

     function akunupdate()
     {
          if (isset($_POST['update'])) {
               $data = array(

                    'nama_skpd' => htmlentities($this->input->post('nama_skpd')),
                    'alamat_skpd' => htmlentities($this->input->post('alamat_skpd')),
                    'nama_operator' => htmlentities($this->input->post('nama_operator')),
                    'kontak_operator' => htmlentities($this->input->post('kontak_operator')),

               );
               $where = array(
                    'nomor_skpd' => htmlentities($this->input->post('nomor_skpd'))
               );
               $insert = $this->model->updateakun($data, $where);
               if ($insert) {
                    $this->session->set_flashdata('SUCCESS', 'Yes berhasil update data');
               } else {
                    $this->session->set_flashdata('GAGAL', 'Yah gagal update data');
               }
               redirect(base_url("Dashboard/akun"));
          }
     }

     function gantipassword()
     {
          $table = 'skpd';
          $password_old = md5(htmlentities($this->input->post('password')));
          $where = array(
               'nomor_skpd' => $this->session->userdata('nomor_skpd')
          );
          $data = array(
               'password' => md5(htmlentities($this->input->post('password_new')))
          );

          $cek = $this->model->getone($table, $where);
          foreach ($cek as $x) {
               $password = $x->password;
          }
          if ($password_old != $password) {
               $this->session->set_flashdata('GAGAL', 'Password lama salah!');
               redirect(base_url("Dashboard/akun"));
          }

          $updatepassword = $this->model->updateakun($data, $where);
          if ($updatepassword) {
               $this->session->set_flashdata('SUCCESS', 'Yes berhasil update data');
          } else {
               $this->session->set_flashdata('GAGAL', 'Yah gagal update data');
          }
          redirect(base_url("Dashboard/akun"));
     }
}
