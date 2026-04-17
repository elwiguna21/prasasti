<style>
.content-body {
    overflow-y: auto !important;
    height: calc(100vh - 80px) !important;
}
.container-fluid { padding-bottom: 60px !important; }

/* Kartu Status */
.detail-status-card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 2px 12px rgba(0,0,0,.08);
}
.detail-status-icon {
    width: 48px; height: 48px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
}
.detail-info-row {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
}
.detail-info-row:last-child { border-bottom: none; }
.detail-info-icon {
    width: 32px; height: 32px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; flex-shrink: 0; margin-top: 2px;
}

/* ===== PDF Viewer + Watermark TTE ===== */
#pdf-viewer-container {
    position: relative;
    overflow: auto;
    background: #e9ecef;
    min-height: 500px;
    max-height: 700px;
    padding: 20px;
    text-align: center;
    border-radius: 0 0 12px 12px;
}
#pdf-page-wrapper {
    position: relative;
    display: inline-block;
    box-shadow: 0 4px 20px rgba(0,0,0,0.25);
}
#pdf-canvas {
    display: block;
}
#tte-watermark {
    position: absolute;
    border: 2.5px dashed #e74c3c;
    background: rgba(231, 76, 60, 0.08);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    pointer-events: none;
    z-index: 10;
    animation: tte-pulse 2s ease-in-out infinite;
}
#tte-watermark .tte-wm-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    color: #c0392b;
    font-size: 11px;
    font-weight: 600;
    text-align: center;
    line-height: 1.3;
}
#tte-watermark .tte-wm-inner i {
    font-size: 16px;
    opacity: 0.7;
}
@keyframes tte-pulse {
    0%, 100% { border-color: rgba(231,76,60,0.8); background: rgba(231,76,60,0.08); }
    50% { border-color: rgba(231,76,60,0.4); background: rgba(231,76,60,0.04); }
}
</style>

<!-- Page Title -->
<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah') ?>">Alih Media Arsip Usul Serah</a></li>
          <li class="breadcrumb-item active">Detail Berkas</li>
     </ol>
</div>

<?php
/* ── helpers ── */
$status_pen = $berkas->penilaian_arsip_statis ?? null;
$status_ver = $berkas->verifikasi_status    ?? 'N';
$status_tte = $berkas->tte_status           ?? null;

/* Label & warna status utama */
if ($status_tte === 'Y') {
    $statusLabel = 'Sudah Ditandatangani';
    $statusColor = '#28a745';
    $statusBg    = 'rgba(40,167,69,.1)';
    $statusIcon  = 'fas fa-check-circle';
} elseif ($status_ver === 'Y') {
    $statusLabel = 'Menunggu Tandatangan';
    $statusColor = '#007bff';
    $statusBg    = 'rgba(0,123,255,.1)';
    $statusIcon  = 'fas fa-clock';
} elseif ($status_pen === 'Y') {
    $statusLabel = 'Menunggu Verifikasi LKD';
    $statusColor = '#17a2b8';
    $statusBg    = 'rgba(23,162,184,.1)';
    $statusIcon  = 'fas fa-clock';
} elseif ($status_pen === 'N') {
    $statusLabel = 'Ditolak Admin';
    $statusColor = '#dc3545';
    $statusBg    = 'rgba(220,53,69,.1)';
    $statusIcon  = 'fas fa-times-circle';
} else {
    $statusLabel = 'Menunggu Penilaian Admin';
    $statusColor = '#ffc107';
    $statusBg    = 'rgba(255,193,7,.1)';
    $statusIcon  = 'fas fa-hourglass-half';
}
?>

<!-- Tombol Kembali -->
<div class="d-flex justify-content-end mb-3">
     <a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah') ?>" class="btn btn-primary btn-sm">
          <i class="fas fa-arrow-left me-1"></i> Kembali
     </a>
</div>

