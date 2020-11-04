<?php $this->load->view('Admin/nav');?>

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
      <span aria-hidden="true">x</span><span class="only">Close</span></button>
    <?= $this->session->flashdata('SUCCESS') ?>
  </div>
</div>
<?php
 }
 if ($this->session->flashdata('GAGAL')) { ?>
  <div class="col-md-12">
  <div role="alert" class="alert alert-warning">
    <button data-dismiss="alert" class="close" type="button">
      <span aria-hidden="true">x</span><span class="only">Close</span></button>
    <?= $this->session->flashdata('GAGAL') ?>
  </div>
</div>
<?php } 
$uri = $this->uri->segment(2);
if($uri != 'arsip'){

  foreach($berkas as $data){
    $id = $data->id;
    $kode_klsf = $data->kode_klsf;
    $indek = $data->indek;
    $deskripsi = $data->deskripsi;
    $tahun = $data->tahun;
    $unit_kerja_pencipta = $data->unit_kerja_pencipta;
    $file = $data->file;
    
  }
} else{
  return false;
}
?>

<div class="col-md-4">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Arsip Statis</h6>
      <!-- Card Body -->
      </div>
      <div class="card-body">
        <?php if($berkas != null){
          ?>
         <form class="form-horizontal" action="<?= base_url()?>Dashboard/arsipupdate" method="post" enctype="multipart/form-data">
         <?php
        } else {
        ?>
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <?php } ?>
        <input type="hidden" name="id" value="<?= $id ?>">
          <div class="form-group">
            <label>Kode Klasifikasi</label>
            <input type="text" class="form-control" name="kode_klsf" value="<?= $kode_klsf?>">
          </div>
          <div class="form-group">
            <label>Indek</label>
            <input type="text" class="form-control" name="indek" value="<?= $indek?>">
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" name="deskripsi" rows="10" value=""><?= $deskripsi?></textarea>
          </div>
          <div class="form-group">
            <label>Tahun</label>
            <input type="number" class="form-control" name="tahun"value="<?= $tahun?>" >
          </div>
          <div class="form-group">
            <label>Unit Kerja Pencipta</label>
            <input type="text" class="form-control" name="unit_kerja_pencipta"value="<?= $unit_kerja_pencipta?>" >
          </div>
          <div class="form-group">
            <label>File</label>
           :  <?= $file?>
           <input type="hidden" name="fileold" value="<?= $file?>">
            <input type="file" class="form-control dropify" name="file" data-height="200" >
          </div>

          <button class="btn btn-outline-success btn-block mt-4" type="submit" name="update">SIMPAN</button>
          <?php if($berkas != null){
          ?>
          <a class="btn btn-outline-info btn-block" href="<?= base_url()?>Dashboard/arsip" name="batal">BATAL</a>
          <?php
          } else {
          ?>
          <button class="btn btn-outline-info btn-block" type="reset" name="batal">BATAL</button>
          <?php } ?>
        </form>  
        </div>    
      </div>

  </div>

  <div class="col-md-8">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Arsip Statis</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        
        <div class="table-responsive">
                <table class="table  table-hover table-bordered mt-2 mb-2" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Klasifikasi</th>
                      <th>Indek</th>
                      <th>Tahun</th>
                      <th>Unit kerja <br>Pencipta</th>
                      <th>Aksi</th>
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


</div>
<!-- /.container-fluid -->

</div>

<?php $this->load->view('Admin/foot');?>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->

    <!-- datatable -->
    <link href=" https://cdn.datatables.net/1.10.22/css/dataTables.semanticui.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.semanticui.min.css" rel="stylesheet">
    
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.semanticui.min.js"></script>
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
            table = $('#dataTable').DataTable({ 
              dom: "fBrtip",
              buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                // "order": [1,'desc'], //Initial no order.
        
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo base_url('Dashboard/ajax_list')?>",
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