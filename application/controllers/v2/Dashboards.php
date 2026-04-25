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

		$data['total_users']               = $this->user->get_all_where_count(array('company' => $this->encryption->decrypt($this->user_auth->company_id)));
		$data['total_users_operator']      = $this->user->get_all_where_count(array('company' => $this->encryption->decrypt($this->user_auth->company_id), 'role' => 'operator'));
		$data['total_users_verificator']   = $this->user->get_all_where_count(array('company' => $this->encryption->decrypt($this->user_auth->company_id), 'role' => 'verifikator_skpd'));

		$data['total_archieves']           = $this->archieve->get_all_where_count(array('nomor_skpd' => $this->user_auth->no_company));
		$data['total_archieves_inactives'] = $this->archieve->get_all_where_count(array('nomor_skpd' => $this->user_auth->no_company, 'jenis_arsip is null OR jenis_arsip NOT IN ("vital", "usul_serah")' => null));
		$data['total_archieves_vital']     = $this->archieve->get_all_where_count(array('nomor_skpd' => $this->user_auth->no_company, 'jenis_arsip' => 'vital'));
		$data['total_archieves_usul_musnah']    = $this->archieve->get_all_where_count(array('nomor_skpd' => $this->user_auth->no_company, 'jenis_arsip' => 'usul_serah'));

		$data['logs']  = $this->logs->get_all_where(
			   array(
					 'user' => $this->encryption->decrypt($this->user_auth->id),
				   'limits'    => 8
			   )
		);

		if ($this->user_auth->user_role == 'admin') {
			$this->backend('v2/backend/dashboard/index', $data);
		} else {
			$this->backend('v2/backend/dashboard/user', $data);
		}
	}
}