<div class="row g-3 align-items-start">

     <!-- ====== KOLOM KIRI ====== -->
     <div class="col-lg-4">

          <!-- Kartu Status -->
          <div class="card detail-status-card mb-3">
               <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                         <div class="detail-status-icon" style="background:<?= $statusBg ?>; color:<?= $statusColor ?>">
                              <i class="<?= $statusIcon ?>"></i>
                         </div>
                         <div>
                              <div class="text-muted small">Status Pengajuan</div>
                              <div class="fw-bold" style="color:<?= $statusColor ?>"><?= $statusLabel ?></div>
                         </div>
                    </div>

                    <hr class="my-2">

                    <!-- Pembuat / Operator -->
                    <div class="detail-info-row">
                         <div class="detail-info-icon" style="background:rgba(0,123,255,.1); color:#007bff">
                              <i class="fas fa-user-edit"></i>
                         </div>
                         <div>
                              <div class="text-muted x-small mb-0" style="font-size:11px">Pembuat</div>
                              <div class="fw-semibold small"><?= htmlspecialchars($berkas->operator_name ?? ($berkas->created_by ?? '-')) ?></div>
                              <?php if (!empty($berkas->tanggal)): ?>
                              <div class="text-muted" style="font-size:11px">
                                   <i class="far fa-clock me-1"></i><?= date('d F Y', strtotime($berkas->tanggal)) ?>
                              </div>
                              <?php endif; ?>
                         </div>
                    </div>

                    <?php if (in_array($status_pen, ['Y', 'N']) && !empty($berkas->penilai_name)): ?>
                    <!-- Admin (Penilai) -->
                    <div class="detail-info-row">
                         <div class="detail-info-icon" style="background:rgba(23,162,184,.12); color:#17a2b8">
                              <i class="fas fa-gavel"></i>
                         </div>
                         <div>
                              <div class="text-muted" style="font-size:11px"><?= $status_pen === 'Y' ? 'Disetujui oleh' : 'Ditolak oleh' ?></div>
                              <div class="fw-semibold small"><?= htmlspecialchars($berkas->penilai_name) ?></div>
                              <?php if (!empty($berkas->penilaian_tanggal)): ?>
                              <div class="text-muted" style="font-size:11px">
                                   <i class="far fa-clock me-1"></i><?= date('d F Y H:i', strtotime($berkas->penilaian_tanggal)) ?>
                              </div>
                              <?php endif; ?>
                         </div>
                    </div>
                    <?php endif; ?>

                    <?php if (in_array($status_ver, ['Y', 'N']) && !empty($berkas->verifikator_name)): ?>
                    <!-- Verifikator -->
                    <div class="detail-info-row">
                         <div class="detail-info-icon" style="background:rgba(255,193,7,.12); color:#ffc107">
                              <i class="fas fa-user-check"></i>
                         </div>
                         <div>
                              <div class="text-muted" style="font-size:11px"><?= $status_ver === 'Y' ? 'Diverifikasi oleh' : 'Ditolak (Verifikasi) oleh' ?></div>
                              <div class="fw-semibold small"><?= htmlspecialchars($berkas->verifikator_name) ?></div>
                              <?php if (!empty($berkas->verifikasi_tanggal)): ?>
                              <div class="text-muted" style="font-size:11px">
                                   <i class="far fa-clock me-1"></i><?= date('d F Y H:i', strtotime($berkas->verifikasi_tanggal)) ?>
                              </div>
                              <?php endif; ?>
                         </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($status_tte === 'Y' && !empty($berkas->signer_name)): ?>
                    <!-- Penanda Tangan -->
                    <div class="detail-info-row">
                         <div class="detail-info-icon" style="background:rgba(40,167,69,.12); color:#28a745">
                              <i class="fas fa-pen-nib"></i>
                         </div>
                         <div>
                              <div class="text-muted" style="font-size:11px">Ditandatangani oleh</div>
                              <div class="fw-semibold small"><?= htmlspecialchars($berkas->signer_name) ?></div>
                              <?php if (!empty($berkas->tte_tanggal)): ?>
                              <div class="text-muted" style="font-size:11px">
                                   <i class="far fa-clock me-1"></i><?= date('d F Y H:i', strtotime($berkas->tte_tanggal)) ?>
                              </div>
                              <?php endif; ?>
                         </div>
                    </div>
                    <?php endif; ?>

               </div>
          </div>

          <!-- Tombol Aksi: Admin Penilaian (belum dinilai) -->
          <?php if ($role === 'admin' && $status_pen === null): ?>
          <div class="card detail-status-card mb-3 border-warning">
               <div class="card-body">
                    <p class="text-muted small mb-2"><i class="fas fa-gavel me-1 text-warning"></i> Berikan penilaian terhadap berkas ini.</p>
                    <div class="d-grid gap-2">
                         <button class="btn btn-success btn-sm" onclick="penilaian('disetujui')">
                              <i class="fas fa-check-circle me-1"></i> Setujui & Teruskan ke Verifikator
                         </button>
                         <button class="btn btn-danger btn-sm" onclick="penilaian('ditolak')">
                              <i class="fas fa-times-circle me-1"></i> Tolak Berkas
                         </button>
                    </div>
               </div>
          </div>
          <?php endif; ?>

          <!-- Tombol Aksi: Admin ubah penilaian (hanya bisa jika belum diverifikasi & belum TTE) -->
          <?php if ($role === 'admin' && $status_pen !== null && $status_ver !== 'Y' && $status_tte !== 'Y'): ?>
          <div class="card detail-status-card mb-3">
               <div class="card-body">
                    <div class="text-muted small mb-2"><i class="fas fa-redo me-1"></i> Ubah Penilaian</div>
                    <div class="d-flex gap-2">
                         <button class="btn btn-success btn-xs flex-fill" onclick="penilaian('disetujui')">
                              <i class="fas fa-check me-1"></i> Setujui
                         </button>
                         <button class="btn btn-danger btn-xs flex-fill" onclick="penilaian('ditolak')">
                              <i class="fas fa-times me-1"></i> Tolak
                         </button>
                    </div>
               </div>
          </div>
          <?php endif; ?>

          <!-- Tombol Aksi: Verifikator LKD -->
          <?php if ($role === 'verifikator_lkd' && $status_pen === 'Y' && $status_ver === 'N'): ?>
          <div class="card detail-status-card mb-3 border-info">
               <div class="card-body">
                    <p class="text-muted small mb-2"><i class="fas fa-clipboard-check me-1 text-info"></i> Lakukan verifikasi berkas.</p>
                    <div class="d-grid gap-2">
                         <button class="btn btn-info btn-sm" onclick="verifikasi('terverifikasi')">
                              <i class="fas fa-check-double me-1"></i> Verifikasi & Teruskan ke Kepala LKD
                         </button>
                         <button class="btn btn-danger btn-sm" onclick="verifikasi('ditolak')">
                              <i class="fas fa-times-circle me-1"></i> Tolak Berkas
                         </button>
                    </div>
               </div>
          </div>
          <?php endif; ?>

          <!-- Tombol Aksi: Verifikator ubah verifikasi -->
          <?php if ($role === 'verifikator_lkd' && $status_pen === 'Y' && $status_ver !== 'N'): ?>
          <div class="card detail-status-card mb-3">
               <div class="card-body">
                    <div class="text-muted small mb-2"><i class="fas fa-redo me-1"></i> Ubah Verifikasi</div>
                    <div class="d-flex gap-2">
                         <button class="btn btn-info btn-xs flex-fill" onclick="verifikasi('terverifikasi')">
                              <i class="fas fa-check me-1"></i> Terverifikasi
                         </button>
                         <button class="btn btn-danger btn-xs flex-fill" onclick="verifikasi('ditolak')">
                              <i class="fas fa-times me-1"></i> Tolak
                         </button>
                    </div>
               </div>
          </div>
          <?php endif; ?>

          <!-- Tombol Aksi: Kepala LKD — TTE -->
          <?php if ($role === 'kepala_lkd' && $status_ver === 'Y' && $status_tte !== 'Y'): ?>
          <div class="card detail-status-card mb-3 border-primary">
               <div class="card-body">
                    <p class="text-muted small mb-2"><i class="fas fa-file-signature me-1 text-primary"></i> Berkas siap ditandatangani secara elektronik.</p>
                    <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalPassphrase">
                         <i class="fas fa-pen-nib me-1"></i> Tandatangani Dokumen
                    </button>
               </div>
          </div>
          <?php endif; ?>

          <!-- Status: Kepala LKD sudah TTE -->
          <?php if ($role === 'kepala_lkd' && $status_tte === 'Y'): ?>
          <div class="card detail-status-card mb-3 border-success">
               <div class="card-body text-center py-3">
                    <i class="fas fa-check-double text-success fa-2x mb-2"></i>
                    <p class="text-success fw-semibold mb-0 small">Dokumen Telah Ditandatangani Elektronik</p>
               </div>
          </div>
          <?php endif; ?>

          <!-- Download Dokumen TTE -->
          <?php if (!empty($berkas->tte_dokumen)): ?>
          <a href="<?= base_url('assets/upload/berkas/' . $berkas->tte_dokumen) ?>" target="_blank" class="btn btn-success w-100 mb-2">
               <i class="fas fa-file-signature me-1"></i> Unduh Dokumen TTE
          </a>
          <?php endif; ?>

          <!-- Download Draft PDF (hanya tampil jika belum TTE) -->
          <?php if (!empty($berkas->file) && empty($berkas->tte_dokumen)): ?>
          <a href="<?= base_url('assets/upload/berkas/' . $berkas->file) ?>" target="_blank" class="btn btn-outline-danger w-100 mb-3">
               <i class="fas fa-file-pdf me-1"></i> Unduh Draf Dokumen
          </a>
          <?php endif; ?>

          <!-- Monitoring -->
          <div class="card detail-status-card">
               <div class="card-header border-0 pb-0">
                    <h5 class="text-primary d-inline">Monitoring</h5>
               </div>
               <div class="card-body">
                    <?php if (!empty($monitorings)):
                         $isFirst = true; ?>
                    <div class="widget-timeline">
                         <ul class="timeline">
                              <?php foreach ($monitorings as $monitoring):
                                   switch ($monitoring->title) {
                                        case 'process': $badge_color = 'warning'; break;
                                        case 'reject':  $badge_color = 'danger';  break;
                                        case 'done':    $badge_color = 'success'; break;
                                        default:        $badge_color = 'primary'; break;
                                   } ?>
                              <li>
                                   <?php if ($isFirst): ?>
                                   <div class="timeline-badge <?= $badge_color; ?> pulse"></div>
                                   <?php $isFirst = false; else: ?>
                                   <div class="timeline-badge <?= $badge_color; ?>"></div>
                                   <?php endif; ?>
                                   <a class="timeline-panel text-<?= $badge_color; ?>" href="javascript:void(0);">
                                        <span><?= tgl_indo(date('Y-m-d', strtotime($monitoring->created_at))) . ' - ' . jam_indo(date('H:i:s', strtotime($monitoring->created_at))); ?></span>
                                        <h6 class="mb-0"><?= $monitoring->message; ?></h6>
                                        <p class="mb-0"><?= $monitoring->employee_fullname; ?></p>
                                   </a>
                              </li>
                              <?php endforeach; ?>
                         </ul>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-warning fade show">
                         <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                              <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                              <line x1="12" y1="9" x2="12" y2="13"></line>
                              <line x1="12" y1="17" x2="12.01" y2="17"></line>
                         </svg>
                         <strong>Maaf!</strong> Belum tersedia data monitoring.
                    </div>
                    <?php endif; ?>
               </div>
          </div>

     </div>

     <!-- ====== KOLOM KANAN ====== -->
     <div class="col-lg-8">

          <!-- Info Dokumen -->
          <div class="card detail-status-card mb-3">
               <div class="card-body p-4">

                    <!-- Kode Klasifikasi -->
                    <div class="mb-3">
                         <div class="text-muted small">Kode Klasifikasi</div>
                         <div class="fw-bold fs-6 text-primary"><?= htmlspecialchars($berkas->kode_klsf ?? '-') ?></div>
                    </div>

                    <hr class="my-2">

                    <div class="row g-3">
                         <div class="col-md-6">
                              <div class="text-muted small">Uraian Informasi Arsip</div>
                              <div class="fw-semibold"><?= htmlspecialchars($berkas->uraian_informasi_arsip ?? '-') ?></div>
                         </div>
                         <div class="col-md-6">
                              <div class="text-muted small">Unit Kerja Pencipta</div>
                              <div class="fw-semibold"><?= htmlspecialchars($berkas->unit_kerja_pencipta ?? '-') ?></div>
                         </div>
                         <div class="col-md-4">
                              <div class="text-muted small">Kurun Waktu (Tahun)</div>
                              <div class="fw-semibold"><?= htmlspecialchars($berkas->tahun ?? '-') ?></div>
                         </div>
                         <div class="col-md-4">
                              <div class="text-muted small">Jumlah Dokumen</div>
                              <div class="fw-semibold"><?= $berkas->jumlah ? number_format($berkas->jumlah) . ' dok' : '-' ?></div>
                         </div>
                         <div class="col-md-4">
                              <div class="text-muted small">Tanggal</div>
                              <div class="fw-semibold"><?= htmlspecialchars($berkas->tanggal ?? '-') ?></div>
                         </div>
                         <?php if (!empty($berkas->deskripsi)): ?>
                         <div class="col-12">
                              <div class="text-muted small">Keterangan</div>
                              <div><?= htmlspecialchars($berkas->deskripsi) ?></div>
                         </div>
                         <?php endif; ?>
                    </div>

               </div>
          </div>

          <!-- Pratinjau PDF via PDF.js Canvas + Watermark TTE -->
          <?php if (!empty($berkas->file) || !empty($berkas->tte_dokumen)): ?>
          <?php
          // Gunakan URL single proxy (baca_dokumen) untuk memancing IDM ignore
          $pdfProxyUrl = base_url('v2/backend/alih_media_arsip_usul_serah/baca_dokumen/' . $berkas->id);
          
          if ($status_tte === 'Y' && !empty($berkas->tte_dokumen)) {
              $namaFilePdf = $berkas->tte_dokumen;
          } else {
              $namaFilePdf = $berkas->file;
          }
          $ttePosisi = !empty($berkas->tte_posisi) ? $berkas->tte_posisi : 'null';
          ?>

          <div class="card detail-status-card">
               <div class="card-header d-flex align-items-center justify-content-between py-2 px-4" style="border-bottom:1px solid #f0f0f0; background:#f8f9fa; border-radius:12px 12px 0 0;">
                    <div class="d-flex align-items-center gap-2">
                         <span style="width:10px;height:10px;border-radius:50%;background:#dc3545;display:inline-block;"></span>
                         <span class="text-muted small"><?= htmlspecialchars($namaFilePdf) ?></span>
                    </div>
                    <!-- Navigasi Halaman PDF -->
                    <div class="d-flex align-items-center gap-2">
                         <button type="button" class="btn btn-xs btn-outline-secondary" id="btn-prev-page" disabled>
                              <i class="fas fa-chevron-left"></i>
                         </button>
                         <span class="small fw-semibold" id="page-info">1 / 1</span>
                         <button type="button" class="btn btn-xs btn-outline-secondary" id="btn-next-page" disabled>
                              <i class="fas fa-chevron-right"></i>
                         </button>
                         <span class="text-muted mx-1">|</span>
                         <button type="button" class="btn btn-xs btn-outline-secondary" id="btn-zoom-out" title="Perkecil">
                              <i class="fas fa-search-minus"></i>
                         </button>
                         <span id="zoom-label" class="small fw-semibold" style="min-width:40px;text-align:center;">100%</span>
                         <button type="button" class="btn btn-xs btn-outline-secondary" id="btn-zoom-in" title="Perbesar">
                              <i class="fas fa-search-plus"></i>
                         </button>
                    </div>
               </div>
               <div class="card-body p-0">
                    <div id="pdf-viewer-container">
                         <div id="pdf-page-wrapper" class="d-none">
                              <canvas id="pdf-canvas"></canvas>
                              <!-- Watermark TTE Overlay (read-only) -->
                              <?php if ($status_tte !== 'Y'): ?>
                              <div id="tte-watermark" class="d-none">
                                   <div class="tte-wm-inner">
                                        <i class="fas fa-signature"></i>
                                        <span>Posisi Tanda Tangan</span>
                                   </div>
                              </div>
                              <?php endif; ?>
                         </div>
                         <div id="pdf-loading" class="py-5 text-center text-muted">
                              <i class="fas fa-spinner fa-spin fa-2x mb-3 d-block"></i>
                              Memuat dokumen PDF...
                         </div>
                    </div>
               </div>
          </div>

          <!-- Info Posisi TTE -->
          <?php if (!empty($berkas->tte_posisi)): ?>
          <?php $pos = json_decode($berkas->tte_posisi, true); ?>
          <div class="mt-2 p-3 rounded small" style="background:rgba(231,76,60,0.06); border:1px solid rgba(231,76,60,0.15);">
               <i class="fas fa-map-marker-alt me-1 text-danger"></i>
               <strong>Posisi TTE:</strong>
               Halaman <strong><?= $pos['page'] ?? '-' ?></strong> ·
               Koordinat: <strong><?= ($pos['x'] ?? '-') ?>, <?= ($pos['y'] ?? '-') ?></strong> ·
               Ukuran: <strong><?= ($pos['width'] ?? '-') ?> × <?= ($pos['height'] ?? '-') ?> px</strong>
          </div>
          <?php else: ?>
          <div class="mt-2 p-3 rounded small bg-light text-muted">
               <i class="fas fa-info-circle me-1"></i>
               Posisi TTE belum ditentukan oleh operator. Tanda tangan akan disisipkan secara <em>invisible</em>.
          </div>
          <?php endif; ?>

          <?php endif; ?>


     </div>

