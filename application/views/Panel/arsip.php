<?php 
$this->load->view('Panel/nav');?>

<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Arsip</h1>
  
</div>

<!-- Content Row -->



  <div class="col-md-12">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Arsip Statis</h6>
          </div>
      <!-- Card Body -->
      <div class="card-body">

			<a href="<?= base_url()?>Excel/form"  class="btn btn-info">Import Data Excel</a>

		<hr>
      Pilih SKPD : 
            <select id="table-filter" class="form-control col-md-6 mt-2 mb-3">
            <option value="">Semua</option>
            <?php foreach($skpd as $data){ ?>
              <option alamat="<?= $data->alamat_skpd?>"><?= $data->nama_skpd?></option>
            <?php } ?>

            </select>
           
        <div class="table-responsive">
                <table class="table table-hover table-bordered mt-2 mb-2" id="dataTable" width="100%" cellspacing="0">
                  <thead align="center">
                    <tr>
                      <th rowspan="2">No</th>
                      <th rowspan="2">Tanggal<br>Entry</th>
                      <th rowspan="2">Nama SKPD</th>
                      <th rowspan="2">Kode<br> Klasifikasi</th>
                      <th rowspan="2">Indek</th>
                      <th rowspan="2">Deskripsi</th>
                      <th rowspan="2">Tahun</th>  
                      <th rowspan="2">Unit kerja <br>Pencipta</th>
                      <th colspan="4">Lokasi</th>
                      <th colspan="2">Keterangan</th>
                      <th rowspan="2">Status</th>
                      <th rowspan="2" width="100">Aksi</th>
                    </tr>
                    <tr>
                      <th>Sampul</th>
                      <th>Berkas</th>
                      <th>Box</th>
                      <th>Rak</th>
                      <th>Tk Perkembangan</th>
                      <th>Ruang</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
        </div>
       
      </div>
    </div>
  </div>
 



</div>
<!-- /.container-fluid -->

</div>

<div class="modal fade" id="arsipmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-body">
        <div class="container">
        <form class="form-horizontal" id="form" action="#">
     
            <input type="text" name="id" id="id">
          <div class="form-group">
             <div class="row">
         
            <label class="col-md-2">Kode Klasifikasi</label>
            <input type="text" class="form-control col-md-10" name="kode_klsf" readonly>
            
          </div>
            </div>
          <div class="form-group">
             <div class="row">
            <label class="col-md-2">Indek</label>
            <input type="text" class="form-control col-md-10" name="indek" readonly>
          </div>
            </div>
          <div class="form-group">
             <div class="row">
            <label class="col-md-2">Deskripsi</label>
            <textarea class="form-control col-md-10" name="deskripsi" rows="5"readonly ></textarea>
          </div>
            </div>
          <div class="form-group">
             <div class="row">
            <label class="col-md-2">Tahun</label>
            <input type="number" class="form-control col-md-10" name="tahun" readonly>
          </div>
            </div>
          <div class="form-group">
             <div class="row">
            <label class="col-md-2">Unit Kerja Pencipta</label>
            <input type="text" class="form-control col-md-10" name="unit_kerja_pencipta" readonly>
            </div>
          </div>
          <div class="form-group">
             <div class="row">
            <label class="col-md-2">Lokasi Sampul</label>
            <input type="number" class="form-control col-md-10" name="lokasi_sampul">
           </div>
          </div>
          <div class="form-group">
          <div class="row">
            <label class="col-md-2">Lokasi Berkas</label>
            <input type="number" class="form-control col-md-10" name="lokasi_berkas">
           </div>
          </div>
          <div class="form-group">
             <div class="row">
            <label class="col-md-2">Lokasi Box</label>
            <input type="number" class="form-control col-md-10" name="lokasi_box">
           </div>
          </div>
          <div class="form-group">
             <div class="row">
            <label class="col-md-2">Lokasi Rak</label>
            <input type="number" class="form-control col-md-10" name="lokasi_rak">
           </div>
          </div>
          <div class="form-group">
             <div class="row">
            <label class="col-md-2">Tingkat Perkembangan</label>
            <select class="form-control col-md-10" name="keterangan_tk_perkembangan">
              <option>Pilih</option>
              <option value="Asli">Asli</option>
              <option value="Copy">Copy</option>
             </select>
           </div>
          </div>
          <div class="form-group">
             <div class="row">
            <label class="col-md-2">Ruang Penyimpanan</label>
            <select class="form-control col-md-10" name="ruang_penyimpanan">
            <option>Pilih</option>
              <option value="Depo 1">Depo 1</option>
              <option value="Depo 2">Depo 2</option>
              <option value="Depo 3">Depo 3</option>
             </select>
           </div>
          </div>
          <div class="form-group" id="photo-preview">
                            <div class="col-md-9">
                               
                                <span class="help-block"></span>
                            </div>
                        </div>
          <div class="form-group">
             <div class="row">
            <label class="col-md-2">File</label>
            <input type="file" class="form-control col-md-10" name="file">
           </div>
          </div>
          <button class="btn btn-outline-success btn-block mt-4" type="submit"  id="btnSave" onclick="save()">SIMPAN</button>
          <button class="btn btn-outline-info btn-block" data-dismiss="modal">BATAL</button>
          
        </form> 
        </div>
      </div> 
        </div>    
      </div>

  </div>
  <style>
    @media print {
        .header-print {
          display: table-header-group;
        }
      }
  </style>
