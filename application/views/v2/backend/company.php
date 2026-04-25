<link href="<?= base_url('assets/v3/backend/') ?>vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/styles/index.min.css') ?>" />
<style>
     .dataTables_filter input {
          width: 300px !important;
          /* Or any specific pixel or percentage value (e.g., 50%) */
     }
</style>

<div class="row">
     <div class="col-xl-12">
          <div class="page-titles">
               <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('v2/dashboards') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar SKPD</a></li>
               </ol>
          </div>

          <?php if (!empty($this->session->flashdata('status'))) {
               $status = $this->session->flashdata('status');
          ?>
               <div class="alert alert-<?= ($status == 200) ? 'success' : 'danger'; ?> left-icon-big alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
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
          <?php } ?>
          <div class="filter cm-content-box box-primary">
               <div class="content-title">
                    <div class="cpa">
                         <i class="fa-solid fa-users me-2"></i>Daftar SKPD
                    </div>
                    <div class="align-middle">
                         <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-add shadow my-2">
                              <i class="fa fa-plus me-2"></i>Tambah SKPD</a>
                    </div>
               </div>
               <div class="cm-content-body form excerpt">
                    <div class="card-body">
                         <div class="table-responsive">
                              <table id="company-table" class="display" style="min-width: 845px">
                                   <thead>
                                        <tr>
                                             <th>No.</th>
                                             <th>Nama SKPD</th>
                                             <th>Alamat</th>
                                             <th>Telepon</th>
                                             <th>Email</th>
                                             <th>Aksi</th>
                                        </tr>
                                   </thead>
                                   <tbody></tbody>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="modal fade add-company-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="add-company-modal">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah SKPD Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
               </div>
               <form action="<?= base_url('v2/companies/save') ?>" id="add-form" method="post">
                    <div class="modal-body">
                         <div class="row">
                              <input type="hidden" class="form-control" name="company" readonly>
                              <input type="hidden" class="form-control" name="no_company" readonly>
                              <div class="mb-3 col-md-12">
                                   <label class="form-label">Nama SKPD <span class="text-danger">*</span></label>
                                   <textarea name="name" class="form-control" placeholder="Masukan nama SKPD" required></textarea>
                              </div>
                              <div class="mb-3 col-md-12">
                                   <label class="form-label">Email <span class="text-danger">*</span></label>
                                   <input type="email" name="email" class="form-control" placeholder="Email" required autocomplete="off">
                              </div>
                              <div class="mb-3 col-md-12">
                                   <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                   <input type="text" name="phone" class="form-control" placeholder="No. Handphone" required autocomplete="off">
                              </div>
                              <div class="col-md-12">
                                   <label>Alamat <span class="text-danger">*</span></label>
                                   <textarea name="address" class="form-control" placeholder="Masukan alamat SKPD" required></textarea>
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

<!-- REQUIRED VENDORS! -->
<!-- <script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script> -->

