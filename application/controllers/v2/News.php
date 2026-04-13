<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends MY_Controller
{
	public $user_auth = null;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('v2/Article', 'article');
		$this->load->model('v2/Newslatter', 'newslatter');
		$this->load->model('v2/Employee', 'employee');
		$this->load->model('M_artikel', 'artikel');
		$this->load->model('M_berita', 'berita');
		$this->load->model('M_data', 'model');

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
		$search = $this->input->get('keyword');
		$limits = 6;
		$pages = (!empty($this->input->get('pages'))) ? ($this->input->get('pages') - 1) * $limits : 0;

		$where = array(
			   'limits' => $limits,
			   'starts' => $pages
		);

		if (!empty($search)) {
			$where['search'] = $search;
		}

		$this->load->library('pagination');
		$config['per_page'] = $where['limits'];
		$config['base_url'] = base_url('v2/news');
		$config['total_rows'] = $this->newslatter->get_all_where_count($where);
		$this->pagination->initialize($config);

		$data['newslatters'] = $this->newslatter->get_all_where($where);
		$data['newslatters_total'] = $config['total_rows'];
		$data['pagination'] = $this->pagination->create_links();

		$data['newslatters_last'] = $this->newslatter->get_all_where(array('limits' => 3, 'starts' => $pages));
		$data['articles_last'] = $this->article->get_all_where(array('limits' => 3, 'starts' => $pages));

		$data['title'] = 'Berita';

		$this->frontend('v2/frontend/news/index', $data);
	}

	public function detail()
	{
		$slug = $this->input->get('slug');
		if (empty($slug)) {
			redirect('v2/frontend/news');
		}

		$newslatter = $this->newslatter->get_single_where(array('slug' => $slug));
		if (empty($newslatter)) {
			show_404();
			die;
		}

		if (file_exists('./assets/upload/' . $newslatter->gambar)) {
			$newslatter->gambar = base_url('assets/upload/' . $newslatter->gambar);
		} else {
			$newslatter->gambar = base_url('assets/v3/frontend/images/blog/default/thum1.jpg');
		}

		$data['newslatter'] = $newslatter;
		$data['title'] = 'Detail Berita - ' . $newslatter->judul;

		$data['newslatters_last'] = $this->newslatter->get_all_where(array('limits' => 3, 'starts' => 0));
		$data['articles_last'] = $this->article->get_all_where(array('limits' => 3, 'starts' => 0));

		$this->frontend('v2/frontend/news/detail', $data);
	}

	public function articles()
	{
		$search = $this->input->get('keyword');
		$limits = 6;
		$pages = (!empty($this->input->get('pages'))) ? ($this->input->get('pages') - 1) * $limits : 0;

		$where = array(
			   'limits' => $limits,
			   'starts' => $pages
		);

		if (!empty($search)) {
			$where['search'] = $search;
		}

		$this->load->library('pagination');
		$config['per_page'] = $where['limits'];
		$config['base_url'] = base_url('v2/articles');
		$config['total_rows'] = $this->article->get_all_where_count($where);
		$this->pagination->initialize($config);

		$data['articles'] = $this->article->get_all_where($where);
		$data['articles_total'] = $config['total_rows'];
		$data['pagination'] = $this->pagination->create_links();

		$data['articles_last'] = $this->article->get_all_where(array('limits' => 3, 'starts' => $pages));
		$data['title'] = 'Artikel';

		$data['news_last'] = $this->newslatter->get_all_where(array('limits' => 3, 'starts' => $pages));

		$this->frontend('v2/frontend/news/article', $data);
	}

	public function articles_detail()
	{
		$slug = $this->input->get('slug');
		if (empty($slug)) {
			redirect('v2/articles');
		}

		$article = $this->article->get_single_where(array('slug' => $slug));
		if (empty($article)) {
			show_404();
			die;
		}

		if (file_exists('./assets/upload/' . $article->gambar)) {
			$article->gambar = base_url('assets/upload/') . $article->gambar;
		} else {
			$article->gambar = base_url('assets/v3/frontend/images/blog/default/thum1.jpg');
		}

		$data['article'] = $article;
		$data['articles_last'] = $this->article->get_all_where(array('limits' => 3, 'starts' => 0));
		$data['title'] = 'Detail Artikel - ' . $article->judul;

		$data['news_last'] = $this->newslatter->get_all_where(array('limits' => 3, 'starts' => 0));
		// echo json_encode($data);
		// die;

		$this->frontend('v2/frontend/news/article_detail', $data);
	}

	// ===== BACKEND =====
	public function articles_list()
	{
		if (empty($this->user_auth) or $this->user_auth->user_role != 'admin') {
			show_error('Maaf, permintaan Anda tidak dapat kami layani.', 401);
			die;
		}

		$data['title']    = 'Artikel';
		$data['employee'] = $this->user_auth;

		$this->backend('v2/backend/data_artikel', $data);
	}

	public function articles_list_ajax()
	{
		if (!$this->input->is_ajax_request()) {
			redirect('v2/backend/dashboards');
		}
		$list  = $this->artikel->get_datatables();
		$data  = array();
		$no    = $_POST['start'];
		$nomor = 1;
		foreach ($list as $artikel) {
			$isi   = substr($artikel->isi, 0, 100);
			$no++;
			$row   = array();
			$row[] = $nomor++;
			$row[] = $artikel->judul;
			$row[] = $artikel->tanggal;
			$row[] = $isi;
			$row[] = '<div class="d-flex"><a class="btn btn-primary btn-xs sharp me-1" href="javascript:void(0)" title="Edit" onclick="edit_artikel(\'' . $artikel->idartikel . '\')"><i class="fas fa-pencil-alt"></i></a><a class="btn btn-danger btn-xs sharp" href="javascript:void(0)" title="Hapus" onclick="delete_artikel(\'' . $artikel->idartikel . '\')"><i class="fas fa-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
			   "draw"            => $_POST['draw'],
			   "recordsTotal"    => $this->artikel->count_all(),
			   "recordsFiltered" => $this->artikel->count_filtered(),
			   "data"            => $data,
		);
		echo json_encode($output);
	}

	public function articles_edit($id)
	{
		$data = $this->artikel->get_by_id($id);
		echo json_encode($data);
	}

	public function articles_add()
	{
		$this->_validate();
		$data = array(
			   'judul'   => htmlentities($this->input->post('judul')),
			   'slug'    => slug(htmlentities($this->input->post('judul'))),
			   'tanggal' => DATE('d-m-Y'),
			   'isi'     => htmlentities($this->input->post('isi'))
		);

		$config['upload_path']   = './assets/upload/';
		$config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg';
		$config['encrypt_name']  = TRUE;

		$this->upload->initialize($config);
		if (!empty($_FILES['file']['name'])) {
			if ($this->upload->do_upload('file')) {
				$gbr = $this->upload->data();
				$data['gambar'] = $gbr['file_name'];
				$this->artikel->save($data);
				echo json_encode(array("status" => TRUE));
			}
		}
	}

	public function articles_update()
	{
		$this->_validate();
		$data = array(
			   'judul' => htmlentities($this->input->post('judul')),
			   'slug'  => slug(htmlentities($this->input->post('judul'))),
			   'isi'   => htmlentities($this->input->post('isi'))
		);

		$where = array(
			   'idartikel' => htmlentities($this->input->post('idartikel'))
		);
		$fileold = htmlentities($this->input->post('fileold'));

		$config['upload_path']   = './assets/upload/';
		$config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg';
		$config['encrypt_name']  = TRUE;

		$this->upload->initialize($config);
		if (!empty($_FILES['file']['name'])) {
			if ($this->upload->do_upload('file')) {
				@unlink("./assets/upload/" . $fileold);
				$gbr = $this->upload->data();
				$data['gambar'] = $gbr['file_name'];
				$this->artikel->update($where, $data);
			}
		} else {
			$data['gambar'] = $fileold;
			$this->artikel->update($where, $data);
		}
		echo json_encode(array("status" => TRUE));
	}

	public function articles_delete($id)
	{
		$table = 'artikel';
		$where = array('idartikel' => $id);
		$query = $this->model->getone($table, $where);
		foreach ($query as $x) {
			$file = $x->gambar;
		}
		@unlink("./assets/upload/" . $file);
		$this->model->hapus($table, $where);
		echo json_encode(array("status" => TRUE));
	}

	public function list()
	{
		$data['title']    = 'Berita';
		$data['employee'] = $this->user_auth;

		$this->backend('v2/backend/data_berita', $data);
	}

	public function list_ajax()
	{
		if (!$this->input->is_ajax_request()) {
			redirect('v2/dashboards');
		}
		$list  = $this->berita->get_datatables();
		$data  = array();
		$no    = $_POST['start'];
		$nomor = 1;
		foreach ($list as $berita) {
			$isi   = substr($berita->isi, 0, 100);
			$no++;
			$row   = array();
			$row[] = $nomor++;
			$row[] = $berita->judul;
			$row[] = $berita->tanggal;
			$row[] = $isi;
			$row[] = '<div class="d-flex"><a class="btn btn-primary btn-xs sharp me-1" href="javascript:void(0)" title="Edit" onclick="edit_berita(\'' . $berita->idberita . '\')"><i class="fas fa-pencil-alt"></i></a><a class="btn btn-danger btn-xs sharp" href="javascript:void(0)" title="Hapus" onclick="delete_berita(\'' . $berita->idberita . '\')"><i class="fas fa-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
			   "draw"            => $_POST['draw'],
			   "recordsTotal"    => $this->berita->count_all(),
			   "recordsFiltered" => $this->berita->count_filtered(),
			   "data"            => $data,
		);
		echo json_encode($output);
	}

	public function edit($id)
	{
		$data = $this->berita->get_by_id($id);
		echo json_encode($data);
	}

	public function add()
	{
		$this->_validate();
		$data = array(
			   'judul'   => htmlentities($this->input->post('judul')),
			   'slug'    => slug(htmlentities($this->input->post('judul'))),
			   'tanggal' => DATE('d-m-Y'),
			   'isi'     => htmlentities($this->input->post('isi'))
		);

		$config['upload_path']   = './assets/upload/';
		$config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg';
		$config['encrypt_name']  = TRUE;

		$this->upload->initialize($config);
		if (!empty($_FILES['file']['name'])) {
			if ($this->upload->do_upload('file')) {
				$gbr = $this->upload->data();
				$data['gambar'] = $gbr['file_name'];
				$this->berita->save($data);
				echo json_encode(array("status" => TRUE));
			}
		}
	}

	public function update()
	{
		$this->_validate();
		$data = array(
			   'judul' => htmlentities($this->input->post('judul')),
			   'slug'  => slug(htmlentities($this->input->post('judul'))),
			   'isi'   => htmlentities($this->input->post('isi'))
		);

		$where = array(
			   'idberita' => htmlentities($this->input->post('idberita'))
		);
		$fileold = htmlentities($this->input->post('fileold'));

		$config['upload_path']   = './assets/upload/';
		$config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg';
		$config['encrypt_name']  = TRUE;

		$this->upload->initialize($config);
		if (!empty($_FILES['file']['name'])) {
			if ($this->upload->do_upload('file')) {
				@unlink("./assets/upload/" . $fileold);
				$gbr = $this->upload->data();
				$data['gambar'] = $gbr['file_name'];
				$this->berita->update($where, $data);
			}
		} else {
			$data['gambar'] = $fileold;
			$this->berita->update($where, $data);
		}
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id)
	{
		$table = 'berita';
		$where = array('idberita' => $id);
		$query = $this->model->getone($table, $where);
		foreach ($query as $x) {
			$file = $x->gambar;
		}
		@unlink("./assets/upload/" . $file);
		$this->model->hapus($table, $where);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror']   = array();
		$data['status']       = TRUE;

		if ($this->input->post('judul') == '') {
			$data['inputerror'][]   = 'judul';
			$data['error_string'][] = 'Data judul harus di isi';
			$data['status']         = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}
