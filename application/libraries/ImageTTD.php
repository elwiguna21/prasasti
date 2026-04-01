<?php

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

defined('BASEPATH') or exit('No direct script access allowed');

class ImageTTD
{

    /**
     * Word-wrap text rendering pada GD image
     */
    function wrapimagettftext($img, $fontSize, $drawFrame, $textColor, $fontType, $text, $lineHeight = '', $wordSpacing = '', $hAlign = 0, $vAlign = 0)
    {
        if ($wordSpacing === ' ' || $wordSpacing === '') {
            $size = imagettfbbox($fontSize, 0, $fontType, ' ');
            $wordSpacing = abs($size[4] - $size[0]);
        }
        $size = imagettfbbox($fontSize, 0, $fontType, 'Zltfgyjp');
        $baseHeight = abs($size[5] - $size[1]);
        $size = imagettfbbox($fontSize, 0, $fontType, 'Zltf');
        $topHeight = abs($size[5] - $size[1]);

        if ($lineHeight === '' || $lineHeight === '') {
            $lineHeight = $baseHeight * 110 / 100;
        } else if (is_string($lineHeight) && $lineHeight[strlen($lineHeight) - 1] === '%') {
            $lineHeight = floatVal(substr($lineHeight, 0, -1));
            $lineHeight = $baseHeight * $lineHeight / 100;
        }

        $usableWidth = $drawFrame[2] - $drawFrame[0];
        $usableHeight = $drawFrame[3] - $drawFrame[1];
        $leftX = $drawFrame[0];
        $centerX = $drawFrame[0] + $usableWidth / 2;
        $rightX = $drawFrame[0] + $usableWidth;
        $topY = $drawFrame[1];
        $centerY = $drawFrame[1] + $usableHeight / 2;
        $bottomY = $drawFrame[1] + $usableHeight;
        $text = explode(" ", $text);
        $line_w = -$wordSpacing;
        $line_h = 0;
        $total_w = 0;
        $total_h = 0;
        $total_lines = 0;
        $toWrite = array();
        $pendingLastLine = array();
        for ($i = 0; $i < count($text); $i++) {
            $size = imagettfbbox($fontSize, 0, $fontType, $text[$i]);

            $width = abs($size[4] - $size[0]);
            $height = abs($size[5] - $size[1]);

            $x = -$size[0] - $width / 2;
            $y = $size[1] + $height / 2;

            if ($line_w + $wordSpacing + $width > $usableWidth) {
                $lastLineW = $line_w;
                $lastLineH = $line_h;

                if ($total_w < $lastLineW) $total_w = $lastLineW;
                $total_h += $lineHeight;

                foreach ($pendingLastLine as $aPendingWord) {

                    if ($hAlign < 0) $tx = $leftX + $aPendingWord['tx'];
                    else if ($hAlign > 0) $tx = $rightX - $lastLineW + $aPendingWord['tx'];
                    else if ($hAlign == 0) $tx = $centerX - $lastLineW / 2 + $aPendingWord['tx'];

                    $toWrite[] = array('line' => $total_lines, 'x' => $tx, 'y' => $total_h, 'txt' => $aPendingWord['txt']);
                }
                $pendingLastLine = array();

                $total_lines++;
                $line_w = $width;
                $line_h = $height;

                $pendingLastLine[] = array('tx' => 0, 'w' => $width, 'h' => $height, 'x' => $x, 'y' => $y, 'txt' => $text[$i]);
            } else {

                $line_w += $wordSpacing;
                $pendingLastLine[] = array('tx' => $line_w, 'h' => $width, 'w' => $height, 'x' => $x, 'y' => $y, 'txt' => $text[$i]);
                $line_w += $width;
                if ($line_h < $height) $line_h = $height;
            }
        }
        $lastLineW = $line_w;
        $lastLineH = $line_h;
        if ($total_w < $lastLineW) $total_w = $lastLineW;
        $total_h += $lineHeight;
        foreach ($pendingLastLine as $aPendingWord) {

            if ($hAlign < 0) $tx = $leftX + $aPendingWord['tx'];
            else if ($hAlign > 0) $tx = $rightX - $lastLineW + $aPendingWord['tx'];
            else if ($hAlign == 0) $tx = $centerX - $lastLineW / 2 + $aPendingWord['tx'];

            $toWrite[] = array('line' => $total_lines, 'x' => $tx, 'y' => $total_h, 'txt' => $aPendingWord['txt']);
        }
        $pendingLastLine = array();
        $total_lines++;

        $total_h += $lineHeight - $topHeight;
        $last_y = 0;
        foreach ($toWrite as $aWord) {

            $posx = $aWord['x'];

            if ($vAlign < 0) $posy = $topY + $aWord['y'];
            else if ($vAlign > 0) $posy = $bottomY - $total_h + $aWord['y'];
            else if ($vAlign == 0) $posy = $centerY - $total_h / 2 + $aWord['y'];

            imagettftext($img, $fontSize, 0, $posx, $posy, $textColor, $fontType, $aWord['txt']);

            $last_y = $posy;
        }
        return $last_y;
    }

