<!-- Page Title -->
<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item active">FAQ</li>
     </ol>
</div>


     <div class="row">
          <div class="col-12">
               <div class="card">
                    <div class="card-header">
                         <h4 class="card-title">FAQ</h4>
                         <button class="btn btn-primary btn-sm" onclick="add_faq()"><i class="fas fa-plus me-1"></i> Tambah Data</button>
                    </div>
                    <div class="card-body">
                         <div class="table-responsive">
                              <table id="dataTable" class="display" style="min-width: 845px">
                                   <thead>
                                        <tr>
                                             <th>No</th>
                                             <th>Pertanyaan</th>
                                             <th>Jawaban</th>
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
                    <h5 class="modal-title">FAQ Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form action="#" id="form" class="form-horizontal">
                         <input type="hidden" value="" name="idfaq" />
                         <div class="mb-3">
                              <label class="form-label">Pertanyaan</label>
                              <input type="text" name="pertanyaan" class="form-control" placeholder="Masukkan pertanyaan">
                              <span class="help-block text-danger"></span>
                         </div>
                         <div class="mb-3">
                              <label class="form-label">Jawaban</label>
                              <textarea name="jawaban" class="form-control" rows="6" placeholder="Masukkan jawaban"></textarea>
                              <span class="help-block text-danger"></span>
                         </div>
                    </form>
               </div>
               <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Batal</button>
               </div>
          </div>
     </div>
</div>

<!-- Required vendors -->
<script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script>

<script type="text/javascript">
var save_method, table;

$(document).ready(function() {
     table = $('#dataTable').DataTable({
          "processing": true, "serverSide": true, "order": [1, 'asc'],
          "ajax": { "url": "<?php echo base_url('v2/backend/faqs/ajax_list') ?>", "type": "POST" },
          "columnDefs": [{ "targets": [-1], "orderable": false }],
     });
     $("input, textarea, select").change(function() { $(this).closest('.mb-3').find('.help-block').empty(); $(this).removeClass('is-invalid'); });
});

function add_faq() {
     save_method = 'add'; $('#form')[0].reset(); $('.help-block').empty();
     var myModal = new bootstrap.Modal(document.getElementById('modal_form')); myModal.show(); $('.modal-title').text('Tambah FAQ');
}

function edit_faq(id) {
     save_method = 'update'; $('#form')[0].reset(); $('.help-block').empty();
     $.ajax({
          url: "<?php echo site_url('v2/backend/faqs/ajax_edit/') ?>" + id, type: "GET", dataType: "JSON",
          success: function(data) {
               $('[name="idfaq"]').val(data.idfaq);
               $('[name="pertanyaan"]').val(data.pertanyaan);
               $('[name="jawaban"]').val(data.jawaban);
               var myModal = new bootstrap.Modal(document.getElementById('modal_form')); myModal.show(); $('.modal-title').text('Edit FAQ');
          },
          error: function() { alert('Error mengambil data'); }
     });
}

function reload_table() { table.ajax.reload(null, false); }

function save() {
     $('#btnSave').text('Menyimpan...').attr('disabled', true);
     var url = (save_method == 'add') ? "<?php echo site_url('v2/backend/faqs/ajax_add') ?>" : "<?php echo site_url('v2/backend/faqs/ajax_update') ?>";
     $.ajax({
          url: url, type: "POST", data: $('#form').serialize(), dataType: "JSON",
          success: function(data) {
               if (data.status) { bootstrap.Modal.getInstance(document.getElementById('modal_form')).hide(); reload_table(); }
               else { for (var i = 0; i < data.inputerror.length; i++) { $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid').closest('.mb-3').find('.help-block').text(data.error_string[i]); } }
               $('#btnSave').text('Simpan').attr('disabled', false);
          },
          error: function() { alert('Error menyimpan data'); $('#btnSave').text('Simpan').attr('disabled', false); }
     });
}

function delete_faq(id) {
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
               $.ajax({ url: "<?php echo site_url('v2/backend/faqs/ajax_delete/') ?>" + id, type: "POST", dataType: "JSON",
                    success: function() { Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success'); reload_table(); },
                    error: function() { Swal.fire('Error!', 'Gagal menghapus data.', 'error'); }
               });
          }
     });
}
</script>
