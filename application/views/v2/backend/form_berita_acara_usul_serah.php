<!-- Page Title -->
<link rel="stylesheet" href="<?= base_url('assets/v3/backend/') ?>vendor/dropify/css/dropify.min.css">

<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah') ?>">Alih Media
                    Arsip Usul Serah</a></li>
          <li class="breadcrumb-item"><a
                    href="<?= base_url('v2/backend/alih_media_arsip_usul_serah/berita_acara') ?>">Berita Acara
                    (BAST)</a></li>
          <li class="breadcrumb-item active">Upload Baru</li>
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
                         <form id="form-bast" action="#" method="post" enctype="multipart/form-data">
                              <div class="row">
                                   <div class="mb-3 col-md-6">
                                        <label class="form-label">Nama / Nomor BAST <span
                                                  class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control"
                                             placeholder="Masukkan nomor atau nama Berita Acara" required>
                                   </div>
                              </div>
                              <div class="row mt-3">
                                   <div class="mb-3 col-md-12">
                                        <label class="form-label">File BAST (PDF) <span
                                                  class="text-danger">*</span></label>
                                        <br>
                                        <span class="text-muted"><small><i>Dokumen Berita Acara (BAST) yang sudah
                                                       ditandatangani. Format: .pdf, Maksimal: 10MB</i></small></span>
                                        <input type="file" name="file_pdf" id="file_pdf" class="dropify"
                                             data-max-file-size="10M" data-allowed-file-extensions="pdf" required />
                                   </div>
                              </div>
                              <hr>
                              <div class="mt-4">
                                   <button type="submit" class="btn btn-primary" id="btnSave">Simpan BAST</button>
                                   <a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah/berita_acara') ?>"
                                        class="btn btn-light">Batal</a>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- Required vendors -->
<!-- <script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script> -->
<script src="<?= base_url('assets/v3/backend/') ?>vendor/dropify/js/dropify.min.js"></script>

<script>

     $('.dropify').dropify({
          messages: {
               'default': 'Drag and drop file BAST PDF ke sini atau klik',
               'replace': 'Drag and drop / klik untuk mengganti file',
               'remove': 'Hapus',
               'error': 'Terjadi kesalahan.'
          }
     });

     $('#form-bast').on('submit', function (e) {
          e.preventDefault();
          $('#btnSave').text('Menyimpan...');
          $('#btnSave').attr('disabled', true);

          var formData = new FormData(this);

          $.ajax({
               url: "<?= base_url('v2/backend/alih_media_arsip_usul_serah/ajax_add_berita_acara') ?>",
               type: "POST",
               data: formData,
               contentType: false,
               processData: false,
               dataType: "JSON",
               success: function (data) {
                    if (data.status) {
                         Swal.fire({
                              title: 'Berhasil!',
                              text: 'Berita Acara berhasil diupload.',
                              icon: 'success',
                              showConfirmButton: false,
                              timer: 1500
                         }).then(function () {
                              window.location.href = "<?= base_url('v2/backend/alih_media_arsip_usul_serah/berita_acara') ?>";
                         });
                    } else {
                         $('#btnSave').text('Simpan BAST');
                         $('#btnSave').attr('disabled', false);
                         Swal.fire('Gagal!', data.pesan, 'error');
                    }
               },
               error: function () {
                    $('#btnSave').text('Simpan BAST');
                    $('#btnSave').attr('disabled', false);
                    Swal.fire('Error!', 'Terjadi kesalahan pada server.', 'error');
               }
          });
     });

</script>