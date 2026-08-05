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
                              <li><a href="<?= base_url('v2/articles/list') ?>">Artikel</a></li>
                              <li><a href="<?= base_url('v2/news/list') ?>">
                                        Berita
                                   </a></li>
                              <li><a href="<?= base_url('v2/banners') ?>">Banner</a></li>
                              <li><a href="<?= base_url('v2/galleries/list') ?>">
                                        Galeri
                                   </a></li>
                              <li><a href="<?= base_url('v2/faqs') ?>">FAQ</a></li>
                              <li><a href="<?= base_url('v2/links') ?>">Link</a></li>
                              <li><a href="<?= base_url('v2/regulations/list') ?>">
                                        Peraturan
                                   </a></li>
                              <!--                              <li><a href="--><?php //= base_url('v2/backend/inventarisarsips')
                                                                                ?><!--">Inventaris Arsip</a></li>-->
                              <!--                              <li><a href="--><?php //= base_url('v2/backend/arsipstatiss')
                                                                                ?><!--">Daftar Arsip Statis</a></li>-->
                              <li><a href="<?= base_url('v2/guides/list') ?>">
                                        Guide Arsip
                                   </a></li>
                              <li><a href="<?= base_url('v2/materi') ?>">Materi/Paparan</a></li>
                              <li><a href="<?= base_url('v2/profiles/list') ?>">
                                        Profil
                                   </a></li>
                         </ul>
                    </li>
                    <li>
                         <a class="has-arrow ai-icon" href="javascript:void();" aria-expanded="false">
                              <i class="fas fa-file-upload"></i>
                              <span class="nav-text">Layanan</span>
                         </a>
                         <ul aria-expanded="false">
                              <li><a href="<?= base_url('v2/services/list') ?>">Permohonan Perbaikan</a></li>
                         </ul>
                    </li>
               <?php endif; ?>

               <?php if (!in_array($this->session->userdata('next-role'), ['kepala_lkd', 'verifikator_lkd'])): ?>
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
               <?php endif; ?>
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
               <li>
                    <a href="<?= base_url('v2/authentications/signout') ?>" class="ai-icon">
                         <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                              <polyline points="16 17 21 12 16 7"></polyline>
                              <line x1="21" y1="12" x2="9" y2="12"></line>
                         </svg>
                         <span class="nav-text text-danger">Sign Out</span>
                    </a>
               </li>

          </ul>

          <div class="add-menu-sidebar">
               <!-- <img src="<?= base_url('assets/v3/backend/images/icon1.png') ?>" alt=""> -->
               <p>Anda ingi ke halaman utama?</p>
               <a href="<?= base_url('v2/home') ?>" class="btn btn-sm btn-light shadow bg-white">
                    <i class="flaticon-381-home-2 text-dark"></i>
                    <span class="ms-2 text-dark">Beranda</span>
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
