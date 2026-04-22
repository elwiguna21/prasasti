<div class="breadcrumb-section bg-img" style="background-image: url('assets/img/bg-img/90.jpg');">
     <div class="container">
          <!-- Breadcrumb Content -->
          <div class="breadcrumb-content">
               <div class="divider"></div>
               <h2>Layanan Perbaikan Arsip</h2>
               <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <li>Layanan Perbaikan Arsip</li>
               </ul>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>

<div class="contact-page-section">
     <!-- Divider -->
     <div class="divider"></div>

     <div class="container">
          <?php if (!empty($this->session->flashdata('status'))) { ?>
               <div class="alert alert-<?= ($this->session->flashdata('status') == 200) ? 'success' : 'danger'; ?> fade show" role="alert">
                    <span class="fw-bold"><?= ($this->session->flashdata('status') == 200) ? 'Berhasil' : 'Kesalahan'; ?>!</span> <?= (!empty($this->session->flashdata('message'))) ? $this->session->flashdata('message') : 'Terjadi kesalahan saat mengunggah data' ?>.
               </div>
          <?php } ?>

          <div class="row g-4 justify-content-center">
               <!-- Contact Small Card -->
               <div class="col-12 col-md-6 col-lg-4">
                    <div class="contact-small-card">
                         <div class="icon bg-primary">
                              <i class="ti ti-notes" style="font-size: 30px;"></i>
                         </div>

                         <div>
                              <h4>Terbuka Umum</h4>
                              <p class="mb-0">Perbaikan arsip yang rusak untuk umum / masyarakat Kabupaten Sumedang.</p>
                         </div>
                    </div>
               </div>

               <!-- Contact Small Card -->
               <div class="col-12 col-md-6 col-lg-4">
                    <div class="contact-small-card">
                         <div class="icon bg-primary">
                              <i class="ti ti-clock-check" style="font-size: 30px;"></i>
                         </div>

                         <div>
                              <h4>Mudah &amp; Cepat</h4>
                              <p class="mb-0">Permohonan perbaikan arsip yang rusak secara online, dapat dilakukan kapanpun & dimanapun.</p>
                         </div>
                    </div>
               </div>

               <!-- Contact Small Card -->
               <div class="col-12 col-md-6 col-lg-4">
                    <div class="contact-small-card">
                         <div class="icon bg-primary">
                              <i class="ti ti-cash-banknote-off" style="font-size: 30px;"></i>
                         </div>

                         <div>
                              <h4>Biaya Gratis</h4>
                              <p class="mb-0">Layanan perbaikan arsip tidak dikenakan retribusi daerah (gratis).</p>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>

<section class="faq-wrapper">
     <div class="container">
          <div class="row g-5 align-items-end">
               <div class="col-12">
                    <div class="section-heading">
                         <span class="sub-title">Layanan</span>
                         <h2 class="mb-0">Perbaikan Arsip</h2>
                    </div>
               </div>
          </div>
     </div>

     <div class="divider-sm"></div>

     <div class="container">
          <div class="row g-4 g-md-5">
               <!-- Happy Counts -->
               <div class="col-12 col-sm-6 col-lg-3">
                    <div class="happy-counts wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">
                         <h3 class="counter"><?= number_format($total, 0, ',', '.'); ?></h3>
                         <h5 class="mb-0">Total Arsip Perbaikan</h5>
                    </div>
               </div>

               <!-- Happy Counts -->
               <div class="col-12 col-sm-6 col-lg-3">
                    <div class="happy-counts wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
                         <h3 class="counter"><?= number_format($process, 0, ',', '.'); ?></h3>
                         <h5 class="mb-0">Diajukan</h5>
                    </div>
               </div>

               <!-- Happy Counts -->
               <div class="col-12 col-sm-6 col-lg-3">
                    <div class="happy-counts wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="800ms">
                         <h3 class="counter"><?= number_format($done, 0, ',', '.'); ?></h3>
                         <h5 class="mb-0">Selesai</h5>
                    </div>
               </div>

               <!-- Happy Counts -->
               <div class="col-12 col-sm-6 col-lg-3">
                    <div class="happy-counts wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="1000ms">
                         <h3 class="counter"><?= number_format($reject, 0, ',', '.'); ?></h3>
                         <h5 class="mb-0">Ditolak</h5>
                    </div>
               </div>

               <div class="col-12">
                    <div class="d-flex flex-column gap-5">
                         <!-- Widget -->
                         <div class="blog-widget">
                              <h4 class="fw-bold mb-4">Cari tiket (kode unik) permohonan anda atau menggunakan email/no. telepon anda</h4>
                              <!-- Form -->
                              <form action="<?= base_url('v2/services') ?>" method="get">
                                   <input name="code" type="text" class="form-control" placeholder="Contoh: A3WW10 | test@mail.com | 081111" autocomplete="off" value="<?= (!empty($_GET['code'])) ? $_GET['code'] : '' ?>">
                                   <button type="submit" class="btn-primary">
                                        <i class="ti ti-search" style="font-size: 20px;"></i>
                                   </button>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider-sm"></div>
