<!--<link rel="stylesheet" href="https://cdn.datatables.net/select/3.1.3/css/select.dataTables.css">-->
<link href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css" rel="stylesheet"/>
<style>
    .dataTables_filter input {
        width: 400px !important;
        /* Or any specific pixel or percentage value (e.g., 50%) */
    }
</style>

<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('v2/alih_media_arsip_vital/berita_acara') ?>">Daftar Berita
                    Acara</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);">Detail Berita Acara Arsip Vital</a></li>
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
     <div class="col-xl-12 col-lg-12">
          <div class="card">
               <div class="card-header bg-primary">
                    <div class="cpa">
                         <h4 class="card-title text-white">Informasi Berita Acara</h4>
                    </div>
                    <div class="align-middle">
                         <a href="<?= base_url('v2/alih_media_arsip_vital/berita_acara') ?>"
                            class="btn btn-xs btn-info light shadow">
                              <i class="fas fa-arrow-left me-2"></i> Daftar Berita Acara</a>
                    </div>
               </div>
               <div class="card-body">
                    <div class="row mb-4">
                         <div class="col-md-6">
                              <table class="table table-borderless table-sm">
                                   <tr>
                                        <th width="150">Nama BAST</th>
                                        <td width="10">:</td>
                                        <td><strong><?= htmlspecialchars($bast->name) ?></strong></td>
                                   </tr>
                                   <tr>
                                        <th>Waktu Upload</th>
                                        <td>:</td>
                                        <td><?= tgl_indo(date('Y-m-d', strtotime($bast->created_at))) . ' - ' . jam_indo(date('H:i:s', strtotime($bast->created_at))) ?></td>
                                   </tr>
                                   <tr>
                                        <th>File Terlampir</th>
                                        <td>:</td>
                                        <td>
									<?php if (!empty($bast->document) and file_exists('./assets/upload/berita_acara/' . $bast->document)): ?>
                                                  <a href="<?= base_url('assets/upload/berita_acara/' . $bast->document) ?>"
                                                     target="_blank" class="btn btn-sm btn-info light">
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

     <div class="col-xl-12">
          <div class="card">
               <div class="card-header">
                    <h4 class="card-title">Daftar Dokumen Arsip Vital</h4>
                    <button type="button" class="btn btn-primary btn-sm btn-document-modal">
                         <i class="fas fa-link me-1"></i> Tautkan Dokumen Arsip Vital
                    </button>
               </div>
               <div class="card-body">
                    <div class="table-responsive">
                         <table id="tableLinkedDokumen" class="display" style="min-width: 840px">
                              <thead>
                              <tr>
                                   <th style="width: 10%;" class="text-center">No</th>
                                   <th style="width: 40%;">Uraian Informasi / Nama Berkas</th>
                                   <th style="width: 20%;" class="text-center">Unit Pencipta</th>
                                   <th style="width: 15%;" class="text-center">Kode Klasifikasi</th>
                                   <th style="width: 15%;" class="text-center">Aksi</th>
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

<div class="modal fade" id="modalPilihDokumen" tabindex="-1" aria-labelledby="modalPilihDokumenLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="modalPilihDokumenLabel">Tautkan Dokumen Arsip Vital yang Telah
                         di-TTE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form id="form-linked-dokumen"
                     action="<?= base_url('v2/alih_media_arsip_vital/berita_acara_detail_save') ?>" method="post">
                    <div class="modal-body">
                         <input type="hidden" class="form-control" name="bast" value="<?= $_GET['bast']; ?>"
                                required readonly>
                         <!--                         <input type="text" class="form-control" name="archieve" required readonly>-->
                         <input type="hidden" name="archieves" id="ids_terpilih" required readonly>

                         <div class="col-xl-12 mb-3">
                              <span class="badge badge-info ml-2">
                                 Terpilih: <span id="counter-terpilih">0</span> baris
                             </span>
                         </div>
                         <div class="table-responsive">
                              <table id="archieves-table" class="display" style="width: 100%">
                                   <thead>
                                   <tr>
                                        <!--                                        <th width="4%" class="text-center"><input type="checkbox" id="select-all"></th>-->
                                        <th style="width: 5%">#</th>
                                        <th width="1%"></th>
                                        <th class="text-center">Kode Klasifikasi</th>
                                        <th class="text-start">Uraian Informasi Arsip</th>
                                        <th class="text-center">Unit Pencipta</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   </tbody>
                              </table>
                         </div>

                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                         <button type="submit" class="btn btn-primary">Simpan Tautan</button>
                    </div>
               </form>
          </div>
     </div>
</div>

<script src="<?= base_url('assets/v3/backend/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>

