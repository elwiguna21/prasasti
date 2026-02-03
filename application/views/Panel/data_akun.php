<?php 
$this->load->view('Panel/nav');?>

<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data SKPD</h1>
  
</div>
<div class="col-md-12">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data SKPD</h6>
        <button class="btn btn-success" onclick="add_akun();"></i> Tambah Data</button>
      </div>
      <div class="card-body">
    
                <class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                         <tr>
                             <th>No</th>
                           <th>Nomor SKPD</th>
                            <th>Nama SKPD </th>
                            <th>Alamat SKPD</th>
                            <th>Nama Operator</th>
                            <th>Kontak Operator</th>
                            <th>Username</th>
                            <th width="100">Action</th>
                         </tr>
                        </thead>
                  
                        <tbody>
                                                        
                        </tbody>
                    </table>
                </class=>
                </div>

            </div>
        </div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               
                <h3 class="modal-title">akun Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id_skpd"/> 
                    <div class="form-body"> 
                        <div class="form-group">
                            <label class="control-label col-md-3">Nomor SKPD</label>
                            <div class="col-md-12">
                                <input type="text" name="nomor_skpd" placeholder="nomor_skpd" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama SKPD</label>
                            <div class="col-md-12">
                                <input type="text" name="nama_skpd" placeholder="nama_skpd" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat SKPD</label>
                            <div class="col-md-12">
                                <input type="text" name="alamat_skpd" placeholder="alamat_skpd" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Operator</label>
                            <div class="col-md-12">
                                <input type="text" name="nama_operator" placeholder="nama_operator" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kontak Operator</label>
                            <div class="col-md-12">
                                <input type="text" name="kontak_operator" placeholder="kontak_operator" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Username</label>
                            <div class="col-md-12">
                                <input type="text" name="username" placeholder="username" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-12">
                                <input type="text" name="password" placeholder="password" class="form-control"></input>
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
<!-- End Bootstrap modal -->

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
  
  
    <script type="text/javascript">
        
        var save_method; //for save method string
        var table;
        
        $(document).ready(function() {
        
            //datatables
            table = $('#dataTable').DataTable({ 
        
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [2,'asc'], //Initial no order.
        
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo base_url('Akun/ajax_list')?>",
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
        
            
        
            //set input/textarea/select event when change value, remove class error and remove text help block 
            $("input").change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("textarea").change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("select").change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
        
        });
        
        
        
        function add_akun()
        {
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add akun'); // Set Title to Bootstrap modal title
        }
        
        function edit_akun(id)
        {
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
        
            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('Akun/ajax_edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
        
                    $('[name="id_skpd"]').val(data.id_skpd);
                    $('[name="username"]').val(data.username);
                    $('[name="password"]').val();
                    $('[name="nomor_skpd"]').val(data.nomor_skpd);
                    $('[name="nama_skpd"]').val(data.nama_skpd);
                    $('[name="alamat_skpd"]').val(data.alamat_skpd);
                    $('[name="nama_operator"]').val(data.nama_operator);
                    $('[name="kontak_operator"]').val(data.kontak_operator);
                 
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit akun'); // Set title to Bootstrap modal title
        
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
        
            if(save_method == 'add') {
                url = "<?php echo site_url('Akun/ajax_add')?>";
            } else {
                url = "<?php echo site_url('Akun/ajax_update')?>";
            }
        
            // ajax adding data to database
            $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {
         
                    if(data.status) //if success close modal and reload ajax table
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
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
        
        function delete_akun(id)
        {
            if(confirm('Are you sure delete this data?'))
            {
                // ajax delete data to database
                $.ajax({
                    url : "<?php echo site_url('Akun/ajax_delete')?>/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
        
            }
        }
 
</script>
 

</body>
</html>