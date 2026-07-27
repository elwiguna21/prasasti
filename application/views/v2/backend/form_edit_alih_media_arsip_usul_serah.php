<!-- Page Title -->
<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah') ?>">Alih Media Arsip Usul Serah</a></li>
          <li class="breadcrumb-item active">Edit Data</li>
     </ol>
</div>

<!-- SmartWizard CSS -->
<link rel="stylesheet" href="<?= base_url('assets/v3/backend/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/v3/backend/vendor/jquery-smartwizard/dist/css/smart_wizard_all.min.css') ?>">
<!-- Select2 CSS -->
<link rel="stylesheet" href="<?= base_url('assets/v3/backend/vendor/select2/css/select2.min.css') ?>">

<style>
     /* ===== Select2 Overrides ===== */
     .select2-container--default .select2-selection--single {
          border-radius: 0.5rem;
          border: 0.0625rem solid #c8c8c8;
          height: 3.5rem;
          background: #fff;
     }

     .select2-container--default .select2-selection--single .select2-selection__rendered {
          line-height: 3.5rem;
          color: #7e7e7e;
          padding-left: 0.9375rem;
          min-height: 3.5rem;
     }

     .select2-container--default .select2-selection--single .select2-selection__arrow {
          top: 1.075rem;
          right: 0.9375rem;
     }

     /* ===== Wizard Overrides (Custom Step-by-Step) ===== */
     #smartwizard {
          background: transparent;
          border: none;
     }

     #smartwizard .nav {
          position: relative;
          margin-bottom: 40px;
          justify-content: center;
          border-bottom: none !important;
     }

     /* Garis penghubung */
     #smartwizard .nav::before {
          content: "";
          position: absolute;
          top: 25px;
          left: 10%;
          right: 10%;
          height: 3px;
          background-color: #f1f1f1;
          z-index: 0;
          border-radius: 10px;
     }

     #smartwizard .nav .nav-item {
          position: relative;
          z-index: 1;
          padding: 0 20px;
          background: #fff;
          /* Tutup garis jika menumpuk */
     }

     #smartwizard .nav .nav-link {
          background: transparent !important;
          border: none !important;
          display: flex;
          flex-direction: column;
          align-items: center;
          padding: 0;
          transition: all 0.3s ease;
          opacity: 0.6;
     }

     #smartwizard .nav .nav-link .sw-icon {
          width: 50px;
          height: 50px;
          line-height: 50px;
          background: #f8f9fa;
          border: 3px solid #f1f1f1;
          border-radius: 50%;
          color: #adb5bd;
          font-size: 18px;
          text-align: center;
          margin-bottom: 10px;
          transition: all 0.3s ease;
          display: flex;
          align-items: center;
          justify-content: center;
     }

     /* Marker / Penanda Step Aktif */
     #smartwizard .nav .nav-link.active {
          opacity: 1;
     }

     #smartwizard .nav .nav-link.active .sw-icon {
          background: #5c78ef;
          border-color: rgba(92, 120, 239, 0.2);
          color: #fff;
          box-shadow: 0 0 0 5px rgba(92, 120, 239, 0.15);
     }

     #smartwizard .nav .nav-link.active {
          font-weight: 700;
          color: #5c78ef !important;
     }

     /* Step Done */
     #smartwizard .nav .nav-link.done {
          opacity: 1;
     }

     #smartwizard .nav .nav-link.done .sw-icon {
          background: #28a745;
          border-color: #28a745;
          color: #fff;
     }

     #smartwizard .nav .nav-link.done {
          color: #28a745 !important;
     }

     .sw-btn-group {
          gap: 8px;
          margin-top: 20px;
     }

     /* ===== Step 3: PDF Viewer ===== */
     #pdf-container {
          position: relative;
          overflow: auto;
          background: #e9ecef;
          border-radius: 8px;
          min-height: 500px;
          padding: 20px;
          text-align: center;
     }

     #pdf-page-wrapper {
          position: relative;
          display: inline-block;
          box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
     }

     #pdf-canvas {
          display: block;
          max-width: 100%;
     }

     #tte-box {
          position: absolute;
          width: 200px;
          height: 73px;
          border: 2px solid rgba(0, 123, 255, 0.5);
          background: url('<?= base_url("assets/images/frame_ttd.png") ?>') no-repeat center center;
          background-size: 100% 100%;
          cursor: move;
          border-radius: 2px;
          display: flex;
          align-items: center;
          justify-content: center;
          user-select: none;
          top: 20px;
          left: 20px;
          z-index: 10;
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
          opacity: 0.92;
     }

     #tte-box .tte-label {
          font-size: 9px;
          color: rgba(0, 0, 0, 0.35);
          font-weight: 600;
          text-align: center;
          pointer-events: none;
     }

     #tte-box .tte-resize-handle {
          position: absolute;
          bottom: 0;
          right: 0;
          width: 14px;
          height: 14px;
          background: #007bff;
          cursor: se-resize;
          border-radius: 2px 0 2px 0;
          opacity: 0.7;
     }

     .pdf-nav-bar {
          display: flex;
          align-items: center;
          gap: 10px;
          justify-content: center;
          margin-bottom: 12px;
     }

     #pdf-upload-preview {
          border: 2px dashed #dee2e6;
          border-radius: 8px;
          padding: 40px;
          text-align: center;
          cursor: pointer;
          transition: all 0.3s;
          background: #f8f9fa;
     }

     #pdf-upload-preview:hover,
     #pdf-upload-preview.dragover {
          border-color: #5c78ef;
          background: #eef1fb;
     }

     #pdf-upload-preview .upload-icon {
          font-size: 48px;
          color: #adb5bd;
          margin-bottom: 10px;
     }

     #pdf-upload-preview.has-file {
          border-color: #28a745;
          background: #f0fff4;
     }

     #pdf-upload-preview.has-file .upload-icon {
          color: #28a745;
     }

     /* ===== TTE Check Result ===== */
     #tte-check-result {
          display: none;
          margin-top: 16px;
          padding: 16px 20px;
          border-radius: 8px;
          border: 1px solid;
          animation: fadeInUp 0.4s ease;
     }

     #tte-check-result.tte-checking {
          background: #fff8e1;
          border-color: #ffecb3;
          color: #795548;
     }

     #tte-check-result.tte-found {
          background: #e8f5e9;
          border-color: #a5d6a7;
          color: #2e7d32;
     }

     #tte-check-result.tte-not-found {
          background: #e3f2fd;
          border-color: #90caf9;
          color: #1565c0;
     }

     #tte-check-result.tte-error {
          background: #fce4ec;
          border-color: #ef9a9a;
          color: #c62828;
     }

     @keyframes fadeInUp {
          from { opacity: 0; transform: translateY(10px); }
          to   { opacity: 1; transform: translateY(0); }
     }

     .tte-signer-card {
          background: rgba(255,255,255,0.7);
          border-radius: 6px;
          padding: 10px 14px;
          margin-top: 10px;
     }
