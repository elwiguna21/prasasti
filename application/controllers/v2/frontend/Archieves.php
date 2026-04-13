<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Archieves extends MY_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('v2/Archieve', 'archieve');
          $this->load->model('v2/Company', 'company');
          $this->load->model('v2/GuideArchieve', 'guide_archieve');
          $this->load->model('v2/Inventory', 'inventory');
     }

     public function index()
     {
          $data['title']      = 'Arsip Statis';

          $data['companies']  = $this->company->get_all_where();

          $search             = $this->input->get('title');
          $limits             = 12;
          $pages              = (!empty($this->input->get('pages'))) ? ($this->input->get('pages') - 1) * $limits : 0;
          $company            = $this->input->get('company');

          $where              = array(
               'limits'        => $limits,
               'starts'        => $pages
          );

          if (!empty($search)) {
               $where['search']         = $search;
          }

          if (!empty($company)) {
               $where['berkas.nomor_skpd']   = $company;
          }

          $where['berkas.penilaian_arsip_statis']   = 'Y';

          $this->load->library('pagination');
          $config['per_page']           = $where['limits'];
          $config['base_url']           = base_url('v2/frontend/archieves');
          $config['total_rows']         = $this->archieve->get_all_where_count($where);
          $this->pagination->initialize($config);

          $data['archieves']            = $this->archieve->get_all_where($where);
          $data['archieves_total']      = $config['total_rows'];
          $data['pagination']           = $this->pagination->create_links();

          // echo json_encode($data);
          // die;
          $this->frontend('v2/frontend/archieves/static', $data);
     }

     public function detail()
     {
          $data['title']      = 'Detail Arsip';

          $archieve           = $this->input->get('archieve');
          $company            = $this->input->get('company');

          if (empty($archieve) or empty($company)) {
               show_error('Mohon pilih arsip terlebih dahulu! Silahkan coba kembali.');
               die;
          }

          $archieves          = $this->archieve->get_single_where(array('berkas.id' => $archieve, 'berkas.nomor_skpd' => $company));
          if (empty($archieve)) {
               show_error('Data tidak dapat ditemukan! Silahkan coba kembali.');
               die;
          }

          // if (file_exists('./assets/upload/berkas/' . $archieves->tte_dokumen)) {
          //      $archieves->tte_dokumen  = base_url('assets/upload/berkas/' . $archieves->tte_dokumen);
          // }

          $data['archieve']   = $archieves;

          // echo json_encode($data);
          // die;
          $this->frontend('v2/frontend/archieves/detail', $data);
     }

     public function inventory()
     {
          $data['title']      = 'Inventaris Arsip';
          $data['companies']  = $this->company->get_all_where();

          $this->frontend('v2/frontend/archieves/inventory', $data);
     }

     public function detail_inv()
     {
          if (empty($_GET)) {
               redirect('v2/frontend/archieves/inventory');
          }

          $data['title']      = 'Detail Inventaris Arsip';

          $id                 = $this->encryption->decrypt($this->input->get('archieve'));
          $klasifikasi        = $this->input->get('kode');
          $skpd               = $this->input->get('company');

          if (empty($id) or empty($skpd)) {
               show_error('Mohon pilih arsip terlebih dahulu! Silahkan coba kembali.');
               die;
          }

          $where              = array(
               'berkas.id'           => $id,
               'berkas.nomor_skpd'   => $skpd
          );

          if (!empty($klasifikasi)) {
               $where['berkas.kode_klsf'] = $klasifikasi;
          }

          $archieve           = $this->archieve->get_single_where($where);
          if (empty($archieve)) {
               show_error('Terjadi kesalahan saat mencari data arsip...');
               die;
          }

          $data['archieve']   = $archieve;

          $this->frontend('v2/frontend/archieves/detail_inventory', $data);
     }

     public function guide()
     {
          $data['title']      = 'Guide Arsip';

          $search             = $this->input->get('title');
          $limits             = 12;
          $pages              = (!empty($this->input->get('pages'))) ? ($this->input->get('pages') - 1) * $limits : 0;

          $where              = array(
               'limits'        => $limits,
               'starts'        => $pages
          );

          if (!empty($search)) {
               $where['search']         = $search;
          }

          $this->load->library('pagination');
          $config['per_page']           = $where['limits'];
          $config['base_url']           = base_url('v2/frontend/archieves/guide');
          $config['total_rows']         = $this->guide_archieve->get_all_where_count($where);
          $this->pagination->initialize($config);

          $data['guides']            = $this->guide_archieve->get_all_where($where);
          $data['guides_total']      = $config['total_rows'];
          $data['pagination']           = $this->pagination->create_links();

          $this->frontend('v2/frontend/archieves/guide', $data);
     }

     public function get_guide_json()
     {
          if ($this->input->method() != 'post') {
               echo json_encode(array('status' => 403, 'message' => 'Cant access this request!'));
               die;
          }

          $id       = $this->input->post('guide');
          $file     = $this->input->post('file');

          if (empty($_POST)) {
               echo json_encode(array('status' => 403, 'message' => 'Please select data first!'));
               die;
          }

          $where    = array(
               'id'      => $this->encryption->decrypt($id),
               'file'    => $file
          );

          $guide         = $this->guide_archieve->get_single_where($where);
          if (empty($guide)) {
               echo json_encode(array('status' => 404, 'message' => 'Dokumen guide arsip tidak dapat ditemukan!', 'data' => null));
          } else {
               echo json_encode(array('status' => 200, 'message' => 'Dokumen guide arsip berhasil ditemukan', 'data' => $guide));
          }
     }

     public function get_inventories_json()
     {
          if ($this->input->method() != 'post') {
               show_error('Post Request Only!', 405);
               die;
          }

          $columns        = array(
               0 => 'id',
               1 => 'kode_klsf',
               2 => 'indek',
               3 => 'tahun',
               4 => 'nomor_skpd',
               5 => 'jenis_arsip',
          );

          $limit      = $this->input->post('length');
          $start      = $this->input->post('start');
          $order      = (!empty($this->input->post('order'))) ? $columns[$this->input->post('order')[0]['column']] : "id";
          $dir        = (!empty($this->input->post('order'))) ? $this->input->post('order')[0]['dir'] : "asc";
          $search     = $this->input->post('search');
          $company    = $this->input->post('company');

          $where      = array(
               'starts'    => $start,
               'limits'    => $limit,
               'orders'    => 'berkas.' . $order,
               'dirs'      => $dir,
          );

          if (!empty($company)) {
               $where['berkas.nomor_skpd'] = $company;
          }

          $total_rows         = $this->archieve->get_all_where_count($where);
          $total_filtered     = $total_rows;

          if (!empty($search)) {
               $where['search']    = $search;
               $total_filtered     = $this->archieve->get_all_where_count($where);
          }

          $data               = array();
          $archieves          = $this->archieve->get_all_where($where);
          if (!empty($archieves)) {
               foreach ($archieves as $archieve) {
                    $nested['id']                 = $this->encryption->encrypt($archieve->id);
                    $nested['klasifikasi']        = $archieve->kode_klsf ?? '-';
                    $nested['indeks']             = $archieve->indek ?? '-';
                    $nested['tahun']              = $archieve->tahun ?? '-';
                    $nested['skpd']               = (!empty($archieve->name)) ? $archieve->name : (!empty($archieve->unit_kerja_pencipta) ? $archieve->unit_kerja_pencipta : '-');
                    if ($archieve->jenis_arsip == 'vital') {
                         $nested['jenis']    = 'Arsip Vital';
                    } else if ($archieve->jenis_arsip == 'usul_serah') {
                         $nested['jenis']    = 'Arsip Usul Serah';
                    } else {
                         $nested['jenis']    = '-';
                    }

                    $params                       = array(
                         'archieve'          => $nested['id'],
                         'code'              => $nested['klasifikasi'],
                         'company'           => $archieve->nomor_skpd
                    );
                    $nested['actions']            = '<a class="site-button radius-md" href="' . base_url("v2/frontend/archieves/detail_inv?") . http_build_query($params) . '"><i class="ti-eye"></i></a>';

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
}
