<style>
     img {
          position: relative;
     }
</style>
<div class="breadcrumb-section bg-img"
     style="background-image: url('<?= base_url("assets/v3/frontend/v2/") ?>img/bg-img/90.jpg');">
     <div class="container">
          <!-- Breadcrumb Content -->
          <div class="breadcrumb-content">
               <div class="divider"></div>
               <h2>Galeri</h2>
               <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <li>Galeri</li>
               </ul>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</div>

<!-- Case Study Section -->
<section class="case-study-section bg-secondary">
     <!-- Divider -->
     <div class="divider"></div>

     <div class="container">
          <div class="row g-5 align-items-end">
               <!-- Section Heading -->
               <div class="col-12">
                    <div class="section-heading">
                         <span class="sub-title">Dokumentasi pelaksanaan kearsipan</span>
                         <h2 class="mb-0">Lingkungan Pemerintah Daerah Kabupaten Sumedang</h2>
                    </div>
               </div>
          </div>
     </div>

     <div class="divider-sm"></div>

     <div class="container">
          <div class="row d-flex justify-content-center align-items-center g-4" id="lightgallery"></div>
          <div class="d-flex justify-content-center align-items-center mt-3" id="loading">
               <div class="spinner-border ms-center text-primary me-2" aria-hidden="true"></div>
               <span role="status">Sedang memuat data...</span>
          </div>
     </div>

     <!-- Divider -->
     <div class="divider"></div>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
     $(document).ready(function() {
          let limit = 5;
          let start = 0;
          let action = 'inactive';

          load_data(limit, start);

          function load_data(limit, start) {
               $.ajax({
                    url: "<?= base_url('v2/galleries/get_galleries_json') ?>", // File tujuan request
                    method: "POST",
                    data: {
                         limits: limit,
                         starts: start
                    },
                    cache: false,
                    beforeSend: function() {
                         $('#loading').show();
                    },
                    success: function(data, status) {
                         if (status == 'success') {
                              let dao = JSON.parse(data);
                              if (dao.data == '') {
                                   $('#loading').html("Tidak ada data lagi.");
                                   action = 'active'; // Hentikan request
                              } else {
                                   $('#lightgallery').append(dao.data);
                                   $('#loading').hide();
                                   action = 'inactive'; // Lanjutkan jika user scroll lagi
                              }
                         } else {
                              Swal.fire("Gagal", "Terjadi kesalahan saat memuat data...", "error");
                         }
                    }
               });
          }

          // Event Scroll
          $(window).scroll(function() {
               if ($(window).scrollTop() + $(window).height() > $("#lightgallery").height() && action == 'inactive') {
                    action = 'active';
                    start = start + limit;
                    setTimeout(function() {
                         load_data(limit, start);
                    }, 1000); // Delay 1 detik untuk memberi jeda loading
               }
          });
     })
</script>
