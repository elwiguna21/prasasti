<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
     public $user_auth;

     public function __construct()
     {
          parent::__construct();
          $this->load->model('v2/User', 'user');
          $this->load->model('v2/Employee', 'employee');

          if (empty($this->session->userdata('next-uid')) && empty($this->session->userdata('next-role'))) {
               show_error('Not Authorize! Please signin again.', 403);
               die;
          } else {
               $user                    = $this->employee->get_single_where(
                    array(
                         'user.id'           => $this->encryption->decrypt($this->session->userdata('next-uid')),
                         'user.username'     => $this->session->userdata('next-uname')
                    )
               );

               if (empty($user)) {
                    redirect('v2/authentications/signout');
               }

               $this->user_auth              = $user;
               $this->user_auth->avatar      = base_url('assets/v3/backend/images/avatar/user-dummy.jpg');
          }
     }

     public function index()
     {
          $data['title']      = 'Daftar Pengguna';
          $data['employee']   = $this->user_auth;

          $this->backend('v2/backend/users', $data);
     }

     public function save()
     {
          if (empty($_POST)) {
               show_error('Please fill a form and try again!', 403);
               die;
          }

          $data_user     = array(
               'username'          => strtolower($this->input->post('username')),
               'role'              => strtolower($this->input->post('role')),
               'company'           => $this->input->post('skpd')
          );

          $user_id       = $this->encryption->decrypt($this->input->post('user'));
          if (!empty($user_id)) {
               // edit
               if (!empty($this->input->post('password'))) {
                    $data_user['password']   = hashing_password('sha512', $this->input->post('password'), KEY_ENCRYPT);
               }
               $user                    = $this->user->update_entry($data_user, array('id' => $user_id, 'deleted_at' => null));
          } else {
               // insert
               $data_user['password']   = hashing_password('sha512', $this->input->post('password'), KEY_ENCRYPT);
               $user                    = $this->user->insert_entry($data_user);
          }

          if ($user > 0) {
               $this->load->model('v2/Company', 'company');
               $skpd     = $this->company->get_single_where(array('id' => $this->input->post('skpd')));
               $data_employee      = array(
                    'fullname'          => ucwords($this->input->post('fullname')),
                    'email'             => strtolower($this->input->post('email')),
                    'phone'             => $this->input->post('phone'),
                    'no_company'        => $skpd->no_company,
                    'company'           => $this->encryption->decrypt($skpd->id),
               );

               if (!empty($user_id)) {
                    $data_employee['user']        = $user_id;
                    $this->employee->update_entry($data_employee, array('user' => $data_employee['user'], 'deleted_at' => null));
                    $this->session->set_flashdata(array('status' => 200, 'message' => "Pengguna <strong>{$data_employee['fullname']}</strong> berhasil diperbarui."));
               } else {
                    $data_employee['user']        = $user;
                    $this->employee->insert_entry($data_employee);
                    $this->session->set_flashdata(array('status' => 200, 'message' => "Pengguna baru <strong>{$data_employee['fullname']}</strong> berhasil disimpan."));
               }
          } else {
               if (!empty($user_id)) {
                    $this->session->set_flashdata(array('status' => 500, 'message' => "Terjadi kesalahan saat memperbarui data! Silahkan coba kembali."));
               } else {
                    $this->session->set_flashdata(array('status' => 500, 'message' => "Terjadi kesalahan saat menyimpan data pengguna baru! Silahkan coba kembali."));
               }
          }

          if (isset($_POST['profiles']) && $_POST['profiles']) {
               redirect('v2/backend/users/profiles');
          }
          redirect('v2/backend/users');
     }

     public function profiles()
     {
          $data['title']      = 'Profil Pengguna';
          $data['employee']   = $this->user_auth;

          // echo json_encode($data);
          // die;
          $this->backend('v2/backend/profile', $data);
     }

     // JSON OUTPUT
     public function get_users_json()
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
               1 => 'username',
               // 3 => 'role',
               4 => 'company',
               5 => 'role'
          );

          $limit      = $this->input->post('length');
          $start      = $this->input->post('start');
          $order      = (!empty($this->input->post('order'))) ? $columns[$this->input->post('order')[0]['column']] : "id";
          $dir        = (!empty($this->input->post('order'))) ? $this->input->post('order')[0]['dir'] : "asc";
          // $search     = (!empty($this->input->post('search')['value'])) ? $this->input->post('search')['value'] : null;
          $search        = $this->input->post('search');
          $role          = $this->input->post('role');
          $company       = $this->input->post('skpd');

          $where      = array(
               'starts'    => $start,
               'limits'    => $limit,
               'orders'    => $order,
               'dirs'      => $dir,
          );

          // $where['username !='] = 'Admin';

          if (!empty($role)) {
               $where['role']      = $role;
          }

          if (!empty($company)) {
               $where['company']   = $company;
          }

          $total_rows         = $this->user->get_all_where_count($where);
          $total_filtered     = $total_rows;

          if (!empty($search)) {
               $where['search']    = $search;
               $total_filtered     = $this->user->get_all_where_count($where);
          }

          $data               = array();
          $users              = $this->user->get_all_where($where);
          if (!empty($users)) {
               foreach ($users as $user) {
                    $btn_edit      = '<a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1 btn-edit" data-user="' . $user->id . '" data-uname="' . $user->username . '"><i class="fas fa-pencil-alt"></i></a>';
                    $btn_delete    = '<a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp btn-delete" data-user="' . $user->id . '" data-uname="' . $user->username . '"><i class="fa fa-trash"></i></a>';
                    $action        = '<div class="d-flex">' . $btn_edit . $btn_delete . '</div>';

                    // <span class="badge badge-sm light badge-secondary">Secondary</span>
                    $roles = '';
                    switch ($user->role) {
                         case 'admin':
                              $roles    = '<span class="badge badge-sm light badge-success">ADMIN</span>';
                              break;
                         case 'verifikator_skpd':
                              $roles    = '<span class="badge badge-sm light badge-dark">VERIFIKATOR SKPD</span>';
                              break;
                         case 'verifikator_lkd':
                              $roles    = '<span class="badge badge-sm light badge-info">VERIFIKATOR LKD</span>';
                              break;
                         case 'kepala_skpd':
                              $roles    = '<span class="badge badge-sm light badge-primary">KEPALA SKPD</span>';
                              break;
                         case 'kepala_lkd':
                              $roles    = '<span class="badge badge-sm light badge-warning">KEPALA LKD</span>';
                              break;
                         case 'operator':
                              $roles    = '<span class="badge badge-sm light badge-danger">OPERATOR</span>';
                              break;
                         default:
                              $roles    = '-';
                              break;
                    }

                    if (empty($user->employee)) {
                         $user->employee->fullname     = '-';
                         $user->employee->phone        = '-';
                    }

                    if (empty($user->company)) {
                         $user->company->name          = '-';
                    }

                    $user->role         = $roles;
                    $user->action       = $action;
                    $data[]             = $user;
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

     public function get_user_json()
     {
          if ($this->input->method() != 'post') {
               echo json_encode(array('status' => 403, 'Your request is not allowed!'));
               die;
          }
          if (empty($_POST)) {
               echo json_encode(array('status' => 500, 'Please fill a form and try again!'));
               die;
          }

          $where    = array(
               'employee.user'     => $this->encryption->decrypt($this->input->post('user')),
               'user.username'     => $this->input->post('uname')
          );
          $user     = $this->employee->get_single_where($where);
          if (!empty($user)) {
               $user->company_id   = $this->encryption->decrypt($user->company_id);
               echo json_encode(array('status' => 200, 'message' => 'Pengguna berhasil ditemukan', 'data' => $user));
          } else {
               echo json_encode(array('status' => 404, 'message' => 'Pengguna gagal ditemukan!', 'data' => $user));
          }
     }

     public function get_skpd_json()
     {
          $this->load->model('v2/Company', 'company');
          $search        = $this->input->post('search');
          $page          = $this->input->post('page');

          $where         = array(
               'limits'  => 20,
               'starts'  => ($page > 1) ? ($page - 1) * 20 : $page
          );

          $total_rows    = $this->company->get_all_where_count($where);
          if (!empty($search)) {
               $where['search']    = $search;
               $total_rows         = $this->company->get_all_where_count($where);
               $results            = $this->company->get_all_where($where);
          } else {
               $results            = $this->company->get_all_where($where);
          }

          $data['results']    = $results;
          $data['pagination'] = true;
          $data['totalRows']  = $total_rows;

          echo json_encode($data);
     }

     public function find_exists_user_json()
     {
          if ($this->input->method() != 'post') {
               http_response_code(405);
               show_error('Post Request Only!', 405);
               die;
          }

          if (empty($_POST)) {
               echo json_encode(array('status' => 500, 'message' => 'Akses ditolak! Mohon kirim data terlebih dahulu.'));
               die;
          }

          $user_id            = $this->encryption->decrypt($this->input->post('user'));

          if (isset($_POST['username'])) {
               $user          = $this->employee->get_single_where(array('user.username' => $this->input->post('username')));
          } else {
               $user          = $this->employee->get_single_where(array('employee.email' => $this->input->post('email')));
          }

          if (!empty($user)) {
               if ($user_id == $this->encryption->decrypt($user->user_id)) {
                    if (isset($_POST['username'])) {
                         echo json_encode(array('valid' => true, 'message' => 'Username dapat digunakan.'));
                    } else {
                         echo json_encode(array('valid' => true, 'message' => 'Email dapat digunakan.'));
                    }
               } else {
                    if (isset($_POST['username'])) {
                         echo json_encode(array('valid' => false, 'message' => 'Username sudah digunakan oleh Pengguna lain! Silahkan ganti Username anda.'));
                    } else {
                         echo json_encode(array('valid' => false, 'message' => 'Email sudah digunakan oleh Pengguna lain! Silahkan ganti Email anda.'));
                    }
               }
          } else {
               if (isset($_POST['username'])) {
                    echo json_encode(array('valid' => true, 'message' => 'Username dapat digunakan.'));
               } else {
                    echo json_encode(array('valid' => true, 'message' => 'Email dapat digunakan.'));
               }
          }
     }

     public function deleted()
     {
          if ($this->input->method() != 'post') {
               echo json_encode(array('status' => 401, 'message' => 'Permintaan anda tidak di izinkan!'));
               die;
          }

          if (empty($_POST)) {
               echo json_encode(array('status' => 403, 'message' => 'Mohon pilih pengguna terlebih dahulu!'));
               die;
          }

          $employee_id   = $this->encryption->decrypt($this->input->post('emp'));
          $username      = $this->input->post('uname');
          $user_id       = $this->encryption->decrypt($this->input->post('user'));

          $employee      = $this->employee->get_single_where(array(
               'employee.id'       => $employee_id,
               'user.id'           => $user_id,
               'user.username'     => $username
          ));

          if ($user_id == $this->encryption->decrypt($employee->user_id) && $employee_id == $this->encryption->decrypt($employee->id)) {
               $deleted  = $this->employee->delete_entry(array('id' => $employee_id, 'user' => $user_id));
               if ($deleted) {
                    $this->user->delete_entry(array('id' => $user_id, 'username' => $username));
                    echo json_encode(array('status' => 200, 'message' => 'Pengguna berhasil dihapus.'));
               } else {
                    echo json_encode(array('status' => 200, 'message' => 'Pengguna gagal dihapus!'));
               }
          } else {
               echo json_encode(array('status' => 200, 'message' => 'Pengguna yang anda cari tidak ditemukan! Silahkan coba kembali.'));
          }
     }
}
