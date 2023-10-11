<?php
session_start();
date_default_timezone_set("Asia/Jakarta");


require '../Conn/functions.php';

if (!isset($_SESSION["masuk"])) {
  header("location:../index");
  exit;
}

if (isset($_POST["changeLogo"])) {

  if (ubahLogo($_POST) > 0) {
    echo "<script>
              // alert('Edit secess!');
              document.location.href='profil_Company';
          </script>
          ";
  } else {
    echo mysqli_error($koneksi);
  }
}




// $id_user=$_SESSION['masuk']["AdminID"];
// $Admin = query("SELECT * FROM mscompany WHERE AdminID= '$id_user' LIMIT 1");

$id = $_SESSION['masuk']["AdminID"];
$query      = "SELECT * FROM mscompany WHERE AdminID = '$id' ";
$query1     = mysqli_query($koneksi, $query);
$Logo       = mysqli_fetch_array($query1);

// echo  $logo['LogoCompany'];

//Penarikan data Dri tabel Pesan
// $totalcart = mysqli_query($koneksi, "SELECT * FROM msemployee WHERE AdminID = '$id_user'");
// //code Menghitung jumlah record cart
// $jumlahcart = mysqli_num_rows($totalcart);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dataprima</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../Assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../Assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../Assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../Assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../Assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../Assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../Assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../Assets/plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="../Assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../Assets/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../Assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../Assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../Assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../Assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../Assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../Assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../Assets/plugins/dropzone/min/dropzone.min.css">
  <link rel="stylesheet" href="../Assets/plugins/bs-stepper/css/bs-stepper.min.css">
  <link rel="stylesheet" href="../Assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- Toastr -->
  <link rel="stylesheet" href="../Assets/plugins/toastr/toastr.min.css">
  <script type="text/javascript">
    function PreviewImage() {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
      oFReader.onload = function(oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
      };
    };
  </script>
  <script type="text/javascript">
    function PreviewImageAdd() {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("UrlImageAdd").files[0]);
      oFReader.onload = function(oFREvent) {
        document.getElementById("UrlPreviewAdd").src = oFREvent.target.result;
      };
    };
  </script>
  <script type="text/javascript">
    function PreviewImageEdit(n) {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("UrlImageEdit" + n).files[0]);
      oFReader.onload = function(oFREvent) {
        document.getElementById("UrlPreviewEdit" + n).src = oFREvent.target.result;
      };
    };
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
  </script>
  <!-- CSS CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
  <!-- datetimepicker jQuery CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
  </script>

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../Logo/jam.png" alt="AdminLTELogo" height="60" width="60">
    </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>

        <!-- <li class="nav-item">
        
          <a class="nav-link" data-slide="true" data-toggle="modal" data-target="#logout" role="button">

            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li> -->


        <li class="nav-item dropdown" style="margin-top: -5px;">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <div class="image">
              <!-- <img src="../Assets/dist/img/user2-160x160.jpg" width="30" class="img-circle elevation-1" alt="User Image"> -->
              <?php
              if ($Logo['LogoCompany'] == null || $Logo['LogoCompany'] == "") {
              ?>
                <img src="../Assets/Logo/noimage.png" width="25" class="img-circle elevation-1" alt="User Image">
              <?php } else { ?>
                <img src="../Logo/<?= $Logo['LogoCompany']; ?>" width="25" class="img-circle elevation-1" alt="User Image">
              <?php } ?>
              <p style="margin-top: -22px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $_SESSION['masuk']["AdminName"]; ?> </p>
            </div>
          </a>

          <!-- <div class="user-block">
            <img  class="img-circle img-bordered-sm" src="../Assets/dist/img/user1-128x128.jpg" alt="user image">
            <span class="username">
              <a href="#">Jonathan Burke Jr.</a>
            </span>
            <span class="description">Online</span>
          </div> -->

          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div></div>
            <span class="dropdown-item dropdown-header">
              <div class="image">
                <?php
                if ($Logo['LogoCompany'] == null || $Logo['LogoCompany'] == "") {
                ?>
                  <img src="../Assets/Logo/noimage.png" width="150" class="img-circle elevation-1" alt="User Image">
                <?php } else { ?>

                  <img src="../Logo/<?= $Logo['LogoCompany']; ?>" class="img-circle profile-user-img" alt="User Image">
                <?php } ?>


                <h5></h5>
                <!-- <p><b>Member sejak</b></p> -->
                <p>
                  <?php echo $_SESSION['masuk']["AdminName"]; ?> <br>
                  <small> Birtday Date, @<?= date('D M Y', strtotime($_SESSION['masuk']["TglLahir"])); ?></small>
                </p>
              </div>



            </span>
            <div class="dropdown-divider"></div>

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item" data-slide="true" data-toggle="modal" data-target="#EditLogo">
              <i class="fas fa-cog mr-2"></i> Ubah Logo
            </a>

            <a href="#" class="dropdown-item" data-slide="true" data-toggle="modal" data-target="#logout">
              <i class="fas fa-sign-out-alt mr-2"></i> Keluar

            </a>

            <div class="dropdown-divider"></div>
            <a href="profil_Company" class="dropdown-item dropdown-footer">View Profile</a>
          </div>
        </li>

      </ul>
    </nav>

    <!-- update Logo -->
    <div id="EditLogo" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- konten modal Hapus-->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Change Logo</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- body modal -->
          <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input type="hidden" name="AdminID" readonly="readonly" value="<?= $_SESSION['masuk']["AdminID"]; ?>">
                <div class="custom-file">
                  <label for="gambar">Pilih logo anda</label>
                  <input id="uploadImage" class="custom-file-input" required type="file" name="gambar" onchange="PreviewImage();" />
                  <label class="custom-file-label" for="uploadImage">Choose file</label>
                  <div class="text-left">
                    <br>
                  </div>

                </div>
              </div>

              <div class="form-group">
                <label for="gambar"></label>
                <p>Ukuran maksimal gambar 200kb ! <br> Rekomandasi 500x500px</p>
                <?php
                if ($Logo['LogoCompany'] == null || $Logo['LogoCompany'] == "") {
                ?>
                  <img src="../logo/noimage.png" class="profile-user-img  thumbnail form-control" id="uploadPreview" style="width: 150px; height: 150px; border-radius: 5px;" />
                <?php } else { ?>
                  <img src="../logo/<?= $Logo['LogoCompany'] ?>" class="profile-user-img  thumbnail form-control" id="uploadPreview" style="width: 150px; height: 150px; border-radius: 5px;" />

                <?php } ?>
              </div>

          </div>
          <!-- body modal finish -->

          <!-- footer modal -->
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> &nbsp; No</button>
            <button type="submit" name="changeLogo" class="btn  btn-primary btn-sm"> <i class="fas fa-cloud-upload-alt"></i> &nbsp; Save New Logo</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- modal Logout data -->
    <div id="logout" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- konten modal Hapus-->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Logout</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- body modal -->
          <div class="modal-body">
            <form action="../View/logout" method="post" enctype="multipart/form-data">

              <label for="Name">Yakin ingin keluar .?</label>

          </div>
          <!-- body modal finish -->

          <!-- footer modal -->
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> &nbsp; No</button>
            <button type="submit" class="btn  btn-primary btn-sm"> <i class="fas fa-sign-out-alt"></i> &nbsp; Yes </button>

          </div>

          </form>
        </div>
      </div>
    </div>
    <!-- /.navbar -->