<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// $route['v2']                    = 'v2/backend/dashboards';
$route['v2']                    = 'v2/frontend/home';

// Alih Media Routes
$route['v2/backend/alih_media_arsip_usul_serah']                                = 'v2/backend/AlihMediaArsipUsulSerahs/index';
$route['v2/backend/alih_media_arsip_usul_serah/tambah']                         = 'v2/backend/AlihMediaArsipUsulSerahs/tambah';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_list']                      = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_list';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_add']                       = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_add';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_upload_pdf']                = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_upload_pdf';
$route['v2/backend/alih_media_arsip_usul_serah/detail/(:num)']                  = 'v2/backend/AlihMediaArsipUsulSerahs/detail/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_penilaian/(:num)']          = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_penilaian/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_verifikasi/(:num)']         = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_verifikasi/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_tte/(:num)']                = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_tte/$1';
$route['v2/backend/alih_media_arsip_usul_serah/tanda_tangan']                   = 'v2/backend/AlihMediaArsipUsulSerahs/tanda_tangan';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_tte_list']                  = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_tte_list';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_edit/(:num)']               = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_edit/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_update/(:num)']             = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_update/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_delete/(:num)']             = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_delete/$1';
$route['v2/backend/alih_media_arsip_usul_serah/view_pdf/(:num)']                = 'v2/backend/AlihMediaArsipUsulSerahs/view_pdf/$1';

// Berita Acara (BAST) Routes
$route['v2/backend/alih_media_arsip_usul_serah/berita_acara']                    = 'v2/backend/AlihMediaArsipUsulSerahs/berita_acara';
$route['v2/backend/alih_media_arsip_usul_serah/tambah_berita_acara']             = 'v2/backend/AlihMediaArsipUsulSerahs/tambah_berita_acara';
$route['v2/backend/alih_media_arsip_usul_serah/detail_berita_acara/(:num)']      = 'v2/backend/AlihMediaArsipUsulSerahs/detail_berita_acara/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_list_berita_acara']          = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_list_berita_acara';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_add_berita_acara']           = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_add_berita_acara';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_delete_berita_acara/(:num)'] = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_delete_berita_acara/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_link_berkas']                = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_link_berkas';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_unlink_berkas/(:num)/(:num)']= 'v2/backend/AlihMediaArsipUsulSerahs/ajax_unlink_berkas/$1/$2';

// Verifikasi Dokumen Publik Route
$route['v2/frontend/verifikasi_dokumen/index/(:num)']                           = 'v2/frontend/VerifikasiDokumen/index/$1';
