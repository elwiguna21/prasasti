<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends MY_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('v2/Service', 'service');
     }

     public function index()
     {
          $data['title']      = 'Layanan Perbaikan Arsip';

          $code               = $this->input->get('code');
          if (!empty($code)) {
               $archieve      = $this->service->get_single_where(array('search' => $code));
               if (empty($archieve)) {
                    $this->session->set_flashdata(array('status' => 404, 'message' => 'Pencarian tidak dapat ditemukan'));
               } else {
                    if ($archieve->status == 'done') {
                         $this->session->set_flashdata(array('status' => 200, 'message' => 'Permohonan perbaikan arsip anda telah selesai dilayani. Terima kasih'));
                    } else if ($archieve->status == 'reject') {
                         $this->session->set_flashdata(array('status' => 500, 'message' => "Mohon maaf permohonan perbaikan arsip anda ditolak dengan alasan: " . $archieve->verification_message));
                    } else if ($archieve->status == 'waiting') {
                         $this->session->set_flashdata(array('status' => 200, 'message' => 'Permohonan perbaikan arsip anda sedang kami proses. Mohon menunggu tim kami menghubungi anda. Terima kasih'));
                    }
               }
          }

          $data['total']      = $this->service->get_all_where_count();
          $data['process']    = $this->service->get_all_where_count(array('status' => 'waiting'));
          $data['done']       = $this->service->get_all_where_count(array('status' => 'done', 'verification_user !=' => null));
          $data['reject']     = $this->service->get_all_where_count(array('status' => 'reject', 'verification_user !=' => null));

          $this->frontend_new('v2/frontend/service', $data);
     }

     public function add()
     {
          if (empty($_POST)) {
               show_error('Please fill a form and try again!', 403);
               die;
          }

          if (!is_dir('./data/repair/')) {
               mkdir('./data/repair/', 0755, true);
          }

          $bytes_length = ceil(8 / 2);
          try {
               $bytes = random_bytes($bytes_length); // Get cryptographically secure random bytes
          } catch (Exception $e) {
               // Handle exceptions in case of an error (e.g., no secure source of randomness available)
               // For older PHP versions, a polyfill can be used
               die("Could not generate random bytes: " . $e->getMessage());
          }
          $hex_string    = bin2hex($bytes); // Convert to hexadecimal string (doubles the length)
          $code          = substr($hex_string, 0, 8);

          $data          = array(
               'code'              => strtoupper($code),
               'fullname'          => ucwords($this->input->post('fullname')),
               'email'             => strtolower($this->input->post('email')),
               'phone'             => $this->input->post('phone'),
               'address'           => ucwords($this->input->post('address')),
               'description'       => ucfirst($this->input->post('description')),
          );

          if (!empty($_FILES) and $_FILES['document']['error'] == 0) {
               $config['upload_path']   = './data/repair/';
               $config['allowed_types'] = 'jpg|png|pdf';
               $config['encrypt_name']  = TRUE;
               $this->upload->initialize($config);

               if (!$this->upload->do_upload('document')) {
                    $this->session->set_flashdata(array('status' => 500, 'message' => $this->upload->display_errors()));
                    redirect('v2/services');
               } else {
                    $data['document'] = $this->upload->data('file_name');
               }
          }

          $save          = $this->service->insert_entry($data);
          if ($save) {
               $this->session->set_flashdata(array('status' => 200, 'message' => "Ajuan perbaikan anda berhasil dikirim dengan kode <span class='fs-bold'>" . $data['code'] . "</span>. Simpan kode unik anda untuk memudahkan pencarian"));
          } else {
               $this->session->set_flashdata(array('status' => 200, 'message' => "Terjadi kesalahan saat menyimpan data ajuan perbaikan arsip anda! Silahkan coba kembali."));
          }

          redirect('v2/services');
     }

     public function list()
     {
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

               $user->avatar       = base_url('assets/v3/backend/images/avatar/user-dummy.jpg');
          }

          $data['title']           = 'Daftar Permohonan Perbaikan Arsip';
          $data['employee']        = $user;

          $data['total_all']       = $this->service->get_all_where_count();
          $data['total_waiting']   = $this->service->get_all_where_count(array('status' => 'waiting'));
          $data['total_done']      = $this->service->get_all_where_count(array('status' => 'done', 'verification_user !=' => null));
          $data['total_reject']    = $this->service->get_all_where_count(array('status' => 'reject', 'verification_user !=' => null));

          // echo json_encode($data);
          // die;
          $this->backend('v2/backend/services/index', $data);
     }

     public function detail()
     {
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

               $user->avatar       = base_url('assets/v3/backend/images/avatar/user-dummy.jpg');
          }

          $data['title']           = 'Detail Permohonan Perbaikan Arsip';
          $data['employee']        = $user;

          if (empty($_GET['code']) or empty($_GET['service'])) {
               show_error('Mohon pilih permohonan terlebih dahulu! Silahkan coba kembali.');
               die;
          }

          $id                      = $this->encryption->decrypt($_GET['service']);
          $code                    = $_GET['code'];

          $service                 = $this->service->get_single_where(array('service.id' => $id, 'service.code' => $code));
          if (empty($service)) {
               show_error('Terjadi kesalahan saat memuat data permohonan...');
               die;
          } else {
               $service->id        = $this->encryption->encrypt($service->id);
          }

          $data['service']         = $service;

