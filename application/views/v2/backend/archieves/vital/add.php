<!-- SmartWizard CSS -->
<link rel="stylesheet"
      href="<?= base_url('assets/v3/backend/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css') ?>">
<link rel="stylesheet"
      href="<?= base_url('assets/v3/backend/vendor/jquery-smartwizard/dist/css/smart_wizard_all.min.css') ?>">
<style>
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
</style>

<div class="row page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('v2/alih_media_arsip_vital') ?>">Daftar Arsip
                    Vital</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah</a></li>
     </ol>
</div>

<div class="media mb-2 mt-3">
     <div class="media-body">
          <div class="pull-end">
               <a href="<?= base_url('v2/alih_media_arsip_vital') ?>" class="btn btn-primary btn-sm shadow">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
               </a>
          </div>
          <h5 class="my-1 text-primary">Tambah Arsip Vital Baru</h5>
          <!-- <p class="read-content-email"><?= $archieve->kode_klsf ?? '-'; ?></p> -->
     </div>
</div>

<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-body">
                    <!-- SmartWizard -->
                    <div id="smartwizard">
                         <ul class="nav">
                              <li class="nav-item">
                                   <a class="nav-link" href="#step-1">
                                        <span class="sw-icon"><i class="fas fa-clipboard-list"></i></span>
                                        Data Arsip
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a class="nav-link" href="#step-2">
                                        <span class="sw-icon"><i class="fas fa-file-pdf"></i></span>
                                        Upload Dokumen (PDF)
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
                                        <h5 class="text-center mb-1">Data Arsip</h5>
                                        <p class="text-center text-muted small mb-4">Isi informasi arsip vital</p>
                                   </div>
                                   <div class="row g-3">
                                        <div class="col-12">
									<?php if (!empty($archieve)) { ?>
                                                  <input type="hidden" class="form-control" id="archieve"
                                                         name="archieve"
                                                         value="<?= $_GET['archieve']; ?>" required readonly>
									<?php } ?>
                                             <label class="form-label fw-semibold">Kode Klasifikasi <span
                                                          class="text-danger">*</span></label>
                                             <input type="text" id="kode_klsf" name="kode_klsf" class="form-control"
                                                    placeholder="Contoh: 900.1" autocomplete="off"
                                                    value="<?= (!empty($archieve)) ? $archieve->kode_klsf : '' ?>">
                                             <span class="help-block text-danger small"></span>
                                        </div>
                                        <div class="col-12">
                                             <label class="form-label fw-semibold">Indeks <span
                                                          class="text-danger">*</span></label>
                                             <input type="text" id="indeks" name="indeks" class="form-control"
                                                    placeholder="Masukan indeks arsip" autocomplete="off"
                                                    value="<?= (!empty($archieve)) ? $archieve->indek : '' ?>">
                                             <span class="help-block text-danger small"></span>
                                        </div>
                                        <div class="col-12">
                                             <label class="form-label fw-semibold">Uraian Informasi Arsip <span
                                                          class="text-danger">*</span></label>
                                             <textarea id="uraian_informasi_arsip" name="uraian_informasi_arsip"
                                                       class="form-control" rows="3"
                                                       placeholder="Tuliskan uraian informasi arsip..."><?= (!empty($archieve)) ? $archieve->uraian_informasi_arsip : '' ?></textarea>
                                             <span class="help-block text-danger small"></span>
                                        </div>
                                        <div class="col-md-4">
                                             <label class="form-label fw-semibold">Kurun Waktu (Tahun) <span
                                                          class="text-danger">*</span></label>
                                             <input type="number" id="tahun" name="tahun" class="form-control"
                                                    placeholder="Contoh: 2024" min="1900" max="2100" autocomplete="off"
                                                    value="<?= (!empty($archieve)) ? $archieve->tahun : '' ?>">
                                             <span class="help-block text-danger small"></span>
                                        </div>
                                        <div class="col-md-4">
                                             <label class="form-label fw-semibold">Jumlah Dokumen <span
                                                          class="text-danger">*</span></label>
                                             <div class="input-group">
                                                  <input type="number" id="jumlah" name="jumlah" class="form-control"
                                                         placeholder="0" min="1" autocomplete="off"
                                                         value="<?= (!empty($archieve)) ? $archieve->jumlah : '' ?>">
                                                  <span class="input-group-text">dok</span>
                                             </div>
                                             <span class="help-block text-danger small"></span>
                                        </div>
                                        <div class="col-md-4">
                                             <label class="form-label fw-semibold">Waktu (Tanggal) <span
                                                          class="text-danger">*</span></label>
                                             <input type="date" id="tanggal" name="tanggal" class="form-control"
                                                    autocomplete="off"
                                                    value="<?= (!empty($archieve)) ? date('Y-m-d', strtotime($archieve->tanggal)) : '' ?>">
                                             <span class="help-block text-danger small"></span>
                                        </div>
                                        <div class="col-12">
                                             <label class="form-label fw-semibold">Unit Kerja Pencipta</label>
                                             <input type="text" id="unit_kerja_pencipta" name="unit_kerja_pencipta"
                                                    class="form-control" placeholder="Nama unit kerja pencipta arsip"
                                                    autocomplete="off"
                                                    value="<?= (!empty($archieve)) ? $archieve->unit_kerja_pencipta : '' ?>">
                                        </div>
                                        <div class="col-12">
                                             <label class="form-label fw-semibold">Keterangan</label>
                                             <textarea id="keterangan" name="keterangan" class="form-control" rows="2"
                                                       placeholder="Keterangan tambahan (opsional)"><?= (!empty($archieve)) ? $archieve->deskripsi : '' ?></textarea>
                                        </div>
                                   </div>
                              </div>

                              <!-- STEP 2: Upload PDF -->
                              <div id="step-2" class="tab-pane" role="tabpanel">
                                   <div class="py-3">
                                        <h5 class="text-center mb-1">Upload Dokumen PDF</h5>
                                        <p class="text-center text-muted small mb-4">Upload file PDF yang akan
                                             ditandatangani secara elektronik</p>
                                   </div>
                                   <div class="row justify-content-center">
                                        <div class="col-md-8">
                                             <div id="pdf-upload-preview"
                                                  onclick="document.getElementById('file_pdf_input').click()">
                                                  <div class="upload-icon"><i class="fas fa-file-pdf"></i></div>
                                                  <h6 id="upload-label">Klik atau drag file PDF ke sini</h6>
                                                  <p class="text-muted small mb-0">Format: PDF · Maksimal 20MB</p>
                                             </div>
                                             <input type="file" id="file_pdf_input" accept=".pdf" class="d-none"
                                                    data-initial="<?= (!empty($archieve)) ? $archieve->file : null; ?>">
                                             <div id="upload-progress" class="mt-3 d-none">
                                                  <div class="progress">
                                                       <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                            style="width: 0%"></div>
                                                  </div>
                                                  <small class="text-muted">Mengupload...</small>
                                             </div>
                                             <span id="pdf-upload-error" class="text-danger small d-none"></span>
                                        </div>
                                   </div>
                              </div>

                              <!-- STEP 3: Posisi TTE -->
                              <div id="step-3" class="tab-pane" role="tabpanel">
                                   <div class="py-3">
                                        <h5 class="text-center mb-1">Atur Posisi Tanda Tangan Elektronik</h5>
                                        <p class="text-center text-muted small mb-4">Geser dan ubah ukuran kotak merah
                                             untuk menentukan posisi TTE pada dokumen</p>
                                   </div>

                                   <!-- PDF Nav Bar -->
                                   <div class="pdf-nav-bar">
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                                id="btn-prev-page" disabled>
                                             <i class="fas fa-chevron-left me-1"></i> Sebelumnya
                                        </button>
                                        <span class="fw-semibold" id="page-info">Halaman 1 / 1</span>
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                                id="btn-next-page" disabled>
                                             Selanjutnya <i class="fas fa-chevron-right ms-1"></i>
                                        </button>
                                        <div class="ms-3 d-flex align-items-center gap-2">
                                             <span class="text-muted small">Zoom:</span>
                                             <button type="button" class="btn btn-sm btn-outline-secondary"
                                                     id="btn-zoom-out"><i class="fas fa-search-minus"></i></button>
                                             <span id="zoom-label" class="small fw-semibold">100%</span>
                                             <button type="button" class="btn btn-sm btn-outline-secondary"
                                                     id="btn-zoom-in"><i class="fas fa-search-plus"></i></button>
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
                                                       <small class="fst-italic"
                                                              style="background:rgba(255,255,255,0.6);padding:1px 4px;border-radius:2px;">Geser
                                                            / ubah ukuran</small>
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
                                   <input type="hidden" id="tte_posisi" name="tte_posisi" value="">
                                   <input type="hidden" id="pdf_filename_temp" name="pdf_filename_temp" value="">
                              </div>

                         </div><!-- end tab-content -->
                    </div><!-- end smartwizard -->
               </div>
          </div>
     </div>
