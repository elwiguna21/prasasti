<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export PDF Arsip Usul Serah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #000;
        }
        .header-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            border: none;
        }
        .header-table td {
            border: none;
            vertical-align: top;
        }
        .instansi-title {
            font-size: 16px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 5px;
        }
        .instansi-address, .instansi-email {
            font-size: 11px;
            color: #555;
            margin-bottom: 3px;
        }
        .doc-title {
            font-size: 15px;
            font-weight: bold;
            color: #1a1a1a;
            text-align: right;
            margin-bottom: 5px;
        }
        .print-date {
            font-size: 11px;
            color: #555;
            text-align: right;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .data-table th, .data-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: top;
        }
        .data-table th {
            background-color: #f2f2f2;
            color: #000;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }
        .petunjuk-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 11px;
        }
        .petunjuk-table td {
            border: none !important;
            padding: 3px 0;
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
            <div class="doc-title">DAFTAR ARSIP USUL SERAH</div>
            <div class="print-date"><b>Tanggal Cetak:</b> <?= date('d M Y') ?></div>
        </td>
    </tr>
</table>

<table class="data-table">
    <thead>
        <tr>
            <th width="35">No.</th>
            <th>JENIS ARSIP</th>
            <th width="70">TAHUN</th>
            <th width="80">JUMLAH</th>
            <th width="140">TINGKAT PERKEMBANGAN</th>
            <th width="150">KETERANGAN</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data_berkas)): ?>
            <?php $no = 1; foreach ($data_berkas as $row): ?>
                <tr>
                    <td style="text-align: center;"><?= $no++ ?>.</td>
                    <td><?= $row->uraian_informasi_arsip ?></td>
                    <td style="text-align: center;"><?= $row->tahun ?></td>
                    <td style="text-align: center;"><?= $row->jumlah ?></td>
                    <td style="text-align: center;"><?= !empty($row->keterangan_tk_perkembangan) ? ucfirst($row->keterangan_tk_perkembangan) : '-' ?></td>
                    <td><?= !empty($row->deskripsi) ? $row->deskripsi : '-' ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center; padding: 15px;">Tidak ada data.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<table class="petunjuk-table">
    <tr>
        <td style="width: 170px;">Petunjuk Pengisian</td>
        <td style="width: 15px;">:</td>
        <td></td>
    </tr>
    <tr>
        <td>Nomor</td>
        <td>:</td>
        <td>Berisi nomor urut jenis Arsip</td>
    </tr>
    <tr>
        <td>Jenis Arsip</td>
        <td>:</td>
        <td>Berisi jenis / series Arsip</td>
    </tr>
    <tr>
        <td>Tahun</td>
        <td>:</td>
        <td>Berisi tahun terciptanya Arsip</td>
    </tr>
    <tr>
        <td>Jumlah</td>
        <td>:</td>
        <td>Berisi jumlah Arsip</td>
    </tr>
    <tr>
        <td>Tingkat Perkembangan</td>
        <td>:</td>
        <td>Berisi tingkat keaslian Arsip (asli,copy atau salinan)</td>
    </tr>
    <tr>
        <td>Keterangan</td>
        <td>:</td>
        <td>Berisi informasi tentang kondisi Arsip (misalnya rusak/tidak lengkap berbahasa asing/daerah)</td>
    </tr>
</table>

</body>
</html>
