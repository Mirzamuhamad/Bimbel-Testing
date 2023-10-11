<?php
@session_start();
require 'Conn/functions.php';
//Cek cookie dahulu sebelum cek session

if (isset($_COOKIE['Company']) && isset($_COOKIE['key'])) {

  $id_Company = $_COOKIE['id_Company'];
  $key = $_COOKIE['key'];

  //ambil username berdasarkan id

  $result = mysqli_query($koneksi, "SELECT Email FROM mscompany WHERE CompanyCode = $id_Company");
  $row = mysqli_fetch_assoc($result);

  //cek coockie dan username

  if ($key === hash('sha256', $row['Email'])) {
    $_SESSION['masuk'] = true;
  }
}


//Cek jika sudah masuk maka arahkan ke tampil buku
if (isset($_SESSION["masuk"])) {
  header("location:View/dashboard.php");
  exit;
}

//chek data form

if (isset($_POST["masuk"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];
  $sql      = "SELECT * FROM mscompany WHERE Email = '$username' ";


  $query    = mysqli_query($koneksi, $sql);
  $result   = mysqli_num_rows($query);

  if ($result > 0) {
    $fetch = mysqli_fetch_array($query);

    //set session
    if (password_verify($password, $fetch["Password"])) {

      $_SESSION["masuk"] = $fetch;
      //cek remember me
      if (isset($_POST['remember'])) {
        //membuat cookie  
        setcookie('Company', $fetch['CompanyCode'], time() + 60);
        setcookie('key', hash('sha256', $fetch['username']), time() + 60); //time untuk membatasi waktu seberapa lama cookie akan di simpan
      }

      header('location:View/dashboard.php');
      // header('location:View/tr_Order');
      exit;
    }
  }

  $error = true;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="Assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="Assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="dashboard.php" class="h3"><b>LOGIN</a>
      </div>
      <div class="card-body">
        <!-- <p class="login-box-msg">Sign in to start your session</p> -->

        <form method="post">

          <!--Pesan kesalahan masuk -->
          <?php if (isset($error)) : ?>
            <p style="color:  red; text-align: center; font-style: italic;">Username atau password salah!silahkan coba lagi!!</p>
          <?php endif; ?>

          <div class="input-group mb-3">
            <input type="email" id="username" name="username" required autofocus class="form-control" placeholder="Email">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" id="password" name="password" required class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember" value="remember-me">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="masuk" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
        <!-- /.social-auth-links -->

        <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->

        <!-- <a href="View/register.php" class="text-center">Register</a> -->

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="Assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="Assets/dist/js/adminlte.min.js"></script>
</body>

</html>