</section>

<section class="faq-wrapper bg-secondary">
     <!-- Background -->
     <div class="bg-shape">
          <img src="assets/img/core-img/shape12.png" alt="">
     </div>

     <!-- Divider -->
     <div class="divider-sm"></div>

     <div class="container">
          <div class="faq-contact-card align-items-center bg-secondary p-0">
               <!-- Contact Info Card -->
               <div class="contact-info-card">
                    <div class="section-heading">
                         <span class="sub-title">Layanan</span>
                         <h2 class="mb-0">Perbaikan Arsip</h2>
                    </div>

                    <!-- Phone Number Card -->
                    <div class="phone-number-card mt-4">
                         <img src="<?= base_url('assets/v3/frontend/v2/') ?>img/bg-img/110.jpg" alt="">

                         <div class="d-flex gap-2 align-items-center">
                              <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 54 54" fill="none">
                                   <g clip-path="url(#clip0_1_18751)">
                                        <path
                                             d="M27 3.16406C32.4997 3.16628 37.8295 5.06974 42.0864 8.55192C46.3432 12.0341 49.2654 16.8809 50.3577 22.271C51.45 27.6611 50.6453 33.2631 48.0799 38.1278C45.5145 42.9925 41.3462 46.8207 36.2812 48.9639C30.4561 51.4254 23.8916 51.4721 18.032 49.0936C12.1724 46.7152 7.49767 42.1064 5.03613 36.2812C2.57459 30.4561 2.52791 23.8916 4.90637 18.032C7.28482 12.1724 11.8936 7.49767 17.7188 5.03613C20.6549 3.79361 23.8118 3.15685 27 3.16406ZM27 0C12.0888 0 0 12.0888 0 27C0 41.9112 12.0888 54 27 54C41.9112 54 54 41.9112 54 27C54 12.0888 41.9112 0 27 0Z"
                                             fill="white" />
                                        <path
                                             d="M34.8777 41.541C33.3094 41.4355 31.0988 40.8945 28.9409 40.1225C21.3324 37.3993 13.9084 30.1441 12.3306 19.9959C12.0501 18.1892 12.3454 16.5386 13.7144 15.1949C14.1732 14.7456 14.5813 14.2457 15.0296 13.7859C16.7171 12.0488 19.1829 12.0045 20.9306 13.673C21.4843 14.2004 22.0475 14.7203 22.5875 15.2645C23.3269 15.9937 23.7551 16.9811 23.782 18.0193C23.8089 19.0574 23.4326 20.0656 22.732 20.8322C22.3101 21.3005 21.8671 21.7456 21.422 22.1896C20.9358 22.6748 20.3315 22.9532 19.6829 23.1557C18.8823 23.4067 18.7336 23.7421 19.0975 24.5068C21.3967 29.3225 24.9957 32.7899 29.8943 34.9091C30.5493 35.1918 30.852 35.0642 31.1157 34.4145C31.6936 32.9896 32.7536 31.9507 33.9718 31.1112C35.3502 30.162 37.3246 30.3729 38.6303 31.4951C39.3461 32.1103 40.0301 32.7615 40.6796 33.4463C41.3784 34.1939 41.7667 35.1793 41.7657 36.2027C41.7647 37.2261 41.3745 38.2107 40.6743 38.957C40.4707 39.1785 40.2609 39.3947 40.0658 39.6225C38.8908 40.9884 37.4006 41.6275 34.8777 41.541Z"
                                             fill="white" />
                                   </g>
                                   <defs>
                                        <clipPath id="clip0_1_18751">
                                             <rect width="54" height="54" fill="white" />
                                        </clipPath>
                                   </defs>
                              </svg>
                              <h4 class="mb-0 text-white">(0261) 201231</h4>
                         </div>
                    </div>
               </div>

               <!-- Contact Form -->
               <div class="faq-contact-section style-two bg-white">
                    <div class="mb-5">
                         <h4>Lengkapi form dibawah ini</h4>
                         <p class="mb-0">untuk mengajukan permohonan perbaikan arsip yang rusak</p>
                    </div>

                    <!-- Contact Form -->
                    <form class="faq-contact-form style-two" action="<?= base_url('v2/services/add') ?>" enctype="multipart/form-data" method="post">
                         <div class="row g-4">
                              <div class="col-12">
                                   <div class="form-group">
                                        <input name="fullname" type="text" required class="form-control" placeholder="Nama lengkap anda" autocomplete="off">
                                   </div>
                              </div>
                              <div class="col-12 col-lg-6">
                                   <div class="form-group">
                                        <input name="phone" type="text" required class="form-control" placeholder="No.HP / WhatsApp">
                                   </div>
                              </div>
                              <div class="col-12 col-lg-6">
                                   <div class="form-group">
                                        <input name="email" type="email" class="form-control" required placeholder="Email aktif anda" autocomplete="off">
                                   </div>
                              </div>
                              <div class="col-12">
                                   <div class="form-group">
                                        <textarea name="address" rows="4" class="form-control" required placeholder="Masukan alamat anda"></textarea>
                                   </div>
                              </div>
                              <div class="col-12">
                                   <div class="form-group">
                                        <textarea name="description" rows="4" class="form-control" required placeholder="Masukan keterangan / deskripsi arsip yang akan diperbaiki"></textarea>
                                   </div>
                              </div>
                              <div class="col-12">
                                   <div class="form-group">
                                        <input name="document" type="file" required class="form-control" placeholder="Unggah dokumen arsip" accept="image/*, .pdf">
                                   </div>
                              </div>
                              <div class="col-12">
                                   <button type="submit" class="btn btn-primary w-100 mt-3">Kirim Permohonan</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider-sm"></div>
</section>

<!-- Maps Section -->
<div class="maps-section">
     <!-- <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d689667.0035819365!2d-90.02137296204438!3d38.72850958573321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87d8b4a9faed8ef9%3A0xbe39eaca22bbe05b!2sSt.%20Louis%2C%20MO%2C%20USA!5e0!3m2!1sen!2sbd!4v1745491575147!5m2!1sen!2sbd"
          loading="lazy"></iframe> -->
     <iframe
          src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15845.723602543547!2d107.9242028!3d-6.8388309!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68d14a7ae5bd49%3A0xfc76dd2f21670a54!2sDinas%20Arsip%20%26%20Perpustakaan%20Kab.%20Sumedang!5e0!3m2!1sen!2sid!4v1776747292761!5m2!1sen!2sid"
          height="350"
          loading="lazy"></iframe>
</div>

<script>
     let alert = document.querySelector('.alert');
     if (alert) {
          setTimeout(() => {
               alert.style.display = 'none';
          }, 10000);
     }
</script>
