<!-- header -->
<!-- <header class="site-header header-transparent mo-left"> -->
<header class="site-header header-transparent header mo-left">
     <div class="top-bar">
          <div class="container">
               <div class="row d-flex justify-content-between">
                    <div class="dlab-topbar-left">
                         <ul>
                              <li><i class="flaticon-phone-call m-r5"></i> (0261) 2200412</li>
                              <li><i class="ti-location-pin m-r5"></i> Jl. Margamukti - Cimakala, Kab. Sumedang</li>
                         </ul>
                    </div>
                    <div class="dlab-topbar-right">
                         <ul>
                              <!-- <li><i class="ti-skype m-r5"></i> Agency.software</li> -->
                              <li><i class="ti-email m-r5"></i> disarpus@sumedangkab.go.id</li>
                         </ul>
                    </div>
               </div>
          </div>
     </div>
     <!-- main header -->
     <div class="sticky-header main-bar-wraper navbar-expand-lg">
          <div class="main-bar clearfix">
               <div class="container clearfix">
                    <!-- website logo -->
                    <div class="logo-header mostion logo-dark">
                         <a href="<?= base_url('v2'); ?>" class="dez-page"><img src="<?= base_url('assets/v3/frontend/') ?>images/teks-prasasti2.png" alt=""></a>
                    </div>
                    <!-- nav toggle button -->
                    <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                         <span></span>
                         <span></span>
                         <span></span>
                    </button>
                    <!-- extra nav -->
                    <div class="extra-nav">
                         <div class="extra-cell">
                              <?php if (!empty($this->session->userdata('next-uid')) and !empty($this->session->userdata('next-uname'))) { ?>
                                   <a href="<?= base_url('v2/dashboards') ?>" class="dez-page site-button white">Ke Dashboard </a>
                              <?php } else { ?>
                                   <a href="<?= base_url('v2/authentications') ?>" class="dez-page site-button white">Sign In </a>
                              <?php } ?>
                         </div>
                    </div>
                    <!-- main nav -->
                    <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                         <ul class="nav navbar-nav">
                              <?php $current_uri = $this->uri->segment(3); ?>
                              <li class="<?= ($current_uri == 'home' || $current_uri == '') ? 'active' : ''; ?>"><a href="<?= base_url('v2') ?>">Beranda</a></li>
                              <li class="<?= ($current_uri == 'profiles') ? 'active' : ''; ?>"><a href="javascript:void(0);">Profil <i class="fa fa-chevron-down"></i></a>
                                   <ul class="sub-menu">
                                        <!-- <li><a href="<?= base_url('v2/frontend/profiles') ?>" class="dez-page">Sambutan </a></li> -->
                                        <li><a href="<?= base_url('v2/frontend/profiles/vision') ?>" class="dez-page">Visi &amp; Misi </a></li>
                                        <li><a href="<?= base_url('v2/frontend/profiles/about') ?>" class="dez-page">Gambaran Umum </a></li>
                                        <li><a href="<?= base_url('v2/frontend/profiles/jobdesc') ?>" class="dez-page">Tugas &amp; Fungsi</a></li>
                                        <li><a href="<?= base_url('v2/frontend/profiles/history') ?>" class="dez-page">Sejarah</a></li>
                                        <li><a href="<?= base_url('v2/frontend/profiles/structure') ?>" class="dez-page">Struktur Organisasi</a></li>
                                   </ul>
                              </li>
                              <li class="sub-menu-down <?= ($current_uri == 'news') ? 'active' : ''; ?>"><a href="javascript:void(0);">Informasi <i class="fa fa-chevron-down"></i></a>
                                   <ul class="sub-menu">
                                        <li><a href="<?= base_url('v2/frontend/news/articles') ?>" class="dez-page">Artikel</a></li>
                                        <li><a href="<?= base_url('v2/frontend/news') ?>" class="dez-page">Berita </a></li>
                                   </ul>
                              </li>
                              <li class="sub-menu-down <?= ($current_uri == 'services') ? 'active' : ''; ?>"><a href="javascript:void(0);">Layanan <i class="fa fa-chevron-down"></i></a>
                                   <ul class="sub-menu">
                                        <li><a href="<?= base_url('v2/services') ?>" class="dez-page">Perbaikan Arsip</a></li>
                                   </ul>
                              </li>
                              <li class="sub-menu-down <?= ($current_uri == 'archieves') ? 'active' : ''; ?>">
                                   <a href="javascript:void(0);">Arsip Statis <i class="fa fa-chevron-down"></i></a>
                                   <ul class="sub-menu">
                                        <li><a href="<?= base_url('v2/frontend/archieves') ?>" class="dez-page">Arsip Statis</a></li>
                                        <li><a href="<?= base_url('v2/frontend/archieves/inventory') ?>" class="dez-page">Inventaris Arsip</a></li>
                                        <li><a href="<?= base_url('v2/frontend/archieves/guide') ?>" class="dez-page">Guide Arsip</a></li>
                                   </ul>
                              </li>
                              <li class="<?= ($current_uri == 'regulations') ? 'active' : ''; ?>"><a href="<?= base_url('v2/frontend/regulations') ?>" class="dez-page">Peraturan</a></li>
                              <li class="<?= ($current_uri == 'galleries') ? 'active' : ''; ?>"><a href="<?= base_url('v2/frontend/galleries'); ?>" class="dez-page">Galeri</a></li>
                         </ul>
                    </div>
               </div>
          </div>
     </div>
     <!-- main header END -->
</header>
<!-- header END -->
