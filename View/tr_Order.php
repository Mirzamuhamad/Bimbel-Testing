<?php include '../Template/header.php';?>
  <!-- Main Sidebar Container -->
<?php include '../Template/sidebar.php';?>


<?php 
    $user = query("SELECT * FROM trorderhd WHERE Status = 'Bukti Bayar' ORDER BY OrderID DESC ");

    if (isset($_POST["orderApprove"])) {

      if (orderApprove($_POST) > 0) {
        echo "<script>
                  // alert('Edit secess!');
                  document.location.href='tr_Order';
              </script>
              ";
      } else {
        echo mysqli_error($koneksi);
      }
    }

    if (isset($_POST["orderReject"])) {

      if (orderReject($_POST) > 0) {
        echo "<script>
                  // alert('Edit secess!');
                  document.location.href='tr_Order';
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
          <!-- <div class="col-sm-6">
            <h1>Order Murid</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Order</a></li>
              <li class="breadcrumb-item active">Data Order</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Order</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>   
                    <th>Order ID</th>
                    <th>Status</th>
                    <th>Transdate</th>
                    <th>Bruto</th>
                    <th>Admin</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php $i = 1; ?>
                  <?php foreach ($user as $isi ): ?>

                  <tr>
                    <td><?= $i; ?></td>
                    <td><b><?= $isi['OrderID']; ?></b></td>
                    <!-- <td><img src="../image/<?= $isi["image"]; ?>" width="50" height="50" class="img-circle elevation-10" alt="User Image"></td> -->
                    <td> <?= $isi["Status"]; ?></td>
                    <td> <?= date('d M Y', strtotime($isi['TransDate'])); ?> </td>
                    <td> <?= $isi["Bruto"]; ?> </td></td>
                    <td> <?= $isi["Admin"]; ?> </td> 
                    <td> <?= $isi["Total"]; ?> </td> 
                    <td class="text-center py-0 align-middle"> 
                    <div class="btn-group btn-group-sm">                          
                          <a class="btn  btn-primary " data-toggle="modal" data-target="#ConfirmOrder<?= $isi['OrderID'];?>"><i class="fas fa-eye"></i> </a>
                        </div>  
                    </td>               
                  </tr>

                  <!-- modal edit data -->
                  <div id="ConfirmOrder<?= $isi['OrderID'];?>" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-md">
                        <!-- konten modal-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Confirm Order <b><?= $isi['OrderID']; ?></b></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- body modal -->
                          <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">

                              <?php
                                $OrderID= $isi['OrderID'];
                                $UserLogin = $isi['UserLogin'];
                                $query      = "SELECT * FROM mslogin WHERE UserLogin = '$UserLogin' ";
                                $query1     = mysqli_query($koneksi, $query);
                                $User      = mysqli_fetch_array($query1);
                                ?>
                              <div class="row">
                                <div class="col-md-12">
                                  <input type="hidden" id="OrderID" name="OrderID" readonly="readonly" value="<?= $OrderID; ?>">
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-md-1"></div>
                                      <div class="col-md-10"><img  class="rounded float-left img-fluid max-width: 100%" src="https://bimbel-srv2.dolphinstudio.id/storage/uploads/<?=$isi['UploadFile'];?>" alt=""></div></div>
                                  </div>
                                  <input type="hidden" id="ModifiedBy" name="ModifiedBy" readonly="true" enabled="false" value="<?= $_SESSION['masuk']["AdminID"] ?>" name="Name" required class="form-control" autocomplete="off">



                                </div>
                              </div>
                          </div>
                          <!-- body modal finish -->

                          <!-- footer modal -->
                          <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i> Close    </button>
                            <button type="submit" name="orderReject" class="btn btn-danger btn-sm"> <i class="fas fa-ban"></i> Rejected</button>
                            <button type="submit" name="orderApprove" class="btn  btn-primary btn-sm"> <i class="fa fa-check-circle"></i> Approved</button>

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
<?php include '../Template/footer.php';?> 
 
