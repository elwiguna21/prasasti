<div class="d-flex flex-column gap-5">
     <div class="blog-widget">
          <div class="h4 fw-bold mb-4">Cari Artikel</div>

          <form role="search" method="get">
               <input type="search" placeholder="Cari judul artikel..." class="form-control" value="<?= !empty($_GET['keyword']) ? $_GET['keyword'] : ''; ?>" autocomplete="off">
               <button type="submit" class="btn-primary">
                    <i class="ti ti-search" style="font-size: 20px;"></i>
               </button>
          </form>
     </div>

     <div class="blog-widget">
          <div class="h4 fw-bold mb-4">Artikel Terbaru</div>

          <div class="d-flex flex-column gap-4">

               <?php if (!empty($articles_last)) {
                    foreach ($articles_last as $article_last) {
               ?>
                         <div class="widget-blog-post">
                              <div class="blog-thumbnail">
                                   <?php
                                   $file_name = base_url('assets/upload/') . $article_last->gambar;
                                   ?>
                                   <?php if (file_exists('./assets/upload/' . $article_last->gambar)) { ?>
                                        <img src="<?= $file_name; ?>" alt="<?= $article_last->judul ?>">
                                   <?php } else { ?>
                                        <img src="<?= base_url('assets/v3/frontend/v2/') ?>img/bg-img/122.jpg" alt="<?= $article_last->judul; ?>">
                                   <?php } ?>

                              </div>
                              <div class="blog-content">
                                   <p class="mb-1 text-primary"><?= tgl_indo(date('Y-m-d', strtotime($article_last->tanggal))); ?></p>
                                   <a href="<?= base_url('v2/articles/detail?slug=' . $article_last->slug); ?>"><?= $article_last->judul; ?></a>
                              </div>
                         </div>
               <?php }
               } ?>

          </div>
     </div>

     <div class="blog-widget">
          <div class="h4 fw-bold mb-4">Layanan</div>
          <ul class="blog-list style-two">
               <li><a href="<?= base_url('v2/frontend/services') ?>">Perbaikan Arsip</a></li>
          </ul>
     </div>

     <div class="blog-widget">
          <div class="h4 fw-bold mb-4">Berita Terbaru</div>

          <div class="d-flex flex-column gap-4">
               <?php if (!empty($news_last)) {
                    foreach ($news_last as $news) { ?>
                         <div class="widget-blog-post">
                              <div class="blog-thumbnail">
                                   <?php
                                   if (file_exists('./assets/upload/' . $news->gambar)) {
                                        $news_file     = base_url('assets/upload/') . $news->gambar;
                                   } else {
                                        $news_file     = base_url('assets/v3/frontend/v2/img/bg-img/122.jpg');
                                   }
                                   ?>
                                   <img src="<?= $news_file; ?>" alt="<?= $news->judul; ?>">
                              </div>
                              <div class="blog-content">
                                   <p class="mb-1 text-primary"><?= tgl_indo(date('Y-m-d', strtotime($news->tanggal))); ?></p>
                                   <a href="<?= base_url('v2/news/detail?slug=' . $news->slug) ?>"><?= $news->judul; ?></a>
                              </div>
                         </div>
               <?php }
               } ?>
          </div>
     </div>

     <!-- Widget -->
     <!-- <div class="blog-widget">
          <div class="h4 fw-bold mb-4">Tags</div>

          <ul class="tag-list list-unstyled">
               <li><a href="#">Business</a></li>
               <li><a href="#">Technology</a></li>
               <li><a href="#">Digital</a></li>
               <li><a href="#">IT Solution</a></li>
               <li><a href="#">Finance</a></li>
               <li><a href="#">Software</a></li>
               <li><a href="#">Digital</a></li>
               <li><a href="#">Cyber Security</a></li>
          </ul>
     </div> -->
</div>
