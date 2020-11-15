<?php $this->load->view('Panel/nav');?>


<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Arsip Total</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $this->db->count_all('berkas');?></div>
          </div>
          <div class="col-auto">
          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Arsip Terupload</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $this->db->count_all('berkas');?></div>
          </div>
          <div class="col-auto">
          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Arsip Terverifikasi</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
              </div>
              <div class="col">
                <div class="progress progress-sm mr-2">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="<?php
                  foreach($verifikasi->result() as $data){ echo $data->total;}?>" aria-valuemin="0" aria-valuemax="<?php echo $this->db->count_all('berkas');?>"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

        <div class="col-md-12">
        <div class="card shadow text-center mb-4 mt-4">
           <div class="card-body">
           <h5 class="card-title">Berkas Per SKPD</h5>
           <div style="width: auto;height: auto" >
									<canvas id="myChart"></canvas>
							</div>
            </div>
        </div>
      </div>
</div>

</div>
<!-- /.container-fluid -->

</div>

<?php $this->load->view('Admin/foot');?>

<?php foreach($perskpd as $data){
    $skpd[] = $data->skpd;
    $jumlah[] = $data->jml;
  }
  ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>

		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($skpd,TRUE);?>,
				datasets: [{
					label: 'Data Per SKPD',
					data: <?php echo json_encode($jumlah,TRUE);?>,
	
          backgroundColor: [
					'blue',
					'teal',
					'indigo',
					'cyan',
				
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
    });
  </script>

  
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
               
                <h3 class="modal-title">profil Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" class="form-control" name="id"/> 
                    <div class="form-body">
                    <div class="form-group">
                            <label class="control-label col-md-3">alamat</label>
                            <div class="col-md-12">
                               <input type="text" name="alamat" class="form-control" >
                                <span class="help-block"></span>
                            </div>
                     </div>
                     <div class="form-group">
                            <label class="control-label col-md-3">telepon</label>
                            <div class="col-md-12">
                               <input type="text" name="telepon" class="form-control" >
                                <span class="help-block"></span>
                            </div>
                     </div>
                     <div class="form-group">
                            <label class="control-label col-md-3">visi</label>
                            <div class="col-md-12">
                               <textarea name="visi" class="form-control" rows="5"></textarea>
                                <span class="help-block"></span>
                            </div>
                     </div>
                     <div class="form-group">
                            <label class="control-label col-md-3">misi</label>
                            <div class="col-md-12">
                               <textarea name="misi" class="form-control" rows="5"></textarea>
                                <span class="help-block"></span>
                            </div>
                     </div>
                     <div class="form-group">
                            <label class="control-label col-md-3">sambutan</label>
                            <div class="col-md-12">
                               <textarea name="sambutan" class="form-control" rows="5"></textarea>
                                <span class="help-block"></span>
                            </div>
                     </div>
                     <div class="form-group">
                            <label class="control-label col-md-3">gambaran umum</label>
                            <div class="col-md-12">
                               <textarea name="gambaran_umum" class="form-control" rows="5"></textarea>
                                <span class="help-block"></span>
                            </div>
                     </div>
                     <div class="form-group">
                            <label class="control-label col-md-3">tugas fungsi</label>
                            <div class="col-md-12">
                               <textarea name="tugas_fungsi" class="form-control" rows="5"></textarea>
                                <span class="help-block"></span>
                            </div>
                     </div>
                     <div class="form-group">
                            <label class="control-label col-md-3">sejarah</label>
                            <div class="col-md-12">
                               <textarea name="sejarah" class="form-control" rows="5"></textarea>
                                <span class="help-block"></span>
                            </div>
                     </div>
                     <div class="form-group">
                            <label class="control-label col-md-3">struktur organisasi</label>
                            <div class="col-md-12">
                               <textarea name="struktur_organisasi" class="form-control" rows="5"></textarea>
                                <span class="help-block"></span>
                            </div>
                     </div>
                   
                                        
                      
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
        
        var save_method; //for save method string
        var table;
        var base_url = '<?php echo base_url();?>';
        

        
        function edit_profil(id)
        {
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
        
            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('profil/ajax_edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
        
                    $('[name="id"]').val(data.id);
              
                    $('[name="alamat"]').val(data.alamat);
                    $('[name="telepon"]').val(data.telepon);
                    $('[name="visi"]').val(data.visi);
                    $('[name="misi"]').val(data.misi);
                    $('[name="sambutan"]').val(data.telepon);
                    $('[name="gambaran_umum"]').val(data.gambaran_umum);
                    $('[name="tugas_fungsi"]').val(data.tugas_fungsi);
                    $('[name="sejarah"]').val(data.sejarah);
                    $('[name="struktur_organisasi"]').val(data.struktur_organisasi);
                  
       
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit profil'); // Set title to Bootstrap modal title
                    
                    $('#photo-preview').show(); // show photo preview modal
                    
                    if(data.file)
                    {
                     
                        $('#photo-preview div').html('File lama: <a href="'+base_url+'assets/upload/'+data.file+'" class="btn btn-info" target="_blank">Lihat File</a><input type="hidden" name="fileold" class="form-control" value="' + data.file + '">'); 
                       // remove photo

                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
        
     
        function save()
        {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable 
            var url;
        
           
                url = "<?php echo site_url('profil/ajax_update')?>";
         
        
            // ajax adding data to database
            var formData = new FormData($('#form')[0]);
            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {
         
                    if(data.status) //if success close modal and reload ajax table
                    {
                        $('#modal_form').modal('hide');
                        $('#form')[0].reset();
                   
                        location.reload();
                        return false;
                    }
                    else
                    {
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
        
        
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
        
                }
            });
        }
   
 
</script>