<div class="breadcrumb-section bg-img" style="background-image: url('<?= base_url('assets/v3/frontend/v2/') ?>img/bg-img/90.jpg');">
     <div class="container">
          <!-- Breadcrumb Content -->
          <div class="breadcrumb-content">
               <div class="divider"></div>
               <h2>Berita</h2>
               <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <li>Berita</li>
               </ul>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>

<div class="blog-section">
     <!-- Divider -->
     <div class="divider"></div>

     <div class="container">
          <div class="row g-5 g-md-4 g-xl-5">
               <div class="col-12 col-md-7 col-lg-8">
                    <div class="row g-4 g-xxl-5 justify-content-center">
                         <?php if (!empty($newslatters)) {
                              foreach ($newslatters as $newslatter) { ?>
                                   <div class="col-12 col-lg-6">
                                        <div class="blog-card wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">
                                             <!-- Post Image -->
                                             <div class="post-img">
                                                  <?php if (file_exists('./assets/upload/' . $newslatter->gambar)) { ?>
                                                       <img src="<?= base_url('assets/upload/' . $newslatter->gambar); ?>" alt="<?= $newslatter->judul; ?>" style="max-height: 175px !important; ;">
                                                  <?php } else { ?>
                                                       <img src="<?= base_url('assets/v3/frontend/v2/') ?>img/bg-img/1.jpg" alt="<?= $newslatter->judul; ?>">
                                                  <?php } ?>
                                             </div>
                                             <!-- Post Body -->
                                             <div class="post-body">
                                                  <div class="blog-meta flex-wrap d-flex align-items-center gap-2">
                                                       <a href="#">Admin</a>
                                                       <div class="dot"></div>
                                                       <a href="#"><?= tgl_indo(date('Y-m-d', strtotime($newslatter->tanggal))); ?></a>
                                                  </div>
                                                  <a class="post-title h4" href="<?= base_url('v2/news/detail?slug=' . $newslatter->slug); ?>"><?= $newslatter->judul; ?></a>
                                                  <a class="read-more-btn" href="<?= base_url('v2/news/detail?slug=' . $newslatter->slug); ?>">Selengkapnya <i class="ti ti-arrow-right"></i></a>
                                             </div>
                                        </div>
                                   </div>
                              <?php } ?>
                              <?= $pagination; ?>
                         <?php } else { ?>
                              <div class="col-12">
                                   <h2 class="error-head">Berita tidak ditemukan !</h2>
                                   <p class="font-16">Kami mohon maaf, tetapi tampaknya berita yang Anda cari tidak dapat ditemukan.</p>
                                   <p class="font-16">Anda dapat kembali ke Beranda dengan mengklik tombol.</p>
                                   <a href="<?= base_url() ?>" class="site-button">Beranda</a>
                              </div>
                         <?php } ?>
                    </div>
               </div>

               <div class="col-12 col-md-5 col-lg-4">
                    <?php require_once('_right_content_news.php') ?>
               </div>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>
