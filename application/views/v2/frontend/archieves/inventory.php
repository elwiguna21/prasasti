<link rel="stylesheet" href="<?= base_url() ?>assets/v3/backend/vendor/datatables/css/jquery.dataTables.min.css">

<div class="dlab-bnr-inr overlay-primary" style="background-image:url(<?= base_url('assets/v3/frontend/images/banner/bnr2.jpg') ?>);">
     <div class="container">
          <div class="dlab-bnr-inr-entry">
               <h1 class="text-white">Inventaris Arsip</h1>
               <!-- Breadcrumb row -->
               <div class="breadcrumb-row">
                    <ul class="list-inline">
                         <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                         <li><a href="<?= base_url('v2/frontend/archieves') ?>">Arsip Statis</a></li>
                         <li>Inventaris Arsip</li>
                    </ul>
               </div>
               <!-- Breadcrumb row END -->
          </div>
     </div>
</div>

<div class="section-full content-inner">
     <div class="container">
          <div class="section-head text-black text-center">
               <h2 class="text-uppercase m-b10">Inventaris Arsip</h2>
               <p>Sarana untuk menemukan kembali arsip yang memuat uraian informasi rinci mengenai arsip yang telah diolah.</p>
          </div>

          <form class="shop-form row" id="form-filter">
               <div class="row">
                    <div class="form-group col-lg-6 col-md-12">
                         <input type="text" id="search" class="form-control" placeholder="Cari kode klasifikasi atau indeks arsip" autocomplete="off" value="">
                    </div>
                    <div class="form-group col-lg-4 col-md-6">
                         <select class="form-control" id="company">
                              <option value="">Pilih SKPD</option>
                              <?php foreach ($companies as $company) { ?>
                                   <option value="<?= $company->no_company; ?>"><?= $company->name; ?></option>
                              <?php } ?>
                         </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-6">
                         <button type="button" class="site-button btn-filter">Cari</button>
                         <button type="button" class="ms-2 site-button bg-warning btn-reset">Reset</button>
                    </div>
               </div>
          </form>

          <div class="row">
               <div class="col-md-12">
                    <div class="table-responsive">
                         <table class="table check-tbl" id="inventory-table">
                              <thead class="">
                                   <tr>
                                        <th width="5%" class="text-center">No.</th>
                                        <th>Kode Klasifikasi</th>
                                        <th>Indeks</th>
                                        <th>Tahun</th>
                                        <th>SKPD</th>
                                        <th>Jenis Arsip</th>
                                        <th width="5%" class="text-center">Aksi</th>
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

<!-- REQUIRED VENDORS! -->
<!-- <script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script> -->

<!-- SweetAlert2 -->
<!-- <script src="<?= base_url('assets/v3/backend/') ?>vendor/sweetalert2/sweetalert2.min.js"></script> -->

<script src="<?= base_url() ?>assets/v3/backend/vendor/datatables/js/jquery.dataTables.min.js"></script>

<script>
     let inventory_table = $('#inventory-table').DataTable({
          responsive: false,
          searching: true,
          processing: true,
          serverSide: true,
          ajax: {
               url: "<?= base_url('v2/frontend/archieves/get_inventories_json') ?>",
               type: "post",
               data: {
                    search: function() {
                         return $("#search").val();
                    },
                    company: function() {
                         return $("#company").val();
                    }
               }
          },
          bLengthChange: !1,
          order: [
               [0, "desc"]
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
               data: "klasifikasi",
          }, {
               data: "indeks",
          }, {
               data: "tahun",
          }, {
               data: "skpd",
          }, {
               data: "jenis",
          }, {
               data: "actions",
               bSortable: !1,
          }]
     });
     $(".dataTables_paginate").addClass("radius-md");
     $(".dataTables_filter").hide();

     $('.btn-filter').click(function() {
          inventory_table.ajax.reload();
     });

     $('.btn-reset').click(function() {
          $('#search').val(null);
          $('#company').val("").trigger('change');
          $('#form-filter')[0].reset();
          $('#form-filter').find('input:text, input:password, input:file, select, textarea').val('');
          console.log($('#company').val());

          inventory_table.ajax.reload();
     })
</script>