<script>
    var selectedIds = [];

    let archieves_linked = $('#tableLinkedDokumen').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= base_url('v2/alih_media_arsip_vital/get_bast_linked_json') ?>",
            data: {
                bast: function () {
                    return '<?= $_GET["bast"]; ?>';
                },
            },
            type: "post"
        },
        order: [
            [0, "desc"]
        ],
        language: {
            processing: '<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> Mohon tunggu ...',
            infoEmpty: '<strong>Tidak ada data</strong>',
            zeroRecords: '<div class="alert alert-danger content-center" role="alert"><div class="alert-content"><p>Maaf, data tidak ditemukan...</p></div></div>',
            searchPlaceholder: 'Cari uraian informasi arsip / unit kerja pencipta / kode klasifikasi...',
            sSearch: '',
            lengthMenu: "Tampilkan _MENU_ data",
            paginate: {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
            }
        },
        columns: [{
            data: "",
            className: "text-center",
            render: function (data, type, row, meta) {
                let number = meta.row + meta.settings._iDisplayStart + 1;
                return "<span class='d-flex justify-content-center'>" + number + "</span>";
            }
        }, {
            data: "uraian_informasi_arsip",
            className: "text-start",
        }, {
            data: "unit_kerja_pencipta",
            className: "text-center",
        }, {
            data: "klasifikasi",
            className: "text-center",
        }, {
            data: "action",
            bSortable: !1,
        }
        ]
    });

    let archieves = $('#archieves-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        // select: true,
        select: {
            'style': 'multiple',
            'selector': 'td:first-child',
            'info': false
        },
        ajax: {
            url: "<?= base_url('v2/alih_media_arsip_vital/get_archieve_not_exists_bast') ?>",
            type: "post",
            data: {
                bast: function () {
                    return '<?= $_GET["bast"]; ?>';
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
            searchPlaceholder: 'Cari uraian informasi arsip / unit kerja pencipta / kode klasifikasi...',
            sSearch: '',
            lengthMenu: "Tampilkan _MENU_ data",
            paginate: {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
            },
            select: {
                rows: "%d baris terpilih" // %d is a placeholder for the number
            }
        },
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    var id = row.id;
                    var checked = selectedIds.includes(id) ? 'checked' : '';
                    return '<input type="checkbox" class="row-checkbox" value="' + id + '" ' + checked + '>';
                }
            },
            {
                data: "id",
                targets: 1,
                visible: false,
                searchable: false,
                orderable: false
            },
            {
                data: "klasifikasi",
                className: "text-center"
            },
            {
                data: "uraian_informasi_arsip",
            }, {
                data: "unit_kerja_pencipta",
                className: "text-center"
            }
        ],
        drawCallback: function (settings) {
            // 2. Setiap kali pindah page, sinkronkan ulang checkbox
            $('.row-checkbox').each(function () {
                if (selectedIds.includes($(this).val())) {
                    $(this).prop('checked', true);
                }
            });
        }
    });

    $('#archieves-table tbody').on('change', '.row-checkbox', function () {
        var id = $(this).val();

        if (this.checked) {
            // Tambahkan jika belum ada (mencegah duplikasi)
            if (!selectedIds.includes(id)) {
                selectedIds.push(id);
            }
        } else {
            // Hapus dari array jika di-uncheck
            selectedIds = selectedIds.filter(function (item) {
                return item !== id;
            });
        }

        renderSelectedCount();
    });

    function renderSelectedCount() {
        var total = selectedIds.length;
        $('#counter-terpilih').text(total);
    }

    let modal_archieve = document.querySelector('#modalPilihDokumen');
    modal_archieve.addEventListener('hide.bs.modal', function () {
        selectedIds = [];
        $('input[name="archive"]').val(null);
        renderSelectedCount();
    });

    $('#form-linked-dokumen').on('submit', function (e) {
        // 1. Cek apakah array selectedIds kosong
        if (selectedIds.length === 0) {
            e.preventDefault(); // Batalkan proses submit

            // Tampilkan peringatan (bisa menggunakan SweetAlert atau alert biasa)
            Swal.fire({
                title: "Kesalahan",
                text: "Mohon pilih minimal satu arsip yang akan di kaitkan pada berita acara!",
                icon: "error",
                allowOutsideClick: false,
                allowEscapeKey: false,
            });
            return false;
        }

        // 2. Jika tidak kosong, konversi array menjadi string (dipisahkan koma)
        // Lalu masukkan ke dalam hidden input
        // $('input[name="archieve"]').val(selectedIds.join(','));
        $('#ids_terpilih').val(selectedIds.join(','));

        // Lanjutkan submit...
        console.log($('#ids_terpilih').val());
        Swal.fire({
            title: "Mohon tunggu",
            text: "Sedang mengirim data...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: function () {
                Swal.showLoading();
            }
        });
        return true;
    });

    $('.btn-document-modal').click(function () {
        Swal.fire({
            title: "Mohon tunggu",
            text: "Sedang memuat data...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: function () {
                Swal.showLoading();
            }
        });

        // archieves.ajax.reload();
        $('#modalPilihDokumen').modal('show');
        Swal.close();
    });

    archieves_linked.on('click', '.btn-unlinked', function () {
        let bast = $(this).data('bast');
        let bast_detail = $(this).data('bast-detail');
        let archieve = $(this).data('archieve');

        Swal.fire({
            title: "Lepas Tautan Arsip",
            text: "Apakah anda akan melepas tautan arsip dari berita acara tersebut?",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Lepas Tautan!",
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
                    title: "Mohon tunggu...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: function () {
                        Swal.showLoading();
                    }
                });

                $.post("<?= base_url('v2/alih_media_arsip_vital/berita_acara_detail_unlink') ?>", {
                    bast: bast,
                    bast_detail: bast_detail,
                    archieve: archieve
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
                            // window.location.reload();
                            archieves_linked.ajax.reload();
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
                    text: "Anda membatalkan pelepasan tautan arsip dari berita acara :)",
                    icon: "error"
                });
            }
        });
    });
</script>