    /**
     * Generate gambar TTE (PNG) berisi frame, nama, NIP, jabatan, QR code
     *
     * @param  string $nama      Nama lengkap penanda tangan
     * @param  string $nip       NIP penanda tangan
     * @param  string $jabatan   Jabatan penanda tangan
     * @param  string $qr_string URL untuk QR code (link verifikasi)
     * @param  string $tanggal   Tanggal TTE (format Y-m-d)
     * @return string            Base64 encoded PNG image
     */
    function generate($nama, $nip, $jabatan, $qr_string = '', $tanggal = '')
    {
        $template = 'frame.png';
        $img_width = 726;
        $img_height = 264;
        $y_judul = 65;
        $y_nama = 90;
        $y_nip = 130;
        $y_jabatan = 100;
        $min_jabatan = 60;
        $x_tgl = 577.5;
        $y_tgl = 30;
        $y_qr = 40;

        $jpg_image = imagecreatefrompng(APPPATH . 'libraries/image_ttd/' . $template);
        $targetImage = imagecreatetruecolor($img_width, $img_height);
        imagealphablending($targetImage, false);
        imagesavealpha($targetImage, true);

        $black = imagecolorallocate($jpg_image, 0, 0, 0);
        $font_path = APPPATH . 'libraries/image_ttd/times.ttf';

        // Teks "Ditandatangani secara elektronik oleh :"
        $text = "Ditandatangani secara elektronik oleh :";
        imagettftext($jpg_image, 12, 0, 145, $y_judul, $black, $font_path, $text);

        // Nama (bold)
        $drawFrame = array(145, $y_nama, $img_width - 10, $img_height - 100);
        $fontType = APPPATH . 'libraries/image_ttd/times_b.ttf';
        $fontSize = 16;
        $hAlign = -1; // left
        $vAlign = -1; // top
        $ly = $this->wrapimagettftext($jpg_image, $fontSize, $drawFrame, $black, $fontType, $nama, '120%', ' ', $hAlign, $vAlign);

        $font_path = APPPATH . 'libraries/image_ttd/times.ttf';

        // NIP
        imagettftext($jpg_image, 16, 0, 145, $ly + 25, $black, $font_path, "NIP. " . $nip);

        // Jabatan
        $drawFrame = array(145, $y_jabatan, $img_width - 10, $img_height - $min_jabatan);
        $fontType = APPPATH . 'libraries/image_ttd/times.ttf';
        $fontSize = 12;
        $hAlign = -1; // left
        $vAlign = 1;  // bottom
        $ly = $this->wrapimagettftext($jpg_image, $fontSize, $drawFrame, $black, $fontType, $jabatan, '120%', ' ', $hAlign, $vAlign);

        // Tanggal
        if (!empty($tanggal)) {
            $fontType = APPPATH . 'libraries/image_ttd/times_b.ttf';
            // Format tanggal pendek
            $tgl_formatted = $this->formatTanggalShort($tanggal);
            imagettftext($jpg_image, 12, 0, $x_tgl, $y_tgl, $black, $fontType, strtoupper($tgl_formatted));
        }

        // QR Code
        if (!empty($qr_string)) {
            $logoPath = FCPATH . 'assets/images/bsre.png';
            $builderParams = Builder::create()
                ->writer(new PngWriter())
                ->writerOptions([])
                ->data($qr_string)
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                ->size(187)
                ->margin(0)
                ->roundBlockSizeMode(new RoundBlockSizeModeMargin());

            // Tambahkan logo hanya jika file ada
            if (file_exists($logoPath)) {
                $builderParams = $builderParams
                    ->logoPath($logoPath)
                    ->logoResizeToWidth(50);
            }

            $buildQR = $builderParams
                ->validateResult(false)
                ->build();

            $string_qr = $buildQR->getString();
            list($width, $height) = getimagesizefromstring($string_qr);
            $image2 = imagecreatefromstring($string_qr);
            imagecopymerge($jpg_image, $image2, 526, $y_qr, 0, 0, $width, $height, 100);
        }

        imagecopyresampled(
            $targetImage,
            $jpg_image,
            0, 0, 0, 0,
            $img_width, $img_height,
            $img_width, $img_height
        );

        ob_start();
        imagepng($targetImage, null, 9);
        $base_64_ttd = base64_encode(ob_get_clean());
        imagedestroy($targetImage);
        return $base_64_ttd;
    }

    /**
     * Format tanggal ke format pendek Indonesia (contoh: 03 MAR 2026)
     */
    private function formatTanggalShort($tanggal)
    {
        $bulan = array(
            1 => 'JAN', 2 => 'FEB', 3 => 'MAR', 4 => 'APR',
            5 => 'MEI', 6 => 'JUN', 7 => 'JUL', 8 => 'AGU',
            9 => 'SEP', 10 => 'OKT', 11 => 'NOV', 12 => 'DES'
        );
        $tgl = date('d', strtotime($tanggal));
        $bln = (int) date('m', strtotime($tanggal));
        $thn = date('Y', strtotime($tanggal));
        return $tgl . ' ' . ($bulan[$bln] ?? '') . ' ' . $thn;
    }
}
