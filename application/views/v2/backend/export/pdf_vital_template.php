<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export PDF Arsip Vital</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 1.2cm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #000;
            margin: 0;
            padding: 0;
        }
        .header-table {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
            border: none;
        }
        .header-table td {
            border: none;
            vertical-align: top;
        }
        .instansi-title {
            font-size: 15px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 3px;
        }
        .instansi-address, .instansi-email {
            font-size: 10px;
            color: #555;
            margin-bottom: 2px;
        }
        .doc-title {
            font-size: 14px;
            font-weight: bold;
            color: #1a1a1a;
            text-align: right;
            margin-bottom: 3px;
        }
        .print-date {
            font-size: 10px;
            color: #555;
            text-align: right;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            table-layout: fixed;
        }
        .data-table th, .data-table td {
            border: 1px solid #000;
            padding: 5px 6px;
            vertical-align: top;
            word-wrap: break-word;
        }
        .data-table th {
            background-color: #f2f2f2;
            color: #000;
            text-align: center;
            font-weight: bold;
        }
        .petunjuk-container {
            margin-top: 15px;
            font-size: 10px;
            line-height: 1.5;
        }
        .petunjuk-table {
            border-collapse: collapse;
            width: 100%;
        }
        .petunjuk-table td {
            border: none !important;
            padding: 2px 0;
            vertical-align: top;
        }
    </style>
</head>
<body>

<table class="header-table">
    <tr>
        <td style="width: 65%;">
            <div class="instansi-title">DINAS ARSIP DAN PERPUSTAKAAN KABUPATEN SUMEDANG</div>
            <div class="instansi-address">Jl. Pacuan Kuda No.2, Kotakaler, Sumedang Utara, Kab. Sumedang, Jawa Barat 45621</div>
            <div class="instansi-email">Email: disarpus@sumedangkab.go.id</div>
        </td>
        <td style="width: 35%;">
            <div class="doc-title">DAFTAR ARSIP VITAL</div>
            <div class="print-date"><b>Tanggal Cetak:</b> <?= date('d M Y') ?></div>
        </td>
    </tr>
</table>

<table class="data-table">
    <thead>
        <tr>
            <th style="width: 4%;">No</th>
            <th style="width: 16%;">Jenis Arsip</th>
            <th style="width: 14%;">Unit Kerja</th>
            <th style="width: 8%;">Kurun Waktu</th>
            <th style="width: 10%;">Media</th>
            <th style="width: 6%;">Jml</th>
            <th style="width: 10%;">Jangka Simpan</th>
            <th style="width: 14%;">Metode Perlindungan</th>
            <th style="width: 10%;">Lokasi Simpan</th>
            <th style="width: 8%;">Ket</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($archieves)): ?>
            <?php $no = 1; foreach ($archieves as $row): ?>
                <tr>
                    <td style="text-align: center;"><?= $no++ ?></td>
                    <td><?= $row['uraian'] ?? '-' ?></td>
                    <td><?= $row['unit_kerja'] ?? '-' ?></td>
                    <td style="text-align: center;"><?= $row['tahun'] ?? '-' ?></td>
                    <td style="text-align: center;"><?= $row['media'] ?? '-' ?></td>
                    <td style="text-align: center;"><?= $row['jumlah'] ?? '-' ?></td>
                    <td style="text-align: center;"><?= $row['jangka_simpan'] ?? '-' ?></td>
                    <td><?= $row['metode_perlindungan'] ?? '-' ?></td>
                    <td><?= $row['ruang_penyimpanan'] ?? '-' ?></td>
                    <td><?= $row['deskripsi'] ?? '-' ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10" style="text-align: center; padding: 15px;">Tidak ada data arsip vital.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="petunjuk-container">
    <table class="petunjuk-table">
        <tr>
            <td style="width: 25px;">1.</td>
            <td style="width: 140px;">Nomor</td>
            <td style="width: 15px;">:</td>
            <td>Diisi dengan nomor urut Arsip Vital</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Jenis Arsip</td>
            <td>:</td>
            <td>Diisi dengan Arsip Vital yang telah didata</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Unit Kerja</td>
            <td>:</td>
            <td>Diisi dengan nama unit kerja asal Arsip Vital</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>Kurun waktu</td>
            <td>:</td>
            <td>Diisi dengan tahun Arsip Vital tercipta</td>
        </tr>
        <tr>
            <td>5.</td>
            <td>Media</td>
            <td>:</td>
            <td>Diisi dengan jenis media rekam Arsip Vital</td>
        </tr>
        <tr>
            <td>6.</td>
            <td>Jumlah</td>
            <td>:</td>
            <td>Diisi dengan banyaknya Arsip Vital misal, 1 berkas</td>
        </tr>
        <tr>
            <td>7.</td>
            <td>Jangka simpan</td>
            <td>:</td>
            <td>Diisi dengan batas waktu sebagai Arsip Vital</td>
        </tr>
        <tr>
            <td>8.</td>
            <td>Metode</td>
            <td>:</td>
            <td>Diisi dengan jenis metode Perlindungan sesuai dengan kebutuhan masing-masing media rekam yang digunakan.</td>
        </tr>
        <tr>
            <td>9.</td>
            <td>Lokasi simpan</td>
            <td>:</td>
            <td>Diisi dengan tempat Arsip tersebut di simpan</td>
        </tr>
        <tr>
            <td>10.</td>
            <td>Keterangan</td>
            <td>:</td>
            <td>Diisi dengan informasi spesifik yang belum/tidak ada dalam kolom yang tersedia</td>
        </tr>
    </table>
</div>

</body>
</html>
