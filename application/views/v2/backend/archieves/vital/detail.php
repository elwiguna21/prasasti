<link rel="stylesheet" href="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/styles/index.min.css') ?>"/>
<style>
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
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
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

        0%,
        100% {
            border-color: rgba(231, 76, 60, 0.8);
            background: rgba(231, 76, 60, 0.08);
        }

        50% {
            border-color: rgba(231, 76, 60, 0.4);
            background: rgba(231, 76, 60, 0.04);
        }
    }

    .pulse {
        animation: pulse-animation 2s infinite;
    }

    @keyframes pulse-animation {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(52, 152, 219, 0.7);
        }

        70% {
            transform: scale(1);
            box-shadow: 0 0 0 10px rgba(52, 152, 219, 0);
        }

        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(52, 152, 219, 0);
        }
    }
</style>
<?php
$status_name = '';
$status_color = '';
$status_icon = '';

$verifikasi_status_name = '';
$verifikasi_status_color = '';
$verifikasi_status_icon = '';

$tte_status_name = '';
$tte_status_color = '';
$tte_status_icon = '';

if ($archieve->verifikasi_status == 'R') {
	$status_name = 'Ditolak Verifikator';
	$status_color = 'danger';
	$status_icon = 'fa fa-exclamation-triangle';
} else if ($archieve->verifikasi_status == 'Y' and $archieve->tte_status == 'N') {
	$status_name = 'Menunggu Ditandatangan';
	$status_color = 'info';
	$status_icon = 'las la-file-signature';
} else if ($archieve->verifikasi_status == 'Y' and $archieve->tte_status == 'R') {
	$status_name = 'Ditolak Penandatangan';
	$status_color = 'danger';
	$status_icon = 'fa fa-exclamation-triangle';
} else if ($archieve->tte_status == 'Y') {
	$status_name = 'Sudah Ditandatangani';
	$status_color = 'success';
	$status_icon = 'las la-signature';
} else {
	$status_name = 'Menunggu Verifikasi';
	$status_color = 'warning';
	$status_icon = 'las la-clock';
}

if ($archieve->verifikasi_status == 'Y') {
	$verifikasi_status_icon = 'fas fa-check-circle';
} else if ($archieve->verifikasi_status == 'R') {
	$verifikasi_status_icon = 'fa fa-exclamation-triangle';
}

?>
<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('v2/alih_media_arsip_vital') ?>">Daftar Arsip
                    Vital</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Detail</a></li>
     </ol>
</div>

<?php if (!empty($this->session->flashdata('status'))) {
	$status = $this->session->flashdata('status');
	?>
     <div class="alert alert-<?= ($status == 200) ? 'success' : 'danger'; ?> left-icon-big alert-dismissible fade show">
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i
                            class="mdi mdi-btn-close"></i></span>
          </button>
          <div class="media">
               <div class="alert-left-icon-big">
                    <span><i class="mdi mdi-<?= ($status == 200) ? 'check-circle-outline' : 'alert'; ?>"></i></span>
               </div>
               <div class="media-body">
                    <h5 class="mt-1 mb-2"><?= ($status == 200) ? 'Berhasil' : 'Gagal' ?>!</h5>
                    <p class="mb-0"><?= $this->session->flashdata('message'); ?></p>
               </div>
          </div>
     </div>
<?php } ?>

<div class="media mb-2 mt-3">
     <div class="media-body">
          <div class="pull-end">
               <a href="<?= base_url('v2/alih_media_arsip_vital') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
               </a>
          </div>
          <h5 class="my-1 text-primary"><?= $archieve->indek ?? '-'; ?></h5>
          <p class="read-content-email"><?= $archieve->kode_klsf ?? '-'; ?></p>
     </div>
</div>

