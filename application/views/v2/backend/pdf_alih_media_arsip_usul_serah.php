<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export PDF Arsip Usul Serah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
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
            color: #4a5568;
            margin-bottom: 10px;
        }
        .instansi-address, .instansi-email {
            font-size: 12px;
            color: #718096;
            margin-bottom: 5px;
        }
        .doc-title {
            font-size: 16px;
            font-weight: bold;
            color: #1a73e8;
            text-align: right;
            margin-bottom: 10px;
            margin-top: 5px;
        }
        .print-date {
            font-size: 12px;
            color: #718096;
            text-align: right;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th, .data-table td {
            border: 1px solid #e2e8f0;
            padding: 8px;
        }
        .data-table th {
            background-color: #1a73e8;
            color: white;
            text-align: left;
            font-weight: bold;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
        }
        .badge-success {
            background-color: #e6ffed;
            color: #22863a;
        }
        .badge-danger {
            background-color: #ffeef0;
            color: #cb2431;
        }
        .dot {
            height: 6px;
            width: 6px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 4px;
        }
        .dot-success { background-color: #22863a; }
        .dot-danger { background-color: #cb2431; }
    </style>
</head>
<body>

<table class="header-table">
    <tr>
        <td style="width: 70%;">
            <div class="instansi-title">DINAS ARSIP DAN PERPUSTAKAAN KABUPATEN SUMEDANG</div>
            <div class="instansi-address">Jl. Pacuan Kuda No.2, Kotakaler, Sumedang Utara, Kab. Sumedang, Jawa Barat 45621</div>
            <div class="instansi-email">Email: disarpus@sumedangkab.go.id</div>
        </td>
        <td style="width: 30%;">
            <div class="doc-title">DAFTAR ARSIP USUL SERAH</div>
            <div class="print-date"><b>Tanggal Cetak:</b> <?= date('d M Y') ?></div>
        </td>
    </tr>
</table>

<table class="data-table">
    <thead>
        <tr>
            <th width="30">No</th>
            <th>Klasifikasi</th>
            <th>Uraian Informasi</th>
            <th>Kurun Waktu</th>
            <th>Unit Kerja Pencipta</th>
            <th width="100">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data_berkas)): ?>
            <?php $no = 1; foreach ($data_berkas as $row): ?>
                <?php 
                    $klasifikasi_text = !empty($row->kode_klsf) ? $row->kode_klsf : '-';
                    $skpd_text = !empty($row->unit_kerja_pencipta) ? $row->unit_kerja_pencipta : '-';

                    // Parse status based on what is in export_excel
                    $penilaian = $row->penilaian_arsip_statis ?? null;
                    $verifikasi = $row->verifikasi_status ?? null;
                    $tte = $row->tte_status ?? null;
                    $is_ditolak_verifikator = ($verifikasi === 'N' && !empty($row->verifikasi_user));

                    $is_signed = false;
                    $is_rejected = false;

                    if ($tte === 'Y') {
                         $status = 'Sudah Ditandatangani';
                         $is_signed = true;
                    } elseif ($verifikasi === 'Y') {
                         $status = 'Menunggu Tandatangan';
                    } elseif ($is_ditolak_verifikator) {
                         $status = 'Ditolak Verifikator';
                         $is_rejected = true;
                    } elseif ($penilaian === 'Y') {
                         $status = 'Menunggu Verifikasi';
                    } elseif ($penilaian === 'N') {
                         $status = 'Ditolak Penilai';
                         $is_rejected = true;
                    } else {
                         $status = 'Menunggu Penilaian';
                    }
                ?>
                <tr>
                    <td style="text-align: center;"><?= $no++ ?></td>
                    <td><?= $klasifikasi_text ?></td>
                    <td><?= $row->uraian_informasi_arsip ?></td>
                    <td style="text-align: center;"><?= $row->tahun ?></td>
                    <td><?= $skpd_text ?></td>
                    <td style="text-align: center;">
                        <?php if ($is_signed): ?>
                            <span class="badge badge-success"><span class="dot dot-success"></span> <?= $status ?></span>
                        <?php elseif ($is_rejected): ?>
                            <span class="badge badge-danger"><span class="dot dot-danger"></span> <?= $status ?></span>
                        <?php else: ?>
                            <span class="badge badge-danger" style="background-color:#f1f5f9; color:#475569;"><span class="dot" style="background-color:#475569;"></span> <?= $status ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align: center; padding: 20px;">Tidak ada data.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
