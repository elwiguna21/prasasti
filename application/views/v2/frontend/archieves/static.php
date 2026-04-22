<style>
    .link-title:hover {
        color: #2B4DFF;
    }
</style>
<div class="breadcrumb-section bg-img" style="background-image: url('assets/img/bg-img/90.jpg');">
     <div class="container">
          <!-- Breadcrumb Content -->
          <div class="breadcrumb-content">
               <div class="divider"></div>
               <h2>Arsip Statis</h2>
               <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <li>Arsip Statis</li>
               </ul>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>

<section class="service-section">
     <!-- Divider -->
     <div class="divider-sm"></div>

     <div class="container">
          <div class="row justify-content-center">
               <!-- Section Heading -->
               <div class="col-12 col-md-7">
                    <div class="section-heading text-center">
                         <span class="sub-title">Arsip Statis</span>
                         <p class="mb-0">Arsip yang memiliki nilai guna kesejarahan, telah habis masa retensinya, dan
                              ditetapkan permanen setelah diverifikasi oleh lembaga kearsipan. Arsip ini tidak lagi
                              digunakan secara langsung dalam administrasi sehari-hari, melainkan disimpan untuk
                              kepentingan penelitian, sejarah, dan memori kolektif bangsa.</p>
                    </div>
               </div>
          </div>
          <div class="divider-sm"></div>
     </div>

     <div class="container">
          <div class="row g-4 g-md-5">
               <div class="col-lg-12">
                    <div class="d-flex flex-column gap-5">
                         <div class="blog-widget">
                              <form method="get">
                                   <div class="row">
                                        <div class="col-lg-5 col-12 mb-3">
                                             <input type="text" name="title" class="form-control"
                                                    placeholder="Cari indeks / klasifikasi / uraian arsip" autocomplete="off"
                                                    value="<?= (!empty($_GET['title'])) ? $_GET['title'] : '' ?>">
                                        </div>
                                        <div class="col-lg-5 col-12 mb-3">
                                             <select class="form-control" name="company">
                                                  <option value="">Pilih SKPD</option>
										<?php foreach ($companies as $company) { ?>
                                                       <option value="<?= $company->no_company; ?>" <?= (!empty($_GET['company']) && $_GET['company'] == $company->no_company) ? 'selected' : '' ?>><?= $company->name; ?></option>
										<?php } ?>
                                             </select>
                                        </div>
                                        <div class="col-lg-2 col-12">
                                             <div class="project-navigation-container justify-content-center">
                                                  <button type="submit" class="btn btn-primary px-3">Cari</button>
                                                  <button type="reset" class="btn btn-danger btn-reset px-3">Reset
                                                  </button>
                                             </div>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
          <!-- <div class="divider-sm"></div> -->
     </div>
</section>

<section class="pricing-section mt-4">
     <div class="container">
          <p><?= number_format($archieves_total, 0, ',', '.'); ?> Arsip ditemukan</p>
		<?php if (!empty($archieves)) { ?>
               <div class="pricing-card-two wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">
                    <div class="row">
					<?php foreach ($archieves as $archieve) {
						$params = array('archieve' => $this->encryption->encrypt($archieve->id), 'company' => $archieve->nomor_skpd);
						?>
                              <div class="col-lg-4 col-md-6 col-12 mb-3">
                                   <div class="packgae-name-price wow fadeInUp" data-wow-duration="1000ms"
                                        data-wow-delay="400ms">

                                        <h4>
                                             <a href="<?= base_url('v2/archieves/detail?' . http_build_query($params)); ?>"
                                                class="link-title"><?= (!empty($archieve->indek)) ? $archieve->indek : ((!empty($archieve->uraian_informasi_arsip)) ? substr($archieve->uraian_informasi_arsip, 0, 50) : '-'); ?></a>
                                        </h4>

                                        <div class="border-top mt-4 mb-3"></div>
                                        <!-- <h2 class="price-value mb-0">$19.00</h2> -->
                                        <ul class="ps-0 list-unstyled mb-2">
                                             <li class="align-items-center align-content-center">
                                                  <i class="ti ti-calendar text-purple me-2"
                                                     style="font-size: 18px;"></i> <?= $archieve->tahun; ?>
                                             </li>
                                             <li>
                                                  <i class="ti ti-user text-purple me-2"
                                                     style="font-size: 18px;"></i> <?= (!empty($archieve->name)) ? $archieve->name : ((!empty($archieve->unit_kerja_pencipta)) ? $archieve->unit_kerja_pencipta : '-') ?>
                                             </li>
                                        </ul>
                                        <p class="mb-3"><?= (!empty($archieve->uraian_informasi_arsip)) ? $archieve->uraian_informasi_arsip : ((!empty($archieve->deskripsi)) ? $archieve->deskripsi : '-'); ?></p>
                                        <div class="d-flex justify-content-center">
                                             <a href="<?= base_url('v2/archieves/detail?' . http_build_query($params)); ?>"
                                                class="btn btn-sm btn-primary w-100">Detail</a>
                                        </div>
                                   </div>
                              </div>
					<?php } ?>

                         <div class="d-flex justify-content-center mt-2">
						<?= $pagination; ?>
                         </div>
                    </div>
               </div>
		<?php } else { ?>
               <div class="col-lg-12">
                    <div class="alert alert-warning">
                         Maaf, tidak dapat memuat arsip statis atau arsip statis belum tersedia...
                    </div>
               </div>
		<?php } ?>
     </div>
