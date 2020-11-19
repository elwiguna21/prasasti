<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Excel extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin','model');
		$this->load->library('session');
		if ($this->session->userdata('status') != "login" || $this->session->userdata('level') != 'admin') {
            redirect(base_url("Front"));
        }
	}

	private $filename = "import_data";



	
	public function form(){
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			$upload = $this->model->upload_file($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('assets/upload/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		
		$this->load->view('Panel/import', $data);
	}

	function import()
	{
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('assets/upload/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 2;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 2){
				array_push($data, array(
						'tanggal' => DATE('d-m-Y H:i:s'),
						'nomor_skpd' => $row['A'],
						'kode_klsf' => $row['B'],
						'indek' => $row['C'],
						'deskripsi' => $row['D'],
						'tahun' => $row['E'],
						'unit_kerja_pencipta' => $row['F'],
						'lokasi_sampul' =>$row['G'],
						'lokasi_berkas' => $row['H'],
						'lokasi_box' => $row['I'],
						'lokasi_rak' => $row['J'],
						'keterangan_tk_perkembangan' => $row['K'],
						'ruang_penyimpanan' => $row['L'],
				));
				}
				$numrow++; 
			}
			$this->model->simpandata2($data);
			redirect("Panel/arsip");
	}
}

?>