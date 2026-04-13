<!-- Page Title -->
<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item active">Profil</li>
     </ol>
</div>

<!-- Main Content -->
<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-header">
                    <h4 class="card-title">Profil</h4>
                    <button class="btn btn-primary btn-sm" onclick="add_profil()"><i class="fas fa-plus me-1"></i>
                         Tambah Profil
                    </button>
               </div>
               <div class="card-body">
                    <div class="table-responsive">
                         <table id="dataTable" class="display" style="min-width: 845px">
                              <thead>
                              <tr>
                                   <th>No</th>
                                   <th>Alamat</th>
                                   <th>Telepon</th>
                                   <th>Action</th>
                              </tr>
                              </thead>
                              <tbody></tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- Bootstrap 5 Modal -->
<div class="modal fade" id="modal_form" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title">Form Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form action="#" id="form" class="form-horizontal">
                         <input type="hidden" value="" name="id"/>

                         <!-- Alamat & Telepon -->
                         <div class="row">
                              <div class="col-md-6 mb-3">
                                   <label class="form-label">Alamat</label>
                                   <textarea name="alamat" class="form-control" rows="3"
                                             placeholder="Alamat lengkap"></textarea>
                                   <span class="help-block text-danger"></span>
                              </div>
                              <div class="col-md-6 mb-3">
                                   <label class="form-label">Telepon</label>
                                   <input type="text" name="telepon" class="form-control" placeholder="Nomor Telepon">
                                   <span class="help-block text-danger"></span>
                              </div>
                         </div>

                         <!-- Visi & Misi -->
                         <div class="row">
                              <div class="col-md-6 mb-3">
                                   <label class="form-label">Visi</label>
                                   <textarea name="visi" class="form-control" rows="4"
                                             placeholder="Visi organisasi"></textarea>
                                   <span class="help-block text-danger"></span>
                              </div>
                              <div class="col-md-6 mb-3">
                                   <label class="form-label">Misi</label>
                                   <textarea name="misi" class="form-control" rows="4"
                                             placeholder="Misi organisasi"></textarea>
                                   <span class="help-block text-danger"></span>
                              </div>
                         </div>

                         <!-- Sambutan & Gambaran Umum -->
                         <div class="row">
                              <div class="col-md-6 mb-3">
                                   <label class="form-label">Sambutan</label>
                                   <textarea name="sambutan" class="form-control" rows="4"
                                             placeholder="Kata sambutan"></textarea>
                                   <span class="help-block text-danger"></span>
                              </div>
                              <div class="col-md-6 mb-3">
                                   <label class="form-label">Gambaran Umum</label>
                                   <textarea name="gambaran_umum" class="form-control" rows="4"
                                             placeholder="Gambaran umum organisasi"></textarea>
                                   <span class="help-block text-danger"></span>
                              </div>
                         </div>

                         <!-- Tugas Fungsi & Sejarah -->
                         <div class="row">
                              <div class="col-md-6 mb-3">
                                   <label class="form-label">Tugas & Fungsi</label>
                                   <textarea name="tugas_fungsi" class="form-control" rows="4"
                                             placeholder="Tugas dan fungsi"></textarea>
                                   <span class="help-block text-danger"></span>
                              </div>
                              <div class="col-md-6 mb-3">
                                   <label class="form-label">Sejarah</label>
                                   <textarea name="sejarah" class="form-control" rows="4"
                                             placeholder="Sejarah organisasi"></textarea>
                                   <span class="help-block text-danger"></span>
                              </div>
                         </div>

                         <!-- Struktur Organisasi -->
                         <div class="mb-3">
                              <label class="form-label">Deskripsi Struktur Organisasi</label>
                              <textarea name="struktur_organisasi" class="form-control" rows="3"
                                        placeholder="Deskripsi struktur organisasi"></textarea>
                              <span class="help-block text-danger"></span>
                         </div>

                         <div class="mb-3" id="photo-preview">
                              <div></div>
                         </div>
                         <div class="mb-3">
                              <label class="form-label">Gambar Struktur Organisasi</label>
                              <input type="file" class="form-control dropify" name="file_struktur_organisasi"
                                     data-height="150" data-allowed-file-extensions="jpg png jpeg">
                              <span class="help-block text-danger"></span>
                         </div>

                    </form>
               </div>
               <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><i
                                 class="fas fa-save me-1"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Batal</button>
               </div>
          </div>
     </div>
