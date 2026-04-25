<link rel="stylesheet" href="<?= base_url('assets/v3/backend/') ?>vendor/dropify/css/dropify.css">

<div class="page-titles">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?= base_url('v2/dashboards') ?>">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="<?= base_url('v2/alih_media_arsip_vital/berita_acara') ?>">Daftar Berita Acara</a></li>
		<li class="breadcrumb-item active"><a href="javascript:void(0);">Tambah Berita Acara Arsip Vital</a></li>
	</ol>
</div>

<div class="row">
     <div class="col-xl-12 col-lg-12">
          <div class="card">
               <div class="card-header">
                    <h4 class="card-title">Form Upload Berita Acara (BAST)</h4>
               </div>
               <div class="card-body">
                    <div class="basic-form">
                         <form id="form-bast" action="<?= base_url('v2/alih_media_arsip_vital/berita_acara_save') ?>" method="post" enctype="multipart/form-data">
                              <div class="row">
                                   <div class="mb-3 col-md-12">
                                        <label class="form-label">Nama / Nomor BAST <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Masukkan nomor atau nama Berita Acara" required>
                                   </div>
                              </div>
                              <div class="row mt-3">
                                   <div class="mb-3 col-md-12">
                                        <label class="form-label">File BAST (PDF) <span class="text-danger">*</span></label>
                                        <br>
                                        <span class="text-muted"><small><i>Dokumen Berita Acara (BAST) yang sudah ditandatangani. Format: .pdf, Maksimal: 10MB</i></small></span>
                                        <input type="file" name="file_pdf" class="dropify" data-max-file-size="10M" accept="application/pdf" required />
                                   </div>
                              </div>
                              <hr>
                              <div class="mt-4">
                                   <button type="submit" class="btn btn-primary btn-sm shadow btn-save me-2">Simpan BAST</button>
                                   <a href="<?= base_url('v2/alih_media_arsip_vital/berita_acara') ?>" class="btn btn-danger light btn-sm shadow ">Batal</a>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>

<script src="<?= base_url('assets/v3/backend/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/') ?>vendor/dropify/js/dropify.js"></script>

<script>
    var drEvent = $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop file BAST PDF ke sini atau klik',
            'replace': 'Drag and drop / klik untuk mengganti file',
            'remove':  'Hapus',
            'error':   'Terjadi kesalahan.'
        },

        tpl: {
            wrap:            '<div class="dropify-wrapper"></div>',
            loader:          '<div class="dropify-loader"></div>',
            message:         '<div class="dropify-message"><span class="file-icon" /> <p>{{ default }}</p></div>',
            preview:         '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
            filename:        '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
            clearButton:     '<button type="button" class="dropify-clear btn btn-danger">{{ remove }}</button>',
            errorLine:       '<p class="dropify-error">{{ error }}</p>',
            errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
        }
    });

    $('#form-bast').on('submit', function () {
        Swal.fire({
            title: "Mohon tunggu",
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: function() {
                Swal.showLoading();
            }
        });
        console.log('onSubmit');
    });
</script>