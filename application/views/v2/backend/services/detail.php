<?php
$status_name        = '';
$status_color       = '';
$status_icon        = '';

if ($service->status == 'reject') {
     $status_name        = 'Ditolak Verifikator';
     $status_color       = 'danger';
     $status_icon        = 'fa fa-exclamation-triangle';
} else if ($service->status == 'done') {
     $status_name        = 'Selesai';
     $status_color       = 'success';
     $status_icon        = 'fas fa-check-circle';
} else {
     $status_name        = 'Menunggu Persetujuan';
     $status_color       = 'warning';
     $status_icon        = 'las la-clock';
}
?>
<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/dashboards') ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('v2/services/list') ?>">Daftar Permohonan Perbaikan</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);">Detail</a></li>
     </ol>
</div>

<?php if (!empty($this->session->flashdata('status'))) {
     $status = $this->session->flashdata('status'); ?>
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
     <div class="col-xl-4">
          <div class="row">
               <div class="col-xl-12">
                    <div class="card">
                         <div class="card-header">
                              <div class="iconbox">
                                   <i class="<?= $status_icon; ?> bg-<?= $status_color; ?>"></i>
                                   <h5>Status</h5>
                                   <small class="text-<?= $status_color; ?>"><?= $status_name; ?></small>
                              </div>
                         </div>
                         <div class="card-body">
                              <div class="widget-media">
                                   <ul class="timeline">
                                        <li>
                                             <div class="timeline-panel">
                                                  <div class="media me-2 media-info">
                                                       <i class="fas fa-user-edit"></i>
                                                  </div>
                                                  <div class="media-body">
                                                       <small class="d-block">Pemohon</small>
                                                       <h6 class="mb-1"><?= $service->fullname; ?></h6>
                                                       <small class="d-block"><?= full_tgl_indo($service->created_at) ?></small>
                                                  </div>
                                             </div>
                                        </li>
                                        <?php if (in_array($service->status, ['done', 'reject'])) { ?>
                                             <li>
                                                  <div class="timeline-panel">
                                                       <div class="media me-2 media-<?= $status_color; ?>">
                                                            <i class="fas <?= ($service->status == 'reject') ? $status_icon : 'fa-user-check'; ?>"></i>
                                                       </div>
                                                       <div class="media-body">
                                                            <?php if ($service->status == 'done') { ?>
                                                                 <small class="d-block">Disetujui oleh</small>
                                                            <?php } else if ($service->status == 'reject') { ?>
                                                                 <small class="d-block">Ditolak oleh</small>
                                                            <?php } ?>

                                                            <h6 class="mb-1"><?= $service->employee_fullname; ?></h6>
                                                            <small class="d-block"><?= full_tgl_indo($service->verification_date); ?></small>
                                                       </div>
                                                  </div>
                                             </li>

                                             <?php if ($service->status == 'reject') { ?>
                                                  <li>
                                                       <div class="timeline-panel">
                                                            <div class="media me-2 media-warning">
                                                                 <i class="fas fa-circle-info"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                 <small class="d-block">Keterangan</small>
                                                                 <h6 class="mb-1"><?= $service->verification_message; ?></h6>
                                                            </div>
                                                       </div>
                                                  </li>
                                             <?php } ?>
                                        <?php } ?>
                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col-xl-12 mb-3">
                    <?php if ($service->status == 'waiting' and empty($service->verification_user)) { ?>
                         <a href="javascript:void(0);" class="btn light btn-sm btn-success w-100 shadow btn-accept mb-3" data-service="<?= $service->id; ?>" data-code="<?= $service->code; ?>"><i class="fas fa-user-check me-2"></i> Setujui Permohonan</a>
                         <a href="javascript:void(0);" class="btn btn-sm btn-danger w-100 shadow btn-reject mb-3"><i class="fas fa-close me-2"></i> Tolak Permohonan</a>
                    <?php } ?>

                    <?php if (file_exists('./data/repair/' . $service->document)) { ?>
                         <a href="<?= base_url('data/repair/' . $service->document); ?>" class="btn btn-sm btn-info shadow w-100 mb-3" target="_blank"><i class="fas fa-file-download me-2"></i> Download Dokumen Pendukung</a>
                    <?php } else { ?>
                         <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger shadow w-100 mb-3 disabled"><i class="fas fa-exclamation-triangle me-2"></i> Download Dokumen Pendukung</a>
                    <?php } ?>

                    <?php if ($employee->user_username == 'lutdinar') { ?>
                         <form action="<?= base_url('v2/services/deleted') ?>" method="post">
                              <input type="hidden" class="form-control" name="service" value="<?= $service->id ?>" required readonly>
                              <input type="hidden" class="form-control" name="code" value="<?= $service->code ?>" required readonly>
                              <button type="submit" class="btn btn-sm btn-danger shadow w-100 btn-deleted mb-3"><i class="fas fa-close me-2"></i> Hapus Permohonan</button>
                         </form>
<!--                         <a href="--><?php //= base_url('v2/services/deleted?' . http_build_query(array('code' => $service->code, 'service' => $service->id))); ?><!--" class="btn btn-sm btn-danger shadow w-100 mb-3"><i class="fas fa-close me-2"></i> Hapus Permohonan</a>-->
                    <?php } ?>
               </div>
          </div>
     </div>

     <div class="col-xl-8">
          <div class="card">
               <div class="card-header">
                    <div class="media-body">
                         <div class="pull-end">
                              <a href="<?= base_url('v2/services/list') ?>" class="btn btn-primary btn-sm">
                                   <i class="fas fa-arrow-left me-1"></i> Kembali
                              </a>
                         </div>
                         <h5 class="my-1"><?= $service->fullname ?? '-'; ?></h5>
                         <p class="read-content-email mb-0">#<span class="text-primary"><?= $service->code; ?></span></p>
                    </div>
               </div>
               <div class="card-body">
                    <div class="row">
                         <div class="col-lg-6 col-sm-12 mb-4">
                              <h6>No. HP / Telepon:</h6>
                              <div><?= $service->phone ?? '-'; ?></div>
                         </div>
                         <div class="col-lg-6 col-sm-12 mb-4">
                              <h6>Alamat Pemohon:</h6>
                              <div><?= $service->address ?? '-'; ?></div>
                         </div>
                         <div class="mb-4 col-xl-12 col-sm-12">
                              <h6>Keterangan:</h6>
                              <div><?= $service->description; ?></div>
                         </div>

                         <div class="col-xl-12">
                              <h6>Dokumen Pendukung:</h6>
                              <?php if (file_exists('./data/repair/' . $service->document)) { ?>
                                   <iframe src="<?= base_url('data/repair/' . $service->document); ?>" frameborder="0" width="100%" height="600px"></iframe>
                              <?php } else { ?>
                                   <div class="alert alert-warning fade show">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                             <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                             <line x1="12" y1="9" x2="12" y2="13"></line>
                                             <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                        </svg>
                                        <strong>Kesalahan!</strong> Terjadi kesalahan saat memuat dokumen pendukung atau dokumen pendukung tidak dapat ditemukan.
                                   </div>
                              <?php } ?>

                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="modal fade reject-modal" id="reject-modal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tolak Permohonan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
               </div>
               <form action="<?= base_url('v2/services/reject') ?>" method="post">
                    <div class="modal-body">
                         <input type="hidden" class="form-control" name="service" value="<?= $service->id; ?>" readonly required>
                         <input type="hidden" class="form-control" name="code" value="<?= $service->code; ?>" readonly required>
                         <div class="row">
                              <div class="mb-3 col-md-6">
                                   <label class="form-label">Nama Pemohon:</label>
                                   <h6 class="text-primary"><?= $service->fullname; ?></h6>
                              </div>
                              <div class="mb-3 col-md-6">
                                   <label class="form-label">No. HP / Telepon:</label>
                                   <h6 class="text-primary"><?= $service->phone; ?></h6>
                              </div>
                              <div class="mb-0 col-md-12">
                                   <label class="form-label">Keterangan Penolakan: <span class="text-danger">*</span></label>
                                   <textarea name="description" class="form-control" placeholder="Masukan keterangan / deskripsi penolakan permohonan yang diajukan" required></textarea>
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

<script>
     $('.btn-accept').click(function() {
          let service = $(this).data('service'),
               code = $(this).data('code');

          Swal.fire({
               title: "Setujui Permohonan",
               text: "Apakah anda akan menyetujui permohonan: <?= $service->fullname; ?> & merubah status menjadi selesai?",
               icon: "warning",
               showCancelButton: !0,
               confirmButtonText: "Ya, Setujui dan Selesaikan!",
               cancelButtonText: "Batal",
               allowOutsideClick: false,
               allowEscapeKey: false,
               customClass: {
                    confirmButton: "btn btn-success mt-2",
                    cancelButton: "btn light btn-danger ms-3 mt-2"
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

                    $.post("<?= base_url('v2/services/verification') ?>", {
                         service: service,
                         code: code,
                    }, function(data, status) {
                         if (status == 'success') {
                              let respons = JSON.parse(data);
                              Swal.fire({
                                   title: (respons.status == 200) ? 'Berhasil' : 'Gagal',
                                   text: respons.message,
                                   icon: (respons.status == 200) ? 'success' : 'error'
                              }).then(function() {
                                   window.location.reload();
                              });

                         } else {
                              Swal.fire('Kesalahan', 'Terjadi kesalahan saat mengirimkan data ke server untuk verifikasi permohonan!', 'error');
                         }
                    }).fail(function() {
                         Swal.fire('Kesalahan', 'Terjadi kesalahan saat menghubungkan ke server untuk verifikasi permohonan!', 'error');
                    })
               } else if (t.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                         title: "Batal",
                         text: "Anda membatalkan verifikasi permohonan :)",
                         icon: "error"
                    });
               }
          });
     });

     $('.btn-reject').click(function() {
          let service = $(this).data('service');
          let code = $(this).data('code');

          Swal.fire({
               title: "Tolak Permohonan",
               text: "Apakah anda akan menolak permohonan: <?= $service->fullname; ?>?",
               icon: "warning",
               showCancelButton: !0,
               confirmButtonText: "Ya, Tolak Permohonan!",
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
                         title: "Mohon tunggu...",
                         allowOutsideClick: false,
                         allowEscapeKey: false,
                         didOpen: function() {
                              Swal.showLoading();
                         }
                    });

                    setTimeout(() => {
                         Swal.close();
                         $('.reject-modal').modal('show');
                    }, 500);

                    // $.post("<?= base_url('v2/services/reject') ?>", {
                    //      service: service,
                    //      code: code,
                    // }, function(data, status) {
                    //      if (status == 'success') {
                    //           let respons = JSON.parse(data);
                    //           Swal.fire({
                    //                title: (respons.status == 200) ? 'Berhasil' : 'Gagal',
                    //                text: respons.message,
                    //                icon: (respons.status == 200) ? 'success' : 'error'
                    //           }).then(function() {
                    //                window.location.reload();
                    //           });

                    //      } else {
                    //           Swal.fire('Kesalahan', 'Terjadi kesalahan saat mengirimkan data ke server untuk verifikasi permohonan!', 'error');
                    //      }
                    // }).fail(function() {
                    //      Swal.fire('Kesalahan', 'Terjadi kesalahan saat menghubungkan ke server untuk verifikasi permohonan!', 'error');
                    // });
               } else if (t.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                         title: "Batal",
                         text: "Anda membatalkan verifikasi permohonan :)",
                         icon: "error"
                    });
               }
          });
     });

     $('.btn-save').submit(function() {
          Swal.fire({
               title: "Mohon tunggu...",
               allowOutsideClick: false,
               allowEscapeKey: false,
               didOpen: function() {
                    Swal.showLoading();
               }
          });
     });

     let btn_deleted = $('.btn-deleted');
     if (btn_deleted) {
         btn_deleted.click(function () {
             Swal.fire({
                 title: "Mohon tunggu",
                 text: "Sedang mengirim data...",
                 allowOutsideClick: false,
                 allowEscapeKey: false,
                 didOpen: function() {
                     Swal.showLoading();
                 }
             });
         });
     }
</script>