</div>

<script src="<?= base_url('assets/v3/backend/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>

<!-- Dropify -->
<link rel="stylesheet" href="<?= base_url('assets/v3/backend/vendor/dropify/css/dropify.min.css') ?>"/>
<script src="<?= base_url('assets/v3/backend/vendor/dropify/js/dropify.min.js') ?>"></script>

<script type="text/javascript">
    var save_method;
    var table;
    var base_url = '<?php echo base_url(); ?>';


    // DataTable
    table = $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url('v2/profiles/ajax_list') ?>",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [-1],
            "orderable": false,
        }],
    });

    // Reset validation on input change
    $("input, textarea, select").change(function () {
        $(this).closest('.mb-3').find('.help-block').empty();
        $(this).removeClass('is-invalid');
    });

    // Dropify Init with Try-Catch Safety
    try {
        $('.dropify').dropify({
            messages: {
                default: '<h6>Pilih Gambar Struktur Organisasi<br>Format: JPG, PNG</h6>',
                replace: 'Ganti',
                remove: 'Hapus',
                error: 'Error'
            }
        });
    } catch (e) {
        console.error("Dropify init error:", e);
    }


    function add_profil() {
        save_method = 'add';
        $('#form')[0].reset();
        $('.help-block').empty();
        $('#photo-preview div').html('');

        var myModal = new bootstrap.Modal(document.getElementById('modal_form'));
        myModal.show();
        $('.modal-title').text('Tambah Profil');

        // Reset Dropify
        var drEvent = $('.dropify').dropify();
        drEvent = drEvent.data('dropify');
        if (drEvent) drEvent.resetPreview();
    }

    function edit_profil(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('v2/profiles/ajax_edit/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id);
                $('[name="alamat"]').val(data.alamat);
                $('[name="telepon"]').val(data.telepon);
                $('[name="visi"]').val(data.visi);
                $('[name="misi"]').val(data.misi);
                $('[name="sambutan"]').val(data.sambutan);
                $('[name="gambaran_umum"]').val(data.gambaran_umum);
                $('[name="tugas_fungsi"]').val(data.tugas_fungsi);
                $('[name="sejarah"]').val(data.sejarah);
                $('[name="struktur_organisasi"]').val(data.struktur_organisasi);

                if (data.file_struktur_organisasi) {
                    $('#photo-preview div').html('Gambar lama: <div class="mb-2"><img src="' + base_url + 'assets/upload/' + data.file_struktur_organisasi + '" class="img-fluid img-thumbnail" style="max-height: 200px;"></div><input type="hidden" name="fileold" value="' + data.file_struktur_organisasi + '">');
                } else {
                    $('#photo-preview div').html('');
                }

                var myModal = new bootstrap.Modal(document.getElementById('modal_form'));
                myModal.show();
                $('.modal-title').text('Edit Profil');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error mengambil data dari server');
            }
        });
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function save() {
        $('#btnSave').text('Menyimpan...').attr('disabled', true);
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('v2/profiles/ajax_add') ?>";
        } else {
            url = "<?php echo site_url('v2/profiles/ajax_update') ?>";
        }

        var formData = new FormData($('#form')[0]);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    bootstrap.Modal.getInstance(document.getElementById('modal_form')).hide();
                    reload_table();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data profil berhasil disimpan.',
                        timer: 1500
                    });
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                        $('[name="' + data.inputerror[i] + '"]').closest('.mb-3').find('.help-block').text(data.error_string[i]);
                    }
                }
                $('#btnSave').text('Simpan').attr('disabled', false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error menyimpan data');
                $('#btnSave').text('Simpan').attr('disabled', false);
            }
        });
    }

    function delete_profil(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('v2/profiles/ajax_delete/') ?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        Swal.fire(
                            'Terhapus!',
                            'Data profil berhasil dihapus.',
                            'success'
                        );
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire(
                            'Error!',
                            'Gagal menghapus data.',
                            'error'
                        );
                    }
                });
            }
        })
    }
</script>
