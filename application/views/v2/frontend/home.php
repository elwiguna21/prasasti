<!-- Slider Banner -->
<div class="owl-slider-banner">
     <div class="owl-slider owl-carousel owl-theme owl-none">
          <?php if (!empty($banners)) {
               foreach ($banners as $banner) { ?>
                    <div class="item slide-item">
                         <div class="slide-item-img"><img src="<?= $banner->file ?>" class="" alt="<?= $banner->caption ?>"></div>
                         <div class="slide-content overlay-primary">
                              <!-- <div class="slide-content-box container">
                                   <div class="max-w600 text-white">
                                        <h2 class="text-white font-weight-400"><?= $banner->caption; ?>. <br></h2>
                                        <p>We are passionate of deep understanding of management and communication and how to interact with the digital world is the true value we provide. We help you in all the stages of realization of your digital products.</p>
                                        <a href="javascript:void(0);" class="site-button m-r10 white button-lg">Get Started</a>
                                        <a href="javascript:void(0);" class="site-button outline outline-2 button-lg">How It Work</a>
                                   </div>
                              </div> -->
                         </div>
                    </div>
          <?php }
          } ?>

     </div>
     <!-- Service -->
     <div class="service-box-slide">
          <div class="container">
               <div class="row">
                    <div class="col-lg-12">
                         <div class="img-carousel-content owl-carousel text-center text-white owl-none ">
                              <div class="item">
                                   <div class="icon-bx-wraper bx-style-1 p-a20 radius-sm">
                                        <div class="icon-content">
                                             <h5 class="dlab-tilte">
                                                  <span class="icon-sm"><i class="flaticon-notebook"></i></span>
                                                  Validation
                                             </h5>
                                             <p>Helping you identify the <br> opportunities</p>
                                        </div>
                                   </div>
                              </div>
                              <div class="item">
                                   <div class="icon-bx-wraper bx-style-1 p-a20 radius-sm">
                                        <div class="icon-content">
                                             <h5 class="dlab-tilte">
                                                  <span class="icon-sm"><i class="flaticon-file"></i></span>
                                                  Documentation
                                             </h5>
                                             <p>Helping you with the Initial <br> paperwork</p>
                                        </div>
                                   </div>
                              </div>
                              <div class="item">
                                   <div class="icon-bx-wraper bx-style-1 p-a20 radius-sm">
                                        <div class="icon-content">
                                             <h5 class="dlab-tilte">
                                                  <span class="icon-sm"><i class="flaticon-devices"></i></span>
                                                  Development
                                             </h5>
                                             <p>Mobile App or Website, we <br> build the MVP</p>
                                        </div>
                                   </div>
                              </div>
                              <div class="item">
                                   <div class="icon-bx-wraper bx-style-1 p-a20 radius-sm">
                                        <div class="icon-content">
                                             <h5 class="dlab-tilte">
                                                  <span class="icon-sm"><i class="flaticon-rocket-ship"></i></span>
                                                  Launching
                                             </h5>
                                             <p>Product & the news, we launch <br> with a buzz</p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- Service End -->
