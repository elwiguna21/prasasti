 <nav class="navbar navbar-expand-lg navbar-light sticky-top">
     <div class="container-fluid">
         <img src="<?= base_url() ?>assets/image/logo.png" alt="" class="nav-img">
         <button class="navbar-toggler mb-2" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse mb-2" id="mobile_nav">
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