</div>

<!-- Modal Passphrase TTE -->
<div class="modal fade" id="modalPassphrase" tabindex="-1" aria-labelledby="modalPassphraseLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header" style="background:#007bff;">
                    <h5 class="modal-title" id="modalPassphraseLabel" style="color:#fff;"><i class="fas fa-key me-2"></i>Masukkan Passphrase TTE</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
               </div>
               <div class="modal-body">
                    <p class="text-muted small">Masukkan passphrase sertifikat elektronik Anda untuk menandatangani dokumen ini.</p>
                    <div class="mb-3">
                         <label class="form-label fw-semibold">Passphrase <span class="text-danger">*</span></label>
                         <div class="input-group">
                              <input type="password" id="inputPassphrase" class="form-control" placeholder="Masukkan passphrase..." autocomplete="off">
                              <button class="btn btn-outline-secondary" type="button" onclick="togglePassphrase()">
                                   <i class="fas fa-eye" id="iconTogglePass"></i>
                              </button>
                         </div>
                         <div id="passError" class="text-danger small mt-1" style="display:none"></div>
                    </div>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btnSubmitTTE" onclick="submitTTE()">
                         <i class="fas fa-pen-nib me-1"></i> Tanda Tangani
                    </button>
               </div>
          </div>
     </div>
