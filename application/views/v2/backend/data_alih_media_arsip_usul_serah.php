<link rel="stylesheet" href="<?= base_url('assets/v3/backend/vendor/select2/css/select2.min.css') ?>">
<style>
     .select2-container--default .select2-selection--single {
          border-radius: 0.5rem;
          border: 0.0625rem solid #c8c8c8;
          height: 3.5rem;
          background: #fff;
     }

     .select2-container--default .select2-selection--single .select2-selection__rendered {
          line-height: 3.5rem;
          color: #7e7e7e;
          padding-left: 0.9375rem;
          min-height: 3.5rem;
     }

     .select2-container--default .select2-selection--single .select2-selection__arrow {
          top: 1.075rem;
          right: 0.9375rem;
     }
</style>

<!-- Page Title -->
<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item active">Alih Media Arsip Usul Serah</li>
     </ol>
</div>

<!-- Statistik Cards -->
<div class="row">
     <div class="col-xxl-3 col-lg-3 col-sm-6">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-primary text-primary">
                              <i class="ti-archive"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Arsip Usul Serah</p>
                              <h4 class="mb-0"><?= number_format($total_arsip, 0, ',', '.'); ?></h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xxl-3 col-lg-3 col-sm-6">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-warning text-warning">
                              <i class="fas fa-check-circle"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Diverifikasi</p>
                              <h4 class="mb-0"><?= number_format($total_diverifikasi, 0, ',', '.'); ?></h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xxl-3 col-lg-3 col-sm-6">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-danger text-danger">
                              <i class="fas fa-file-signature"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Menunggu TTE</p>
                              <h4 class="mb-0"><?= number_format($total_menunggu_tte, 0, ',', '.'); ?></h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xxl-3 col-lg-3 col-sm-6">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-success text-success">
                              <i class="las la-signature"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Di TTE</p>
                              <h4 class="mb-0"><?= number_format($total_tte, 0, ',', '.'); ?></h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="row">
     <!-- Filter -->
     <div class="col-lg-12 mb-4">
          <div class="filter cm-content-box box-primary">
               <div class="content-title">
                    <div class="cpa">
                         <i class="fa-sharp fa-solid fa-filter me-2"></i>Filter
                    </div>
                    <div class="tools">
                         <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                    </div>
               </div>
               <div class="cm-content-body form excerpt">
                    <div class="card-body">
                         <div class="row">
                              <div class="<?= ($this->session->userdata('next-role') == 'admin') ? 'col-xl-3' : 'col-xl-4' ?> col-sm-12">
                                   <input type="text" class="form-control mb-xl-0 mb-3" id="search" placeholder="Cari kode klasifikasi atau indeks arsip..." autocomplete="off">
                              </div>
                              <div class="<?= ($this->session->userdata('next-role') == 'admin') ? 'col-xl-2' : 'col-xl-3' ?> col-sm-12">
                                   <select id="filter_status">
                                        <option value="">Semua Status</option>
                                        <option value="verify_waiting">Menunggu Verifikasi</option>
                                        <option value="verify_done">Sudah Diverifikasi</option>
                                        <option value="verify_reject">Verifikasi Ditolak</option>
                                        <option value="tte_waiting">Menunggu Tandatangan</option>
                                        <option value="tte_done">Sudah Ditandatangani</option>
                                        <option value="tte_reject">Tandatangan Ditolak</option>
                                   </select>
                              </div>
                              <div class="col-xl-2 col-sm-12">
                                   <select id="filter_tahun">
                                        <option value="">Semua Tahun</option>
                                        <?php if (!empty($years)): foreach ($years as $y): ?>
                                             <option value="<?= htmlspecialchars($y->name) ?>"><?= htmlspecialchars($y->name) ?></option>
                                        <?php endforeach; endif; ?>
                                   </select>
                              </div>
                              <?php if ($this->session->userdata('next-role') == 'admin'): ?>
                                   <div class="col-xl-2 col-sm-12">
                                        <select id="filter_skpd_adv">
                                             <option value="">-- Pilih SKPD --</option>
                                             <?php if (!empty($list_skpd)): foreach ($list_skpd as $skpd): ?>
                                                  <option value="<?= htmlspecialchars($skpd->id) ?>"><?= htmlspecialchars($skpd->nama_skpd) ?></option>
                                             <?php endforeach; endif; ?>
                                        </select>
                                   </div>
                              <?php endif; ?>
                              <div class="col-xl-3 col-sm-12">
                                   <button class="btn btn-primary btn-filter" title="Klik disini untuk mencari" type="button"><i class="fa fa-search me-1"></i>Filter</button>
                                   <button class="btn btn-danger light btn-reset" title="Klik disini untuk menghapus filter" type="button">Reset</button>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- Tabel Data -->
     <div class="col-12">
          <div class="filter cm-content-box box-primary pt-3">
               <div class="content-title mb-2">
                    <div class="cpa">
                         <i class="fa-sharp fa-solid fa-file-alt me-2"></i>Daftar Alih Media Arsip Usul Serah
                    </div>
                    <div class="align-middle">
                         <button type="button" class="btn btn-success btn-sm me-2" onclick="export_excel()">
                              <i class="fas fa-file-excel me-1"></i> Export Excel
                         </button>
                         <button type="button" class="btn btn-danger btn-sm me-2" onclick="export_pdf()">
                              <i class="fas fa-file-pdf me-1"></i> Export PDF
                         </button>
                         <a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah/berita_acara') ?>" class="btn btn-info btn-sm me-2">
                              <i class="fas fa-file-signature me-1"></i> Berita Acara (BAST)
                         </a>
                         <?php if ($this->session->userdata('next-role') == 'operator'): ?>
                              <a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah/tambah') ?>" class="btn btn-primary btn-sm">
                                   <i class="fas fa-plus me-1"></i> Tambah Data
                              </a>
                         <?php endif; ?>
                    </div>
               </div>
               <div class="cm-content-body form excerpt">
                    <div class="card-body">
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
</div>

