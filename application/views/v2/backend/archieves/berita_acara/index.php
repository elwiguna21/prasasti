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
          <li class="breadcrumb-item"><a href="<?= base_url('v2/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);">Daftar Berita Acara Arsip Vital</a></li>
     </ol>
</div>

<?php if (!empty($this->session->flashdata('status'))) {
	$status = $this->session->flashdata('status');
	?>
     <div class="col-xl-12">
          <div class="alert alert-<?= ($status == 200) ? 'success' : 'danger'; ?> left-icon-big alert-dismissible fade show">
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i
                                 class="mdi mdi-btn-close"></i></span>
               </button>
               <div class="media">
                    <div class="alert-left-icon-big">
                         <span><i class="mdi mdi-<?= ($status == 200) ? 'check-circle-outline' : 'alert'; ?>"></i></span>
                    </div>
                    <div class="media-body">
                         <h5 class="mt-1 mb-2"><?= ($status == 200) ? 'Berhasil' : 'Gagal' ?>!</h5>
                         <p class="mb-0"><?= $this->session->flashdata('message'); ?></p>
                    </div>
               </div>
          </div>
     </div>
<?php } ?>

<div class="row">
     <div class="col-xxl-3 col-lg-3 col-sm-6">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-primary text-primary">
                              <i class="ti-archive"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Arsip Vital</p>
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
                              <i class="ti-archive"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Berita Acara</p>
                              <h4 class="mb-0"><?= number_format($total_bast, 0, ',', '.'); ?></h4>
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
                              <i class="fas fa-link"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Tertaut Berita Acara</p>
                              <h4 class="mb-0"><?= number_format($total_archieve_linked, 0, ',', '.'); ?></h4>
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
                              <i class="fas fa-unlink"></i>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Belum Tertaut Berita Acara</p>
                              <h4 class="mb-0"><?= number_format($total_archieve_unlinked, 0, ',', '.'); ?></h4>
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
               </div>
               <div class="cm-content-body form excerpt">
                    <div class="card-body">
                         <div class="row">
                              <div class="<?= ($employee->user_role == 'admin') ? 'col-xl-5' : 'col-xl-9' ?> col-sm-12">
                                   <input type="text" class="form-control mb-xl-0 mb-3" id="search"
                                          placeholder="Cari nama atau nomor berita acara..." autocomplete="off">
                              </div>
						<?php if ($employee->user_role == 'admin') { ?>
                                   <div class="col-xl-4 col-sm-12">
                                        <select id="company"></select>
                                   </div>
						<?php } ?>

                              <div class="col-xl-3 col-sm-12">
                                   <button class="btn btn-primary btn-filter" title="Klik disini untuk mencari"
                                           type="button"><i class="fa fa-search me-1"></i>Filter
                                   </button>
                                   <button class="btn btn-danger light btn-reset"
                                           title="Klik disini untuk menghapus filter" type="button">Reset
                                   </button>
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
                         <i class="fa-sharp fa-solid fa-file-alt me-2"></i>Daftar Berita Acara Arsip Vital
                    </div>
				<?php if ($employee->user_role == 'verifikator_skpd') { ?>
                         <div class="align-middle">
                              <a href="<?= base_url('v2/alih_media_arsip_vital/berita_acara_add') ?>"
                                 class="btn btn-primary btn-sm"><i
                                           class="fal fa-plus me-1"></i> Tambah Berita Acara</a>
                         </div>
				<?php } ?>
               </div>
               <div class="cm-content-body form excerpt">
                    <div class="card-body">
                         <div class="table-responsive">
                              <table id="bast-table" class="display" style="min-width: 845px">
                                   <thead>
                                   <tr>
                                        <th style="width: 10%" class="text-center">No.</th>
                                        <th class="text-start">Nama / Nomor BAST</th>
                                        <th class="text-center">Waktu Upload</th>
                                        <th class="text-center">Arsip Tertaut</th>
								<?php if ($employee->user_role == 'admin') { ?>
                                                <th class="text-center">Pembuat</th>
                                             <th class="text-center">SKPD</th>
								<?php } ?>
                                        <th style="width: 5%;" class="text-center">Aksi</th>
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
<script src="<?= base_url('assets/v3/backend/vendor/select2/js/select2.full.min.js') ?>"></script>

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
             data: function (params) {
                 return {
                     search: params.term, // search term
                     page: params.page
                 };
             },
             processResults: function (data, params) {
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

     $('.btn-reset').click(function () {
		<?php if ($employee->user_role == 'admin') { ?>
         company.val(null).trigger('change');
		<?php } ?>
         $('#search').val(null);
         bast_table.ajax.reload();
     });

     $('.btn-filter').click(function () {
         bast_table.ajax.reload();
     });

     var bast_table = $('#bast-table').DataTable({
         // responsive: false,
         searching: true,
         processing: true,
         serverSide: true,
         ajax: {
             url: "<?= base_url('v2/alih_media_arsip_vital/get_bast_json') ?>",
             type: "post",
             data: {
                 search: function () {
                     return $("#search").val();
                 },
                 company: function () {
                     return $("#company").val();
                 },
             }
         },
         order: [
             [0, "desc"]
         ],
         language: {
             processing: '<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> Mohon tunggu ...',
             infoEmpty: '<strong>Tidak ada data</strong>',
             zeroRecords: '<div class="alert alert-danger content-center" role="alert"><div class="alert-content"><p>Maaf, data tidak ditemukan...</p></div></div>',
             searchPlaceholder: 'Cari kode klasifikasi atau indeks arsip...',
             sSearch: '',
             lengthMenu: "Tampilkan _MENU_ data",
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
             data: "name",
         }, {
             data: "created_at",
             className: "text-center"
         }, {
                 data: "total_archieve",
                 className: "text-center"
             },
		    <?php if ($employee->user_role == 'admin') { ?>
             {
                 bSortable: !1,
                 data: "creator",
             },
             {
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

     bast_table.on('click', '.btn-delete', function () {
         let bast = $(this).data('bast');
         let company = $(this).data('company');

         Swal.fire({
             title: "Hapus Berita Acara",
             text: "Apakah anda akan menghapus berita acara tersebut?",
             icon: "warning",
             showCancelButton: !0,
             confirmButtonText: "Ya, Hapus!",
             cancelButtonText: "Batal",
             allowOutsideClick: false,
             allowEscapeKey: false,
             customClass: {
                 confirmButton: "btn btn-danger mt-2",
                 cancelButton: "btn light btn-warning ms-3 mt-2"
             },
             buttonsStyling: !1
         }).then(function (t) {
             if (t.isConfirmed) {
                 Swal.fire({
                     title: "Mohon tunggu",
                     text: "Sedang mengirim data...",
                     allowOutsideClick: false,
                     allowEscapeKey: false,
                     didOpen: function () {
                         Swal.showLoading();
                     }
                 });

                 $.post("<?= base_url('v2/alih_media_arsip_vital/berita_acara_deleted') ?>", {
                     bast: bast,
                     company: company,
                 }, function (data, status) {
                     if (status == 'success') {
                         let dao = JSON.parse(data);
                         Swal.fire({
                             title: (dao.status == 200) ? 'Berhasil' : 'Gagal',
                             text: dao.message,
                             icon: (dao.status == 200) ? 'success' : 'error',
                             allowOutsideClick: false,
                             allowEscapeKey: false,
                         }).then(function () {
                             // bast_table.ajax.reload();
                             window.location.reload();
                         });
                     } else {
                         Swal.fire({
                             title: "Kesalahan",
                             text: "Terjadi kesalahan saat mengirim data ke server...",
                             icon: "error",
                             allowOutsideClick: false,
                             allowEscapeKey: false,
                         });
                     }
                 }).fail(function () {
                     Swal.fire({
                         title: "Kesalahan",
                         text: "Terjadi kesalahan saat menghubungkan ke server...",
                         icon: "error",
                         allowOutsideClick: false,
                         allowEscapeKey: false,
                     });
                 })

             } else if (t.dismiss === Swal.DismissReason.cancel) {
                 Swal.fire({
                     title: "Batal",
                     text: "Anda membatalkan penghapusan berita acara :)",
                     icon: "error"
                 });
             }
         });

     });
</script>