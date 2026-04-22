<style>
    .table-transparent {
        --bs-table-bg: transparent;
        --bs-table-accent-bg: transparent;
        background-color: transparent;
    }
</style>

<div class="breadcrumb-section bg-img"
     style="background-image: url('<?= base_url("assets/v3/frontend/v2/") ?>img/bg-img/90.jpg');">
     <div class="container">
          <!-- Breadcrumb Content -->
          <div class="breadcrumb-content">
               <div class="divider"></div>
               <h2>Detail <?= ($_GET['src'] == 'static') ? 'Arsip Statis' : 'Inventaris Arsip' ?></h2>
               <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <?php if ($_GET['src'] == 'static') { ?>
	                    <li><a href="<?= base_url('v2/archieves') ?>">Arsip Statis</a></li>
                    <?php } else { ?>
	                    <li><a href="<?= base_url('v2/archieves/inventory') ?>">Inventaris Arsip</a></li>
                    <?php } ?>

                    <li>Detail</li>
               </ul>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>

<!-- Portfolio Details Section -->
<div class="portfolio-details-section mb-5">
     <!-- Divider -->
     <div class="divider-sm"></div>

     <div class="container">
          <div class="row d-flex justify-content-between g-5 g-md-4 g-lg-5">
               <div class="col-12 col-lg-7 mb-5">
	               <?php if ($archieve->tte_status == 'Y' and file_exists('./assets/upload/berkas/' . $archieve->tte_dokumen)) { ?>
                         <iframe src="<?= base_url('assets/upload/berkas/' . $archieve->tte_dokumen); ?>"
                                 frameborder="0"
                                 class="w-100 mb-3" style="min-height: 700px"></iframe>
                         <div class="d-flex align-items-start gap-4">
                              <div class="icon">
                                   <i class="ti ti-signature text-success" style="font-size: 50px;"></i>
                              </div>
                              <div>
                                   <p class="mb-0">Dokumen ini telah ditandatangani secara elektronik oleh:</p>
                                   <h5 class="mb-1"><?= (!empty($archieve->signer)) ? $archieve->signer->fullname : '-'; ?></h5>
                                   <h6 class="fw-normal" style="color: #585B6F !important;">pada <?= tgl_indo(date('Y-m-d', strtotime($archieve->tte_tanggal))) . ' - ' . jam_indo(date('H:i:s', strtotime($archieve->tte_tanggal))); ?></h6>
                              </div>
                         </div>
	               <?php } else if (file_exists('./assets/data/' . $archieve->file)) { ?>
                         <iframe src="<?= base_url('assets/data/' . $archieve->file); ?>" frameborder="0"
                                 class="w-100 mb-3" style="min-height: 700px"></iframe>
                         <div class="d-flex align-items-start gap-4">
                              <div class="icon">
                                   <i class="ti ti-file-text-shield text-danger"
                                      style="font-size: 30px;"></i>
                              </div>
                              <div>
                                   <p class="mb-0 text-danger">Dokumen ini berupa draf dan belum ditandatangani oleh Kepala <?= ($archieve->penilaian_arsip_statis == 'Y') ? 'LEMBAGA KEARSIPAN DAERAH' : ucwords($archieve->name); ?>!</p>
                              </div>
                         </div>
	               <?php } else { ?>
                         <div class="alert alert-danger" role="alert">
                              <h4 class="alert-heading">Kesalahan!</h4>
                              <hr>
                              <p>Maaf, dokumen tidak dapat ditemukan atau terjadi kesalahan saat memuat
                                   pratinjau dokumen.</p>
                         </div>
	               <?php } ?>
               </div>
               <div class="col-12 col-lg-5">
                         <!-- Project Details Card -->
                         <div class="project-details-card">
                              <h4 class="fw-bold">Deskripsi</h4>

                              <div class="project-info mt-4">
                                   <div class="table-responsive">
                                        <table class="table table-hover table-transparent align-middle">
                                             <tr>
                                                  <td class="ps-0 fw-bold">SKPD</td>
                                                  <td>:</td>
                                                  <td class="pe-0"><?= (!empty($archieve->name)) ? $archieve->name : '-'; ?></td>
                                             </tr>
                                             <tr>
                                                  <td class="ps-0 fw-bold">Unit Pencipta</td>
                                                  <td>:</td>
                                                  <td class="pe-0"><?= (!empty($archieve->unit_kerja_pencipta)) ? $archieve->unit_kerja_pencipta : '-'; ?></td>
                                             </tr>
                                             <tr>
                                                  <td class="ps-0 fw-bold">Jenis Arsip</td>
                                                  <td>:</td>
							               <?php if (!empty($archieve->jenis_arsip)) {
								               if ($archieve->jenis_arsip == 'vital') { ?>
                                                            <td class="pe-0">Arsip Vital</td>
								               <?php } else { ?>
                                                            <td class="pe-0">Usul Serah Pindah</td>
								               <?php }
							               } else { ?>
                                                       <td>-</td>
							               <?php } ?>
                                             </tr>
                                             <tr>
                                                  <td class="ps-0 fw-bold">Tahun</td>
                                                  <td>:</td>
                                                  <td class="pe-0"><?= $archieve->tahun; ?></td>
                                             </tr>
                                             <tr>
                                                  <td class="ps-0 fw-bold">Indeks</td>
                                                  <td>:</td>
                                                  <td class="pe-0"><?= $archieve->indek; ?></td>
                                             </tr>
                                             <tr>
                                                  <td class="ps-0 fw-bold">Kode Klasifikasi</td>
                                                  <td>:</td>
                                                  <td class="pe-0"><?= $archieve->kode_klsf; ?></td>
                                             </tr>
                                             <tr>
                                                  <td class="ps-0 fw-bold">Uraian Informasi</td>
                                                  <td>:</td>
                                                  <td class="pe-0"><?= $archieve->uraian_informasi_arsip; ?></td>
                                             </tr>
                                             <tr>
                                                  <td class="ps-0 fw-bold">Verifikator</td>
                                                  <td>:</td>
							               <?php if (!empty($archieve->verifikator)) {
								               if ($archieve->verifikator == 'SKPD') { ?>
                                                            <td class="pe-0 text-primary">Satuan Kerja Perangkat Daerah</td>
								               <?php } else { ?>
                                                            <td class="pe-0 text-danger">Lembaga Kearsipan Daerah</td>
								               <?php }
							               } else { ?>
                                                       <td>-</td>
							               <?php } ?>
                                             </tr>
                                             <tr>
                                                  <td class="ps-0 fw-bold">Arsip Statis</td>
                                                  <td>:</td>
                                                  <td class="pe-0"><?= ($archieve->penilaian_arsip_statis == 'Y') ? 'Ya' : 'Tidak'; ?></td>
                                             </tr>
                                             <tr>
                                                  <td class="ps-0 fw-bold">Keterangan</td>
                                                  <td>:</td>
                                                  <td class="pe-0"><?= (!empty($archieve->deskripsi)) ? $archieve->deskripsi : '-'; ?></td>
                                             </tr>
                                        </table>
                                   </div>
                              </div>

                              <!-- Social Nav -->
                              <!--                              <div class="social-nav">-->
                              <!--                                   <a href="#">-->
                              <!--                                        <i class="ti ti-brand-facebook"></i>-->
                              <!--                                   </a>-->
                              <!--                                   <a href="#">-->
                              <!--                                        <i class="ti ti-brand-x"></i>-->
                              <!--                                   </a>-->
                              <!--                                   <a href="#">-->
                              <!--                                        <i class="ti ti-brand-linkedin"></i>-->
                              <!--                                   </a>-->
                              <!--                                   <a href="#">-->
                              <!--                                        <i class="ti ti-brand-instagram"></i>-->
                              <!--                                   </a>-->
                              <!--                              </div>-->
                         </div>

		               <?php if (file_exists('./assets/upload/berkas/' . $archieve->tte_dokumen) or file_exists('./assets/data/' . $archieve->file)) { ?>
                              <div class="download-card mt-4">
                                   <h4 class="mb-4 fw-bold">Download Dokumen</h4>
                                   <a target="_blank" href="<?= ($archieve->tte_status == 'Y') ? base_url('assets/upload/berkas/' . $archieve->tte_dokumen) : base_url('assets/data/' . $archieve->file); ?>" class="btn <?= ($archieve->tte_status == 'Y' and file_exists('./assets/upload/berkas/' . $archieve->tte_dokumen)) ? 'btn-success' : 'btn-danger' ?> w-100 mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                             height="24" viewBox="0 0 24 24" fill="none">
                                             <path
                                                     d="M7.79297 21.25H16.209C17.1372 21.25 18.0275 20.8813 18.6838 20.2249C19.3402 19.5685 19.709 18.6783 19.709 17.75V12.22C19.7093 11.2919 19.341 10.4016 18.685 9.745L12.716 3.775C12.3909 3.45 12.0051 3.19221 11.5804 3.01634C11.1558 2.84047 10.7006 2.74997 10.241 2.75H7.79297C6.86471 2.75 5.97447 3.11875 5.3181 3.77513C4.66172 4.4315 4.29297 5.32174 4.29297 6.25V17.75C4.29297 18.6783 4.66172 19.5685 5.3181 20.2249C5.97447 20.8813 6.86471 21.25 7.79297 21.25Z"
                                                     stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                     stroke-linejoin="round"/>
                                             <path
                                                     d="M11.6895 3.10999V8.76999C11.6895 9.30042 11.9002 9.80913 12.2752 10.1842C12.6503 10.5593 13.159 10.77 13.6895 10.77H19.3515"
                                                     stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                     stroke-linejoin="round"/>
                                             <path
                                                     d="M7.25 16.5V15.5M7.25 15.5V13.5H8.25C8.51522 13.5 8.76957 13.6054 8.95711 13.7929C9.14464 13.9804 9.25 14.2348 9.25 14.5C9.25 14.7652 9.14464 15.0196 8.95711 15.2071C8.76957 15.3946 8.51522 15.5 8.25 15.5H7.25ZM15.25 16.5V15.25M15.25 15.25V13.5H16.75M15.25 15.25H16.75M11.25 16.5V13.5H11.75C12.1478 13.5 12.5294 13.658 12.8107 13.9393C13.092 14.2206 13.25 14.6022 13.25 15C13.25 15.3978 13.092 15.7794 12.8107 16.0607C12.5294 16.342 12.1478 16.5 11.75 16.5H11.25Z"
                                                     stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        DOWNLOAD PDF <?= ($archieve->tte_status == 'Y' and file_exists('./assets/upload/berkas/' . $archieve->tte_dokumen)) ? 'TTE' : 'DRAF' ?></a>
                              </div>
		               <?php } ?>

                         <!-- Need Help -->
                         <div class="need-help-card mt-4">
                              <h4 class="fw-bold">Anda butuh bantuan?</h4>
                              <p class="mb-4">Hubungi kami untuk mendapatkan dukungan</p>

                              <div class="d-flex flex-column gap-4">
                                   <!-- Help Item -->
                                   <div class="help-item d-flex align-items-center">
                                        <div class="icon">
                                             <a href="tel:0261201231">
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                       viewBox="0 0 24 24"
                                                       fill="none">
                                                       <path
                                                               d="M6.62 10.79C8.06 13.62 10.38 15.93 13.21 17.38L15.41 15.18C15.68 14.91 16.08 14.82 16.43 14.94C17.55 15.31 18.76 15.51 20 15.51C20.55 15.51 21 15.96 21 16.51V20C21 20.55 20.55 21 20 21C10.61 21 3 13.39 3 4C3 3.45 3.45 3 4 3H7.5C8.05 3 8.5 3.45 8.5 4C8.5 5.25 8.7 6.45 9.07 7.57C9.18 7.92 9.1 8.31 8.82 8.59L6.62 10.79Z"
                                                               fill="#222222"/>
                                                  </svg>
                                             </a>
                                        </div>
                                        <div>
                                             <p class="mb-1">Telepon</p>
                                             <h5 class="mb-0"><a href="tel:0261201231">(0261) 201231</a></h5>
                                        </div>
                                   </div>

                                   <!-- Help Item -->
                                   <div class="help-item d-flex align-items-center">
                                        <div class="icon">
                                             <a href="mailto:disarpus@sumedangkab.go.id">
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                       viewBox="0 0 24 24"
                                                       fill="none">
                                                       <path
                                                               d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z"
                                                               fill="#222222"/>
                                                  </svg>
                                             </a>
                                        </div>
                                        <div>
                                             <p class="mb-1">Email</p>
                                             <h5 class="mb-0"><a href="mailto:disarpus@sumedangkab.go.id" class="text-break">disarpus@sumedangkab.go.id</a></h5>
                                        </div>
                                   </div>

                                   <!-- Help Item -->
                                   <div class="help-item d-flex align-items-center">
                                        <div class="icon">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                  viewBox="0 0 24 24"
                                                  fill="none">
                                                  <path
                                                          d="M12 11.5C11.337 11.5 10.7011 11.2366 10.2322 10.7678C9.76339 10.2989 9.5 9.66304 9.5 9C9.5 8.33696 9.76339 7.70107 10.2322 7.23223C10.7011 6.76339 11.337 6.5 12 6.5C12.663 6.5 13.2989 6.76339 13.7678 7.23223C14.2366 7.70107 14.5 8.33696 14.5 9C14.5 9.3283 14.4353 9.65339 14.3097 9.95671C14.1841 10.26 13.9999 10.5356 13.7678 10.7678C13.5356 10.9999 13.26 11.1841 12.9567 11.3097C12.6534 11.4353 12.3283 11.5 12 11.5ZM12 2C10.1435 2 8.36301 2.7375 7.05025 4.05025C5.7375 5.36301 5 7.14348 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 7.14348 18.2625 5.36301 16.9497 4.05025C15.637 2.7375 13.8565 2 12 2Z"
                                                          fill="#222222"/>
                                             </svg>
                                        </div>
                                        <div>
                                             <p class="mb-1">Alamat Kantor</p>
                                             <h5 class="mb-0">Jl. Margamukti, Cimalaka, Kabupaten Sumedang</h5>
                                        </div>
                                   </div>
                              </div>
                         </div>
               </div>
          </div>
     </div>
</div>
