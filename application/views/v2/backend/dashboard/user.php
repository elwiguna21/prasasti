<style>
     .pulse {
          animation: pulse-animation 2s infinite;
     }

     @keyframes pulse-animation {
          0% {
               transform: scale(0.95);
               box-shadow: 0 0 0 0 rgba(52, 152, 219, 0.7);
          }

          70% {
               transform: scale(1);
               box-shadow: 0 0 0 10px rgba(52, 152, 219, 0);
          }

          100% {
               transform: scale(0.95);
               box-shadow: 0 0 0 0 rgba(52, 152, 219, 0);
          }
     }
</style>
<div class="form-head d-flex mb-3 align-items-start">
     <!--     <div class="me-auto d-none d-lg-block">-->
     <div class="me-auto d-block">
          <h2 class="text-primary font-w600 mb-0">Halo, <?= $employee->fullname; ?></h2>
          <p class="mb-0">Selamat datang di Dashboard Prasasti!</p>
     </div>
</div>

<div class="row">
     <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon d-flex">
                         <span class="me-3 bgl-primary text-primary">
                              <i class="ti-user"></i>
                         </span>
                         <div class="media-body">
                              <h3 class="mb-0 text-black"><span class="counter ms-0"><?= $total_users; ?></span></h3>
                              <p class="mb-0">Total Pengguna</p>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon d-flex">
                         <span class="me-3 bgl-warning text-warning">
                              <i class="ti-user"></i>
                         </span>
                         <div class="media-body">
                              <h3 class="mb-0 text-black"><span
                                        class="counter ms-0"><?= $total_users_operator; ?></span></h3>
                              <p class="mb-0">Operator</p>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon d-flex">
                         <span class="me-3 bgl-success text-success">
                              <i class="ti-user"></i>
                         </span>
                         <div class="media-body">
                              <h3 class="mb-0 text-black"><span
                                        class="counter ms-0"><?= $total_users_verificator; ?></span></h3>
                              <p class="mb-0">Verifikator</p>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon d-flex">
                         <span class="me-3 bgl-danger text-danger">
                              <i class="ti-user"></i>
                         </span>
                         <div class="media-body">
                              <h3 class="mb-0 text-black"><span
                                        class="counter ms-0"><?= $total_users_evaluator; ?></span></h3>
                              <p class="mb-0">Penilai</p>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="row">
     <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
          <div class="widget-stat card bg-primary">
               <div class="card-body  p-4">
                    <div class="media">
                         <span class="me-3">
                              <i class="la la-archive"></i>
                         </span>
                         <div class="media-body text-white">
                              <p class="mb-1 text-white">Total Arsip</p>
                              <h3 class="text-white"><?= $total_archieves; ?></h3>
                              <div class="progress mb-2 bg-secondary">
                                   <div class="progress-bar progress-animated bg-white" style="width: 100%"></div>
                              </div>
                              <small>100% dari total arsip</small>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
          <div class="widget-stat card bg-warning">
               <div class="card-body p-4">
                    <div class="media">
                         <span class="me-3">
                              <i class="la la-archive"></i>
                         </span>
                         <div class="media-body text-white">
                              <p class="mb-1 text-white">Arsip Inaktif</p>
                              <h3 class="text-white"><?= $total_archieves_inactives; ?></h3>
                              <div class="progress mb-2 bg-primary">
                                   <div class="progress-bar progress-animated bg-white"
                                        style="width: <?= ($total_archieves_inactives > 0) ? ($total_archieves_inactives / $total_archieves) * 100 : 0; ?>%"></div>
                              </div>
                              <small><?= ($total_archieves_inactives > 0) ? round(($total_archieves_inactives / $total_archieves) * 100, 2) : 0; ?>
                                   % dari total arsip</small>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
          <div class="widget-stat card bg-success overflow-hidden">
               <div class="card-body p-4">
                    <div class="media">
                         <span class="me-3">
                              <i class="la la-archive"></i>
                         </span>
                         <div class="media-body text-white">
                              <p class="mb-1 text-white">Arsip Vital</p>
                              <h3 class="text-white"><?= $total_archieves_vital; ?></h3>
                              <div class="progress mb-2 bg-success">
                                   <div class="progress-bar progress-animated bg-white"
                                        style="width: <?= ($total_archieves_vital > 0) ? ($total_archieves_vital / $total_archieves) * 100 : 0; ?>%"></div>
                              </div>
                              <small><?= ($total_archieves_vital > 0) ?  round(($total_archieves_vital / $total_archieves) * 100, 2) : 0; ?>
                                   % dari total arsip</small>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
          <div class="widget-stat card bg-danger ">
               <div class="card-body p-4">
                    <div class="media">
                         <span class="me-3">
                              <i class="la la-archive"></i>
                         </span>
                         <div class="media-body text-white">
                              <p class="mb-1 text-white">Arsip Usul Musnah</p>
                              <h3 class="text-white"><?= $total_archieves_usul_musnah ?></h3>
                              <div class="progress mb-2 bg-secondary">
                                   <div class="progress-bar progress-animated bg-white"
                                        style="width: <?= ($total_archieves_usul_musnah > 0) ? ($total_archieves_usul_musnah / $total_archieves) * 100 : 0; ?>%"></div>
                              </div>
                              <small><?= ($total_archieves_usul_musnah > 0) ? round(($total_archieves_usul_musnah / $total_archieves) * 100, 2) : 0; ?>
                                   % dari total arsip</small>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-xl-8 col-xxl-8 col-lg-12 col-sm-12">
          <div class="card">
               <div class="card-header border-0 pb-0 d-sm-flex d-block">
                    <div class="me-3">
                         <h4 class="card-title mb-1">Arsip Dibuat</h4>
                         <small class="mb-0">Total arsip yang dibuat berdasarkan bulan</small>
                    </div>
                    <select class="form-control style-1 default-select  mt-3 mt-sm-0" id="archieve-month-year">
                         <option value="2026" selected>2026</option>
                    </select>
               </div>
               <div class="card-body revenue-chart px-3">
                    <div id="archieve-month-chart"></div>
               </div>
          </div>
     </div>

     <div class="col-xl-4 col-lg-12">
          <div class="card">
               <div class="card-header border-0 pb-0">
                    <h4 class="card-title">Log Pengguna</h4>
               </div>
               <div class="card-body p-0">
                    <div id="DZ_W_TimeLine1" class="widget-timeline dz-scroll style-1 my-4 px-4" style="height:370px;">
                         <?php if (!empty($logs)) {
                              $isFirst = true; ?>
                              <ul class="timeline">
                                   <?php foreach ($logs as $log) {
                                        if ($log->action == 'signin') {
                                             $action_color = 'success';
                                        } else if ($log->action == 'signout') {
                                             $action_color = 'danger';
                                        } else {
                                             $action_color = 'primary';
                                        } ?>
                                        <li>
                                             <?php if ($isFirst) { ?>
                                                  <div class="timeline-badge <?= $action_color; ?> pulse"></div>
                                             <?php $isFirst = false;
                                             } else { ?>
                                                  <div class="timeline-badge <?= $action_color; ?>"></div>
                                             <?php } ?>

                                             <a class="timeline-panel text-muted" href="javascript:void(0);">
                                                  <span><?= tgl_indo(date('Y-m-d', strtotime($log->created_at))) . ' - ' . jam_indo(date('H:i:s', strtotime($log->created_at))); ?></span>
                                                  <h6 class="mb-0"><?= ucwords($log->menu) ?> <strong
                                                            class="text-info"><?= ucwords($log->action); ?></strong>
                                                  </h6>
                                                  <p class="mb-0"><?= $log->description; ?></p>
                                             </a>
                                        </li>
                                   <?php } ?>
                              </ul>
                         <?php } else { ?>
                              <div class="alert alert-warning">
                                   <p class="mb-0">Belum ada log dari akun anda.</p>
                              </div>
                         <?php } ?>
                         </ul>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-xl-6 col-xxl-6 col-lg-12 col-md-12">
          <div class="card">
               <div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
                    <div class="mb-3">
                         <h4 class="card-title mb-1">Status Arsip Vital</h4>
                         <small class="mb-0">Arsip Vital berdasarkan status</small>
                    </div>
               </div>
               <div class="card-body tab-content orders-summary pt-3">
                    <div class="d-flex flex-wrap order-manage p-3 align-items-center mb-4">
                         <a href="javascript:void(0);"
                              class="btn fs-22 text-white py-1 btn-success px-4 me-3"><?= $total_archieves_vital; ?></a>
                         <h4 class="mb-0">Arsip Vital <i class="fa fa-circle text-success ms-1 fs-15"></i></h4>
                         <a href="<?= base_url('v2/alih_media_arsip_vital') ?>"
                              class="ms-sm-auto mt-sm-0 mt-2 text-success font-w500">Kelola Arsip Vital <i
                                   class="ti-angle-right ms-1"></i></a>
                    </div>
                    <div class="row">
                         <div class="col-sm-4 mb-4">
                              <div class="border border-primary px-3 py-3 rounded-xl">
                                   <h2 class="fs-32 font-w600 counter text-primary"><?= $total_archieve_vital_waiting_verification; ?></h2>
                                   <p class="fs-16 mb-0">Menunggu di Verifikasi</p>
                              </div>
                         </div>
                         <div class="col-sm-4 mb-4">
                              <div class="border border-warning px-3 py-3 rounded-xl">
                                   <h2 class="fs-32 font-w600 counter text-warning"><?= $total_archieve_vital_waiting_signed; ?></h2>
                                   <p class="fs-16 mb-0">Menunggu di TTE</p>
                              </div>
                         </div>
                         <div class="col-sm-4 mb-4">
                              <div class="border border-success px-3 py-3 rounded-xl">
                                   <h2 class="fs-32 font-w600 counter text-success"><?= $total_archieve_vital_signed; ?></h2>
                                   <p class="fs-16 mb-0">Sudah di TTE</p>
                              </div>
                         </div>
                    </div>
                    <div class="widget-timeline-icon">
                         <div class="row align-items-center">
                              <div class="col-xl-3 col-lg-2 col-xxl-4 col-sm-3 col-md-3 my-2 text-center text-sm-left">
                                   <div id="vital-chart" class="d-inline-block"></div>
                              </div>
                              <div class="col-xl-9 col-lg-10 col-xxl-8 col-sm-9 col-md-9">
                                   <div class="d-flex align-items-center mb-3">
                                        <p class="mb-0 fs-14 me-2 col-4 col-xxl-5 px-0">Menunggu Verifikasi
                                             (<?= ($total_archieve_vital_waiting_verification > 0) ? number_format(($total_archieve_vital_waiting_verification / $total_archieves_vital) * 100, 2, ',', '.') : 0 ?>
                                             %)</p>
                                        <div class="progress mb-0" style="height:8px; width:100%;">
                                             <div class="progress-bar bg-primary progress-animated"
                                                  style="width:<?= ($total_archieve_vital_waiting_verification > 0) ? number_format(($total_archieve_vital_waiting_verification / $total_archieves_vital) * 100, 2, ',', '.') : 0 ?>%; height:8px;"
                                                  role="progressbar">
                                                  <span class="sr-only">60% Complete</span>
                                             </div>
                                        </div>
                                        <span class=" ms-auto col-1 col-xxl-2 px-0 text-end"><?= $total_archieve_vital_waiting_verification; ?></span>
                                   </div>
                                   <div class="d-flex align-items-center  mb-3">
                                        <p class="mb-0 fs-14 me-2 col-4 col-xxl-5 px-0">Menunggu di TTE
                                             (<?= ($total_archieve_vital_waiting_signed > 0) ? number_format(($total_archieve_vital_waiting_signed / $total_archieves_vital) * 100, 2, ',', '.') : 0 ?>
                                             %)</p>
                                        <div class="progress mb-0" style="height:8px; width:100%;">
                                             <div class="progress-bar bg-warning progress-animated"
                                                  style="width:<?= ($total_archieve_vital_waiting_signed > 0) ? ($total_archieve_vital_waiting_signed / $total_archieves_vital) * 100 : 0 ?>%; height:8px;"
                                                  role="progressbar">
                                                  <span class="sr-only">60% Complete</span>
                                             </div>
                                        </div>
                                        <span class="ms-auto col-1 col-xxl-2 px-0 text-end"><?= $total_archieve_vital_waiting_signed; ?></span>
                                   </div>
                                   <div class="d-flex align-items-center">
                                        <p class="mb-0 fs-14 me-2 col-4 col-xxl-5 px-0">Selesai di TTE
                                             (<?= ($total_archieve_vital_signed > 0) ? number_format(($total_archieve_vital_signed / $total_archieves_vital) * 100, 2, ',', '.') : 0 ?>
                                             %)</p>
                                        <div class="progress mb-0" style="height:8px; width:100%;">
                                             <div class="progress-bar bg-success progress-animated"
                                                  style="width:<?= ($total_archieve_vital_signed > 0) ? ($total_archieve_vital_signed / $total_archieves_vital) * 100 : 0 ?>%; height:8px;"
                                                  role="progressbar">
                                                  <span class="sr-only">60% Complete</span>
                                             </div>
                                        </div>
                                        <span class="ms-auto col-1 col-xxl-2 px-0 text-end"><?= $total_archieve_vital_signed; ?></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-xl-6 col-xxl-6 col-lg-12 col-md-12">
          <div class="card">
               <div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
                    <div class="mb-3">
                         <h4 class="card-title mb-1">Status Arsip Usul Musnah</h4>
                         <small class="mb-0">Arsip Usul Musnah berdasarkan status</small>
                    </div>
               </div>
               <div class="card-body tab-content orders-summary pt-3">
                    <div class="d-flex flex-wrap order-manage p-3 align-items-center mb-4">
                         <a href="javascript:void(0);"
                              class="btn fs-22 text-white py-1 btn-success px-4 me-3"><?= $total_archieves_usul_musnah; ?></a>
                         <h4 class="mb-0">Arsip Usul Musnah <i class="fa fa-circle text-success ms-1 fs-15"></i></h4>
                         <a href="<?= base_url('v2/alih_media_arsip_usul_serah') ?>"
                              class="ms-sm-auto mt-sm-0 mt-2 text-success font-w500">Kelola Arsip<i
                                   class="ti-angle-right ms-1"></i></a>
                    </div>
                    <div class="row">
                         <div class="col-sm-4 mb-4">
                              <div class="border border-primary px-3 py-3 rounded-xl">
                                   <h2 class="fs-32 font-w600 counter text-primary"><?= $total_archieve_musnah_waiting_verification; ?></h2>
                                   <p class="fs-16 mb-0">Menunggu di Verifikasi</p>
                              </div>
                         </div>
                         <div class="col-sm-4 mb-4">
                              <div class="border border-warning px-3 py-3 rounded-xl">
                                   <h2 class="fs-32 font-w600 counter text-warning"><?= $total_archieve_musnah_waiting_signed; ?></h2>
                                   <p class="fs-16 mb-0">Menunggu di TTE</p>
                              </div>
                         </div>
                         <div class="col-sm-4 mb-4">
                              <div class="border border-success px-3 py-3 rounded-xl">
                                   <h2 class="fs-32 font-w600 counter text-success"><?= $total_archieve_musnah_signed; ?></h2>
                                   <p class="fs-16 mb-0">Sudah di TTE</p>
                              </div>
                         </div>
                    </div>
                    <div class="widget-timeline-icon">
                         <div class="row align-items-center">
                              <div class="col-xl-3 col-lg-2 col-xxl-4 col-sm-3 col-md-3 my-2 text-center text-sm-left">
                                   <div id="musnah-chart" class="d-inline-block"></div>
                              </div>
                              <div class="col-xl-9 col-lg-10 col-xxl-8 col-sm-9 col-md-9">
                                   <div class="d-flex align-items-center mb-3">
                                        <p class="mb-0 fs-14 me-2 col-4 col-xxl-5 px-0">Menunggu Verifikasi
                                             (<?= ($total_archieve_musnah_waiting_verification > 0) ? number_format(($total_archieve_musnah_waiting_verification / $total_archieves_usul_musnah) * 100, 2, ',', '.') : 0 ?>
                                             %)</p>
                                        <div class="progress mb-0" style="height:8px; width:100%;">
                                             <div class="progress-bar bg-primary progress-animated"
                                                  style="width:<?= ($total_archieve_musnah_waiting_verification > 0) ? ($total_archieve_musnah_waiting_verification / $total_archieves_usul_musnah) * 100 : 0 ?>%; height:8px;"
                                                  role="progressbar">
                                                  <span class="sr-only">60% Complete</span>
                                             </div>
                                        </div>
                                        <span class=" ms-auto col-1 col-xxl-2 px-0 text-end"><?= $total_archieve_musnah_waiting_verification; ?></span>
                                   </div>
                                   <div class="d-flex align-items-center  mb-3">
                                        <p class="mb-0 fs-14 me-2 col-4 col-xxl-5 px-0">Menunggu di TTE
                                             (<?= ($total_archieve_musnah_waiting_signed > 0) ? number_format(($total_archieve_musnah_waiting_signed / $total_archieves_usul_musnah) * 100, 2, ',', '.') : 0 ?>
                                             %)</p>
                                        <div class="progress mb-0" style="height:8px; width:100%;">
                                             <div class="progress-bar bg-warning progress-animated"
                                                  style="width:<?= ($total_archieve_musnah_waiting_signed > 0) ? ($total_archieve_musnah_waiting_signed / $total_archieves_usul_musnah) * 100 : 0 ?>%; height:8px;"
                                                  role="progressbar">
                                                  <span class="sr-only">60% Complete</span>
                                             </div>
                                        </div>
                                        <span class="ms-auto col-1 col-xxl-2 px-0 text-end"><?= $total_archieve_musnah_waiting_signed; ?></span>
                                   </div>
                                   <div class="d-flex align-items-center">
                                        <p class="mb-0 fs-14 me-2 col-4 col-xxl-5 px-0">Selesai di TTE
                                             (<?= ($total_archieve_musnah_signed > 0) ? number_format(($total_archieve_musnah_signed / $total_archieves_usul_musnah) * 100, 2, ',', '.') : 0 ?>
                                             %)</p>
                                        <div class="progress mb-0" style="height:8px; width:100%;">
                                             <div class="progress-bar bg-success progress-animated"
                                                  style="width:<?= ($total_archieve_musnah_signed > 0) ? ($total_archieve_musnah_signed / $total_archieves_usul_musnah) * 100 : 0 ?>%; height:8px;"
                                                  role="progressbar">
                                                  <span class="sr-only">60% Complete</span>
                                             </div>
                                        </div>
                                        <span class="ms-auto col-1 col-xxl-2 px-0 text-end"><?= $total_archieve_musnah_signed; ?></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- Apex Chart -->
