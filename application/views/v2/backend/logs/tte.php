<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);">Daftar Log TTE</a></li>
     </ol>
</div>

<div class="row">
     <div class="col-xxl-4 col-lg-4 col-sm-12">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-primary text-primary">
                              <i class="ti-archive"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Total Log</p>
                              <h4 class="mb-0"><?= number_format($total_logs, 0, ',', '.'); ?></h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xxl-4 col-lg-4 col-sm-12">
          <div class="widget-stat card">
               <div class="card-body  p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-danger text-danger">
                              <i class="fas fa-file-signature"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">TTE Gagal</p>
                              <h4 class="mb-0"><?= number_format($total_logs_failed, 0, ',', '.'); ?></h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xxl-4 col-lg-4 col-sm-12">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-success text-success">
                              <i class="las la-signature"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">TTE Berhasil</p>
                              <h4 class="mb-0"><?= number_format($total_logs_success, 0, ',', '.'); ?></h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="row">
     <div class="col-12">
          <div class="filter cm-content-box box-primary pt-3">
               <div class="content-title mb-2">
                    <div class="cpa">
                         <i class="fa-sharp fa-solid fa-file-alt me-2"></i>Daftar Logs TTE
                    </div>
               </div>
               <div class="cm-content-body form excerpt">
                    <div class="card-body">
                         <div class="table-responsive">
                              <table id="logs-table" class="display" style="min-width: 845px">
                                   <thead>
                                        <tr>
                                             <th class="text-center">No.</th>
                                             <th class="text-center">Pegawai</th>
                                             <th class="text-center">IP Address</th>
                                             <th class="text-start">Tanggal TTE</th>
                                             <th class="text-center">Status TTE</th>
                                             <th class="text-center">Deskripsi</th>
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
</div>

<script src="<?= base_url('assets/v3/backend/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script>
     var logs_table = $('#logs-table').DataTable({
          // responsive: false,
          searching: true,
          processing: true,
          serverSide: true,
          ajax: {
               url: "<?= base_url('v2/Logs/get_logs_tte_json') ?>",
               type: "post",
               data: {
                    search: function() {
                         return $("#search").val();
                    },
                    status: function() {
                         return $("#status").val();
                    },
                    year: function() {
                         return $("#year").val();
                    },
                    company: function() {
                         return $("#company").val();
                    },
               }
          },
          // bLengthChange: !1,
          order: [
               [0, "desc"]
          ],
          language: {
               processing: '<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> Mohon tunggu ...',
               infoEmpty: '<strong>Tidak ada data</strong>',
               zeroRecords: '<div class="alert alert-danger content-center" role="alert"><div class="alert-content"><p>Maaf, data tidak ditemukan...</p></div></div>',
               searchPlaceholder: 'Cari berdasarkan deskripsi / tanggal / status...',
               sSearch: '',
               lengthMenu: "Tampilkan _MENU_ data",
               paginate: {
                    next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
               }
          },
          columns: [{
               data: "",
               className: 'text-center',
               render: function(data, type, row, meta) {
                    let number = meta.row + meta.settings._iDisplayStart + 1;
                    return "<span class='d-flex justify-content-center'>" + number + "</span>";
               }
          }, {
               data: "employee",
               className: 'text-center'
          }, {
               data: "ip_address",
               className: 'text-center'
          }, {
               bSortable: !1,
               data: "signed"
          }, {
               data: "status",
               className: 'text-center'
          }, {
               bSortable: !1,
               data: "description",
               className: 'text-center'
          }]
     });
     $(".dataTables_paginate").addClass("pagination-rounded");
     $(".dataTables_filter").hide();
</script>
