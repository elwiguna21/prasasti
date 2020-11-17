<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SISEMAR</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="shortcut icon" href="<?= base_url()?>assets/image/logo.gif" type="image/png" sizes="16x16">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
  <!-- corousel post -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
 <!------ Include the above in your HEAD tag ---------->
<link href="<?= base_url() ?>assets/front/app.css" rel="stylesheet">
 <script src="<?= base_url() ?>assets/front/app.js" type="text/javascript"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <img src="<?= base_url() ?>assets/image/logo.gif" alt="" height="30"> 
        <a class="navbar-brand" href="<?= base_url() ?>"> SISEMAR</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span> 
        </button>
        <div class="collapse navbar-collapse" id="mobile_nav">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">
        </ul>
        <ul class="navbar-nav navbar-light">
            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Home</a></li>
            <li class="nav-item dmenu dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Profil
                </a>
                <div class="dropdown-menu sm-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= base_url() ?>Front/sambutan">Sambutan</a>
                    <a class="dropdown-item" href="<?= base_url() ?>Front/visi">Visi</a>
                    <a class="dropdown-item" href="<?= base_url() ?>Front/misi">Misi</a>
                    <a class="dropdown-item" href="<?= base_url() ?>Front/gambaran_umum">Gambaran Umum</a>
                    <a class="dropdown-item" href="<?= base_url() ?>Front/tugas_fungsi">Tugas dan Fungsi</a>
                    <a class="dropdown-item" href="<?= base_url() ?>Front/sejarah">Sejarah</a>
                    <a class="dropdown-item" href="<?= base_url() ?>Front/struktur_organisasi">Struktur Organisasi</a>
                </div>
            </li>
            <li class="nav-item dmenu dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Informasi
                </a>
                <div class="dropdown-menu sm-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= base_url() ?>Front/artikel">Artikel</a>
                    <a class="dropdown-item" href="<?= base_url() ?>Front/berita">Berita</a>           
                </div>
            </li>           
            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>Front/peraturan">Peraturan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>Front/galeri">Galeri</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>Admin">Login</a></li>
   
        </ul>
        </div>
    </div>
</nav>
<style>
    .carousel {
  position: relative;
  height: auto;

    }
.carousel-item {
  position: relative;
  display: none;
  align-items: center;
  width: 100%;
  height: auto;
  max-height: 600px;
 
  
}


