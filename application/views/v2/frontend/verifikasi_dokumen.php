<div class="case-study-section">
     <!-- Divider -->
     <div class="divider-sm"></div>
     <div class="divider-sm"></div>
     <div class="container py-5">
          <div class="row justify-content-center">
               <div class="col-lg-8">

                    <?php if (empty($berkas)): ?>
                         <!-- Dokumen Tidak Ditemukan -->
                         <div class="card border-0 shadow-sm text-center py-5">
                              <div class="card-body">
                                   <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                                   <h4 class="fw-bold">Dokumen Tidak Ditemukan</h4>
                                   <p class="text-muted">Dokumen yang Anda cari tidak tersedia atau telah dihapus.</p>
                                   <a href="<?= base_url() ?>" class="btn btn-primary mt-2">
                                        <i class="fas fa-home me-1"></i> Kembali ke Beranda
                                   </a>
                              </div>
                         </div>
                    <?php else: ?>
                         <!-- Header Verifikasi -->
                         <div class="text-center mb-4">
                              <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mb-3"
                                   style="width:64px;height:64px;">
                                   <i class="fas fa-shield-alt fa-2x text-white"></i>
                              </div>
                              <h4 class="fw-bold mb-1">Verifikasi Dokumen Elektronik</h4>
                              <p class="text-muted small mb-0">Halaman ini membuktikan keaslian dokumen yang telah
                                   ditandatangani secara elektronik</p>
                         </div>

                         <!-- Status TTE -->
                         <?php if (!empty($berkas->tte_status) && $berkas->tte_status === 'Y'): ?>
                              <div class="alert alert-success d-flex align-items-center shadow-sm border-0"
                                   role="alert">
                                   <i class="fas fa-check-circle fa-2x me-3"></i>
                                   <div>
                                        <strong>Dokumen Sah</strong><br>
                                        <small>Dokumen ini telah ditandatangani secara elektronik dan
                                             terverifikasi.</small>
                                   </div>
                              </div>
                         <?php else: ?>
                              <div class="alert alert-warning d-flex align-items-center shadow-sm border-0"
                                   role="alert">
                                   <i class="fas fa-clock fa-2x me-3"></i>
                                   <div>
                                        <strong>Belum Ditandatangani</strong><br>
                                        <small>Dokumen ini belum ditandatangani secara elektronik.</small>
                                   </div>
                              </div>
                         <?php endif; ?>

                         <!-- Detail Dokumen -->
                         <div class="card border-0 shadow my-3">
                              <div class="card-header bg-white border-bottom">
                                   <h6 class="mb-0 fw-bold"><i class="fas fa-file-alt me-2 text-primary"></i>Informasi
                                        Dokumen</h6>
                              </div>
                              <div class="card-body">
                                   <table class="table table-borderless mb-0">
                                        <tbody>
                                             <tr>
                                                  <td class="text-muted" style="width:200px;">Kode Klasifikasi</td>
                                                  <td class="fw-semibold"><?= htmlspecialchars($berkas->kode_klsf ?? '-') ?></td>
                                             </tr>
                                             <tr>
                                                  <td class="text-muted">Uraian Informasi Arsip</td>
                                                  <td class="fw-semibold"><?= htmlspecialchars(!empty($berkas->uraian_informasi_arsip)) ? $berkas->uraian_informasi_arsip : (!empty($berkas->deskripsi) ? $berkas->deskripsi : '-') ?></td>
                                             </tr>
                                             <tr>
                                                  <td class="text-muted">Kurun Waktu (Tahun)</td>
                                                  <td class="fw-semibold"><?= htmlspecialchars($berkas->tahun ?? '-') ?></td>
                                             </tr>
                                             <tr>
                                                  <td class="text-muted">Jumlah Dokumen</td>
                                                  <td class="fw-semibold"><?= htmlspecialchars($berkas->jumlah ?? '-') ?>
                                                       dok
                                                  </td>
                                             </tr>
                                             <tr>
                                                  <td class="text-muted">Tanggal</td>
                                                  <td class="fw-semibold"><?= !empty($berkas->tanggal) ? date('d F Y', strtotime($berkas->tanggal)) : '-' ?></td>
                                             </tr>
                                        </tbody>
                                   </table>
                              </div>
                         </div>

                         <?php if (!empty($berkas->tte_status) && $berkas->tte_status === 'Y'): ?>
                              <!-- Detail TTE -->
                              <div class="card border-0 shadow my-3">
                                   <div class="card-header bg-white border-bottom">
                                        <h6 class="mb-0 fw-bold"><i class="fas fa-pen-nib me-2 text-success"></i>Informasi
                                             Tanda Tangan Elektronik</h6>
                                   </div>
                                   <div class="card-body">
                                        <table class="table table-borderless mb-0">
                                             <tbody>
                                                  <tr>
                                                       <td class="text-muted" style="width:200px;">Ditandatangani oleh</td>
                                                       <td class="fw-semibold"><?= (!empty($penandatangan)) ? $penandatangan->fullname . '<br/><span class="fw-light">' . $penandatangan->jabatan . '</span>' : '-' ?></td>
                                                  </tr>
                                                  <tr>
                                                       <td class="text-muted">Tanggal TTE</td>
                                                       <td class="fw-semibold"><?= !empty($berkas->tte_tanggal) ? date('d F Y, H:i', strtotime($berkas->tte_tanggal)) : '-' ?>
                                                            WIB
                                                       </td>
                                                  </tr>
                                             </tbody>
                                        </table>
                                   </div>
                              </div>
                         <?php endif; ?>

                         <!-- Catatan Hukum -->
                         <div class="card border-0 shadow mt-3 bg-light">
                              <div class="card-body small text-muted">
                                   <strong class="fst-italic">Catatan :</strong>
                                   <p class="mb-1">- UU ITE No 11 Tahun 2008 Pasal 5 ayat 1 : "Informasi Elektronik
                                        dan/atau Dokumen Elektronik dan/atau hasil cetaknya merupakan alat bukti hukum
                                        yang sah."</p>
                                   <p class="mb-0">- Dokumen ini telah ditandatangani secara elektronik menggunakan
                                        sertifikat elektronik yang diterbitkan oleh Balai Besar Sertifikasi Elektronik
                                        (BSrE), Badan Siber dan Sandi Negara.</p>
                              </div>
                         </div>

                    <?php endif; ?>

               </div>
          </div>
     </div>
</div>
