<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Panel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'xss');
        $this->load->model('M_admin', 'model');
        if ($this->session->userdata('status') != "login" || $this->session->userdata('level') != 'admin') {
            redirect(base_url("Front"));
        }
    }

    public function index()
    {
        $data['verifikasi'] = $this->model->getverifikasi();
        $data['perskpd'] = $this->model->getperskpd();
        $this->load->view('Panel/home', $data);
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
        $data['skpd'] = $this->model->getdata('skpd');
        $this->load->view('Panel/arsip', $data);
    }


    function arsipdetail($id = true)
    {
        $table = 'berkas';
        $where = array(
            'id' => $id
        );
        $data['detail'] = $this->model->getone($table, $where);
        $this->load->view('Panel/arsipdetail', $data);
    }

    public function ajax_edit($id = true)
    {
        $table = 'berkas';
        $where = array(
            'id' => $id
        );
        $data = $this->model->getone2($table, $where);
        echo json_encode($data);
    }

    public function ajax_update()
    {

        $data = array(
            'lokasi_sampul' => htmlentities($this->input->post('lokasi_sampul')),
            'lokasi_berkas' => htmlentities($this->input->post('lokasi_berkas')),
            'lokasi_box' => htmlentities($this->input->post('lokasi_box')),
            'lokasi_rak' => htmlentities($this->input->post('lokasi_rak')),
            'keterangan_tk_perkembangan' => htmlentities($this->input->post('keterangan_tk_perkembangan')),
            'ruang_penyimpanan' => htmlentities($this->input->post('ruang_penyimpanan')),
        );
        $fileold= htmlentities($this->input->post('fileold'));
        $config['upload_path'] = './assets/data/'; //path folder
        $config['allowed_types'] = 'rar|zip|pdf'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = 2000000;

        $this->upload->initialize($config);
        if (!empty($_FILES['file']['name'])) {
            if ($this->upload->do_upload('file')) {
                unlink("./assets/data/".$fileold);
                $gbr = $this->upload->data();
                
                $data['file'] = $gbr['file_name'];

                $this->model->update($data, array('id' => htmlentities($this->input->post('id'))));
                // redirect(base_url("Panel/arsip"));
            }
        }
        else
        {
            $data['file']=$fileold;
            $this->model->update($data, array('id' => htmlentities($this->input->post('id'))));
            
        }
        // $this->model->update($data, array('id' => htmlentities($this->input->post('id'))));

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_list()
    {
//        if (!$this->input->is_ajax_request()) {
  //          redirect('Front');
    //    }
        $lists = $this->model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor = 1;
        foreach ($lists as $list) {
            if ($list->lokasi_berkas == null || $list->ruang_penyimpanan == null) {
                $status = '<span class="badge badge-danger">
                not verified</span>';
            } else {
                $status = '<span class="badge badge-success">
                verified</span>';
            }
            $no++;
            $row = array();
            $row[] = $nomor++;
            $row[] = $list->tanggal;
            $row[] = $list->nama_skpd;
            $row[] = $list->kode_klsf;
            $row[] = $list->indek;
            $row[] = $list->deskripsi;
            $row[] = $list->tahun;
            $row[] = $list->unit_kerja_pencipta;
            $row[] = $list->lokasi_sampul;
            $row[] = $list->lokasi_berkas;
            $row[] = $list->lokasi_box;
            $row[] = $list->lokasi_rak;
            $row[] = $list->keterangan_tk_perkembangan;
            $row[] = $list->ruang_penyimpanan;
            $row[] = $status;

            //add html for action
            $row[] = '
            <a href="' . base_url() . 'Panel/arsipdetail/' . $list->id . '" title="Detail"><span class="badge badge-info">
            Detail</span></a> | 
            <a href="javascript:void(0)" title="Edit" onclick="edit_arsip(' . "'" . $list->id . "'" . ')" title="Edit"><span class="badge badge-success">
            Update</span></a> | 
            <a href="' . base_url() . 'Panel/arsiphapus/' . $list->id . '" title="hapus"  onclick="return confirm(' . "'Anda yakin mau menghapus item ini ?'" . ')"><span class="badge badge-danger">
            Hapus</span></a>
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

            redirect(base_url("Panel/arsip"));
        }
    }

    function akun()
    {
        $table = 't_admin';
        $where = array(
            'nama' => $this->session->userdata('nama')
        );
        $data['akun'] = $this->model->getone($table, $where);
        $this->load->view('Panel/akun', $data);
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


    function dataskpd()
    {
        $this->load->view('Panel/data_akun');
    }

    function faq()
    {
        $this->load->view('Panel/data_faq');
    }


    function link()
    {
        $this->load->view('Panel/data_link');
    }

    function artikel()
    {
        $this->load->view('Panel/data_artikel');
    }

    function berita()
    {
        $this->load->view('Panel/data_berita');
    }

    function banner()
    {
        $this->load->view('Panel/data_banner');
    }

    function galeri()
    {
        $this->load->view('Panel/data_galeri');
    }

    function peraturan()
    {
        $this->load->view('Panel/data_peraturan');
    }
}