//           echo json_encode($data);
//           die;
          $this->backend('v2/backend/services/detail', $data);
     }

	public function deleted()
	{
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
			} else if ($user->user_username != 'lutdinar') {
				show_error('Cant access this request!', 403);
				die;
			}

			$user->avatar       = base_url('assets/v3/backend/images/avatar/user-dummy.jpg');
		}

		if (empty($_POST['code']) or empty($_POST['service'])) {
			show_error('Mohon pilih permohonan terlebih dahulu! Silahkan coba kembali.');
			die;
		}

		$id                      = $this->encryption->decrypt($_POST['service']);
		$code                    = $_POST['code'];

		$service                 = $this->service->get_single_where(array('service.id' => $id, 'service.code' => $code));
		if (empty($service)) {
			show_error('Terjadi kesalahan saat memuat data permohonan...');
			die;
		}

		$deleted                 = $this->service->delete_entry(array('id' => $service->id, 'code' => $service->code));
		if ($deleted > 0) {
			if (file_exists('./data/repair/' . $service->document)) {
				unlink('./data/repair/' . $service->document);
			}

			$this->session->set_flashdata(array('status' => 200, 'message' => 'Permohonan berhasil dihapus.'));
		} else {
			$this->session->set_flashdata(array('status' => 500, 'message' => 'Permohonan gagal dihapus! Silahkan coba kembali.'));
		}

		redirect('v2/services/list');
	}

     public function get_services_json()
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
               1 => 'fullname',
               2 => 'phone',
               3 => 'address',
               4 => 'status',
               5 => 'created_at'
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

          $total_rows         = $this->service->get_all_where_count($where);
          $total_filtered     = $total_rows;

          if (!empty($search)) {
               $where['search']    = $search;
               $total_filtered     = $this->service->get_all_where_count($where);
          }

          $data               = array();
          $services           = $this->service->get_all_where($where);
          if (!empty($services)) {
               foreach ($services as $service) {
                    $service->id   = $this->encryption->encrypt($service->id);
                    $params        = array('code' => $service->code, 'service' => $service->id);
                    $btn_detail    = '<a href="' . base_url('v2/services/detail?' . http_build_query($params)) . '" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>';
                    $action        = '<div class="d-flex">' . $btn_detail . '</div>';

                    $status = '';
                    switch ($service->status) {
                         case 'done':
                              $status    = '<span class="badge badge-sm light badge-success">Selesai</span>';
                              break;
                         case 'reject':
                              $status    = '<span class="badge badge-sm light badge-danger">Ditolak</span>';
                              break;
                         default:
                              $status    = '<span class="badge badge-sm light badge-warning">Menunggu Persetujuan</span>';
                              break;
                    }

                    $nested['id']            = $service->id;
                    $nested['fullname']      = '<a href="' . base_url('v2/services/detail?' . http_build_query($params)) . '"><strong class="text-primary">' . $service->fullname . '</strong></a><br>
                    <a href="mailto:' . $service->email . '">' . $service->email . '</a>';
                    $nested['phone']         = $service->phone;
                    $nested['address']       = $service->address;
                    $nested['status']        = $status;
                    $nested['created_at']    = full_tgl_indo($service->created_at);
                    $nested['action']        = $action;

                    $data[]                  = $nested;
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

     public function verification()
     {
          if ($this->input->method() !== 'post') {
               echo json_encode(array('status' => 401, 'message' => 'Anda tidak dapat mengakses permintaan ini!'));
               die;
          }

          $id       = $this->input->post('service');
          $code     = $this->input->post('code');

          if (empty($id) or empty($code)) {
               echo json_encode(array('status' => 500, 'message' => 'Mohon pilih permohonan terlebih dahulu! Silahkan coba kembali.'));
               die;
          }

          $service  = $this->service->get_single_where(array('repair.id' => $this->encryption->decrypt($id), 'repair.code' => $code));
          if (empty($service)) {
               echo json_encode(array('status' => 404, 'message' => 'Permohonan tidak dapat ditemukan! Silahkan coba kembali.'));
               die;
          }

          $data          = array(
               'status'                 => 'done',
               'verification_user'      => $this->encryption->decrypt($this->session->userdata('next-uid')),
               'verification_date'      => date('Y-m-d H:i:s')
          );

          $where         = array(
               'id'      => $service->id,
               'code'    => $service->code
          );

          $update        = $this->service->update_entry($data, $where);
          if ($update) {
               echo json_encode(array('status' => 200, 'message' => 'Permohonan berhasil diverifikasi.'));
               die;
          } else {
               echo json_encode(array('status' => 500, 'message' => 'Permohonan gagal diverifikasi! Silahkan coba kembali.'));
               die;
          }
     }

     public function reject()
     {
          if ($this->input->method() !== 'post') {
               show_error('Anda tidak dapat mengakses permintaan ini!', 403);
               die;
          }

          $id       = $this->input->post('service');
          $code     = $this->input->post('code');

          if (empty($id) or empty($code)) {
               show_error('Mohon pilih permohonan terlebih dahulu! Silahkan coba kembali.');
               die;
          }

          $service  = $this->service->get_single_where(array('repair.id' => $this->encryption->decrypt($id), 'repair.code' => $code));
          if (empty($service)) {
               show_error('Permohonan tidak dapat ditemukan! Silahkan coba kembali.');
               die;
          }

          $data          = array(
               'status'                 => 'reject',
               'verification_user'      => $this->encryption->decrypt($this->session->userdata('next-uid')),
               'verification_date'      => date('Y-m-d H:i:s'),
               'verification_message'   => $this->input->post('description')
          );

          $where         = array(
               'id'      => $service->id,
               'code'    => $service->code
          );

          $update        = $this->service->update_entry($data, $where);
          if ($update) {
               $this->session->set_flashdata(array('status' => 200, 'message' => 'Permohonan berhasil ditolak.'));
          } else {
               $this->session->set_flashdata(array('status' => 500, 'message' => 'Permohonan gagal ditolak! Silahkan coba kembali.'));
          }

          $params        = array('service' => $id, 'code' => $code);
          redirect('v2/services/detail?' . http_build_query($params));
     }
}
