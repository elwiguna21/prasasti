<div class="row page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/dashboards/archieves') ?>">Daftar Arsip</a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('v2/backend/dashboards/archieves') ?>">Statis</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah</a></li>
     </ol>
</div>
<div class="row">
     <div class="col-xl-12">
          <div class="card">
               <div class="card-body">
                    <div class="row">
                         <div class="col-xl-12">
                              <h4 class="mb-3 text-black">Tambah Arsip Statis Baru</h4>
                              <form class="needs-validation" novalidate="" method="post">
                                   <div class="row">
                                        <div class="col-md-6 mb-3">
                                             <label for="classification" class="form-label">Kode Klasifikasi</label>
                                             <input type="text" class="form-control" id="classification" name="classification" placeholder="Masukan kode klasifikasi" value="" required>
                                             <div class="invalid-feedback">
                                                  Valid first name is required.
                                             </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                             <label for="indeks" class="form-label">Indeks</label>
                                             <input type="text" class="form-control" id="indeks" name="indeks" placeholder="Masukan indeks" value="" required>
                                             <div class="invalid-feedback">
                                                  Valid last name is required.
                                             </div>
                                        </div>
                                   </div>

                                   <div class="mb-3">
                                        <label for="desc" class="form-label">Deskripsi</label>
                                        <textarea name="desc" id="desc" class="form-control" rows="3" required></textarea>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-6 mb-3">
                                             <label class="form-label">Tahun</label>
                                             <input type="text" name="year" class="form-control" placeholder="Masukan tahun arsip" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                             <label class="form-label">Unit Kerja Pencipta</label>
                                             <input type="text" class="form-control" name="unit_create" placeholder="Masukan unit kerja pencipta" required>
                                        </div>
                                   </div>

                                   <hr class="mb-4">
                                   <h4 class="mb-1">Media penyimpanan</h4>
                                   <div class="row">
                                        <div class="col-md-6 mb-3">
                                             <label class="form-label">Lokasi sampul</label>
                                             <input type="text" class="form-control" name="lokasi_sampul" placeholder="" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                             <label class="form-label">Lokasi berkas</label>
                                             <input type="text" class="form-control" name="lokasi_berkas" placeholder="" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                             <label class="form-label">Lokasi box</label>
                                             <input type="text" class="form-control" name="lokasi_box" placeholder="" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                             <label class="form-label">Lokasi rak</label>
                                             <input type="text" class="form-control" name="lokasi_rak" placeholder="" required>
                                        </div>
                                   </div>

                                   <hr class="mb-4">
                                   <h4 class="mb-1">Media Arsip</h4>
                                   <div class="mb-3">
                                        <label for="file" class="form-label">Berkas</label>
                                        <input type="file" class="form-control" name="berkas" required>
                                   </div>

                                   <div class="d-flex justify-content-end">
                                        <a class="btn btn-danger" href="<?= base_url('v2/backend/dashboards/archieves') ?>">Batal</a>
                                        <button class="btn btn-primary ms-2" type="submit">Tambahkan</button>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- Required vendors -->
<script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script>
