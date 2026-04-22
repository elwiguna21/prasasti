<!--<link rel="stylesheet" href="--><?php //= base_url() ?><!--assets/v3/backend/vendor/datatables/css/jquery.dataTables.min.css">-->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.css">
<style>
    .btn-sm {
        min-width: 30px;
    }

    .dt-paging .pagination .page-item .page-link {
        border-radius: 50px !important;
        margin: 0 4px; /* Adds space between rounded buttons */
    }

    /* Optional: Keep the first and last buttons rounded specifically */
    .dt-paging .pagination .page-item:first-child .page-link {
        border-top-left-radius: 50px !important;
        border-bottom-left-radius: 50px !important;
    }

    .dt-paging .pagination .page-item:last-child .page-link {
        border-top-right-radius: 50px !important;
        border-bottom-right-radius: 50px !important;
    }

</style>
<div class="breadcrumb-section bg-img"
     style="background-image: url('<?= base_url("assets/v3/frontend/v2/") ?>img/bg-img/90.jpg');">
     <div class="container">
          <!-- Breadcrumb Content -->
          <div class="breadcrumb-content">
               <div class="divider"></div>
               <h2>Inventaris Arsip</h2>
               <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <li>Inventaris Arsip</li>
               </ul>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>

<section class="service-section">
     <!-- Divider -->
     <div class="divider-sm"></div>

     <div class="container">
          <div class="row justify-content-center">
               <!-- Section Heading -->
               <div class="col-12 col-md-7">
                    <div class="section-heading text-center">
                         <span class="sub-title">Inventaris Arsip</span>
                         <p class="mb-0">Sarana untuk menemukan kembali arsip yang memuat uraian informasi rinci
                              mengenai arsip yang telah diolah.</p>
                    </div>
               </div>
          </div>
          <div class="divider-sm"></div>
     </div>

     <div class="container">
          <div class="row g-4 g-md-5">
               <div class="col-lg-12">
                    <div class="d-flex flex-column gap-5">
                         <div class="blog-widget">
                              <form id="form-filter">
                              <div class="row">
                                   <div class="col-lg-5 col-12 mb-3">
                                        <input type="text" id="search" class="form-control"
                                               placeholder="Cari kode klasifikasi atau indeks arsip" autocomplete="off"
                                               value="">
                                   </div>
                                   <div class="col-lg-5 col-12 mb-3">
                                        <select class="form-control" name="company" id="company">
                                             <option value="">Pilih SKPD</option>
									<?php foreach ($companies as $company) { ?>
                                                  <option value="<?= $company->no_company; ?>" <?= (!empty($_GET['company']) && $_GET['company'] == $company->no_company) ? 'selected' : '' ?>><?= $company->name; ?></option>
									<?php } ?>
                                        </select>
                                   </div>
                                   <div class="col-lg-2 col-12">
                                        <div class="project-navigation-container justify-content-center">
                                             <button type="button" class="btn btn-primary btn-filter px-3">Cari</button>
                                             <button type="reset" class="btn btn-danger btn-reset px-3">Reset
                                             </button>
                                        </div>
                                   </div>
                              </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
           <div class="divider-sm"></div>
     </div>
</section>

<div class="blog-section">
     <div class="container">
          <div class="row">
               <div class="col-md-12">
                    <div class="table-responsive">
                         <table class="table table-hover table-bordered" id="inventory-table">
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
                              <tbody class="align-middle">
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
     <div class="divider-sm"></div>
</div>

<!--<script src="--><?php //= base_url() ?><!--assets/v3/backend/vendor/jquery/jquery.min.js"></script>-->
<!--<script src="--><?php //= base_url() ?><!--assets/v3/backend/vendor/datatables/js/jquery.dataTables.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.js"></script>

<script>
    let inventory_table = $('#inventory-table').DataTable({
        responsive: false,
        searching: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= base_url('v2/archieves/get_inventories_json') ?>",
            type: "post",
            data: {
                search: function () {
                    return $("#search").val();
                },
                company: function () {
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
                // next: '<i class="bi bi-chevron-right"></i>',
                // previous: '<i class="bi bi-chevron-left"></i>'
            }
        },
        columns: [{
            data: "",
            render: function (data, type, row, meta) {
                let number = meta.row + meta.settings._iDisplayStart + 1;
                return "<span class='d-flex justify-content-center'>" + number + "</span>";
            },
            className: 'text-center'
        }, {
            data: "klasifikasi",
            className: 'text-center'
        }, {
            data: "indeks",
            className: 'text-center'
        }, {
            data: "tahun",
            className: 'text-center'
        }, {
            data: "skpd",
            className: 'text-center'
        }, {
            data: "jenis",
            bSortable: !1,
            className: 'text-center'
        }, {
            data: "actions",
            className: 'text-center',
            bSortable: !1,
        }]
    });
    // $(".dataTables_paginate").addClass("rounded");
    $(".dt-search").hide();

    $('.btn-filter').click(function () {
        inventory_table.ajax.reload();
    });

    $('.btn-reset').click(function () {
        $('#search').val(null);
        $('#company').val("").trigger('change');
        $('#form-filter')[0].reset();
        $('#form-filter').find('input:text, select').val('');

        inventory_table.ajax.reload();
    })
</script>