</div>
<!-- Slider Banner -->
<div class="content-block">
     <!-- About Us -->
     <div class="section-full bg-white content-inner-1 about-us" data-wow-delay="0.4s">
          <div class="container">
               <div class="row ">
                    <div class="col-lg-7 col-md-8">
                         <div class="abuot-box row wow fadeIn" data-wow-delay="0.6s">
                              <div class="col-lg-4">
                                   <h2 class="box-title m-t0 m-b10">Tentang<span class="bg-primary"></span></h2>
                                   <h4 class="text-gray-dark">PRASASTI</h4>
                              </div>
                              <div class="col-lg-8">
                                   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMak.</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-5 col-md-4 about-img wow fadeIn" data-wow-delay="0.4s">
                         <img src="https://sisemar.sumedangkab.go.id/assets/upload/9836a82e268987c78e8393174f0cb605.jpg" data-tilt alt="Arsip" style="min-height: 500px;">
                    </div>
               </div>
          </div>
     </div>
     <!-- About Us End -->
     <!-- Our Services -->
     <div class="section-full content-inner-2 wow fadeInLeft" data-wow-delay="0.4s">
          <div class="container">
               <div class="section-head text-black text-center wow fadeIn" data-wow-delay="0.4s">
                    <h4 class="text-gray-dark m-b10">Layanan</h4>
                    <h2 class="box-title m-tb0">Perbaikan <span class="text-primary">Arsip</span></h2>
                    <p>Ikuti langkah dibawah ini untuk menggunakan layanan perbaikan arsip anda yang rusak.</p>
               </div>
          </div>
          <div class="development-box">
               <div class="container">
                    <div class="img-carousel-content owl-carousel owl-none wow fadeIn" data-wow-delay="0.4s">
                         <div class="item">
                              <div class="box-item-service text-center">
                                   <div class="item-service-content m-b40">
                                        <h5>Ajukan Permohonan</h5>
                                        <p class="m-b0">Ajukan permohonan perbaikan arsip dengan melengkapi form yang telah disediakan.</p>
                                   </div>
                                   <div class="clearfix">
                                        <span class="text-primary round-center"></span>
                                   </div>
                                   <div class="icon-bx-md radius border-1 m-t40 m-b20">
                                        <span class="icon-cell"><i class="flaticon-devices"></i></span>
                                   </div>
                                   <a href="<?= base_url('v2/services') ?>" class="site-button outline outline-2"><span class="font-weight-500">Selengkapnya</span></a>
                              </div>
                         </div>
                         <div class="item">
                              <div class="box-item-service text-center">
                                   <div class="icon-bx-md radius border-1 m-b20 m-t0">
                                        <span class="icon-cell"><i class="flaticon-pen"></i></span>
                                   </div>
                                   <a href="<?= base_url('v2/services') ?>" class="site-button outline outline-2 m-b40"><span class="font-weight-500">Selengkapnya</span></a>
                                   <div class="clearfix">
                                        <span class="text-primary round-center"></span>
                                   </div>
                                   <div class="item-service-content m-t40">
                                        <h5>Verifikasi Permohonan</h5>
                                        <p class="m-b0">Ajuan permohonan perbaikan arsip anda akan segera kami verifikasi.</p>
                                   </div>
                              </div>
                         </div>
                         <div class="item">
                              <div class="box-item-service text-center">
                                   <div class="item-service-content m-b40">
                                        <h5>Proses Permohonan</h5>
                                        <p class="m-b0">Setelah diverifikasi, kami akan segera menghubungi anda untuk proses lebih lanjut.</p>
                                   </div>
                                   <div class="clearfix">
                                        <span class="text-primary round-center"></span>
                                   </div>
                                   <div class="icon-bx-md radius border-1 m-t40 m-b20">
                                        <span class="icon-cell"><i class="flaticon-smartphone"></i></span>
                                   </div>
                                   <a href="<?= base_url('v2/services') ?>" class="site-button outline outline-2"><span class="font-weight-500">Selengkapnya</span></a>
                              </div>
                         </div>
                         <div class="item">
                              <div class="box-item-service text-center">
                                   <div class="icon-bx-md radius border-1 m-b20 m-t0">
                                        <span class="icon-cell"><i class="flaticon-team"></i></span>
                                   </div>
                                   <a href="" class="site-button outline outline-2 m-b40"><span class="font-weight-500">Read More</span></a>
                                   <div class="clearfix">
                                        <span class="text-primary round-center"></span>
                                   </div>
                                   <div class="item-service-content m-t40">
                                        <h5>Layanan Selesai</h5>
                                        <p class="m-b0">Setelah kami proses, anda akan menerima arsip terbaru dan layanan terselesaikan.</p>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- Our Services -->

     <div class="section-full facility bg-gray wow fadeInLeft" data-wow-delay="0.4s">
          <div class="row m-a0">
               <div class="col-lg-4 col-md-12 col-sm-12 p-a0">
                    <div class="icon-bx-wraper left bg-primary text-white p-a70 dlab-box-icon">
                         <div class="icon-lg">
                              <div class="icon-cell">
                                   <div>
                                        <span>
                                             <i class="ti-check-box"></i>
                                             <i class="ti-check-box"></i>
                                        </span>
                                   </div>
                              </div>
                         </div>
                         <div class="icon-content">
                              <h4 class="dlab-tilte">Cepat &amp; Mudah</h4>
                              <p>Dapatkan informasi kearsipan daerah dengan mudah dan cepat serta dapat diakses kapanpun dan dimanapun.</p>
                         </div>
                    </div>
               </div>
               <div class="col-lg-4 col-md-12 col-sm-12 p-a0">
                    <div class="icon-bx-wraper left p-a70 dlab-box-icon">
                         <div class="icon-lg">
                              <div class="icon-cell">
                                   <div>
                                        <span>
                                             <i class="ti-user"></i>
                                             <i class="ti-user"></i>
                                        </span>
                                   </div>
                              </div>
                         </div>
                         <div class="icon-content">
                              <h4 class="dlab-tilte">Tim Kearsipan</h4>
                              <p>Kami memiliki tim yang handal untuk mengelola kearsipan daerah serta menangani layanan perbaikan arsip yang rusak.</p>
                         </div>
                    </div>
               </div>
               <div class="col-lg-4 col-md-12 col-sm-12 p-a0">
                    <div class="icon-bx-wraper left bg-primary text-white p-a70 dlab-box-icon">
                         <div class="icon-lg">
                              <div class="icon-cell">
                                   <div>
                                        <span>
                                             <i class="ti-headphone-alt"></i>
                                             <i class="ti-headphone-alt"></i>
                                        </span>
                                   </div>
                              </div>
                         </div>
                         <div class="icon-content">
                              <h4 class="dlab-tilte">24/7 Bantuan</h4>
                              <p>Jika anda mengalami kesulitan atau memiliki pertanyaan, kami akan segera membantu anda.</p>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="section-full content-inner bg-img-fix bg-img-fix" style="background-image:url(<?= base_url('assets/v3/frontend/') ?>images/background/bg12.jpg);" data-wow-delay="0.4s">
          <div class="container">
               <div class="row m-b30">
                    <div class="col-lg-4 col-md-12 align-self-center wow fadeInLeft" data-wow-delay="0.2s">
                         <h5>Statistik</h5>
                         <h2 class="font-weight-700">Kearsipan Kabupaten Sumedang</h2>
                    </div>
                    <div class="col-lg-8 col-md-12">
                         <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-6 wow fadeIn" data-wow-delay="0.2s">
                                   <div class="icon-bx-wraper bx-style-1 p-tb30 p-lr20 m-b30 center br-col-b1 bg-white">
                                        <h2 class="counter font-45"><?= number_format($archieve_total, 0, ',', '.'); ?></h2>
                                        <div class="icon-content">
                                             <h5 class="font-weight-500">Arsip</h5>
                                             <p class="m-b0 font-14">Total arsip di Kabupaten Sumedang.</p>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                                   <div class="icon-bx-wraper bx-style-1 p-tb30 p-lr20 m-b30 center br-col-b1 bg-white">
                                        <h2 class="counter font-45"><?= number_format($archieve_vital, 0, ',', '.'); ?></h2>
                                        <div class="icon-content">
                                             <h5 class="font-weight-500">Arsip Vital</h5>
                                             <p class="m-b0 font-14">Total arsip vital di Kabupaten Sumedang.</p>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12 wow fadeIn" data-wow-delay="0.6s">
                                   <div class="icon-bx-wraper bx-style-1 p-tb30 p-lr20 m-b30 center br-col-b1 bg-white">
                                        <h2 class="counter font-45"><?= number_format($archieve_usul, 0, ',', '.'); ?></h2>
                                        <div class="icon-content">
                                             <h5 class="font-weight-500">Arsip Usul Serah</h5>
                                             <p class="m-b0 font-14">Total arsip usul serah di Kabupaten Sumedang.</p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 m-b30 wow fadeIn" data-wow-delay="0.2s">
                         <img src="<?= base_url('assets/v3/frontend/') ?>images/about/about1.jpg" class="radius-sm" alt="">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 m-b30 wow fadeIn" data-wow-delay="0.4s">
                         <img src="<?= base_url('assets/v3/frontend/') ?>images/about/about2.jpg" class="radius-sm" alt="">
                    </div>
               </div>
          </div>
     </div>

     <div class="section-full m-t50 bg-gray wow fadeInRight" data-wow-delay="0.4s">
          <div class="row dzseth">
               <div class="col-lg-12 d-flex mb-4 mb-md-4 mb-lg-0 wow fadeInLeft" data-wow-delay="0.4s">
                    <div class="chart-box align-self-stretch d-flex">
                         <canvas id="archieve-canvas" style="height:500px;" class="align-self-center"></canvas>
                    </div>
               </div>
          </div>
     </div>

     <!-- <div class="section-full content-inner-2 bg-primary bg-img-fix overlay-primary tax-info-chart wow fadeInRight" style="background-image:url(https://sisemar.sumedangkab.go.id/assets/upload/dfb48aa48022cfb8c22bc0bad2974f0c.jpg);" data-wow-delay="0.4s">
          <div class="container">
               <div class="row dzseth">
                    <div class="col-lg-12 d-flex mb-4 mb-md-4 mb-lg-0 wow fadeInLeft" data-wow-delay="0.4s">
                         <div class="chart-box align-self-stretch d-flex">
                              <canvas id="archieve-canvas" style="height:500px;" class="align-self-center"></canvas>
                         </div>
                    </div>
               </div>
          </div>
     </div> -->

     <div class="section-full content-inner bg-img-fix wow fadeInRight" style="background-image:url(<?= base_url('assets/v3/frontend/') ?>images/background/bg14.jpg);" data-wow-delay="0.4s">
          <div class="container">
               <div class="row">
                    <div class="col-md-12 text-center section-head">
                         <h2 class="font-weight-700 m-b0">Berita Terbaru</h2>
                         <p class="m-b0">Lihat berita selengkapnya <a href="<?= base_url('v2/frontend/news') ?>" class="text-primary font-weight-500">disini</a>.</p>
                    </div>
               </div>
               <div class="row">
                    <div class="col-md-12 m-b0">
                         <div class="blog-carousel owl-carousel owl-btn-center-lr owl-btn-3 owl-theme owl-btn-center-lr owl-btn-1">
                              <?php if (!empty($news)) {
                                   foreach ($news as $new) { ?>
                                        <div class="item">
                                             <div class="blog-post blog-grid blog-rounded blog-effect1">
                                                  <div class="dlab-post-media dlab-img-effect ">
                                                       <a href="<?= base_url('v2/frontend/news/detail?slug=' . $new->slug); ?>"><img src="https://sisemar.sumedangkab.go.id/assets/upload/<?= $new->gambar; ?>" alt="<?= $new->judul; ?>" style="height: 200px; object-fit: cover;">
                                                       </a>
                                                  </div>
                                                  <div class="dlab-info p-a20 border-1">
                                                       <div class="dlab-post-title ">
                                                            <h5 class="post-title font-weight-500">
                                                                 <a href="<?= base_url('v2/frontend/news/detail?slug=' . $new->slug); ?>"><?= $new->judul; ?></a>
                                                            </h5>
                                                       </div>
                                                       <div class=" dlab-post-meta ">
                                                            <ul>
                                                                 <li class=" post-date"> <i class="fa fa-comments"></i><strong><?= $new->tanggal; ?></strong></li>
                                                                 <li class="post-author"><i class="fa fa-user"></i><a href="javascript:void(0);">Admin</a> </li>
                                                            </ul>
                                                       </div>
                                                       <div class="dlab-post-text">
                                                            <p><?= mb_substr($new->isi, 0, 75) ?> ..</p>
                                                       </div>
                                                       <div class="dlab-post-readmore">
                                                            <a href="<?= base_url('v2/frontend/news/detail?slug=' . $new->slug); ?>" title="Selengkapnya" rel="bookmark" class="site-button-link black outline">Selengkapnya <i class="ti-arrow-right"></i></a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                              <?php }
                              } ?>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="section-full bg-white content-inner-1 portfolio">
          <div class="container-fluid p-0">
               <div class="max-w600 m-auto text-center m-b30 wow fadeInLeft" data-wow-delay="0.4s">
                    <!-- <h6 class="m-t0">Artikel</h6> -->
                    <h2 class="m-t0 m-b0">Artikel Terbaru</h2>
                    <p class="m-b30">Lihat artikel selengkapnya <a href="<?= base_url('v2/frontend/articles') ?>" class="text-primary font-weight-500">disini</a>.</p>
               </div>
               <div class="clearfix">
                    <ul id="masonry" class="row dlab-gallery-listing gallery-grid-4 gallery mfp-gallery port-style1  g-0 wow fadeInRight" data-wow-delay="0.4s">
                         <?php if (!empty($articles)) {
                              foreach ($articles as $article) { ?>
                                   <li class="advertising branding photography card-container col-lg-3 col-md-6 col-xs-6 col-sm-6 p-a0 wow zoomIn" data-wow-delay="0.2s">
                                        <div class="dlab-box dlab-gallery-box">
                                             <div class="dlab-media dlab-img-overlay1 dlab-img-effect dlab-img-effect ">
                                                  <a href="<?= base_url('v2/frontend/news/articles_detail?=slug' . $article->slug); ?>"> <img src="https://sisemar.sumedangkab.go.id/assets/upload/<?= $article->gambar; ?>" alt="<?= $article->judul; ?>" style="width: 100%; height: 360px !important; object-fit: cover;">
                                                       <div class="overlay-bx">
                                                            <div class="overlay-icon align-b text-white">
                                                                 <div class="text-white text-left port-box">
                                                                      <h5><?= $article->judul; ?></h5>
                                                                      <p><?= mb_substr($new->isi, 0, 30) ?> ..</p>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </a>
                                             </div>
                                        </div>
                                   </li>
                         <?php }
                         } ?>
                    </ul>
               </div>
          </div>
     </div>

     <!-- Our Portfolio -->
     <div class="section-full content-inner-1 mfp-gallery wow fadeIn mb-5" data-wow-delay="0.4s">
          <div class="container-fluid">
               <div class="section-head text-center">
                    <h4 class="text-gray-dark m-b10">Tim</h4>
                    <h2 class="box-title m-t0 m-b15">Lembaga Kearsipan Daerah<span class="bg-primary"></span></h2>
                    <h5>KABUPATEN SUMEDANG</h5>
               </div>
               <div class="portfolio-carousel owl-carousel owl-none">
                    <div class="item">
                         <div class="dlab-box portfolio-box">
                              <div class="dlab-media dlab-img-effect dlab-img-overlay1"> <img src="<?= base_url('assets/v3/frontend/') ?>images/project/pic1.jpg" alt="">
                                   <div class="dlab-info-has p-a15 bg-primary">
                                        <!-- <a href="javascript:void(0);" class="site-button outline radius-xl white">Wordpress</a> -->
                                        <a href="<?= base_url('v2/profiles/structure') ?>" class="site-button outline radius-xl white float-end">Lihat</a>
                                   </div>
                                   <div class="overlay-bx">
                                        <div class="overlay-icon text-white">
                                             <h5>Website Name</h5>
                                             <p class="m-b10">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots</p>
                                             <a href="<?= base_url('assets/v3/frontend/') ?>images/project/pic1.jpg" class="mfp-link" title="Title Come Here"> <i class="ti-fullscreen icon-bx-xs"></i> </a>
                                             <a href="<?= base_url('v2/profiles/structure') ?>" target="bank"><i class="ti-arrow-top-right icon-bx-xs"></i></a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="item">
                         <div class="dlab-box portfolio-box">
                              <div class="dlab-media dlab-img-effect dlab-img-overlay1"> <img src="<?= base_url('assets/v3/frontend/') ?>images/project/pic2.jpg" alt="">
                                   <div class="dlab-info-has p-a15 bg-primary">
                                        <a href="javascript:void(0);" class="site-button outline radius-xl white">Wordpress</a>
                                        <a href="javascript:void(0);" class="site-button outline radius-xl white float-end">Vist Site</a>
                                   </div>
                                   <div class="overlay-bx">
                                        <div class="overlay-icon text-white">
                                             <h5>Website Name</h5>
                                             <p class="m-b10">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots</p>
                                             <a href="<?= base_url('assets/v3/frontend/') ?>images/project/pic1.jpg" class="mfp-link" title="Title Come Here"> <i class="ti-fullscreen icon-bx-xs"></i> </a>
                                             <a href="https://www.google.com/" target="bank"><i class="ti-arrow-top-right icon-bx-xs"></i></a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="item">
                         <div class="dlab-box portfolio-box">
                              <div class="dlab-media dlab-img-effect dlab-img-overlay1"> <img src="<?= base_url('assets/v3/frontend/') ?>images/project/pic3.jpg" alt="">
                                   <div class="dlab-info-has p-a15 bg-primary">
                                        <a href="javascript:void(0);" class="site-button outline radius-xl white">Wordpress</a>
                                        <a href="javascript:void(0);" class="site-button outline radius-xl white float-end">Vist Site</a>
                                   </div>
                                   <div class="overlay-bx">
                                        <div class="overlay-icon text-white">
                                             <h5>Website Name</h5>
                                             <p class="m-b10">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots</p>
                                             <a href="<?= base_url('assets/v3/frontend/') ?>images/project/pic1.jpg" class="mfp-link" title="Title Come Here"> <i class="ti-fullscreen icon-bx-xs"></i> </a>
                                             <a href="https://www.google.com/" target="bank"><i class="ti-arrow-top-right icon-bx-xs"></i></a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="item">
                         <div class="dlab-box portfolio-box">
                              <div class="dlab-media dlab-img-effect dlab-img-overlay1"> <img src="<?= base_url('assets/v3/frontend/') ?>images/project/pic4.jpg" alt="">
                                   <div class="dlab-info-has p-a15 bg-primary">
                                        <a href="javascript:void(0);" class="site-button outline radius-xl white">Wordpress</a>
                                        <a href="javascript:void(0);" class="site-button outline radius-xl white float-end">Vist Site</a>
                                   </div>
                                   <div class="overlay-bx">
                                        <div class="overlay-icon text-white">
                                             <h5>Website Name</h5>
                                             <p class="m-b10">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots</p>
                                             <a href="<?= base_url('assets/v3/frontend/') ?>images/project/pic1.jpg" class="mfp-link" title="Title Come Here"> <i class="ti-fullscreen icon-bx-xs"></i> </a>
                                             <a href="https://www.google.com/" target="bank"><i class="ti-arrow-top-right icon-bx-xs"></i></a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- Our Portfolio END -->

     <div class="section-full add-to-call bg-primary p-tb30">
          <div class="container">
               <div class="d-lg-flex d-sm-block justify-content-between align-items-center">
                    <h2 class="m-b10 m-t10 text-white">Ajukan perbaikan arsip yang rusak</h2>
                    <div><a href="<?= base_url('v2/frontend/services') ?>" class="site-button button-md white">Ajukan Sekarang <i class="fa fa-upload ms-2"></i></a></div>
               </div>
          </div>
     </div>
