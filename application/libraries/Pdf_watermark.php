<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdf_Watermark
{
     public $mpdf;

     public function set_watermark($source, $output)
     {
          if (!file_exists($source)) {
               log_message('error', 'Watermark Error: Source PDF file not found at ' . $source);
               return false;
          }

          // 2. Instantiate mPDF without predefined canvas sizes
          $this->mpdf = new \Mpdf\Mpdf([
               'mode' => 'utf-8',
               'tempDir' => APPPATH . 'cache/'
          ]);
          // $this->mpdf = new \Mpdf\Mpdf();

          try {
               $watermark_img = FCPATH . 'assets/v3/backend/images/watermarks/sumedang.png';
               $this->mpdf->SetWatermarkImage(
                    $watermark_img,
                    0.15,         // Opacity level (15% visibility)
                    [75, 75],          // 'D' maintains natural logo dimensions safely
                    'F'           // 'F' centers it horizontally and vertically on the canvas
               );
               $this->mpdf->showWatermarkImage = true;

               // 3. Ambil file PDF yang sudah ditandatangani sebagai template
               $pageCount = $this->mpdf->setSourceFile($source);

               for ($i = 1; $i <= $pageCount; $i++) {
                    $templateId = $this->mpdf->importPage($i);

                    // Ambil ukuran asli halaman
                    $size = $this->mpdf->getTemplateSize($templateId);

                    // Tambahkan halaman baru sesuai ukuran asli
                    $this->mpdf->AddPageByArray([
                         'orientation' => $size['orientation'],
                         'sheet-size' => [
                              $size['width'],
                              $size['height']
                         ],
                         'margin-left'   => 0,
                         'margin-right'  => 0,
                         'margin-top'    => 0,
                         'margin-bottom' => 0,
                    ]);

                    // Tempel template memenuhi halaman
                    $this->mpdf->useTemplate(
                         $templateId,
                         0,
                         0,
                         $size['width'],
                         $size['height'],
                         true
                    );
               }

               // 6. Output and save the structural changes
               $this->mpdf->Output($output, \Mpdf\Output\Destination::FILE);

               if (file_exists($output) && filesize($output) > 0) {
                    return true;
               }

               return false;
          } catch (\Mpdf\MpdfException $e) {
               log_message('error', 'mPDF Error: ' . $e->getMessage());
               return false;
          } catch (\Throwable $e) {
               log_message('error', 'Watermark PDF Error: ' . $e->getMessage());
               return false;
          }
     }
}
