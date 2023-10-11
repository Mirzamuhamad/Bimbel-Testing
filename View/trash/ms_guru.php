<?php include '../Template/header.php'; ?>
<!-- Main Sidebar Container -->
<?php include '../Template/sidebar.php'; ?>
<?php
$Company = $_SESSION['masuk']["AdminID"];
$user = query("SELECT * FROM mslogin WHERE UserType = 'Teacher'");

if (isset($_POST["saveGuru"])) {

    if (GuruAdd($_POST) > 0) {
        echo "<script>
              // alert('Register Berhasil, silahkan Login!');
              document.location.href='ms_guru';
          </script>
          ";
    } else {
        echo mysqli_error($koneksi);
    }
}

if (isset($_POST["Editguru"])) {

    if (EditGuru($_POST) > 0) {
        echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_guru';
          </script>
          ";
    } else {
        echo mysqli_error($koneksi);
    }
}

if (isset($_POST["hapusguru"])) {

    if (HapusGuru($_POST) > 0) {
        echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_guru';
          </script>
          ";
    } else {
        echo mysqli_error($koneksi);
    }
}

// $query = "SELECT max(EmpID) as maxKode FROM msguru";
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

<!-- <script>
    $(function() {
        $("#ExamDateStart").datepicker({
            dateFormat: "dd/mm/yy",
            dateMonth: true,
            dateYear: true,
        });
    });
