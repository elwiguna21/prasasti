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
                         <li>Sejarah</li>
                    </ul>
               </div>
               <!-- Breadcrumb row END -->
          </div>
     </div>
</div>
<!-- inner page banner END -->

<div class="content-block">
     <!-- Your Faq -->
     <div class="section-full overlay-white-middle content-inner" style="background-image:url(images/pattern/pic1.jpg);">
          <div class="container">
               <div class="section-head text-black text-center">
                    <h4 class="text-gray-dark m-b10">Sejarah</h4>
                    <h2 class="box-title m-b10">Kearsipan Daerah Kabupaten Sumedang</h2>
                    <div class="dlab-separator bg-primary"></div>
               </div>
          </div>
     </div>

     <div class="section-full overlay-primary-dark bg-img-fix" style="background-image:url(images/background/bg1.jpg);">
          <div class="container">
               <div class="row">
                    <div class="col-lg-5 col-md-5 content-inner chosesus-content text-white">
                         <h2 class="box-title m-b15 wow fadeInLeft" data-wow-delay="0.2s">Sejarah<span class="bg-primary"></span></h2>
                         <p class="font-16 op8 wow fadeInLeft" data-wow-delay="0.4s">Lembaga Kearsipan Daerah Kabupaten Sumedang</p>
                         <h3 class="font-weight-500 m-b50 op6 wow fadeInLeft" data-wow-delay="0.6s">Dinas Arsip dan Perpustakaan Kabupaten Sumedang.</h3>
                         <div class="col-12 m-b30 wow fadeIn" data-wow-delay="0.2s">
                              <div class="faq-video">
                                   <a class="play-btn popup-youtube" href="https://www.youtube.com/embed/6lt2JfJdGSY">
                                        <i class="flaticon-play-button text-white"></i></a>
                                   <img src="<?= base_url('assets/v3/frontend/') ?>images/about/pic10.jpg" alt="" class="img-cover radius-sm">
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-7 col-md-7 m-b30">
                         <form class="inquiry-form wow fadeInUp dzForm" data-wow-delay="0.2s">

                              <h3 class="box-title m-t0 m-b10">Sejarah <span class="text-primary">Lembaga Kearsipan Daerah</span></h3>
                              <p><?= nl2br($profile->sejarah); ?></p>

                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>
