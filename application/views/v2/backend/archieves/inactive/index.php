<style>
     .dataTables_filter input {
          width: 400px !important;
          /* Or any specific pixel or percentage value (e.g., 50%) */
     }
</style>

<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);">Daftar Arsip Inaktif</a></li>
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
     <div class="col-xl-12">
          <div class="card">
               <div class="card-header">
                    <h5 class="card-title text-primary">Daftar Arsip Inaktif</h5>
               </div>
               <div class="card-body">
                    <div class="table-responsive">
                         <table id="inactive-table" class="display" style="width: 100%">
                              <thead>
                                   <tr>
                                        <th style="width: 10%" class="text-center">No.</th>
                                        <th class="text-start">Indeks</th>
                                        <th class="text-center">Kode Klasifikasi</th>
                                        <th class="text-center">Deskripsi</th>
                                        <th class="text-center">Tahun</th>
                                        <th class="text-center">Unit Kerja Pencipta</th>
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

<div class="modal fade archieve-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
     aria-labelledby="archieve-modal">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Pindahkan Kategori Arsip</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
               </div>
               <form action="<?= base_url('v2/archieves/move_archieve') ?>" method="post">
                    <div class="modal-body">
                         <input type="hidden" class="form-control" name="archieve" required readonly>
                         <input type="hidden" class="form-control" name="company" required readonly>

                         <div class="row">
                              <div class="col-xl-6 col-sm-12">
                                   <label class="form-label">Indeks</label>
                                   <p class="fw-bold" id="indeks">-</p>
                              </div>
                              <div class="col-xl-6 col-sm-12">
                                   <label class="form-label">Kode Klasifikasi</label>
                                   <p class="fw-bold" id="klasifikasi">-</p>
                              </div>
                              <div class="col-xl-6 col-sm-12">
                                   <label class="form-label">Tahun</label>
                                   <p class="fw-bold" id="tahun">-</p>
                              </div>
                              <div class="col-xl-6 col-sm-12">
                                   <label class="form-label">Unit Kerja Pencipta</label>
                                   <p class="fw-bold" id="unit_kerja_pencipta">-</p>
                              </div>
                              <div class="col-xl-12 mb-2">
                                   <label class="form-label">Deskripsi</label>
                                   <p class="fw-bold" id="deskripsi">-</p>
                              </div>
                              <div class="col-xl-9 mb-3">
                                   <label class="form-label">Pilih Jenis Arsip <span class="text-danger">*</span></label>
                                   <div class="d-flex justify-content-between">
                                        <!--                                        <div class="form-check d-inline-block">-->
                                        <!--                                             <input class="form-check-input" type="radio" name="jenis_arsip"-->
                                        <!--                                                    id="flexRadioDefault4" value="arsip_statis" required>-->
                                        <!--                                             <label class="form-check-label" for="flexRadioDefault4">-->
                                        <!--                                                  Arsip Statis-->
                                        <!--                                             </label>-->
                                        <!--                                        </div>-->
                                        <div class="form-check d-inline-block mx-2">
                                             <input class="form-check-input" type="radio" name="jenis_arsip"
                                                  id="flexRadioDefault5" value="arsip_vital" required>
                                             <label class="form-check-label" for="flexRadioDefault5">
                                                  Arsip Vital
                                             </label>
                                        </div>
                                        <div class="form-check d-inline-block">
                                             <input class="form-check-input" type="radio" name="jenis_arsip"
                                                  id="flexRadioDefault6" value="arsip_usul_serah" required>
                                             <label class="form-check-label" for="flexRadioDefault6">
                                                  Arsip Usul Serah
                                             </label>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-danger light me-3" data-bs-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                    </div>
               </form>
          </div>
     </div>
</div>

<script src="<?= base_url('assets/v3/backend/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>

