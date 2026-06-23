<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . "/third_party/PHPExcel/PHPExcel.php";

class ExportExcel extends PHPExcel
{
     public function __construct()
     {
          parent::__construct();
     }
}
