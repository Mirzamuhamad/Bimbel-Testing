<?php include '../Template/header.php'; ?>
<!-- Main Sidebar Container -->
<?php include '../Template/sidebar.php'; ?>
<?php
$Company = $_SESSION['masuk']["CompanyCode"];
$user = query("SELECT * FROM msemployee WHERE CompanyCode = '$Company' ORDER BY Emp_Number DESC ");

if (isset($_POST["saveuser"])) {

  if (useremployee($_POST) > 0) {
    echo "<script>
              // alert('Register Berhasil, silahkan Login!');
              document.location.href='data_Employee';
          </script>
          ";
  } else {
    echo mysqli_error($koneksi);
  }
}

if (isset($_POST["editUser"])) {

  if (EditEmployee($_POST) > 0) {
    echo "<script>
              // alert('Edit secess!');
              document.location.href='data_Employee';
          </script>
          ";
  } else {
    echo mysqli_error($koneksi);
  }
}


if (isset($_POST["hapusUser"])) {

  if (HapusEmployee($_POST) > 0) {
    echo "<script>
              // alert('Edit secess!');
              document.location.href='data_Employee';
          </script>
          ";
  } else {
    echo mysqli_error($koneksi);
  }
}


// $query = "SELECT max(EmpID) as maxKode FROM msemployee";
// 	$hasil = mysqli_query($koneksi, $query);
// 	$data  = mysqli_fetch_array($hasil);
// 	$kodeMenu = substr($data["maxKode"],5,8)+1;
// 	if ($data['maxKode'] = '') {
// 	  $EmpCode = "USR00001"; 

// 	} else {
// 	   $char = "USR";
// 	  $kode = $char . sprintf("%05s", $kodeMenu);
// 	}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Data Employee</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Employee</a></li>
            <li class="breadcrumb-item active">Employee </li>
          </ol>
        </div>
      </div>
    </div> <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Employee Data</h3>
              <div class="row">
                <div class="col-12">
                  <!-- <input type="submit" value="Create new Porject" class="btn btn-primary btn-xs float-right"> -->
                  <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#myModal"><i class="fas fa-user-plus"></i> Employee</button>
                </div>
              </div>

            </div>
            <!-- code barang -->
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>EmpID</th>
                    <th>Image</th>
                    <th>Company</th>
                    <th>Telp</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>TTL</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>

                  <?php $i = 1; ?>
                  <?php foreach ($user as $isi) : ?>

                    <tr>
                      <td><?= $isi['Emp_Name']; ?></td>
                      <td><?= $isi['Emp_Number']; ?></td>
                      <td><img src="../Employee/<?= $isi["fotoProfil"]; ?>" width="50" height="50" class="img-circle elevation-10" alt="Image"></td>
                      <td> <?= $isi["CompanyCode"]; ?></td>
                      <td> <?= $isi["Telp"]; ?> </td>
                      <td> <?= $isi["email"]; ?> </td>
                      <td> <?= $isi["Gender"]; ?> </td>
                      <td> <?= date('d M Y', strtotime($isi['Tgl_Lahir'])); ?> </td>
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <!-- <a class="btn btn-block btn-danger btn-xs" href="hapus_Employee.php?EmpID=<?= $isi["EmpID"]; ?>"  onclick=" return confirm('yakin akan di hapus?');"><i class="fas fa-trash-alt"></i> </a> -->
                          <a class="btn  btn-primary " data-toggle="modal" data-target="#EditUser<?= $isi['EmpID']; ?>"><i class="fas fa-edit"></i> </a>
                          <a class="btn  btn-danger " data-toggle="modal" data-target="#hapusUser<?= $isi['EmpID']; ?>"><i class="fas fa-trash-alt"></i> </a>
                        </div>
                      </td>
                    </tr>
                    
                    <!-- modal hapus data -->
                    <div id="hapusUser<?= $isi['EmpID'] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- konten modal Hapus-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Hapus Employee</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- body modal -->
                          <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">

                              <?php
                              $id = $isi['EmpID'];
                              $id_menu    = $isi['EmpID'];
                              $query      = "SELECT * FROM msemployee WHERE EmpID = '$id' ";
                              $query1     = mysqli_query($koneksi, $query);
                              $Edit      = mysqli_fetch_array($query1);
                              ?>

                              <input type="hidden" name="EmpCode" name="EmpCode" readonly="readonly" value="<?= $Edit["EmpID"]; ?>">
                              <div class="form-group">
                                <label for="Name">Yakin akan hapus employee ini .?</label>
                                <input type="Text" id="Name" readonly="readonly" name="EmpName" required class="form-control" autocomplete="off" value="<?= $Edit["Emp_Name"]; ?>">
                              </div>

                          </div>
                          <!-- body modal finish -->

                          <!-- footer modal -->
                          <div class="modal-footer">
                            <button type="submit" name="hapusUser" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> &nbsp; Yes </button>
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> &nbsp; No</button>
                          </div>

                          </form>
                        </div>
                      </div>
                    </div>


                    
                    <!-- modal edit data -->
                    <div id="EditUser<?= $isi['EmpID'] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-xl">
                        <!-- konten modal-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Employee</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- body modal -->
                          <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">

                              <?php
                              $id = $isi['EmpID'];
                              $id_menu    = $isi['EmpID'];
                              $query      = "SELECT * FROM msemployee WHERE EmpID = '$id' ";
                              $query1     = mysqli_query($koneksi, $query);
                              $Edit      = mysqli_fetch_array($query1);
                              ?>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="hidden" name="EmpCode" name="EmpCode" readonly="readonly" value="<?= $Edit["EmpID"]; ?>">
                                  <div class="form-group">
                                    <label for="Name">Employe Name</label>
                                    <input type="Text" id="Name" name="EmpName" required class="form-control" autocomplete="off" value="<?= $Edit["Emp_Name"]; ?>">
                                  </div>

                                  <div class="form-group">
                                    <label for="EmpNumber">Employe Number</label>
                                    <input type="Text" id="EmpNumber" name="EmpNumber" required class="form-control" autocomplete="off" value="<?= $Edit["Emp_Number"]; ?>">
                                  </div>

                                  <div class="form-group">
                                    <label for="Telp">Phone</label>
                                    <input type="text" id="Telp" name="Telp" maxlength="13" required class="form-control" inputmode="numeric" value="<?= $Edit["Telp"]; ?>">
                                  </div>

                                  <div class="form-group">
                                    <label for="Imei">Imei</label>
                                    <input type="text" id="Imei" name="Imei" class="form-control" autocomplete="off" value="<?= $Edit["Imei"]; ?>">
                                  </div>

                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="Email" id="Email" name="Email" required class="form-control" autocomplete="off" value="<?= $Edit["email"]; ?>">
                                  </div>

                                  <div class="form-group ">
                                    <label for="Tgl_Lahir">Tanggal Lahir</label>
                                    <input type="text" id="Tgl_Lahir" name="Tgl_Lahir" required class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" inputmode="numeric" autocomplete="off" value=" <?= $Edit["Tgl_Lahir"]; ?>">
                                  </div>

                                  <div class="form-group">
                                    <label for="Gender">Gender</label>
                                    <select id="Gender" name="Gender" class="form-control custom-select">
                                      <option selected=""><?= $Edit["Gender"]; ?></option>
                                      <option>Laki - Laki</option>
                                      <option>Perempuan</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <!-- body modal finish -->

                          <!-- footer modal -->
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> Close</button>
                            <button type="submit" name="editUser" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> Save Edit Employee</button>

                          </div>

                          </form>
                        </div>
                      </div>
                    </div>

                    <?php $i++; ?>
                  <?php endforeach; ?>
                </tbody>
                <!-- <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot> -->
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content -->

