<!-- Page Title -->
<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah') ?>">Alih Media Arsip Usul Serah</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah/berita_acara') ?>">Berita Acara (BAST)</a></li>
          <li class="breadcrumb-item active">Detail</li>
     </ol>
</div>

<div class="row">
     <div class="col-xl-12 col-lg-12">
          <div class="card">
               <div class="card-header bg-primary">
                    <h4 class="card-title text-white">Informasi Berita Acara</h4>
               </div>
               <div class="card-body">
                    <div class="row mb-4">
                         <div class="col-md-6">
                              <table class="table table-borderless table-sm">
                                   <tr>
                                        <th width="150">Nama BAST</th>
                                        <td width="10">:</td>
                                        <td><strong><?= htmlspecialchars($berita_acara->name) ?></strong></td>
                                   </tr>
                                   <tr>
                                        <th>Waktu Upload</th>
                                        <td>:</td>
                                        <td><?= date('d-m-Y H:i', strtotime($berita_acara->created_at)) ?></td>
                                   </tr>
                                   <tr>
                                        <th>File Terlampir</th>
                                        <td>:</td>
                                        <td>
                                             <?php if (!empty($berita_acara->document)): ?>
                                                  <a href="<?= base_url('assets/upload/berita_acara/' . $berita_acara->document) ?>" target="_blank" class="btn btn-sm btn-info light">
                                                       <i class="fas fa-file-pdf me-1"></i> Buka/Download BAST
                                                  </a>
                                             <?php else: ?>
                                                  <span class="text-danger">File tidak ditemukan</span>
                                             <?php endif; ?>
                                        </td>
                                   </tr>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-xl-12 col-lg-12">
          <div class="card">
               <div class="card-header">
                    <h4 class="card-title">Daftar Dokumen Usulan Serah</h4>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPilihDokumen">
                         <i class="fas fa-link me-1"></i> Tautkan Dokumen Usulan
                    </button>
               </div>
               <div class="card-body">
                    <div class="table-responsive">
                         <table id="tableLinkedDokumen" class="display" style="min-width: 800px">
                              <thead>
                                   <tr>
                                        <th width="40">No</th>
                                        <th>Uraian Informasi / Nama Berkas</th>
                                        <th>Unit Pencipta</th>
                                        <th>Kode Klasifikasi</th>
                                        <th width="100">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if (empty($linked_berkas)): ?>
                                        <tr>
                                             <td colspan="5" class="text-center text-muted">Belum ada dokumen yang ditautkan ke Berita Acara ini.</td>
                                        </tr>
                                   <?php else: ?>
                                        <?php $no = 1; foreach ($linked_berkas as $dok): ?>
                                             <tr>
                                                  <td><?= $no++ ?></td>
                                                  <td class="text-start"><?= htmlspecialchars($dok->uraian_informasi_arsip ?? '-') ?></td>
                                                  <td><?= htmlspecialchars($dok->unit_kerja_pencipta ?? '-') ?></td>
                                                  <td><?= htmlspecialchars($dok->kode_klsf ?? '-') ?></td>
                                                  <td>
                                                       <button type="button" class="btn btn-danger btn-xs" title="Hapus Tautan" onclick="unlink_dokumen(<?= $berita_acara->id ?>, <?= $dok->id ?>)">
                                                            <i class="fas fa-unlink"></i> Lepas
                                                       </button>
                                                  </td>
                                             </tr>
                                        <?php endforeach; ?>
                                   <?php endif; ?>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- Modal Pilih Dokumen -->
