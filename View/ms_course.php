<?php include '../Template/header.php'; ?>
<!-- Main Sidebar Container -->
<?php include '../Template/sidebar.php'; ?>
<?php
$Company = $_SESSION['masuk']["AdminID"];
$user = query("SELECT * FROM mscourse ORDER BY CourseID DESC ");

if (isset($_POST["saveCourse"])) {

  if (CourseAdd($_POST) > 0) {
    echo "<script>
              // alert('Register Berhasil, silahkan Login!');
              document.location.href='ms_course';
          </script>
          ";
  } else {
    echo mysqli_error($koneksi);
  }
}

if (isset($_POST["editCourse"])) {

  if (EditCourse($_POST) > 0) {
    echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_course';
          </script>
          ";
  } else {
    echo mysqli_error($koneksi);
  }
}


if (isset($_POST["hapusCourse"])) {

  if (HapusCourse($_POST) > 0) {
    echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_course';
          </script>
          ";
  } else {
    echo mysqli_error($koneksi);
  }
}


// $query = "SELECT max(CourseID) as maxKode FROM msCourse";
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
      <!-- <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Data Course</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Course</a></li>
            <li class="breadcrumb-item active">Course </li>
          </ol>
        </div>
      </div> -->
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
              <h3 class="card-title">Course Data</h3>
              <div class="row">
                <div class="col-12">
                  <!-- <input type="submit" value="Create new Porject" class="btn btn-primary btn-xs float-right"> -->
                  <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#myModalCourse"><i class="fas fa-plus"></i> &nbsp; Course</button>
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
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Url Image</th>
                    <th>Fg Active</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>

                  <?php $i = 1; ?>
                  <?php foreach ($user as $isi) : ?>

                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $isi['CourseID']; ?></td>
                      <td><?= $isi['CourseName']; ?></td>
                      <!-- <td><img src="../Course/<?= $isi["fotoProfil"]; ?>" width="50" height="50" class="img-circle elevation-10" alt="Image"></td> -->
                      <!-- <td> <?= $isi["UrlImage"]; ?></td> -->
                      <td class="text-center py-0 align-middle">
                        <?php
                        if ($isi["UrlImage"] == null || $isi["UrlImage"] == "") {
                        ?>
                          <img src="../Assets/Logo/noimage.png" width="25" class="img-circle elevation-1" alt="User Image">
                        <?php } else { ?>
                          <a class="btn" data-toggle="modal" data-target="#Preview<?= $isi['CourseID']; ?>">
                            <img src="../image/Course/<?= $isi["UrlImage"]; ?>" width="30" height="30" class="img-circle" alt="User Image">
                          </a>
                        <?php } ?>
                      </td>
                      <td> <?= $isi["FgActive"]; ?> </td>
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <!-- <a class="btn btn-block btn-danger btn-xs" href="hapus_Course.php?CourseID=<?= $isi["CourseID"]; ?>"  onclick=" return confirm('yakin akan di hapus?');"><i class="fas fa-trash-alt"></i> </a> -->
                          <a class="btn  btn-primary " data-toggle="modal" data-target="#EditCourse<?= $isi['CourseID']; ?>"><i class="fas fa-edit"></i> </a>
                          <a class="btn  btn-danger " data-toggle="modal" data-target="#hapusCourse<?= $isi['CourseID']; ?>"><i class="fas fa-trash-alt"></i> </a>
                        </div>
                      </td>
                    </tr>

                    <!-- modal hapus data -->
                    <div id="hapusCourse<?= $isi['CourseID'] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- konten modal Hapus-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Hapus Course</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- body modal -->
                          <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">

                              <?php
                              $id = $isi['CourseID'];
                              $query      = "SELECT * FROM mscourse WHERE CourseID = '$id' ";
                              $query1     = mysqli_query($koneksi, $query);
                              $Edit      = mysqli_fetch_array($query1);
                              ?>

                              <input type="hidden" name="CourseID" name="CourseID" readonly="readonly" value="<?= $Edit["CourseID"]; ?>">
                              <div class="form-group">
                                <label for="Name">Yakin akan hapus Course ini .?</label>
                                <input type="Text" id="CourseName" readonly="readonly" name="CourseName" required class="form-control" autocomplete="off" value="<?= $Edit["CourseName"]; ?>">
                              </div>

                          </div>
                          <!-- body modal finish -->

                          <!-- footer modal -->
                          <div class="modal-footer">
                            <button type="submit" name="hapusCourse" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> &nbsp; Yes </button>
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> &nbsp; No</button>
                          </div>

                          </form>
                        </div>
                      </div>
                    </div>

                    <!-- modal edit data -->
                    <div id="EditCourse<?= $isi['CourseID'] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-md">
                        <!-- konten modal-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Course</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- body modal -->
                          <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">

                              <?php
                              $id = $isi['CourseID'];
                              $id_menu    = $isi['CourseID'];
                              $query      = "SELECT * FROM msCourse WHERE CourseID = '$id' ";
                              $query1     = mysqli_query($koneksi, $query);
                              $Edit      = mysqli_fetch_array($query1);
                              ?>
                              <div class="row">
                                <div class="col-md-12">

                                  <input type="hidden" id="CourseID" name="CourseID" readonly="readonly" value="<?= $Edit["CourseID"]; ?>">
                                  <div class="form-group">
                                    <label for="CourseName">Course Name</label>
                                    <input type="Text" id="CourseName" name="CourseName" required class="form-control" autocomplete="off" value="<?= $Edit["CourseName"]; ?>">
                                  </div>

                                  <!-- <div class="form-group">
                                    <label for="UrlImage">Url Image</label>
                                    <input type="Text" id="UrlImage" name="UrlImage" required class="form-control" autocomplete="off" value="<?= $Edit["UrlImage"]; ?>">
                                  </div> -->

                                  <div class="form-group">
                                    <label for="UrlImageAdd">Url Image</label>
                                    <div class="custom-file">
                                      <input id="UrlImageEdit<?= $id ?>" class="form-control custom-file-input" type="file" name="gambar" onchange="PreviewImageEdit(<?= $id ?>);" />
                                      <label class="custom-file-label" for="gambar"><?= $Edit["UrlImage"]; ?></label>
                                    </div>
                                  </div>
                                  <!-- <div class="form-group">
                                    <p>Preview</p>
                                    <img src="../Assets/logo/noimage.png" class="profile-user-img  thumbnail form-control" id="UrlPreviewEdit<?= $id ?>" style="width: 150px; height: 150px; border-radius: 5px;" />
                                  </div> -->


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
                            <button type="submit" name="editCourse" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> Save Edit Course</button>

                          </div>

                          </form>
                        </div>
                      </div>
                    </div>

                    <!-- modal edit data -->
                    <div id="Preview<?= $isi['CourseID']; ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-md">
                        <!-- konten modal-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Preview <b><?= $isi['CourseID']; ?></b></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- body modal -->
                          <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-md-1"></div>
                                      <div class="col-md-10"><img class="rounded float-left img-fluid max-width: 100%" src="../image/Course/<?= $isi['UrlImage']; ?>" alt=""></div>
                                    </div>
                                  </div>
                                  <input type="hidden" id="ModifiedBy" name="ModifiedBy" readonly="true" enabled="false" value="<?= $_SESSION['masuk']["AdminID"] ?>" name="Name" required class="form-control" autocomplete="off">



                                </div>
                              </div>
                          </div>
                          <!-- body modal finish -->

                          <!-- footer modal -->
                          <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> Close </button>

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
<div id="myModalCourse" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- konten modal-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Course</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form id="quickForm" action="" method="post" enctype="multipart/form-data">

          <div class="row">
            <div class="col-sm-12">

              <div class="form-group">
                <label for="CourseID">Course ID</label>
                <input type="Text" id="CourseID" name="CourseID" Required class="form-control" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="Course">Course Name</label>
                <input type="Text" id="Course" name="CourseName" Required class="form-control" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="UrlImageAdd">Url Image</label>
                <div class="custom-file">
                  <input id="UrlImageAdd" class="form-control custom-file-input" type="file" name="gambar" onchange="PreviewImageAdd();" />
                  <label class="custom-file-label" for="gambar">Choose file</label>
                </div>
              </div>
              <!-- <div class="form-group">
                <p>Preview</p>
                <img src="../Assets/logo/noimage.png" class="profile-user-img  thumbnail form-control" id="UrlPreviewAdd" style="width: 150px; height: 150px; border-radius: 5px;" />
              </div> -->

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
        <button type="submit" name="saveCourse" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> Save New Course</button>

      </div>
      </form>
    </div>
  </div>
</div>
<!--  Koding Untuk membuat modal atau popup -->

<?php include '../Template/footer.php'; ?>

<!-- <script>
  $(function() {
    $.validator.setDefaults({
      submitHandler: function() {
        alert("Form successful submitted !");
      }
    });
    $('#quickForm').validate({
      rules: {
        CourseID: {
          required: true
        },
        CourseName: {
          required: true
        },
        // UrlImageAdd: {
        //   required: true
        // },
      },
      messages: {
        CourseID: {
          required: "Please enter a Course ID "
        },
        CourseName: {
          required: "Please provide a Course Name"
        },
        // UrlImageAdd: {
        //   required: "Please enter a Url Image"
        // }
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
</script> -->