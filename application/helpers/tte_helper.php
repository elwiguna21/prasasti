<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * TTE Helper — Tanda Tangan Elektronik via BSrE Cloud
 * Diadaptasi dari register_akta/general_helper.php
 */

if (!function_exists('tanda_tangan_cloud')) {

    /**
     * Menandatangani file PDF secara elektronik via API BSrE Sumedang
     *
     * @param  string $path_pdf       Path absolut file PDF sumber (./assets/upload/berkas/xxx.pdf)
     * @param  string $path_output    Direktori output (tanpa trailing slash)
     * @param  string $nik            NIK penanda tangan
     * @param  string $passphrase     Passphrase sertifikat elektronik
     * @param  string $filename       Nama file output (contoh: tte_xxxx.pdf)
     * @param  array  $tte_posisi     Opsional, data posisi visible signature ['page','x','y','width','height','canvas_w','canvas_h','scale']
     * @return array  ['error' => bool, 'message' => string, 'file_ttd' => string]
     */
    function tanda_tangan_cloud($path_pdf, $path_output, $nik, $passphrase, $filename, $linkQR = '', $tte_posisi = null, $data_specimen = null)
    {
        // ── Kredensial API BSrE ──
        $server_ip   = 'tte.sumedangkab.go.id';
        $server_user = 'sisemar';
        $server_pass = 'A:S$]6vy^G-<)=byMr';

        $error    = false;
        $message  = '';
        $file_ttd = '';

        // Validasi file sumber ada
        if (!file_exists($path_pdf)) {
            return array(
                'error'    => true,
                'message'  => 'File PDF sumber tidak ditemukan.',
                'file_ttd' => ''
            );
        }

        // ── Tambahkan footer "Catatan" di halaman TTE menggunakan mPDF ──
        $converted_path = null;
        try {
            // Tentukan halaman footer = halaman TTE image
            $footer_page = null;
            if (!empty($data_specimen['page'])) {
                $footer_page = (int) $data_specimen['page'];
            } elseif (!empty($tte_posisi['page'])) {
                $footer_page = (int) $tte_posisi['page'];
            }

            // Baca info semua halaman dari PDF sumber
            $mpdf_temp = new \Mpdf\Mpdf();
            $pagecount = $mpdf_temp->setSourceFile($path_pdf);

            if (empty($footer_page) || $footer_page > $pagecount) {
                $footer_page = $pagecount;
            }

            // Ambil spesifikasi tiap halaman + tentukan orientasi dari dimensi
            $page_specs = [];
            for ($i = 1; $i <= $pagecount; $i++) {
                $tplId = $mpdf_temp->importPage($i);
                $s = $mpdf_temp->getTemplateSize($tplId);
                // Orientasi dari dimensi (FPDI bisa return empty orientation)
                $s['ori'] = ($s['width'] > $s['height']) ? 'L' : 'P';
                // Format dalam urutan portrait (lebar kecil, tinggi besar)
                // mPDF mengharapkan format portrait, lalu orientation yang merotasinya
                $s['fmt_w'] = min($s['width'], $s['height']);
                $s['fmt_h'] = max($s['width'], $s['height']);
                $page_specs[$i] = $s;
            }

            // Buat mPDF baru dengan format halaman pertama
            $first = $page_specs[1];
            $mpdf = new \Mpdf\Mpdf([
                'format'        => [$first['fmt_w'], $first['fmt_h']],
                'orientation'   => $first['ori'],
                'margin_left'   => 0,
                'margin_right'  => 0,
                'margin_top'    => 0,
                'margin_bottom' => 0,
                'margin_header' => 0,
                'margin_footer' => 0,
            ]);
            $mpdf->setSourceFile($path_pdf);

            // HTML footer catatan
            $footer_html = '<div style="position:absolute;bottom:0;left:0;max-width:100%;width:100%;background-color:rgba(255, 255, 255, 0.7);padding:10px 20px;font-size:9px">
                <span style="font-weight:bold;font-style:italic;margin:0">Catatan : </span>
                    <p style="margin:0">- UU ITE No 11 Tahun 2008 Pasal 5 ayat 1 : 
"Informasi Elektronik dan/atau Dokumen Elektronik dan/atau hasil cetaknya merupakan alat bukti hukum yang sah."
</p><p style="margin:0">- Dokumen ini telah ditandatangani secara elektronik menggunakan sertifikat elektronik yang diterbitkan oleh Balai Besar Sertifikasi Elektronik (BSrE), Badan Siber dan Sandi Negara.</p>
                </div>';

            // Import semua halaman, tambahkan footer hanya di halaman TTE
            for ($i = 1; $i <= $pagecount; $i++) {
                $tplId = $mpdf->importPage($i);
                $s = $page_specs[$i];

                if ($i > 1) {
                    $mpdf->AddPageByArray([
                        'orientation' => $s['ori'],
                        'sheet-size'  => [$s['fmt_w'], $s['fmt_h']],
                        'margin-left' => 0, 'margin-right' => 0,
                        'margin-top'  => 0, 'margin-bottom' => 0,
                    ]);
                }

                $mpdf->UseTemplate($tplId);

                // Footer hanya di halaman TTE
                if ($i == $footer_page) {
                    $mpdf->WriteHTML($footer_html);
                }
            }

            $converted_name = time() . rand(0, 999) . '_footer.pdf';
            $converted_path = rtrim($path_output, '/') . '/' . $converted_name;
            $mpdf->Output($converted_path, 'F');

            // Gunakan file yang sudah ada footer sebagai sumber
            $path_pdf = $converted_path;
        } catch (\Throwable $e) {
            // Jika gagal menambahkan footer, lanjut dengan file asli
            error_log('mPDF footer error: ' . $e->getMessage() . ' | File: ' . $e->getFile() . ':' . $e->getLine());
            log_message('error', 'Gagal menambahkan footer mPDF: ' . $e->getMessage());
        }

        // ── Build POST data ──
        $postData = array(
            'file'       => curl_file_create(realpath($path_pdf), 'application/pdf'),
            'nik'        => $nik,
            'passphrase' => $passphrase,
            'tampilan'   => 'INVISIBLE',
            'linkQR'     => $linkQR
        );

        // Jika ada data specimen (image TTE) → mode VISIBLE dengan image
        // BSrE API parameter mapping (sama seperti register_akta):
        //   xAxis  = llx (lower-left X)
        //   height = lly (lower-left Y) — BUKAN height!
        //   width  = urx (upper-right X) — BUKAN width!
        //   yAxis  = ury (upper-right Y)
        if (!empty($data_specimen) && !empty($data_specimen['image_ttd'])) {
            $llx = $data_specimen['xAxis'];
            $lly = $data_specimen['yAxis'];
            $urx = $data_specimen['xAxis'] + $data_specimen['width'];
            $ury = $data_specimen['yAxis'] + $data_specimen['height'];

            $postData['tampilan'] = 'visible';
            $postData['page']     = (int) ($data_specimen['page'] ?? 1);
            $postData['image']    = true;
            $postData['imageTTD'] = curl_file_create($data_specimen['image_ttd'], 'image/png');
            $postData['xAxis']    = round($llx, 2);
            $postData['height']   = round($lly, 2);
            $postData['width']    = round($urx, 2);
            $postData['yAxis']    = round($ury, 2);
        }
        // Jika ada data posisi TTE (tanpa image) → mode VISIBLE posisi saja
        elseif (!empty($tte_posisi) && isset($tte_posisi['page'])) {
            $postData['tampilan'] = 'visible';
            $postData['page']     = (int) $tte_posisi['page'];

            // Konversi koordinat canvas (pixel) → rasio terhadap ukuran canvas
            $canvas_w = !empty($tte_posisi['canvas_w']) ? (float)$tte_posisi['canvas_w'] : 1;
            $canvas_h = !empty($tte_posisi['canvas_h']) ? (float)$tte_posisi['canvas_h'] : 1;
            $scale    = !empty($tte_posisi['scale'])    ? (float)$tte_posisi['scale']    : 1;

            // Koordinat dalam pixel pada canvas (sudah di-scale)
            $px_x = (float)($tte_posisi['x'] ?? 0);
            $px_y = (float)($tte_posisi['y'] ?? 0);
            $px_w = (float)($tte_posisi['width'] ?? 160);
            $px_h = (float)($tte_posisi['height'] ?? 80);

            // Konversi ke PDF points (1 PDF point ≈ 72/96 pixel pada scale 1)
            // Ukuran PDF asli (points) = canvas_size / scale * (72/96)
            $pdf_w_pts = ($canvas_w / $scale) * (72 / 96);
            $pdf_h_pts = ($canvas_h / $scale) * (72 / 96);

            // Posisi TTE dalam PDF points
            $xAxis  = ($px_x / $canvas_w) * $pdf_w_pts;
            $yAxis  = ($px_y / $canvas_h) * $pdf_h_pts;
            $width  = ($px_w / $canvas_w) * $pdf_w_pts;
            $height = ($px_h / $canvas_h) * $pdf_h_pts;

            $postData['xAxis']  = round($xAxis, 2);
            $postData['yAxis']  = round($yAxis, 2);
            $postData['width']  = round($width, 2);
            $postData['height'] = round($height, 2);
        }

        // ── cURL ke API BSrE ──
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://' . $server_ip . '/api/sign/pdf');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERPWD, "$server_user:$server_pass");
        curl_setopt($ch, CURLOPT_TIMEOUT, 120); // timeout 2 menit

        $result     = curl_exec($ch);
        $curl_error = false;

        if (curl_errno($ch)) {
            $curl_error   = true;
            $curl_message = curl_error($ch);
        }

        $http_code    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        curl_close($ch);

        // ── Handle Response ──
        $is_pdf_content  = (strpos($content_type, 'application/pdf') !== false);
        $is_pdf_magic    = (substr($result, 0, 5) === '%PDF-');
        $is_octet_stream = (strpos($content_type, 'application/octet-stream') !== false);

        if ($curl_error) {
            $error   = true;
            $message = 'Gagal terhubung ke server TTE: ' . $curl_message;
        } elseif ($http_code != 200) {
            $error = true;
            $json_check = json_decode($result);
            if (isset($json_check->error)) {
                // Terjemahkan pesan error BSrE ke bahasa yang lebih user-friendly
                $bsre_error = $json_check->error;
                if (stripos($bsre_error, 'wrong password') !== false || stripos($bsre_error, 'password') !== false) {
                    $message = 'Passphrase yang Anda masukkan salah. Silakan coba lagi.';
                } elseif (stripos($bsre_error, 'user not found') !== false || stripos($bsre_error, 'not found') !== false) {
                    $message = 'NIK tidak ditemukan di sistem BSrE. Pastikan NIK Anda sudah terdaftar.';
                } elseif (stripos($bsre_error, 'certificate') !== false) {
                    $message = 'Sertifikat elektronik bermasalah. Hubungi administrator BSrE.';
                } elseif (stripos($bsre_error, 'Internal Server Error') !== false) {
                    $message = 'Terjadi kesalahan pada server BSrE. Hubungi administrator.';
                } else {
                    $message = $bsre_error;
                }
            } else {
                // Pesan berdasarkan HTTP status code
                if ($http_code == 500) {
                    $message = 'Passphrase salah atau terjadi kesalahan pada server BSrE. Silakan periksa kembali passphrase Anda.';
                } elseif ($http_code == 401 || $http_code == 403) {
                    $message = 'Akses ditolak oleh server BSrE. Hubungi administrator.';
                } elseif ($http_code == 400) {
                    $message = 'Data yang dikirim tidak valid. Pastikan passphrase dan NIK sudah benar.';
                } else {
                    $message = 'Terjadi kesalahan saat penandatanganan. Kode ERROR: ' . $http_code;
                    if (!empty($result) && strlen($result) < 500) {
                        $message .= ' — ' . strip_tags($result);
                    }
                }
            }
        } elseif ($is_pdf_content || $is_pdf_magic || ($is_octet_stream && strlen($result) > 1000)) {
            // Sukses — response adalah file PDF yang sudah ditandatangani
            $output_path = rtrim($path_output, '/') . '/' . $filename;
            file_put_contents($output_path, $result);

            $error    = false;
            $message  = 'Dokumen berhasil ditandatangani secara elektronik.';
            $file_ttd = $filename;
        } else {
            // HTTP 200 tapi bukan PDF → kemungkinan error dari server
            $error = true;
            $json_check = json_decode($result);
            if (isset($json_check->error)) {
                $message = $json_check->error;
            } elseif (!empty($result) && strlen($result) < 1000) {
                $message = 'Gagal: ' . strip_tags($result);
            } else {
                // Log untuk debugging
                $debug_info = 'Content-Type: ' . $content_type . ' | Size: ' . strlen($result) . ' bytes | First 50 chars: ' . substr($result, 0, 50);
                $message = 'Response tidak valid. Debug: ' . $debug_info;
            }
        }

        // Hapus file PDF sementara (footer)
        if (!empty($converted_path) && file_exists($converted_path)) {
            @unlink($converted_path);
        }

        return array(
            'error'    => $error,
            'message'  => $message,
            'file_ttd' => $file_ttd
        );
    }
}