<div class="modal fade" id="modalPilihDokumen" tabindex="-1" aria-labelledby="modalPilihDokumenLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPilihDokumenLabel">Tautkan Dokumen Usulan yang Telah di-TTE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="form-link-dokumen">
               <input type="hidden" name="berita_acara_id" value="<?= $berita_acara->id ?>">
               <div class="table-responsive">
                    <table class="display" id="tableAvailableDokumen" style="min-width: 100%">
                         <thead>
                              <tr>
                                   <th width="40" class="text-center">
                                        <div class="form-check custom-checkbox ms-2">
                                             <input type="checkbox" class="form-check-input" id="checkAll">
                                             <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                   </th>
                                   <th>Uraian Informasi Arsip</th>
                                   <th>Unit Pencipta</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php if (empty($available_berkas)): ?>
                                   <tr>
                                        <td colspan="3" class="text-center text-muted">Tidak ada dokumen usulan siap TTE atau semua dokumen sudah ditautkan.</td>
                                   </tr>
                              <?php else: ?>
                                   <?php foreach ($available_berkas as $av): ?>
                                        <tr>
                                             <td class="text-center">
                                                  <div class="form-check custom-checkbox ms-2">
                                                       <input type="checkbox" name="berkas_ids[]" value="<?= $av->id ?>" class="form-check-input checkItem">
                                                  </div>
                                             </td>
                                             <td><?= htmlspecialchars($av->uraian_informasi_arsip ?? '-') ?></td>
                                             <td><?= htmlspecialchars($av->unit_kerja_pencipta ?? '-') ?></td>
                                        </tr>
                                   <?php endforeach; ?>
                              <?php endif; ?>
                         </tbody>
                    </table>
               </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="btnSimpanTautan" <?= empty($available_berkas) ? 'disabled' : '' ?>>Simpan Tautan</button>
      </div>
    </div>
  </div>
</div>

<!-- Required vendors -->
<script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script>
<script src="<?= base_url('assets/v3/backend/') ?>vendor/sweetalert2/dist/sweetalert2.min.js"></script>

<script>
$(document).ready(function() {
     // Config DataTable untuk modal (Optional, but good for searchability)
     if ($('#tableAvailableDokumen tbody tr td').length > 1) {
          $('#tableAvailableDokumen').DataTable({
               "pageLength": 10,
               "lengthChange": false,
               "columnDefs": [
                    { "targets": [0], "orderable": false }
               ]
          });
     }

     // Config DataTable untuk tabel dokumen utama (agar style seragam)
     if ($('#tableLinkedDokumen tbody tr td').length > 1) {
          $('#tableLinkedDokumen').DataTable({
               "pageLength": 10,
               "lengthMenu": [10, 25, 50, 100],
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
     }

     // Check all functionality
     $('#checkAll').on('change', function() {
          $('.checkItem').prop('checked', $(this).prop('checked'));
     });

     $('.checkItem').on('change', function() {
          if ($('.checkItem:checked').length === $('.checkItem').length) {
               $('#checkAll').prop('checked', true);
          } else {
               $('#checkAll').prop('checked', false);
          }
     });

     // Simpan tautan (AJAX)
     $('#btnSimpanTautan').on('click', function() {
          var checkedLen = $('.checkItem:checked').length;
          if (checkedLen === 0) {
               Swal.fire('Perhatian', 'Silakan pilih minimal 1 dokumen untuk ditautkan.', 'warning');
               return;
          }

          var btn = $(this);
          btn.text('Menyimpan...').attr('disabled', true);

          $.ajax({
               url: "<?= base_url('v2/backend/alih_media_arsip_usul_serah/ajax_link_berkas') ?>",
               type: "POST",
               data: $('#form-link-dokumen').serialize(),
               dataType: "JSON",
               success: function(data) {
                    if (data.status) {
                         Swal.fire({
                              title: 'Berhasil!',
                              text: data.pesan,
                              icon: 'success',
                              showConfirmButton: false,
                              timer: 1500
                         }).then(function() {
                              location.reload();
                         });
                    } else {
                         btn.text('Simpan Tautan').attr('disabled', false);
                         Swal.fire('Gagal!', data.pesan, 'error');
                    }
               },
               error: function() {
                    btn.text('Simpan Tautan').attr('disabled', false);
                    Swal.fire('Error!', 'Terjadi kesalahan sistem.', 'error');
               }
          });
     });
});

function unlink_dokumen(berita_id, berkas_id) {
     Swal.fire({
          title: 'Lepas Tautan?',
          text: 'Dokumen akan dilepas dari BAST ini.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, Lepas!',
          cancelButtonText: 'Batal'
     }).then((result) => {
          if (result.isConfirmed) {
               $.ajax({
                    url: "<?= base_url('v2/backend/alih_media_arsip_usul_serah/ajax_unlink_berkas/') ?>" + berita_id + "/" + berkas_id,
                    type: "POST",
                    dataType: "JSON",
                    success: function() {
                         Swal.fire('Terlepas!', 'Dokumen berhasil dilepas.', 'success').then(() => {
                              location.reload();
                         });
                    },
                    error: function() {
                         Swal.fire('Error!', 'Gagal melepas dokumen.', 'error');
                    }
               });
          }
     });
}
</script>
