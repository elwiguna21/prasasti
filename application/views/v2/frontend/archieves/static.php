<style>
     .dlab-post-meta li:after {
          content: "";
          display: inline-block;
          font-weight: normal;
          margin-left: 5px;
          opacity: 0.5;
     }
</style>
<div class="dlab-bnr-inr overlay-primary" style="background-image:url(<?= base_url('assets/v3/frontend/images/banner/bnr2.jpg') ?>);">
     <div class="container">
          <div class="dlab-bnr-inr-entry">
               <h1 class="text-white">Arsip Statis</h1>
               <!-- Breadcrumb row -->
               <div class="breadcrumb-row">
                    <ul class="list-inline">
                         <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                         <li>Arsip Statis</li>
                    </ul>
               </div>
               <!-- Breadcrumb row END -->
          </div>
     </div>
</div>

<div class="section-full content-inner">
     <!-- Product -->
     <div class="container">
          <div>
               <form class="shop-form row">
                    <div class="row">
                         <div class="form-group col-lg-6 col-md-12">
                              <input type="text" name="title" class="form-control" placeholder="Cari nama arsip" autocomplete="off" value="<?= (!empty($_GET['title'])) ? $_GET['title'] : '' ?>">
                         </div>
                         <div class="form-group col-lg-4 col-md-6">
                              <select class="form-control" name="company">
                                   <option value="">Pilih SKPD</option>
                                   <?php foreach ($companies as $company) { ?>
                                        <option value="<?= $company->no_company; ?>" <?= (!empty($_GET['company']) && $_GET['company'] == $company->no_company) ? 'selected' : '' ?>><?= $company->name; ?></option>
                                   <?php } ?>
                              </select>
                         </div>
                         <div class="form-group col-lg-2 col-md-6">
                              <button type="submit" class="site-button ">Cari</button>
                              <button type="reset" class="ms-2 site-button bg-warning btn-reset">Reset</button>
                         </div>
                    </div>
               </form>
               <p>Jumlah Arsip: <?= number_format($archieves_total, 0, ',', '.'); ?></p>
          </div>

          <div class="wow fadeIn m-t20" data-wow-delay="0.5s">
               <div class="row">
                    <?php if (!empty($archieves)) {
                         foreach ($archieves as $archieve) { ?>
                              <div class="col-lg-3 col-md-6 col-sm-12">
                                   <div class="blog-post blog-grid blog-rounded blog-effect1">
                                        <div class="dlab-info p-a20 border-1">
                                             <div class="dlab-post-title ">
                                                  <h5 class="post-title font-weight-500"><a href="<?= base_url('v2/frontend/archieves/detail?archieve=' . $archieve->id . '&company=' . $archieve->nomor_skpd); ?>"><?= $archieve->indek; ?></a></h5>
                                             </div>
                                             <div class="dlab-post-meta">
                                                  <ul>
                                                       <li class="post-date"> <i class="fa fa-calendar"></i><strong><?= $archieve->tahun; ?></strong></li>
                                                       <li class="post-author"><i class="fa fa-user"></i><a href="javascript:void(0);"><?= $archieve->name; ?></a> </li>
                                                  </ul>
                                             </div>
                                             <div class="dlab-post-text">
                                                  <p><?= $archieve->deskripsi; ?></p>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         <?php } ?>
                         <?= $pagination; ?>
                    <?php } else { ?>
                         <div class="col-12">
                              <div class="alert alert-warning">
                                   <span>Data tidak ditemukan...</span>
                              </div>
                         </div>
                    <?php } ?>
               </div>
          </div>
     </div>
</div>

<div class="section-full p-t50 p-b20 bg-primary-dark text-white shop-action">
     <div class="container">
          <div class="row">
               <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="icon-bx-wraper left m-b30">
                         <div class="icon-md text-black radius">
                              <a href="javascript:void(0);" class="icon-cell text-white"><i class="fa fa-gift"></i></a>
                         </div>
                         <div class="icon-content">
                              <h5 class="dlab-tilte">Free shipping on orders $60+</h5>
                              <p>Order more than 60$ and you will get free shippining Worldwide. More info.</p>
                         </div>
                    </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="icon-bx-wraper left m-b30">
                         <div class="icon-md text-black radius">
                              <a href="javascript:void(0);" class="icon-cell text-white"><i class="fa fa-plane"></i></a>
                         </div>
                         <div class="icon-content">
                              <h5 class="dlab-tilte">Worldwide delivery</h5>
                              <p>We deliver to the following countries: USA, Canada, Europe, Australia</p>
                         </div>
                    </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="icon-bx-wraper left m-b30">
                         <div class="icon-md text-black radius">
                              <a href="javascript:void(0);" class="icon-cell text-white"><i class="fa fa-history"></i></a>
                         </div>
                         <div class="icon-content">
                              <h5 class="dlab-tilte">60 days money back guranty!</h5>
                              <p>Not happy with our product, feel free to return it, we will refund 100% your money!</p>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<script src="<?= base_url('assets/v3/frontend/js/jquery.min.js') ?>"></script>
<script>
     $('.btn-reset').click(function() {
          $('input[name="title"]').val(null);
          $('select[name="company"]').val(null).trigger('change');
          window.location.href = '<?= base_url('v2/frontend/archieves') ?>';
     })
</script>
