<?php include '../Template/header.php'; ?>
<!-- Main Sidebar Container -->
<?php include '../Template/sidebar.php'; ?>
<?php
$Company = $_SESSION['masuk']["AdminID"];
$user = query("SELECT msolimpiade.* FROM msolimpiade");

if (isset($_POST["saveOlimpiade"])) {

    if (OlimpiadeAdd($_POST) > 0) {
        echo "<script>
              // alert('Register Berhasil, silahkan Login!');
              document.location.href='ms_olimpiade';
          </script>
          ";
    } else {
        echo mysqli_error($koneksi);
    }
}

if (isset($_POST["EditOlimpiade"])) {

    if (EditOlimpiade($_POST) > 0) {
        echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_olimpiade';
          </script>
          ";
    } else {
        echo mysqli_error($koneksi);
    }
}

if (isset($_POST["hapusOlimpiade"])) {

    if (HapusOlimpiade($_POST) > 0) {
        echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_olimpiade';
          </script>
          ";
    } else {
        echo mysqli_error($koneksi);
    }
}

// $query = "SELECT max(EmpID) as maxKode FROM msolimpiade";
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
                            <h3 class="card-title">Olimpiade Data</h3>
                            <div class="row">
                                <div class="col-12">
                                    <!-- <input type="submit" value="Create new Porject" class="btn btn-primary btn-xs float-right"> -->
                                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#myModal"><i class="fas fa-user-plus"></i> Olimpiade</button>
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
                                        <th>Olimpiade ID</th>
                                        <th>Olimpiade Name</th>
                                        <th>Eligible Class Start</th>
                                        <th>Eligible Class End</th>
                                        <th>Eligible Age Start</th>
                                        <th>Eligible Age End</th>
                                        <th>Exam Date Start</th>
                                        <th>Exam Date End</th>
                                        <th>Registration Date</th>
                                        <th>Url Image</th>
                                        <th>Url Image 2</th>
                                        <th>Price</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1; ?>
                                    <?php foreach ($user as $isi) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $isi['OlimpiadeID']; ?></td>
                                            <td><?= $isi['OlimpiadeName']; ?></td>
                                            <td> <?= $isi["EligibleClassStart"]; ?> </td>
                                            <td> <?= $isi["EligibleClassEnd"]; ?> </td>
                                            <td> <?= $isi["EligibleAgeStart"]; ?> </td>
                                            <td> <?= $isi["EligibleAgeEnd"]; ?> </td>
                                            <td> <?= date('d-m-Y', strtotime($isi['ExamDateStart'])); ?> </td>
                                            <td> <?= date('d-m-Y', strtotime($isi['ExamDateEnd'])); ?></td>
                                            <td> <?= date('d-m-Y', strtotime($isi['RegistrationDate'])); ?></td>
                                            <td class="text-center py-0 align-middle">
                                                <?php
                                                if ($isi["UrlImage"] == null || $isi["UrlImage"] == "") {
                                                ?>
                                                    <img src="../Assets/Logo/noimage.png" width="25" class="img-circle elevation-1" alt="User Image">
                                                <?php } else { ?>
                                                    <a class="btn" data-toggle="modal" data-target="#Preview<?= $i; ?>">
                                                        <img src="../image/Olimpiade/<?= $isi["UrlImage"]; ?>" width="30" height="30" class="img-circle" alt="User Image">
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center py-0 align-middle">
                                                <?php
                                                if ($isi["UrlImage2"] == null || $isi["UrlImage2"] == "") {
                                                ?>
                                                    <img src="../Assets/Logo/noimage.png" width="25" class="img-circle elevation-1" alt="User Image">
                                                <?php } else { ?>
                                                    <a class="btn" data-toggle="modal" data-target="#Preview2<?= $i; ?>">
                                                        <img src="../image/Olimpiade/<?= $isi["UrlImage2"]; ?>" width="30" height="30" class="img-circle" alt="User Image">
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <td> <?= $isi["Price"]; ?> </td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">

                                                    <a class="btn  btn-primary " data-toggle="modal" data-target="#EditOlimpiade<?= $i; ?>"><i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn  btn-danger " data-toggle="modal" data-target="#hapusOlimpiade<?= $i; ?>"><i class="fas fa-trash-alt"></i> </a>

                                                </div>
                                            </td>
                                        </tr>


                                        <!-- modal hapus data -->
                                        <div id="hapusOlimpiade<?= $i; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- konten modal Hapus-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Olimpiade</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- body modal -->
                                                    <div class="modal-body">
                                                        <form action="" method="post" enctype="multipart/form-data">

                                                            <?php
                                                            $OlimpiadeID = $isi['OlimpiadeID'];

                                                            $query = "SELECT msolimpiade.* ,msvenue.VenueName AS VenueName FROM msolimpiade JOIN msvenue ON msvenue.VenueID = msolimpiade.venue WHERE msolimpiade.OlimpiadeID= '$OlimpiadeID'";
                                                            $query1 = mysqli_query($koneksi, $query);
                                                            $Edit = mysqli_fetch_array($query1);
                                                            ?>

                                                            <input type="hidden" name="Teacher" readonly="readonly" value="<?= $Edit['OlimpiadeID']; ?>">
                                                            <div class="form-group">
                                                                <label for="Name">Yakin akan hapus Olimpiade ini .?</label>
                                                                <input type="Text" id="OlimpiadeID" readonly="readonly" name="OlimpiadeID" required class="form-control" autocomplete="off" value="<?= $OlimpiadeID; ?>">
                                                            </div>

                                                    </div>
                                                    <!-- body modal finish -->

                                                    <!-- footer modal -->
                                                    <div class="modal-footer">
                                                        <button type="submit" name="hapusOlimpiade" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i>
                                                            &nbsp; Yes </button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> &nbsp;
                                                            No</button>
                                                    </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- modal edit data -->
                                        <div id="EditOlimpiade<?= $i ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-xl">
                                                <!-- konten modal-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Olimpiade</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- body modal -->
                                                    <div class="modal-body">
                                                        <form action="" method="post" enctype="multipart/form-data">

                                                            <?php
                                                            $OlimpiadeID = $isi['OlimpiadeID'];
                                                            $query = "SELECT msolimpiade.* ,msvenue.VenueName, msorganizer.OrganizerName FROM msolimpiade JOIN msvenue ON msvenue.VenueID = msolimpiade.venue
                                                             JOIN msorganizer ON msorganizer.OrganizerID = msolimpiade.Organizer 
                                                             WHERE OlimpiadeID= '$OlimpiadeID' ";
                                                            $query1 = mysqli_query($koneksi, $query);
                                                            $Edit = mysqli_fetch_array($query1);
                                                            ?>

                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="OlimpiadeID">Olimpiade ID</label>
                                                                        <input type="Text" id="OlimpiadeID" name="OlimpiadeID" readonly required class="form-control" autocomplete="off" value="<?= $Edit["OlimpiadeID"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="OlimpiadeName">Olimpiade Name</label>
                                                                        <input type="Text" id="OlimpiadeName" name="OlimpiadeName" required class="form-control" autocomplete="off" value="<?= $Edit["OlimpiadeName"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="EligibleClassStart">Eligible Class
                                                                            Start</label>
                                                                        <input type="Text" id="EligibleClassStart" name="EligibleClassStart" required class="form-control" autocomplete="off" value="<?= $Edit["EligibleClassStart"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="EligibleClassEnd">Eligible Class
                                                                            End</label>
                                                                        <input type="Text" id="EligibleClassEnd" name="EligibleClassEnd" required class="form-control" autocomplete="off" value="<?= $Edit["EligibleClassEnd"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="EligibleAgeStart">Eligible Age
                                                                            Start</label>
                                                                        <input type="Text" id="EligibleAgeStart" name="EligibleAgeStart" required class="form-control" autocomplete="off" value="<?= $Edit["EligibleAgeStart"]; ?>">
                                                                    </div>

                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="EligibleAgeEnd">Eligible Age End</label>
                                                                        <input type="Text" id="EligibleAgeEnd" name="EligibleAgeEnd" required class="form-control" autocomplete="off" value="<?= $Edit["EligibleAgeEnd"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ExamDateStart">Exam Date Start</label>
                                                                        <div class="input-group date" data-target-input="nearest">
                                                                            <input type="Text" id="ExamDateStart" name="ExamDateStart" required class="form-control datetimepicker" value="<?= date('d-m-Y', strtotime($Edit['ExamDateStart'])); ?>">
                                                                            <div class="input-group-append">
                                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ExamDateEnd">Exam Date End</label>
                                                                        <div class="input-group date" data-target-input="nearest">
                                                                            <input type="Text" id="ExamDateEnd" name="ExamDateEnd" required class="form-control datetimepicker" value="<?= date('d-m-Y', strtotime($Edit['ExamDateEnd'])); ?>">
                                                                            <div class="input-group-append">
                                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ExamDateEnd">Registration
                                                                            Date</label>
                                                                        <div class="input-group date" data-target-input="nearest">
                                                                            <input type="Text" id="RegistrationDate" name="RegistrationDate" required class="form-control datetimepicker" value="<?= date('d-m-Y', strtotime($Edit['RegistrationDate'])); ?>">
                                                                            <div class="input-group-append">
                                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UrlImage">Url Image</label>
                                                                        <div class="custom-file">
                                                                            <input type="hidden" id="UrlImage" name="UrlImage" readonly="readonly" value="<?= $Edit["UrlImage"]; ?>">
                                                                            <input id="UrlImagex" class="form-control custom-file-input" type="file" name="gambar" onchange="PreviewImageAdd();" />
                                                                            <label class="custom-file-label" for="gambar"><?= $Edit["UrlImage"]; ?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="UrlImage">Url Image 2</label>
                                                                        <div class="custom-file">
                                                                            <input type="hidden" id="UrlImage2" name="UrlImage2" readonly="readonly" value="<?= $Edit["UrlImage2"]; ?>">
                                                                            <input id="UrlImagex2" class="form-control custom-file-input" type="file" name="gambar2" onchange="PreviewImageAdd();" />
                                                                            <label class="custom-file-label" for="gambar2"><?= $Edit["UrlImage2"]; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="Price">Price</label>
                                                                        <input type="Text" id="Price" name="Price" required class="form-control" autocomplete="off" value="<?= $Edit["Price"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Venue</label>
                                                                        <input type="hidden" id="UpdatedBy" name="UpdatedBy" readonly="true" enabled="false" value="<?= $_SESSION['masuk']["AdminID"] ?>" required class="form-control" autocomplete="off">

                                                                        <select id="Venue" name="Venue" class="form-control select2" data-placeholder="Pilih Venue" style="width: 100%;">
                                                                            <option selected="selected" value="<?= $Edit["Venue"]; ?>"><?= $Edit["VenueName"]; ?></option>
                                                                            <?php
                                                                            $venueQuery = "SELECT VenueID, VenueName FROM msVenue WHERE FgActive = 'Y'  ";
                                                                            $venueGetData = mysqli_query($koneksi, $venueQuery);
                                                                            while ($venue = mysqli_fetch_array($venueGetData)) {
                                                                            ?>
                                                                                <option value="<?= $venue["VenueID"]; ?>">
                                                                                    <?= $venue["VenueName"]; ?> </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Organizer</label>
                                                                        <select id="Organizer" name="Organizer" class="form-control select2" data-placeholder="Pilih Organizer" style="width: 100%;">
                                                                            <option selected="selected" value="<?= $Edit["Organizer"]; ?>"><?= $Edit["OrganizerName"]; ?></option>
                                                                            <?php
                                                                            $OrganizerQuery = "SELECT OrganizerID, OrganizerName FROM msorganizer WHERE FgActive = 'Y' ";
                                                                            $OrganizerGetData = mysqli_query($koneksi, $OrganizerQuery);
                                                                            while ($Organizer = mysqli_fetch_array($OrganizerGetData)) {
                                                                            ?>
                                                                                <option value="<?= $Organizer["OrganizerID"]; ?>">
                                                                                    <?= $Organizer["OrganizerName"]; ?>
                                                                                </option>
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
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i>
                                                            Close</button>
                                                        <button type="submit" name="EditOlimpiade" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i>
                                                            Save Edit Olimpiade</button>
                                                    </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="Preview<?= $i; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <!-- konten modal-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Preview <b><?= $isi['OlimpiadeName']; ?></b></h4>
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
                                                                            <div class="col-md-10"><img class="rounded float-left img-fluid max-width: 100%" src="../image/Olimpiade/<?= $isi['UrlImage']; ?>" alt=""></div>
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
                                        <div id="Preview2<?= $i; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <!-- konten modal-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Preview <b><?= $isi['OlimpiadeName']; ?></b></h4>
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
                                                                            <div class="col-md-10"><img class="rounded float-left img-fluid max-width: 100%" src="../image/Olimpiade/<?= $isi['UrlImage2']; ?>" alt=""></div>
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
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- konten modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Olimpiade</h4>
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
                                <div class="input-group date" data-target-input="nearest">
                                    <input type="Text" id="ExamDateStart" name="ExamDateStart" required class="form-control datetimepicker" autocomplete="off">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ExamDateEnd">Exam Date End</label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input type="Text" id="ExamDateEnd" name="ExamDateEnd" required class="form-control datetimepicker" autocomplete="off">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ExamDateEnd">Registration
                                    Date</label>
                                <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                    <input type="Text" id="RegistrationDate" required class="form-control datetimepicker" autocomplete="off">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="UrlImage">Url Image</label>
                                <div class="custom-file">
                                    <input id="UrlImage" class="form-control custom-file-input" required type="file" name="gambar" onchange="PreviewImageAdd();" />
                                    <label class="custom-file-label" for="gambar">Choose file</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="UrlImage2">Url Image 2</label>
                                <div class="custom-file">
                                    <input id="UrlImage2" class="form-control custom-file-input" type="file" name="gambar2" onchange="PreviewImageAdd();" />
                                    <label class="custom-file-label" for="gambar2">Choose file</label>
                                </div>
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
                                    <?php
                                    $venueQuery = "SELECT VenueID, VenueName FROM msVenue WHERE FgActive = 'Y'  ";
                                    $venueGetData = mysqli_query($koneksi, $venueQuery);
                                    while ($venue = mysqli_fetch_array($venueGetData)) {
                                    ?>
                                        <option value="<?= $venue["VenueID"]; ?>">
                                            <?= $venue["VenueName"]; ?> </option>
                                    <?php } ?>

                                </select>
                            </div>


                            <div class="form-group">
                                <label>Organizer</label>
                                <select id="Organizer" name="Organizer" class="form-control select2" data-placeholder="Pilih Organizer" style="width: 100%;" required>
                                    <option selected="selected" value="" disabled="False">Pilih Organizer</option>
                                    <?php
                                    $OrganizerQuery = "SELECT OrganizerID, OrganizerName FROM msorganizer WHERE FgActive = 'Y' ";
                                    $OrganizerGetData = mysqli_query($koneksi, $OrganizerQuery);
                                    while ($Organizer = mysqli_fetch_array($OrganizerGetData)) {
                                    ?>
                                        <option value="<?= $Organizer["OrganizerID"]; ?>">
                                            <?= $Organizer["OrganizerName"]; ?>
                                        </option>
                                    <?php } ?>
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