<!-- Required vendors -->
<script src="<?= base_url('assets/v3/backend/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/v3/backend/vendor/select2/js/select2.full.min.js') ?>"></script>

<script type="text/javascript">
     var table;
     var base_url = '<?php echo base_url(); ?>';

     var statusSelect = $('#filter_status').select2({
          width: '100%',
     });
     
     var tahunSelect = $('#filter_tahun').select2({
          width: '100%',
     });

     <?php if ($this->session->userdata('next-role') == 'admin'): ?>
          var skpdSelect = $('#filter_skpd_adv').select2({
               width: '100%',
               placeholder: 'Pilih SKPD',
               allowClear: true
          });
     <?php endif; ?>

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
                    data.filter_skpd = $('#filter_skpd_adv').val() || '';
                    data.filter_status = $('#filter_status').val() || '';
                    data.filter_tahun = $('#filter_tahun').val() || '';
                    data.search_keyword = $('#search').val() || '';
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
               "processing": '<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> Mohon tunggu ...',
               "search": "Cari:",
               "lengthMenu": "Tampilkan _MENU_ data",
               "info": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
               "infoEmpty": "<strong>Tidak ada data</strong>",
               "infoFiltered": "(dari _MAX_ total data)",
               "zeroRecords": '<div class="alert alert-danger content-center" role="alert"><div class="alert-content"><p>Maaf, data tidak ditemukan...</p></div></div>',
               "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                    "previous": '<i class="fa fa-angle-left" aria-hidden="true"></i>'
               }
          }
     });

     $(".dataTables_paginate").addClass("pagination-rounded");
     $(".dataTables_filter").hide();

     // Filter button
     $('.btn-filter').click(function() {
          table.ajax.reload();
     });

     // Reset button
     $('.btn-reset').click(function() {
          $('#search').val('');
          if (statusSelect) statusSelect.val(null).trigger('change');
          if (tahunSelect) tahunSelect.val(null).trigger('change');
          <?php if ($this->session->userdata('next-role') == 'admin'): ?>
               if (skpdSelect) {
                    skpdSelect.val(null).trigger('change');
               }
          <?php endif; ?>
          table.ajax.reload();
     });

     function edit_data(id) {
          window.location.href = base_url + 'v2/backend/alih_media_arsip_usul_serah/edit/' + id;
     }

     function export_excel() {
          var filter_skpd = '';
          <?php if ($this->session->userdata('next-role') == 'admin'): ?>
               filter_skpd = $('#filter_skpd_adv').val() || '';
          <?php endif; ?>
          var search_keyword = $('#search').val() || '';
          var filter_status = $('#filter_status').val() || '';
          var filter_tahun = $('#filter_tahun').val() || '';
          
          var url = base_url + 'v2/backend/alih_media_arsip_usul_serah/export_excel?filter_skpd=' + encodeURIComponent(filter_skpd) + '&filter_status=' + encodeURIComponent(filter_status) + '&filter_tahun=' + encodeURIComponent(filter_tahun) + '&search_keyword=' + encodeURIComponent(search_keyword);
          window.location.href = url;
     }

     function export_pdf() {
          var filter_skpd = '';
          <?php if ($this->session->userdata('next-role') == 'admin'): ?>
               filter_skpd = $('#filter_skpd_adv').val() || '';
          <?php endif; ?>
          var search_keyword = $('#search').val() || '';
          var filter_status = $('#filter_status').val() || '';
          var filter_tahun = $('#filter_tahun').val() || '';
          
          var url = base_url + 'v2/backend/alih_media_arsip_usul_serah/export_pdf?filter_skpd=' + encodeURIComponent(filter_skpd) + '&filter_status=' + encodeURIComponent(filter_status) + '&filter_tahun=' + encodeURIComponent(filter_tahun) + '&search_keyword=' + encodeURIComponent(search_keyword);
          window.open(url, '_blank');
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