<div class="row g-3 align-items-start">
     <div class="col-lg-4">
          <div class="row">
               <div class="col-xl-12">
                    <div class="card">
                         <div class="card-header">
                              <div class="iconbox">
                                   <i class="<?= $status_icon; ?> bg-<?= $status_color; ?>"></i>
                                   <small>Status</small>
                                   <p class="text-<?= $status_color; ?>"><?= $status_name; ?></p>
                              </div>
                         </div>
                         <div class="card-body">
                              <div class="widget-media">
                                   <ul class="timeline">
                                        <li>
                                             <div class="timeline-panel">
                                                  <div class="media me-2 media-info">
                                                       <i class="fas fa-user-edit"></i>
                                                  </div>
                                                  <div class="media-body">
                                                       <small class="d-block">Pembuat</small>
                                                       <h6 class="mb-1"><?= $archieve->creator->fullname ?? '-'; ?></h6>
                                                       <small class="d-block"><?= tgl_indo(date('Y-m-d', strtotime($archieve->tanggal))) ?></small>
                                                  </div>
                                             </div>
                                        </li>
								<?php if (in_array($archieve->verifikasi_status, ['Y', 'R'])) { ?>
                                             <li>
                                                  <div class="timeline-panel">
                                                       <div class="media me-2 media-warning">
                                                            <i class="fas fa-user-check"></i>
                                                       </div>
                                                       <div class="media-body">
												<?php if ($archieve->verifikasi_status == 'Y') { ?>
                                                                 <small class="d-block">Diverifikasi oleh</small>
												<?php } else if ($archieve->verifikasi_status == 'R') { ?>
                                                                 <small class="d-block">Ditolak oleh</small>
												<?php } ?>

                                                            <h6 class="mb-1"><?= $archieve->verificator->fullname; ?></h6>
                                                            <small class="d-block"><?= tgl_indo(date('Y-m-d', strtotime($archieve->verifikasi_tanggal))) ?></small>
                                                       </div>
                                                  </div>
                                             </li>
									<?php if ($archieve->verifikasi_status == 'R') { ?>
                                                  <li>
                                                       <div class="timeline-panel">
                                                            <div class="media me-2 media-danger">
                                                                 <i class="las la-info-circle"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                 <small class="d-block">Penolakan Verifikasi</small>
                                                                 <h6 class="mb-1"><?= ucfirst($archieve->verifikasi_message); ?></h6>
                                                            </div>
                                                       </div>
                                                  </li>
									<?php } ?>
								<?php } ?>
								<?php if (in_array($archieve->tte_status, ['Y', 'R'])) { ?>
                                             <li>
                                                  <div class="timeline-panel">
                                                       <div class="media me-2 media-success">
                                                            <i class="las la-signature"></i>
                                                       </div>
                                                       <div class="media-body">
												<?php if ($archieve->tte_status == 'Y') { ?>
                                                                 <small class="d-block">Ditandatangani oleh</small>
												<?php } else if ($archieve->tte_status == 'R') { ?>
                                                                 <small class="d-block">Ditolak oleh</small>
												<?php } ?>
                                                            <h6 class="mb-1"><?= $archieve->signer->fullname; ?></h6>
                                                            <small class="d-block"><?= tgl_indo(date('Y-m-d', strtotime($archieve->tte_tanggal))) ?></small>
                                                       </div>
                                                  </div>
                                             </li>
									<?php if ($archieve->tte_status == 'R') { ?>
                                                  <li>
                                                       <div class="timeline-panel">
                                                            <div class="media me-2 media-danger">
                                                                 <i class="las la-info-circle"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                 <small class="d-block">Penolakan TTE</small>
                                                                 <h6 class="mb-1"><?= ucfirst($archieve->tte_message); ?></h6>
                                                            </div>
                                                       </div>
                                                  </li>
									<?php } ?>
								<?php } ?>
                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>

               <!-- action button -->
               <div class="col-xl-12 mb-3">
				<?php if (($archieve->verifikasi_status != 'Y' or $archieve->verifikasi_status == null) and $this->session->userdata('next-role') == 'operator') {
					$params = array('archieve' => $archieve->id, 'company' => $archieve->nomor_skpd);
					?>
                         <a href="<?= base_url('v2/alih_media_arsip_vital/edit?' . http_build_query($params)); ?>"
                            class="btn btn-sm btn-warning w-100 mb-3">
                              <i class="fas fa-edit me-1"></i> Ubah Arsip
                         </a>
                         <a href="javascript:void(0);" class="btn light btn-sm btn-danger w-100 mb-3 btn-delete"
                            data-archieve="<?= $archieve->id; ?>" data-company="<?= $archieve->nomor_skpd; ?>">
                              <i class="fas fa-trash me-1"></i> Hapus Arsip
                         </a>
				<?php } ?>

				<?php if ($archieve->verifikasi_status == 'R' and $this->session->userdata('next-role') == 'operator') { ?>
                         <a href="javascript:void(0);" class="btn btn-sm btn-info w-100 mb-3 btn-resend"
                            data-archieve="<?= $archieve->id; ?>" data-company="<?= $archieve->nomor_skpd; ?>">
                              <i class="fas fa-arrow-right-from-file me-1"></i> Kirim Kembali ke Verifikator
                         </a>
				<?php } ?>

				<?php if ($this->session->userdata('next-role') == 'verifikator_skpd') {
					?>
					<?php if ($archieve->verifikasi_status == 'N') { ?>
                              <a href="javascript:void(0);" class="btn btn-sm btn-success btn-verification w-100 mb-3"
                                 data-archieve="<?= $archieve->id; ?>" data-company="<?= $archieve->nomor_skpd; ?>">
                                   <i class="fas fa-user-check me-1"></i> Setujui & Teruskan ke Kepala SKPD
                              </a>
                              <a href="javascript:void(0);" class="btn btn-sm btn-danger w-100 mb-3 btn-reject"
                                 data-archieve="<?= $archieve->id; ?>" data-company="<?= $archieve->nomor_skpd; ?>">
                                   <i class="fas fa-close me-1"></i> Tolak Pengajuan
                              </a>
					<?php } else if ($archieve->tte_status == 'R') { ?>
                              <a href="javascript:void(0);" class="btn btn-sm btn-info btn-resend w-100 mb-3"
                                 data-archieve="<?= $archieve->id; ?>" data-company="<?= $archieve->nomor_skpd; ?>">
                                   <i class="fas fa-arrow-right-from-file me-1"></i> Kirim ulang ke Kepala SKPD
                              </a>
					<?php } ?>

				<?php } ?>



				<?php if ($archieve->tte_status == 'N' and $this->session->userdata('next-role') == 'kepala_skpd') { ?>
					<?php if (file_exists('./assets/upload/berkas/' . $archieve->file)) { ?>
                              <a href="javascript:void(0);" class="btn btn-sm btn-success btn-sign w-100 mb-3">
                                   <i class="fas fa-file-signature me-1"></i> Tandatangani Dokumen
                              </a>
					<?php } ?>


                         <a href="javascript:void(0);" class="btn btn-sm btn-danger w-100 mb-3 btn-unsign"
                            data-archieve="<?= $archieve->id; ?>" data-company="<?= $archieve->nomor_skpd; ?>">
                              <i class="fas fa-mail-reply me-1"></i> Kembalikan ke Verifikator
                         </a>
				<?php } ?>

				<?php if ($archieve->tte_status == 'Y' and file_exists('./assets/upload/berkas/' . $archieve->tte_dokumen)) { ?>
                         <a href="<?= base_url('assets/upload/berkas/' . $archieve->tte_dokumen) ?>" target="_blank"
                            class="btn light btn-success btn-sm w-100 mb-3">
                              <i class="fas fa-file-pdf me-1"></i> Unduh Dokumen TTE
                         </a>
				<?php } else {
					if (file_exists('./assets/upload/berkas/' . $archieve->file)) { ?>
                              <a href="<?= base_url('assets/upload/berkas/') . $archieve->file; ?>" target="_blank" class="btn light btn-info btn-sm w-100 mb-3">
                                   <i class="fas fa-file-pdf me-1"></i> Unduh Draf
                              </a>
					<?php } else if (file_exists('./assets/data/' . $archieve->file)) { ?>
                              <a href="<?= base_url('assets/data/') . $archieve->file; ?>" target="_blank" class="btn light btn-info btn-sm w-100 mb-3">
                                   <i class="fas fa-file-pdf me-1"></i> Unduh Draf
                              </a>
					<?php } else { ?>
                              <a href="javascript:void(0);" class="btn light btn-outline-danger btn-sm w-100 mb-3 disabled">
                                   <i class="fas fa-exclamation-triangle me-1"></i> Unduh Draf
                              </a>
					<?php } ?>
				<?php } ?>
               </div>

               <!-- Monitoring -->
               <div class="col-xl-12">
                    <div class="card">
                         <div class="card-header border-0 pb-0">
                              <!-- <h4 class="card-title">Monitoring</h4> -->
                              <h5 class="text-primary d-inline">Monitoring</h5>
                         </div>
                         <div class="card-body">
						<?php if (!empty($monitorings)) {
							$isFirst = true;
							?>
                                   <div class="widget-timeline">
                                        <ul class="timeline">
									<?php foreach ($monitorings as $monitoring) {
										switch ($monitoring->title) {
											case 'process':
												$badge_color = 'warning';
												break;
											case 'reject':
												$badge_color = 'danger';
												break;
											case 'done':
												$badge_color = 'success';
												break;
											default:
												$badge_color = 'primary';
												break;
										}
										?>
                                                  <li>
											<?php if ($isFirst) { ?>
                                                            <div class="timeline-badge <?= $badge_color; ?> pulse"></div>
												<?php $isFirst = false;
											} else { ?>
                                                            <div class="timeline-badge <?= $badge_color; ?>"></div>
											<?php } ?>
                                                       <a class="timeline-panel text-<?= $badge_color; ?>"
                                                          href="javascript:void(0);">
                                                            <span><?= tgl_indo(date('Y-m-d', strtotime($monitoring->created_at))) . ' - ' . jam_indo(date('H:i:s', strtotime($monitoring->created_at))); ?></span>
                                                            <h6 class="mb-0"><?= $monitoring->message; ?></h6>
                                                            <p class="mb-0"><?= $monitoring->employee_fullname; ?></p>
                                                       </a>

                                                  </li>
									<?php } ?>
                                        </ul>
                                   </div>
						<?php } else { ?>
                                   <div class="alert alert-warning fade show">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                             stroke-width="2"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                             <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                             <line x1="12" y1="9" x2="12" y2="13"></line>
                                             <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                        </svg>
                                        <strong>Maaf!</strong> Belum tersedia data monitoring.
                                   </div>
						<?php } ?>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-lg-8">
          <div class="card">
               <div class="card-header">
                    <div class="iconbox px-0">
                         <small>Kode Klasifikasi</small>
                         <p class="text-primary"><?= (!empty($archieve->kode_klsf)) ? $archieve->kode_klsf : '-'; ?></p>
                    </div>
               </div>
               <div class="card-body">
                    <div class="row">
                         <div class="col-lg-6 col-sm-12 mb-4">
                              <h6>Uraian Informasi Arsip:</h6>
                              <div><?= $archieve->uraian_informasi_arsip ?? '-'; ?></div>
                         </div>
                         <div class="col-lg-6 col-sm-12 mb-4">
                              <h6>Unit Kerja Pencipta:</h6>
                              <div><?= $archieve->unit_kerja_pencipta ?? '-'; ?></div>
                         </div>
                         <div class="mb-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                              <h6>Kurun Waktu (Tahun):</h6>
                              <div><?= $archieve->tahun; ?></div>
                         </div>
                         <div class="mb-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                              <h6>Jumlah Dokumen:</h6>
                              <div><?= $archieve->jumlah ?? '-' ?></div>
                         </div>
                         <div class="mb-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                              <h6>Tanggal Arsip:</h6>
                              <div><?= tgl_indo(date('Y-m-d', strtotime($archieve->tanggal))); ?></div>
                         </div>
                         <div class="col-xl-12">
                              <h6>Keterangan:</h6>
                              <div><?= $archieve->deskripsi ?? '-'; ?></div>
                         </div>
                    </div>
               </div>
          </div>


		<?php if (!empty($archieve->file) || !empty($archieve->tte_dokumen)) { ?>
			<?php
			// Selalu gunakan route proxy IDM bypass
			$pdfProxyUrl = base_url('v2/alih_media_arsip_vital/baca_dokumen?' . http_build_query(array('archieve' => $archieve->id)));
			
			if ($archieve->tte_status === 'Y' && !empty($archieve->tte_dokumen)) {
				$namaFilePdf = $archieve->tte_dokumen;
			} else {
				$namaFilePdf = $archieve->file;
			}
			$ttePosisi = !empty($archieve->tte_posisi) ? $archieve->tte_posisi : null;
			?>
               <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between py-2 px-4"
                         style="border-bottom:1px solid #f0f0f0; background:#f8f9fa; border-radius:12px 12px 0 0;">
                         <div class="d-flex align-items-center gap-2">
                              <span style="width:10px;height:10px;border-radius:50%;background:#dc3545;display:inline-block;"></span>
                              <span class="text-muted small"><?= htmlspecialchars($namaFilePdf) ?></span>
                         </div>
                         <!-- Navigasi Halaman PDF -->
                         <div class="d-flex align-items-center gap-2">
                              <button type="button" class="btn btn-xs btn-outline-secondary" id="btn-prev-page"
                                      disabled>
                                   <i class="fas fa-chevron-left"></i>
                              </button>
                              <span class="small fw-semibold" id="page-info">1 / 1</span>
                              <button type="button" class="btn btn-xs btn-outline-secondary" id="btn-next-page"
                                      disabled>
                                   <i class="fas fa-chevron-right"></i>
                              </button>
                              <span class="text-muted mx-1">|</span>
                              <button type="button" class="btn btn-xs btn-outline-secondary" id="btn-zoom-out"
                                      title="Perkecil">
                                   <i class="fas fa-search-minus"></i>
                              </button>
                              <span id="zoom-label" class="small fw-semibold"
                                    style="min-width:40px;text-align:center;">100%</span>
                              <button type="button" class="btn btn-xs btn-outline-secondary" id="btn-zoom-in"
                                      title="Perbesar">
                                   <i class="fas fa-search-plus"></i>
                              </button>
                         </div>
                    </div>
                    <div class="card-body p-0">
                         <div id="pdf-viewer-container">
                              <div id="pdf-page-wrapper" class="d-none">
                                   <canvas id="pdf-canvas"></canvas>
                                   <!-- Watermark TTE Overlay (read-only) -->
							<?php if ($archieve->tte_status !== 'Y'): ?>
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
			<?php if (!empty($archieve->tte_posisi)): ?>
				<?php $pos = json_decode($archieve->tte_posisi, true); ?>
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
		<?php } else { ?>
               <div class="alert alert-warning fade show">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
                         stroke-linecap="round" stroke-linejoin="round" class="me-2">
                         <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                         <line x1="12" y1="9" x2="12" y2="13"></line>
                         <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                    <strong>Kesalahan!</strong> Terjadi kesalahan pada dokumen arsip.
               </div>
		<?php } ?>
     </div>