<script src="<?= base_url('assets/v3/backend/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/bundle/popular.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/plugin-bootstrap5/index.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/plugin-auto-focus/index.js') ?>"></script>
<script>
     var edit_modal = false;

     let companies_table = $('#company-table').DataTable({
          responsive: false,
          searching: true,
          processing: true,
          serverSide: true,
          ajax: {
               url: "<?= base_url('v2/companies/get_companies_json') ?>",
               type: "post",
          },
          order: [
               [1, "asc"]
          ],
          language: {
               processing: '<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> Mohon tunggu ...',
               infoEmpty: '<strong>Tidak ada data</strong>',
               zeroRecords: '<div class="alert alert-danger content-center" role="alert"><div class="alert-content"><p>Maaf, data tidak ditemukan...</p></div></div>',
               searchPlaceholder: 'Cari nama SKPD...',
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
               data: "name",
          }, {
               bSortable: !1,
               data: "address"
          }, {
               bSortable: !1,
               data: "phone"
          }, {
               data: "email"
          }, {
               data: "action",
               bSortable: !1,
          }]
     });
     $(".dataTables_paginate").addClass("pagination-rounded");
     // $(".dataTables_filter").hide();

     companies_table.on('click', '.btn-edit', function() {
          Swal.fire({
               title: "Mohon tunggu",
               allowOutsideClick: false,
               allowEscapeKey: false,
               didOpen: function() {
                    Swal.showLoading();
               }
          });

          $.post("<?= base_url('v2/companies/get_company_json') ?>", {
               company: $(this).data('company'),
               no_company: $(this).data('no-company')
          }, function(data, status) {
               if (status == 'success') {
                    let dao = JSON.parse(data);

                    Swal.close();
                    if (dao.status == 200) {
                         edit_modal = true;
                         $('input[name="company"]').val(dao.data.id);
                         $('input[name="no_company"]').val(dao.data.no_company);
                         $('textarea[name="name"]').val(dao.data.name);
                         $('textarea[name="address"]').val(dao.data.address);
                         $('input[name="phone"]').val(dao.data.phone);
                         $('input[name="email"]').val(dao.data.email);

                         document.querySelector('#modal-title').innerHTML = 'Ubah SKPD';
                         $('.add-company-modal').modal('show');
                    } else {
                         Swal.fire({
                              title: 'Kesalahan',
                              text: dao.message,
                              icon: 'error'
                         });
                    }
               } else {
                    Swal.fire({
                         title: 'Kesalahan',
                         text: 'Terjadi kesalahan saat menghubungkan ke server...',
                         icon: 'error'
                    });
               }
          });
     });

     $('.btn-add').click(function() {
          Swal.fire({
               title: "Mohon tunggu",
               allowOutsideClick: false,
               allowEscapeKey: false,
               didOpen: function() {
                    Swal.showLoading();
               }
          });

          setTimeout(() => {
               Swal.close();
               $('.add-company-modal').modal('show');
          }, 500);
     });

     let add_company_modal = document.querySelector('.add-company-modal');
     add_company_modal.addEventListener('hide.bs.modal', function(e) {
          $('input[name="company"]').val(null);
          $('input[name="no_company"]').val(null);
          $('textarea[name="name"]').val(null);
          $('input[name="email"]').val(null);
          $('input[name="phone"]').val(null);
          $('textarea[name="address"]').val(null);
          $('#add-form')[0].reset();
          addFv.resetField('name', true);
          addFv.resetField('email', true);
          addFv.resetField('phone', true);
          addFv.resetField('address', true);
          document.querySelector('#modal-title').innerHTML = 'Tambah SKPD Baru';

          edit_modal = false;
          $('input[name="company"]').prop('required', false);
          $('input[name="no_company"]').prop('required', false);
     });

     add_company_modal.addEventListener('show.bs.modal', function(e) {
          if (edit_modal) {
               $('input[name="company"]').prop('required', true);
               $('input[name="no_company"]').prop('required', true);
          }
     });

     const formAdd = document.getElementById('add-form');
     const addFv = FormValidation.formValidation(formAdd, {
          fields: {
               name: {
                    validators: {
                         notEmpty: {
                              message: 'Nama SKPD harus diisi dan tidak boleh kosong!'
                         },
                         stringLength: {
                              min: 5,
                              max: 200,
                              message: 'Nama SKPD harus lebih dari 5 karakter dan kurang dari 200 karakter',
                         },
                         regexp: {
                              regexp: /^[a-zA-Z., ]+$/,
                              message: 'Karakter yang anda masukan tidak diperbolehkan!'
                         },
                    }
               },
               phone: {
                    validators: {
                         notEmpty: {
                              message: 'No. telepon harus diisi dan tidak boleh kosong!'
                         },
                         stringLength: {
                              min: 5,
                              max: 20,
                              message: 'No. telepon harus lebih dari 5 karakter dan kurang dari 20 karakter.',
                         },
                         regexp: {
                              regexp: /^[0-9+() ]+$/,
                              message: 'Karakter yang anda masukan tidak diperbolehkan!'
                         },
                    }
               },
               email: {
                    validators: {
                         notEmpty: {
                              message: 'Email tidak boleh kosong dan harus diisi!'
                         },
                         emailAddress: {
                              message: 'Mohon masukan alamat email yang benar',
                         },
                         stringLength: {
                              min: 5,
                              max: 40,
                              message: 'Email harus lebih dari 5 karakter dan kurang dari 40 karakter',
                         },
                         // remote: {
                         //      method: 'POST',
                         //      url: '<?= base_url("v2/users/find_exists_user_json") ?>',
                         //      delay: 2000,
                         //      data: function() {
                         //           return {
                         //                email: formAdd.querySelector('input[name="email"]').value,
                         //                user: formAdd.querySelector('#user').value
                         //           }
                         //      }
                         // },
                    }
               },
               address: {
                    validators: {
                         notEmpty: {
                              message: 'Alamat harus diisi dan tidak boleh kosong!'
                         },
                         stringLength: {
                              min: 5,
                              max: 150,
                              message: 'Panjang minimal 6 karakter dan maksimal 150 karakter'
                         },
                         regexp: {
                              regexp: /^[a-zA-Z0-9,. ]+$/,
                              message: 'Karakter yang anda masukan tidak diperbolehkan!'
                         },
                    }
               },
          },
          plugins: {
               trigger: new FormValidation.plugins.Trigger(),
               bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: '',
                    rowSelector: '.col-md-12'
               }),
               submitButton: new FormValidation.plugins.SubmitButton(),
               defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
               autoFocus: new FormValidation.plugins.AutoFocus()
          },
          init: instance => {
               instance.on('plugins.message.placed', function(e) {
                    if (e.element.parentElement.classList.contains('input-group')) {
                         e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                    }

                    if (e.element.parentElement.parentElement.classList.contains('custom-option')) {
                         e.element.closest('.row').insertAdjacentElement('afterend', e.messageElement);
                    }
               });
          }
     });

     companies_table.on('click', '.btn-delete', function() {
          Swal.fire({
               title: "Mohon tunggu",
               allowOutsideClick: false,
               allowEscapeKey: false,
               didOpen: function() {
                    Swal.showLoading();
               }
          });

          $.post("<?= base_url('v2/companies/get_company_json') ?>", {
                    company: $(this).data('company'),
                    no_company: $(this).data('no-company')
               }, function(data, status) {
                    if (status == 'success') {
                         let dao = JSON.parse(data);
                         if (dao.status == 200 && dao.data != null) {
                              Swal.fire({
                                   title: "Hapus SKPD",
                                   text: "Apakah anda akan menghapus SKPD: " + dao.data.name + "?",
                                   icon: "warning",
                                   showCancelButton: !0,
                                   confirmButtonText: "Ya, Hapus!",
                                   cancelButtonText: "Batal",
                                   allowOutsideClick: false,
                                   allowEscapeKey: false,
                                   customClass: {
                                        confirmButton: "btn btn-danger mt-2",
                                        cancelButton: "btn btn-warning ms-3 mt-2"
                                   },
                                   buttonsStyling: !1
                              }).then(function(t) {
                                   if (t.isConfirmed) {
                                        Swal.fire({
                                             title: "Mohon tunggu...",
                                             allowOutsideClick: false,
                                             allowEscapeKey: false,
                                             didOpen: function() {
                                                  Swal.showLoading();
                                             }
                                        });

                                        $.post("<?= base_url('v2/companies/deleted') ?>", {
                                             company: dao.data.id,
                                             no_company: dao.data.no_company,
                                        }, function(data, status) {
                                             if (status == 'success') {
                                                  let resp_delete = JSON.parse(data);
                                                  Swal.fire({
                                                       title: (resp_delete.status == 200) ? 'Berhasil' : 'Gagal',
                                                       text: resp_delete.message,
                                                       icon: (resp_delete.status == 200) ? 'success' : 'error'
                                                  }).then(function() {
                                                       companies_table.ajax.reload();
                                                  });

                                             } else {
                                                  Swal.fire('Kesalahan', 'Terjadi kesalahan saat mengirimkan data ke server untuk penghapusan SKPD!', 'error');
                                             }
                                        }).fail(function() {
                                             Swal.fire('Kesalahan', 'Terjadi kesalahan saat menghubungkan ke server untuk penghapusan SKPD!', 'error');
                                        })
                                   } else if (t.dismiss === Swal.DismissReason.cancel) {
                                        Swal.fire({
                                             title: "Batal",
                                             text: "Anda membatalkan penghapusan SKPD :)",
                                             icon: "error"
                                        });
                                   }
                              })

                         } else {
                              Swal.fire('Kesalahan', dao.message, 'error');
                         }
                    } else {
                         Swal.fire('Kesalahan', 'Terjadi kesalahan saat memuat data...', 'error');
                    }
               })
               .fail(function() {
                    Swal.fire('Kesalahan', 'Terjadi kesalahan saat menghubungkan ke server...', 'error');
               });
     });
</script>
