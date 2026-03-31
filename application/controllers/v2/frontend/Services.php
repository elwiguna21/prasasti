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

          $this->frontend('v2/frontend/service', $data);
     }

     public function add()
     {
          if (empty($_POST)) {
               show_error('Please fill a form and try again!', 403);
               die;
          }

          $bytes_length = ceil(8 / 2);
          try {
               $bytes = random_bytes($bytes_length); // Get cryptographically secure random bytes
          } catch (Exception $e) {
               // Handle exceptions in case of an error (e.g., no secure source of randomness available)
               // For older PHP versions, a polyfill can be used
               die("Could not generate random bytes: " . $e->getMessage());
          }
          $hex_string = bin2hex($bytes); // Convert to hexadecimal string (doubles the length)
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
                    redirect('v2/frontend/services');
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

          redirect('v2/frontend/services');
     }
}