</div>

<?php if (in_array($employee->user_role, array('verifikator_skpd', 'kepala_skpd'))) { ?>
     <div class="modal fade reject-modal" id="reject-modal" data-bs-backdrop="static" data-bs-keyboard="false"
          role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title"
                             id="modal-title"><?= ($employee->user_role == 'verifikator_skpd') ? 'Tolak Verifikasi' : 'Tolak Penandatanganan'; ?></h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal">
                         </button>
                    </div>
                    <form action="<?= base_url('v2/archieves/vital_reject') ?>" method="post">
                         <div class="modal-body">
                              <input type="hidden" class="form-control" name="archieve" value="<?= $archieve->id; ?>"
                                     readonly
                                     required>
                              <input type="hidden" class="form-control" name="company"
                                     value="<?= $archieve->nomor_skpd; ?>"
                                     readonly required>
                              <div class="row">
                                   <div class="mb-3 col-md-6">
                                        <label class="form-label">Kode Klasifikasi:</label>
                                        <h6 class="text-primary"><?= $archieve->kode_klsf ?? '-'; ?></h6>
                                   </div>
                                   <div class="mb-3 col-md-6">
                                        <label class="form-label">Indeks:</label>
                                        <h6 class="text-primary"><?= $archieve->indek ?? '-'; ?></h6>
                                   </div>
                                   <div class="mb-0 col-md-12">
                                        <label class="form-label">Keterangan Penolakan: <span
                                                     class="text-danger">*</span></label>
                                        <textarea name="description" class="form-control"
                                                  placeholder="Masukan keterangan / deskripsi penolakan"
                                                  required></textarea>
                                   </div>
                              </div>
                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-danger light me-3" data-bs-dismiss="modal">Batal
                              </button>
                              <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>

	<?php if ($employee->user_role == 'kepala_skpd') { ?>
          <div class="modal fade passphrase-modal" id="passphrase-modal" data-bs-backdrop="static"
               data-bs-keyboard="false"
               role="dialog" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                         <div class="modal-header bg-primary text-white">
                              <h5 class="modal-title text-white" id="modal-title"><i class="fas fa-key me-2"></i>Masukkan
                                   Passphrase TTE</h5>
                              <button type="button" class="btn-close" style="color: #fff;" data-bs-dismiss="modal">
                              </button>
                         </div>
                         <form id="passphrase-form" action="<?= base_url('v2/alih_media_arsip_vital/signed') ?>" method="post">
                              <div class="modal-body">
                                   <div class="row">
                                        <input type="hidden" class="form-control" name="archieve"
                                               value="<?= $archieve->id; ?>" required readonly>
                                        <input type="hidden" class="form-control" name="company"
                                               value="<?= $archieve->nomor_skpd; ?>" required readonly>

                                        <div class="mb-0 col-md-12">
                                             <label class="form-label">Passphrase TTE <span
                                                          class="text-danger">*</span></label>
                                             <div class="input-group">
                                                  <input type="password" class="form-control" name="passphrase"
                                                         id="passphrase"
                                                         placeholder="Masukan passphrase anda" required
                                                         autocomplete="off">
                                                  <a href="javascript:void(0);"
                                                     class="btn btn-primary waves-effect waves-light"
                                                     id="password-addon" onclick="createpassword('passphrase', this)"><i
                                                               class="mdi mdi-eye-outline"></i></a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-danger light me-3" data-bs-dismiss="modal">Batal
                                   </button>
                                   <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
	<?php } ?>
<?php } ?>

