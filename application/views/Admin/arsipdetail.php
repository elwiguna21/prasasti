<?php $this->load->view('Admin/nav');?>


<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Arsip Detail</h1>
 </div>

<!-- Content Row -->
<div class="row">

  <!-- Pending Requests Card Example -->
  <div class="col-md-12 mb-4">
    <div class="card shadow mb-4">
      <div class="card-body">
      <?php if ($detail != null){
                      foreach($detail as $data){
                        ?>
        <div class="row">
          <div class="col-md-6">
            
                Data Arsip<hr>
                <div class="table-scrollable table-scrollable-borderless">
									<table class="table table-hover table-light">
                    
                      
										<tr>
											<td align="right"> Kode Klasifikasi </td>
											<td> : </td>
											<td> <?= $data->kode_klsf;?></td>
                    </tr>
                    <tr>
											<td align="right"> Indek </td>
											<td> : </td>
											<td> <?= $data->indek;?></td>
                    </tr>
                    <tr>
											<td align="right"> Deskripsi </td>
											<td> : </td>
											<td> <?= $data->deskripsi;?></td>
                    </tr>
                    <tr>
											<td align="right"> Tahun </td>
											<td> : </td>
											<td> <?= $data->tahun;?></td>
                    </tr>
                    <tr>
											<td align="right"> Unit Kerja Pencipta </td>
											<td> : </td>
											<td> <?= $data->unit_kerja_pencipta;?></td>
                    </tr>
                    <tr>
											<td align="right"> Lokasi Sampul </td>
											<td> : </td>
											<td> <?= $data->lokasi_sampul;?></td>
                    </tr>
                    <tr>
											<td align="right"> Lokasi Berkas </td>
											<td> : </td>
											<td> <?= $data->lokasi_berkas;?></td>
                    </tr>
                    <tr>
											<td align="right"> Lokasi Box </td>
											<td> : </td>
											<td> <?= $data->lokasi_box;?></td>
                    </tr>
                    <tr>
											<td align="right"> Lokasi Rak </td>
											<td> : </td>
											<td> <?= $data->lokasi_rak;?></td>
                    </tr>
                    <tr>
											<td align="right"> Keterangan Tingkat Perkambangan </td>
											<td> : </td>
											<td> <?= $data->keterangan_tk_perkembangan;?></td>
                    </tr>
                    <tr>
											<td align="right"> Ruang Penyimpanan </td>
											<td> : </td>
											<td> <?= $data->ruang_penyimpanan;?></td>
                    </tr>
                  </table>
                </div>
                
          </div>
          <div class="col-md-6">
            
               File<hr>
               <?php 
                $file = base_url().'assets/data/'.$data->file;
                $extensi = pathinfo($file, PATHINFO_EXTENSION);
                if($extensi == 'pdf'){

                
               ?>
               <iframe src="<?=base_url()?>assets/data/<?= $data->file?>" width="100%" height="800"></iframe>
               
                <?php } else {
                  echo '<h4>File Berupa RAR dan ZIP silakan Download Untuk Melihat data.</h4>';
                }
                ?>
                <a class="btn btn-outline-primary btn-block mt-4" href="<?= $file?>" target="_blank">  <i class="fas fa-download"></i> Download</a>
          </div>
        </div>
     
                      <?php                  
                      }
                        }else{
                          echo 'data tidak ada';
                      }
                      ?>
        <a class="btn btn-outline-success btn-block mt-4" href="<?= base_url()?>Dashboard/arsip" >Kembali</a>
       </div>  
    </div>
  </div>

</div>

                        

</div>
<!-- /.container-fluid -->

</div>

<?php $this->load->view('Admin/foot');?>