<?php include '../Template/header.php'; ?>
<!-- Main Sidebar Container -->
<?php include '../Template/sidebar.php'; ?>
<?php
$Company = $_SESSION['masuk']["AdminID"];
$user = query("SELECT * FROM mskwalifikasi");

$Course = "";

if (isset($_POST["saveKwalifikasi"])) {

  if (KwalifikasiAdd($_POST) > 0) {
    echo "<script>
              // alert('Register Berhasil, silahkan Login!');
              document.location.href='ms_kwalifikasi';
          </script>
          ";
  } else {
    echo mysqli_error($koneksi);
  }
}

if (isset($_POST["EditKwalifikasi"])) {

  if (EditKwalifikasi($_POST) > 0) {
    echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_kwalifikasi';
          </script>
          ";
  } else {
    echo mysqli_error($koneksi);
  }
}

if (isset($_POST["hapusKwalifikasi"])) {

  if (HapusKwalifikasi($_POST) > 0) {
    echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_kwalifikasi';
          </script>
          ";
  } else {
    echo mysqli_error($koneksi);
  }
}

// $query = "SELECT max(EmpID) as maxKode FROM msKwalifikasi";
//     $hasil = mysqli_query($koneksi, $query);
//     $data  = mysqli_fetch_array($hasil);
//     $kodeMenu = substr($data["maxKode"],5,8)+1;
//     if ($data['maxKode'] = '') {
//       $EmpCode = "USR00001";

