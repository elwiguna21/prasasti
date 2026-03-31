<!-- inner page banner -->
<div class="dlab-bnr-inr overlay-primary" style="background-image:url(<?= base_url('assets/v3/frontend/images/banner/bnr2.jpg') ?>);">
     <div class="container">
          <div class="dlab-bnr-inr-entry">
               <h1 class="text-white">Sejarah</h1>
               <!-- Breadcrumb row -->
               <div class="breadcrumb-row">
                    <ul class="list-inline">
                         <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                         <li><a href="<?= base_url('v2/frontend/profiles/vision') ?>">Profil</a></li>
                         <li>Struktur Organisasi</li>
                    </ul>
               </div>
               <!-- Breadcrumb row END -->
          </div>
     </div>
</div>
<!-- inner page banner END -->

<div class="content-block">
     <div class="section-ful our-about-info content-inner-1 wow fadeIn " data-wow-delay="0.4s" style="background-image:url(<?= base_url('assets/v3/frontend/') ?>images/background/bg-map.jpg); background-position:center; background-repeat:no-repeat;">
          <div class="container">
               <div class="section-head text-center">
                    <h2 class="box-title m-tb0">Struktur <span class="text-primary">Organisasi</span></h2>
                    <p> Dinas Arsip dan Perpustakaan Kabupaten Sumedang</p>
               </div>
               <div class="row dzseth m-b30">
                    <div class="col-lg-6 col-md-6 m-b30 about-img wow fadeIn " data-wow-delay="0.8s">
                         <img src="<?= base_url('assets/v3/frontend/') ?>images/our-services/pic1.jpg" data-tilt alt="">
                    </div>
                    <div class="col-lg-6 col-md-6 m-b30 dis-tbl text-justify">
                         <div class="dis-tbl-cell">
                              <!-- <h3 class="box-title">Mision<span class="bg-primary"></span></h3> -->
                              <p class="font-16 text-justify"><?= nl2br($profile->struktur_organisasi) ?></p>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
