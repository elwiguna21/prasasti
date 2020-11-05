<?php 
$this->load->view('Panel/nav');?>

<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Arsip</h1>
  
</div>

<!-- Content Row -->

<div class="row">
<?php if ($this->session->flashdata('SUCCESS')) { ?>
  <div class="col-md-12">
  <div role="alert" class="alert alert-success">
    <button data-dismiss="alert" class="close" type="button">
      <span aria-hidden="true">x</span></button>
    <?= $this->session->flashdata('SUCCESS') ?>
  </div>
</div>
<?php
 }
 if ($this->session->flashdata('GAGAL')) { ?>
  <div class="col-md-12">
  <div role="alert" class="alert alert-warning">
    <button data-dismiss="alert" class="close" type="button">
      <span aria-hidden="true">x</span></button>
    <?= $this->session->flashdata('GAGAL') ?>
  </div>
</div>
<?php } 

?>


  <div class="col-md-12">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Arsip Statis</h6>
        <a class="btn btn-dark" href="" data-toggle="modal" data-target="#arsipmodal">EDit data</a>
      </div>
      <!-- Card Body -->
      <div class="card-body">
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
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-body">
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

       
          <div class="form-group">
            <label>Kode Klasifikasi</label>
            <input type="text" class="form-control" name="kode_klsf">
          </div>
          <div class="form-group">
            <label>Indek</label>
            <input type="text" class="form-control" name="indek" >
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" name="deskripsi" rows="10" ></textarea>
          </div>
          <div class="form-group">
            <label>Tahun</label>
            <input type="number" class="form-control" name="tahun">
          </div>
          <div class="form-group">
            <label>Unit Kerja Pencipta</label>
            <input type="text" class="form-control" name="unit_kerja_pencipta" >
          </div>
          <div class="form-group">
            <label>File</label>
   
            <input type="file" class="form-control dropify" name="file" data-height="200" >
          </div>

          <button class="btn btn-outline-success btn-block mt-4" type="submit" name="simpan">SIMPAN</button>
         
          <button class="btn btn-outline-info btn-block" type="reset" name="batal">BATAL</button>
         
        </form> 
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
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->

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
        
        $(document).ready(function() {
        
            //datatables

            $('#table-filter').on('change', function(){

              table.search(this.value).draw(); 
              
               dinas = $("#table-filter option:selected" ).text();
               alamat = $("#table-filter option:selected").attr("alamat");
               
              });
              
            
            table = $('#dataTable').DataTable({ 
              dom: "lfBrtip",
              buttons: ['excel',{
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

</script>