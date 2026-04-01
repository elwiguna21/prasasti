<div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-primary bg-pt" style="background-image:url(<?= base_url('assets/v3/frontend/') ?>images/banner/bnr3.jpg);">
     <div class="container">
          <div class="dlab-bnr-inr-entry">
               <h1 class="text-white">Artikel</h1>
               <!-- Breadcrumb row -->
               <div class="breadcrumb-row">
                    <ul class="list-inline">
                         <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                         <li>Artikel</li>
                    </ul>
               </div>
               <!-- Breadcrumb row END -->
          </div>
     </div>
</div>

<div class="content-area">
     <div class="container">
          <div class="row justify-content-center">
               <!-- Left part start -->
               <div class="col-lg-8">
                    <?php if (!empty($articles)) {
                         if (!empty($_GET['keyword'])) { ?>
                              <p>Hasil pencarian: <?= $articles_total; ?></p>
                         <?php } ?>
                         <?php foreach ($articles as $article) { ?>
                              <div class="blog-post blog-md clearfix wow fadeInUp" data-wow-delay="0.2s">
                                   <div class="dlab-post-media dlab-img-effect zoom-slow">
                                        <a href="<?= base_url('v2/frontend/news/articles_detail?slug=' . $article->slug); ?>">
                                             <?php
                                             // $filename = "https://sisemar.sumedangkab.go.id/assets/upload/" . $article->gambar;
                                             $filename = base_url('./assets/upload/') . $article->gambar;
                                             if (file_exists('./assets/upload' . $article->gambar)) { ?>
                                                  <img src="<?= $filename; ?>" alt="<?= $article->judul; ?>">
                                             <?php } else { ?>
                                                  <img src="<?= base_url('assets/v3/frontend/') ?>images/blog/grid/pic1.jpg" alt="<?= $article->judul; ?>">
                                             <?php } ?>
                                        </a>
                                   </div>
                                   <div class="dlab-post-info">
                                        <div class="dlab-post-title ">
                                             <h4 class="post-title"><a href="<?= base_url('v2/frontend/news/articles_detail?slug=' . $article->slug); ?>"><?= $article->judul; ?></a></h4>
                                        </div>
                                        <div class="dlab-post-meta">
                                             <ul class="d-flex align-items-center">
                                                  <li class="post-date"> <i class="fa fa-calendar"></i><strong><?= $article->tanggal; ?></strong> </li>
                                                  <li class="post-author"><i class="fa fa-user"></i>By <a href="javascript:void(0);">Admin</a> </li>
                                                  <!-- <li class="post-comment"><i class="fa fa-comments"></i> <a href="javascript:void(0);">0</a> </li> -->
                                             </ul>
                                        </div>
                                        <div class="dlab-post-text">
                                             <p><?= substr($article->isi, 0, 100) . '...' ?></p>
                                        </div>
                                        <div class="dlab-post-readmore blog-share">
                                             <a href="<?= base_url('v2/frontend/news/articles_detail?slug=' . $article->slug); ?>" title="READ MORE" rel="bookmark" class="site-button outline outline-1">Selengkapnya
                                                  <i class="fas fa-long-arrow-alt-right"></i>
                                             </a>
                                             <div class="share-btn">
                                                  <ul class="clearfix">
                                                       <li><a href="javascript:void(0);" class="site-button sharp"><i class="fab fa-facebook-f"></i></a></li>
                                                       <li><a href="javascript:void(0);" class="site-button sharp"><i class="fab fa-google-plus-g"></i></a></li>
                                                       <li><a href="javascript:void(0);" class="site-button sharp"><i class="fab fa-linkedin-in"></i></a></li>
                                                       <li><a href="javascript:void(0);" class="site-button sharp"><i class="fab fa-twitter"></i></a></li>
                                                       <li class="share-button"><a href="javascript:void(0);" class="site-button sharp"><i class="fa fa-share-alt"></i></a></li>
                                                  </ul>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         <?php }
                    } else { ?>
                         <div class="container">
                              <div class="dlab-bnr-inr-entry align-m">
                                   <div class="row max-w700 dz_error-404 m-auto">
                                        <div class="col-lg-4 m-tb30">
                                             <div class="bg-primary dz_error text-white">
                                                  404
                                             </div>
                                        </div>
                                        <div class="col-lg-8 m-b30">
                                             <h2 class="error-head">Artikel tidak ditemukan !</h2>
                                             <p class="font-16">Kami mohon maaf, tetapi tampaknya artikel yang Anda cari tidak dapat ditemukan.</p>
                                             <p class="font-16">Anda dapat kembali ke Beranda dengan mengklik tombol.</p>
                                             <a href="<?= base_url('/') ?>" class="site-button">Beranda</a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php } ?>

                    <?= $pagination; ?>
               </div>

               <div class="col-lg-4 sticky-top">
                    <?php require_once('_right_content_article.php') ?>
               </div>
          </div>
     </div>
</div>