</script> -->

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
                            <h3 class="card-title">Teacher Data</h3>
                            <div class="row">
                                <div class="col-12">
                                    <!-- <input type="submit" value="Create new Porject" class="btn btn-primary btn-xs float-right"> -->
                                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#myModal"><i class="fas fa-user-plus"></i> Teacher</button>
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
                                        <th>User Login</th>
                                        <th>User Name</th>
                                        <th>Gender</th>
                                        <th>BirthDate</th>
                                        <th>Email</th>
                                        <th>Handphone</th>
                                        <th>AddressHome</th>
                                        <th>SchoolName</th>
                                        <th>UrlPhoto</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1; ?>
                                    <?php foreach ($user as $isi) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $isi['UserLogin']; ?></td>
                                            <td><?= $isi['UserName']; ?></td>
                                            <td> <?= $isi["Gender"]; ?> </td>
                                            <td> <?= date('d-m-Y', strtotime($isi['BirthDate'])); ?> </td>
                                            <td> <?= $isi["Email"]; ?> </td>
                                            <td> <?= $isi["Handphone"]; ?> </td>
                                            <td> <?= $isi["AddressHome"]; ?> </td>
                                            <td> <?= $isi['SchoolName']; ?></td>
                                            <td> <?= $isi['UrlPhoto']; ?></td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">

                                                    <a class="btn  btn-primary " data-toggle="modal" data-target="#EditGuru<?= $i; ?>"><i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn  btn-danger " data-toggle="modal" data-target="#hapusGuru<?= $i; ?>"><i class="fas fa-trash-alt"></i> </a>

                                                </div>
                                            </td>
                                        </tr>


                                        <!-- modal hapus data -->
                                        <div id="hapusGuru<?= $i; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- konten modal Hapus-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Teacher</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- body modal -->
                                                    <div class="modal-body">
                                                        <form action="" method="post" enctype="multipart/form-data">

                                                            <?php
                                                            $UserLogin = $isi['UserLogin'];

                                                            $query = "SELECT * WHERE mslogin= '$UserLogin'";
                                                            $query1 = mysqli_query($koneksi, $query);
                                                            $Edit = mysqli_fetch_array($query1);
                                                            ?>

                                                            <input type="hidden" name="UserLogin" readonly="readonly" value="<?= $Edit['UserLogin']; ?>">
                                                            <div class="form-group">
                                                                <label for="Name">Yakin akan hapus Teacher ini .?</label>
                                                                <input type="Text" id="UserName" readonly="readonly" name="UserName" required class="form-control" autocomplete="off" value="<?= $UserName; ?>">
                                                            </div>

                                                    </div>
                                                    <!-- body modal finish -->

                                                    <!-- footer modal -->
                                                    <div class="modal-footer">
                                                        <button type="submit" name="hapusGuru" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i>
                                                            &nbsp; Yes </button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> &nbsp;
                                                            No</button>
                                                    </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- modal edit data -->
                                        <div id="EditGuru<?= $i ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-XL">
                                                <!-- konten modal-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Teacher</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- body modal -->
                                                    <div class="modal-body">
                                                        <form action="" method="post" enctype="multipart/form-data">

                                                            <?php
                                                            $UserLogin = $isi['UserLogin'];
                                                            $query = "SELECT* mslogin FROM msolimpiade 
                                                             WHERE UserLogin= '$UserLogin' ";
                                                            $query1 = mysqli_query($koneksi, $query);
                                                            $Edit = mysqli_fetch_array($query1);
                                                            ?>

                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="UserLogin">User Login</label>
                                                                        <input type="hidden" id="UpdatedBy" name="UpdatedBy" readonly="true" enabled="false" value="<?= $_SESSION['masuk']["AdminID"] ?>" required class="form-control" autocomplete="off">

                                                                        <input type="Text" id="UserLogin" name="UserLogin" readonly required class="form-control" autocomplete="off" value="<?= $Edit["UserLogin"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UserName">User Name</label>
                                                                        <input type="Text" id="UserName" name="UserName" required class="form-control" autocomplete="off" value="<?= $Edit["UserName"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="Gender">Gender
                                                                            Start</label>
                                                                        <input type="Text" id="Gender" name="Gender" required class="form-control" autocomplete="off" value="<?= $Edit["Gender"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="BirthDate">BirthDate</label>
                                                                        <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                                                            <input type="Text" id="BirthDate" name="BirthDate" required class="form-control" data-target="#reservationdate3" value="<?= date('d-m-Y', strtotime($Edit['BirthDate'])); ?>">
                                                                            <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="Email">Email
                                                                            Start</label>
                                                                        <input type="Text" id="Email" name="Email" required class="form-control" autocomplete="off" value="<?= $Edit["Email"]; ?>">
                                                                    </div>

                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="Handphone">Handphone</label>
                                                                        <input type="Text" id="Handphone" name="Handphone" required class="form-control" autocomplete="off" value="<?= $Edit["Handphone"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="AddressHome">AddressHome</label>
                                                                        <input type="Text" id="AddressHome" name="AddressHome" required class="form-control" autocomplete="off" value="<?= $Edit["AddressHome"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="SchoolName">SchoolName</label>
                                                                        <input type="Text" id="SchoolName" name="SchoolName" required class="form-control" autocomplete="off" value="<?= $Edit["SchoolName"]; ?>">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="UrlPhoto">Url Photo</label>
                                                                        <input type="Text" id="UrlPhoto" name="UrlPhoto" required class="form-control" autocomplete="off" value="<?= $Edit["UrlPhoto"]; ?>">
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
                                                                <div class="col-sm-4">

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
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i>
                                                            Close</button>
                                                        <button type="submit" name="EditGuru" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i>
                                                            Save Edit Teacher</button>
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
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- konten modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Guru</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- body modal -->
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="OlimpiadeID">Olimpiade ID</label>
                                <input type="Text" id="OlimpiadeID" name="OlimpiadeID" required class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="OlimpiadeName">Olimpiade Name</label>
                                <input type="Text" id="OlimpiadeName" name="OlimpiadeName" required class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="EligibleClassStart">Eligible Class
                                    Start</label>
                                <input type="Text" id="EligibleClassStart" name="EligibleClassStart" required class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="EligibleClassEnd">Eligible Class
                                    End</label>
                                <input type="Text" id="EligibleClassEnd" name="EligibleClassEnd" required class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="EligibleAgeStart">Eligible Age
                                    Start</label>
                                <input type="Text" id="EligibleAgeStart" name="EligibleAgeStart" required class="form-control" autocomplete="off">
                            </div>

                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="EligibleAgeEnd">Eligible Age End</label>
                                <input type="Text" id="EligibleAgeEnd" name="EligibleAgeEnd" required class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="ExamDateStart">Exam Date Start</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="Text" id="ExamDateStart" name="ExamDateStart" data-placeholder="DD/MM/YYYY" required class="form-control" data-target="#reservationdate">
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ExamDateEnd">Exam Date End</label>
                                <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                    <input type="Text" id="ExamDateEnd" name="ExamDateEnd" required class="form-control" data-target="#reservationdate1">
                                    <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ExamDateEnd">Registration
                                    Date</label>
                                <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                    <input type="Text" id="RegistrationDate" name="RegistrationDate" required class="form-control" data-target="#reservationdate2">
                                    <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="UrlImage">Url Image</label>
                                <input type="Text" id="UrlImage" name="UrlImage" required class="form-control" autocomplete="off">
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="UrlImage2">Url Image 2</label>
                                <input type="Text" id="UrlImage2" name="UrlImage2" required class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="Price">Price</label>
                                <input type="Text" id="Price" name="Price" required class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Venue</label>
                                <input type="hidden" id="CreatedBy" name="CreatedBy" readonly="true" enabled="false" value="<?= $_SESSION['masuk']["AdminID"] ?>" required class="form-control" autocomplete="off">

                                <select id="Venue" name="Venue" class="form-control select2" data-placeholder="Pilih Venue" style="width: 100%;" required>
                                    <option selected="selected" value="" disabled="False">Pilih Venue</option>


                                </select>
                            </div>


                            <div class="form-group">
                                <label>Organizer</label>
                                <select id="Organizer" name="Organizer" class="form-control select2" data-placeholder="Pilih Organizer" style="width: 100%;" required>
                                    <option selected="selected" value="" disabled="False">Pilih Organizer</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="FgActive">Fg Active</label>
                                <select id="FgActive" name="FgActive" class="form-control custom-select">
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
                <button type="submit" name="saveOlimpiade" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> Save New Olimpiade</button>

            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#Teacher").select2({
            theme: 'bootstrap4',
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

<?php include '../Template/footer.php'; ?>