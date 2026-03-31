<div class="dlab-bnr-inr overlay-primary bg-pt" style="background-image:url(<?= base_url('assets/v3/frontend/') ?>images/banner/bnr7.jpg);">
     <div class="container">
          <div class="dlab-bnr-inr-entry">
               <h1 class="text-white"><?= $newslatter->judul; ?></h1>
               <!-- Breadcrumb row -->
               <div class="breadcrumb-row">
                    <ul class="list-inline">
                         <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                         <li><a href="<?= base_url('v2/frontend/news') ?>">Berita</a></li>
                         <li>Detail</li>
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
               <div class="col-lg-8 col-12">
                    <!-- blog start -->
                    <div class="blog-post blog-single">
                         <div class="dlab-post-media dlab-img-effect zoom-slow wow fadeIn m-b10" data-wow-delay="0.2s"> <a href="javascript:void(0);"><img src="<?= $newslatter->gambar; ?>" alt=""></a> </div>
                         <div class="dlab-post-meta m-b20">
                              <ul class="d-flex align-items-center">
                                   <li class="post-date"> <i class="fa fa-calendar"></i><strong><?= $newslatter->tanggal; ?></strong></li>
                                   <li class="post-author"><i class="fa fa-user"></i>By <a href="javascript:void(0);">Admin</a> </li>
                                   <!-- <li class="post-comment"><i class="fa fa-comments"></i> <a href="javascript:void(0);">0 Comments</a> </li> -->
                              </ul>
                         </div>
                         <div class="dlab-post-text">
                              <p class="text-justify"><?= $newslatter->isi; ?></p>
                         </div>
                         <div class="dlab-post-tags clear">
                              <div class="post-tags"> <a href="javascript:void(0);">Child </a> <a href="javascript:void(0);">Eduction </a> <a href="javascript:void(0);">Money </a> <a href="javascript:void(0);">Resturent </a> </div>
                         </div>
                         <div class="dlab-divider bg-gray-dark op4"><i class="icon-dot c-square"></i></div>
                         <div class="share-details-btn">
                              <ul>
                                   <li>
                                        <h5 class="m-a0">Share Post</h5>
                                   </li>
                                   <li><a href="javascript:void(0);" class="site-button facebook button-sm"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                                   <li><a href="javascript:void(0);" class="site-button google-plus button-sm"><i class="fab fa-google-plus-g"></i> Google Plus</a></li>
                                   <li><a href="javascript:void(0);" class="site-button linkedin button-sm"><i class="fab fa-linkedin-in"></i> Linkedin</a></li>
                                   <li><a href="javascript:void(0);" class="site-button instagram button-sm"><i class="fab fa-instagram"></i> Instagram</a></li>
                                   <li><a href="javascript:void(0);" class="site-button twitter button-sm"><i class="fab fa-twitter"></i> Twitter</a></li>
                                   <li><a href="javascript:void(0);" class="site-button whatsapp button-sm"><i class="fab fa-whatsapp"></i> Whatsapp</a></li>
                              </ul>
                         </div>
                    </div>
                    <!-- blog END -->
               </div>
               <!-- Left part END -->
               <!-- Right part START -->
               <div class="col-lg-4 sticky-top">
                    <?php require_once('_right_content_news.php') ?>
               </div>
               <!-- Right part END -->

          </div>
     </div>
</div>
