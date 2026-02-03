 <!-- ./Head -->
 <?php $this->load->view('partials/head'); ?>
 <!-- ./Head -->

 <body>
     <!-- ./Navbar -->
     <?php $this->load->view('partials/navbar'); ?>
     <!-- ./Navbar -->

     <div id="carouselExampleFade" class="carousel slide carousel-fade mb-4" data-ride="carousel">
         <div class="carousel-inner">
             <?php foreach ($banner1 as $data) { ?>
                 <div class="carousel-item active">
                     <img src="<?= base_url() ?>assets/upload/<?= $data->file ?>" class="d-block w-100" alt="...">
                 </div>
             <?php } ?>
             <?php foreach ($banner as $data) { ?>
                 <div class="carousel-item">
                     <img src="<?= base_url() ?>assets/upload/<?= $data->file ?>" class="d-block w-100" alt="...">
                 </div>
             <?php } ?>

             <!--https://upload.wikimedia.org/wikipedia/commons/8/8d/Yarra_Night_Panorama%2C_Melbourne_-_Feb_2005.jpg-->
         </div>
         <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
             <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
             <span class="carousel-control-next-icon" aria-hidden="true"></span>
             <span class="sr-only">Next</span>
         </a>
     </div>

     <hr>
     <div class="container mt-4 mb-4">
         <div class="row">
             <br />
             <div class="col text-center">
                 <h2>DATA ARSIP STATIS</h2>
                 <p>Berikut ini adalah data arsip statis di lingkungan Dinas Arsip dan Perpustakaan Sumedang</p>
             </div>
         </div>
         <div class="row text-center">
             <div class="col">
                 <div class="counter">
                     <i class="fa fa-book fa-2x"></i>
                     <h2 class="timer count-title count-number" data-to="<?php foreach ($jmlarsip as $data) {
                                                                                echo $data->total;
                                                                            } ?>" data-speed="1000"></h2>
                     <p class="count-text ">Arsip</p>
                 </div>
             </div>
             <div class="col">
                 <div class="counter">
                     <i class="fa fa-home fa-2x"></i>
                     <h2 class="timer count-title count-number" data-to="<?php foreach ($jmlskpd as $data) {
                                                                                echo $data->total;
                                                                            } ?>" data-speed="1000"></h2>
                     <p class="count-text ">SKPD</p>
                 </div>
             </div>

         </div>
     </div>
     <hr>
     <div class="container mt-4">
         <h3 class="h3">Berita Terbaru </h3>
         <div class="row">
             <div class="col-md-12">
                 <div id="news-slider" class="owl-carousel">
                     <?php foreach ($berita as $data) { ?>
                         <div class="post-slide">
                             <div class="post-img">
                                 <a href="<?= base_url() ?>Front/beritadetail/<?= $data->slug ?>">
                                     <img src="<?= base_url() ?>assets/upload/<?= $data->gambar ?>" alt="">
                                 </a>
                             </div>
                             <div class="post-review">
                                 <h3 class="post-title"><a href="<?= base_url() ?>Front/beritadetail/<?= $data->slug ?>"><?= $data->judul ?></a></h3>
                                 <ul class="post-bar">
                                     <li><i class="fa fa-user"></i><a href="#">admin</a></li>
                                     <li><i class="fa fa-calendar"></i><a href="#"><?= $data->tanggal ?></a></li>
                                 </ul>
                                 <p class="post-description"><?= substr($data->isi, 0, 100) ?></p>
                             </div>
                         </div>
                     <?php } ?>
                 </div>
             </div>
         </div>
     </div>

     <div class="container text-right mt-3">
         <h3><a href="<?= base_url() ?>Front/berita">Semua Berita <i class="fa fa-arrow-right"></i></a></h3>
     </div>
     <hr>

     <div class="demo mt-4">
         <div class="container">
             <h3 class="h3">Artikel Terbaru </h3>
             <div class="row">
                 <div class="col-md-12">
                     <div id="news-slider2" class="owl-carousel">
                         <?php foreach ($artikel as $data) { ?>
                             <div class="post-slide2">
                                 <div class="post-img">
                                     <a href="<?= base_url() ?>Front/artikeldetail/<?= $data->slug ?>"><img src="<?= base_url() ?>assets/upload/<?= $data->gambar ?>" alt=""></a>
                                 </div>
                                 <div class="post-content">
                                     <h3 class="post-title"><a href="#"><?= $data->judul ?></a></h3>
                                     <p class="post-description">
                                         <?= substr($data->isi, 0, 100) ?>
                                     </p>
                                     <ul class="post-bar">
                                         <li><i class="fa fa-calendar"></i> <?= $data->tanggal ?></li>
                                     </ul>
                                     <a href="<?= base_url() ?>Front/artikeldetail/<?= $data->slug ?>" class="read-more">Selengkapnya</a>
                                 </div>
                             </div>
                         <?php } ?>

                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="container text-right mt-3">
         <h3><a href="<?= base_url() ?>Front/artikel">Semua Artikel <i class="fa fa-arrow-right"></i></a></h3>
     </div>
     <hr>

     <!-- Tabs -->
     <section id="tabs">
         <div class="container">
             <h6 class="section-title h1">FAQ</h6>
             <div class="row">
                 <div class="col-xs-12 ">
                     <nav>
                         <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                             <?php foreach ($faq as $data) { ?>
                                 <a class="nav-item nav-link" id="nav-<?= $data->id ?>-tab" data-toggle="tab" href="#nav-<?= $data->id ?>" role="tab" aria-controls="nav-<?= $data->id ?>" aria-selected="true"><?= $data->pertanyaan ?></a>
                             <?php } ?>
                         </div>
                     </nav>
                     <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                         <?php foreach ($faq as $data) { ?>
                             <div class="tab-pane fade show" id="nav-<?= $data->id ?>" role="tabpanel" aria-labelledby="nav-<?= $data->id ?>-tab">
                                 <?= $data->jawaban ?>
                             </div>
                         <?php } ?>
                     </div>

                 </div>
             </div>
         </div>
     </section>

     <!-- ./Footer -->
     <?php $this->load->view('partials/footer'); ?>
     <!-- ./Footer -->

 </body>

 </html>