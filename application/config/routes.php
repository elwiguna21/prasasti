<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Frontend Routes
$route['v2']                                 = 'v2/home';
$route['v2/inventory/detail']                = 'v2/archieves/inventory_detail';

// Data Umum Routes

// PROFILES COMPANY
$route['v2/profiles/list']                   = 'v2/profiles/list';

// ARTICLES Routes
$route['v2/articles']                        = 'v2/news/articles';
$route['v2/articles/detail']                 = 'v2/news/articles_detail';
$route['v2/articles/list']                   = 'v2/news/articles_list';
$route['v2/articles/list/ajax']              = 'v2/news/articles_list_ajax';
$route['v2/articles/manage/edit/(:num)']     = 'v2/news/articles_edit/$1';
$route['v2/articles/manage/add']             = 'v2/news/articles_add';
$route['v2/articles/manage/update']          = 'v2/news/articles_update';
$route['v2/articles/manage/delete/(:num)']   = 'v2/news/articles_delete/$1';

// NEWS Routes
$route['v2/news/list']                       = 'v2/news/list';
$route['v2/news/list/ajax']                  = 'v2/news/list_ajax';
$route['v2/news/manage/edit/(:num)']         = 'v2/news/edit/$1';
$route['v2/news/manage/add']                 = 'v2/news/add';
$route['v2/news/manage/update']              = 'v2/news/update';
$route['v2/news/manage/delete/(:num)']       = 'v2/news/delete/$1';

// GUIDE ARSIP Routes
$route['v2/guides/list']                     = 'v2/archieves/guide_list';
$route['v2/guides/list/ajax']                = 'v2/archieves/guide_list_ajax';
$route['v2/guides/manage/edit/(:num)']       = 'v2/archieves/guide_edit/$1';
$route['v2/guides/manage/add']               = 'v2/archieves/guide_add';
$route['v2/guides/manage/update']            = 'v2/archieves/guide_update';
$route['v2/guides/manage/delete/(:num)']     = 'v2/archieves/guide_delete/$1';

// REGULATIONS Routes
$route['v2/regulations/list']                = 'v2/regulations/list';

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
$route['v2/backend/alih_media_arsip_usul_serah/ajax_unlink_berkas/(:num)/(:num)'] = 'v2/backend/AlihMediaArsipUsulSerahs/ajax_unlink_berkas/$1/$2';

// Verifikasi Dokumen Publik Route
$route['v2/frontend/verifikasi_dokumen/index/(:num)']                           = 'v2/frontend/VerifikasiDokumen/index/$1';

// Alih Media Arsip Vital Route
$route['v2/alih_media_arsip_vital']                                     = 'v2/archieves/vital_list';
$route['v2/alih_media_arsip_vital/add']                                 = 'v2/archieves/vital_add';
$route['v2/alih_media_arsip_vital/save']                                = 'v2/archieves/vital_save';
$route['v2/alih_media_arsip_vital/detail']                              = 'v2/archieves/vital_detail';
$route['v2/alih_media_arsip_vital/edit']                                = 'v2/archieves/vital_edit';
$route['v2/alih_media_arsip_vital/delete']                              = 'v2/archieves/vital_delete';
$route['v2/alih_media_arsip_vital/signed']                              = 'v2/archieves/vital_signed';
$route['v2/alih_media_arsip_vital/verification']                        = 'v2/archieves/vital_verification';
$route['v2/alih_media_arsip_vital/resend']                              = 'v2/archieves/vital_resend';
$route['v2/alih_media_arsip_vital/view_pdf']                            = 'v2/archieves/view_pdf';
$route['v2/alih_media_arsip_vital/upload_pdf']                          = 'v2/archieves/upload_pdf_temp';
