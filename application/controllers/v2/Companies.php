<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Companies extends MY_Controller
{
     public $user_auth;

     public function __construct()
     {
          parent::__construct();
          // $this->load->helper('url', 'xss', 'slug');
          // $this->load->model('M_artikel', 'artikel');
          // $this->load->model('M_data', 'model');
          $this->load->model('v2/Employee', 'employee');
          $this->load->model('v2/Company', 'company');

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
          $data['title']      = 'Daftar SKPD';
          $data['employee']   = $this->user_auth;

          $this->backend('v2/backend/company', $data);
     }

     public function save()
     {
          if (empty($this->session->userdata('next-uid')) && $this->session->userdata('next-state') != 'logged_in') {
               show_error('Not Authorize!', 401);
               die;
          }

          if ($this->input->method() != 'post' or empty($_POST)) {
               show_error('Post Request Only!', 405);
               die;
          }

          $this->db->select_max('no_company');
          $last_no_company = $this->db->get('company')->row();
          if (empty($last_no_company)) {
               show_error('Gagal mendapatkan data no_company! Silahkan hubungi developer');
               die;
          } else {
               $no_company    = (int)$last_no_company->no_company + 1;
          }

          $data          = array(
               'no_company'        => $no_company,
               'name'              => htmlspecialchars(ucfirst($this->input->post('name'))),
               'email'             => htmlspecialchars(strtolower($this->input->post('email'))),
               'phone'             => htmlspecialchars($this->input->post('phone')),
               'address'           => htmlspecialchars($this->input->post('address')),
          );

          if (!empty($_POST['company'])) {
               $save          = $this->company->update_entry(
                    $data,
                    array(
                         'id' => $this->encryption->decrypt($this->input->post('company')),
                         'no_company'   => $this->input->post('no_company')
                    )
               );
               if ($save) {
                    $this->session->set_flashdata(array('status' => 200, 'message' => "SKPD " . $data['name'] . " berhasil diperbarui."));
               } else {
                    $this->session->set_flashdata(array('status' => 200, 'message' => "SKPD " . $data['name'] . " gagal diperbarui! Silahkan coba kembali."));
               }
          } else {

               $save          = $this->company->insert_entry($data);
               if ($save) {
                    $this->session->set_flashdata(array('status' => 200, 'message' => "SKPD " . $data['name'] . " berhasil disimpan."));
               } else {
                    $this->session->set_flashdata(array('status' => 200, 'message' => "SKPD " . $data['name'] . " gagal disimpan! Silahkan coba kembali."));
               }
          }

          redirect('v2/backend/companies');
     }

     public function get_companies_json()
     {
          if (empty($this->session->userdata('next-uid')) && $this->session->userdata('next-state') != 'logged_in') {
               show_error('Not Authorize!', 401);
               die;
          }

          if ($this->input->method() != 'post') {
               show_error('Post Request Only!', 405);
               die;
          }

          $columns        = array(
               0 => 'id',
               1 => 'name',
               2 => 'address',
               3 => 'phone',
               4 => 'email',
          );

          $limit      = $this->input->post('length');
          $start      = $this->input->post('start');
          $order      = (!empty($this->input->post('order'))) ? $columns[$this->input->post('order')[0]['column']] : "id";
          $dir        = (!empty($this->input->post('order'))) ? $this->input->post('order')[0]['dir'] : "asc";
          $search     = (!empty($this->input->post('search')['value'])) ? $this->input->post('search')['value'] : null;

          $where      = array(
               'starts'    => $start,
               'limits'    => $limit,
               'orders'    => $order,
               'dirs'      => $dir,
          );

          $total_rows         = $this->company->get_all_where_count($where);
          $total_filtered     = $total_rows;

          if (!empty($search)) {
               $where['search']    = $search;
               $total_filtered     = $this->company->get_all_where_count($where);
          }

          $data               = array();
          $companies          = $this->company->get_all_where($where);
          if (!empty($companies)) {
               foreach ($companies as $company) {
                    $company->id   = $this->encryption->encrypt($company->id);
                    $btn_edit      = '<a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1 btn-edit" data-company="' . $company->id . '" data-no-company="' . $company->no_company . '"><i class="fas fa-pencil-alt"></i></a>';
                    $btn_delete    = '<a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp btn-delete" data-company="' . $company->id . '" data-no-company="' . $company->no_company . '"><i class="fa fa-trash"></i></a>';
                    $action        = '<div class="d-flex">' . $btn_edit . $btn_delete . '</div>';

                    $nested['id']       = $company->id;
                    $nested['name']     = $company->name;
                    $nested['address']  = $company->address;
                    $nested['phone']    = $company->phone;
                    $nested['email']    = $company->email;
                    $nested['action']   = $action;

                    $data[]             = $nested;
               }
          }

          $json_data = array(
               "draw"              => intval($this->input->post('draw')),
               "recordsTotal"      => intval($total_rows),
               "recordsFiltered"   => intval($total_filtered),
               "data"              => $data,
          );

          echo json_encode($json_data);
     }

     public function get_companies_select_json()
     {
          $search     = $this->input->post('search');
          $page       = (!empty($this->input->post('page'))) ? $this->input->post('page') : 1;

          $where      = array(
               'limits'    => '20',
               'starts'    => ($page - 1) * 20,
               'orders'    => 'name',
               'dirs'      => 'asc',
          );

          if (!empty($search)) {
               $where['search']      = $search;
          }

          $companies       = $this->company->get_all_where($where);
          if (!empty($companies)) {
               foreach ($companies as $company) {
                    $company->id        = $company->no_company;
                    $company->text      = $company->name;
               }
               $data['results']            = $companies;
               $data['pagination']         = true;
          } else {
               $data['results']            = null;
               $data['pagination']         = false;
          }

          $data['totalRows']              = $this->company->get_all_where_count($where);

          echo json_encode($data);
     }

     public function get_company_json()
     {
          if (empty($this->session->userdata('next-uid')) && $this->session->userdata('next-state') != 'logged_in') {
               show_error('Not Authorize!', 401);
               die;
          }

          if ($this->input->method() != 'post') {
               show_error('Post Request Only!', 405);
               die;
          }

          $id            = $this->encryption->decrypt($this->input->post('company'));
          $no_company    = $this->input->post('no_company');
          if (empty($id) or empty($no_company)) {
               echo json_encode(array('status' => 500, 'message' => 'Mohon pilih SKPD terlebih dahulu! Silahkan coba kembali.'));
               die;
          }

          $where         = array(
               'id'           => $id,
               'no_company'   => $no_company
          );

          $company       = $this->company->get_single_where($where);
          if (empty($company)) {
               echo json_encode(array(
                    'status'       => 404,
                    'message'      => 'Data SKPD tidak dapat ditemukan!',
                    'data'         => null
               ));
               die;
          } else {
               echo json_encode(array(
                    'status'       => 200,
                    'message'      => 'Data SKPD berhasil ditemukan!',
                    'data'         => $company
               ));
               die;
          }
     }

     public function deleted()
     {
          if (empty($this->session->userdata('next-uid')) && $this->session->userdata('next-state') != 'logged_in') {
               show_error('Not Authorize!', 401);
               die;
          }

          if ($this->input->method() != 'post') {
               show_error('Post Request Only!', 405);
               die;
          }

          $id            = $this->encryption->decrypt($this->input->post('company'));
          $no_company    = $this->input->post('no_company');
          if (empty($id) or empty($no_company)) {
               echo json_encode(array('status' => 500, 'message' => 'Mohon pilih SKPD terlebih dahulu! Silahkan coba kembali.'));
               die;
          }

          $company      = $this->company->get_single_where(array(
               'id'           => $id,
               'no_company'   => $no_company
          ));

          if ($id == $this->encryption->decrypt($company->id) && $no_company == $company->no_company) {
               $deleted  = $this->company->delete_entry(array('id' => $id, 'no_company' => $no_company));
               if ($deleted) {
                    echo json_encode(array('status' => 200, 'message' => 'SKPD berhasil dihapus.'));
                    die;
               } else {
                    echo json_encode(array('status' => 500, 'message' => 'SKPD gagal dihapus! Silahkan coba kembali.'));
                    die;
               }
          } else {
               echo json_encode(array('status' => 404, 'message' => 'SKPD yang anda cari tidak ditemukan! Silahkan coba kembali.'));
               die;
          }
     }
}
