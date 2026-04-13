<link href="<?= base_url('assets/v3/backend/') ?>vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">

<div class="dlab-bnr-inr overlay-primary" style="background-image:url(<?= base_url('assets/v3/frontend/images/banner/bnr2.jpg') ?>);">
     <div class="container">
          <div class="dlab-bnr-inr-entry">
               <h1 class="text-white">Guide Arsip</h1>
               <!-- Breadcrumb row -->
               <div class="breadcrumb-row">
                    <ul class="list-inline">
                         <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                         <li><a href="<?= base_url('v2/frontend/archieves') ?>">Arsip Statis</a></li>
                         <li>Guide Arsip</li>
                    </ul>
               </div>
               <!-- Breadcrumb row END -->
          </div>
     </div>
</div>

<div class="section-full bg-white content-inner" style="background-image:url(<?= base_url('assets/v3/frontend/') ?>images/background/bg1.png);">
     <div class="container">
          <div class="section-content">
               <div class="row">
                    <div class="col-6 col-lg-3 col-md-6 col-sm-6">
                         <div class="icon-bx-wraper">
                              <div class="icon-md text-black m-b20">
                                   <a href="javascript:void(0);" class="icon-cell text-black"><i class="flaticon-trophy"></i></a>
                              </div>
                              <div class="icon-content m-b30">
                                   <h5 class="dlab-tilte">Arsip Terintegrasi</h5>
                                   <p>Pengolahan arsip terintegrasi.</p>
                              </div>
                         </div>
                         <div class="icon-bx-wraper m-b30">
                              <div class="icon-md text-black m-b20">
                                   <a href="javascript:void(0);" class="icon-cell text-black"><i class="flaticon-technology"></i></a>
                              </div>
                              <div class="icon-content">
                                   <h5 class="dlab-tilte">Pencarian Arsip</h5>
                                   <p>Memudahkan dalam pencarian arsip.</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6 col-sm-6">
                         <div class="icon-bx-wraper">
                              <div class="icon-md text-black m-b20">
                                   <a href="javascript:void(0);" class="icon-cell text-black"><i class="flaticon-bar-chart"></i></a>
                              </div>
                              <div class="icon-content m-b30">
                                   <h5 class="dlab-tilte">Monitoring</h5>
                                   <p>Monitoring pengolah arsip dengan mudah dan cepat.</p>
                              </div>
                         </div>
                         <div class="icon-bx-wraper  m-b30">
                              <div class="icon-md text-black m-b20">
                                   <a href="javascript:void(0);" class="icon-cell text-black"><i class="flaticon-devices"></i></a>
                              </div>
                              <div class="icon-content">
                                   <h5 class="dlab-tilte">Responsif</h5>
                                   <p>Dapat diakses dan digunakan oleh berbagai perangkat.</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6 col-sm-6 m-b30 wow fadeInUp" data-wow-delay="0.2s">
                         <div class="dlab-media dlab-img-overlay6 gradient radius-sm">
                              <img src="<?= base_url('assets/v3/frontend/') ?>images/about/pic1.jpg" alt="">
                         </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                         <div class="dlab-media dlab-img-overlay6 gradient radius-sm">
                              <img src="<?= base_url('assets/v3/frontend/') ?>images/about/pic2.jpg" alt="">
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="section-full content-inner" style="background-image:url(images/pattern/pic1.jpg);">
     <div class="container">
          <div class="section-head text-black text-center">
               <h2 class="text-uppercase m-b10">Guide Arsip</h2>
               <p>Untuk memudahkan dalam pengelolaan arsip, silahkan dapat melihat panduan dibawah ini.</p>
          </div>
          <div class="row text-center">
               <?php if (!empty($guides)) {
                    foreach ($guides as $guide) { ?>
                         <div class="col-lg-4 col-md-4 col-sm-6 m-b30 wow fadeInUp" data-wow-delay="0.3s">
                              <div class="icon-bx-wraper bx-style-1 p-a30 center fly-box-ho">
                                   <div class="icon-content">
                                        <h5 class="dlab-tilte text-uppercase"><a href="javascript:void(0);"><?= $guide->caption; ?></a></h5>
                                        <!-- <p><?= $archieve->deskripsi; ?></p> -->
                                        <a href="javascript:void(0);" class="site-button btn-detail" data-guide="<?= $guide->id; ?>" data-file="<?= $guide->file; ?>"><i class="ti ti-eye me-2"></i> Dokumen</a>
                                   </div>
                              </div>
                         </div>
                    <?php }
               } else { ?>
                    <div class="col-lg-12 m-b30 wow fadeInUp" data-wow-delay="0.4s">
                         <div class="alert alert-warning">
                              Data tidak ditemukan...
                         </div>
                    </div>
               <?php } ?>
          </div>
     </div>
</div>

<div class="modal fade" id="guide-modal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="modal-title">Detail Guide</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal">
                    </button>
               </div>
               <div class="modal-body">
                    <p class="m-b10" id="caption-guide"></p>
                    <iframe src="" id="view-guide" width="100%" height="500" frameborder="0"></iframe>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-danger light me-3" data-bs-dismiss="modal">Tutup</button>
               </div>
          </div>
     </div>
</div>

<!-- REQUIRED VENDORS! -->
<script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url('assets/v3/backend/') ?>vendor/sweetalert2/sweetalert2.min.js"></script>

<script>
     $('.btn-detail').click(function() {
          let guide = $(this).data('guide');
          let file = $(this).data('file');

          Swal.fire({
               title: "Mohon tunggu",
               allowOutsideClick: false,
               allowEscapeKey: false,
               didOpen: function() {
                    Swal.showLoading();
               }
          });

          $.post("<?= base_url('v2/frontend/archieves/get_guide_json') ?>", {
               guide: guide,
               file: file
          }, function(data, status) {
               if (status == 'success') {
                    let dao = JSON.parse(data);
                    if (dao.status == 200) {
                         swal.close();
                         document.getElementById('view-guide').src = "<?= base_url('assets/upload/') ?>" + dao.data.file;
                         document.getElementById('caption-guide').innerHTML = dao.data.caption;

                         $("#guide-modal").modal('show');
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

     $('#guide-modal').on('hidden.bs.modal', function() {
          document.getElementById('view-guide').src = "";
          document.getElementById('caption-guide').innerHTML = "-";
     });
</script>