</style>

<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-header">
                    <h4 class="card-title"><i class="fas fa-file-alt me-2"></i>Edit Form Alih Media Arsip Usul Serah</h4>
               </div>
               <div class="card-body">

                    <!-- SmartWizard -->
                    <div id="smartwizard">
                         <ul class="nav">
                              <li class="nav-item">
                                   <a class="nav-link" href="#step-1">
                                        <span class="sw-icon"><i class="fas fa-clipboard-list"></i></span>
                                        Data Berkas
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a class="nav-link" href="#step-2">
                                        <span class="sw-icon"><i class="fas fa-file-pdf"></i></span>
                                        Upload PDF
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a class="nav-link" href="#step-3">
                                        <span class="sw-icon"><i class="fas fa-signature"></i></span>
                                        Posisi TTE
                                   </a>
                              </li>
                         </ul>

                         <div class="tab-content">

                              <!-- STEP 1: Data Berkas -->
                              <div id="step-1" class="tab-pane" role="tabpanel">
                                   <div class="py-3">
                                        <h5 class="text-center mb-1">Data Berkas</h5>
                                        <p class="text-center text-muted small mb-4">Isi informasi berkas arsip usul serah</p>
                                   </div>
                                   <div class="row g-3">
                                        <div class="col-12">
                                             <label class="form-label fw-semibold">Kode Klasifikasi <span class="text-danger">*</span></label>
                                             <select id="kode_klsf" name="kode_klsf" class="form-control select2" required>
                                                  <option value="">Pilih Klasifikasi Surat</option>
                                                  <?php foreach($klasifikasi as $k): ?>
                                                       <option value="<?= $k->kode_gabungan ?>" <?= (isset($berkas->kode_klsf) && $berkas->kode_klsf === $k->kode_gabungan) ? 'selected' : '' ?>><?= $k->kode_gabungan ?> - <?= $k->nama ?></option>
                                                  <?php endforeach; ?>
                                             </select>
                                             <span class="help-block text-danger small"></span>
                                        </div>
                                        <div class="col-12">
                                             <label class="form-label fw-semibold">Uraian Informasi Arsip <span class="text-danger">*</span></label>
                                             <textarea id="uraian_informasi_arsip" name="uraian_informasi_arsip" class="form-control" rows="3" placeholder="Tuliskan uraian informasi arsip..."><?= htmlspecialchars($berkas->uraian_informasi_arsip ?? '') ?></textarea>
                                             <span class="help-block text-danger small"></span>
                                        </div>
                                        <div class="col-md-6">
                                             <label class="form-label fw-semibold">Kurun Waktu (Tahun) <span class="text-danger">*</span></label>
                                             <input type="number" id="tahun" name="tahun" class="form-control" placeholder="Contoh: 2024" min="1900" max="2100" value="<?= $berkas->tahun ?? '' ?>">
                                             <span class="help-block text-danger small"></span>
                                        </div>
                                        <div class="col-md-6">
                                             <label class="form-label fw-semibold">Jumlah Berkas <span class="text-danger">*</span></label>
                                             <div class="input-group">
                                                  <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="0" min="1" value="<?= $berkas->jumlah ?? '' ?>">
                                                  <span class="input-group-text">berkas</span>
                                             </div>
                                             <span class="help-block text-danger small"></span>
                                        </div>
                                        <div class="col-md-6">
                                             <label class="form-label fw-semibold">Tingkat Perkembangan <span class="text-danger">*</span></label>
                                             <select id="keterangan_tk_perkembangan" name="keterangan_tk_perkembangan" class="form-control" required>
                                                  <option value="">Pilih Tingkat Perkembangan</option>
                                                  <option value="Asli" <?= (isset($berkas->keterangan_tk_perkembangan) && $berkas->keterangan_tk_perkembangan === 'Asli') ? 'selected' : '' ?>>Asli</option>
                                                  <option value="Copy" <?= (isset($berkas->keterangan_tk_perkembangan) && $berkas->keterangan_tk_perkembangan === 'Copy') ? 'selected' : '' ?>>Copy</option>
                                                  <option value="Salinan" <?= (isset($berkas->keterangan_tk_perkembangan) && $berkas->keterangan_tk_perkembangan === 'Salinan') ? 'selected' : '' ?>>Salinan</option>
                                             </select>
                                             <span class="help-block text-danger small"></span>
                                        </div>
                                        <div class="col-12">
                                             <label class="form-label fw-semibold">Unit Kerja Pencipta</label>
                                             <input type="text" id="unit_kerja_pencipta" name="unit_kerja_pencipta" class="form-control" placeholder="Nama unit kerja pencipta arsip" value="<?= htmlspecialchars($berkas->unit_kerja_pencipta ?? '') ?>">
                                        </div>
                                        <div class="col-12">
                                             <label class="form-label fw-semibold">Keterangan <span class="text-danger">*</span></label>
                                             <textarea id="keterangan" name="keterangan" class="form-control" rows="2" placeholder="Masukan keterangan" required><?= htmlspecialchars($berkas->deskripsi ?? '') ?></textarea>
                                             <span class="help-block text-danger small"></span>
                                        </div>
                                   </div>
                              </div>

                              <!-- STEP 2: Upload PDF -->
                              <div id="step-2" class="tab-pane" role="tabpanel">
                                   <div class="py-3">
                                        <h5 class="text-center mb-1">Upload Dokumen PDF</h5>
                                        <p class="text-center text-muted small mb-4">Upload file PDF yang akan ditandatangani secara elektronik</p>
                                   </div>
                                   <div class="row justify-content-center">
                                        <div class="col-md-8">
                                             <div id="pdf-upload-preview" onclick="document.getElementById('file_pdf_input').click()" class="<?= !empty($berkas->file) ? 'has-file' : '' ?>">
                                                  <div class="upload-icon"><i class="fas fa-file-pdf"></i></div>
                                                  <h6 id="upload-label"><?= !empty($berkas->file) ? '<i class="fas fa-check-circle text-success me-2"></i>' . htmlspecialchars($berkas->file) : 'Klik atau drag file PDF ke sini' ?></h6>
                                                  <p class="text-muted small mb-0">Format: PDF · Maksimal 10MB (Upload baru untuk mengganti file lama)</p>
                                             </div>
                                             <input type="file" id="file_pdf_input" accept=".pdf" class="d-none">
                                             <div id="upload-progress" class="mt-3 d-none">
                                                  <div class="progress">
                                                       <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"></div>
                                                  </div>
                                                  <small class="text-muted">Mengupload...</small>
                                             </div>
                                             <span id="pdf-upload-error" class="text-danger small d-none"></span>
                                             <!-- TTE Check Result -->
                                             <div id="tte-check-result"></div>
                                        </div>
                                   </div>
                              </div>

                              <!-- STEP 3: Posisi TTE -->
                              <div id="step-3" class="tab-pane" role="tabpanel">
                                   <div class="py-3">
                                        <h5 class="text-center mb-1">Atur Posisi Tanda Tangan Elektronik</h5>
                                        <p class="text-center text-muted small mb-4">Geser dan ubah ukuran kotak merah untuk menentukan posisi TTE pada dokumen</p>
                                   </div>

                                   <!-- PDF Nav Bar -->
                                   <div class="pdf-nav-bar">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-prev-page" disabled>
                                             <i class="fas fa-chevron-left me-1"></i> Sebelumnya
                                        </button>
                                        <span class="fw-semibold" id="page-info">Halaman 1 / 1</span>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-next-page" disabled>
                                             Selanjutnya <i class="fas fa-chevron-right ms-1"></i>
                                        </button>
                                        <div class="ms-3 d-flex align-items-center gap-2">
                                             <span class="text-muted small">Zoom:</span>
                                             <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-zoom-out"><i class="fas fa-search-minus"></i></button>
                                             <span id="zoom-label" class="small fw-semibold">100%</span>
                                             <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-zoom-in"><i class="fas fa-search-plus"></i></button>
                                        </div>
                                   </div>

                                   <!-- PDF Viewer -->
                                   <div id="pdf-container">
                                        <div id="pdf-empty-state" class="py-5 text-muted">
                                             <i class="fas fa-file-pdf fa-3x mb-3 d-block"></i>
                                             PDF belum diupload atau sedang dimuat...
                                        </div>
                                        <div id="pdf-page-wrapper" class="d-none">
                                             <canvas id="pdf-canvas"></canvas>
                                             <!-- Draggable TTE Box (dengan preview image TTE) -->
                                             <div id="tte-box">
                                                  <div class="tte-label">
                                                       <small class="fst-italic" style="background:rgba(255,255,255,0.6);padding:1px 4px;border-radius:2px;">Geser / ubah ukuran</small>
                                                  </div>
                                                  <div class="tte-resize-handle" title="Ubah ukuran"></div>
                                             </div>
                                        </div>
                                   </div>

                                   <!-- TTE Position Info -->
                                   <div class="mt-3 p-3 bg-light rounded small text-muted" id="tte-info">
                                        <i class="fas fa-info-circle me-1 text-primary"></i>
                                        Posisi TTE belum ditentukan. Upload PDF terlebih dahulu.
                                   </div>

                                   <!-- Hidden fields -->
                                   <input type="hidden" id="tte_posisi" name="tte_posisi" value="<?= htmlspecialchars($berkas->tte_posisi ?? '') ?>">
                                   <input type="hidden" id="pdf_filename_temp" name="pdf_filename_temp" value="">
                                   <input type="hidden" id="existing_file" value="<?= !empty($berkas->file) ? $berkas->file : '' ?>">
                              </div>

                         </div><!-- end tab-content -->
                    </div><!-- end smartwizard -->

               </div>
          </div>
     </div>
