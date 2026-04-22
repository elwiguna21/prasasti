<div class="breadcrumb-section bg-img" style="background-image: url('<?= base_url('assets/v3/frontend/v2/') ?>img/bg-img/90.jpg');">
     <div class="container">
          <!-- Breadcrumb Content -->
          <div class="breadcrumb-content">
               <div class="divider"></div>
               <h2>Sejarah</h2>
               <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <li>Sejarah</li>
               </ul>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>

<section class="about-section">
     <!-- Right Shape -->
     <div class="right-shape">
          <img src="assets/img/core-img/shape.png" alt="">
     </div>

     <!-- Divider -->
     <div class="divider"></div>

     <div class="container">
          <div class="row g-5 align-items-center">
               <div class="col-12 col-lg-6">
                    <!-- About Content -->
                    <div class="about-content ps-md-4">
                         <div class="section-heading">
                              <span class="sub-title">Sejarah</span>
                              <h2 class="mb-4">Lembaga Kearsipan Daerah <span class="text-blue">Kabupaten Sumedang</span></h2>
                              <p class="text-justify mb-5"><?= nl2br($profile->sejarah); ?></p>
                         </div>
                    </div>
               </div>

               <div class="col-12 col-lg-6">
                    <!-- About Video -->
                    <div class="about-video-content wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
                         <img src="<?= base_url('assets/v3/frontend/v2/') ?>img/bg-img/25.jpg" alt="">

                         <!-- Play Video -->
                         <div class="play-video-btn video-btn" data-video="https://youtu.be/4GUFkrHvZdE">
                              <div class="icon">
                                   <i class="ti ti-player-play-filled"></i>
                              </div>
                         </div>
                    </div>

                    <!-- About Images -->
                    <div class="about-images d-flex px-5 mt-5 wow fadeInUp" data-wow-duration="1000ms"
                         data-wow-delay="800ms">
                         <div>
                              <img class="w-100" src="<?= base_url('assets/v3/frontend/v2/') ?>img/bg-img/26.jpg" alt="">
                         </div>
                         <div>
                              <svg class="rotatingImage" xmlns="http://www.w3.org/2000/svg" width="70" height="70"
                                   viewBox="0 0 70 70" fill="none">
                                   <path
                                        d="M35 0L46.1369 23.8631L70 35L46.1369 46.1369L35 70L23.8631 46.1369L0 35L23.8631 23.8631L35 0Z"
                                        fill="#222222" />
                              </svg>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</section>