</div>

<!-- PDF.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

<script>
var base_url  = '<?php echo base_url(); ?>';
var berkas_id = '<?php echo $berkas->id; ?>';

// ===== PDF.js: Render PDF dengan Watermark TTE =====
<?php if (!empty($berkas->file)): ?>
(function() {
     pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

     var pdfUrl    = '<?= $pdfProxyUrl ?>';
     var ttePosisi = <?= $ttePosisi ?>;
     var pdfDoc    = null;
     var pageNum   = 1;
     var pageScale = 1.0;

     // Load PDF
     pdfjsLib.getDocument({ url: pdfUrl, withCredentials: false }).promise.then(function(pdf) {
          pdfDoc = pdf;
          pageNum = 1;
          document.getElementById('pdf-loading').classList.add('d-none');
          renderPage(pageNum);
     }).catch(function(err) {
          console.error('PDF.js error:', err);
          document.getElementById('pdf-loading').innerHTML =
               '<i class="fas fa-exclamation-triangle text-danger fa-2x mb-3 d-block"></i>' +
               '<span class="text-danger">Gagal memuat PDF. Silakan coba refresh halaman.</span>';
     });

     function renderPage(num) {
          if (!pdfDoc) return;
          pdfDoc.getPage(num).then(function(page) {
               var viewport = page.getViewport({ scale: pageScale });
               var canvas   = document.getElementById('pdf-canvas');
               var ctx      = canvas.getContext('2d');
               canvas.width  = viewport.width;
               canvas.height = viewport.height;

               page.render({ canvasContext: ctx, viewport: viewport }).promise.then(function() {
                    document.getElementById('pdf-page-wrapper').classList.remove('d-none');
                    document.getElementById('page-info').textContent = num + ' / ' + pdfDoc.numPages;
                    document.getElementById('btn-prev-page').disabled = (num <= 1);
                    document.getElementById('btn-next-page').disabled = (num >= pdfDoc.numPages);
                    positionWatermark(canvas.width, canvas.height);
               });
          });
     }

     // Posisi watermark berdasarkan data tte_posisi
     function positionWatermark(canvasW, canvasH) {
          var wm = document.getElementById('tte-watermark');
          if (!ttePosisi || !ttePosisi.page) {
               wm.classList.add('d-none');
               return;
          }

          // Watermark hanya ditampilkan di halaman yang dipilih operator
          if (pageNum !== ttePosisi.page) {
               wm.classList.add('d-none');
               return;
          }

          // Hitung rasio skala antara canvas saat ini dan canvas saat operator mengatur posisi
          var origCanvasW = ttePosisi.canvas_w || canvasW;
          var origCanvasH = ttePosisi.canvas_h || canvasH;
          var ratioW = canvasW / origCanvasW;
          var ratioH = canvasH / origCanvasH;

          var x = Math.round(ttePosisi.x * ratioW);
          var y = Math.round(ttePosisi.y * ratioH);
          var w = Math.round(ttePosisi.width * ratioW);
          var h = Math.round(ttePosisi.height * ratioH);

          wm.style.left   = x + 'px';
          wm.style.top    = y + 'px';
          wm.style.width  = w + 'px';
          wm.style.height = h + 'px';
          wm.classList.remove('d-none');
     }

     // Nav: halaman sebelumnya
     document.getElementById('btn-prev-page').addEventListener('click', function() {
          if (pageNum > 1) { pageNum--; renderPage(pageNum); }
     });
     // Nav: halaman berikutnya
     document.getElementById('btn-next-page').addEventListener('click', function() {
          if (pdfDoc && pageNum < pdfDoc.numPages) { pageNum++; renderPage(pageNum); }
     });
     // Zoom In
     document.getElementById('btn-zoom-in').addEventListener('click', function() {
          pageScale = Math.min(pageScale + 0.25, 3.0);
          document.getElementById('zoom-label').textContent = Math.round(pageScale * 100) + '%';
          if (pdfDoc) renderPage(pageNum);
     });
     // Zoom Out
     document.getElementById('btn-zoom-out').addEventListener('click', function() {
          pageScale = Math.max(pageScale - 0.25, 0.5);
          document.getElementById('zoom-label').textContent = Math.round(pageScale * 100) + '%';
          if (pdfDoc) renderPage(pageNum);
     });
})();
<?php endif; ?>