</div>
<!-- contact area END -->

<script src="<?= base_url('assets/v3/frontend/') ?>plugins/chart/Chart.bundle.js"></script>
<!-- <script src="<?= base_url('assets/v3/frontend/') ?>plugins/chart/charts.js"></script> -->
<script src="<?= base_url('assets/v3/frontend/') ?>plugins/chart/utils.js"></script>
<script>
     var config = {
          type: 'bar',
          data: {
               labels: <?= json_encode($archieve_arr['labels']) ?>,
               datasets: [{
                    label: 'Jumlah Arsip',
                    fill: false,
                    borderColor: window.chartColors.red,
                    backgroundColor: window.chartColors.red,
                    data: <?= json_encode($archieve_arr['datasets']) ?>
               }]
          },
          options: {
               responsive: true,
               title: {
                    display: true,
                    text: 'Grafik Total Arsip Berdasarkan SKPD'
               },
               scales: {
                    xAxes: [{
                         display: true,
                         ticks: {
                              callback: function(dataLabel, index) {
                                   // Hide the label of every 2nd dataset. return null to hide the grid line too
                                   return index % 2 === 0 ? dataLabel : '';
                              }
                         }
                    }],
                    yAxes: [{
                         display: true,
                         beginAtZero: false
                    }]
               }
          }
     };

     window.onload = function() {
          var ctx = document.getElementById('archieve-canvas').getContext('2d');
          window.myLine = new Chart(ctx, config);
     };
</script>