<script src="<?= base_url('assets/v3/backend/') ?>vendor/apexchart/apexchart.js"></script>

<script>
     let dataVital = [<?= $total_archieve_vital_waiting_verification ?>, <?= $total_archieve_vital_waiting_signed ?>, <?= $total_archieve_vital_signed ?>];
     let dataMusnah = [<?= $total_archieve_musnah_waiting_verification ?>, <?= $total_archieve_musnah_waiting_signed ?>, <?= $total_archieve_musnah_signed ?>];
     var optionsDonut = {
          series: [100, 100, 100],
          labels: ['Menunggu Verifikasi', 'Menunggu TTE', 'Sudah TTE'],
          colors: ['#2f4cdd', '#ff6d4d', '#2bc155'],
          chart: {
               width: 150,
               height: 150,
               type: 'donut',
               sparkline: {
                    enabled: true,
               },

          },
          plotOptions: {
               pie: {
                    customScale: 1,
                    donut: {
                         size: '50%',
                    }
               }
          },
          dataLabels: {
               enabled: false
          },
          responsive: [{
               breakpoint: 1300,
               options: {
                    chart: {
                         width: 120,
                         height: 120
                    },
               }
          }],
          legend: {
               show: false
          },
          tooltip: {
               y: {
                    formatter: function(val) {
                         return val + " Arsip"
                    }
               }
          }
     };

     var vitalDonutChart = new ApexCharts(document.querySelector("#vital-chart"), optionsDonut);
     vitalDonutChart.render();
     vitalDonutChart.updateSeries(dataVital);

     var musnahDonutChart = new ApexCharts(document.querySelector("#musnah-chart"), optionsDonut);
     musnahDonutChart.render();
     musnahDonutChart.updateSeries(dataMusnah);

     var options = {
          series: [{
               name: 'Total',
               data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
               //radius: 12,
          }, ],
          chart: {
               type: 'area',
               height: 350,
               toolbar: {
                    show: false,
               },

          },
          plotOptions: {
               bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
               },
          },
          colors: ['#2f4cdd'],
          dataLabels: {
               enabled: false,
          },
          markers: {
               shape: "circle",
          },
          legend: {
               show: false,
          },
          stroke: {
               show: true,
               width: 4,
               colors: ['#2f4cdd'],
          },

          grid: {
               borderColor: '#eee',
          },
          xaxis: {
               categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
               labels: {
                    style: {
                         colors: '#3e4954',
                         fontSize: '13px',
                         fontFamily: 'Poppins',
                         fontWeight: 100,
                         cssClass: 'apexcharts-xaxis-label',
                    },
               },
               crosshairs: {
                    show: false,
               }
          },
          yaxis: {
               labels: {
                    style: {
                         colors: '#3e4954',
                         fontSize: '13px',
                         fontFamily: 'Poppins',
                         fontWeight: 100,
                         cssClass: 'apexcharts-xaxis-label',
                    },
               },
          },
          fill: {
               opacity: 1
          },
          tooltip: {
               y: {
                    formatter: function(val) {
                         return val + " Arsip"
                    }
               }
          }
     };
     var chartBar1 = new ApexCharts(document.querySelector("#archieve-month-chart"), options);
     chartBar1.render();
     _initialize_arhieve_data();

     function _initialize_arhieve_data() {
          $.post("<?= base_url('v2/Dashboards/get_total_archieves_json') ?>", {
               year: $('#archieve-month-year').val()
          }, function(data, status) {
               if (status == 'success') {
                    let dao = JSON.parse(data);
                    options.series[0].data = dao;
                    chartBar1.update();
               } else {
                    Swal.fire("Kesalahan", "Terjadi kesalahan saat memuat data ke server...", "error");
               }
          }).fail(function() {
               Swal.fire("Kesalahan", "Terjadi kesalahan saat menghubungkan ke server...", "error");
          });
     }
</script>
