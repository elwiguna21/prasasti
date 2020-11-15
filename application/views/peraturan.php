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

<div class="container mt-4 mb-4">
<h3>
    <?=  ucwords(str_replace('_', ' ',$judul)) ?><hr>
</h3>
	<div class="row">
		<div class="col-md-12">
      <div class="table-responsive">
  <table class="table table-bordered table-hover table-light" width="100%">
    <thead align="center">
      <th>NO</th>
      <th>Judul</th>
      <th>File</th>
    </thead>
    <tbody>
    <?php 
    $no=1;
    foreach($data as $data){
      ?>
       <tr>
         <td width="100" align="center"><?= $no++ ?></td>
         <td width="800"><?= $data->caption?></td>
         <td  class="text-center"><a href="<?= base_url()?>Front/download/<?= $data->file?>"
                      class="btn btn-outline btn-info btn-block">Download
                      <i class="fa fa-download ml-2"></i>
                    </a></td>
       </tr>
      
        
    <?php } ?>        
    </tbody>
  </table>
    </div>
    </div>

	</div>
</div>



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
    <style>
        .btn:focus, .btn:active, button:focus, button:active {
            outline: none !important;
            box-shadow: none !important;
            }

            #image-gallery .modal-footer{
            display: block;
            }

            .thumb{
            margin-top: 15px;
            margin-bottom: 15px;
            }
    </style>

    <script>
        let modalId = $('#image-gallery');

$(document)
  .ready(function () {

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
      $('#show-previous-image, #show-next-image')
        .show();
      if (counter_max === counter_current) {
        $('#show-next-image')
          .hide();
      } else if (counter_current === 1) {
        $('#show-previous-image')
          .hide();
      }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }

          selector = $('[data-image-id="' + current_image + '"]');
          updateGallery(selector);
        });

      function updateGallery(selector) {
        let $sel = selector;
        current_image = $sel.data('image-id');
        $('#image-gallery-title')
          .text($sel.data('title'));
        $('#image-gallery-image')
          .attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGallery($(this));
        });
    }
  });

// build key actions
$(document)
  .keydown(function (e) {
    switch (e.which) {
      case 37: // left
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });

    </script>
</body>
</html>