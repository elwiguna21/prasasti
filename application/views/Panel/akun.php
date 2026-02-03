<?php $this->load->view('Admin/nav');?>


<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Profil</h1>
  <a href="<?= base_url()?>Dashboard" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-back fa-sm text-white-50"></i> Kembali</a>
</div>
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
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Akun</h6>
          <!-- Card Body -->
        </div>
        <div class="card-body">
          <div class="row">
          
            <div class="col-md-6">     
              <form class="form-horizontal" action="<?= base_url()?>Dashboard/gantipassword" method="post">
                <?php
                if($akun != null){
                  foreach($akun as $data){
                ?>
                <input type="hidden" name="nomor_skpd" value="<?= $data->nomor_skpd?>">
                <div class="form-group">
                  <label>Password Lama</label>
                  <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                  <label>Password Baru</label>
                  <input type="password" class="form-control" name="password_new"  id="txtNewPassword">
                </div>
                <div class="form-group">
                  <label>Ulangi Password</label>
                  <input type="password" class="form-control" name="password_new_confirm"id="txtConfirmPassword" >
                  <div class="registrationFormAlert" style="color:green;" id="CheckPasswordMatch"></div>
                </div>

                <button class="btn btn-outline-success btn-block mt-4" type="submit" name="simpan">UBAH</button>
              
                <?php
                    }
                  }
                  ?>
              </form>  
            </div>    

        </div>
      </div>

  </div>
</div>
</div>
</div>


<?php $this->load->view('Admin/foot');?>
<script>
    function checkPasswordMatch() {
        var password = $("#txtNewPassword").val();
        var confirmPassword = $("#txtConfirmPassword").val();
        if (password != confirmPassword)
            $("#CheckPasswordMatch").html("Passwords Tidak Sama");
        else
            $("#CheckPasswordMatch").html("Passwords Sama");
    }
    $(document).ready(function () {
       $("#txtConfirmPassword").keyup(checkPasswordMatch);
    });
    </script>