<style>
     .contact-form-bx label,
     .contact-form-bx .form-control {
          color: #fff !important;
     }

     .contact-form-bx .input-group::after {
          background: #fff !important;
     }

     .alert-danger {
          color: #721c24;
          background-color: #f8d7da;
          border-color: #f5c6cb;
     }

     .alert-success {
          color: #155724;
          background-color: #d4edda;
          border-color: #c3e6cb;
     }

     .alert {
          position: relative;
          padding: .75rem 1.25rem;
          margin-bottom: 1rem;
          border: 1px solid transparent;
          border-radius: .25rem;
     }

     .alert-dismissible .close {
          position: absolute;
          top: 0;
          right: 0;
          padding: .75rem 1.25rem;
          color: inherit;
     }

     button.close {
          padding: 0;
          background-color: transparent;
          border: 0;
     }

     .close {
          float: right;
          font-size: 1.5rem;
          font-weight: 700;
          line-height: 1;
          color: #000;
          text-shadow: 0 1px 0 #fff;
          opacity: .5;
     }
</style>
<div class="dlab-bnr-inr overlay-primary" style="background-image:url(<?= base_url('assets/v3/frontend/') ?>images/banner/bnr5.jpg);">
     <div class="container">
          <div class="dlab-bnr-inr-entry">
               <h1 class="text-white">Layanan Perbaikan Arsip</h1>
               <!-- Breadcrumb row -->
               <div class="breadcrumb-row">
                    <ul class="list-inline">
                         <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                         <li>Layanan</li>
                    </ul>
               </div>
               <!-- Breadcrumb row END -->
          </div>
     </div>
</div>

