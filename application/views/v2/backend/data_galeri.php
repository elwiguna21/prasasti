<!-- Page Title -->
<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item active">Galeri</li>
     </ol>
</div>


<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-header">
                    <h4 class="card-title">Galeri</h4>
                    <button class="btn btn-primary btn-sm" onclick="add_galeri()"><i class="fas fa-plus me-1"></i>
                         Tambah Data
                    </button>
               </div>
               <div class="card-body">
                    <div class="table-responsive">
                         <table id="dataTable" class="display" style="min-width: 845px">
                              <thead>
                              <tr>
                                   <th>No</th>
                                   <th>Judul</th>
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
                    <h5 class="modal-title">Galeri Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form action="#" id="form" class="form-horizontal">
                         <input type="hidden" value="" name="id"/>
                         <div class="mb-3">
                              <label class="form-label">Judul</label>
                              <input type="text" name="judul" class="form-control" placeholder="Masukkan judul galeri">
                              <span class="help-block text-danger"></span>
                         </div>
                         <div class="mb-3" id="photo-preview">
                              <div></div>
                         </div>
                         <div class="mb-3">
                              <label class="form-label">File Gambar</label>
                              <input type="file" class="form-control dropify" name="file" data-height="200">
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
    var save_method, table;
    var base_url = '<?php echo base_url(); ?>';


    table = $('#dataTable').DataTable({
        "processing": true, "serverSide": true, "order": [1, 'asc'],
        "ajax": {"url": "<?php echo base_url('v2/galleries/ajax_list') ?>", "type": "POST"},
        "columnDefs": [{"targets": [-1], "orderable": false}],
    });
    $("input, textarea, select").change(function () {
        $(this).closest('.mb-3').find('.help-block').empty();
        $(this).removeClass('is-invalid');
    });
    try {
        $('.dropify').dropify({
            messages: {
                default: '<h6>Pilih Gambar Galeri<br>Format: JPG, PNG</h6>',
                replace: 'Ganti',
                remove: 'Hapus',
                error: 'Error'
            }
        });
    } catch (e) {
        console.error("Dropify init error:", e);
    }

    function add_galeri() {
        save_method = 'add';
        $('#form')[0].reset();
        $('#photo-preview div').html('');
        $('.help-block').empty();
        var myModal = new bootstrap.Modal(document.getElementById('modal_form'));
        myModal.show();
        $('.modal-title').text('Tambah Galeri');
        var drEvent = $('.dropify').dropify();
        drEvent = drEvent.data('dropify');
        if (drEvent) drEvent.resetPreview();
    }

    function edit_galeri(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('.help-block').empty();
        $.ajax({
            url: "<?php echo site_url('v2/galleries/ajax_edit/') ?>" + id, type: "GET", dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id);
                $('[name="judul"]').val(data.caption);
                if (data.file) {
                    $('#photo-preview div').html('File lama: <img src="' + base_url + 'assets/upload/' + data.file + '" alt="" width="200" class="img-thumbnail"><input type="hidden" name="fileold" value="' + data.file + '">');
                }
                var myModal = new bootstrap.Modal(document.getElementById('modal_form'));
                myModal.show();
                $('.modal-title').text('Edit Galeri');
            },
            error: function () {
                alert('Error mengambil data');
            }
        });
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function save() {
        $('#btnSave').text('Menyimpan...').attr('disabled', true);
        var url = (save_method == 'add') ? "<?php echo site_url('v2/galleries/ajax_add') ?>" : "<?php echo site_url('v2/galleries/ajax_update') ?>";
        var formData = new FormData($('#form')[0]);
        $.ajax({
            url: url, type: "POST", data: formData, contentType: false, processData: false, dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    bootstrap.Modal.getInstance(document.getElementById('modal_form')).hide();
                    reload_table();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid').closest('.mb-3').find('.help-block').text(data.error_string[i]);
                    }
                }
                $('#btnSave').text('Simpan').attr('disabled', false);
            },
            error: function () {
                alert('Error menyimpan data');
                $('#btnSave').text('Simpan').attr('disabled', false);
            }
        });
    }

    function delete_galeri(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('v2/galleries/ajax_delete/') ?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function () {
                        Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                        reload_table();
                    },
                    error: function () {
                        Swal.fire('Error!', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    }
</script>