</div>

<script src="<?= base_url('assets/v3/backend/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.min.js') ?>"></script>

<!-- PDF.js via CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

<!-- interact.js via CDN (drag + resize) -->
<script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.27/dist/interact.min.js"></script>

<script>
    // ===== PDF.js Worker =====
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    var pdfDoc = null;
    var pageNum = 1;
    var pageScale = 1.0;
    var tempFilename = '', tempFileJSON = '', pathFile = '';
    let is_exists = false;
    let initial_file = $('#file_pdf_input').data('initial');
    if (initial_file) {
        is_exists = true;
        tempFilename = '<?= (!empty($archieve)) ? json_encode($archieve->file) : null ?>';
        tempFileJSON = JSON.parse(tempFilename);
        pathFile = initial_file ? '<?= base_url() ?>/assets/data/' + tempFileJSON : null;
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
    $('#smartwizard').on('leaveStep', function (e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
        if (stepDirection === 'forward') {
            if (currentStepIndex === 0) {
                // return validateStep1();
                if (is_exists) {

                    if (tempFilename != '' || tempFilename != null) {
                        fetch(pathFile)
                            .then(response => response.blob())
                            .then(data => {
                                const myFile = new File([data], tempFileJSON, {
                                    type: 'application/pdf',
                                });
                                if (myFile != null || myFile != '') {
                                    // 2. Wrap the file in a DataTransfer object
                                    const dataTransfer = new DataTransfer();
                                    dataTransfer.items.add(myFile);

                                    // 3. Set the input's files property
                                    const fileInput = document.querySelector('#file_pdf_input');
                                    fileInput.files = dataTransfer.files;

                                    fileInput.dispatchEvent(new Event('change', {bubbles: true}));
                                    // console.log("File loaded and change event fired.");
                                } else {
                                    Swal.fire("Kesalahan", `Gagal memuat draf pdf dengan nama: ${tempFileJSON}! Silahkan upload ulang.`, "error");
                                }
                            });
                    }
                }

                return validateStep1();
            }

            if (currentStepIndex === 1) {
                return validateStep2();
            }
        }
        return true;
    });

    // Saat masuk step 2: render PDF
    $('#smartwizard').on('showStep', function (e, anchorObject, stepIndex) {
        if (stepIndex === 2) {
            if (tempFilename) renderPdfPage(pageNum);
            $('#btnSimpan').removeClass('d-none');
        } else {
            $('#btnSimpan').addClass('d-none');
        }
    });

    // ===== Validasi Step 1 =====
    function validateStep1() {
        var valid = true;
        var fields = [{
            id: 'kode_klsf',
            label: 'Kode Klasifikasi'
        },
            {
                id: 'indeks',
                label: 'Indeks'
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
                label: 'Jumlah Dokumen'
            },
            {
                id: 'tanggal',
                label: 'Waktu (Tanggal)'
            },
        ];
        fields.forEach(function (f) {
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
            return false;
        }
        document.getElementById('pdf-upload-error').classList.add('d-none');
        return true;
    }

    // File input change
    document.getElementById('file_pdf_input').addEventListener('change', function () {
        if (this.files.length) handlePdfFile(this.files[0]);
    });

    // ===== Handle PDF file upload =====
    function handlePdfFile(file) {
        if (file.type !== 'application/pdf') {
            Swal.fire('Kesalahan', 'Hanya file PDF yang diizinkan!', 'error');
            return;
        }
        if (file.size > 20 * 1024 * 1024) {
            Swal.fire('Kesalahan', 'Ukuran file maksimal 50MB!', 'error');
            return;
        }

        // Update UI
        var preview = document.getElementById('pdf-upload-preview');
        var label = document.getElementById('upload-label');
        // preview.classList.add('has-file');
        preview.style.background = '#ffeae6';
        label.innerHTML = '<i class="fas fa-check-circle text-warning me-2"></i>' + file.name;

        // Show progress
        var progress = document.getElementById('upload-progress');
        var bar = progress.querySelector('.progress-bar');
        progress.classList.remove('d-none');
        bar.style.width = '0%';

        // Upload ke server temp
        var formData = new FormData();
        formData.append('file_pdf', file);
        let pdf_filename_temp = document.getElementById('pdf_filename_temp');
        if (pdf_filename_temp.value != null) {
            formData.append('pdf_filename_temp', pdf_filename_temp.value);
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= base_url(); ?>v2/alih_media_arsip_vital/upload_pdf');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                var pct = Math.round(e.loaded / e.total * 100);
                bar.style.width = pct + '%';
                label.innerHTML = '<i class="fas fa-clock text-warning me-2"></i>' + file.name;
            }
        };

        xhr.onload = function () {
            progress.classList.add('d-none');

            if (xhr.status == 200) {
                var res = JSON.parse(xhr.responseText);
                if (res.status) {
                    label.innerHTML = '<i class="fas fa-check-circle text-success me-2"></i>' + file.name;
                    preview.classList.add('has-file');
                    preview.style.background = '#f0fff4';
                    tempFilename = res.filename;
                    document.getElementById('pdf_filename_temp').value = res.filename;
                    // Preload PDF.js
                    loadPdfFromUrl(res.url);
                    document.getElementById('pdf-upload-error').classList.add('d-none');
                } else {
                    // alert('Gagal upload: ' + (res.message || 'Error'));
                    console.log(xhr);
                    Swal.fire("Gagal", "Upload dokumen gagal! Silahkan coba kembali", "error");
                    preview.classList.remove('has-file');
                    // preview.style.backgroundColor = '#fee6ea';
                    preview.style.background = '#f8f9fa';
                    label.innerHTML = 'Klik atau drag file PDF ke sini';
                }
            } else {
                console.log(xhr);
                Swal.fire("Gagal", "Upload dokumen gagal! Silahkan coba kembali", "error");
                preview.classList.remove('has-file');
                preview.style.background = '#f8f9fa';
                label.innerHTML = 'Klik atau drag file PDF ke sini';
            }
        };
        xhr.send(formData);
    }

    // ===== Load PDF via PDF.js =====
    function loadPdfFromUrl(url) {
        pdfjsLib.getDocument({
            url: url,
            withCredentials: false
        }).promise.then(function (pdf) {
            pdfDoc = pdf;
            pageNum = 1;
            var prevBtn = document.getElementById('btn-prev-page');
            var nextBtn = document.getElementById('btn-next-page');
            if (pdf.numPages > 1) {
                nextBtn.disabled = false;
            }
            prevBtn.disabled = true;
            renderPdfPage(pageNum);
        }).catch(function (err) {
            console.error('PDF.js error:', err);
            alert('Gagal memuat preview PDF.');
        });
    }

    // ===== Render halaman PDF =====
    function renderPdfPage(num) {
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

    // PDF Nav buttons
    document.getElementById('btn-prev-page').addEventListener('click', function () {
        if (pageNum > 1) {
            pageNum--;
            renderPdfPage(pageNum);
        }
    });
    document.getElementById('btn-next-page').addEventListener('click', function () {
        if (pdfDoc && pageNum < pdfDoc.numPages) {
            pageNum++;
            renderPdfPage(pageNum);
        }
    });

    // Zoom
    document.getElementById('btn-zoom-in').addEventListener('click', function () {
        pageScale = Math.min(pageScale + 0.25, 3.0);
        document.getElementById('zoom-label').textContent = Math.round(pageScale * 100) + '%';
        if (pdfDoc) renderPdfPage(pageNum);
    });
    document.getElementById('btn-zoom-out').addEventListener('click', function () {
        pageScale = Math.max(pageScale - 0.25, 0.5);
        document.getElementById('zoom-label').textContent = Math.round(pageScale * 100) + '%';
        if (pdfDoc) renderPdfPage(pageNum);
    });

    // interact.js: drag tte-box
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

    // Drag-drop file to upload area
    var dropArea = document.getElementById('pdf-upload-preview');
    dropArea.addEventListener('dragover', function (e) {
        e.preventDefault();
        this.classList.add('dragover');
    });
    dropArea.addEventListener('dragleave', function () {
        this.classList.remove('dragover');
    });
    dropArea.addEventListener('drop', function (e) {
        e.preventDefault();
        this.classList.remove('dragover');
        var files = e.dataTransfer.files;
        if (files.length) handlePdfFile(files[0]);
    });

    $('#btnSimpan').click(function () {
        if (!validateStep1()) {
            // alert('Lengkapi data berkas terlebih dahulu (Step 1).');
            Swal.fire({
                title: "Kesalahan",
                text: "Mohon lengkapi data arsip terlebih dahulu (Step 1).",
                icon: "warning",
                allowOutsideClick: false,
                allowEscapeKey: false,
            });
            return;
        }
        // if (!validateStep2()) {
        //     Swal.fire({
        //         title: "Kesalahan",
        //         text: "Mohon lengkapi data lokasi penyimpanan arsip terlebih dahulu (Step 2).",
        //         icon: "warning",
        //         allowOutsideClick: false,
        //         allowEscapeKey: false,
        //     });
        //     return;
        // }
        if (!validateStep2()) {
            Swal.fire({
                title: "Kesalahan",
                text: "Mohon upload dokumen arsip terlebih dahulu (Step 3).",
                icon: "warning",
                allowOutsideClick: false,
                allowEscapeKey: false,
            });
            return;
        }

        $('#btnSimpan').text('Menyimpan...').attr('disabled', true);
        Swal.fire({
            title: "Mohon tunggu",
            text: "Sedang mengirim data...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: function () {
                Swal.showLoading();
            }
        });

        var formData = new FormData();
	    <?php if (!empty($archieve)) { ?>
        formData.append('archieve', document.getElementById('archieve').value);
	    <?php } ?>

        formData.append('kode_klsf', document.getElementById('kode_klsf').value);
        formData.append('indeks', document.getElementById('indeks').value);
        formData.append('uraian_informasi_arsip', document.getElementById('uraian_informasi_arsip').value);
        formData.append('tahun', document.getElementById('tahun').value);
        formData.append('jumlah', document.getElementById('jumlah').value);
        formData.append('tanggal', document.getElementById('tanggal').value);
        formData.append('unit_kerja_pencipta', document.getElementById('unit_kerja_pencipta').value);
        formData.append('keterangan', document.getElementById('keterangan').value);
        formData.append('tte_posisi', document.getElementById('tte_posisi').value);
        formData.append('pdf_filename_temp', document.getElementById('pdf_filename_temp').value);

        // File PDF dari input (kirim ulang untuk disimpan permanent)
        var fileInput = document.getElementById('file_pdf_input');
        if (fileInput.files.length) {
            formData.append('file_pdf', fileInput.files[0]);
        }

        $.ajax({
            url: '<?= base_url("v2/alih_media_arsip_vital/save") ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: function (res) {
                if (res.status) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data arsip baru berhasil disimpan.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    }).then(function () {
                        window.location.href = '<?= base_url("v2/alih_media_arsip_vital") ?>';
                    });
                } else {
                    Swal.fire('Gagal!', res.message || 'Terjadi kesalahan saat mengirim data arsip...', 'error');
                    $('#btnSimpan').text('Simpan Data').attr('disabled', false);
                }
            },
            error: function () {
                Swal.fire('Error!', 'Terjadi kesalahan saat mengirimkan data ke server...', 'error');
                $('#btnSimpan').text('Simpan Data').attr('disabled', false);
            }
        });

    });
</script>
