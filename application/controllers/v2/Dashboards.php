<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboards extends MY_Controller
{
     public $employee_auth, $user_auth;

     public function __construct()
     {
          parent::__construct();
          $this->load->model('v2/User', 'user');
          $this->load->model('v2/Employee', 'employee');
          $this->load->model('v2/Logs', 'logs');
          $this->load->model('v2/Archieve', 'archieve');

          if (empty($this->session->userdata('next-uid')) && empty($this->session->userdata('next-role'))) {
               show_error('Not Authorize! Please signin again.', 403);
               die;
          } else {
               $user = $this->employee->get_single_where(
                    array(
                         'user.id' => $this->encryption->decrypt($this->session->userdata('next-uid')),
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
          $data['title'] = 'Dashboard';
          $data['employee'] = $this->user_auth;

          $data['total_users'] = $this->user->get_all_where_count(array('company' => $this->encryption->decrypt($this->user_auth->company_id), 'role !=' => 'kepala_skpd'));
          $data['total_users_operator'] = $this->user->get_all_where_count(array('company' => $this->encryption->decrypt($this->user_auth->company_id), 'role' => 'operator'));
          $data['total_users_verificator'] = $this->user->get_all_where_count(array('company' => $this->encryption->decrypt($this->user_auth->company_id), 'role IN ("verifikator_skpd", "verifikator_lkd")' => null));
          $data['total_users_evaluator'] = $this->user->get_all_where_count(array('company' => $this->encryption->decrypt($this->user_auth->company_id), 'role' => 'admin'));

          $data['total_archieves'] = $this->archieve->get_all_where_count(array('nomor_skpd' => $this->user_auth->no_company));
          $data['total_archieves_inactives'] = $this->archieve->get_all_where_count(array('nomor_skpd' => $this->user_auth->no_company, 'jenis_arsip is null OR jenis_arsip NOT IN ("vital", "usul_serah")' => null));
          $data['total_archieves_vital'] = $this->archieve->get_all_where_count(array('nomor_skpd' => $this->user_auth->no_company, 'jenis_arsip' => 'vital'));
          $data['total_archieves_usul_musnah'] = $this->archieve->get_all_where_count(array('nomor_skpd' => $this->user_auth->no_company, 'jenis_arsip' => 'usul_serah'));

          $data['logs'] = $this->logs->get_all_where(
               array(
                    'user' => $this->encryption->decrypt($this->user_auth->user_id),
                    'limits' => 8
               )
          );

          $data['total_archieve_vital_waiting_verification'] = $this->archieve->get_all_where_count(
               array(
                    'nomor_skpd' => $this->user_auth->no_company,
                    'jenis_arsip' => 'vital',
                    'verifikasi_status IN ("N", "R")' => null
               )
          );
          $data['total_archieve_vital_waiting_signed'] = $this->archieve->get_all_where_count(
               array(
                    'nomor_skpd' => $this->user_auth->no_company,
                    'jenis_arsip' => 'vital',
                    'verifikasi_status IN ("Y")' => null,
                    'tte_status IN ("N", "R")' => null,
               )
          );
          $data['total_archieve_vital_signed'] = $this->archieve->get_all_where_count(
               array(
                    'nomor_skpd' => $this->user_auth->no_company,
                    'jenis_arsip' => 'vital',
                    'verifikasi_status' => 'Y',
                    'tte_status'     => 'Y'
               )
          );

          $data['total_archieve_musnah_waiting_verification'] = $this->archieve->get_all_where_count(
               array(
                    'nomor_skpd' => $this->user_auth->no_company,
                    'jenis_arsip' => 'usul_serah',
                    'verifikasi_status' => 'N'
               )
          );
          $data['total_archieve_musnah_waiting_signed'] = $this->archieve->get_all_where_count(
               array(
                    'nomor_skpd' => $this->user_auth->no_company,
                    'jenis_arsip' => 'usul_serah',
                    'verifikasi_status' => 'Y',
                    'tte_status'     => 'N'
               )
          );
          $data['total_archieve_musnah_signed'] = $this->archieve->get_all_where_count(
               array(
                    'nomor_skpd' => $this->user_auth->no_company,
                    'jenis_arsip' => 'usul_serah',
                    'verifikasi_status' => 'Y',
                    'tte_status'     => 'Y'
               )
          );

          //		echo json_encode($data); die;

          if ($this->user_auth->user_role == 'admin') {
               $this->backend('v2/backend/dashboard/index', $data);
          } else {
               $this->backend('v2/backend/dashboard/user', $data);
          }
     }

     public function get_total_archieves_json()
     {
          // if ($this->input->method() != 'post') {
          //      echo json_encode(array('status' => 403, 'message' => 'Cant access this request method!'));
          //      die;
          // }

          $year          = $this->input->post('year');
          $company       = $this->encryption->decrypt($this->user_auth->company_id);
          $bulan_indo = [
               1 => 'Januari',
               2 => 'Februari',
               3 => 'Maret',
               4 => 'April',
               5 => 'Mei',
               6 => 'Juni',
               7 => 'Juli',
               8 => 'Agustus',
               9 => 'September',
               10 => 'Oktober',
               11 => 'November',
               12 => 'Desember'
          ];

          $where         = array(
               'nomor_skpd'   => $company,
          );

          $tanggal_bersih = "STR_TO_DATE(LEFT(tanggal, 10), '%d-%m-%Y')";
          $where["YEAR($tanggal_bersih) = $year"]           = null;

          $data          = $this->archieve->get_all_where_group_month_count($where);
          $data_array    = array();
          if (!empty($data)) {
               $rekap_jumlah = [];
               foreach ($data as $row) {
                    $rekap_jumlah[$row->bulan_angka] = (int)$row->jumlah_berkas;
               }


               foreach ($bulan_indo as $angka_bulan => $nama_bulan) {
                    // Jika bulan ada di hasil query, ambil nilainya. Jika tidak ada, set ke 0.
                    $jumlah = isset($rekap_jumlah[$angka_bulan]) ? $rekap_jumlah[$angka_bulan] : 0;

                    array_push($data_array, $jumlah);
               }
          }


          echo json_encode($data_array);
     }
}
