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