<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Archieves extends MY_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('v2/Archieve', 'archieve');
          $this->load->model('v2/Company', 'company');
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

          $this->load->library('pagination');
          $config['per_page']           = $where['limits'];
          $config['base_url']           = base_url('v2/frontend/archieves');
          $config['total_rows']         = $this->archieve->get_all_where_count($where);
          $this->pagination->initialize($config);

          $data['archieves']            = $this->archieve->get_all_where($where);
          $data['archieves_total']      = $config['total_rows'];
          $data['pagination']           = $this->pagination->create_links();

          $this->frontend('v2/frontend/archieves/static', $data);
     }

     public function detail()
     {
          $data['title']      = 'Detail Arsip';

          $archieve           = $this->input->get('archieve');
          $company            = $this->input->get('company');

          if (empty($archieve) or empty($company)) {
               redirect('v2/frontend/archieves');
          }

          $archieves          = $this->archieve->get_single_where(array('berkas.id' => $archieve, 'berkas.nomor_skpd' => $company));
          if (empty($archieve)) {
               show_error('Cant find a data request');
               die;
          }

          $data['archieve']   = $archieves;

          $this->frontend('v2/frontend/archieves/detail', $data);
     }

     public function inventory()
     {
          $data['title']      = 'Inventaris Arsip';

          $this->frontend('v2/frontend/archieves/inventory', $data);
     }

     public function guide()
     {
          $data['title']      = 'Guide Arsip';

          $this->frontend('v2/frontend/archieves/guide', $data);
     }
}
