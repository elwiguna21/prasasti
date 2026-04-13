<!-- Page Title -->
<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item active">Alih Media Arsip Usul Serah</li>
     </ol>
</div>

<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-header">
                    <h4 class="card-title">Data Alih Media Arsip Usul Serah</h4>
                    <div>
                         <a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah/berita_acara') ?>" class="btn btn-info btn-sm me-2">
                              <i class="fas fa-file-signature me-1"></i> Berita Acara (BAST)
                         </a>
                         <a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah/tambah') ?>" class="btn btn-primary btn-sm">
                              <i class="fas fa-plus me-1"></i> Tambah Data
                         </a>
                    </div>
               </div>
               <div class="card-body">

                    <!-- Filter SKPD -->
                    <div class="row mb-3">
                         <div class="col-md-4">
                              <label class="form-label">Filter SKPD:</label>
                              <select id="filter_skpd" class="form-control default-select">
                                   <option value="">-- Semua SKPD --</option>
                                   <?php if (!empty($list_skpd)): foreach ($list_skpd as $skpd): ?>
                                             <option value="<?= htmlspecialchars($skpd->id) ?>"><?= htmlspecialchars($skpd->nama_skpd) ?></option>
                                   <?php endforeach;
                                   endif; ?>
                              </select>
                         </div>
                    </div>

                    <div class="table-responsive">
                         <table id="dataTable" class="display" style="min-width: 1200px">
                              <thead>
                                   <tr>
                                        <th width="40">No</th>
                                        <th>Klasifikasi</th>
                                        <th>Uraian Informasi Arsip</th>
                                        <th>Kurun Waktu</th>
                                        <th>Jumlah</th>
                                        <th>Waktu</th>
                                        <th width="150">Status</th>
                                        <th width="120">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody></tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- Required vendors -->
<script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script>
<script src="<?= base_url('assets/v3/backend/') ?>vendor/select2/js/select2.full.min.js"></script>
<script src="<?= base_url('assets/v3/backend/') ?>js/plugins-init/select2-init.js"></script>
<script src="<?= base_url('assets/v3/backend/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
     var table;
     var base_url = '<?php echo base_url(); ?>';


     $('#filter_skpd').select2({
          width: "100%"
     });

     table = $('#dataTable').DataTable({
          "processing": true,
          "serverSide": true,
          "order": [
               [1, 'asc']
          ],
          "ajax": {
               "url": "<?php echo base_url('v2/backend/alih_media_arsip_usul_serah/ajax_list') ?>",
               "type": "POST",
               "data": function(data) {
                    data.filter_skpd = $('#filter_skpd').val();
               }
          },
          "columnDefs": [{
                    "targets": [0],
                    "orderable": false
               },
               {
                    "targets": [-1],
                    "orderable": false
               }
          ],
          "language": {
               "processing": "Memproses...",
               "search": "Cari:",
               "lengthMenu": "Tampilkan _MENU_ data",
               "info": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
               "infoEmpty": "Tidak ada data",
               "infoFiltered": "(dari _MAX_ total data)",
               "zeroRecords": "Tidak ada data yang ditemukan",
               "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
               }
          }
     });

     // Reload table on dropdown change
     $('#filter_skpd').on('change', function() {
          table.ajax.reload();
     });

     function edit_data(id) {
          window.location.href = base_url + 'v2/backend/alih_media_arsip_usul_serah/edit/' + id;
     }

     function reload_table() {
          table.ajax.reload(null, false);
     }

     function delete_data(id) {
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
                         url: base_url + 'v2/backend/alih_media_arsip_usul_serah/ajax_delete/' + id,
                         type: "POST",
                         dataType: "JSON",
                         success: function() {
                              Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                              reload_table();
                         },
                         error: function() {
                              Swal.fire('Error!', 'Gagal menghapus data.', 'error');
                         }
                    });
               }
          });
     }
</script>