<!-- PDF.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/bundle/popular.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/plugin-bootstrap5/index.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/plugin-auto-focus/index.js') ?>"></script>

<script>
    (function () {
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        var pdfUrl = '<?= $pdfProxyUrl ?>';
        var ttePosisi = '<?= $ttePosisi ?>';
        if (ttePosisi !== '' || ttePosisi != null) {
            ttePosisi = JSON.parse(ttePosisi);
        }

        var pdfDoc = null;
        var pageNum = 1;
        var pageScale = 1.0;

        // Load PDF
        pdfjsLib.getDocument({
            url: pdfUrl,
            withCredentials: false
        }).promise.then(function (pdf) {
            pdfDoc = pdf;
            pageNum = 1;
            document.getElementById('pdf-loading').classList.add('d-none');
            renderPage(pageNum);
        }).catch(function (err) {
            console.log("PDF.js error: " + err);
            document.getElementById('pdf-loading').innerHTML =
                '<i class="fas fa-exclamation-triangle text-danger fa-2x mb-3 d-block"></i>' +
                '<span class="text-danger">Gagal memuat PDF. Silakan coba refresh halaman.</span>';
        });

        function renderPage(num) {
            if (!pdfDoc) return;
            pdfDoc.getPage(num).then(function (page) {
                var viewport = page.getViewport({
                    scale: pageScale
                });
                var canvas = document.getElementById('pdf-canvas');
                var ctx = canvas.getContext('2d');
                canvas.width = viewport.width;
                canvas.height = viewport.height;

                page.render({
                    canvasContext: ctx,
                    viewport: viewport
                }).promise.then(function () {
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

            wm.style.left = x + 'px';
            wm.style.top = y + 'px';
            wm.style.width = w + 'px';
            wm.style.height = h + 'px';
            wm.classList.remove('d-none');
        }

        // Nav: halaman sebelumnya
        document.getElementById('btn-prev-page').addEventListener('click', function () {
            if (pageNum > 1) {
                pageNum--;
                renderPage(pageNum);
            }
        });
        // Nav: halaman berikutnya
        document.getElementById('btn-next-page').addEventListener('click', function () {
            if (pdfDoc && pageNum < pdfDoc.numPages) {
                pageNum++;
                renderPage(pageNum);
            }
        });
        // Zoom In
        document.getElementById('btn-zoom-in').addEventListener('click', function () {
            pageScale = Math.min(pageScale + 0.25, 3.0);
            document.getElementById('zoom-label').textContent = Math.round(pageScale * 100) + '%';
            if (pdfDoc) renderPage(pageNum);
        });
        // Zoom Out
        document.getElementById('btn-zoom-out').addEventListener('click', function () {
            pageScale = Math.max(pageScale - 0.25, 0.5);
            document.getElementById('zoom-label').textContent = Math.round(pageScale * 100) + '%';
            if (pdfDoc) renderPage(pageNum);
        });
    })();

    <?php if ($employee->user_role == 'operator' and in_array($archieve->verifikasi_status, array('N', 'R', null))) { ?>
    $('.btn-delete').click(function () {
        let archieve = $(this).data('archieve');
        let company = $(this).data('company');

        Swal.fire({
            title: "Hapus Arsip",
            text: "Apakah anda akan menghapus arsip tersebut?",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
            allowOutsideClick: false,
            allowEscapeKey: false,
            customClass: {
                confirmButton: "btn btn-danger mt-2",
                cancelButton: "btn light btn-warning ms-3 mt-2"
            },
            buttonsStyling: !1
        }).then(function (t) {
            if (t.isConfirmed) {
                Swal.fire({
                    title: "Mohon tunggu...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: function () {
                        Swal.showLoading();
                    }
                });

                $.post("<?= base_url('v2/alih_media_arsip_vital/delete') ?>", {
                    archieve: archieve,
                    company: company,
                }, function (data, status) {
                    if (status == 'success') {
                        let respons = JSON.parse(data);
                        if (respons.status == 200) {
                            console.log(respons);

                            Swal.fire({
                                title: (respons.status == 200) ? 'Berhasil' : 'Gagal',
                                text: respons.message,
                                icon: (respons.status == 200) ? 'success' : 'error',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then(function () {
                                window.location.href = "<?= base_url('v2/alih_media_arsip_vital') ?>";
                            });
                        } else {
                            Swal.fire({
                                title: (respons.status == 200) ? 'Berhasil' : 'Gagal',
                                text: respons.message,
                                icon: (respons.status == 200) ? 'success' : 'error'
                            });
                        }
                    } else {
                        Swal.fire('Kesalahan', 'Terjadi kesalahan saat mengirimkan data ke server untuk penghapusan arsip!', 'error');
                    }
                }).fail(function () {
                    Swal.fire('Kesalahan', 'Terjadi kesalahan saat menghubungkan ke server untuk penghapusan arsip!', 'error');
                });
            } else if (t.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: "Batal",
                    text: "Anda membatalkan penghapusan arsip :)",
                    icon: "error"
                });
            }
        });
    });
    <?php } else if ($employee->user_role == 'verifikator_skpd') { ?>
    $('.btn-verification').click(function () {
        let archieve = $(this).data('archieve');
        let company = $(this).data('company');

        Swal.fire({
            title: "Verifikasi Arsip",
            text: "Apakah anda akan memverifikasi arsip tersebut?",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Verifikasi!",
            cancelButtonText: "Batal",
            allowOutsideClick: false,
            allowEscapeKey: false,
            customClass: {
                confirmButton: "btn btn-success mt-2",
                cancelButton: "btn light btn-warning ms-3 mt-2"
            },
            buttonsStyling: !1
        }).then(function (t) {
            if (t.isConfirmed) {
                Swal.fire({
                    title: "Mohon tunggu...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: function () {
                        Swal.showLoading();
                    }
                });

                $.post("<?= base_url('v2/alih_media_arsip_vital/verification') ?>", {
                    status: 'Y',
                    archieve: archieve,
                    company: company,
                }, function (data, status) {
                    if (status == 'success') {
                        let respons = JSON.parse(data);
                        Swal.fire({
                            title: (respons.status == 200) ? 'Berhasil' : 'Gagal',
                            text: respons.message,
                            icon: (respons.status == 200) ? 'success' : 'error',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire('Kesalahan', 'Terjadi kesalahan saat mengirimkan data ke server untuk verifikasi arsip!', 'error');
                    }
                }).fail(function () {
                    Swal.fire('Kesalahan', 'Terjadi kesalahan saat menghubungkan ke server untuk verifikasi arsip!', 'error');
                });
            } else if (t.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: "Batal",
                    text: "Anda membatalkan verifikasi arsip :)",
                    icon: "error"
                });
            }
        });
    });

    $('.btn-reject').click(function () {
        let archieve = $(this).data('archieve');
        let company = $(this).data('company');

        Swal.fire({
            title: "Verifikasi Arsip",
            text: "Apakah anda akan menolak arsip tersebut?",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Tolak!",
            cancelButtonText: "Batal",
            allowOutsideClick: false,
            allowEscapeKey: false,
            customClass: {
                confirmButton: "btn btn-danger mt-2",
                cancelButton: "btn light btn-warning ms-3 mt-2"
            },
            buttonsStyling: !1
        }).then(function (t) {
            if (t.isConfirmed) {
                Swal.fire({
                    title: "Mohon tunggu...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: function () {
                        Swal.showLoading();
                    }
                });

                setTimeout(() => {
                    Swal.close();
                    $('.reject-modal').modal('show');
                }, 500);
            } else if (t.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: "Batal",
                    text: "Anda membatalkan penolakan verifikasi :)",
                    icon: "error"
                });
            }
        });
    });
    <?php } else if ($employee->user_role == 'kepala_skpd') { ?>
    $('.btn-unsign').click(function () {
        let archieve = $(this).data('archieve');
        let company = $(this).data('company');

        Swal.fire({
            title: "Tolak Penandatangan",
            text: "Apakah anda akan menolak penandatangan arsip tersebut?",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Tolak!",
            cancelButtonText: "Batal",
            allowOutsideClick: false,
            allowEscapeKey: false,
            customClass: {
                confirmButton: "btn btn-danger mt-2",
                cancelButton: "btn light btn-warning ms-3 mt-2"
            },
            buttonsStyling: !1
        }).then(function (t) {
            if (t.isConfirmed) {
                Swal.fire({
                    title: "Mohon tunggu...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: function () {
                        Swal.showLoading();
                    }
                });

                setTimeout(() => {
                    Swal.close();
                    $('.reject-modal').modal('show');
                }, 500);
            } else if (t.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: "Batal",
                    text: "Anda membatalkan penolakan penandatangan :)",
                    icon: "error"
                });
            }
        });
    })

    $('.btn-sign').click(function () {
        $('.passphrase-modal').modal('show');
    });

    $('.passphrase-modal').on('hide.bs.modal', function () {
        $('input[name="passphrase"]').val(null);
    });
    let createpassword = (type, ele) => {
        document.getElementById(type).type = document.getElementById(type).type == "password" ? "text" : "password"
        let icon = ele.childNodes[0].classList
        let stringIcon = icon.toString()
        if (stringIcon.includes("mdi-eye-outline")) {
            ele.childNodes[0].classList.remove("mdi-eye-outline")
            ele.childNodes[0].classList.add("mdi-eye-off-outline")
        } else {
            ele.childNodes[0].classList.add("mdi-eye-outline")
            ele.childNodes[0].classList.remove("mdi-eye-off-outline")
        }
    }

    const formPassphrase = document.getElementById('passphrase-form');
    if (formPassphrase) {
        FormValidation.formValidation(formPassphrase, {
            fields: {
                passphrase: {
                    validators: {
                        notEmpty: {
                            message: 'Passphrase harus diisi dan tidak boleh kosong!'
                        },
                        stringLength: {
                            min: 3,
                            max: 50,
                            message: 'Passphrase harus lebih dari 3 karakter dan kurang dari 50 karakter',
                        },
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: '',
                    rowSelector: function(field, ele) {
                        switch (field) {
                            case 'passphrase':
                                return '.col-md-12';
                            default:
                                return '.mb-0';
                        }
                    }
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: instance => {
                instance.on('plugins.message.placed', function (e) {
                    if (e.element.parentElement.classList.contains('input-group')) {
                        e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                    }

                    if (e.element.parentElement.parentElement.classList.contains('custom-option')) {
                        e.element.closest('.row').insertAdjacentElement('afterend', e.messageElement);
                    }
                });
            }
        }).on('core.form.valid', function () {
            Swal.fire({
                title: "Mohon tunggu",
                text: "Sedang mengirim data...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: function () {
                    Swal.showLoading();
                }
            });
        })

        // $('#passphrase-form').on('submit', function () {
        //     console.log('form submit');
        // })
    }
    <?php } ?>

    <?php if (in_array($employee->user_role, array('operator', 'verifikator_skpd'))) { ?>
    $('.btn-resend').click(function () {
        let archieve = $(this).data('archieve');
        let company = $(this).data('company');
        let role = ('<?= $employee->user_role ?>' == 'operator') ? "Verifikator" : "Penandatangan";

        Swal.fire({
            title: "Kirim Ulang ke " + role,
            text: "Apakah anda akan mengirim ulang ke " + role + " arsip tersebut?",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Kirim!",
            cancelButtonText: "Batal",
            allowOutsideClick: false,
            allowEscapeKey: false,
            customClass: {
                confirmButton: "btn btn-success mt-2",
                cancelButton: "btn light btn-warning ms-3 mt-2"
            },
            buttonsStyling: !1
        }).then(function (t) {
            if (t.isConfirmed) {
                Swal.fire({
                    title: "Mohon tunggu...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: function () {
                        Swal.showLoading();
                    }
                });

                $.post("<?= base_url('v2/alih_media_arsip_vital/resend') ?>", {
                    archieve: archieve,
                    company: company,
                }, function (data, status) {
                    if (status == 'success') {
                        let respons = JSON.parse(data);
                        if (respons.status == 200) {
                            Swal.fire({
                                title: (respons.status == 200) ? 'Berhasil' : 'Gagal',
                                text: respons.message,
                                icon: (respons.status == 200) ? 'success' : 'error',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then(function () {
                                window.location.href = "<?= base_url('v2/alih_media_arsip_vital') ?>";
                            });
                        } else {
                            Swal.fire({
                                title: (respons.status == 200) ? 'Berhasil' : 'Gagal',
                                text: respons.message,
                                icon: (respons.status == 200) ? 'success' : 'error'
                            });
                        }
                    } else {
                        Swal.fire('Kesalahan', 'Terjadi kesalahan saat mengirimkan data ke server untuk kirim ulang arsip!', 'error');
                    }
                }).fail(function () {
                    Swal.fire('Kesalahan', 'Terjadi kesalahan saat menghubungkan ke server untuk kirim ulang arsip!', 'error');
                });
            } else if (t.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: "Batal",
                    text: "Anda membatalkan pengiriman ulang arsip :)",
                    icon: "error"
                });
            }
        });
    })
    <?php } ?>
</script>