<!-- modal add data -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xl">
    <!-- konten modal-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Employee</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="Name">Employe Name</label>
                <input type="Text" id="Name" name="EmpName" required class="form-control" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="EmpNumber">Employe Number</label>
                <input type="Text" id="EmpNumber" name="EmpNumber" required class="form-control" autocomplete="off">
              </div>


              <div class="form-group">
                <label for="EmpNumber">Company</label>
                <input type="Text" id="Name" readonly="true" enabled="false" value="<?= $_SESSION['masuk']["CompanyName"] ?>" name="Name" required class="form-control" autocomplete="off">
                <input type="hidden" id="CompanyCode" name="CompanyCode" readonly="true" enabled="false" value="<?= $_SESSION['masuk']["CompanyCode"] ?>" name="Name" required class="form-control" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="Telp">Phone</label>
                <input type="number" id="Telp" name="Telp" required class="form-control" autocomplete="off">
              </div>
            </div>

            <div class="col-sm-6">


              <div class="form-group">
                <label for="Email">Email</label>
                <input type="Email" id="Email" name="Email" required class="form-control" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="Tgl_Lahir">Tanggal Lahir</label>
                <input type="date" id="Tgl_Lahir" name="Tgl_Lahir" required class="form-control" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="Gender">Gender</label>
                <select id="Gender" name="Gender" class="form-control custom-select">
                  <option selected="" disabled="">Select one</option>
                  <option>Laki - Laki</option>
                  <option>Perempuan</option>
                </select>
              </div>
            </div>
          </div>

      </div>
      <!-- body modal finish -->

      <!-- footer modal -->
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> Close</button>
        <button type="submit" name="saveuser" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> Save New Employee</button>

      </div>
      </form>
    </div>
  </div>
</div>
<!--  Koding Untuk membuat modal atau popup -->

<?php include '../Template/footer.php'; ?> 