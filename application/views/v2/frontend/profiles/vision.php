<!-- inner page banner -->
<div class="dlab-bnr-inr overlay-primary" style="background-image:url(<?= base_url('assets/v3/frontend/images/banner/bnr2.jpg') ?>);">
     <div class="container">
          <div class="dlab-bnr-inr-entry">
               <h1 class="text-white">Visi & Misi</h1>
               <!-- Breadcrumb row -->
               <div class="breadcrumb-row">
                    <ul class="list-inline">
                         <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                         <li><a href="javascript:void(0);">Profil</a></li>
                         <li>Visi & Misi</li>
                    </ul>
               </div>
               <!-- Breadcrumb row END -->
          </div>
     </div>
</div>
<!-- inner page banner END -->

<div class="content-block">
     <div class="section-ful our-about-info content-inner-1 wow fadeIn" data-wow-delay="0.4s" style="background-image:url(<?= base_url('assets/v3/frontend/') ?>images/background/bg-map.jpg); background-position:center; background-repeat:no-repeat;">
          <div class="container">
               <div class="section-head text-center">
                    <h4 class="text-gray-dark m-b10">Visi & Misi</h4>
                    <h2 class="box-title m-tb0">Kabupaten <span class="text-primary">Sumedang</span></h2>
                    <p>Kabupaten Sumedang terdiri atas 26 kecamatan, 7 kelurahan, dan 270 desa. Sumedang, ibu kota kabupaten ini, terletak sekitar 45 km dari Kota Bandung. Kota ini meliputi kecamatan Sumedang Utara dan Sumedang Selatan. Sumedang dilintasi jalur utama Bandung - Cirebon.</p>
               </div>
               <div class="row dzseth m-b30">
                    <div class="col-lg-6 col-md-6 m-b30 about-img wow fadeIn" data-wow-delay="0.8s">
                         <img src="<?= base_url('assets/v3/frontend/images/our-services/pic1.jpg') ?>" data-tilt alt="">
                    </div>
                    <div class="col-lg-6 col-md-6 m-b30 dis-tbl text-justify">
                         <div class="dis-tbl-cell">
                              <h3 class="box-title">Visi<span class="bg-primary"></span></h3>
                              <p class="font-16"><?= $profile->visi; ?></p>
                         </div>
                    </div>
               </div>
               <div class="row dzseth">
                    <div class="col-lg-6 col-md-6 dis-tbl text-justify">
                         <div class="dis-tbl-cell">
                              <h3 class="box-title">Misi<span class="bg-primary"></span></h3>
                              <p class="font-16"><?= nl2br($profile->misi); ?></p>
                         </div>
                    </div>
                    <div class="col-lg-6 col-md-6 about-img wow fadeIn" data-wow-delay="0.8s">
                         <img src="<?= base_url('assets/v3/frontend/images/our-services/pic2.jpg') ?>" data-tilt alt="">
                    </div>
               </div>
          </div>
     </div>
</div>
