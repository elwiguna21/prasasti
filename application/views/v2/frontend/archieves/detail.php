<div class="dlab-bnr-inr overlay-primary" style="background-image:url(<?= base_url('assets/v3/frontend/images/banner/bnr2.jpg') ?>);">
     <div class="container">
          <div class="dlab-bnr-inr-entry">
               <h1 class="text-white">Arsip Statis</h1>
               <!-- Breadcrumb row -->
               <div class="breadcrumb-row">
                    <ul class="list-inline">
                         <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                         <li><a href="<?= base_url('v2/frontend/archieves') ?>">Arsip Statis</a></li>
                         <li>Detail Arsip</li>
                    </ul>
               </div>
               <!-- Breadcrumb row END -->
          </div>
     </div>
</div>

<div class="content-area w-100">
     <div class="container-fluid">
          <div class="row">
               <div class="col-lg-6 col-xl-6 ">
                    <div class="sticky-top">
                         <div class="dlab-post-media dlab-img-effect zoom-slow wow fadeIn " data-wow-delay="0.2s">
                              <a href="javascript:void(0);"><img class="fullscreen-cover" src="<?= base_url('assets/v3/frontend/') ?>images/blog/default/thum1.jpg" alt=""></a>
                         </div>
                    </div>
               </div>
               <!-- Left part start -->
               <div class="col-lg-6 col-xl-6">
                    <!-- blog start -->
                    <div class="blog-post blog-single">
                         <div class="dlab-post-title ">
                              <h1 class="post-title m-t0"><a href="javascript:void(0);"><?= $archieve->indek; ?></a></h1>
                         </div>
                         <div class="dlab-post-meta m-b20">
                              <ul class="d-flex align-items-center">
                                   <li class="post-date"> <i class="fa fa-calendar"></i><strong><?= $archieve->tahun; ?></strong></li>
                                   <li class="post-author"><i class="fa fa-user"></i><a href="javascript:void(0);"><?= $archieve->name; ?></a> </li>
                                   <!-- <li class="post-comment"><i class="fa fa-comments"></i> <a href="javascript:void(0);">0 Comments</a> </li> -->
                              </ul>
                         </div>
                         <div class="dlab-post-text">

                              <h5>Deskripsi & Detail</h5>
                              <p><?= $archieve->deskripsi; ?></p>

                              <div id="graphic-design-1" class="tab-pane">
                                   <table class="table table-bordered">
                                        <tr>
                                             <td width="40%">Unit Pencipta</td>
                                             <td><?= (!empty($archieve->unit_kerja_pencipta)) ? $archieve->unit_kerja_pencipta : '-'; ?></td>
                                        </tr>
                                        <tr>
                                             <td>Jenis Arsip</td>
                                             <?php if (!empty($archieve->jenis_arsip)) {
                                                  if ($archieve->jenis_arsip == 'vital') { ?>
                                                       <td>Arsip Vital</td>
                                                  <?php } else { ?>
                                                       <td>Usul Serah Pindah</td>
                                                  <?php }
                                             } else { ?>
                                                  <td>-</td>
                                             <?php } ?>
                                        </tr>
                                        <tr>
                                             <td>Verifikator</td>
                                             <?php if (!empty($archieve->verifikator)) {
                                                  if ($archieve->verifikator == 'skpd') { ?>
                                                       <td class="text-primary">Satuan Kerja Perangkat Daerah</td>
                                                  <?php } else { ?>
                                                       <td class="text-danger">Lembaga Kearsipan Daerah</td>
                                                  <?php }
                                             } else { ?>
                                                  <td>-</td>
                                             <?php } ?>
                                        </tr>
                                        <tr>
                                             <td>Lokasi Sampul</td>
                                             <td><?= (!empty($archieve->lokasi_sampul)) ? $archieve->lokasi_sampul : '-'; ?></td>
                                        </tr>
                                        <tr>
                                             <td>Lokasi Berkas</td>
                                             <td><?= (!empty($archieve->lokasi_berkas)) ? $archieve->lokasi_berkas : '-'; ?></td>
                                        </tr>
                                        <tr>
                                             <td>Lokasi Box</td>
                                             <td><?= (!empty($archieve->lokasi_box)) ? $archieve->lokasi_box : '-'; ?></td>
                                        </tr>
                                        <tr>
                                             <td>Lokasi Rak</td>
                                             <td><?= (!empty($archieve->lokasi_rak)) ? $archieve->lokasi_rak : '-'; ?></td>
                                        </tr>
                                        <tr>
                                             <td>Tingkat Perkembangan</td>
                                             <td><?= (!empty($archieve->keterangan_tk_perkembangan)) ? $archieve->keterangan_tk_perkembangan : '-'; ?></td>
                                        </tr>
                                        <tr>
                                             <td>Ruang Penyimpanan</td>
                                             <td><?= (!empty($archieve->ruang_penyimpanan)) ? $archieve->ruang_penyimpanan : '-'; ?></td>
                                        </tr>
                                   </table>
                              </div>
                              <div class="dlab-divider bg-gray-dark"></div>
                              <a href="<?= base_url('assets/upload/' . $archieve->file); ?>" class="site-button primary" target="_blank"><i class="ti-download me-2"></i> Download</a>
                              <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                              ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only
                              five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
                              of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like
                              Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                              has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                              type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                              It was popularised in the 1960s with the release</p> -->
                         </div>
                         <div class="dlab-divider bg-gray-dark op4"><i class="icon-dot c-square"></i></div>
                         <div class="share-details-btn">
                              <ul>
                                   <li>
                                        <h5 class="m-a0">Bagikan</h5>
                                   </li>
                                   <li><a href="javascript:void(0);" class="site-button facebook button-sm"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                                   <li><a href="javascript:void(0);" class="site-button google-plus button-sm"><i class="fab fa-google-plus-g"></i> Google Plus</a></li>
                                   <li><a href="javascript:void(0);" class="site-button instagram button-sm"><i class="fab fa-instagram"></i> Instagram</a></li>
                                   <li><a href="javascript:void(0);" class="site-button twitter button-sm"><i class="fab fa-twitter"></i> Twitter</a></li>
                                   <li><a href="javascript:void(0);" class="site-button whatsapp button-sm"><i class="fab fa-whatsapp"></i> Whatsapp</a></li>
                              </ul>
                         </div>
                    </div>
                    <!-- blog END -->
               </div>
               <!-- Left part END -->
          </div>
     </div>
</div>
