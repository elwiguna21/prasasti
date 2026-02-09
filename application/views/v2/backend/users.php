<link href="<?= base_url('assets/v3/backend/') ?>vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/styles/index.min.css') ?>" />

<div class="row">
     <div class="col-xl-12">
          <div class="page-titles">
               <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Pengguna</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar</a></li>
               </ol>
          </div>
          <div class="filter cm-content-box box-primary">
               <div class="content-title">
                    <div class="cpa">
                         <i class="fa-solid fa-filter me-2"></i>Filter
                    </div>
                    <div class="tools">
                         <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                    </div>
               </div>
               <div class="cm-content-body form excerpt">
                    <div class="card-body">
                         <div class="row">
                              <div class="col-xl-3 col-sm-6">
                                   <input type="text" class="form-control mb-3 mb-xl-0" id="search" placeholder="Cari username" autocomplete="off">
                              </div>
                              <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                                   <select id="role">
                                        <option value="">SEMUA</option>
                                        <option value="admin">ADMIN</option>
                                        <option value="verifikator_skpd">VERIFIKATOR SKPD</option>
                                        <option value="verifikator_lkd">VERIFIKATOR LKD</option>
                                        <option value="kepala_skpd">KEPALA SKPD</option>
                                        <option value="kepala_lkd">KEPALA LKD</option>
                                        <option value="operator">OPERATOR</option>
                                   </select>
                              </div>
                              <div class="col-xl-3 col-sm-6">
                                   <select id="skpd"></select>
                              </div>
                              <div class="col-xl-3 col-sm-6">
                                   <button class="btn btn-primary btn-filter" title="Tekan untuk mencari" type="button"><i class="fa fa-search me-1"></i>Filter</button>
                                   <button class="btn btn-danger light btn-reset" title="Tekan untuk hapus filter" type="button"><i class="fa fa-refresh me-1"></i>Reset</button>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="mb-3">
               <ul class="d-flex align-items-center flex-wrap">
                    <li><a href="javascript:void(0);" class="btn btn-primary btn-add">Tambah Pengguna</a></li>
                    <!-- <li><a href="blog-category.html" class="btn btn-primary mx-1">Blog Category</a></li> -->
               </ul>
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
                         <i class="fa-solid fa-users me-2"></i>Daftar Pengguna
                    </div>
                    <div class="tools">
                         <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                    </div>
               </div>
               <div class="cm-content-body form excerpt">
                    <div class="card-body">
                         <div class="table-responsive">
                              <table id="users-table" class="display" style="min-width: 845px">
                                   <thead>
                                        <tr>
                                             <th>No.</th>
                                             <th>Username</th>
                                             <th>Nama Lengkap</th>
                                             <th>No. HP</th>
                                             <th>SKPD</th>
                                             <th>Hak Akses</th>
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