</style>
    <div id="carouselExampleFade" class="carousel slide carousel-fade mb-4" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach($banner1 as $data){?>
            <div class="carousel-item active">
                <img src="<?= base_url() ?>assets/upload/<?= $data->file?>" class="d-block w-100" alt="...">
            </div>
            <?php }?>
            <?php foreach($banner as $data){?>
            <div class="carousel-item">
                <img src="<?= base_url() ?>assets/upload/<?= $data->file?>" class="d-block w-100" alt="...">
            </div>
            <?php }?>
           
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
	    <br/>
	   <div class="col text-center">
		<h2>DATA ARSIP STATIS</h2>
		<p>Berikut ini adalah data arsip statis di lingkungan Dinas Arsip dan Perpustakaan Sumedang</p>
		</div>
	</div>
		<div class="row text-center">
	        <div class="col">
                <div class="counter">
                <i class="fa fa-book fa-2x"></i>
                <h2 class="timer count-title count-number" data-to="<?php foreach($jmlarsip as $data){echo $data->total;}?>" data-speed="1000"></h2>
                <p class="count-text ">Arsip</p>
                </div>
            </div>
            <div class="col">
               <div class="counter">
                <i class="fa fa-home fa-2x"></i>
                <h2 class="timer count-title count-number" data-to="<?php foreach($jmlskpd as $data){echo $data->total;}?>" data-speed="1000"></h2>
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
                <?php foreach($berita as $data){?>
                <div class="post-slide">
                    <div class="post-img">
                        <a href="<?= base_url() ?>Front/beritadetail/<?= $data->slug?>">
                            <img src="<?= base_url() ?>assets/upload/<?= $data->gambar?>" alt="">
                        </a>
                    </div>
                    <div class="post-review">
                        <h3 class="post-title"><a href="<?= base_url() ?>Front/beritadetail/<?= $data->slug?>"><?= $data->judul?></a></h3>
                        <ul class="post-bar">
                            <li><i class="fa fa-user"></i><a href="#">admin</a></li>
                            <li><i class="fa fa-calendar"></i><a href="#"><?= $data->tanggal?></a></li>
                        </ul>
                        <p class="post-description"><?= substr($data->isi,0,100)?></p>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<div class="container text-right mt-3">
<h3><a href="<?= base_url()?>Front/berita">Semua Berita <i class="fa fa-arrow-right"></i></a></h3>
</div>
<hr>

<div class="demo mt-4">
    <div class="container">
        <h3 class="h3">Artikel Terbaru </h3>    
        <div class="row">
            <div class="col-md-12">
                <div id="news-slider2" class="owl-carousel">
                <?php foreach($artikel as $data){?>
                    <div class="post-slide2">
                        <div class="post-img">
                            <a href="<?= base_url() ?>Front/artikeldetail/<?= $data->slug?>"><img src="<?= base_url() ?>assets/upload/<?= $data->gambar?>" alt=""></a>
                        </div>
                        <div class="post-content">
                            <h3 class="post-title"><a href="#"><?= $data->judul?></a></h3>
                            <p class="post-description">
                            <?= substr($data->isi,0,100)?>
                            </p>
                            <ul class="post-bar">
                                <li><i class="fa fa-calendar"></i> <?= $data->tanggal?></li>
                            </ul>
                            <a href="<?= base_url() ?>Front/artikeldetail/<?= $data->slug?>" class="read-more">Selengkapnya</a>
                        </div>
                    </div>
                    <?php }?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container text-right mt-3">
<h3><a href="<?= base_url()?>Front/artikel">Semua Artikel <i class="fa fa-arrow-right"></i></a></h3>
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
                    <?php foreach($faq as $data){?>
                        <a class="nav-item nav-link" id="nav-<?= $data->id?>-tab" data-toggle="tab" href="#nav-<?= $data->id?>" role="tab" aria-controls="nav-<?= $data->id?>" aria-selected="true"><?= $data->pertanyaan?></a>
                    <?php } ?>
					</div>
				</nav>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <?php foreach($faq as $data){?>
					<div class="tab-pane fade show" id="nav-<?= $data->id?>" role="tabpanel" aria-labelledby="nav-<?= $data->id?>-tab">
                    <?= $data->jawaban?>
                    </div>
                    <?php } ?>
				</div>
			
			</div>
		</div>
	</div>
</section>

<section id="footer">
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>SISEMAR</h5>
					<ul class="list-unstyled quick-links">
						<li>Merupakan aplikasi untuk pencatatn arsip statis dilingkungan Dinas Arsip dan Perpustakaan Sumedang</li>
					</ul>
                </div>
                <?php foreach($profil as $data){
                 $telepon = $data->telepon;
                 $alamat = $data->alamat;   
                }?>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Kontak</h5>
					<ul class="list-unstyled quick-links">
						<li><a href=""><i class="fa fa-phone"></i><?= $telepon ?></a></li>
						<li><a href=""><i class="fa fa-home"></i><?= $alamat ?></a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Link Terkait</h5>
					<ul class="list-unstyled quick-links">
                    <?php foreach($link as $data){?>
						<li><a href="<?= $data->link?>"><i class="fa fa-angle-double-right"></i><?= $data->judul?></a></li>
                    <?php } ?>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
				
				</div>
				<hr>
			</div>	
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
					<a>Dinas Arsip Dan Perpustakaan Kabupaten Sumedang</a>
					<br><a class="h6">© All right Reversed.<a class="text-green ml-2" href="" target="_blank"><?= Date('Y')?></a></a>
				</div>
				<hr>
			</div>	
		</div>
	</section>
    <!-- ./Footer -->
    
</body>
</html>


