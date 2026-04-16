<!-- Page Title -->
<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah') ?>">Alih Media
                    Arsip Usul Serah</a></li>
          <li class="breadcrumb-item active">Berita Acara (BAST)</li>
     </ol>
</div>

<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-header">
                    <h4 class="card-title">Data Berita Acara Serah Terima (BAST)</h4>
                    <a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah/tambah_berita_acara') ?>"
                         class="btn btn-primary btn-sm">
                         <i class="fas fa-plus me-1"></i> Upload BAST Baru
                    </a>
               </div>
               <div class="card-body">
                    <div class="table-responsive">
                         <table id="dataTable" class="display" style="min-width: 800px">
                              <thead>
                                   <tr>
                                        <th width="40">No</th>
                                        <th>Nama / Nomor BAST</th>
                                        <th>Waktu Upload</th>
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
<script src="<?= base_url('assets/v3/backend/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
     var table;
     var base_url = '<?php echo base_url(); ?>';

     table = $('#dataTable').DataTable({
          "processing": true,
          "serverSide": true,
          "order": [[2, 'desc']],
          "ajax": {
               "url": "<?php echo base_url('v2/backend/alih_media_arsip_usul_serah/ajax_list_berita_acara') ?>",
               "type": "POST"
          },
          "columnDefs": [
               { "targets": [0], "orderable": false },
               { "targets": [-1], "orderable": false }
          ],
          "language": {
               "processing": "Memproses...",
               "search": "Cari:",
               "lengthMenu": "Tampilkan _MENU_ data",
               "info": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
               "infoEmpty": "Tidak ada data",
               "infoFiltered": "(dari _MAX_ total data)",
               "zeroRecords": "Tidak ada data yang ditemukan",
               "paginate": { "first": "Pertama", "last": "Terakhir", "next": "Selanjutnya", "previous": "Sebelumnya" }
          }
     });


     function reload_table() {
          table.ajax.reload(null, false);
     }

     function delete_berita_acara(id) {
          Swal.fire({
               title: 'Apakah Anda yakin?',
               text: 'Data BAST dan relasinya ke dokumen akan dihapus!',
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#d33',
               cancelButtonColor: '#3085d6',
               confirmButtonText: 'Ya, hapus!',
               cancelButtonText: 'Batal'
          }).then((result) => {
               if (result.isConfirmed) {
                    $.ajax({
                         url: base_url + 'v2/backend/alih_media_arsip_usul_serah/ajax_delete_berita_acara/' + id,
                         type: "POST",
                         dataType: "JSON",
                         success: function () {
                              Swal.fire('Terhapus!', 'BAST berhasil dihapus.', 'success');
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