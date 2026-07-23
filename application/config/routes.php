<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Frontend Routes
$route['v2']                                 = 'home';
$route['v2/inventory/detail']                = 'archieves/inventory_detail';

// Data Umum Routes

// PROFILES COMPANY
$route['v2/profiles/list']                   = 'profiles/list';

// ARTICLES Routes
$route['v2/articles']                        = 'news/articles';
$route['v2/articles/detail']                 = 'news/articles_detail';
$route['v2/articles/list']                   = 'news/articles_list';
$route['v2/articles/list/ajax']              = 'news/articles_list_ajax';
$route['v2/articles/manage/edit/(:num)']     = 'news/articles_edit/$1';
$route['v2/articles/manage/add']             = 'news/articles_add';
$route['v2/articles/manage/update']          = 'news/articles_update';
$route['v2/articles/manage/delete/(:num)']   = 'news/articles_delete/$1';

// NEWS Routes
$route['v2/news/list']                       = 'news/list';
$route['v2/news/list/ajax']                  = 'news/list_ajax';
$route['v2/news/manage/edit/(:num)']         = 'news/edit/$1';
$route['v2/news/manage/add']                 = 'news/add';
$route['v2/news/manage/update']              = 'news/update';
$route['v2/news/manage/delete/(:num)']       = 'news/delete/$1';

// GUIDE ARSIP Routes
$route['v2/guides/list']                     = 'archieves/guide_list';
$route['v2/guides/list/ajax']                = 'archieves/guide_list_ajax';
$route['v2/guides/manage/edit/(:num)']       = 'archieves/guide_edit/$1';
$route['v2/guides/manage/add']               = 'archieves/guide_add';
$route['v2/guides/manage/update']            = 'archieves/guide_update';
$route['v2/guides/manage/delete/(:num)']     = 'archieves/guide_delete/$1';

// REGULATIONS Routes
$route['v2/regulations/list']                = 'regulations/list';

// Alih Media Routes
$route['v2/backend/alih_media_arsip_usul_serah']                                = 'backend/AlihMediaArsipUsulSerahs/index';
$route['v2/backend/alih_media_arsip_usul_serah/tambah']                         = 'backend/AlihMediaArsipUsulSerahs/tambah';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_list']                      = 'backend/AlihMediaArsipUsulSerahs/ajax_list';
$route['v2/backend/alih_media_arsip_usul_serah/export_excel']                   = 'backend/AlihMediaArsipUsulSerahs/export_excel';
$route['v2/backend/alih_media_arsip_usul_serah/export_pdf']                     = 'backend/AlihMediaArsipUsulSerahs/export_pdf';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_add']                       = 'backend/AlihMediaArsipUsulSerahs/ajax_add';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_upload_pdf']                = 'backend/AlihMediaArsipUsulSerahs/ajax_upload_pdf';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_verify_tte']                = 'backend/AlihMediaArsipUsulSerahs/ajax_verify_tte';
$route['v2/backend/alih_media_arsip_usul_serah/detail/(:num)']                  = 'backend/AlihMediaArsipUsulSerahs/detail/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_penilaian/(:num)']          = 'backend/AlihMediaArsipUsulSerahs/ajax_penilaian/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_verifikasi/(:num)']         = 'backend/AlihMediaArsipUsulSerahs/ajax_verifikasi/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_tte/(:num)']                = 'backend/AlihMediaArsipUsulSerahs/ajax_tte/$1';
$route['v2/backend/alih_media_arsip_usul_serah/tanda_tangan']                   = 'backend/AlihMediaArsipUsulSerahs/tanda_tangan';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_tte_list']                  = 'backend/AlihMediaArsipUsulSerahs/ajax_tte_list';
$route['v2/backend/alih_media_arsip_usul_serah/edit/(:num)']                    = 'backend/AlihMediaArsipUsulSerahs/edit/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_edit/(:num)']               = 'backend/AlihMediaArsipUsulSerahs/ajax_edit/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_update/(:num)']             = 'backend/AlihMediaArsipUsulSerahs/ajax_update/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_delete/(:num)']             = 'backend/AlihMediaArsipUsulSerahs/ajax_delete/$1';
$route['v2/backend/alih_media_arsip_usul_serah/view_pdf/(:num)']                = 'backend/AlihMediaArsipUsulSerahs/view_pdf/$1';
$route['v2/backend/alih_media_arsip_usul_serah/baca_dokumen/(:num)']            = 'backend/AlihMediaArsipUsulSerahs/baca_dokumen/$1';