// ===== Fungsi Aksi: Penilaian, Verifikasi, TTE =====
function penilaian(aksi) {
     var label = aksi === 'disetujui' ? 'menyetujui' : 'menolak';
     Swal.fire({
          title: 'Konfirmasi',
          text: 'Apakah Anda yakin ingin ' + label + ' berkas ini?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: aksi === 'disetujui' ? '#28a745' : '#dc3545',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Ya, ' + label + '!',
          cancelButtonText: 'Batal'
     }).then(function(result) {
          if (result.isConfirmed) {
               $.ajax({
                    url: base_url + 'v2/backend/alih_media_arsip_usul_serah/ajax_penilaian/' + berkas_id,
                    type: 'POST',
                    dataType: 'JSON',
                    data: { aksi: aksi },
                    success: function(res) {
                         if (res.status) {
                              Swal.fire('Berhasil!', res.pesan, 'success').then(function() { location.reload(); });
                         }
                    },
                    error: function() { Swal.fire('Error!', 'Gagal menghubungi server.', 'error'); }
               });
          }
     });
}

function verifikasi(aksi) {
     var label = aksi === 'terverifikasi' ? 'memverifikasi' : 'menolak';
     Swal.fire({
          title: 'Konfirmasi Verifikasi',
          text: 'Apakah Anda yakin ingin ' + label + ' berkas ini?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: aksi === 'terverifikasi' ? '#17a2b8' : '#dc3545',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Ya, ' + label + '!',
          cancelButtonText: 'Batal'
     }).then(function(result) {
          if (result.isConfirmed) {
               $.ajax({
                    url: base_url + 'v2/backend/alih_media_arsip_usul_serah/ajax_verifikasi/' + berkas_id,
                    type: 'POST',
                    dataType: 'JSON',
                    data: { aksi: aksi },
                    success: function(res) {
                         if (res.status) {
                              Swal.fire('Berhasil!', res.pesan, 'success').then(function() { location.reload(); });
                         } else {
                              Swal.fire('Gagal!', res.pesan, 'error');
                         }
                    },
                    error: function() { Swal.fire('Error!', 'Gagal menghubungi server.', 'error'); }
               });
          }
     });
}

