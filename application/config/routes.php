<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// $route['v2']                    = 'v2/backend/dashboards';
$route['v2']                    = 'v2/frontend/home';