// Berita Acara (BAST) Routes
$route['v2/backend/alih_media_arsip_usul_serah/berita_acara']                    = 'backend/AlihMediaArsipUsulSerahs/berita_acara';
$route['v2/backend/alih_media_arsip_usul_serah/tambah_berita_acara']             = 'backend/AlihMediaArsipUsulSerahs/tambah_berita_acara';
$route['v2/backend/alih_media_arsip_usul_serah/detail_berita_acara/(:num)']      = 'backend/AlihMediaArsipUsulSerahs/detail_berita_acara/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_list_berita_acara']          = 'backend/AlihMediaArsipUsulSerahs/ajax_list_berita_acara';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_add_berita_acara']           = 'backend/AlihMediaArsipUsulSerahs/ajax_add_berita_acara';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_delete_berita_acara/(:num)'] = 'backend/AlihMediaArsipUsulSerahs/ajax_delete_berita_acara/$1';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_link_berkas']                = 'backend/AlihMediaArsipUsulSerahs/ajax_link_berkas';
$route['v2/backend/alih_media_arsip_usul_serah/ajax_unlink_berkas/(:num)/(:num)'] = 'backend/AlihMediaArsipUsulSerahs/ajax_unlink_berkas/$1/$2';

// Verifikasi Dokumen Publik Route
$route['v2/frontend/verifikasi_dokumen/index/(:num)']                           = 'frontend/VerifikasiDokumen/index/$1';

// Alih Media Arsip Vital Route
$route['v2/alih_media_arsip_vital']                                             = 'archieves/vital_list';
$route['v2/alih_media_arsip_vital/add']                                         = 'archieves/vital_add';
$route['v2/alih_media_arsip_vital/save']                                        = 'archieves/vital_save';
$route['v2/alih_media_arsip_vital/detail']                                      = 'archieves/vital_detail';
$route['v2/alih_media_arsip_vital/edit']                                        = 'archieves/vital_edit';
$route['v2/alih_media_arsip_vital/delete']                                      = 'archieves/vital_delete';
$route['v2/alih_media_arsip_vital/signed']                                      = 'archieves/vital_signed';
$route['v2/alih_media_arsip_vital/verification']                                = 'archieves/vital_verification';
$route['v2/alih_media_arsip_vital/resend']                                      = 'archieves/vital_resend';
$route['v2/alih_media_arsip_vital/view_pdf']                                    = 'archieves/view_pdf';
$route['v2/alih_media_arsip_vital/baca_dokumen']                                = 'archieves/baca_dokumen';
$route['v2/alih_media_arsip_vital/upload_pdf']                                  = 'archieves/upload_pdf_temp';
$route['v2/alih_media_arsip_vital/berita_acara']                                = 'archieves/berita_acara';
$route['v2/alih_media_arsip_vital/berita_acara_add']                            = 'archieves/berita_acara_add';
$route['v2/alih_media_arsip_vital/berita_acara_save']                           = 'archieves/berita_acara_save';
$route['v2/alih_media_arsip_vital/bast_detail']                                 = 'archieves/berita_acara_detail';
$route['v2/alih_media_arsip_vital/get_bast_json']                               = 'archieves/get_bast_json';
$route['v2/alih_media_arsip_vital/get_bast_linked_json']                        = 'archieves/get_bast_linked_json';
$route['v2/alih_media_arsip_vital/get_archieve_not_exists_bast']                = 'archieves/get_archieve_not_exist_bast';
$route['v2/alih_media_arsip_vital/berita_acara_detail_save']                    = 'archieves/berita_acara_detail_save';
$route['v2/alih_media_arsip_vital/berita_acara_detail_unlink']                  = 'archieves/berita_acara_detail_unlink';
$route['v2/alih_media_arsip_vital/berita_acara_deleted']                        = 'archieves/berita_acara_delete';
$route['v2/alih_media_arsip_statis']                                            = 'archieves/statis_list';
$route['v2/alih_media_arsip_statis/add']                                        = 'archieves/statis_add';
$route['v2/alih_media_arsip_vital/export']                                      = 'archieves/vital_export';
$route['v2/alih_media_arsip_vital/verify_tte']                                  = 'archieves/vital_verify_tte';
