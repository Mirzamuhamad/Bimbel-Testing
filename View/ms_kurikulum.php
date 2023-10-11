<?php include '../Template/header.php'; ?>
<!-- Main Sidebar Container -->
<?php include '../Template/sidebar.php'; ?>
<?php
$Company = $_SESSION['masuk']["AdminID"];
$user = query("SELECT * FROM mskurikulum ORDER BY kurikulum DESC ");

$KurikulumErr = "";
$Kurikulum = "";

if (isset($_POST["saveKurikulum"])) {

  if (KurikulumAdd($_POST) > 0) {
    echo "<script>
              // alert('Register Berhasil, silahkan Login!');
              document.location.href='ms_kurikulum';
          </script>
          ";
  } else {
    echo mysqli_error($koneksi);
  }

  // if (empty($_POST["Kurikulum"])) {
  //   $KurikulumErr = "Kurikulum is required";
  // } else {
  //   $Kurikulum = htmlspecialchars($_POST["Kurikulum"]);
  //   // check if name only contains letters and whitespace
  //   if (!preg_match("/^[a-zA-Z ]*$/", $Kurikulum)) {
  //     $KurikulumErr = "Only letters and white space allowed";
  //   }
  // }
}

if (isset($_POST["editKurikulum"])) {

  if (EditKurikulum($_POST) > 0) {
    echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_kurikulum';
          </script>
          ";
  } else {
    echo mysqli_error($koneksi);
  }
}


