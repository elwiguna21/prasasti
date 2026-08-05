<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logs extends MY_Controller
{
     public $user_auth;

     public function __construct()
     {
          parent::__construct();
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

     public function tte()
     {
          $data['title']      = 'Logs TTE';
          $data['employee']   = $this->user_auth;

          $this->load->model('v2/LogsTte', 'logs');
          $data['total_logs']           = $this->logs->get_all_where_count();
          $data['total_logs_success']   = $this->logs->get_all_where_count(array('status' => 'success'));
          $data['total_logs_failed']    = $this->logs->get_all_where_count(array('status' => 'failed'));

          $this->backend('v2/backend/logs/tte', $data);
     }

     public function get_logs_tte_json()
     {
          $this->load->model('v2/LogsTte', 'logs');

          $columns = array(
               0 => 'id',
               1 => 'user',
               3 => 'ip_address',
               4 => 'signed',
               5 => 'status',
               6 => 'description',
          );

          $limit = $this->input->post('length');
          $start = $this->input->post('start');
          $order = (!empty($this->input->post('order'))) ? $columns[$this->input->post('order')[0]['column']] : "id";
          $dir = (!empty($this->input->post('order'))) ? $this->input->post('order')[0]['dir'] : "asc";
          // $search     = (!empty($this->input->post('search')['value'])) ? $this->input->post('search')['value'] : null;
          $search = $this->input->post('search');

          $where = array(
               'starts' => $start,
               'limits' => $limit,
               'orders' => $order,
               'dirs' => $dir,
          );

          if (!empty($search)) {
               $where['search'] = $search;
          }

          $total_rows = $this->logs->get_all_where_count($where);
          $total_filtered = $total_rows;

          $data     = $this->logs->get_all_where($where);
          $logs     = array();
          if (!empty($data)) {
               foreach ($data as $d) {
                    if (!empty($d->user)) {
                         $employee                = '<a href="javascript:void(0);"><strong class="text-primary">' . $d->user->fullname . '</strong></a><p>' . $d->user->jabatan . ' - ' . $d->user->email . '</p>';
                    } else {
                         $employee                = '<p>Pegawai tidak dapat ditemukan</p>';
                    }
                    $nested['id']            = $d->id;
                    $nested['employee']      = $employee;
                    $nested['ip_address']    = $d->ip_address;
                    $nested['signed']        = full_tgl_indo($d->signed);
                    $nested['description']   = $d->description;
                    $nested['status']        = ($d->status == 'success') ? '<span class="badge badge-success">Berhasil</span>' : '<span class="badge badge-danger">Gagal</span>';

                    $logs[]                  = $nested;
               }
          }

          $json_data = array(
               "draw" => intval($this->input->post('draw')),
               "recordsTotal" => intval($total_rows),
               "recordsFiltered" => intval($total_filtered),
               "data" => $logs,
          );

          echo json_encode($json_data);
     }
}
