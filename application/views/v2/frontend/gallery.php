<div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-primary bg-pt" style="background-image:url(<?= base_url('assets/v3/frontend/') ?>images/banner/bnr9.jpg);">
     <div class="container">
          <div class="dlab-bnr-inr-entry">
               <h1 class="text-white">Galeri</h1>
               <div class="breadcrumb-row">
                    <ul class="list-inline">
                         <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                         <li>Galeri</li>
                    </ul>
               </div>
               <!-- Breadcrumb row END -->
          </div>
     </div>
</div>

<div class="content-block">
     <!-- Portfolio  -->
     <div class="section-full content-inner-2 portfolio text-uppercase" id="portfolio">
          <div class="container">
               <div class="clearfix">
                    <?php if (!empty($galleries)) { ?>
                         <ul id="masonry" class="dlab-gallery-listing gallery-grid-4 gallery mfp-gallery port-style1">
                              <?php foreach ($galleries as $gallery) { ?>
                                   <li class="web design card-container col-lg-4 col-md-6 col-sm-6 p-a0 wow zoomIn" data-wow-delay="0.2s">
                                        <div class="dlab-box dlab-gallery-box">
                                             <div class="dlab-media dlab-img-overlay1 dlab-img-effect">
                                                  <a href="javascript:void(0);"> <img src="<?= $gallery->file; ?>" alt=""> </a>
                                                  <div class="overlay-bx">
                                                       <div class="overlay-icon align-b text-white">
                                                            <div class="text-white text-left port-box">
                                                                 <h5><?= $gallery->caption; ?></h5>
                                                                 <!-- <p>Branding and Identity</p> -->
                                                                 <a href="<?= $gallery->file; ?>" class="mfp-link portfolio-fullscreen" title="<?= $gallery->caption ?>"><i class="ti-fullscreen icon-bx-xs"></i></a>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </li>
                              <?php } ?>
                         </ul>
                    <?php } else { ?>

                    <?php } ?>

               </div>
          </div>
     </div>
