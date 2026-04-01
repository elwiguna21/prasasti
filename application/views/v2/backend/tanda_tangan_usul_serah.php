<!-- Page Title -->
<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item active">Tanda Tangan Elektronik</li>
     </ol>
</div>

<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-header">
                    <div>
                         <h4 class="card-title"><i class="fas fa-pen-nib me-2 text-primary"></i>Dokumen Alih Media Arsip Usul Serah</h4>
                         <p class="text-muted small mb-0">Daftar berkas yang telah diverifikasi LKD beserta status tanda tangan elektroniknya.</p>
                    </div>
               </div>
               <div class="card-body">
                    <div class="table-responsive">
                         <table id="tteTable" class="display" style="min-width:1000px">
                              <thead>
                                   <tr>
                                        <th width="40">No</th>
                                        <th>Klasifikasi</th>
                                        <th>Uraian Informasi Arsip</th>
                                        <th>Unit Kerja Pencipta</th>
                                        <th>Kurun Waktu</th>
                                        <th width="200">Status Penandatanganan</th>
                                        <th width="60">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody></tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>

<script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script>

<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';

$(document).ready(function() {
     $('#tteTable').DataTable({
          "processing": true,
          "serverSide": true,
          "order": [[1, 'asc']],
          "ajax": {
               "url": "<?php echo base_url('v2/backend/alih_media_arsip_usul_serah/ajax_tte_list') ?>",
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
               "infoEmpty": "Tidak ada dokumen yang menunggu TTE",
               "infoFiltered": "(dari _MAX_ total data)",
               "zeroRecords": "Tidak ada dokumen yang menunggu TTE saat ini",
               "paginate": { "first": "Pertama", "last": "Terakhir", "next": "Selanjutnya", "previous": "Sebelumnya" }
          }
     });
});
</script>
