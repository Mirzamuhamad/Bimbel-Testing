<?php include '../Template/header.php'; ?>
<!-- Main Sidebar Container -->
<?php include '../Template/sidebar.php'; ?>
<?php
$Company = $_SESSION['masuk']["AdminID"];
$user = query("SELECT * FROM msVenue ORDER BY VenueID DESC ");

if (isset($_POST["addVenue"])) {

    if (AddVenue($_POST) > 0) {
        echo "<script>
              // alert('Register Berhasil, silahkan Login!');
              document.location.href='ms_venue';
          </script>
          ";
    } else {
        echo mysqli_error($koneksi);
    }
}

if (isset($_POST["editVenue"])) {

    if (EditVenue($_POST) > 0) {
        echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_venue';
          </script>
          ";
    } else {
        echo mysqli_error($koneksi);
    }
}


if (isset($_POST["hapusVenue"])) {

    if (HapusVenue($_POST) > 0) {
        echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_venue';
          </script>
          ";
    } else {
        echo mysqli_error($koneksi);
    }
}


// $query = "SELECT max(VenueID) as maxKode FROM msVenue";
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
          <h4>Data Venue</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Venue</a></li>
            <li class="breadcrumb-item active">Venue </li>
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
                            <h3 class="card-title">Venue Data</h3>
                            <div class="row">
                                <div class="col-12">
                                    <!-- <input type="submit" value="Create new Porject" class="btn btn-primary btn-xs float-right"> -->
                                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#myModalVenue"><i class="fas fa-plus"></i> &nbsp; Venue</button>
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
                                        <th>Venue ID</th>
                                        <th>Venue Name</th>
                                        <th>Venue Address</th>
                                        <!-- <th>Contact Person</th>
                                        <th>Contact HP</th>
                                        <th>Email</th>
                                        <th>Capacity</th> -->
                                        <th>Fg Active</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1; ?>
                                    <?php foreach ($user as $isi) : ?>

                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $isi['VenueID']; ?></td>
                                            <td><?= $isi['VenueName']; ?></td>
                                            <td> <?= $isi["VenueAddr"]; ?></td>
                                            <!-- <td> <?= $isi["ContactPerson"]; ?></td>
                                            <td> <?= $isi["ContactHP"]; ?></td>
                                            <td> <?= $isi["ContactEmail"]; ?></td>
                                            <td> <?= $isi["Capacity"]; ?></td> -->
                                            <td> <?= $isi["FgActive"]; ?> </td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <!-- <a class="btn btn-block btn-danger btn-xs" href="hapus_Venue.php?VenueID=<?= $isi["VenueID"]; ?>"  onclick=" return confirm('yakin akan di hapus?');"><i class="fas fa-trash-alt"></i> </a> -->
                                                    <a class="btn  btn-primary " data-toggle="modal" data-target="#EditVenue<?= $isi['VenueID']; ?>"><i class="fas fa-edit"></i> </a>
                                                    <a class="btn  btn-danger " data-toggle="modal" data-target="#hapusVenue<?= $isi['VenueID']; ?>"><i class="fas fa-trash-alt"></i> </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- modal hapus data -->
                                        <div id="hapusVenue<?= $isi['VenueID'] ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- konten modal Hapus-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Venue</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- body modal -->
                                                    <div class="modal-body">
                                                        <form action="" method="post" enctype="multipart/form-data">

                                                            <?php
                                                            $id = $isi['VenueID'];
                                                            $query      = "SELECT * FROM msVenue WHERE VenueID = '$id' ";
                                                            $query1     = mysqli_query($koneksi, $query);
                                                            $Edit      = mysqli_fetch_array($query1);
                                                            ?>

                                                            <input type="hidden" name="VenueID" name="VenueID" readonly="readonly" value="<?= $Edit["VenueID"]; ?>">
                                                            <div class="form-group">
                                                                <label for="Name">Yakin akan hapus Venue ini .?</label>
                                                                <input type="Text" id="VenueName" readonly="readonly" name="VenueName" required class="form-control" autocomplete="off" value="<?= $Edit["VenueName"]; ?>">
                                                            </div>

                                                    </div>
                                                    <!-- body modal finish -->

                                                    <!-- footer modal -->
                                                    <div class="modal-footer">
                                                        <button type="submit" name="hapusVenue" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> &nbsp; Yes </button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> &nbsp; No</button>
                                                    </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- modal edit data -->
                                        <div id="EditVenue<?= $isi['VenueID'] ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <!-- konten modal-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Venue</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- body modal -->
                                                    <div class="modal-body">
                                                        <form action="" method="post" enctype="multipart/form-data">

                                                            <?php
                                                            $id = $isi['VenueID'];
                                                            $id_menu    = $isi['VenueID'];
                                                            $query      = "SELECT * FROM msVenue WHERE VenueID = '$id' ";
                                                            $query1     = mysqli_query($koneksi, $query);
                                                            $Edit      = mysqli_fetch_array($query1);
                                                            ?>
                                                            <div class="row">

                                                                <div class="col-sm-6">
                                                                    <input type="hidden" id="VenueID" name="VenueID" readonly="readonly" value="<?= $Edit["VenueID"]; ?>">
                                                                    <div class="form-group">
                                                                        <label for="VenueName">Venue Name</label>
                                                                        <input type="Text" id="VenueName" name="VenueName" required class="form-control" autocomplete="off" value="<?= $Edit["VenueName"]; ?>">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="VenueAddr">Venue Address</label>
                                                                        <input type="Text" id="VenueAddr" name="VenueAddr" required class="form-control" autocomplete="off" value="<?= $Edit["VenueAddr"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ContactPerson">Contact Person</label>
                                                                        <input type="Text" id="ContactPerson" name="ContactPerson" required class="form-control" autocomplete="off" value="<?= $Edit["ContactPerson"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ContactHP">Contact HP</label>
                                                                        <input type="Text" id="ContactHP" name="ContactHP" required class="form-control" autocomplete="off" value="<?= $Edit["ContactHP"]; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ContactEmail">Contact Email</label>
                                                                        <input type="Text" id="ContactEmail" name="ContactEmail" required class="form-control" autocomplete="off" value="<?= $Edit["ContactEmail"]; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="Capacity">Capacity</label>
                                                                        <input type="Text" id="Capacity" name="Capacity" required class="form-control" autocomplete="off" value="<?= $Edit["Capacity"]; ?>">
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
                                                        <button type="submit" name="editVenue" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> Save Edit Venue</button>

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
<div id="myModalVenue" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- konten modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Venue</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- body modal -->
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="VenueID">Venue ID</label>
                                <input type="Text" id="VenueID" name="VenueID" required class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="Venue">Venue Name</label>
                                <input type="Text" id="Venue" name="VenueName" required class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="VenueAddr">Venue Address</label>
                                <input type="Text" id="VenueAddr" name="VenueAddr" required class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="ContactPerson">Contact Person</label>
                                <input type="Text" id="ContactPerson" name="ContactPerson" required class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="ContactHP">Contact HP</label>
                                <input type="Text" id="ContactHP" name="ContactHP" required class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ContactEmail">Contact Email</label>
                                <input type="Text" id="ContactEmail" name="ContactEmail" required class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="Capacity">Capacity</label>
                                <input type="Text" id="Capacity" name="Capacity" required class="form-control" autocomplete="off" ">
                            </div>

                            <div class=" form-group">
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
                <button type="submit" name="addVenue" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> Save New Venue</button>

            </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--  Koding Untuk membuat modal atau popup -->

<?php include '../Template/footer.php'; ?>