</div>

<!-- Required vendors -->
<!-- <script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script> -->
<script src="<?= base_url('assets/v3/backend/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.min.js') ?>"></script>

<!-- PDF.js via CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

<!-- interact.js via CDN (drag + resize) -->
<script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.27/dist/interact.min.js"></script>
<!-- Select2 JS -->
<script src="<?= base_url('assets/v3/backend/vendor/select2/js/select2.full.min.js') ?>"></script>

<script>
     $('#kode_klsf').select2({
          placeholder: "Pilih Klasifikasi Surat",
          allowClear: true,
          width: '100%'
     });
     var base_url = '<?php echo base_url(); ?>';

     // ===== PDF.js Worker =====
     pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

     var pdfDoc = null;
     var pageNum = 1;
     var pageScale = 1.0;
     var tempFilename = document.getElementById('existing_file').value;
     var existingFileUrl = tempFilename ? base_url + 'assets/upload/berkas/' + tempFilename : '';
     var hasExistingTTE = false;
     var tteCheckInProgress = false;
     var currentStepIdx = 0;

     // Load existing PDF jika ada
     if (existingFileUrl) {
          loadPdfFromUrl(existingFileUrl);
          if (tempFilename) {
               verifyTteStatus(tempFilename);
          }
     }

     // ===== SmartWizard Init =====

     $('#smartwizard').smartWizard({
          selected: 0,
          theme: 'dots',
          autoAdjustHeight: true,
          backButtonSupport: true,
          enableURLhash: false,
          transition: {
               animation: 'fade',
               speed: '300'
          },
          toolbarSettings: {
               toolbarPosition: 'bottom',
               showNextButton: true,
               showPreviousButton: true,
               toolbarExtraButtons: [
                    $('<button type="button" id="btnSimpan" class="btn btn-success btn-sm d-none"><i class="fas fa-save me-1"></i> Simpan Data</button>')
               ]
          },
          lang: {
               next: 'Selanjutnya »',
               previous: '« Sebelumnya'
          }
     });

     // Validasi Step 1 sebelum lanjut
     $('#smartwizard').on('leaveStep', function(e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
          if (stepDirection === 'forward') {
               if (currentStepIndex === 0) {
                    return validateStep1();
               }
               if (currentStepIndex === 1) {
                    // Blokir navigasi selama pengecekan TTE masih berjalan
                    if (tteCheckInProgress) {
                         Swal.fire('Mohon Tunggu', 'Sedang memeriksa TTE pada dokumen. Harap tunggu hingga selesai.', 'info');
                         return false;
                    }
                    // Jika dokumen sudah memiliki TTE, blokir navigasi ke Step 3
                    // karena tombol Simpan sudah muncul di Step 2
                    if (hasExistingTTE) {
                         return false;
                    }
                    return validateStep2();
               }
          }
          return true;
     });

     // Helper untuk update visibilitas tombol berdasarkan step aktif dan status TTE
     function updateStepButtons(stepIdx) {
          if (typeof stepIdx === 'number') {
               currentStepIdx = stepIdx;
          }
          if (currentStepIdx === 0) {
               // Step 1: selalu tampilkan Selanjutnya, sembunyikan Simpan
               $('#btnSimpan').addClass('d-none');
               $('.sw-btn-next').removeClass('d-none');
          } else if (currentStepIdx === 1) {
               // Step 2: jika dokumen sudah ada TTE, tampilkan Simpan dan sembunyikan Selanjutnya
               if (hasExistingTTE) {
                    $('#btnSimpan').removeClass('d-none');
                    $('.sw-btn-next').addClass('d-none');
               } else {
                    $('#btnSimpan').addClass('d-none');
                    $('.sw-btn-next').removeClass('d-none');
               }
          } else if (currentStepIdx === 2) {
               // Step 3: tampilkan Simpan, sembunyikan Selanjutnya
               $('#btnSimpan').removeClass('d-none');
               $('.sw-btn-next').addClass('d-none');
          }
     }

     // Saat masuk step: render PDF dan update tombol
     $('#smartwizard').on('showStep', function(e, anchorObject, stepIndex) {
          if (stepIndex === 2) {
               if (tempFilename) renderPdfPage(pageNum);
          }
          updateStepButtons(stepIndex);
     });

     // Tombol Simpan
     $('#btnSimpan').on('click', function() {
          submitForm();
     });

     // Drag-drop upload area
     var dropArea = document.getElementById('pdf-upload-preview');
     dropArea.addEventListener('dragover', function(e) {
          e.preventDefault();
          this.classList.add('dragover');
     });
     dropArea.addEventListener('dragleave', function() {
          this.classList.remove('dragover');
     });
     dropArea.addEventListener('drop', function(e) {
          e.preventDefault();
          this.classList.remove('dragover');
          var files = e.dataTransfer.files;
          if (files.length) handlePdfFile(files[0]);
     });

     // File input change
     document.getElementById('file_pdf_input').addEventListener('change', function() {
          if (this.files.length) handlePdfFile(this.files[0]);
     });

     // PDF Nav buttons
     document.getElementById('btn-prev-page').addEventListener('click', function() {
          if (pageNum > 1) {
               pageNum--;
               renderPdfPage(pageNum);
          }
     });
     document.getElementById('btn-next-page').addEventListener('click', function() {
          if (pdfDoc && pageNum < pdfDoc.numPages) {
               pageNum++;
               renderPdfPage(pageNum);
          }
     });

     // Zoom
     document.getElementById('btn-zoom-in').addEventListener('click', function() {
          pageScale = Math.min(pageScale + 0.25, 3.0);
          document.getElementById('zoom-label').textContent = Math.round(pageScale * 100) + '%';
          if (pdfDoc) renderPdfPage(pageNum);
     });
     document.getElementById('btn-zoom-out').addEventListener('click', function() {
          pageScale = Math.max(pageScale - 0.25, 0.5);
          document.getElementById('zoom-label').textContent = Math.round(pageScale * 100) + '%';
          if (pdfDoc) renderPdfPage(pageNum);
     });

     // interact.js: drag
     interact('#tte-box').draggable({
          listeners: {
               move(event) {
                    var target = event.target;
                    var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                    var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
                    target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
                    target.setAttribute('data-x', x);
                    target.setAttribute('data-y', y);
                    updateTtePositionInfo();
               }
          }
     }).resizable({
          edges: {
               right: true,
               bottom: true,
               bottomRight: '.tte-resize-handle'
          },
          listeners: {
               move(event) {
                    var target = event.target;
                    target.style.width = event.rect.width + 'px';
                    target.style.height = event.rect.height + 'px';
                    updateTtePositionInfo();
               }
          },
          modifiers: [
               interact.modifiers.restrictSize({
                    min: {
                         width: 80,
                         height: 40
                    }
               })
          ]
     });

     // ===== Validasi Step 1 =====
     function validateStep1() {
          var valid = true;
          var fields = [{
                    id: 'kode_klsf',
                    label: 'Kode Klasifikasi'
               },
               {
                    id: 'uraian_informasi_arsip',
                    label: 'Uraian Informasi Arsip'
               },
               {
                    id: 'tahun',
                    label: 'Kurun Waktu'
               },
               {
                    id: 'jumlah',
                    label: 'Jumlah Berkas'
               },
               {
                    id: 'keterangan_tk_perkembangan',
                    label: 'Tingkat Perkembangan'
               },
               {
                    id: 'keterangan',
                    label: 'Keterangan'
               },
          ];
          fields.forEach(function(f) {
               var el = document.getElementById(f.id);
               var helpBlock = el.closest('.col-md-4, .col-md-6, .col-12').querySelector('.help-block');
               if (!el.value.trim()) {
                    if (helpBlock) helpBlock.textContent = f.label + ' harus diisi';
                    el.classList.add('is-invalid');
                    valid = false;
               } else {
                    if (helpBlock) helpBlock.textContent = '';
                    el.classList.remove('is-invalid');
               }
          });
          return valid;
     }

     // ===== Validasi Step 2 =====
     function validateStep2() {
          if (!tempFilename) {
               document.getElementById('pdf-upload-error').textContent = 'File PDF wajib diupload terlebih dahulu.';
               document.getElementById('pdf-upload-error').classList.remove('d-none');
               updateWizardHeight();
               return false;
          }
          document.getElementById('pdf-upload-error').classList.add('d-none');
          updateWizardHeight();
          return true;
     }

     // ===== Handle PDF file upload =====
     function handlePdfFile(file) {
          if (file.type !== 'application/pdf') {
               alert('Hanya file PDF yang diizinkan!');
               return;
          }
          if (file.size > 10 * 1024 * 1024) {
               alert('Ukuran file maksimal 10MB!');
               return;
          }

          // Update UI
          var preview = document.getElementById('pdf-upload-preview');
          var label = document.getElementById('upload-label');
          preview.classList.add('has-file');
          label.innerHTML = '<i class="fas fa-check-circle text-success me-2"></i>' + file.name;

          // Show progress
          var progress = document.getElementById('upload-progress');
          var bar = progress.querySelector('.progress-bar');
          progress.classList.remove('d-none');
          bar.style.width = '0%';

          // Upload ke server temp
          var formData = new FormData();
          formData.append('file_pdf', file);

          var xhr = new XMLHttpRequest();
          xhr.open('POST', base_url + 'v2/backend/alih_media_arsip_usul_serah/ajax_upload_pdf');
          xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

          xhr.upload.onprogress = function(e) {
               if (e.lengthComputable) {
                    var pct = Math.round(e.loaded / e.total * 100);
                    bar.style.width = pct + '%';
               }
          };

          xhr.onload = function() {
               progress.classList.add('d-none');
               var res = JSON.parse(xhr.responseText);
               if (res.status) {
                    tempFilename = res.filename;
                    document.getElementById('pdf_filename_temp').value = res.filename;
                    // Preload PDF.js
                    loadPdfFromUrl(res.url);
                    document.getElementById('pdf-upload-error').classList.add('d-none');

                    // ===== Auto-verifikasi TTE BSrE setelah upload berhasil =====
                    verifyTteStatus(res.filename);
               } else {
                    alert('Gagal upload: ' + (res.message || 'Error'));
                    preview.classList.remove('has-file');
                    label.innerHTML = 'Klik atau drag file PDF ke sini';
               }
          };
          xhr.send(formData);
     }

     // ===== Manual Wizard Height Update =====
     function updateWizardHeight() {
          setTimeout(function() {
               var stepHeight = $('#step-2').outerHeight();
               if (stepHeight > 0) {
                    $('#smartwizard .tab-content').css('height', stepHeight + 'px');
               }
          }, 50);
     }

     // ===== Verifikasi TTE BSrE =====
     function verifyTteStatus(filename) {
          tteCheckInProgress = true;
          var resultDiv = document.getElementById('tte-check-result');
          resultDiv.style.display = 'block';
          resultDiv.className = 'tte-checking';
          resultDiv.innerHTML = '<div class="d-flex align-items-center">' +
               '<div class="spinner-border spinner-border-sm me-2" role="status"></div>' +
               '<span><strong>Memeriksa TTE BSrE...</strong><br><small>Sedang memverifikasi tanda tangan elektronik pada dokumen</small></span>' +
               '</div>';

          // Recalculate wizard height untuk menampilkan spinner
          updateWizardHeight();

          $.ajax({
               url: base_url + 'v2/backend/alih_media_arsip_usul_serah/ajax_verify_tte',
               type: 'POST',
               data: { filename: filename },
               dataType: 'JSON',
               success: function(res) {
                    tteCheckInProgress = false;
                    if (res.status && res.has_tte) {
                         // ✅ Dokumen sudah memiliki TTE
                         hasExistingTTE = true;
                         var signerHtml = '';
                         if (res.detail && res.detail.length > 0) {
                              signerHtml = '<div class="tte-signer-card">';
                              for (var i = 0; i < res.detail.length; i++) {
                                   signerHtml += '<div class="mb-1"><i class="fas fa-user-check me-1"></i> <strong>' + res.detail[i].signer_name + '</strong></div>';
                                   signerHtml += '<div class="small text-muted">Validitas: ' + res.detail[i].cert_validity + '</div>';
                              }
                              signerHtml += '</div>';
                         }
                         resultDiv.className = 'tte-found';
                         resultDiv.innerHTML = '<div>' +
                              '<div class="d-flex align-items-center mb-1">' +
                              '<i class="fas fa-check-circle fa-lg me-2"></i>' +
                              '<strong>Dokumen Sudah Memiliki TTE BSrE</strong>' +
                              '</div>' +
                              '<small>' + (res.message || '') + '</small>' +
                              '<div class="small mt-1"><i class="fas fa-signature me-1"></i> Jumlah tanda tangan: <strong>' + (res.jumlah_signature || 0) + '</strong></div>' +
                              signerHtml +
                              '<hr class="my-2">' +
                              '<div class="small"><i class="fas fa-info-circle me-1"></i> Langkah <strong>Posisi TTE</strong> akan dilewati. Silakan klik <strong>Simpan Data</strong> untuk menyimpan pengajuan.</div>' +
                              '</div>';

                         // Update tombol berdasarkan step aktif
                         updateStepButtons();

                         // Recalculate wizard height agar konten TTE tidak terpotong
                         updateWizardHeight();
                    } else {
                         // ❌ Dokumen belum memiliki TTE
                         hasExistingTTE = false;
                         resultDiv.className = 'tte-not-found';
                         resultDiv.innerHTML = '<div class="d-flex align-items-center">' +
                              '<i class="fas fa-info-circle fa-lg me-2"></i>' +
                              '<div>' +
                              '<strong>Dokumen Belum Memiliki TTE</strong><br>' +
                              '<small>Silakan lanjut ke langkah <strong>Posisi TTE</strong> untuk menentukan posisi tanda tangan elektronik.</small>' +
                              '</div>' +
                              '</div>';

                         // Update tombol berdasarkan step aktif
                         updateStepButtons();

                         // Recalculate wizard height
                         updateWizardHeight();
                    }
               },
               error: function() {
                    // Jika gagal verifikasi, tetap lanjut flow normal
                    tteCheckInProgress = false;
                    hasExistingTTE = false;
                    resultDiv.className = 'tte-error';
                    resultDiv.innerHTML = '<div class="d-flex align-items-center">' +
                         '<i class="fas fa-exclamation-triangle fa-lg me-2"></i>' +
                         '<div>' +
                         '<strong>Gagal Memverifikasi TTE</strong><br>' +
                         '<small>Tidak dapat terhubung ke server verifikasi. Silakan lanjut ke langkah Posisi TTE.</small>' +
                         '</div>' +
                         '</div>';
                    // Update tombol berdasarkan step aktif
                    updateStepButtons();

                    // Recalculate wizard height
                    updateWizardHeight();
               }
          });
     }

     // ===== Load PDF via PDF.js =====
     function loadPdfFromUrl(url) {
          pdfjsLib.getDocument({
               url: url,
               withCredentials: false
          }).promise.then(function(pdf) {
               pdfDoc = pdf;
               pageNum = 1;
               var prevBtn = document.getElementById('btn-prev-page');
               var nextBtn = document.getElementById('btn-next-page');
               if (pdf.numPages > 1) {
                    nextBtn.disabled = false;
               }
               prevBtn.disabled = true;
               renderPdfPage(pageNum);
          }).catch(function(err) {
               console.error('PDF.js error:', err);
               alert('Gagal memuat preview PDF.');
          });
     }

     // ===== Render halaman PDF =====
     function renderPdfPage(num) {
          if (!pdfDoc) return;
          pdfDoc.getPage(num).then(function(page) {
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
               }).promise.then(function() {
                    document.getElementById('pdf-page-wrapper').classList.remove('d-none');
                    document.getElementById('pdf-empty-state').classList.add('d-none');
                    document.getElementById('page-info').textContent = 'Halaman ' + num + ' / ' + pdfDoc.numPages;
                    document.getElementById('btn-prev-page').disabled = (num <= 1);
                    document.getElementById('btn-next-page').disabled = (num >= pdfDoc.numPages);
                    updateTtePositionInfo();
               });
          });
     }

     // ===== Update TTE position info & hidden field =====
     function updateTtePositionInfo() {
          var canvas = document.getElementById('pdf-canvas');
          var tteBox = document.getElementById('tte-box');
          var wrapper = document.getElementById('pdf-page-wrapper');
          if (!canvas || canvas.width === 0) return;

          var wrapperRect = wrapper.getBoundingClientRect();
          var tteRect = tteBox.getBoundingClientRect();

          // Posisi relatif terhadap canvas wrapper
          var x = parseFloat(tteBox.getAttribute('data-x')) || 0;
          var y = parseFloat(tteBox.getAttribute('data-y')) || 0;
          var baseLeft = tteBox.offsetLeft + x;
          var baseTop = tteBox.offsetTop + y;

          var posData = {
               page: pageNum,
               x: Math.round(baseLeft),
               y: Math.round(baseTop),
               width: Math.round(parseFloat(tteBox.style.width) || tteBox.offsetWidth),
               height: Math.round(parseFloat(tteBox.style.height) || tteBox.offsetHeight),
               canvas_w: canvas.width,
               canvas_h: canvas.height,
               scale: pageScale
          };

          document.getElementById('tte_posisi').value = JSON.stringify(posData);
          document.getElementById('tte-info').innerHTML =
               '<i class="fas fa-map-marker-alt me-1 text-danger"></i>' +
               '<strong>Posisi TTE:</strong> ' +
               'Halaman <strong>' + posData.page + '</strong> · ' +
               'X: <strong>' + posData.x + '</strong> · ' +
               'Y: <strong>' + posData.y + '</strong> · ' +
               'Ukuran: <strong>' + posData.width + ' × ' + posData.height + ' px</strong>';
     }

     // ===== Submit Form =====
     function submitForm() {
          if (!validateStep1()) {
               alert('Lengkapi data berkas terlebih dahulu (Step 1).');
               return;
          }
          if (!validateStep2()) {
               alert('Upload file PDF terlebih dahulu (Step 2).');
               return;
          }

          $('#btnSimpan').text('Menyimpan...').attr('disabled', true);

          var formData = new FormData();
          formData.append('kode_klsf', document.getElementById('kode_klsf').value);
          formData.append('uraian_informasi_arsip', document.getElementById('uraian_informasi_arsip').value);
          formData.append('tahun', document.getElementById('tahun').value);
          formData.append('jumlah', document.getElementById('jumlah').value);
          formData.append('keterangan_tk_perkembangan', document.getElementById('keterangan_tk_perkembangan').value);
          formData.append('unit_kerja_pencipta', document.getElementById('unit_kerja_pencipta').value);
          formData.append('keterangan', document.getElementById('keterangan').value);
          formData.append('tte_posisi', document.getElementById('tte_posisi').value);
          formData.append('pdf_filename_temp', document.getElementById('pdf_filename_temp').value);
          formData.append('has_existing_tte', hasExistingTTE ? 'Y' : 'N');

          // File PDF dari input (kirim ulang untuk disimpan permanent)
          var fileInput = document.getElementById('file_pdf_input');
          if (fileInput.files.length) {
               formData.append('file_pdf', fileInput.files[0]);
          }

          $.ajax({
               url: base_url + 'v2/backend/alih_media_arsip_usul_serah/ajax_update/<?= $berkas->id ?>',
               type: 'POST',
               data: formData,
               contentType: false,
               processData: false,
               dataType: 'JSON',
               success: function(res) {
                    if (res.status) {
                         Swal.fire({
                              title: 'Berhasil!',
                              text: 'Data berkas berhasil diperbarui.',
                              icon: 'success',
                              confirmButtonText: 'OK'
                         }).then(function() {
                              window.location.href = base_url + 'v2/backend/alih_media_arsip_usul_serah';
                         });
                    } else {
                         Swal.fire('Gagal!', res.message || 'Terjadi kesalahan.', 'error');
                         $('#btnSimpan').text('Simpan Data').attr('disabled', false);
                    }
               },
               error: function() {
                    Swal.fire('Error!', 'Gagal menghubungi server.', 'error');
                    $('#btnSimpan').text('Simpan Data').attr('disabled', false);
               }
          });
     }
</script>
