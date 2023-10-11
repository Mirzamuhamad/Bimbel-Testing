<?php include '../Template/header.php'; ?>
<!-- Main Sidebar Container -->
<?php include '../Template/sidebar.php'; ?>
<?php
$Company = $_SESSION['masuk']["AdminID"];
$user = query("SELECT * FROM msOrganizer ORDER BY OrganizerID DESC ");

if (isset($_POST["addOrganizer"])) {

    if (AddOrganizer($_POST) > 0) {
        echo "<script>
              // alert('Register Berhasil, silahkan Login!');
              document.location.href='ms_organizer';
          </script>
          ";
    } else {
        echo mysqli_error($koneksi);
    }
}

if (isset($_POST["editOrganizer"])) {

    if (EditOrganizer($_POST) > 0) {
        echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_organizer';
          </script>
          ";
    } else {
        echo mysqli_error($koneksi);
    }
}


if (isset($_POST["hapusOrganizer"])) {

    if (HapusOrganizer($_POST) > 0) {
        echo "<script>
              // alert('Edit secess!');
              document.location.href='ms_organizer';
          </script>
          ";
    } else {
        echo mysqli_error($koneksi);
    }
}


// $query = "SELECT max(OrganizerID) as maxKode FROM msOrganizer";
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
          <h4>Data Organizer</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Organizer</a></li>
            <li class="breadcrumb-item active">Organizer </li>
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
                            <h3 class="card-title">Organizer Data</h3>
                            <div class="row">
                                <div class="col-12">
                                    <!-- <input type="submit" value="Create new Porject" class="btn btn-primary btn-xs float-right"> -->
                                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#myModalOrganizer"><i class="fas fa-plus"></i> &nbsp; Organizer</button>
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
                                        <th>Organizer ID</th>
                                        <th>Organizer Name</th>
                                        <th>Organizer Address</th>
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
                                            <td><?= $isi['OrganizerID']; ?></td>
                                            <td><?= $isi['OrganizerName']; ?></td>
                                            <td> <?= $isi["OrganizerAddr"]; ?></td>
                                            <!-- <td> <?= $isi["ContactPerson"]; ?></td>
                                            <td> <?= $isi["ContactHP"]; ?></td>
                                            <td> <?= $isi["ContactEmail"]; ?></td>
                                            <td> <?= $isi["Capacity"]; ?></td> -->
                                            <td> <?= $isi["FgActive"]; ?> </td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <!-- <a class="btn btn-block btn-danger btn-xs" href="hapus_Organizer.php?OrganizerID=<?= $isi["OrganizerID"]; ?>"  onclick=" return confirm('yakin akan di hapus?');"><i class="fas fa-trash-alt"></i> </a> -->
                                                    <a class="btn  btn-primary " data-toggle="modal" data-target="#EditOrganizer<?= $isi['OrganizerID']; ?>"><i class="fas fa-edit"></i> </a>
                                                    <a class="btn  btn-danger " data-toggle="modal" data-target="#hapusOrganizer<?= $isi['OrganizerID']; ?>"><i class="fas fa-trash-alt"></i> </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- modal hapus data -->
                                        <div id="hapusOrganizer<?= $isi['OrganizerID'] ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- konten modal Hapus-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Organizer</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- body modal -->
                                                    <div class="modal-body">
                                                        <form action="" method="post" enctype="multipart/form-data">

                                                            <?php
                                                            $id = $isi['OrganizerID'];
                                                            $query      = "SELECT * FROM msOrganizer WHERE OrganizerID = '$id' ";
                                                            $query1     = mysqli_query($koneksi, $query);
                                                            $Edit      = mysqli_fetch_array($query1);
                                                            ?>

                                                            <input type="hidden" name="OrganizerID" name="OrganizerID" readonly="readonly" value="<?= $Edit["OrganizerID"]; ?>">
                                                            <div class="form-group">
                                                                <label for="Name">Yakin akan hapus Organizer ini .?</label>
                                                                <input type="Text" id="OrganizerName" readonly="readonly" name="OrganizerName" required class="form-control" autocomplete="off" value="<?= $Edit["OrganizerName"]; ?>">
                                                            </div>

                                                    </div>
                                                    <!-- body modal finish -->

                                                    <!-- footer modal -->
                                                    <div class="modal-footer">
                                                        <button type="submit" name="hapusOrganizer" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> &nbsp; Yes </button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> &nbsp; No</button>
                                                    </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- modal edit data -->
                                        <div id="EditOrganizer<?= $isi['OrganizerID'] ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <!-- konten modal-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Organizer</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- body modal -->
                                                    <div class="modal-body">
                                                        <form action="" method="post" enctype="multipart/form-data">

                                                            <?php
                                                            $id = $isi['OrganizerID'];
                                                            $id_menu    = $isi['OrganizerID'];
                                                            $query      = "SELECT * FROM msOrganizer WHERE OrganizerID = '$id' ";
                                                            $query1     = mysqli_query($koneksi, $query);
                                                            $Edit      = mysqli_fetch_array($query1);
                                                            ?>
                                                            <div class="row">

                                                                <div class="col-sm-6">
                                                                    <input type="hidden" id="OrganizerID" name="OrganizerID" readonly="readonly" value="<?= $Edit["OrganizerID"]; ?>">
                                                                    <div class="form-group">
                                                                        <label for="OrganizerName">Organizer Name</label>
                                                                        <input type="Text" id="OrganizerName" name="OrganizerName" required class="form-control" autocomplete="off" value="<?= $Edit["OrganizerName"]; ?>">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="OrganizerAddr">Organizer Address</label>
                                                                        <input type="Text" id="OrganizerAddr" name="OrganizerAddr" required class="form-control" autocomplete="off" value="<?= $Edit["OrganizerAddr"]; ?>">
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
                                                        <button type="submit" name="editOrganizer" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> Save Edit Organizer</button>

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
<div id="myModalOrganizer" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- konten modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Organizer</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- body modal -->
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="OrganizerID">Organizer ID</label>
                                <input type="Text" id="OrganizerID" name="OrganizerID" required class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="Organizer">Organizer Name</label>
                                <input type="Text" id="Organizer" name="OrganizerName" required class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="OrganizerAddr">Organizer Address</label>
                                <input type="Text" id="OrganizerAddr" name="OrganizerAddr" required class="form-control" autocomplete="off">
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
                <button type="submit" name="addOrganizer" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i> Save New Venue</button>

            </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--  Koding Untuk membuat modal atau popup -->

<?php include '../Template/footer.php'; ?>