<script>
     var inactive_table = $('#inactive-table').DataTable({
          // responsive: false,
          searching: true,
          processing: true,
          serverSide: true,
          ajax: {
               url: "<?= base_url('v2/archieves/get_inactives_json') ?>",
               type: "post",
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
               render: function(data, type, row, meta) {
                    let number = meta.row + meta.settings._iDisplayStart + 1;
                    return "<span class='d-flex justify-content-center'>" + number + "</span>";
               }
          }, {
               data: "indek",
               className: "text-center"
          }, {
               data: "kode_klsf",
               className: "text-center"
          }, {
               data: "deskripsi",
               className: "text-start"
          }, {
               data: "tahun",
               className: "text-center"
          }, {
               data: "unit_kerja_pencipta",
               className: "text-center"
          }, {
               data: "action",
               className: "text-center"
          }, ]
     });
     $(".dataTables_paginate").addClass("pagination-rounded");
     // $(".dataTables_filter").hide();

     inactive_table.on('click', '.btn-detail', function() {
          let archieve = $(this).data('archieve');
          let company = $(this).data('company');

          if (archieve === '' || company === '') {
               Swal.fire({
                    title: "Kesalahan",
                    text: "Maaf, arsip yang anda pilih tidak dapat diproses! Silahkan muat ulang (refresh) halaman ini.",
                    icon: "warning",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
               });
          }

          Swal.fire({
               title: "Mohon tunggu",
               text: "Sedang memuat data...",
               allowOutsideClick: false,
               allowEscapeKey: false,
               didOpen: function() {
                    Swal.showLoading();
               }
          });

          $.post("<?= base_url('v2/archieves/get_archieve_json') ?>", {
               archieve: archieve,
               company: company
          }, function(data, status) {
               if (status == 'success') {
                    let dao = JSON.parse(data);
                    if (dao.status == 200) {
                         $('input[name="archieve"]').val(dao.data.id);
                         $('input[name="company"]').val(dao.data.nomor_skpd);

                         document.querySelector('#indeks').innerHTML = dao.data.indek;
                         document.querySelector('#klasifikasi').innerHTML = dao.data.kode_klsf;
                         document.querySelector('#tahun').innerHTML = dao.data.tahun;
                         document.querySelector('#unit_kerja_pencipta').innerHTML = dao.data.unit_kerja_pencipta;
                         document.querySelector('#deskripsi').innerHTML = (dao.data.deskripsi == "") ? dao.data.deskripsi : '-';
                         Swal.close();
                         $('.archieve-modal').modal('show');
                    } else {
                         Swal.fire({
                              title: "Kesalahan",
                              text: dao.message,
                              icon: "error",
                              allowOutsideClick: false,
                              allowEscapeKey: false,
                         });
                    }
               } else {
                    Swal.fire({
                         title: "Kesalahan",
                         text: "Maaf, terjadi kesalahan saat mengambil data dari server...",
                         icon: "error",
                         allowOutsideClick: false,
                         allowEscapeKey: false,
                    });
               }
          }).fail(function() {
               Swal.fire({
                    title: "Kesalahan",
                    text: "Maaf, terjadi kesalahan saat menghubungkan ke server...",
                    icon: "error",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
               });
          });
     });

     inactive_table.on('click', '.btn-delete', function() {
          let archieve = $(this).data('archieve');
          let company = $(this).data('company');

          if (archieve === '' || company === '') {
               Swal.fire({
                    title: "Kesalahan",
                    text: "Maaf, arsip yang anda pilih tidak dapat diproses! Silahkan muat ulang (refresh) halaman ini.",
                    icon: "warning",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
               });
          }

          Swal.fire({
               title: "Mohon tunggu",
               text: "Sedang memuat data...",
               allowOutsideClick: false,
               allowEscapeKey: false,
               didOpen: function() {
                    Swal.showLoading();
               }
          });

          $.post("<?= base_url('v2/archieves/get_archieve_json') ?>", {
               archieve: archieve,
               company: company
          }, function(data, status) {
               if (status == 'success') {
                    let dao = JSON.parse(data);
                    if (dao.status == 200) {
                         Swal.fire({
                              title: "Hapus Arsip?",
                              text: "Apakah anda akan menghapus arsip tersebut?",
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
                         }).then(function(t) {
                              if (t.isConfirmed) {
                                   Swal.fire({
                                        title: "Mohon tunggu",
                                        text: "Sedang mengirim data...",
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        didOpen: function() {
                                             Swal.showLoading();
                                        }
                                   });

                                   $.post("<?= base_url('v2/alih_media_arsip_vital/inactive_deleted') ?>", {
                                        archieve: dao.data.id,
                                        company: dao.data.nomor_skpd,
                                   }, function(data, status) {
                                        if (status == 'success') {
                                             let dao = JSON.parse(data);
                                             Swal.fire({
                                                  title: (dao.status == 200) ? 'Berhasil' : 'Gagal',
                                                  text: dao.message,
                                                  icon: (dao.status == 200) ? 'success' : 'error',
                                                  allowOutsideClick: false,
                                                  allowEscapeKey: false,
                                             }).then(function() {
                                                  inactive_table.ajax.reload();
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
                                   }).fail(function() {
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
                                        text: "Anda membatalkan penghapusan arsip :)",
                                        icon: "error"
                                   });
                              }
                         });
                    } else {
                         Swal.fire({
                              title: "Kesalahan",
                              text: dao.message,
                              icon: "error",
                              allowOutsideClick: false,
                              allowEscapeKey: false,
                         });
                    }
               } else {
                    Swal.fire({
                         title: "Kesalahan",
                         text: "Maaf, terjadi kesalahan saat mengambil data dari server...",
                         icon: "error",
                         allowOutsideClick: false,
                         allowEscapeKey: false,
                    });
               }
          }).fail(function() {
               Swal.fire({
                    title: "Kesalahan",
                    text: "Maaf, terjadi kesalahan saat menghubungkan ke server...",
                    icon: "error",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
               });
          });
     });
</script>
