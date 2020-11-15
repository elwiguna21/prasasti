<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {


	function __construct() 
    {
        parent::__construct();
		$this->load->model('M_front','model');
    }

	public function index()
	{
		$data ['banner1'] = $this->model->getbanner1();
		$data ['banner'] = $this->model->getbanner();
		$data ['berita'] = $this->model->getberita();
		$data ['artikel'] = $this->model->getartikel();
		$data ['link'] = $this->model->getlink();
		$data ['faq'] = $this->model->getfaq();
		$data ['profil'] = $this->model->getprofil();
		$data ['jmlarsip'] = $this->model->getcountarsip();
		$data ['jmlskpd'] = $this->model->getcountskpd();
		$this->load->view('home',$data);
	}

	function galeri()
	{
		$data ['link'] = $this->model->getlink();
		$data ['profil'] = $this->model->getprofil();
		$data ['galeri'] = $this->model->getgaleri();
		$this->load->view('galeri',$data);
	}

	function berita()
	{
		$data ['judul'] = 'berita';
		$data ['link'] = $this->model->getlink();
		$data ['profil'] = $this->model->getprofil();
		$data ['data'] = $this->model->getberitaall();
		$this->load->view('berita',$data);
	}

	function artikel()
	{
		$data ['judul'] = 'artikel';
		$data ['link'] = $this->model->getlink();
		$data ['profil'] = $this->model->getprofil();
		$data ['data'] = $this->model->getartikelall();
		$this->load->view('berita',$data);
	}

	function sambutan()
	{
		$data ['judul'] = 'sambutan';
		$data ['link'] = $this->model->getlink();
		$data ['profil'] = $this->model->getprofil();
		$this->load->view('post',$data);
	}

	function visi()
	{
		$data ['judul'] = 'visi';
		$data ['link'] = $this->model->getlink();
		$data ['profil'] = $this->model->getprofil();
		$this->load->view('post',$data);
	}
	function misi()
	{
		$data ['judul'] = 'misi';
		$data ['link'] = $this->model->getlink();
		$data ['profil'] = $this->model->getprofil();
		$this->load->view('post',$data);
	}
	function gambaran_umum()
	{
		$data ['judul'] = 'gambaran_umum';
		$data ['link'] = $this->model->getlink();
		$data ['profil'] = $this->model->getprofil();
		$this->load->view('post',$data);
	}
	function tugas_fungsi()
	{
		$data ['judul'] = 'tugas_fungsi';
		$data ['link'] = $this->model->getlink();
		$data ['profil'] = $this->model->getprofil();
		$this->load->view('post',$data);
	}
	function sejarah()
	{
		$data ['judul'] = 'sejarah';
		$data ['link'] = $this->model->getlink();
		$data ['profil'] = $this->model->getprofil();
		$this->load->view('post',$data);
	}
	function struktur_organisasi()
	{
		$data ['judul'] = 'struktur_organisasi';
		$data ['link'] = $this->model->getlink();
		$data ['profil'] = $this->model->getprofil();
		$this->load->view('post',$data);
	}

	function beritadetail($slug = true)
	{
		
		$tabel='berita';
		$data['data'] = $this->model->getdata($tabel,$slug);
		$data ['link'] = $this->model->getlink();
		$data ['profil'] = $this->model->getprofil();
		$this->load->view('single_post',$data);
	}

	function artikeldetail($slug = true)
	{
	
		$tabel='artikel';
		$data['data'] = $this->model->getdata($tabel,$slug);
		$data ['link'] = $this->model->getlink();
		$data ['profil'] = $this->model->getprofil();
		$this->load->view('single_post',$data);
	}


	function peraturan()
	{
	
		$data['judul']='peraturan';
		$data['data'] = $this->model->getperaturan();
		$data ['link'] = $this->model->getlink();
		$data ['profil'] = $this->model->getprofil();
		$this->load->view('peraturan',$data);
	}


	function download($file = true)
	{
		$this->load->helper('download');
		
		$path = file_get_contents(base_url()."assets/upload/".$file); // get file name
		force_download($file, $path); 
	}


}
