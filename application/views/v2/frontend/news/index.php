<div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-primary bg-pt" style="background-image:url(<?= base_url('assets/v3/frontend/') ?>images/banner/bnr9.jpg);">
     <div class="container">
          <div class="dlab-bnr-inr-entry">
               <h1 class="text-white">Berita</h1>
               <!-- Breadcrumb row -->
               <div class="breadcrumb-row">
                    <ul class="list-inline">
                         <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                         <li>Berita</li>
                    </ul>
               </div>
               <!-- Breadcrumb row END -->
          </div>
     </div>
</div>

<div class="content-area">
     <div class="container">
          <div class="row">
               <!-- Left part start -->
               <div class=" col-lg-8 col-md-12">
                    <?php if (!empty($newslatters)) { ?>
                         <div class="row">
                              <?php foreach ($newslatters as $news) { ?>
                                   <div class="col-lg-6 col-12">
                                        <div class="blog-post blog-lg wow fadeIn" data-wow-delay="0.2s">
                                             <div class="dlab-post-media dlab-img-effect zoom-slow">
                                                  <a href="<?= base_url('v2/frontend/news/detail?slug=' . $news->slug); ?>">
                                                       <?php if (file_exists('./assets/upload/' . $news->gambar)) { ?>
                                                            <img src="<?= base_url('assets/upload/' . $news->gambar); ?>" alt="<?= $news->judul; ?>" style="max-height: 175px !important; ;">
                                                       <?php } else { ?>
                                                            <img src="<?= base_url('assets/v3/frontend/') ?>images/blog/default/thum1.jpg" alt="<?= $news->judul; ?>">
                                                       <?php } ?>
                                                  </a>
                                             </div>
                                             <div class="dlab-post-info">
                                                  <div class="dlab-post-title ">
                                                       <h4 class="post-title"><a href="<?= base_url('v2/frontend/news/detail?slug=' . $news->slug); ?>"><?= $news->judul; ?></a></h4>
                                                  </div>
                                                  <div class="dlab-post-meta">
                                                       <ul class="d-flex align-items-center">
                                                            <li class="post-date"> <i class="fa fa-calendar"></i><strong><?= $news->tanggal; ?></strong> </li>
                                                            <li class="post-author"><i class="fa fa-user"></i>By <a href="javascript:void(0);">Admin</a> </li>
                                                            <!-- <li class="post-comment"><i class="fa fa-comments"></i> <a href="javascript:void(0);">0 Comments</a> </li> -->
                                                       </ul>
                                                  </div>
                                                  <div class="dlab-post-text">
                                                       <p><?= substr($news->isi, 0, 200) . ' ...'; ?></p>
                                                  </div>
                                                  <div class="dlab-post-readmore blog-share">
                                                       <a href="<?= base_url('v2/frontend/news/detail?slug=' . $news->slug); ?>" title="READ MORE" rel="bookmark" class="site-button outline outline-1">Selengkapnya
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
                                   </div>
                              <?php } ?>
                         </div>

                         <?= $pagination; ?>
                    <?php } else { ?>
                         <div class="container">
                              <div class="dlab-bnr-inr-entry align-m">
                                   <div class="row max-w700 dz_error-404 m-auto">
                                        <div class="col-lg-4 m-tb30">
                                             <div class="bg-primary dz_error text-white">
                                                  404
                                             </div>
                                        </div>
                                        <div class="col-lg-8 m-b30">
                                             <h2 class="error-head">Berita tidak ditemukan !</h2>
                                             <p class="font-16">Kami mohon maaf, tetapi tampaknya artikel yang Anda cari tidak dapat ditemukan.</p>
                                             <p class="font-16">Anda dapat kembali ke Beranda dengan mengklik tombol.</p>
                                             <a href="<?= base_url('/') ?>" class="site-button">Beranda</a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php } ?>
               </div>
               <!-- Left part END -->
               <!-- Side bar start -->
               <div class="col-lg-4 col-md-12 sticky-top">
                    <?php require_once('_right_content_news.php') ?>
               </div>
               <!-- Side bar END -->
          </div>
     </div>
</div>
