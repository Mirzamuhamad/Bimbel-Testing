<?php include '../Template/header.php'; ?>
<!-- Main Sidebar Container -->
<?php include '../Template/sidebar.php'; ?>
<?php
$CompanyID = $_SESSION['masuk']["AdminID"];
$CompanyData = query("SELECT * FROM mscompany WHERE AdminID = '$CompanyID' ");
// $totalEmployee = mysqli_query($koneksi, "SELECT * FROM mscompany WHERE AdminID='$CompanyID'");
// //code Menghitung jumlah record cart
// $employee = mysqli_num_rows($totalEmployee);

if (isset($_POST["updateCompany"])) {

    if (updateCompany($_POST) > 0) {
        echo "<script>
                //   alert('Update Profil Berhasil, silahkan Login!');
                  document.location.href='profil_Company';
              </script>
              ";
    } else {
        echo mysqli_error($koneksi);
    }
}

if (isset($_POST["updatePassword"])) {

    if (gantiPassword($_POST) > 0) {
        echo "<script>
                  alert('Ubah Password Berhasil, silahkan Login!');
                  document.location.href='logout';
              </script>
              ";
    } else {
        echo mysqli_error($koneksi);
    }
}



?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Admin Profile</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View Profile</li>
                        <li class="breadcrumb-item active">Admin Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <?php
                                if ($Logo['LogoCompany'] == null || $Logo['LogoCompany'] == "") {
                                ?>
                                    <img class="profile-user-img img-fluid img-circle" src="../Assets/Logo/noimage.png" alt="Company profile picture">
                                <?php } else { ?>
                                    <img class="profile-user-img img-fluid img-circle" src="../Logo/<?= $CompanyData[0]['LogoCompany']; ?>" alt="Admin profile picture">
                                <?php } ?>

                            </div>

                            <h6 class="profile-username text-center"><?= $CompanyData[0]['AdminName']; ?></h6>

                            <p class="text-muted text-center">Birtday Date, <?= date('d-m-Y', strtotime($CompanyData[0]["TglLahir"])); ?></p>

                            <!-- <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item ">
                                    <b>All Employee</b> <a class="float-right"><?= $employee; ?></a>
                                </li>
                            </ul> -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Contact</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-phone mr-1"></i> Phone</strong>

                            <p class="text-muted">
                                <?= $CompanyData[0]['Phone']; ?>
                            </p>

                            <hr>

                            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                            <p class="text-muted"><?= $CompanyData[0]['Email']; ?></p>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Admin Information</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Update Profil</a></li>
                                <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Ubah Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">

                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> City Location</strong>

                                    <p class="text-muted"><?= $CompanyData[0]['Kota']; ?></p>
                                    <hr>
                                    <strong><i class="fas fa-building mr-1"></i> Address </strong>

                                    <p class="text-muted"><?= $CompanyData[0]['Alamat']; ?></p>




                                </div>

                                <!-- update data -->
                                <div class="tab-pane" id="settings">
                                    <form method="post" class="form-horizontal">
                                        <input type="hidden" id="AdminID" name="AdminID" value="<?= $CompanyData[0]['AdminID']; ?>" class="form-control" required autocomplete="off" placeholder="Admin ID">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Admin Name</label>
                                            <div class="col-sm-10">
                                                <input type="Text" id="AdminName" name="AdminName" value="<?= $CompanyData[0]['AdminName']; ?>" class="form-control" required autocomplete="off" placeholder="Company name">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="TglLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                            <div class="col-sm-10">
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input type="Text" id="TglLahir" name="TglLahir" required class="form-control datetimepicker" value="<?= date('d-m-Y', strtotime($CompanyData[0]["TglLahir"])); ?>">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="Text" id="Email" readonly="false" name="Email" value="<?= $CompanyData[0]['Email']; ?>" class="form-control" required autocomplete="off" placeholder="Company name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="Text" id="Phone" name="Phone" value="<?= $CompanyData[0]['Phone']; ?>" class="form-control" required autocomplete="off" placeholder="Company name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Kota</label>
                                            <div class="col-sm-10">
                                                <input type="Text" id="kota" name="Kota" value="<?= $CompanyData[0]['Kota']; ?>" class="form-control" required autocomplete="off" placeholder="Kota">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Alamat</label>
                                            <div class="col-sm-10">
                                                <input type="Textarea" id="Alamat" name="Alamat" value="<?= $CompanyData[0]['Alamat']; ?>" class="form-control" required autocomplete="off" placeholder="Alamat">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" name="updateCompany" class="btn btn-primary btn-block">Update Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- password ubah -->
                                <div class="tab-pane" id="password">
                                    <form method="post" class="form-horizontal">
                                        <input type="hidden" id="AdminID" name="AdminID" value="<?= $CompanyData[0]['AdminID']; ?>" class="form-control" required autocomplete="off">
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Old Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" id="OldPassword" name="OldPassword" class="form-control" required autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-3 col-form-label">New Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" id="NewPassword" name="NewPassword" class="form-control" required autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-3 col-form-label">Retype Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" id="RetypeNewPassword" name="RetypeNewPassword" class="form-control" required autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" name="updatePassword" class="btn btn-primary btn-block">Ubah Password</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
    $(".datetimepicker").each(function() {
        $(this).datetimepicker({
            timepicker: false,
            format: 'd-m-Y',
            validateOnBlur: true
        });
    });
</script>

<?php include '../Template/footer.php'; ?>