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
