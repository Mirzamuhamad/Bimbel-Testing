<?php 

require '../Conn/functions.php';


$id_Employee = $_GET['EmpID'];

$sql  = "DELETE FROM msemployee WHERE EmpID = '$id_Employee' ";


if ($query  = mysqli_query($koneksi,$sql)) {
    echo "
        <script>
        //   alert('Berhasil Di Hapus');
          document.location.href = 'data_Employee.php';
        </script>
    ";

} else{
        echo "
         <script>
           alert('Gagal Hapus Data!');
           document.location.href = 'data_Employee.php';
          </script>
        ";
}
