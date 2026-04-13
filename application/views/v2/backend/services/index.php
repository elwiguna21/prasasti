<style>
     .dataTables_filter input {
          width: 400px !important;
          /* Or any specific pixel or percentage value (e.g., 50%) */
     }
</style>

<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);">Daftar Arsip Vital</a></li>
     </ol>
</div>

<div class="row">
     <div class="col-xxl-3 col-lg-3 col-sm-6">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-primary text-primary">
                              <i class="fas fa-file-upload"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Total Permohonan</p>
                              <h4 class="mb-0"><?= number_format($total_all, 0, ',', '.'); ?></h4>
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
                              <i class="fas fa-clock"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Menunggu Persetujuan</p>
                              <h4 class="mb-0"><?= number_format($total_waiting, 0, ',', '.'); ?></h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xxl-3 col-lg-3 col-sm-6">
          <div class="widget-stat card">
               <div class="card-body  p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-success text-success">
                              <i class="fas fa-check-circle"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Permohonan Selesai</p>
                              <h4 class="mb-0"><?= number_format($total_done, 0, ',', '.'); ?></h4>
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
                              <i class="fas fa-close"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Permohonan Ditolak</p>
                              <h4 class="mb-0"><?= number_format($total_reject, 0, ',', '.'); ?></h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-12">
          <div class="card">
               <div class="card-header">
                    <h6 class="card-title text-primary">Daftar Permohonan Perbaikan Arsip</h6>
               </div>
               <div class="card-body">
                    <div class="table-responsive">
                         <table id="services-table" class="display" style="min-width: 845px">
                              <thead>
                                   <tr>
                                        <th width="8%" class="text-center">No.</th>
                                        <th class="text-center">Nama lengkap</th>
                                        <th class="text-start">No. HP</th>
                                        <th class="text-center">Alamat Pemohon</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Permohonan Dibuat</th>
                                        <th width="8%" class="text-center">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>

<script src="<?= base_url('assets/v3/backend/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script>
     let services_table = $('#services-table').DataTable({
          searching: true,
          processing: true,
          serverSide: true,
          ajax: {
               url: "<?= base_url('v2/services/get_services_json') ?>",
               type: "post",
          },
          bLengthChange: !1,
          order: [
               [0, "desc"]
          ],
          language: {
               processing: '<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> Mohon tunggu ...',
               infoEmpty: '<strong>Tidak ada data</strong>',
               zeroRecords: '<div class="alert alert-danger content-center" role="alert"><div class="alert-content"><p>Maaf, data tidak ditemukan...</p></div></div>',
               searchPlaceholder: 'Cari tiket permohonan atau nama pemohon...',
               sSearch: '',
               paginate: {
                    next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
               }
          },
          columns: [{
               data: "id",
               render: function(data, type, row, meta) {
                    let number = meta.row + meta.settings._iDisplayStart + 1;
                    return "<span class='d-flex justify-content-center'>" + number + "</span>";
               }
          }, {
               data: 'fullname'
          }, {
               bSortable: !1,
               data: 'phone'
          }, {
               bSortable: !1,
               data: 'address'
          }, {
               data: 'status'
          }, {
               bSortable: !1,
               data: 'created_at'
          }, {
               bSortable: !1,
               data: 'action'
          }]
     });
     $(".dataTables_paginate").addClass("pagination-rounded");
     // $(".dataTables_filter").hide();
</script>
