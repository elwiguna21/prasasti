<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class ExportPdf
{
     public function generate($html, $filename = '', $stream = TRUE, $paper = 'F4', $orientation = "portrait")
     {
          $options = new Options();
          $options->set('isRemoteEnabled', TRUE); // Allows loading external CSS/images
          $options->set('isHtml5ParserEnabled', true);

          $dompdf = new Dompdf($options);
          $dompdf->loadHtml($html);
          $dompdf->setPaper($paper, $orientation);
          $dompdf->render();

          if ($stream) {
               $dompdf->stream($filename . ".pdf", array("Attachment" => 1)); // 1 = Download, 0 = Preview
          } else {
               return $dompdf->output();
          }
     }
}