if (isset($_POST["hapusKurikulum"])) {

  if (HapusKurikulum($_POST) > 0) {
    echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_kurikulum';
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
      <!-- <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Data Kurikulum</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Kurikulum</a></li>
            <li class="breadcrumb-item active">Data Kurikulum </li>
          </ol>
        </div>
      </div> -->
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Kurikulum Data</h3>
              <div class="row">
                <div class="col-12">
                  <!-- <input type="submit" value="Create new Porject" class="btn btn-primary btn-xs float-right"> -->
                  <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#myModalKurikulum"><i class="fas fa-plus"></i> &nbsp; Kurikulum</button>
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
                    <th>Kurikulum</th>
                    <th>Fg Active</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>

                  <?php $i = 1; ?>
                  <?php foreach ($user as $isi) : ?>

                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $isi['Kurikulum']; ?></td>
                      <td> <?= $isi["FgActive"]; ?> </td>
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <!-- <a class="btn btn-block btn-danger btn-xs" href="hapus_Employee.php?Kurikulum=<?= $isi["Kurikulum"]; ?>"  onclick=" return confirm('yakin akan di hapus?');"><i class="fas fa-trash-alt"></i> </a> -->
                          <a class="btn  btn-primary " data-toggle="modal" data-target="#EditKurikulum<?= $isi['Kurikulum']; ?>"><i class="fas fa-edit"></i> </a>
                          <a class="btn  btn-danger " data-toggle="modal" data-target="#hapusKurikulum<?= $isi['Kurikulum']; ?>"><i class="fas fa-trash-alt"></i> </a>

                        </div>
                      </td>
                    </tr>

                    <!-- modal hapus data -->
                    <div id="hapusKurikulum<?= $isi['Kurikulum'] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- konten modal Hapus-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Hapus Kurikulum</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- body modal -->
                          <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">

                              <?php
                              $id = $isi['Kurikulum'];
                              $query      = "SELECT * FROM mskurikulum WHERE Kurikulum = '$id' ";
                              $query1     = mysqli_query($koneksi, $query);
                              $Edit      = mysqli_fetch_array($query1);
                              ?>

                              <input type="hidden" name="Kurikulum" name="Kurikulum" readonly="readonly" value="<?= $Edit["Kurikulum"]; ?>">
                              <div class="form-group">
                                <label for="Name">Yakin akan hapus employee ini .?</label>
                                <input type="Text" id="Kurikulum" readonly="readonly" name="Kurikulum" required class="form-control" autocomplete="off" value="<?= $Edit["Kurikulum"]; ?>">
                              </div>

                          </div>
                          <!-- body modal finish -->

                          <!-- footer modal -->
                          <div class="modal-footer">
                            <button type="submit" name="hapusKurikulum" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> &nbsp; Yes </button>
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> &nbsp; No</button>
                          </div>

                          </form>
                        </div>
                      </div>
                    </div>



                    <!-- modal edit data -->
                    <div id="EditKurikulum<?= $isi['Kurikulum'] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-md">
                        <!-- konten modal-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Kurikulum</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- body modal -->
                          <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">

                              <?php
                              $id = $isi['Kurikulum'];
                              $id_menu    = $isi['Kurikulum'];
                              $query      = "SELECT * FROM mskurikulum WHERE Kurikulum = '$id' ";
                              $query1     = mysqli_query($koneksi, $query);
                              $Edit      = mysqli_fetch_array($query1);
                              ?>
                              <div class="row">
                                <div class="col-md-12">

                                  <input type="hidden" id="Kurikulum" name="Kurikulum" readonly="readonly" value="<?= $Edit["Kurikulum"]; ?>">
                                  <div class="form-group">
                                    <label for="Kurikulum">Kurikulum</label>
                                    <input type="Text" id="Kurikulum" name="Kurikulum" class="form-control" autocomplete="off" value="<?= $Edit["Kurikulum"]; ?>">
                                  </div>


                                  <div class="form-group">
                                    <label for="Gender">Fg Active</label>
                                    <select id="FgActive" name="FgActive" class="form-control custom-select">
                                      <option selected="<?= $Edit["FgActive"]; ?>"><?php if ($Edit["FgActive"] == 'Y') {  ?> Yes <?php } else { ?>No<?php } ?></option>
                                      <option value="Y">Yes</option>
                                      <option value="N">No</option>
                                    </select>
                                  </div>

                                  <input type="hidden" id="ModifiedBy" name="ModifiedBy" readonly="true" enabled="false" value="<?= $_SESSION['masuk']["AdminID"] ?>" name="Name" required class="form-control" autocomplete="off">



                                </div>
                              </div>
                          </div>
                          <!-- body modal finish -->

                          <!-- footer modal -->
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> Close</button>
                            <button type="submit" name="editKurikulum" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> Save Edit Kurikulum</button>

                          </div>

                          </form>
                        </div>
                      </div>
                    </div>


                    <?php $i++; ?>
                  <?php endforeach; ?>
                </tbody>
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
<div id="myModalKurikulum" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- konten modal-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Kurikulum</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data" id="quickForm">

          <div class="row">
            <div class="col-sm-12">

              <div class="form-group">
                <label for="Kurikulum">Kurikulum ID</label>
                <input type="Text" id="Kurikulum" name="Kurikulum" class="form-control" autocomplete="off">
              </div>


              <div class="form-group">
                <label for="FgActive">Fg Active</label>
                <select id="FgActive" name="FgActive" class="form-control custom-select">
                  <!-- <option selected="Y" disabled="">Select one</option> -->
                  <option value="Y">Yes</option>
                  <option value="N">No</option>
                </select>
              </div>


              <div class="form-group">
                <!-- <label for="EmpNumber">Company</label>
                <input type="Text" id="Name" readonly="true" enabled="false" value="<?= $_SESSION['masuk']["CompanyName"] ?>" name="Name" required class="form-control" autocomplete="off"> -->
                <input type="hidden" id="CreatedBy" name="CreatedBy" readonly="true" enabled="false" value="<?= $_SESSION['masuk']["AdminID"] ?>" name="Name" required class="form-control" autocomplete="off">
              </div>


            </div>


          </div>

      </div>
      <!-- body modal finish -->

      <!-- footer modal -->
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> Close</button>
        <button type="submit" name="saveKurikulum" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> Save New Kurikulum</button>

      </div>
      </form>
    </div>
  </div>
</div>
<!--  Koding Untuk membuat modal atau popup -->

<?php include '../Template/footer.php'; ?>
<script>
  $(function() {
    $.validator.setDefaults({
      submitHandler: function() {
        alert("Form successful submitted!");
      }
    });
    $('#quickForm').validate({
      rules: {
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 5
        },
        terms: {
          required: true
        },
        Kurikulum: {
          required: true
        },
      },
      messages: {
        email: {
          required: "Please enter a email address",
          email: "Please enter a vaild email address"
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
        Kurikulum: {
          required: "Please enter a kurikulum",
          minlength: "Your password must be at least 5 characters long"
        },
        terms: "Please accept our terms"
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>