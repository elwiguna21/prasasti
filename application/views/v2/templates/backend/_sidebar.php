<!--**********************************
            Sidebar start
        ***********************************-->
<div class="deznav">
     <div class="deznav-scroll">
          <ul class="metismenu" id="menu">
               <li>
                    <a class="ai-icon" href="<?= base_url('v2/dashboards') ?>">
                         <i class="flaticon-381-networking"></i>
                         <span class="nav-text">Dashboard</span>
                         <!-- <span class="badge badge-xs badge-success">New</span> -->
                    </a>
               </li>
			<?php if ($this->session->userdata('next-role') === 'admin') : ?>
                    <li>
                         <a class="ai-icon" href="<?= base_url('v2/users') ?>">
                              <i class="flaticon-381-user-9"></i>
                              <span class="nav-text">Daftar Pengguna</span>
                         </a>
                    </li>
                    <li>
                         <a class="ai-icon" href="<?= base_url('v2/companies') ?>">
                              <i class="flaticon-381-map-2"></i>
                              <span class="nav-text">Daftar SKPD</span>
                         </a>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                              <i class="flaticon-381-notepad"></i>
                              <span class="nav-text">Data Umum</span>
                         </a>
                         <ul aria-expanded="false">
                              <li><a href="<?= base_url('v2/articles/list') ?>">Artikel
                                        <span class="badge badge-xs badge-warning">Edit URL</span></a></li>
                              <li><a href="<?= base_url('v2/news/list') ?>">
                                        Berita
                                        <span class="badge badge-xs badge-warning">Edit URL</span>
                                   </a></li>
                              <li><a href="<?= base_url('v2/backend/banners') ?>">Banner</a></li>
                              <li><a href="<?= base_url('v2/galleries/list') ?>">
                                        Galeri
                                        <span class="badge badge-xs badge-warning">Edit URL</span>
                                   </a></li>
                              <li><a href="<?= base_url('v2/backend/faqs') ?>">FAQ</a></li>
                              <li><a href="<?= base_url('v2/backend/links') ?>">Link</a></li>
                              <li><a href="<?= base_url('v2/regulations/list') ?>">
                                        Peraturan
                                        <span class="badge badge-xs badge-warning">Edit URL</span>
                                   </a></li>
<!--                              <li><a href="--><?php //= base_url('v2/backend/inventarisarsips') ?><!--">Inventaris Arsip</a></li>-->
<!--                              <li><a href="--><?php //= base_url('v2/backend/arsipstatiss') ?><!--">Daftar Arsip Statis</a></li>-->
                              <li><a href="<?= base_url('v2/guides/list') ?>">
                                        Guide Arsip
                                        <span class="badge badge-xs badge-warning">Edit URL</span>
                                   </a></li>
                              <li><a href="<?= base_url('v2/backend/materipaparans') ?>">Materi/Paparan</a></li>
                              <li><a href="<?= base_url('v2/profiles/list') ?>">
                                        Profil
                                        <span class="badge badge-xs badge-warning">Edit URL</span>
                                   </a></li>
                         </ul>
                    </li>
                    <li>
                         <a class="ai-icon" href="<?= base_url('v2/services/list') ?>">
                              <i class="fas fa-file-upload"></i>
                              <span class="nav-text">Permohonan Perbaikan</span>
                         </a>
                    </li>
			<?php endif; ?>

               <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                         <i class="flaticon-381-folder-14"></i>
                         <span class="nav-text">Alih Media</span>
                    </a>
                    <ul aria-expanded="false">
                         <li><a href="<?= base_url('v2/alih_media_arsip_vital') ?>">Alih Media Arsip Vital</a></li>
                         <li><a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah') ?>">Alih Media Arsip Usul
                                   Serah</a></li>
                    </ul>
               </li>
			<?php if (in_array($this->session->userdata('next-role'), ['kepala_lkd', 'verifikator_lkd'])): ?>
                    <li>
                         <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                              <i class="flaticon-381-folder-14"></i>
                              <span class="nav-text">Arsip Usul Serah</span>
                         </a>
                         <ul aria-expanded="false">
                              <li><a href="<?= base_url('v2/backend/alih_media_arsip_usul_serah') ?>">Daftar Berkas</a>
                              </li>
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

               <?php if ($this->session->userdata('next-role') == 'operator') { ?>
                    <li>
                         <a class="ai-icon" href="<?= base_url('v2/archieves/inactives') ?>">
                              <i class="flaticon-381-folder-14"></i>
                              <span class="nav-text">Arsip Inaktif</span>
                         </a>
                    </li>
               <?php } ?>
               <li>
                    <a href="<?= base_url('v2/users/profiles') ?>" class="ai-icon"><i class="flaticon-381-user-4"></i>
                         <span class="nav-text">Profil</span>
                    </a>
               </li>

          </ul>

          <div class="add-menu-sidebar">
               <!-- <img src="<?= base_url('assets/v3/backend/images/icon1.png') ?>" alt=""> -->
               <p>Anda ingi ke halaman utama?</p>
               <a href="<?= base_url('v2/home') ?>" class="btn bg-white">
                    <i class="flaticon-381-home-2"></i>
                    <span class="ms-2">Beranda</span>
               </a>
          </div>
          <div class="copyright">
               <p><strong>PRASASTI</strong> © 2026. All Rights Reserved</p>
               <p>Made with <span class="heart"></span> by <a href="https://disarpus.sumedangkab.go.id" target="_blank">Dinas
                         Arsip &amp; Perpustakaan Kabupaten Sumedang</a></p>
          </div>
     </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->
