<!DOCTYPE html>
<html>

<head>
     <title><?= $title; ?></title>
     <style>
          /* --- 1. SETTING KERTAS LANDSCAPE & MARGIN PRESISI --- */
          @page {
               size: A4 landscape;
               margin: 1.2cm 1.2cm 1.2cm 1.2cm;
          }

          /* --- 2. BASE TYPOGRAPHY (Gaya Modern ala BS5) --- */
          body {
               font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
               font-size: 11px;
               /* Sedikit diperkecil agar pas untuk 8 kolom */
               line-height: 1.4;
               color: #212529;
               margin: 0;
               padding: 0;
          }

          h2 {
               font-size: 20px;
               font-weight: 600;
               margin: 0 0 5px 0;
               color: #1a1a1a;
          }

          .text-muted {
               color: #6c757d !important;
          }

          .text-center {
               text-align: center;
          }

          /* --- 3. LAYOUT HEADER --- */
          .header-table {
               width: 100%;
               border-collapse: collapse;
               margin-bottom: 20px;
          }

          .header-table td {
               border: none !important;
               padding: 0 !important;
               vertical-align: middle;
          }

          /* --- 4. CONFIGURASI TABEL UTAMA (Kunci Presisi & Anti-Terpotong) --- */
          .table-pdf {
               width: 100%;
               table-layout: fixed;
               /* Kunci agar lebar kolom patuh sesuai % */
               border-collapse: collapse;
               margin-bottom: 20px;
          }

          /* Pembagian Persentase Lebar Kolom Secara Akurat (Total 100%) */
          .col-no {
               width: 4cm;
          }

          .col-klas {
               width: 15%;
          }

          .col-indeks {
               width: 11%;
          }

          .col-uraian {
               width: 20%;
          }

          .col-deskripsi {
               width: 20%;
          }

          .col-tahun {
               width: 5%;
          }

          .col-unit {
               width: 13%;
          }

          .col-status {
               width: 12%;
          }

          .table-pdf th {
               background-color: #0d6efd;
               /* Primary BS5 */
               color: #ffffff;
               font-weight: 600;
               text-align: left;
               padding: 8px 6px;
               font-size: 10.5px;
               border: 1px solid #0d6efd;
          }

          .table-pdf td {
               padding: 8px 6px;
               border: 1px solid #dee2e6;
               /* Border tipis khas BS5 */
               font-size: 10px;
               vertical-align: top;
               /* Trik agar teks panjang otomatis turun ke bawah & tidak merusak lebar kolom */
               word-wrap: break-word;
               overflow-wrap: break-word;
          }

          /* Efek Striped */
          .table-pdf tbody tr:nth-child(even) {
               background-color: #f8f9fa;
          }

          /* --- 5. TRIK ANTI POTONG SAAT PAGE BREAK --- */
          .table-pdf tr {
               page-break-inside: avoid !important;
               /* Baris data tidak akan terbelah horizontal di ujung kertas */
          }
     </style>

     <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/v3/backend/') ?>images/icon-prasasti.png">

     <link rel="stylesheet" href="<?= base_url('assets/v3/backend/') ?>vendor/select2/css/select2.min.css">
     <link href="<?= base_url('assets/v3/backend/') ?>vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
     <!-- SweetAlert2 -->
     <link href="<?= base_url('assets/v3/backend/') ?>vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">
     <link href="<?= base_url('assets/v3/backend/') ?>css/style.css" rel="stylesheet">
     <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

     <!-- jQuery (must load before content scripts) -->
     <script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script>
</head>

<body class="bg-white">
     <table class="header-table">
          <tr>
               <td>
                    <h2>DINAS ARSIP DAN PERPUSTAKAAN KABUPATEN SUMEDANG</h2>
                    <p class="text-muted" style="margin: 0;">Jl. Pacuan Kuda No.2, Kotakaler, Sumedang Utara, Kab. Sumedang, Jawa Barat 45621<br>Email: disarpus@sumedangkab.go.id</p>
               </td>
               <td class="text-end">
                    <h3 style="color: #0d6efd; margin-top: 0; text-transform: uppercase;"><?= $title; ?></h3>
                    <p style="margin: 0;"><strong>Tanggal Cetak:</strong> <?php echo date('d M Y'); ?></p>
                    <!-- <p class="text-muted" style="margin: 0;">ID Dokumen: #INV-2026001</p> -->
               </td>
          </tr>
     </table>

     <hr style="border: 0; border-top: 2px solid #dee2e6; margin-bottom: 25px;">

     <table class="table-pdf">
          <thead>
               <tr class="text-center">
                    <th class="col-no text-center">No</th>
                    <th class="col-klas">Klasifikasi</th>
                    <th class="col-indeks text-center">Indeks</th>
                    <th class="col-uraian">Uraian Informasi</th>
                    <th class="col-deskripsi">Deskripsi</th>
                    <th class="col-tahun text-center">Tahun</th>
                    <th class="col-unit">Unit Kerja Pencipta</th>
                    <?php if ($user->user_role == 'admin') { ?>
                         <th>SKPD</th>
                    <?php } ?>
                    <th class="col-status text-center">Status</th>
               </tr>
          </thead>
          <tbody>
               <?php $no = 1;
               foreach ($archieves as $row): ?>
                    <tr>
                         <td class="text-center"><?= $no++; ?></td>
                         <td><?= $row['klasifikasi']; ?></td>
                         <td><?= $row['indeks']; ?></td>
                         <td><?= $row['uraian']; ?></td>
                         <td><?= $row['deskripsi']; ?></td>
                         <td class="text-center"><?= $row['tahun']; ?></td>
                         <td class="text-center"><?= $row['unit_kerja']; ?></td>
                         <?php if ($user->user_role == 'admin') { ?>
                              <td class="text-center"><?= $row['skpd']; ?></td>
                         <?php } ?>
                         <td class="text-center"><?= $row['status']; ?></td>
                    </tr>
               <?php endforeach; ?>
          </tbody>
     </table>

</body>

</html>
