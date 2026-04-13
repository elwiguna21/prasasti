<link rel="stylesheet" href="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/styles/index.min.css') ?>" />
<div class="row page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Profil</a></li>
     </ol>
</div>
<!-- row -->
<div class="row">
     <div class="col-lg-12">
          <div class="profile card card-body px-3 pt-3 pb-0">
               <div class="profile-head">
                    <div class="photo-content">
                         <div class="cover-photo rounded"></div>
                    </div>
                    <div class="profile-info">
                         <div class="profile-photo">
                              <img src="<?= $employee->avatar ?>" class="img-fluid rounded-circle" alt="Avatar">
                         </div>
                         <div class="profile-details">
                              <div class="profile-name px-3 pt-2">
                                   <h4 class="text-primary mb-0"><?= $employee->fullname; ?></h4>
                                   <p><?= strtoupper($employee->user_role); ?></p>
                              </div>
                              <div class="profile-email px-2 pt-2">
                                   <h4 class="text-muted mb-0"><?= $employee->email; ?></h4>
                                   <p>Email</p>
                              </div>
                              <div class="dropdown ms-auto">
                                   <a href="javascript:void(0);" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                  <rect x="0" y="0" width="24" height="24"></rect>
                                                  <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                  <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                  <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                             </g>
                                        </svg></a>
                                   <ul class="dropdown-menu dropdown-menu-end">
                                        <li class="dropdown-item"><i class="fa fa-ban text-primary me-2"></i> Block</li>
                                        <li class="dropdown-item"><a href="<?= base_url('v2/authentications/signout') ?>"><i class="fa fa-sign-out text-danger me-2"></i> Sign Out</a></li>
                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
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