<div class="modal fade add-user-modal" id="add-user-modal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah Pengguna Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
               </div>
               <form action="<?= base_url('v2/backend/users/save') ?>" id="add-form" method="post">
                    <div class="modal-body">
                         <div class="row">
                              <input type="hidden" class="form-control" name="user" id="user" readonly>
                              <div class="mb-3 col-md-12">
                                   <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                   <input type="text" name="fullname" class="form-control" placeholder="Nama lengkap pengguna" required autocomplete="off">
                              </div>
                              <div class="mb-3 col-md-6">
                                   <label class="form-label">Email <span class="text-danger">*</span></label>
                                   <input type="email" name="email" class="form-control" placeholder="Email" required autocomplete="off">
                              </div>
                              <div class="mb-3 col-md-6">
                                   <label class="form-label">No. HP <span class="text-danger">*</span></label>
                                   <input type="text" name="phone" class="form-control" placeholder="No. Handphone" required autocomplete="off">
                              </div>
                              <div class="mb-5 col-md-12">
                                   <label>SKPD <span class="text-danger">*</span></label>
                                   <select name="skpd" id="add_skpd" class="form-control" required></select>
                              </div>
                         </div>
                         <div class="row">
                              <h4 class="card-title">Pengaturan Akun </h4>
                              <p class="card-title-desc">Mohon atur Username, Password & Hak akses untuk pengguna baru.</p>
                              <div class="mb-3 col-md-12">
                                   <label>Username <span class="text-danger">*</span></label>
                                   <input type="text" name="username" class="form-control" placeholder="Username pengguna" required autocomplete="off">
                              </div>
                              <div class="mb-1 col-md-6">
                                   <label class="form-label">Password <span class="text-danger">*</span></label>
                                   <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="password" id="pwd" placeholder="Password" required autocomplete="off">
                                        <a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light" id="password-addon" onclick="createpassword('pwd', this)"><i class="mdi mdi-eye-outline"></i></a>
                                   </div>
                                   <div class="progress animated-progess mt-1">
                                        <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                   </div>
                              </div>
                              <div class="mb-1 col-md-6">
                                   <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                   <input type="password" class="form-control" name="conf_password" placeholder="Konfirmasi Password" required autocomplete="off">
                              </div>
                              <small class="text-danger mb-3" id="note-pwd">*) Kosongkan <strong>Password & Konfirmasi Password</strong> apabila tidak akan diubah!</small>
                              <div class="mb-3 col-md-12">
                                   <label>Hak Akses <span class="text-danger">*</span></label>
                                   <select name="role" id="add_role" class="form-control-sm" required>
                                        <option value="">Pilih Hak Akses</option>
                                        <option value="admin">ADMIN</option>
                                        <option value="verifikator_skpd">VERIFIKATOR SKPD</option>
                                        <option value="verifikator_lkd">VERIFIKATOR LKD</option>
                                        <option value="kepala_skpd">KEPALA SKPD</option>
                                        <option value="kepala_lkd">KEPALA LKD</option>
                                        <option value="operator">OPERATOR</option>
                                   </select>
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
<script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script>

