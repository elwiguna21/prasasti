<link rel="stylesheet" href="<?= base_url() ?>assets/v3/backend/vendor/datatables/css/jquery.dataTables.min.css">
<style>
     .dataTables_filter input {
          width: 300px !important;
          /* Or any specific pixel or percentage value (e.g., 50%) */
     }
</style>

<div class="dlab-bnr-inr overlay-primary" style="background-image:url(<?= base_url('assets/v3/frontend/') ?>images/banner/bnr5.jpg);">
     <div class="container">
          <div class="dlab-bnr-inr-entry">
               <h1 class="text-white">Daftar Peraturan / Regulasi</h1>
               <div class="breadcrumb-row">
                    <ul class="list-inline">
                         <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                         <li>Daftar Peraturan</li>
                    </ul>
               </div>
          </div>
     </div>
</div>

<div class="content-block">
     <!-- About Us -->
     <div class="section-full content-inner">
          <div class="container">
               <div class="row">
                    <div class="col-md-12">
                         <div class="table-responsive">
                              <table class="table check-tbl" id="regulations-table">
                                   <thead class="text-left">
                                        <tr>
                                             <th width="10%" class="text-center">No.</th>
                                             <th>Judul</th>
                                             <th width="20%" class="text-center">Berkas</th>
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

<script src="<?= base_url() ?>assets/v3/backend/vendor/global/global.min.js"></script>
<script src="<?= base_url() ?>assets/v3/backend/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script>
     let regulations_table = $('#regulations-table').DataTable({
          responsive: false,
          searching: true,
          processing: true,
          serverSide: true,
          ajax: {
               url: "<?= base_url('v2/frontend/regulations/get_regulations_json') ?>",
               type: "post",
               // data: {
               //      search: function() {
               //           return $("#search").val();
               //      }
               // }
          },
          bLengthChange: !1,
          order: [
               [0, "asc"]
          ],
          language: {
               processing: '<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> Mohon tunggu ...',
               infoEmpty: '<strong>Tidak ada data</strong>',
               zeroRecords: '<div class="alert alert-danger content-center" role="alert"><div class="alert-content"><p>Maaf, data tidak ditemukan...</p></div></div>',
               searchPlaceholder: 'Cari nama peraturan ...',
               sSearch: '',
               paginate: {
                    next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
               }
          },
          columns: [{
               data: "",
               render: function(data, type, row, meta) {
                    let number = meta.row + meta.settings._iDisplayStart + 1;
                    return "<span class='d-flex justify-content-center'>" + number + "</span>";
               }
          }, {
               data: "title",
          }, {
               data: "document",
               bSortable: !1,
          }]
     });
     $(".dataTables_paginate").addClass("radius-md");
     // $(".dataTables_filter").hide();
</script>
