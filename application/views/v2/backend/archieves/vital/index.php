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
                              <i class="ti-archive"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Total Arsip</p>
                              <h4 class="mb-0"><?= number_format($total_archieves, 0, ',', '.'); ?></h4>
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
                              <h4 class="mb-0"><?= number_format($total_verification, 0, ',', '.'); ?></h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xxl-3 col-lg-3 col-sm-6">
          <div class="widget-stat card">
               <div class="card-body  p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-danger text-danger">
                              <i class="fas fa-file-signature"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Menunggu TTE</p>
                              <h4 class="mb-0"><?= number_format($total_unsigned, 0, ',', '.'); ?></h4>
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
                              <h4 class="mb-0"><?= number_format($total_signed, 0, ',', '.'); ?></h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="row">
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
                              <div class="<?= ($this->session->userdata('next-role') == 'admin') ? 'col-xl-5' : 'col-xl-9' ?> col-sm-12">
                                   <input type="text" class="form-control mb-xl-0 mb-3" id="search" placeholder="Cari kode klasifikasi atau indeks arsip..." autocomplete="off">
                              </div>
                              <?php if ($this->session->userdata('next-role') == 'admin') { ?>
                                   <div class="col-xl-4 col-sm-12">
                                        <select id="company"></select>
                                   </div>
                              <?php } ?>

                              <div class="col-xl-3 col-sm-12">
                                   <button class="btn btn-primary btn-filter" title="Klik disini untuk mencari" type="button"><i class="fa fa-search me-1"></i>Filter</button>
                                   <button class="btn btn-danger light btn-reset" title="Klik disini untuk menghapus filter" type="button">Reset</button>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-12">
          <div class="filter cm-content-box box-primary pt-3">
               <div class="content-title mb-2">
                    <div class="cpa">
                         <i class="fa-sharp fa-solid fa-file-alt me-2"></i>Daftar Arsip Vital
                    </div>
                    <div class="align-middle">
                         <?php if ($this->session->userdata('next-role') == 'operator') { ?>
                              <a href="<?= base_url('v2/backend/alih_media_arsip_vital/berita_acara') ?>" class="btn btn-info btn-sm"><i class="fas fa-file-signature me-1"></i> Berita Acara (BAST)</a>
                              <a href="<?= base_url('v2/backend/alih_media_arsip_vital/add') ?>" class="btn btn-primary btn-sm"><i class="fal fa-plus me-1"></i> Tambah Arsip Vital</a>
                         <?php } ?>
                    </div>
               </div>
               <div class="cm-content-body form excerpt">
                    <div class="card-body">
                         <div class="table-responsive">
                              <table id="archieve-vital-table" class="display" style="min-width: 845px">
                                   <thead>
                                        <tr>
                                             <th class="text-center">No.</th>
                                             <th class="text-center">Klasifikasi</th>
                                             <th class="text-start">Uraian Informasi Arsip / Deskripsi</th>
                                             <th class="text-center">Kurun Waktu</th>
                                             <th class="text-center">Jumlah</th>
                                             <th class="text-center">Waktu</th>
                                             <th class="text-center">Status</th>
                                             <?php if ($employee->user_role == 'admin') { ?>
                                                  <th class="text-center">SKPD</th>
                                             <?php } ?>
                                             <th class="text-center">Aksi</th>
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

<!-- Required vendors -->
<!-- <script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script> -->

<script src="<?= base_url('assets/v3/backend/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/v3/backend/vendor/select2/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/') ?>js/plugins-init/select2-init.js"></script>
<script>
     <?php if ($employee->user_role == 'admin') { ?>
          let company = $('#company').select2({
               width: '100%',
               placeholder: 'Pilih SKPD',
               ajax: {
                    url: "<?= base_url('v2/companies/get_companies_select_json') ?>",
                    dataType: 'json',
                    type: 'post',
                    delay: 250,
                    data: function(params) {
                         return {
                              search: params.term, // search term
                              page: params.page
                         };
                    },
                    processResults: function(data, params) {
                         params.page = params.page || 1;

                         return {
                              results: data.results,
                              pagination: {
                                   more: (params.page * 20) < data.totalRows
                              }
                         };
                    },
                    cache: true
               }
          });
     <?php } ?>

     $('.btn-reset').click(function() {
          if (company) {
               company.val(null).trigger('change');
          }
          $('#search').val(null);
          archieve_table.ajax.reload();
     });

     $('.btn-filter').click(function() {
          archieve_table.ajax.reload();
     })

     var archieve_table = $('#archieve-vital-table').DataTable({
          // responsive: false,
          searching: true,
          processing: true,
          serverSide: true,
          ajax: {
               url: "<?= base_url('v2/backend/archieves/get_archieves_vital_json') ?>",
               type: "post",
               data: {
                    search: function() {
                         return $("#search").val();
                    },
                    company: function() {
                         return $("#company").val();
                    },
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
               searchPlaceholder: 'Cari kode klasifikasi atau indeks arsip...',
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
                    bSortable: !1,
                    data: "deskripsi"
               }, {
                    data: "tahun"
               }, {
                    bSortable: !1,
                    data: "jumlah"
               },
               {
                    data: "tanggal"
               }, {
                    bSortable: !1,
                    data: "status",
               },
               <?php if ($employee->user_role == 'admin') { ?> {
                         bSortable: !1,
                         data: "company",
                    },
               <?php } ?> {
                    data: "action",
                    bSortable: !1,
               }
          ]
     });
     $(".dataTables_paginate").addClass("pagination-rounded");
     $(".dataTables_filter").hide();
</script>
