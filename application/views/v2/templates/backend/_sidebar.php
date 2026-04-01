<!--**********************************
            Sidebar start
        ***********************************-->
<div class="deznav">
     <div class="deznav-scroll">
          <ul class="metismenu" id="menu">
               <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                         <i class="flaticon-381-networking"></i>
                         <span class="nav-text">Dashboard</span>
                    </a>
                    <ul aria-expanded="false">
                         <li><a href="<?= base_url('v2/backend/dashboards') ?>">Dashboard</a></li>
                         <li><a href="page-analytics.html">Analytics</a></li>
                         <li><a href="page-review.html">Review</a></li>
                         <li><a href="page-order.html">Order</a></li>
                         <li><a href="page-order-list.html">Order List</a></li>
                         <li><a href="page-general-customers.html">General Customers</a></li>
                    </ul>
               </li>
               <?php if ($this->session->userdata('next-role') === 'admin') : ?>
                    <li>
                         <a class="ai-icon" href="<?= base_url('v2/backend/users') ?>">
                              <i class="flaticon-381-user-9"></i>
                              <span class="nav-text">Daftar Pengguna</span>
                              <span class="badge badge-xs badge-success">New</span>
                         </a>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                              <i class="flaticon-381-notepad"></i>
                              <span class="nav-text">Data Umum</span>
                         </a>
                         <ul aria-expanded="false">
                              <li><a href="<?= base_url('v2/backend/artikels') ?>">Artikel</a></li>
                              <li><a href="<?= base_url('v2/backend/beritas') ?>">Berita</a></li>
                              <li><a href="<?= base_url('v2/backend/banners') ?>">Banner</a></li>
                              <li><a href="<?= base_url('v2/backend/galeris') ?>">Galeri</a></li>
                              <li><a href="<?= base_url('v2/backend/faqs') ?>">FAQ</a></li>
                              <li><a href="<?= base_url('v2/backend/links') ?>">Link</a></li>
                              <li><a href="<?= base_url('v2/backend/peraturans') ?>">Peraturan</a></li>
                              <li><a href="<?= base_url('v2/backend/inventarisarsips') ?>">Inventaris Arsip</a></li>
                              <li><a href="<?= base_url('v2/backend/arsipstatiss') ?>">Daftar Arsip Statis</a></li>
                              <li><a href="<?= base_url('v2/backend/guidearsips') ?>">Guide Arsip</a></li>
                              <li><a href="<?= base_url('v2/backend/materipaparans') ?>">Materi/Paparan</a></li>
                              <li><a href="<?= base_url('v2/backend/profils') ?>">Profil</a></li>
                         </ul>
                    </li>
               <?php endif; ?>
               <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                         <i class="flaticon-381-folder-14"></i>
                         <span class="nav-text">Alih Media</span>
                    </a>
                    <ul aria-expanded="false">
                         <li><a href="<?= base_url('v2/backend/alih_media_arsip_vital') ?>">Alih Media Arsip Vital</a></li>
                         <li><a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah') ?>">Alih Media Arsip Usul Serah</a></li>
                    </ul>
               </li>
               <?php if (in_array($this->session->userdata('next-role'), ['kepala_lkd', 'verifikator_lkd'])): ?>
               <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                         <i class="flaticon-381-folder-14"></i>
                         <span class="nav-text">Arsip Usul Serah</span>
                    </a>
                    <ul aria-expanded="false">
                         <li><a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah') ?>">Daftar Berkas</a></li>
                         <?php if ($this->session->userdata('next-role') === 'kepala_lkd'): ?>
                         <li>
                              <a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah/tanda_tangan') ?>">
                                   <i class="fas fa-pen-nib me-1 text-primary"></i> Tanda Tangan
                                   <span class="badge badge-xs badge-primary ms-1">TTE</span>
                              </a>
                         </li>
                         <?php endif; ?>
                    </ul>
               </li>
               <?php endif; ?>
               <li>
                    <a href="<?= base_url('v2/backend/users/profiles') ?>" class="ai-icon"><i class="flaticon-381-user-4"></i>
                         <span class="nav-text">Profil</span>
                         <span class="badge badge-xs badge-success">New</span>
                    </a>
               </li>

          </ul>

          <div class="add-menu-sidebar">
               <!-- <img src="<?= base_url('assets/v3/backend/images/icon1.png') ?>" alt=""> -->
               <p>Anda ingi ke halaman utama?</p>
               <a href="<?= base_url('v2/frontend/home') ?>" class="btn bg-white">
                    <i class="flaticon-381-home-2"></i>
                    <span class="ms-2">Beranda</span>
               </a>
          </div>
          <div class="copyright">
               <p><strong>PRASASTI</strong> © 2026. All Rights Reserved</p>
               <p>Made with <span class="heart"></span> by <a href="https://disarpus.sumedangkab.go.id" target="_blank">Dinas Arsip &amp; Perpustakaan Kabupaten Sumedang</a></p>
          </div>
     </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->
