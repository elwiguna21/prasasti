<div class="breadcrumb-section bg-img" style="background-image: url('<?= base_url('assets/v3/frontend/v2/') ?>img/bg-img/90.jpg');">
     <div class="container">
          <!-- Breadcrumb Content -->
          <div class="breadcrumb-content">
               <div class="divider"></div>
               <h2>Visi &amp; Misi</h2>
               <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <li>Visi & Misi</li>
               </ul>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>

<div class="team-details-section">
     <!-- Divider -->
     <div class="divider"></div>

     <div class="row justify-content-center">
          <div class="col-12 col-md-5 col-xl-7">
               <div class="section-heading text-center">
                    <span class="sub-title">Visi &amp; Misi</span>
                    <h2 class="mb-0">Kabupaten Sumedang</h2>
                    <p class="mb-5">Kabupaten Sumedang terdiri atas 26 kecamatan, 7 kelurahan, dan 270 desa. Sumedang, ibu kota kabupaten ini, terletak sekitar 45 km dari Kota Bandung. Kota ini meliputi kecamatan Sumedang Utara dan Sumedang Selatan. Sumedang dilintasi jalur utama Bandung - Cirebon.</p>
               </div>
          </div>
     </div>

     <div class="divider-sm"></div>

     <div class="container">
          <div class="row g-5 align-items-center">
               <div class="col-12 col-md-6">
                    <div class="pe-lg-4">
                         <img src="<?= base_url('assets/v3/frontend/v2/') ?>img/bg-img/127.jpg" alt="">
                    </div>
               </div>

               <div class="col-12 col-md-6">
                    <div class="ps-lg-4">
                         <h2 class="mb-2 display-5 fw-semibold">Visi</h2>
                         <p class="text-justify"><?= nl2br($profile->visi); ?></p>
                    </div>

                    <div class="ps-lg-4">
                         <h2 class="mb-2 display-5 fw-semibold">Misi</h2>
                         <p class="text-justify"><?= nl2br($profile->misi); ?></p>
                    </div>
               </div>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>
