<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['use_page_numbers']     = TRUE;
$config['page_query_string']    = TRUE;
$config['query_string_segment'] = 'pages';
$config['reuse_query_string']      = TRUE;
$config['attributes']['rel']    = FALSE;

// $config['full_tag_open']        = '<div class="pagination-bx clearfix text-center"><ul class="pagination justify-content-center">';
// $config['full_tag_close']       = '</ul></div>';
// $config['first_tag_open']       = '<li class="first">';
// $config['first_link']           = '<i class="ti-angle-double-left"></i> First';
// $config['first_tag_close']      = '</li>';
// $config['prev_tag_open']        = '<li class="previous">';
// $config['prev_link']            = '<i class="ti-arrow-left"></i> Prev';
// $config['prev_tag_close']       = '</li>';
// $config['next_tag_open']        = '<li class="next">';
// $config['next_link']            = 'Next <i class="ti-arrow-right"></i>';
// $config['next_tag_close']       = '</li>';
// $config['last_tag_open']        = '<li class="last">';
// $config['last_link']            = 'Last <i class="ti-angle-double-right"></i>';
// $config['last_tag_close']       = '</li>';
// $config['cur_tag_open']         = '<li class="active"><a href="javascript:void(0);">';
// $config['cur_tag_close']        = '</a></li>';
// $config['num_tag_open']         = '<li class="">';
// $config['num_tag_close']        = '</li>';

$config['full_tag_open']        = '<ul class="softora-pagination list-unstyled justify-content-start">';
$config['full_tag_close']       = '</ul>';
$config['first_tag_open']       = '<li class="first">';
$config['first_link']           = '<i class="ti ti-angle-double-left"></i> First';
$config['first_tag_close']      = '</li>';
$config['prev_tag_open']        = '<li class="previous">';
$config['prev_link']            = '<i class="ti ti-chevron-left"></i>';
$config['prev_tag_close']       = '</li>';
$config['next_tag_open']        = '<li class="next">';
$config['next_link']            = '<i class="ti ti-chevron-right"></i>';
$config['next_tag_close']       = '</li>';
$config['last_tag_open']        = '<li class="last">';
$config['last_link']            = '<i class="ti ti-angle-double-right"></i>';
$config['last_tag_close']       = '</li>';
$config['cur_tag_open']         = '<li class="active"><a href="javascript:void(0);">';
$config['cur_tag_close']        = '</a></li>';
$config['num_tag_open']         = '<li class="">';
$config['num_tag_close']        = '</li>';

$config['attributes']           = array('class' => 'magnet-link');
