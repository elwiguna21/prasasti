<!-- inner page banner -->
<div class="dlab-bnr-inr overlay-primary" style="background-image:url(<?= base_url('assets/v3/frontend/images/banner/bnr2.jpg') ?>);">
     <div class="container">
          <div class="dlab-bnr-inr-entry">
               <h1 class="text-white">Gambaran Umum</h1>
               <!-- Breadcrumb row -->
               <div class="breadcrumb-row">
                    <ul class="list-inline">
                         <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                         <li><a href="<?= base_url('v2/frontend/profiles/vision') ?>">Profil</a></li>
                         <li>Gambaran Umum</li>
                    </ul>
               </div>
               <!-- Breadcrumb row END -->
          </div>
     </div>
</div>
<!-- inner page banner END -->

<div class="content-block">
     <div class="section-full content-inner-2">
          <div class="container">
               <div class="section-head text-black text-center">
                    <h4 class="text-gray-dark m-b10">Gambaran Umum</h4>
                    <h2 class="box-title m-tb0">Kearsipan Daerah <span class="text -primary">Kabupaten Sumedang</span></h2>
               </div>
          </div>
          <div class="container">
               <div class="row ">
                    <div class="col-lg-5 col-md-4 about-img wow fadeIn" data-wow-delay="0.4s">
                         <img src="<?= base_url('assets/v3/frontend/') ?>images/about/pic9.jpg" data-tilt alt="">
                    </div>
                    <div class="col-lg-7 col-md-8">
                         <div class="abuot-box left row m-lr0 wow fadeIn" data-wow-delay="0.6s">
                              <div class="col-lg-4">
                                   <h2 class="box-title m-tb0">Gambaran Umum<span class="bg-primary"></span></h2>
                                   <h4 class="text-gray-dark">Penyelenggaraan Kearsipan Daerah</h4>
                              </div>
                              <div class="col-lg-8">
                                   <p class="m-b0"><?= nl2br($profile->gambaran_umum); ?></p>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </div>

     <div class="section-full p-tb80 pt-0">
          <div class="container">
               <div class="row">
                    <div class="col-lg-12">
                         <div class="text-center m-auto ">
                              <div class="m-b20"><i class="fa fa-quote-left font-45 text-primary"></i></div>
                              <h4 class="text-uppercase font-weight-700 font-30">Tugas dan Fungsi Kearsipan Daerah Kabupaten Sumedang</h4>
                              <a href="<?= base_url('v2/frontend/profiles/jobdesc') ?>" class="site-button radius-xl outline outline-2"><span class="p-lr10">Lihat Tugas dan Fungsi</span></a>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