</section>

<section class="services-section bg-white">
     <div class="container">
          <div class="row justify-content-center g-5">
               <!-- Service Small Card -->
               <div class="col-12 col-md-6 col-lg-4">
                    <div class="service-small-card d-flex gap-4 align-items-center wow fadeInUp"
                         data-wow-duration="1000ms"
                         data-wow-delay="400ms">
                         <div class="service-small-card-icon">
                              <!-- <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49" viewBox="0 0 49 49" fill="none">
                                   <g clip-path="url(#clip0_1_352878)">
                                        <mask id="mask0_1_3528A" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0"
                                             width="49" height="49">
                                             <path d="M48.3335 0.333984H0.333496V48.334H48.3335V0.333984Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_1_3528A)">
                                             <mask id="mask1_1_3528A" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0"
                                                  y="0" width="49" height="49">
                                                  <path d="M0.333496 0.333988H48.3335V48.334H0.333496V0.333988Z" fill="white" />
                                             </mask>
                                             <g mask="url(#mask1_1_3528A)">
                                                  <path
                                                       d="M33.3335 24.4277C33.3335 29.3984 29.3041 33.4277 24.3335 33.4277C19.3629 33.4277 15.3335 29.3984 15.3335 24.4277"
                                                       stroke="url(#paint0_linear_1_3528E)" stroke-width="2.6" stroke-miterlimit="10" />
                                                  <path
                                                       d="M2.2085 24.4277V25.9277L8.28668 27.6723C8.71043 29.7193 9.52156 31.622 10.631 33.3119L7.52309 38.7096L9.95778 41.1444L15.3556 38.0365C17.0455 39.1459 18.9482 39.957 20.9952 40.3809L22.612 46.459H26.055L27.6718 40.3809C29.7188 39.957 31.6215 39.1459 33.3114 38.0365L38.7092 41.1444L41.1439 38.7096L38.036 33.3119C39.1454 31.622 39.9566 29.7193 40.3803 27.6723L46.4585 25.9277V24.4277"
                                                       stroke="url(#paint1_linear_1_3528X)" stroke-width="2.6" stroke-miterlimit="10" />
                                                  <path
                                                       d="M2.2085 20.6777C2.2085 16.6047 5.51046 13.3027 9.58353 13.3027C12.4676 13.3027 14.9649 14.9582 16.1772 17.3707"
                                                       stroke="url(#paint2_linear_1_35283)" stroke-width="2.6" stroke-miterlimit="10"
                                                       stroke-linejoin="round" />
                                                  <path
                                                       d="M19.646 6.89648C19.646 4.30767 21.7447 2.20899 24.3335 2.20899C26.9223 2.20899 29.021 4.30767 29.021 6.89648C29.021 9.4853 26.9223 11.584 24.3335 11.584C21.7447 11.584 19.646 9.4853 19.646 6.89648Z"
                                                       stroke="url(#paint3_linear_1_35286)" stroke-width="2.6" stroke-miterlimit="10"
                                                       stroke-linecap="round" stroke-linejoin="round" />
                                                  <path
                                                       d="M15.3335 20.6777C15.3335 15.7071 19.3629 11.6777 24.3335 11.6777C29.3041 11.6777 33.3335 15.7071 33.3335 20.6777"
                                                       stroke="url(#paint4_linear_1_35228)" stroke-width="2.6" stroke-miterlimit="10"
                                                       stroke-linejoin="round" />
                                                  <path
                                                       d="M5.9585 9.52148C5.9585 7.45045 7.63737 5.77148 9.7085 5.77148C11.7796 5.77148 13.4585 7.45045 13.4585 9.52148C13.4585 11.5925 11.7796 13.2715 9.7085 13.2715C7.63737 13.2715 5.9585 11.5925 5.9585 9.52148Z"
                                                       stroke="url(#paint5_linear_1_35283)" stroke-width="2.6" stroke-miterlimit="10"
                                                       stroke-linecap="round" stroke-linejoin="round" />
                                                  <path
                                                       d="M46.4585 20.6777C46.4585 16.6047 43.1565 13.3027 39.0835 13.3027C36.1994 13.3027 33.7021 14.9582 32.4897 17.3707"
                                                       stroke="url(#paint6_linear_13_3528)" stroke-width="2.6" stroke-miterlimit="10"
                                                       stroke-linejoin="round" />
                                                  <path
                                                       d="M42.7085 9.52148C42.7085 7.45045 41.0296 5.77148 38.9585 5.77148C36.8874 5.77148 35.2085 7.45045 35.2085 9.52148C35.2085 11.5925 36.8874 13.2715 38.9585 13.2715C41.0296 13.2715 42.7085 11.5925 42.7085 9.52148Z"
                                                       stroke="url(#paint7_linear_3)" stroke-width="2.6" stroke-miterlimit="10"
                                                       stroke-linecap="round" stroke-linejoin="round" />
                                             </g>
                                        </g>
                                   </g>
                                   <defs>
                                        <linearGradient id="paint0_linear_1_3528E" x1="24.3335" y1="33.4277" x2="24.3335"
                                             y2="24.4277" gradientUnits="userSpaceOnUse">
                                             <stop offset="0" stop-color="#601FEB" />
                                             <stop offset="1" stop-color="#C700B1" />
                                        </linearGradient>
                                        <linearGradient id="paint1_linear_1_3528X" x1="24.3335" y1="46.459" x2="24.3335" y2="24.4277"
                                             gradientUnits="userSpaceOnUse">
                                             <stop offset="0" stop-color="#601FEB" />
                                             <stop offset="1" stop-color="#C700B1" />
                                        </linearGradient>
                                        <linearGradient id="paint2_linear_1_35283" x1="9.19287" y1="20.6777" x2="9.19287"
                                             y2="13.3027" gradientUnits="userSpaceOnUse">
                                             <stop offset="0" stop-color="#601FEB" />
                                             <stop offset="1" stop-color="#C700B1" />
                                        </linearGradient>
                                        <linearGradient id="paint3_linear_1_35286" x1="24.3335" y1="11.584" x2="24.3335" y2="2.20899"
                                             gradientUnits="userSpaceOnUse">
                                             <stop offset="0" stop-color="#601FEB" />
                                             <stop offset="1" stop-color="#C700B1" />
                                        </linearGradient>
                                        <linearGradient id="paint4_linear_1_35228" x1="24.3335" y1="20.6777" x2="24.3335"
                                             y2="11.6777" gradientUnits="userSpaceOnUse">
                                             <stop offset="0" stop-color="#601FEB" />
                                             <stop offset="1" stop-color="#C700B1" />
                                        </linearGradient>
                                        <linearGradient id="paint5_linear_1_35283" x1="9.7085" y1="13.2715" x2="9.7085" y2="5.77148"
                                             gradientUnits="userSpaceOnUse">
                                             <stop offset="0" stop-color="#601FEB" />
                                             <stop offset="1" stop-color="#C700B1" />
                                        </linearGradient>
                                        <linearGradient id="paint6_linear_13_3528" x1="39.4741" y1="20.6777" x2="39.4741"
                                             y2="13.3027" gradientUnits="userSpaceOnUse">
                                             <stop offset="0" stop-color="#601FEB" />
                                             <stop offset="1" stop-color="#C700B1" />
                                        </linearGradient>
                                        <linearGradient id="paint7_linear_3" x1="38.9585" y1="13.2715" x2="38.9585" y2="5.77148"
                                             gradientUnits="userSpaceOnUse">
                                             <stop offset="0" stop-color="#601FEB" />
                                             <stop offset="1" stop-color="#C700B1" />
                                        </linearGradient>
                                        <clipPath id="clip0_1_352878">
                                             <rect width="48" height="48" fill="white" transform="translate(0.333496 0.333984)" />
                                        </clipPath>
                                   </defs>
                              </svg> -->
                              <i class="ti ti-archive text-primary" style="font-size: 50px;"></i>
                         </div>
                         <div>
                              <h5>Manajemen Arsip</h5>
                              <p class="mb-0">Pengelolaan arsip dari setiap Satuan Kerja Perangkat Daerah di Kabupaten
                                   Sumedang.</p>
                         </div>
                    </div>
               </div>

               <!-- Service Small Card -->
               <div class="col-12 col-md-6 col-lg-4">
                    <div class="service-small-card d-flex gap-4 align-items-center wow fadeInUp"
                         data-wow-duration="1000ms"
                         data-wow-delay="600ms">
                         <div class="service-small-card-icon">
                              <i class="ti ti-history text-primary" style="font-size: 50px;"></i>
                         </div>
                         <div>
                              <h5>Mudah & Cepat</h5>
                              <p class="mb-0">Pengelolaan arsip dengan mudah dan cepat dari manapun secara online.</p>
                         </div>
                    </div>
               </div>

               <!-- Service Small Card -->
               <div class="col-12 col-md-6 col-lg-4">
                    <div class="service-small-card d-flex gap-4 align-items-center wow fadeInUp"
                         data-wow-duration="1000ms"
                         data-wow-delay="800ms">
                         <div class="service-small-card-icon">
                              <i class="ti ti-chart-line text-primary" style="font-size: 50px;"></i>
                         </div>
                         <div>
                              <h5>Monitoring Arsip</h5>
                              <p class="mb-0">Monitoring berkala dalam pengelolaan arsip pada Satuan Kerja Perangkat
                                   Kerja.</p>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>

<script src="<?= base_url('assets/v3/frontend/js/jquery.min.js') ?>"></script>
<script>
    $('.btn-reset').click(function () {
        $('input[name="title"]').val(null);
        $('select[name="company"]').val(null).trigger('change');
        window.location.href = '<?= base_url('v2/archieves') ?>';
    })
</script>
