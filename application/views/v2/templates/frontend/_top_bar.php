<!-- Header Area-->
<header class="header-area style-two">
     <!-- Header Top -->
     <div class="header-top">
          <div class="container h-100 d-flex align-items-center justify-content-between">
               <!-- Left Side -->
               <div class="left-side d-flex align-items-center gap-4 gap-lg-5">
                    <div class="d-flex align-items-center gap-2 text-white">
                         <i class="ti ti-mail-filled"></i>
                         <span class="d-none d-lg-block">disarpus@sumedangkab.go.id</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 text-white">
                         <i class="ti ti-map-pin-filled"></i>
                         <span class="d-none d-lg-block">Jl. Margamukti - Cimalaka, Kabupaten Sumedang.</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 text-white">
                         <i class="ti ti-phone"></i>
                         <span class="d-none d-lg-block">(0261) 201231</span>
                    </div>
               </div>

               <!-- Right Side -->
               <div class="right-side">
                    <!-- Social Icons -->
                    <div class="social-nav d-flex align-items-center gap-3">
                         <a href="#">
                              <i class="ti ti-brand-facebook"></i>
                         </a>
                         <a href="#">
                              <i class="ti ti-brand-x"></i>
                         </a>
                         <a href="#">
                              <i class="ti ti-brand-linkedin"></i>
                         </a>
                         <a href="#">
                              <i class="ti ti-brand-instagram"></i>
                         </a>
                    </div>
               </div>
          </div>
     </div>

     <nav class="navbar navbar-expand-lg">
          <div class="container">
               <!-- Navbar Brand -->
               <a class="navbar-brand" href="<?= base_url() ?>">
                    <img src="<?= base_url('assets/v3/frontend/v2/img/logo-prasasti2.png') ?>" alt="" height="36px"
                         style="height: 36px;">
                    <img src="<?= base_url('assets/v3/frontend/v2/img/teks-prasasti.png') ?>" alt=""
                         style="width: 156px;">
               </a>

               <!-- Navbar Toggler -->
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#softoraNav"
                    aria-controls="softoraNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti ti-category"></i>
               </button>

               <!-- Navbar Nav -->
               <div class="collapse navbar-collapse justify-content-between" id="softoraNav">
                    <ul class="navbar-nav navbar-nav-scroll">
                         <li class="softora-dd">
                              <a href="<?= base_url(); ?>" class="active">Beranda</a>
                         </li>
                         <li class="softora-dd">
                              <a href="javascript:void(0);">Profil <i class="ti ti-caret-down-filled"></i></a>
                              <ul class="softora-dd-menu">
                                   <li class="softora-dd"><a href="<?= base_url('profiles/vision') ?>"
                                             class="dez-page">Visi &amp; Misi </a></li>
                                   <li class="softora-dd"><a href="<?= base_url('profiles/about') ?>"
                                             class="dez-page">Gambaran Umum </a></li>
                                   <li class="softora-dd"><a href="<?= base_url('profiles/jobdesc') ?>"
                                             class="dez-page">Tugas &amp; Fungsi</a></li>
                                   <li class="softora-dd"><a href="<?= base_url('profiles/history') ?>"
                                             class="dez-page">Sejarah</a></li>
                                   <li class="softora-dd"><a href="<?= base_url('profiles/structure') ?>"
                                             class="dez-page">Struktur Organisasi</a></li>
                                   <!-- <li class="softora-dd">
                                        <a href="#">Service <i class="ti ti-caret-right-filled"></i></a>
                                        <ul class="softora-dd-menu">
                                             <li>
                                                  <a href="service.html">Service</a>
                                             </li>
                                             <li>
                                                  <a href="service-details.html">Service Details</a>
                                             </li>
                                        </ul>
                                   </li> -->
                              </ul>
                         </li>
                         <li class="softora-dd">
                              <a href="javascript:void(0);">Informasi <i class="ti ti-caret-down-filled"></i></a>
                              <ul class="softora-dd-menu">
                                   <li>
                                        <a href="<?= base_url('articles') ?>">Artikel</a>
                                   </li>
                                   <li>
                                        <a href="<?= base_url('news') ?>">Berita</a>
                                   </li>
                              </ul>
                         </li>
                         <li class="softora-dd">
                              <a href="javascript:void(0);">Layanan <i class="ti ti-caret-down-filled"></i></a>
                              <ul class="softora-dd-menu">
                                   <li>
                                        <a href="<?= base_url('services') ?>">Perbaikan Arsip</a>
                                   </li>
                              </ul>
                         </li>
                         <li class=" softora-dd">
                              <a href="javascript:void(0);">Kearsipan <i class="ti ti-caret-down-filled"></i></a>
                              <ul class="softora-dd-menu">
                                   <li>
                                        <a href="<?= base_url('archieves') ?>">Arsip Statis</a>
                                   </li>
                                   <li>
                                        <a href="<?= base_url('archieves/inventory') ?>">Inventaris Arsip</a>
                                   </li>
                                   <li>
                                        <a href="<?= base_url('archieves/guide') ?>">Guide Arsip</a>
                                   </li>
                              </ul>
                         </li>
                         <li class=" softora-dd">
                              <a href="<?= base_url('regulations') ?>">Peraturan</a>
                         </li>
                         <li class=" softora-dd">
                              <a href="<?= base_url('galleries') ?>">Galeri</a>
                         </li>
                    </ul>

                    <div class="d-flex align-items-center mt-4 mt-lg-0">
                         <!-- Button -->
                         <?php if (!empty($this->session->userdata('next-uid')) and !empty($this->session->userdata('next-uname'))) { ?>
                              <a href="<?= base_url('dashboards') ?>" class="btn btn-primary btn-sm align-middle">
                                   Dashboard <i class="ti ti-home-2 ms-2"></i>
                              </a>
                         <?php } else { ?>
                              <a href="<?= base_url('authentications') ?>" class="btn btn-primary btn-sm px-4">Sign In <i class="ti ti-login-2 ms-2"></i></a>
                         <?php } ?>

                    </div>
               </div>
          </div>
     </nav>
</header>