//     } else {
//        $char = "USR";
//       $kode = $char . sprintf("%05s", $kodeMenu);
//     }

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <!-- <div class="col-sm-6">
          <h4>Data Kwalifikasi</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Kwalifikasi</a></li>
            <li class="breadcrumb-item active">Kwalifikasi </li>
          </ol>
        </div> -->
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
              <h3 class="card-title">Kwalifikasi Data</h3>
              <div class="row">
                <div class="col-12">
                  <!-- <input type="submit" value="Create new Porject" class="btn btn-primary btn-xs float-right"> -->
                  <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#myModal"><i class="fas fa-user-plus"></i> Kwalifikasi</button>
                </div>
              </div>

            </div>
            <!-- code barang -->
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Teacher</th>
                    <th>Kurikulum</th>
                    <th>Course</th>
                    <th>Fg Active</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>

                  <?php $i = 1; ?>
                  <?php foreach ($user as $isi) : ?>



                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $isi['Teacher']; ?></td>
                      <td><?= $isi['Kurikulum']; ?></td>
                      <td> <?= $isi["Course"]; ?> </td>
                      <td> <?= $isi["FgActive"]; ?> </td>
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">

                          <a class="btn  btn-primary " data-toggle="modal" data-target="#EditKwalifikasi<?= $i; ?>"><i class="fas fa-edit"></i> </a>
                          <a class="btn  btn-danger " data-toggle="modal" data-target="#hapusKwalifikasi<?= $i; ?>"><i class="fas fa-trash-alt"></i> </a>

                        </div>
                      </td>
                    </tr>



                    <!-- modal hapus data -->
                    <div id="hapusKwalifikasi<?= $i; ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- konten modal Hapus-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Hapus Kwalifikasi</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- body modal -->
                          <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">

                              <?php
                              $Teacher = $isi['Teacher'];
                              $Course = $isi['Course'];
                              $Kurikulum = $isi['Kurikulum'];

                              $query = "SELECT * FROM mskwalifikasi WHERE Teacher= '$Teacher' AND Course = '$Course' AND Kurikulum = '$Kurikulum'";
                              $query1 = mysqli_query($koneksi, $query);
                              $Edit = mysqli_fetch_array($query1);
                              ?>

                              <input type="hidden" name="Teacher" readonly="readonly" value="<?= $Edit['Teacher']; ?>">
                              <input type="hidden" name="Kurikulum" readonly="readonly" value="<?= $Edit['Kurikulum']; ?>">
                              <input type="hidden" name="Course" readonly="readonly" value="<?= $Edit['Course']; ?>">
                              <div class="form-group">
                                <label for="Name">Yakin akan hapus Kwalifikasi ini .?</label>
                                <input type="Text" id="Name" readonly="readonly" name="EmpName" required class="form-control" autocomplete="off" value="<?= $Edit['Teacher']; ?>, <?= $Edit['Kurikulum']; ?>, <?= $Edit['Course']; ?>">
                              </div>

                          </div>
                          <!-- body modal finish -->

                          <!-- footer modal -->
                          <div class="modal-footer">
                            <button type="submit" name="hapusKwalifikasi" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> &nbsp; Yes </button>
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> &nbsp; No</button>
                          </div>

                          </form>
                        </div>
                      </div>
                    </div>


                    <!-- modal edit data -->
                    <div id="EditKwalifikasi<?= $i ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-md">
                        <!-- konten modal-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Kwalifikasi</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- body modal -->
                          <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">

                              <?php
                              $Teacher = $isi['Teacher'];
                              $Course = $isi['Course'];
                              $Kurikulum = $isi['Kurikulum'];

                              $query = "SELECT * FROM mskwalifikasi WHERE Teacher= '$Teacher' AND Course = '$Course' AND Kurikulum = '$Kurikulum'";
                              $query1 = mysqli_query($koneksi, $query);
                              $Edit = mysqli_fetch_array($query1);
                              ?>

                              <div class="row">

                                <div class="col-md-12">


                                  <div class="form-group">
                                    <label>Teacher</label>
                                    <input type="hidden" id="UpdatedBy" name="UpdatedBy" readonly="true" enabled="false" value="<?= $_SESSION['masuk']["AdminID"] ?>" required class="form-control" autocomplete="off">

                                    <select id="Teacher" name="Teacher" class="form-control select2" data-placeholder="Pilih Teacher" style="width: 100%;" required>
                                      <option selected="selected" value="<?= $Edit["Teacher"]; ?>"><?= $Edit["Teacher"]; ?></option>

                                      <?php
                                      $loginQuery = "SELECT UserName, UserLogin FROM mslogin WHERE UserType = 'Teacher' AND FgActive = 'Y'  ";
                                      $loginGetData = mysqli_query($koneksi, $loginQuery);
                                      while ($Login = mysqli_fetch_array($loginGetData)) {
                                      ?>
                                        <option value="<?= $Login["UserLogin"]; ?>"> <?= $Login["UserName"]; ?> </option>
                                      <?php } ?>

                                    </select>
                                  </div>


                                  <div class="form-group">
                                    <label>Course</label>
                                    <select id="Course" name="Course" class="form-control select2" data-placeholder="Plih Course" style="width: 100%;" required>
                                      <option selected="selected"><?= $Edit["Course"]; ?></option>
                                      <?php
                                      $CourseQuery = "SELECT CourseID, CourseName FROM mscourse WHERE FgActive = 'Y' ";
                                      $CourseGetData = mysqli_query($koneksi, $CourseQuery);
                                      while ($Course = mysqli_fetch_array($CourseGetData)) {
                                      ?>
                                        <option value="<?= $Course["CourseID"]; ?>"> <?= $Course["CourseName"]; ?> </option>
                                      <?php } ?>
                                    </select>
                                  </div>


                                  <div class="form-group">
                                    <label>Kurikulum</label>
                                    <select id="Kurikulum" name="Kurikulum" data-placeholder="Pilih Kurikulum" class="form-control select2" style="width: 100%;" required>
                                      <option selected="selected"><?= $Edit["Kurikulum"]; ?></option>
                                      <?php
                                      $KurikulumQuery = "SELECT Kurikulum FROM mskurikulum WHERE FgActive = 'Y' ";
                                      $KurikulumGetData = mysqli_query($koneksi, $KurikulumQuery);
                                      while ($Kurikulum = mysqli_fetch_array($KurikulumGetData)) {
                                      ?>
                                        <option value="<?= $Kurikulum["Kurikulum"]; ?>"> <?= $Kurikulum["Kurikulum"]; ?> </option>
                                      <?php } ?>
                                    </select>
                                  </div>


                                  <div class="form-group">
                                    <label for="FgActive">Fg Active</label>
                                    <select id="FgActive" name="FgActive" class="form-control custom-select">
                                      <option selected="<?= $Edit["FgActive"]; ?>"><?php if ($Edit["FgActive"] == 'Y') {  ?> Yes <?php } else { ?>No<?php } ?></option>
                                      <option value="Y">Yes</option>
                                      <option value="N">No</option>
                                    </select>
                                  </div>
                                </div>

                              </div>
                          </div>
                          <!-- body modal finish -->

                          <!-- footer modal -->
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> Close</button>
                            <button type="submit" name="EditKwalifikasi" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> Save Edit Kwalifikasi</button>

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
  <div class="modal-dialog modal-md">
    <!-- konten modal-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Kwalifikasi</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">

          <div class="row">
            <div class="col-md-12">

              <div class="form-group">
                <label>Teacher</label>
                <select id="Teacher" name="Teacher" class="form-control select2" data-placeholder="Pilih Teacher" style="width: 100%;" required>
                  <option selected="selected" value="" disabled="False">Pilih Teacher</option>
                  <?php
                  $loginQuery = "SELECT UserName, UserLogin FROM mslogin WHERE UserType = 'Teacher' AND FgActive = 'Y'  ";
                  $loginGetData = mysqli_query($koneksi, $loginQuery);
                  while ($Login = mysqli_fetch_array($loginGetData)) {
                  ?>
                    <option value="<?= $Login["UserLogin"]; ?>"> <?= $Login["UserName"]; ?> </option>
                  <?php } ?>
                </select>
              </div>


              <div class="form-group">
                <label>Course</label>
                <select id="Course" name="Course[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Course" style="width: 100%;" Required>
                  <?php
                  $CourseQuery = "SELECT CourseID, CourseName FROM mscourse WHERE FgActive = 'Y' ";
                  $CourseGetData = mysqli_query($koneksi, $CourseQuery);
                  while ($Course = mysqli_fetch_array($CourseGetData)) {
                  ?>
                    <option value="<?= $Course["CourseID"]; ?>"> <?= $Course["CourseName"]; ?> </option>
                  <?php } ?>
                </select>
              </div>


              <div class="form-group">
                <label>Kurikulum</label>
                <select id="Kurikulum" name="Kurikulum" data-placeholder="Pilih Kurikulum" class="form-control select2" style="width: 100%;" Required>
                  <option selected="selected" value="" disabled="False">Pilih Kurikulum</option>
                  <?php
                  $KurikulumQuery = "SELECT Kurikulum FROM mskurikulum WHERE FgActive = 'Y' ";
                  $KurikulumGetData = mysqli_query($koneksi, $KurikulumQuery);
                  while ($Kurikulum = mysqli_fetch_array($KurikulumGetData)) {
                  ?>
                    <option value="<?= $Kurikulum["Kurikulum"]; ?>"> <?= $Kurikulum["Kurikulum"]; ?> </option>
                  <?php } ?>
                </select>
              </div>


              <div class="form-group">
                <label for="FgActive">Fg Active</label>
                <select id="FgActive" name="FgActive" class="form-control custom-select">
                  <option disabled="">Select one</option>
                  <option selected="True" value="Y">Yes</option>
                  <option value="N">No</option>
                </select>
              </div>
            </div>
          </div>

      </div>
      <!-- body modal finish -->

      <!-- footer modal -->
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> Close</button>
        <button type="submit" name="saveKwalifikasi" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> Save New Kwalifikasi</button>

      </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $("#Teacher").select2({
      // theme: 'bootstrap4',
      placeholder: "Please Select"
    });

    $("#Course").select2({
      // theme: 'bootstrap4',
      placeholder: "Please Select"
    });

    $("#Kurikulum").select2({
      // theme: 'bootstrap4',
      placeholder: "Please Select"
    });
  });
</script>
<!--  Koding Untuk membuat modal atau popup -->

<?php include '../Template/footer.php'; ?>