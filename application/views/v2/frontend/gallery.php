<!--<link href="--><?php //= base_url('assets/v3/backend/') ?><!--vendor/lightgallery/css/lightgallery.min.css" rel="stylesheet">-->
<!--<link href="--><?php //= base_url('assets/v3/backend/') ?><!--vendor/glightbox/dist/css/glightbox.min.css" rel="stylesheet">-->
<style>
     img {
         position: relative;
         /*top: 50%;*/
         /*transform: translateY(-50%);*/
     }
</style>
<div class="breadcrumb-section bg-img"
     style="background-image: url('<?= base_url("assets/v3/frontend/v2/") ?>img/bg-img/90.jpg');">
     <div class="container">
          <!-- Breadcrumb Content -->
          <div class="breadcrumb-content">
               <div class="divider"></div>
               <h2>Galeri</h2>
               <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <li>Galeri</li>
               </ul>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>

<!-- Case Study Section -->
<section class="case-study-section bg-secondary">
     <!-- Divider -->
     <div class="divider"></div>

     <div class="container">
          <div class="row g-5 align-items-end">
               <!-- Section Heading -->
               <div class="col-12">
                    <div class="section-heading">
                         <span class="sub-title">Dokumentasi pelaksanaan kearsipan</span>
                         <h2 class="mb-0">Lingkungan Pemerintah Daerah Kabupaten Sumedang</h2>
                    </div>
               </div>
          </div>
     </div>

     <div class="divider-sm"></div>

     <div class="container">
          <div class="row d-flex justify-content-center align-items-center g-4" id="id="lightgallery"">
               <?php if (!empty($galleries)) {
	               $counter = 1;
                    foreach ($galleries as $gallery) {
                         $gallery->file = "https://sisemar.sumedangkab.go.id/v2/assets/upload/" . $gallery->file;
	                    $column_size = ($counter % 5 == 0) ? 'col-lg-8' : 'col-lg-4'; ?>
                         <div class="col-12 col-sm-6 <?= $column_size; ?>">
                              <div class="case-study-card">
<!--                                   <img src="--><?php //= base_url('assets/v3/frontend/v2/img/') ?><!--bg-img/65.jpg" alt="" style="max-height: 491px">-->
                                   <img src="<?= $gallery->file; ?>" alt="" style="max-height: 491px">
                                   <!-- Case Study Content -->
                                   <div class="case-study-content">
<!--                                        <p class="text-white mb-2"></p>-->
                                        <h4 class="mb-0 text-white"><?= $gallery->caption; ?></h4>
                                   </div>
                                   <!-- View More -->
<!--                                   <a href="--><?php //= $gallery->file; ?><!--" class="btn btn-primary glightbox" data-exthumbimage="--><?php //= $gallery->file; ?><!--" data-src="--><?php //= $gallery->file; ?><!--"><i class="ti ti-arrow-up-right"></i></a>-->
                                   <a href="<?= $gallery->file; ?>" class="btn btn-primary glightbox"><i class="ti ti-arrow-up-right"></i></a>
                              </div>
                         </div>
                    <?php
	                    $counter++;
                    }
               } ?>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<!--<script src="--><?php //= base_url('assets/v3/backend/') ?><!--vendor/glightbox/dist/js/glightbox.min.js"></script>-->
<script>

</script>