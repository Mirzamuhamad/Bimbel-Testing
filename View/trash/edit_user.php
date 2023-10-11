<?php 

require '../Conn/functions.php';

$EmpID= $_GET["EmpCode"];
$EmpNumber= htmlspecialchars($_GET["EmpNumber"]);
$EmpName= htmlspecialchars($_GET["EmpName"]);
$Phone= htmlspecialchars($_GET["Telp"]);
$Email= htmlspecialchars($_GET["Email"]);
$Tgl_Lahir= htmlspecialchars($_GET["Tgl_Lahir"]);
$Gender= htmlspecialchars($_GET["Gender"]);
$Imei= htmlspecialchars($_GET["Imei"]);


echo "$EmpID";


$sql = "UPDATE msemployee SET 
Emp_Number 	 = '$EmpNumber', 
Emp_Name	 = '$EmpName', 
Telp 		 = '$Phone', 
email 		 = '$Email',
Gender 		 = '$Gender', 
Tgl_Lahir 	 = '$Tgl_Lahir',
Imei 		 = '$Imei'   
WHERE EmpID  =  '$EmpID' ";

// $sql = "UPDATE msemployee SET 
// Emp_Number 	 = '1235', 
// Emp_Name	 = 'Asu'
 
// WHERE EmpID  =  'USR00003' ";

if ($query  = mysqli_query($koneksi, $sql)) {
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
