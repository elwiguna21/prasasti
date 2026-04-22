<div class="breadcrumb-section bg-img" style="background-image: url('<?= base_url('assets/v3/frontend/v2/') ?>img/bg-img/90.jpg');">
     <div class="container">
          <!-- Breadcrumb Content -->
          <div class="breadcrumb-content">
               <div class="divider"></div>
               <h2>Artikel</h2>
               <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <li>Artikel</li>
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
                    <?php if (!empty($articles)) {
                         if (!empty($_GET['keyword'])) { ?>
                              <p>Hasil pencarian: <?= $articles_total; ?></p>
                         <?php } ?>
                         <div class="blog-list-wrapper pe-lg-3">
                              <?php foreach ($articles as $article) { ?>
                                   <div class="blog-card style-four">
                                        <div class="post-body">
                                             <div class="blog-meta flex-wrap d-flex align-items-center gap-2">
                                                  <a href="javascript:void(0);">Admin</a>
                                                  <div class="dot"></div>
                                                  <a href="javascript:void(0);"><?= tgl_indo(date('Y-m-d', strtotime($article->tanggal))); ?></a>
                                             </div>
                                             <a class="post-title h4" href="<?= base_url('v2/articles/detail?slug=' . $article->slug); ?>"><?= $article->judul; ?></a>
                                             <div class="d-flex mt-4">
                                                  <a class="btn btn-outline-primary" href="<?= base_url('v2/articles/detail?slug=' . $article->slug); ?>">Selengkapnya <i class="ti ti-arrow-right"></i></a>
                                             </div>
                                        </div>
                                        <!-- Post Image -->
                                        <div class="post-img">
                                             <?php
                                             $filename = base_url('assets/upload/') . $article->gambar;
                                             if (file_exists('./assets/upload/' . $article->gambar)) { ?>
                                                  <img src="<?= $filename; ?>" alt="<?= $article->judul; ?>" style="max-height: 250px !important;">
                                             <?php } else { ?>
                                                  <img src="<?= base_url('assets/v3/frontend/v2/') ?>img/bg-img/87.jpg" alt="<?= $article->judul; ?>">
                                             <?php } ?>
                                             <img src="<?= $filename; ?>" alt="<?= $article->judul; ?>">
                                        </div>
                                   </div>
                              <?php } ?>

                              <!-- Pagination -->
                              <?= $pagination; ?>
                         </div>
                    <?php } else { ?>
                         <h2 class="error-head">Artikel tidak ditemukan !</h2>
                         <p class="font-16">Kami mohon maaf, tetapi tampaknya artikel yang Anda cari tidak dapat ditemukan.</p>
                         <p class="font-16">Anda dapat kembali ke Beranda dengan mengklik tombol.</p>
                         <a href="<?= base_url() ?>" class="site-button">Beranda</a>
                    <?php } ?>
               </div>

               <div class="col-12 col-md-5 col-lg-4">
                    <?php require_once('_right_content_article.php') ?>
               </div>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>