<div class="row">
     <div class="col-xl-12">
          <div class="card h-auto">
               <div class="card-body">
                    <div class="profile-tab">
                         <div class="custom-tab-1">
                              <ul class="nav nav-tabs">
                                   <li class="nav-item"><a href="#about-me" data-bs-toggle="tab" class="nav-link active">Tentang saya</a>
                                   </li>
                                   <li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab" class="nav-link">Pengaturan Profil</a>
                                   </li>
                              </ul>
                              <div class="tab-content">
                                   <div id="about-me" class="tab-pane fade active show">
                                        <div class="profile-about-me">
                                             <div class="pt-4 border-bottom-1 pb-3">
                                                  <h4 class="text-primary">Unit kerja</h4>
                                                  <p class="mb-2"><?= $employee->company_name; ?></p>
                                             </div>
                                        </div>
                                        <div class="profile-skills mb-5">
                                             <h4 class="text-primary mb-2">Hak akses</h4>
                                             <?php switch ($employee->user_role) {
                                                  case 'operator':
                                                       $btn_color     = 'btn-danger light';
                                                       break;
                                                  case 'verifikator_skpd':
                                                       $btn_color     = 'btn-info light';
                                                       break;
                                                  case 'verifikator_lkd':
                                                       $btn_color     = 'btn-warning light';
                                                       break;
                                                  case 'kepala_skpd':
                                                       $btn_color     = 'btn-success light';
                                                       break;
                                                  case 'kepala_lkd':
                                                       $btn_color     = 'btn-primary';
                                                       break;

                                                  default:
                                                       $btn_color     = 'btn-primary light';
                                                       break;
                                             } ?>
                                             <a href="javascript:void(0);" class="btn <?= $btn_color; ?> btn-xs mb-1"><?= strtoupper($employee->user_role); ?></a>
                                        </div>
                                        <div class="profile-personal-info">
                                             <h4 class="text-primary mb-4">Informasi Personal</h4>
                                             <div class="row mb-2">
                                                  <div class="col-sm-3 col-5">
                                                       <h5 class="f-w-500">Nama Lengkap <span class="pull-end">:</span>
                                                       </h5>
                                                  </div>
                                                  <div class="col-sm-9 col-7"><span><?= $employee->fullname; ?></span>
                                                  </div>
                                             </div>
                                             <div class="row mb-2">
                                                  <div class="col-sm-3 col-5">
                                                       <h5 class="f-w-500">Email <span class="pull-end">:</span>
                                                       </h5>
                                                  </div>
                                                  <div class="col-sm-9 col-7"><span><?= $employee->email; ?></span>
                                                  </div>
                                             </div>
                                             <div class="row mb-2">
                                                  <div class="col-sm-3 col-5">
                                                       <h5 class="f-w-500">Telepon / No.HP <span class="pull-end">:</span></h5>
                                                  </div>
                                                  <div class="col-sm-9 col-7"><span><?= $employee->phone; ?></span>
                                                  </div>
                                             </div>

                                             <?php if (in_array($employee->user_role, array('kepala_skpd', 'kepala_lkd'))) { ?>
                                                  <div class="row mb-2">
                                                       <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">NIK <span class="pull-end">:</span></h5>
                                                       </div>
                                                       <div class="col-sm-9 col-7"><span><?= $employee->nik; ?></span>
                                                       </div>
                                                  </div>
                                                  <div class="row mb-2">
                                                       <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">NIP <span class="pull-end">:</span></h5>
                                                       </div>
                                                       <div class="col-sm-9 col-7"><span><?= $employee->nip; ?></span>
                                                       </div>
                                                  </div>
                                                  <div class="row mb-2">
                                                       <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Jabatan <span class="pull-end">:</span></h5>
                                                       </div>
                                                       <div class="col-sm-9 col-7"><span><?= $employee->jabatan; ?></span>
                                                       </div>
                                                  </div>
                                             <?php } ?>
                                             <div class="row mb-2">
                                                  <div class="col-sm-3 col-5">
                                                       <h5 class="f-w-500">Username <span class="pull-end">:</span></h5>
                                                  </div>
                                                  <div class="col-sm-9 col-7"><span><?= $employee->user_username; ?></span>
                                                  </div>
                                             </div>
                                             <div class="row mb-2">
                                                  <div class="col-sm-3 col-5">
                                                       <h5 class="f-w-500">Unit Kerja <span class="pull-end">:</span>
                                                       </h5>
                                                  </div>
                                                  <div class="col-sm-9 col-7"><span><?= $employee->company_name; ?></span>
                                                  </div>
                                             </div>
                                             <div class="row mb-2">
                                                  <div class="col-sm-3 col-5">
                                                       <h5 class="f-w-500">Alamat <span class="pull-end">:</span></h5>
                                                  </div>
                                                  <div class="col-sm-9 col-7"><span><?= $employee->company_address; ?></span>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div id="profile-settings" class="tab-pane fade">
                                        <div class="pt-3">
                                             <div class="settings-form">
                                                  <h4 class="text-primary">Pengaturan Profil</h4>
                                                  <form action="<?= base_url('v2/users/save') ?>" id="add-form" method="post">
                                                       <div hidden>
                                                            <input type="text" name="user" class="form-control" value="<?= $employee->user_id ?>" required readonly>
                                                            <input type="text" name="skpd" class="form-control" value="<?= $this->encryption->decrypt($employee->company_id); ?>" required readonly>
                                                            <input type="text" name="role" class="form-control" value="<?= $employee->user_role; ?>" required readonly>
                                                            <input type="text" class="form-control" name="profiles" value="true" required readonly>
                                                       </div>

                                                       <div class="mb-3 col-md-12">
                                                            <label class="form-label">Nama Lengkap</label>
                                                            <input type="text" placeholder="Masukan nama lengkap" class="form-control" name="fullname" value="<?= $employee->fullname; ?>" required autocomplete="off">
                                                       </div>
                                                       <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                 <label class="form-label">Email</label>
                                                                 <input type="email" placeholder="Email" class="form-control" name="email" value="<?= $employee->email; ?>" required autocomplete="off">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                 <label class="form-label">Telepon / No.HP</label>
                                                                 <input type="text" placeholder="Telepon / No.HP" class="form-control" name="phone" value="<?= $employee->phone ?>" required autocomplete="off">
                                                            </div>
                                                       </div>
                                                       <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                 <label class="form-label">NIK</label>
                                                                 <input type="text" placeholder="NIK" class="form-control" name="nik" value="<?= $employee->nik; ?>" maxlength="16" required autocomplete="off">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                 <label class="form-label">NIP</label>
                                                                 <input type="text" placeholder="NIP" class="form-control" name="nip" value="<?= $employee->nip; ?>" maxlength="20" required autocomplete="off">
                                                            </div>
                                                       </div>
                                                       <div class="mb-3 col-md-12">
                                                            <label class="form-label">Jabatan</label>
                                                            <input type="text" placeholder="Masukan jabatan" class="form-control" name="position" value="<?= $employee->jabatan; ?>" maxlength="100" required autocomplete="off">
                                                       </div>

                                                       <h4 class="text-primary mt-3">Pengaturan Akun</h4>
                                                       <div class="mb-3 col-md-12">
                                                            <label class="form-label">Username</label>
                                                            <input type="text" placeholder="Username" class="form-control" name="username" value="<?= $employee->user_username; ?>" required autocomplete="off">
                                                       </div>
                                                       <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                 <label class="form-label">Password</label>
                                                                 <div class="input-group mb-2">
                                                                      <input type="password" class="form-control" name="password" id="pwd" placeholder="Password" required autocomplete="off">
                                                                      <a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light" id="password-addon" onclick="createpassword('pwd', this)"><i class="mdi mdi-eye-outline"></i></a>
                                                                 </div>
                                                                 <div class="progress animated-progess mt-1">
                                                                      <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                                 </div>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                 <label class="form-label">Konfirmasi Password</label>
                                                                 <input type="password" class="form-control" name="conf_password" placeholder="Konfirmasi Password" required autocomplete="off">
                                                            </div>
                                                            <small class="text-danger mb-3" id="note-pwd">*) Kosongkan <strong>Password & Konfirmasi Password</strong> apabila tidak akan diubah!</small>
                                                       </div>
                                                       <button class="btn btn-primary" type="submit">Simpan</button>
                                                  </form>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- REQUIRED VENDORS! -->
<!-- <script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script> -->

<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/bundle/popular.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/plugin-bootstrap5/index.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/plugin-auto-focus/index.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/umd/plugin-password-strength/index.js') ?>"></script>
<script src="<?= base_url('assets/v3/backend/vendor/@form-validation/zxcvbn.js') ?>"></script>

<script>
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
                              url: '<?= base_url("v2/users/find_exists_user_json") ?>',
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
                              regexp: /^[a-zA-Z0-9_]+$/,
                              message: 'Hanya huruf, angka dan garis bawah yang diperbolehkan!'
                         },
                         remote: {
                              method: 'POST',
                              url: '<?= base_url("v2/users/find_exists_user_json") ?>',
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
                              case 'nip':
                              case 'nik':
                                   return '.col-md-6';
                              case 'fullname':
                              case 'username':
                              case 'position':
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

     addFv.revalidateField('password');
     addFv.revalidateField('conf_password');
     addFv.disableValidator('password');
     addFv.disableValidator('conf_password');

     formAdd.querySelector('[name="password"]').addEventListener('input', function() {
          if (formAdd.querySelector('[name="password"]').value == '') {
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
</script>
