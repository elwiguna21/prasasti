<?php 
$this->load->view('Panel/nav');?>


<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  
  
</div>
<div class="col-md-12">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Surat Masuk E-Office</h6>
        <button class="btn btn-success" onclick="add_akun();"></i> Sync</button>
      </div>
      <div class="card-body">
      <div class="row">
    <select name="skpd" id="skpd" class="form-control col-md-4">
        <option value="">Semua SKPD</option>
    </select>
   <input type="date" name="start" id="start" class="form-control col-md-3 ml-2">
   <input type="date" name="end" id="end" class="form-control col-md-3 ml-2">
   </div>
                <class="table-responsive">
                    <table class="table table-bordered mt-4" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                         <tr>
                            <th>No</th>
                           <th>Tanggal Surat</th>
                            <th>Nomor Surat </th>
                            <th>Perihal</th>
                            <th>Tujuan</th>
                            <th>Pembuat</th>
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
  
  
</body>
</html>