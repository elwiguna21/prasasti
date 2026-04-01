<aside class="side-bar right">
     <div class="widget">
          <h5 class="widget-title style-1">Cari artikel</h5>
          <div class="search-bx style-1">
               <form role="search" method="get">
                    <div class="input-group">
                         <input name="keyword" class="form-control" placeholder="Masukan judul artikel ..." type="text" value="<?= !empty($_GET['keyword']) ? $_GET['keyword'] : ''; ?>" autocomplete="off">
                         <span class="input-group-btn">
                              <button type="submit" class="fa fa-search text-primary"></button>
                         </span>
                    </div>
               </form>
          </div>
     </div>
     <div class="widget recent-posts-entry">
          <h5 class="widget-title style-1">Artikel Terbaru</h5>
          <div class="widget-post-bx">
               <?php if (!empty($articles_last)) {
                    foreach ($articles_last as $article_last) {
               ?>
                         <div class="widget-post clearfix">
                              <div class="dlab-post-media">
                                   <?php
                                   $file_name = base_url('assets/upload/') . $article_last->gambar;
                                   ?>
                                   <?php if (file_exists('./assets/upload/' . $article_last->gambar)) { ?>
                                        <img src="<?= $file_name; ?>" width="200" height="143" alt="<?= $article_last->judul ?>">
                                   <?php } else { ?>
                                        <img src="<?= base_url('assets/v3/frontend/') ?>images/blog/recent-blog/pic1.jpg" width="200" height="143" alt="<?= $article_last->judul; ?>">
                                   <?php } ?>
                              </div>
                              <div class="dlab-post-info">
                                   <div class="dlab-post-header">
                                        <h6 class="post-title"><a href="<?= base_url('v2/frontend/news/articles_detail?slug=' . $article_last->slug); ?>"><?= $article_last->judul; ?></a></h6>
                                   </div>
                                   <div class="dlab-post-meta">
                                        <ul>
                                             <li class="post-author">By Admin</li>
                                             <li class="post-comment"><i class="fa fa-calendar"></i> <?= $article_last->tanggal; ?></li>
                                        </ul>
                                   </div>
                              </div>
                         </div>
                    <?php }
               } else { ?>

               <?php } ?>

          </div>
     </div>

     <div class="widget widget-newslatter">
          <h5 class="widget-title style-1">Newsletter</h5>
          <div class="news-box">
               <p>Enter your e-mail and subscribe to our newsletter.</p>
               <form class="dzSubscribe" action="script/mailchamp.php" method="post">
                    <div class="dzSubscribeMsg"></div>
                    <div class="input-group">
                         <input name="dzEmail" required="required" type="email" class="form-control" placeholder="Your Email">
                         <button name="submit" value="Submit" type="submit" class="site-button btn-block radius-no">Subscribe Now</button>
                    </div>
               </form>
          </div>
     </div>

     <div class="widget widget_archive">
          <h5 class="widget-title style-1">Layanan</h5>
          <ul>
               <li><a href="<?= base_url('v2/frontend/profiles/vision') ?>">Profil</a></li>
               <li><a href="<?= base_url('v2/frontend/profiles/history') ?>">Sejarah</a></li>
               <li><a href="<?= base_url('v2/frontend/news') ?>">Berita</a></li>
               <li><a href="<?= base_url('v2/frontend/services') ?>">Perbaikan Arsip</a></li>
               <li><a href="<?= base_url('v2/frontend/regulations') ?>">Peraturan</a></li>
          </ul>
     </div>

     <div class="widget widget-project">
          <h5 class="widget-title style-1">Berita</h5>
          <div class="widget-project-box owl-none owl-loaded owl-theme owl-carousel dots-style-1 owl-dots-black-full">
               <?php if (!empty($news_last)) {
                    foreach ($news_last as $news) { ?>
                         <div class="item">
                              <div class="dlab-box portfolio-box">
                                   <div class="dlab-media dlab-img-effect dlab-img-overlay1">
                                        <?php
                                        if (file_exists('./assets/upload/' . $news->gambar)) {
                                             $news_file     = base_url('assets/upload/') . $news->gambar;
                                        } else {
                                             $news_file     = base_url('assets/v3/frontend/images/our-services/pic1.jpg');
                                        }
                                        ?>
                                        <img src="<?= $news_file; ?>" alt="<?= $news->judul; ?>" style="max-height: 200px !important;">
                                        <div class="overlay-bx">
                                             <div class="overlay-icon text-white">
                                                  <h5><?= $news->judul; ?></h5>
                                                  <p class="m-b10"><?= substr($news->isi, 0, 60) . '...' ?></p>
                                                  <a href="<?= $news_file; ?>" class="mfp-link" title="Title Come Here"> <i class="ti-fullscreen icon-bx-xs"></i> </a>
                                                  <a href="<?= base_url('v2/frontend/news/detail?slug=' . $news->slug) ?>" target="_blank"><i class="ti-arrow-top-right icon-bx-xs"></i></a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php }
               } else { ?>
                    <div class="item"><img src="<?= base_url('assets/v3/frontend/') ?>images/our-services/pic2.jpg" alt=""></div>
               <?php } ?>
          </div>
     </div>

     <div class="widget widget_tag_cloud radius">
          <h5 class="widget-title style-1">Tags</h5>
          <div class="tagcloud">
               <a href="javascript:void(0);">Design</a>
               <a href="javascript:void(0);">User interface</a>
               <a href="javascript:void(0);">SEO</a>
               <a href="javascript:void(0);">WordPress</a>
               <a href="javascript:void(0);">Development</a>
               <a href="javascript:void(0);">Joomla</a>
               <a href="javascript:void(0);">Design</a>
               <a href="javascript:void(0);">User interface</a>
               <a href="javascript:void(0);">SEO</a>
               <a href="javascript:void(0);">WordPress</a>
               <a href="javascript:void(0);">Development</a>
               <a href="javascript:void(0);">Joomla</a>
               <a href="javascript:void(0);">Design</a>
               <a href="javascript:void(0);">User interface</a>
               <a href="javascript:void(0);">SEO</a>
               <a href="javascript:void(0);">WordPress</a>
               <a href="javascript:void(0);">Development</a>
               <a href="javascript:void(0);">Joomla</a>
          </div>
     </div>
</aside>
