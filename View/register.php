<?php 
require '../Conn/functions.php';

if (isset($_POST["register"])) {
  
    if (registrasi($_POST) > 0 ) {
      echo "<script>
                alert('Register Berhasil, silahkan Login!');
                document.location.href='../index.php';
            </script>
            ";
    } else {
      echo mysqli_error($koneksi);
    }
}

date_default_timezone_set("Asia/Jakarta");

//Data yang di kirim dari handphone
    $Tanggal = date("y-m");

    $query = "SELECT max(CompanyCode) as maxKode FROM mscompany"; 
    $hasil = mysqli_query($koneksi, $query);
    $data  = mysqli_fetch_array($hasil);
    $kodeUser = substr($data['maxKode'],10,15)+1;
    if ($data['maxKode'] = '') {
    $char = "ATD/21-12/00001"; 
    } else {
    $char = "ATD/". $Tanggal. "/" ;
    $kode = $char . sprintf("%05s", $kodeUser);
    }
// echo $kode;


 ?>
<!-- finisj id USER -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../Assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../Assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../Assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../Assets/index2.html" class="h4"><b>REGISTER</b></a>
    </div>
    <div class="card-body">
      



      <form id="myform" method="post">
        <div class="input-group mb-3">
        <input type="hidden" name="Id_Company" readonly="readonly" value="<?= $kode; ?>">
         
          <input type="Text" id="Company" name="Company" class="form-control" required autocomplete="off" placeholder="Company name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" id="Kota" name="Kota" class="form-control" required autocomplete="off" placeholder="Kota">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-address-card"></span>
            </div>
          </div>
        </div>
        

        <div class="input-group mb-3">
          <input type="number" id="JmlEmployee" name="JmlEmployee" class="form-control" required placeholder="Jumlah Employee"  autocomplete="off" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-tie"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="number" id="Telp" name="Telp" class="form-control" required placeholder="Telephone"  autocomplete="off" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-address-book"></span>
            </div>
          </div>
        </div>

        
        <div class="input-group mb-3">
          <input type="email" id="Email" name="Email" class="form-control" required placeholder="Email"  autocomplete="off" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="Password" class="form-control" name="Password" id="Password" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="Password" class="form-control" name="Password2" id="Password2" required placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" required name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" onclick="validasi()" name="register" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div> -->

      <a href="../Index.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../Assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../Assets/dist/js/adminlte.min.js"></script>
</body>
</html>
