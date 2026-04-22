<div class="breadcrumb-section bg-img" style="background-image: url('<?= base_url('assets/v3/frontend/v2/') ?>img/bg-img/90.jpg');">
     <div class="container">
          <!-- Breadcrumb Content -->
          <div class="breadcrumb-content">
               <div class="divider"></div>
               <h2>Gambaran Umum</h2>
               <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <li>Gambaran Umum</li>
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
                    <span class="sub-title">Gambaran Umum</span>
                    <h2 class="mb-0">Lembaga Kearsipan Daerah <span class="text-blue">Kabupaten Sumedang</span></h2>
               </div>
          </div>
     </div>

     <div class="divider-sm"></div>

     <div class="container">
          <div class="row g-5 align-items-center">
               <div class="col-12 col-md-6">
                    <div class="ps-lg-4">
                         <h5 class="mb-4 text-primary">Gambaran Umum</h5>
                         <p class="text-justify"><?= nl2br($profile->gambaran_umum); ?></p>
                    </div>
               </div>

               <div class="col-12 col-md-6">
                    <div class="pe-lg-4">
                         <img src="<?= base_url('assets/v3/frontend/v2/') ?>img/bg-img/127.jpg" alt="">
                    </div>
               </div>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>