function togglePassphrase() {
     var input = document.getElementById('inputPassphrase');
     var icon  = document.getElementById('iconTogglePass');
     if (input.type === 'password') {
          input.type = 'text';
          icon.classList.replace('fa-eye', 'fa-eye-slash');
     } else {
          input.type = 'password';
          icon.classList.replace('fa-eye-slash', 'fa-eye');
     }
}

function submitTTE() {
     var pass  = $('#inputPassphrase').val().trim();
     var errEl = document.getElementById('passError');
     errEl.style.display = 'none';
     if (!pass) {
          errEl.textContent = 'Passphrase tidak boleh kosong.';
          errEl.style.display = 'block';
          return;
     }
     var btn = document.getElementById('btnSubmitTTE');
     btn.disabled = true;
     btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Memproses TTE...';
     $.ajax({
          url: base_url + 'v2/backend/alih_media_arsip_usul_serah/ajax_tte/' + berkas_id,
          type: 'POST',
          dataType: 'JSON',
          data: { passphrase: pass },
          success: function(res) {
               if (res.status) {
                    $('#modalPassphrase').modal('hide');
                    Swal.fire({ title: 'Berhasil!', text: res.pesan, icon: 'success', confirmButtonColor: '#28a745' })
                         .then(function() { location.reload(); });
               } else {
                    errEl.textContent = res.pesan;
                    errEl.style.display = 'block';
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-pen-nib me-1"></i> Tanda Tangani';
               }
          },
          error: function() {
               Swal.fire('Error!', 'Gagal menghubungi server.', 'error');
               btn.disabled = false;
               btn.innerHTML = '<i class="fas fa-pen-nib me-1"></i> Tanda Tangani';
          }
     });
}
</script>