<div class="content-block">
     <div class="section-full content-inner">
          <div class="container">
               <?php if (!empty($this->session->flashdata('status'))) { ?>
                    <div class="alert alert-<?= ($this->session->flashdata('status') == 200) ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                         <span class="fw-bold"><?= ($this->session->flashdata('status') == 200) ? 'Berhasil' : 'Kesalahan'; ?>!</span> <?= (!empty($this->session->flashdata('message'))) ? $this->session->flashdata('message') : 'Terjadi kesalahan saat mengunggah data' ?>.
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
               <?php } ?>

               <div class="section-head text-black text-center">
                    <h4 class="text-gray-dark m-b10">Layanan</h4>
                    <h2 class="box-title m-tb0">Perbaikan Arsip<span class="bg-primary"></span></h2>
                    <p>Layanan ini merupakan untuk melayani masyarakat yang ingin memperbaiki arsip yang telah rusak. Kami akan membantu Anda memperbaikinya, ikuti langkah dibawah ini.</p>
               </div>
          </div>
          <div class="container">
               <div class="row ">
                    <div class="col-md-4 col-sm-6 m-b30 wow zoomIn" data-wow-delay="0.2s">
                         <div class="icon-bx-wraper expertise  bx-style-1 p-a30 center">
                              <div class="icon-lg m-b20"> <a href="javascript:void(0);" class="icon-cell"><i class="flaticon-file"></i></a> </div>
                              <div class="icon-content">
                                   <h5 class="dlab-tilte text-uppercase"><a href="javascript:void(0);">Terbuka Umum</a></h5>
                                   <p>Perbaikan arsip yang rusak untuk umum / masyarakat Kabupaten Sumedang.</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-4 col-sm-6 m-b30 wow zoomIn" data-wow-delay="0.4s">
                         <div class="icon-bx-wraper expertise  bx-style-1 p-a30 center">
                              <div class="icon-lg m-b20"> <a href="javascript:void(0);" class="icon-cell"><i class="flaticon-notebook"></i></a> </div>
                              <div class="icon-content">
                                   <h5 class="dlab-tilte text-uppercase"><a href="javascript:void(0);">Mudah & Cepat</a></h5>
                                   <p>Permohonan perbaikan arsip yang rusak secara online, dapat dilakukan kapanpun & dimanapun.</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-4 col-sm-6 m-b30 wow zoomIn" data-wow-delay="0.6s">
                         <div class="icon-bx-wraper expertise  bx-style-1 p-a30 center">
                              <div class="icon-lg m-b20"> <a href="javascript:void(0);" class="icon-cell"><i class="flaticon-money"></i></a> </div>
                              <div class="icon-content">
                                   <h5 class="dlab-tilte text-uppercase"><a href="javascript:void(0);">Biaya Gratis</a></h5>
                                   <p>Layanan perbaikan arsip tidak dikenakan retribusi daerah (gratis). </p>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </div>
     <!-- Our Services -->
     <!-- Why Chose Us -->
     <div class="section-full content-inner-1 overlay-primary about-service bg-img-fix" style="background-image:url(<?= base_url('assets/v3/frontend/') ?>images/background/bg1.jpg);">
          <div class="container">
               <div class="section-head text-white text-center">
                    <h2 class="box-title m-tb0 max-w800 m-auto">Layanan Perbaikan Arsip<span class="bg-primary"></span></h2>
                    <p>Berikut ini merupakan data statistik dari layanan perbaikan arsip.</p>
                    <form class="row text-white dezPlaceAni justify-content-center align-items-center" action="<?= base_url('v2/services') ?>" method="get">
                         <div class="col-lg-7 contact-form-bx text-center">
                              <div class="form-group">
                                   <div class="input-group">
                                        <label>Masukan kode unik permohonan perbaikan arsip</label>
                                        <input name="code" type="text" class="form-control" placeholder="" autocomplete="off" value="<?= (!empty($_GET['code'])) ? $_GET['code'] : '' ?>">
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-2 col-md-3">
                              <button type="submit" class="site-button button-md radius-xl white btn-block">
                                   <i class="ti-search"></i>
                              </button>
                         </div>
                    </form>
               </div>
          </div>
          <div class="choses-info text-white">
               <div class="container-fluid">
                    <div class="row choses-info-content">
                         <div class="col-lg-3 col-md-3 col-sm-6 p-a30 wow zoomIn" data-wow-delay="0.2s">
                              <h2 class="m-t0 m-b10 font-weight-400 font-45"><i class="ti-bag m-r10"></i><span class="counter"><?= $total ?></span></h2>
                              <h4 class="font-weight-300 m-t0">Total Arsip Perbaikan</h4>
                         </div>
                         <div class="col-lg-3 col-md-3 col-sm-6 p-a30 wow zoomIn" data-wow-delay="0.4s">
                              <h2 class="m-t0 m-b10 font-weight-400 font-45"><i class="ti-user m-r10"></i><span class="counter"><?= $process; ?></span></h2>
                              <h4 class="font-weight-300 m-t0">Diajukan</h4>
                         </div>
                         <div class="col-lg-3 col-md-3 col-sm-6 p-a30 wow zoomIn" data-wow-delay="0.6s">
                              <h2 class="m-t0 m-b10 font-weight-400 font-45"><i class="ti-check m-r10"></i><span class="counter"><?= $done; ?></span></h2>
                              <h4 class="font-weight-300 m-t0">Selesai</h4>
                         </div>
                         <div class="col-lg-3 col-md-3 col-sm-6 p-a30 wow zoomIn" data-wow-delay="0.8s">
                              <h2 class="m-t0 m-b10 font-weight-400 font-45"><i class="ti-close m-r10"></i><span class="counter"><?= $reject; ?></span></h2>
                              <h4 class="font-weight-300 m-t0">Ditolak</h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- Why Chose Us End -->
     <div class="section-full content-inner-1 m-b80">
          <div class="container">
               <div class="row">
                    <div class="col-lg-12">
                         <div class="section-head text-center">
                              <h2 class="box-title m-tb0">Ajukan Perbaikan Arsip<span class="bg-primary"></span></h2>
                              <p> Lengkapi form dibawah ini untuk permohonan perbaikan arsip Anda. </p>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- Get in touch -->
     <div class="section-full overlay-primary-dark bg-img-fix" style="background-image:url(<?= base_url('assets/v3/frontend/') ?>images/background/bg1.jpg);">
          <div class="container">
               <div class="row">
                    <div class="col-lg-5 col-md-5 content-inner chosesus-content text-white">
                         <h2 class="box-title m-b15 wow fadeInLeft" data-wow-delay="0.2s">Perbaikan Arsip<span class="bg-primary"></span></h2>
                         <h4 class="wow fadeInLeft" data-wow-delay="0.8s">Ikuti langkah dibawah ini:</h4>
                         <ul class="list-checked white wow fadeInLeft" data-wow-delay="1s">
                              <li><span>Siapkan berkas arsip yang akan diperbaiki.</span></li>
                              <li><span>Ajukan permohonan perbaikan arsip melalui form yang telah disediakan. Pastikan menggunakan kontak yang dapat dihubungi.</span></li>
                              <li><span>Tim kami akan segera memproses dan menghubungi Anda.</span></li>
                         </ul>
                    </div>
                    <div class="col-lg-7 col-md-7 m-b30">
                         <form class="inquiry-form wow fadeInUp" method="post" data-wow-delay="0.2s" action="<?= base_url('v2/services/add') ?>" enctype="multipart/form-data">
                              <h3 class="box-title m-t0 m-b10">Lengkapi <span class="text-primary">form</span></h3>
                              <p>Gunakan email dan kontak yang aktif agar mudah dihubungi! Pastikan foto arsip pada bagian yang rusak terlihat jelas.</p>
                              <div class="row">
                                   <div class="col-lg-6">
                                        <div class="form-group">
                                             <div class="input-group">
                                                  <span class="input-group-addon"><i class="ti-user text-primary"></i></span>
                                                  <input name="fullname" type="text" required class="form-control" placeholder="Nama lengkap anda" autocomplete="off">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-lg-6">
                                        <div class="form-group">
                                             <div class="input-group">
                                                  <span class="input-group-addon"><i class="ti-mobile text-primary"></i></span>
                                                  <input name="phone" type="text" required class="form-control" placeholder="No.HP / WhatsApp">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-lg-12">
                                        <div class="form-group">
                                             <div class="input-group">
                                                  <span class="input-group-addon"><i class="ti-email text-primary"></i></span>
                                                  <input name="email" type="email" class="form-control" required placeholder="Email aktif anda" autocomplete="off">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-lg-12">
                                        <div class="form-group">
                                             <div class="input-group">
                                                  <span class="input-group-addon"><i class="ti-map text-primary"></i></span>
                                                  <textarea name="address" rows="4" class="form-control" required placeholder="Masukan alamat anda"></textarea>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-lg-12">
                                        <div class="form-group">
                                             <div class="input-group">
                                                  <span class="input-group-addon"><i class="ti-agenda text-primary"></i></span>
                                                  <textarea name="description" rows="4" class="form-control" required placeholder="Masukan keterangan / deskripsi arsip yang akan diperbaiki"></textarea>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-lg-12">
                                        <div class="form-group">
                                             <input name="document" type="file" required class="form-control" placeholder="Unggah dokumen arsip" accept="image/*, .pdf">
                                        </div>
                                   </div>
                                   <!-- <div class="col-lg-12">
                                        <div class="form-group">
                                             <div class="input-group">
                                                  <div class="g-recaptcha" data-sitekey="" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                                                  <input class="form-control d-none" style="display:none;" data-recaptcha="true" required data-error="Please complete the Captcha">
                                             </div>
                                        </div>
                                   </div> -->
                                   <div class="col-lg-12">
                                        <button name="submit" type="submit" value="Submit" class="site-button button-lg"> <span>Kirim</span> </button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
     <!-- Get in touch -->
</div>
