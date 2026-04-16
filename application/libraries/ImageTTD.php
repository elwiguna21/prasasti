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
            $size        = imagettfbbox($fontSize, 0, $fontType, ' ');
            $wordSpacing = abs($size[4] - $size[0]);
        }
        $size       = imagettfbbox($fontSize, 0, $fontType, 'Zltfgyjp');
        $baseHeight = abs($size[5] - $size[1]);
        $size       = imagettfbbox($fontSize, 0, $fontType, 'Zltf');
        $topHeight  = abs($size[5] - $size[1]);

        if ($lineHeight === '' || $lineHeight === '') {
            $lineHeight = $baseHeight * 110 / 100;
        } else if (is_string($lineHeight) && $lineHeight[strlen($lineHeight) - 1] === '%') {
            $lineHeight = floatVal(substr($lineHeight, 0, -1));
            $lineHeight = $baseHeight * $lineHeight / 100;
        }

        $usableWidth  = $drawFrame[2] - $drawFrame[0];
        $usableHeight = $drawFrame[3] - $drawFrame[1];
        $leftX   = $drawFrame[0];
        $centerX = $drawFrame[0] + $usableWidth / 2;
        $rightX  = $drawFrame[0] + $usableWidth;
        $topY    = $drawFrame[1];
        $centerY = $drawFrame[1] + $usableHeight / 2;
        $bottomY = $drawFrame[1] + $usableHeight;

        $text            = explode(" ", $text);
        $line_w          = -$wordSpacing;
        $line_h          = 0;
        $total_w         = 0;
        $total_h         = 0;
        $total_lines     = 0;
        $toWrite         = array();
        $pendingLastLine = array();

        for ($i = 0; $i < count($text); $i++) {
            $size   = imagettfbbox($fontSize, 0, $fontType, $text[$i]);
            $width  = abs($size[4] - $size[0]);
            $height = abs($size[5] - $size[1]);
            $x      = -$size[0] - $width / 2;
            $y      = $size[1] + $height / 2;

            if ($line_w + $wordSpacing + $width > $usableWidth) {
                $lastLineW = $line_w;
                $lastLineH = $line_h;
                if ($total_w < $lastLineW) $total_w = $lastLineW;
                $total_h += $lineHeight;

                foreach ($pendingLastLine as $aPendingWord) {
                    if ($hAlign < 0)      $tx = $leftX + $aPendingWord['tx'];
                    else if ($hAlign > 0) $tx = $rightX - $lastLineW + $aPendingWord['tx'];
                    else                  $tx = $centerX - $lastLineW / 2 + $aPendingWord['tx'];
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
            if ($hAlign < 0)      $tx = $leftX + $aPendingWord['tx'];
            else if ($hAlign > 0) $tx = $rightX - $lastLineW + $aPendingWord['tx'];
            else                  $tx = $centerX - $lastLineW / 2 + $aPendingWord['tx'];
            $toWrite[] = array('line' => $total_lines, 'x' => $tx, 'y' => $total_h, 'txt' => $aPendingWord['txt']);
        }
        $pendingLastLine = array();
        $total_lines++;

        $total_h += $lineHeight - $topHeight;
        $last_y = 0;
        foreach ($toWrite as $aWord) {
            $posx = $aWord['x'];
            if ($vAlign < 0)      $posy = $topY + $aWord['y'];
            else if ($vAlign > 0) $posy = $bottomY - $total_h + $aWord['y'];
            else                  $posy = $centerY - $total_h / 2 + $aWord['y'];
            imagettftext($img, $fontSize, 0, $posx, $posy, $textColor, $fontType, $aWord['txt']);
            $last_y = $posy;
        }
        return $last_y;
    }

    /**
     * Render teks dengan underline di bawah baseline
     * Mengembalikan [ 'y_baseline' => int, 'width' => int ]
     */
    private function drawTextWithUnderline($canvas, $fontSize, $x, $y, $color, $fontPath, $text)
    {
        imagettftext($canvas, $fontSize, 0, $x, $y, $color, $fontPath, $text);
        $bbox  = imagettfbbox($fontSize, 0, $fontPath, $text);
        $tw    = abs($bbox[4] - $bbox[0]);
        $under = $y + 3;
        imageline($canvas, $x, $under, $x + $tw, $under, $color);
        imageline($canvas, $x, $under + 1, $x + $tw, $under + 1, $color);  // tebal 2px
        return array('y_baseline' => $y, 'width' => $tw);
    }

    /**
     * Generate gambar TTE (PNG) — layout sesuai referensi BSrE Sumedang:
     *
     * ┌──────────────┬──────────────────────────────────┐
     * │              │ Ditandatangani Secara Elektronik  │
     * │  LOGO BIRU   │ Oleh:                             │
     * │  SUMEDANG    │                                   │
     * │              │  **NAMA UPPERCASE + underline**   │
     * │              │  199203212020121005                │
     * │              │                                   │
     * │              │  Jabatan                          │
     * └──────────────┴──────────────────────────────────┘
     *
     * @param  string $nama
     * @param  string $nip
     * @param  string $jabatan
     * @param  string $qr_string  (opsional – jika diisi, QR kecil muncul pojok kanan bawah)
     * @param  string $tanggal    (opsional – format Y-m-d)
     * @return string             Base64 PNG
     */
    function generate($nama, $nip, $jabatan, $qr_string = '', $tanggal = '')
    {
        // ── Dimensi dari frame.png (711 × 199 px) ─────────────────────────────────
        $frame      = imagecreatefrompng(APPPATH . 'libraries/image_ttd/frame.png');
        $img_width  = imagesx($frame);   // 711
        $img_height = imagesy($frame);   // 199
        $logo_col_w = 128;               // lebar kolom logo biru

        // ── Canvas: background PUTIH ───────────────────────────────────────────────
        $canvas = imagecreatetruecolor($img_width, $img_height);
        $white  = imagecolorallocate($canvas, 255, 255, 255);
        $black  = imagecolorallocate($canvas, 0, 0, 0);
        $lgray  = imagecolorallocate($canvas, 200, 200, 200);
        imagefill($canvas, 0, 0, $white);

        // Copy logo biru dari frame (1:1, tanpa resize)
        imagecopy($canvas, $frame, 0, 0, 0, 0, $logo_col_w, $img_height);
        imagedestroy($frame);

        // Hapus border internal/ganda bawaan dari frame.png dengan meniban margin menggunakan warna putih
        imagefilledrectangle($canvas, 1, 1, 12, $img_height - 2, $white); // margin kiri
        imagefilledrectangle($canvas, 1, 1, $logo_col_w - 1, 9, $white);  // margin atas
        imagefilledrectangle($canvas, 1, $img_height - 11, $logo_col_w - 1, $img_height - 2, $white); // margin bawah

        // Border luar dan garis pemisah logo
        imagerectangle($canvas, 0, 0, $img_width - 1, $img_height - 1, $black);
        imageline($canvas, $logo_col_w, 0, $logo_col_w, $img_height - 1, $lgray);

        // ── Font ──────────────────────────────────────────────────────────────────
        $font_reg  = APPPATH . 'libraries/image_ttd/times.ttf';
        $font_bold = APPPATH . 'libraries/image_ttd/times_b.ttf';

        // ── Area teks: x mulai dari logo_col_w + padding ──────────────────────────
        // Jika ada QR, batas kanan teks disesuaikan agar tidak tabrakan
        $has_qr  = !empty($qr_string);
        $qr_col_x = 505;               // Kolom QR mulai dari sini
        $qr_col_w = $img_width - $qr_col_x;  // ~206px

        $tx  = $logo_col_w + 14;       // 142 — X awal teks
        $t_r = $has_qr ? ($qr_col_x - 10) : ($img_width - 14);  // batas kanan teks

        // ── 1. Label atas (size 13) ────────────────────────────────────────────────
        imagettftext($canvas, 13, 0, $tx, 30, $black, $font_reg,
                     "Ditandatangani Secara Elektronik Oleh:");

        // ── 2. Nama UPPERCASE + underline (size 19 bold) ──────────────────────────
        $nama_upper = mb_strtoupper($nama, 'UTF-8');
        $bbox_nama  = imagettfbbox(19, 0, $font_bold, $nama_upper);
        $nama_w     = abs($bbox_nama[4] - $bbox_nama[0]);

        $y_nama = 95;   // baseline nama

        if ($nama_w <= ($t_r - $tx)) {
            // Muat 1 baris → render langsung
            $r = $this->drawTextWithUnderline($canvas, 19, $tx, $y_nama, $black, $font_bold, $nama_upper);
            $ly = $r['y_baseline'];
        } else {
            // Wrap ke 2 baris
            $drawFrame = array($tx, 70, $t_r, 120);
            $ly = $this->wrapimagettftext($canvas, 18, $drawFrame, $black, $font_bold,
                                          $nama_upper, '115%', ' ', -1, -1);
            // Underline di bawah baris terakhir
            imageline($canvas, $tx, $ly + 3, $t_r, $ly + 3, $black);
            imageline($canvas, $tx, $ly + 4, $t_r, $ly + 4, $black);
        }

        // ── 3. NIP — hanya angka, tanpa prefix "NIP." (size 15) ──────────────────
        $y_nip = $ly + 22;
        imagettftext($canvas, 15, 0, $tx, $y_nip, $black, $font_reg, $nip);

        // ── 4. Jabatan di bagian bawah (size 15) ──────────────────────────────────
        // Selalu ditempatkan dekat bawah canvas untuk konsistensi visual
        $y_jab    = $img_height - 26;
        $bbox_jab = imagettfbbox(15, 0, $font_reg, $jabatan);
        $jab_w    = abs($bbox_jab[4] - $bbox_jab[0]);

        if ($jab_w <= ($t_r - $tx)) {
            imagettftext($canvas, 15, 0, $tx, $y_jab, $black, $font_reg, $jabatan);
        } else {
            // Wrap jabatan ke 2 baris
            $y_jab_start = $img_height - 46;
            $drawFrame3  = array($tx, $y_jab_start, $t_r, $img_height - 4);
            $this->wrapimagettftext($canvas, 14, $drawFrame3, $black, $font_reg,
                                    $jabatan, '120%', ' ', -1, -1);
        }

        // ── 5. Tanggal — rata tengah kolom kanan, atas (size 12) ─────────────────
        $date_offset_y = 0;
        if (!empty($tanggal)) {
            $tgl      = strtoupper($this->formatTanggalShort($tanggal));
            $bbox_tgl = imagettfbbox(12, 0, $font_bold, $tgl);
            $tgl_w    = abs($bbox_tgl[4] - $bbox_tgl[0]);
            $tgl_x    = $has_qr
                ? $qr_col_x + (int)(($qr_col_w - $tgl_w) / 2)  // center dalam kolom QR
                : $img_width - $tgl_w - 10;                       // pojok kanan atas
            imagettftext($canvas, 12, 0, $tgl_x, 22, $black, $font_bold, $tgl);
            $date_offset_y = 28;
        }

        // ── 6. QR Code — kolom kanan, ukuran PENUH mengisi tinggi canvas ──────────
        if ($has_qr) {
            // Garis pemisah teks | QR
            imageline($canvas, $qr_col_x, 0, $qr_col_x, $img_height - 1, $lgray);

            $qr_margin  = 6;
            $qr_avail_h = $img_height - $date_offset_y - ($qr_margin * 2);
            $qr_avail_w = $qr_col_w - ($qr_margin * 2);
            $qr_size    = min($qr_avail_h, $qr_avail_w);   // maks kotak yang bisa muat

            $logoPath = FCPATH . 'assets/images/bsre.png';

            $builderParams = Builder::create()
                ->writer(new PngWriter())
                ->writerOptions([])
                ->data($qr_string)
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                ->size($qr_size)
                ->margin(0)
                ->roundBlockSizeMode(new RoundBlockSizeModeMargin());

            if (file_exists($logoPath)) {
                $builderParams = $builderParams
                    ->logoPath($logoPath)
                    ->logoResizeToWidth((int)($qr_size * 0.27));
            }

            $buildQR   = $builderParams->validateResult(false)->build();
            $string_qr = $buildQR->getString();
            list($qr_w, $qr_h) = getimagesizefromstring($string_qr);
            $image2 = imagecreatefromstring($string_qr);

            // Center QR dalam kolom kanan, di bawah tanggal
            $qr_x = $qr_col_x + (int)(($qr_col_w - $qr_w) / 2);
            $qr_y = $date_offset_y + $qr_margin + (int)(($qr_avail_h - $qr_h) / 2);
            imagecopymerge($canvas, $image2, $qr_x, $qr_y, 0, 0, $qr_w, $qr_h, 100);
            imagedestroy($image2);
        }

        // ── Output PNG base64 ─────────────────────────────────────────────────────
        ob_start();
        imagepng($canvas, null, 6);
        $base_64_ttd = base64_encode(ob_get_clean());
        imagedestroy($canvas);
        return $base_64_ttd;
    }

    /**
     * Format tanggal ke format pendek Indonesia (contoh: 14 APR 2026)
     */
    private function formatTanggalShort($tanggal)
    {
        $bulan = array(
            1  => 'JAN', 2  => 'FEB', 3  => 'MAR', 4  => 'APR',
            5  => 'MEI', 6  => 'JUN', 7  => 'JUL', 8  => 'AGU',
            9  => 'SEP', 10 => 'OKT', 11 => 'NOV', 12 => 'DES'
        );
        $tgl = date('d', strtotime($tanggal));
        $bln = (int) date('m', strtotime($tanggal));
        $thn = date('Y', strtotime($tanggal));
        return $tgl . ' ' . ($bulan[$bln] ?? '') . ' ' . $thn;
    }
}