<?php $this->load->view('Admin/foot');?>


    <!-- datatable -->
    <!-- css -->
    <link href=" https://cdn.datatables.net/1.10.22/css/dataTables.semanticui.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.semanticui.min.css" rel="stylesheet">
      <!-- js -->
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.semanticui.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> -->
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.semanticui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>
  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" />

<script type="text/javascript">
        
        var save_method; //for save method string
        var table;
        var base_url = '<?php echo base_url();?>';
        
        $(document).ready(function() {
        
            //datatables

            $('#table-filter').on('change', function(){

              table.search(this.value).draw(); 
              
               dinas = $("#table-filter option:selected" ).text();
               alamat = $("#table-filter option:selected").attr("alamat");
               
              });
              
            
            table = $('#dataTable').DataTable({ 
              dom: "lfBrtip",
              buttons: [{
                extend: 'pdfHtml5',
                orientation: 'landscape',
                title: 'DAFTAR PERTELAAN BERKAS ARSIP STATIS',
                pageSize: 'LEGAL',
                messageTop: function () {
          
                  dinas = $("#table-filter option:selected" ).text();
                  alamat = $("#table-filter option:selected").attr("alamat");

                  if ( dinas === 'Semua' ) {
                    return  ' ';
                        
                  } else {
                    return  '\r\n Nama SKPD    : ' + dinas + '' +
                                '\r\n Alamat SKPD  : ' + alamat + '';
                  }
                    
                },
                exportOptions: {
                                 columns: [ 0,3,4,5,6,7,8,9,10,11,12,13 ],  
                               }
            },'colvis' ],
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                // "order": [1,'desc'], //Initial no order.
        
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo base_url('Panel/ajax_list')?>",
                    "type": "POST"
                },
        
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

           
                  });
             table.buttons().container()
                    .appendTo( $('div.eight.column:eq(0)', table.table().container()) );

              $('.dropify').dropify({
                messages: {
                            default: '<h6>Pilih File. Anda juga bisa drag file kesini<br>File berupa PDF, RAR dan ZIP</h6>',
                            replace: 'Ganti',
                            remove:  'Hapus',
                            error:   'error'
                           }
               });
              
           
            

   
          }); 

          function edit_arsip(id)
        {
           
            $('#form')[0].reset(); // reset form on modals
      
            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('Panel/ajax_edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                
                    $('#id').val(data.id);
                    $('[name="kode_klsf"]').val(data.kode_klsf);
                    $('[name="indek"]').val(data.indek);
                    $('[name="tahun"]').val(data.tahun);
                    $('[name="deskripsi"]').val(data.deskripsi);
                    $('[name="unit_kerja_pencipta"]').val(data.unit_kerja_pencipta);
                    $('[name="lokasi_sampul"]').val(data.lokasi_sampul);
                    $('[name="lokasi_berkas"]').val(data.lokasi_berkas);
                    $('[name="lokasi_box"]').val(data.lokasi_box);
                    $('[name="lokasi_rak"]').val(data.lokasi_rak);
                    $('[name="keterangan_tk_perkembangan"]').val(data.keterangan_tk_perkembangan);
                    $('[name="ruang_penyimpanan"]').val(data.ruang_penyimpanan);
                 
                    $('#arsipmodal').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit arsip'); // Set title to Bootstrap modal title
                    $('#photo-preview').show(); // show photo preview modal
                    
                    if(data.file)
                    {
                     
                        $('#photo-preview div').html('File lama: <a href="'+base_url+'assets/data/'+data.file+'" id="imgold"  alt="" target="_blank">Lihat File</a><input type="text" name="fileold" class="form-control" value="' + data.file + '">'); 
                       // remove photo

                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
        
        function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax 
        }
        
        function save()
        {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable 
            var url;
        
            
            url = "<?php echo site_url('Panel/ajax_update')?>";
            
        
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
                        $('#arsipmodal').modal('hide');
                        reload_table();
                        // location.reload();
                    }
                    else
                    {
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                  
        
        
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
<script>
$(document).ready(function(){

	$('#import_form').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url:"<?php echo base_url(); ?>excel/import",
			method:"POST",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success:function(data){
				$('#file').val('');
				alert(data);
			}
		})
	});

});
</script>