<script src="<?= base_url('assets/v3/backend/') ?>vendor/select2/js/select2.full.min.js"></script>
<script src="<?= base_url('assets/v3/backend/') ?>js/plugins-init/select2-init.js"></script>
<script src="<?= base_url('assets/v3/backend/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/v3/backend/') ?>vendor/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/bundle/popular.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/plugin-bootstrap5/index.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/plugin-auto-focus/index.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/plugin-password-strength/index.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/zxcvbn.js') ?>"></script>
<script>
     var edit_modal = false;
     $('#role').select2({
          width: "100%",
     });

     $('#add_role').select2({
          width: "100%",
          dropdownParent: $('#add-user-modal .modal-content'),
     });

     $('#skpd').select2({
          width: "100%",
          ajax: {
               url: "<?= base_url('v2/backend/users/get_skpd_json') ?>",
               dataType: 'json',
               delay: 250,
               type: 'post',
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
          },
          placeholder: 'Cari SKPD',
          templateResult: function(data) {
               // Check if the data object represents a loading or searching message
               if (data.loading) {
                    return $('<span>Mohon tunggu...</span>'); // Customize loading message
               }
               if (data.text === 'Searching...') { // This might vary slightly based on Select2 version
                    return $('<span>Sedang mencari data...</span>'); // Customize searching message
               }
               if (data.text === 'Loading more results..') { // This might vary slightly based on Select2 version
                    return $('<span>Sedang memuat data lainnya...</span>'); // Customize searching message
               }
               // For regular results, return the data.text or a customized HTML structure
               return data.name;
          },
          templateSelection: function(data) {
               return data.name || data.text;
          }
     });

     $('#add_skpd').select2({
          width: "100%",
          dropdownParent: $('#add-user-modal .modal-content'),
          ajax: {
               url: "<?= base_url('v2/backend/users/get_skpd_json') ?>",
               dataType: 'json',
               delay: 250,
               type: 'post',
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
          },
          placeholder: 'Cari SKPD',
          templateResult: function(data) {
               // Check if the data object represents a loading or searching message
               if (data.loading) {
                    return $('<span>Mohon tunggu...</span>'); // Customize loading message
               }
               if (data.text === 'Searching...') { // This might vary slightly based on Select2 version
                    return $('<span>Sedang mencari data...</span>'); // Customize searching message
               }
               if (data.text === 'Loading more results..') { // This might vary slightly based on Select2 version
                    return $('<span>Sedang memuat data lainnya...</span>'); // Customize searching message
               }
               // For regular results, return the data.text or a customized HTML structure
               return data.name;
          },
          templateSelection: function(data) {
               return data.name || data.text;
          }
     });

     let createpassword = (type, ele) => {
          document.getElementById(type).type = document.getElementById(type).type == "password" ? "text" : "password"
          let icon = ele.childNodes[0].classList
          let stringIcon = icon.toString()
          if (stringIcon.includes("mdi-eye-outline")) {
               ele.childNodes[0].classList.remove("mdi-eye-outline")
               ele.childNodes[0].classList.add("mdi-eye-off-outline")
          } else {
               ele.childNodes[0].classList.add("mdi-eye-outline")
               ele.childNodes[0].classList.remove("mdi-eye-off-outline")
          }
     }

     let users_table = $('#users-table').DataTable({
          responsive: false,
          searching: true,
          processing: true,
          serverSide: true,
          ajax: {
               url: "<?= base_url('v2/backend/users/get_users_json') ?>",
               type: "post",
               data: {
                    search: function() {
                         return $("#search").val();
                    },
                    role: function() {
                         return $("#role").val();
                    },
                    skpd: function() {
                         return $("#skpd").val();
                    },
               }
          },
          bLengthChange: !1,
          order: [
               [5, "asc"]
          ],
          language: {
               processing: '<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> Mohon tunggu ...',
               infoEmpty: '<strong>Tidak ada data</strong>',
               zeroRecords: '<div class="alert alert-danger content-center" role="alert"><div class="alert-content"><p>Maaf, data tidak ditemukan...</p></div></div>',
               searchPlaceholder: 'Cari nama atau ticket pengaduan...',
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
               data: "username",
          }, {
               bSortable: !1,
               data: "employee.fullname"
          }, {
               bSortable: !1,
               data: "employee.phone"
          }, {
               data: "company.name"
          }, {
               data: "role",
          }, {
               data: "action",
               bSortable: !1,
          }]
     });
     $(".dataTables_paginate").addClass("pagination-rounded");
     $(".dataTables_filter").hide();

     users_table.on('click', '.btn-edit', function() {
          Swal.fire({
               title: "Mohon tunggu",
               allowOutsideClick: false,
               allowEscapeKey: false,
               didOpen: function() {
                    Swal.showLoading();
               }
          });

          $.post("<?= base_url('v2/backend/users/get_user_json') ?>", {
               user: $(this).data('user'),
               uname: $(this).data('uname')
          }, function(data, status) {
               if (status == 'success') {
                    let dao = JSON.parse(data);
                    swal.close();
                    if (dao.status == 200) {
                         edit_modal = true;
                         $('input[name="user"]').val(dao.data.user_id);
                         $('input[name="fullname"]').val(dao.data.fullname);
                         $('input[name="email"]').val(dao.data.email);
                         $('input[name="phone"]').val(dao.data.phone);
                         $('input[name="username"]').val(dao.data.user_username);

                         var companyOpt = new Option(dao.data.company_name, dao.data.company_id, true, true);
                         $('select[name="skpd"]').append(companyOpt).trigger('change');
                         $('select[name="role"]').val(dao.data.user_role).trigger('change');

                         document.querySelector('#modal-title').innerHTML = 'Ubah Pengguna';
                         $('.add-user-modal').modal('show');
                    } else {
                         swal({
                              title: 'Kesalahan',
                              text: dao.message,
                              icon: 'error'
                         });
                    }
               } else {
                    swal({
                         title: 'Kesalahan',
                         text: 'Terjadi kesalahan saat menghubungkan ke server...',
                         icon: 'error'
                    });
               }
          });
     });

     $('.btn-filter').click(function() {
          users_table.ajax.reload();
     });

     $('.btn-reset').click(function() {
          $('#search').val(null);
          $('#role').val(null).trigger('change');
          $('#skpd').val(null).trigger('change');
          users_table.ajax.reload();
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
               $('.add-user-modal').modal('show');
          }, 1000);
     });

     const progressBar = document.querySelector('#progress-bar');
     const strongPassword = function() {
          return {
               validate: function(input) {
                    const value = input.value;
                    if (value === '') {
                         return {
                              valid: true,
                         };
                    }

                    // Check the password strength
                    if (value.length < 6) {
                         return {
                              valid: false,
                              message: 'Password harus memiliki panjang minimal 6 karakter',
                         };
                    }

                    // The password does not contain any uppercase character
                    if (value === value.toLowerCase()) {
                         return {
                              valid: false,
                              message: 'Password harus memiliki karakter huruf besar',
                         };
                    }

                    // The password does not contain any uppercase character
                    if (value === value.toUpperCase()) {
                         return {
                              valid: false,
                              message: 'Password harus memiliki karakter huruf kecil',
                         };
                    }

                    // The password does not contain any digit
                    if (value.search(/[0-9]/) < 0) {
                         return {
                              valid: false,
                              message: 'Password harus memiliki minimal 1 angka',
                         };
                    }

                    const result = zxcvbn(value);
                    const score = result.score;
                    const messageVal = 'Password lemah atau rentan diketahui' || 'Password sangat lemah';

                    // // const minimalScore = input.options && input.options.minimalScore ? input.options.minimalScore : 1;
                    const minimalScore = 3;
                    switch (score) {
                         case 0:
                              return {
                                   valid: false,
                                        // Yeah, this will be set as error message
                                        message: 'Password sering digunakan atau rentan diketahui',
                                        meta: {
                                             // This meta data will be used later
                                             score: score,
                                        },
                              };
                         case 1:
                              return {
                                   valid: false,
                                        // Yeah, this will be set as error message
                                        message: 'Password sangat lemah',
                                        meta: {
                                             // This meta data will be used later
                                             score: score,
                                        },
                              };
                              break;
                         case 2:
                              return {
                                   valid: false,
                                        // Yeah, this will be set as error message
                                        message: 'Password kurang kuat',
                                        meta: {
                                             // This meta data will be used later
                                             score: score,
                                        },
                              };
                         case 3:
                              return {
                                   valid: true,
                                        // Yeah, this will be set as error message
                                        message: 'Password kuat',
                                        meta: {
                                             // This meta data will be used later
                                             score: score,
                                        },
                              };
                         case 4:
                              return {
                                   valid: true,
                                        // Yeah, this will be set as error message
                                        message: 'Password sangat kuat',
                                        meta: {
                                             // This meta data will be used later
                                             score: score,
                                        },
                              };
                         default:
                              break;
                    }
               }
          }
     }

     const formAdd = document.getElementById('add-form');
     const addFv = FormValidation.formValidation(formAdd, {
          fields: {
               fullname: {
                    validators: {
                         notEmpty: {
                              message: 'Nama lengkap harus diisi dan tidak boleh kosong!'
                         },
                         stringLength: {
                              min: 5,
                              max: 50,
                              message: 'Nama lengkap harus lebih dari 5 karakter dan kurang dari 50 karakter',
                         },
                         regexp: {
                              regexp: /^[a-zA-Z.,' ]+$/,
                              message: 'Karakter yang anda masukan tidak diperbolehkan!'
                         },
                    }
               },
               phone: {
                    validators: {
                         notEmpty: {
                              message: 'Kontak harus diisi dan tidak boleh kosong!'
                         },
                         stringLength: {
                              min: 5,
                              max: 20,
                              message: 'Kontak harus lebih dari 5 karakter dan kurang dari 20 karakter.',
                         },
                         regexp: {
                              regexp: /^[0-9+]+$/,
                              message: 'Hanya angka yang diperbolehkan.'
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
                         remote: {
                              method: 'POST',
                              url: '<?= base_url("v2/backend/users/find_exists_user_json") ?>',
                              delay: 2000,
                              data: function() {
                                   return {
                                        email: formAdd.querySelector('input[name="email"]').value,
                                        user: formAdd.querySelector('#user').value
                                   }
                              }
                         },
                    }
               },
               username: {
                    validators: {
                         notEmpty: {
                              message: 'Username harus diisi dan tidak boleh kosong!'
                         },
                         stringLength: {
                              min: 6,
                              max: 20,
                              message: 'Panjang minimal 6 karakter dan maksimal 20 karakter'
                         },
                         regexp: {
                              regexp: /^[a-zA-Z0-9]+$/,
                              message: 'Hanya huruf dan angka yang diperbolehkan!'
                         },
                         remote: {
                              method: 'POST',
                              url: '<?= base_url("v2/backend/users/find_exists_user_json") ?>',
                              delay: 2000,
                              data: function() {
                                   return {
                                        // username: formAdd.querySelector('input[name="username"]').value
                                        user: formAdd.querySelector('#user').value
                                   }
                              }
                         },
                    }
               },
               password: {
                    validators: {
                         notEmpty: {
                              message: 'Password harus diisi dan tidak boleh kosong!'
                         },
                         stringLength: {
                              min: 6,
                              max: 20,
                              message: 'Panjang password minimal 6 karakter dan maksimal 20 karakter'
                         },
                         checkPassword: {
                              message: 'Password sangat lemah'
                         }
                    }
               },
               conf_password: {
                    validators: {
                         notEmpty: {
                              message: 'Konfirmasi Password harus diisi dan tidak boleh kosong!'
                         },
                         stringLength: {
                              min: 6,
                              max: 20,
                              message: 'Panjang konfirmasi password minimal 6 karakter dan maksimal 20 karakter'
                         },
                         identical: {
                              compare: function() {
                                   return formAdd.querySelector('[name="password"]').value;
                              },
                              message: 'Password dan Konfirmasi Password tidak sama!',
                         },
                    }
               },
               role: {
                    validators: {
                         notEmpty: {
                              message: 'Hak akses harus dipilih dan tidak boleh kosong!'
                         },
                    }
               },
               skpd: {
                    validators: {
                         notEmpty: {
                              message: 'SKPD harus dipilih dan tidak boleh kosong!'
                         },
                    }
               }
          },
          plugins: {
               trigger: new FormValidation.plugins.Trigger(),
               bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: '',
                    // rowSelector: '.form-group'
                    rowSelector: function(field, ele) {
                         switch (field) {
                              case 'email':
                              case 'phone':
                              case 'password':
                              case 'conf_password':
                                   return '.col-md-6';
                              case 'fullname':
                              case 'skpd':
                              case 'username':
                              case 'role':
                                   return '.col-md-12';
                              default:
                                   return '.mb-3';
                         }
                    }
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
     }).registerValidator('checkPassword', strongPassword).on('core.validator.validated', function(e) {
          if (e.field === 'password' && e.validator === 'checkPassword') {
               if (e.result.meta) {
                    const score = e.result.meta.score;
                    switch (score) {
                         case 0:
                              progressBar.style.opacity = 1;
                              progressBar.style.backgroundColor = '#ff4136';
                              progressBar.style.width = '10%';
                              break;
                         case 1:
                              progressBar.style.opacity = 1;
                              progressBar.style.backgroundColor = '#ff4136';
                              progressBar.style.width = '25%';
                              break;
                         case 2:
                              progressBar.style.opacity = 1;
                              progressBar.style.backgroundColor = '#ffb700';
                              progressBar.style.width = '50%';
                              break;
                         case 3:
                              progressBar.style.opacity = 1;
                              progressBar.style.backgroundColor = '#19a974';
                              progressBar.style.width = '75%';
                              break;
                         default:
                              progressBar.style.opacity = 1;
                              progressBar.style.backgroundColor = '#1da1f2';
                              progressBar.style.width = '100%';
                              break;
                    }
               } else {
                    progressBar.style.opacity = 0;
                    progressBar.style.width = '0%';
               }
          }
     });

     formAdd.querySelector('[name="password"]').addEventListener('input', function() {
          if (edit_modal == true && formAdd.querySelector('[name="password"]').value == '') {
               addFv.revalidateField('password');
               addFv.revalidateField('conf_password');
               addFv.disableValidator('password');
               addFv.disableValidator('conf_password');
          } else {
               addFv.revalidateField('password');
               addFv.revalidateField('conf_password');
               addFv.enableValidator('password');
               addFv.enableValidator('conf_password');
          }
     });

     $('.add-user-modal').on('hidden.bs.modal', function() {
          $('#add_role, #add_skpd').val(null).trigger('change');
          $('#add-form')[0].reset();
          addFv.resetField('fullname', true);
          addFv.resetField('phone', true);
          addFv.resetField('email', true);
          addFv.resetField('username', true);
          addFv.resetField('password', true);
          addFv.resetField('conf_password', true);
          addFv.resetField('role', true);
          addFv.resetField('skpd', true);
          addFv.enableValidator('password');
          addFv.enableValidator('conf_password');
          document.querySelector('#modal-title').innerHTML = 'Tambah Pengguna Baru';
          progressBar.style.opacity = 0;
          progressBar.style.width = '0%';

          $('input[name="password"]').prop('required', true);
          $('input[name="conf_password"]').prop('required', true);
          edit_modal = false;
          $('#user').prop('required', false);
          document.querySelector('#note-pwd').innerHTML = '';
     });

     $('.add-user-modal').on('shown.bs.modal', function() {
          if (edit_modal) {
               $('input[name="password"]').prop('required', false);
               $('input[name="conf_password"]').prop('required', false);
               $('#user').prop('required', true);

               addFv.disableValidator('password');
               addFv.disableValidator('conf_password');
               document.querySelector('#note-pwd').innerHTML = '*) Kosongkan <strong>Password & Konfirmasi Password</strong> apabila tidak akan diubah!';
          }
     });

     users_table.on('click', '.btn-delete', function() {
          Swal.fire({
               title: "Mohon tunggu",
               allowOutsideClick: false,
               allowEscapeKey: false,
               didOpen: function() {
                    Swal.showLoading();
               }
          });

          $.post("<?= base_url('v2/backend/users/get_user_json') ?>", {
                    user: $(this).data('user'),
                    uname: $(this).data('uname')
               }, function(data, status) {
                    if (status == 'success') {
                         let dao = JSON.parse(data);
                         if (dao.status == 200 && dao.data != null) {
                              console.log(dao.data);

                              Swal.fire({
                                   title: "Hapus Pengguna",
                                   text: "Apakah anda akan menghapus pengguna: " + dao.data.fullname + "?",
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

                                        $.post("<?= base_url('v2/backend/users/deleted') ?>", {
                                             user: dao.data.user_id,
                                             uname: dao.data.user_username,
                                             emp: dao.data.id
                                        }, function(data, status) {
                                             if (status == 'success') {
                                                  let resp_delete = JSON.parse(data);
                                                  Swal.fire({
                                                       title: (resp_delete.status == 200) ? 'Berhasil' : 'Gagal',
                                                       text: resp_delete.message,
                                                       icon: (resp_delete.status == 200) ? 'success' : 'error'
                                                  }).then(function() {
                                                       users_table.ajax.reload();
                                                  });

                                             } else {
                                                  Swal.fire('Kesalahan', 'Terjadi kesalahan saat mengirimkan data ke server untuk penghapusan pengguna!', 'error');
                                             }
                                        }).fail(function() {
                                             Swal.fire('Kesalahan', 'Terjadi kesalahan saat menghubungkan ke server untuk penghapusan pengguna!', 'error');
                                        })
                                   } else if (t.dismiss === Swal.DismissReason.cancel) {
                                        Swal.fire({
                                             title: "Batal",
                                             text: "Anda membatalkan penghapusan pengguna :)",
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
     })
</script>
