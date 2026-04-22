<link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.css">
<style>
    .dt-search input {
        min-width: 400px !important;
        background-color: #FFFFFF;
        border-radius: 8px;
        height: 50px;
        color: #1F1E21;
        border: 1px solid #d1d1d1;
        /* Or any specific pixel or percentage value (e.g., 50%) */
    }

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

    .btn-outline-danger {
        border: 1px solid #dc3545 !important;
    }
</style>

<div class="breadcrumb-section bg-img"
     style="background-image: url('<?= base_url("assets/v3/frontend/v2/") ?>img/bg-img/90.jpg');">
     <div class="container">
          <!-- Breadcrumb Content -->
          <div class="breadcrumb-content">
               <div class="divider"></div>
               <h2>Peraturan / Regulasi</h2>
               <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <li>Peraturan / Regulasi</li>
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
                         <span class="sub-title">Regulasi Arsip</span>
                         <p class="mb-0">Daftar regulasi dan kebijakan terkait arsip di lingkungan Pemerintah Daerah
                              Kabupaten Sumedang.</p>
                    </div>
               </div>
          </div>
          <div class="divider-sm"></div>
     </div>

     <div class="container">
          <div class="row">
               <div class="col-12">
                    <div class="table-responsive">
                         <table class="table table-hover table-bordered" id="regulations-table">
                              <thead class="">
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

     <div class="divider-sm"></div>

</section>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.js"></script>
<script>
    let regulations_table = $('#regulations-table').DataTable({
        responsive: false,
        searching: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= base_url('v2/regulations/get_regulations_json') ?>",
            type: "post",
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
            render: function (data, type, row, meta) {
                let number = meta.row + meta.settings._iDisplayStart + 1;
                return "<span class='d-flex justify-content-center'>" + number + "</span>";
            }
        }, {
            data: "title",
        }, {
            data: "document",
            bSortable: !1,
            className: 'align-middle'
        }]
    });
    $(".dataTables_paginate").addClass("radius-md");
    // $(".dataTables_filter").hide();
</script>
