<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin</title>
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">


<body>

<nav class="navbar navbar-inverse navbar-dark bg-primary">
	<div class="container-fluid">
	  <div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">ADMIN</a>
	  </div>
	  <div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
      <li><a href="<?php echo base_url('Panel');?>">Dashboard</a></li>
   
 
     
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data Dinas <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="<?php echo base_url('Datamasterweb/banner');?>">Slide Web</a></li>
            <li><a href="<?php echo base_url('Datamasterweb/galeri');?>">Galeri</a></li>
            <li><a href="<?php echo base_url('Datamasterweb/layanan');?>">Layanan</a></li>
            <li><a href="<?php echo base_url('Datamasterweb/link');?>">Link</a></li>
            <li><a href="<?php echo base_url('Datamasterweb/profil');?>">Profil</a></li>
          </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Download <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('Datamasterweb/agregat');?>">Download Agregat</a></li>
            <li><a href="<?php echo base_url('Datamasterweb/lain');?>">Download Lain-lain</a></li>
          </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informasi <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('Datamasterweb/artikel');?>">Artikel</a></li>
            <li><a href="<?php echo base_url('Datamasterweb/berita');?>">Berita</a></li>
            <li><a href="<?php echo base_url('Datamasterweb/pengumuman');?>">Pengumuman</a></li>
           </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kependudukan <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('Datamasterweb/peragama');?>">Per Agama</a></li>
            <li><a href="<?php echo base_url('Datamasterweb/perkecamatan');?>">Per Kecamatan</a></li>
            <li><a href="<?php echo base_url('Datamasterweb/perpendidikan');?>">Per Pendidikan</a></li>
          </ul>
      </li>
      </ul>
 
		<ul class="nav navbar-nav navbar-right">
      <li><a href=""> Hai <?php echo $this->session->userdata("nama");?></a></li>
		  <li><a href="<?php echo base_url('index.php/Admin/logout');?>">Logout</a></li>
		</ul>
	  </div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
  </nav>


<div class="container-fluid mt-4">
<?php echo $output; ?>
</div>


		

    <?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
      

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

</body>
</html>

