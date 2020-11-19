<?php 
error_reporting(0);
$this->load->view('Panel/nav');?>

<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Arsip</h1>
  
</div>

<!-- Content Row -->



  <div class="col-md-12">
    <div class="card shadow mb-4">
    <div class="card-body">
      <!-- Card Header - Dropdown -->
      <h3>Form Import</h3>
	<hr>

	<a href="<?php echo base_url("assets/Format.xlsx"); ?>" class="btn btn-outline-info mb-4">Download Format</a>
  <br>
  Petunjuk 
  <ul>
    <li>Download Format Excel dengan menekan tombol diatas</li>
    <li>Isikan Data sesuai data yang diminta di format tersebut</li>
    <li>Kolom yang bisa di kosongkan kolom lokasi dan keterangan</li>
    <li>NO SKPD merupakan nomor dari SKPD yang sudah ada di sistem ini untuk nomornya bisa dilihat di menu<a href="<?= base_url()?>Panel/skpd"> <span class="badge badge-info"> Data SKPD</span></a></li>
    <li>Sesuaikan nomor tersebut dengan nama SKPD, untuk berkas yang diinput</li>
  </ul>
	<br>

	<!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
	<form method="post" action="<?php echo base_url("Excel/form"); ?>" enctype="multipart/form-data">
		<!--
		-- Buat sebuah input type file
		-- class pull-left berfungsi agar file input berada di sebelah kiri
		-->
		<input type="file" name="file" required accept=".xls, .xlsx" class="form-control dropify">

		<!--
		-- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
		-->
		<input type="submit" name="preview" value="Preview"class="btn btn-outline-primary btn-block mt-3 mb-4">
	</form>

	<?php
	if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
		if(isset($upload_error)){ // Jika proses upload gagal
			echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
			die; // stop skrip
		}

		// Buat sebuah tag form untuk proses import data ke database
		echo "<form method='post' action='".base_url("Excel/import")."'>";


    echo "
    <table class='table table-hover table-bordered mt-2 mb-2' id='dataTable' width='100%' cellspacing='0'>
		<thead>
                    <tr>
                      <th rowspan='2'>No SKPD</th>
                      <th rowspan='2'>Kode<br> Klasifikasi</th>
                      <th rowspan='2'>Indek</th>
                      <th rowspan='2'>Deskripsi</th>
                      <th rowspan='2'>Tahun</th>  
                      <th rowspan='2'>Unit kerja <br>Pencipta</th>
                      <th colspan='4'>Lokasi</th>
                      <th colspan='2'>Keterangan</th>
                   
                    </tr>
                    <tr>
                      <th>Sampul</th>
                      <th>Berkas</th>
                      <th>Box</th>
                      <th>Rak</th>
                      <th>Tk Perkembangan</th>
                      <th>Ruang</th>
                    </tr>
                  </thead>";

		$numrow = 2;
		$kosong = 0;

		// Lakukan perulangan dari data yang ada di excel
		// $sheet adalah variabel yang dikirim dari controller
		foreach($sheet as $row){
			// Ambil data pada excel sesuai Kolom
			$nomor_skpd = $row['A']; // Ambil data NIS
			$kode_klsf = $row['B']; // Ambil data nama
			$indek = $row['C']; // Ambil data jenis kelamin
      $deskripsi = $row['D'];
      $tahun = $row['E']; // Ambil data alamat
      $unit_kerja_pencipta = $row['F'];
      $lokasi_sampul = $row['G'];
      $lokasi_berkas = $row['H'];
      $lokasi_box = $row['I'];
      $lokasi_rak = $row['J'];
      $keterangan_tk_perkembangan = $row['K'];
      $ruang_penyimpanan = $row['L'];


			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 3){
				// Validasi apakah semua data telah diisi
		

				echo "<tr>";
				echo "<td>".$nomor_skpd."</td>";
				echo "<td>".$kode_klsf."</td>";
				echo "<td>".$indek."</td>";
        echo "<td>".$deskripsi."</td>";
        echo "<td>".$tahun."</td>";
        echo "<td>".$unit_kerja_pencipta."</td>";
        echo "<td>".$lokasi_sampul."</td>";
        echo "<td>".$lokasi_berkas."</td>";
        echo "<td>".$lokasi_box."</td>";
        echo "<td>".$lokasi_rak."</td>";
        echo "<td>".$keterangan_tk_perkembangan."</td>";
        echo "<td>".$ruang_penyimpanan."</td>";
				echo "</tr>";
			}

			$numrow++; // Tambah 1 setiap kali looping
		}

		echo "</table>";

		// Cek apakah variabel kosong lebih dari 0
		// Jika lebih dari 0, berarti ada data yang masih kosong
 // Jika semua data sudah diisi
			echo "<hr>";

			// Buat sebuah tombol untuk mengimport data ke database
			echo "<button type='submit' name='import' class='btn btn-outline-success btn-block'>Import</button>";
			echo "<a href='".base_url("Panel/arsip")."' class='btn btn-outline-dark btn-block'>Cancel</a>";
		

		echo "</form>";
	}
	?>
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
        
        $(document).ready(function() {
        

            
              $('.dropify').dropify({
                messages: {
                            default: '<h6>Pilih File. Anda juga bisa drag file kesini<br>File berupa xls dan xlsx</h6>',
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
                    $('[name="ruang_penyimpanan"]').val(data.ruang_penyimpanan );
                 
                    $('#arsipmodal').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit arsip'); // Set title to Bootstrap modal title
        
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
            $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {
        
                    if(data.status) //if success close modal and reload ajax table
                    {
                        $('#arsipmodal').modal('hide');
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