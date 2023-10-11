<?php

include 'Conn.php';
date_default_timezone_set("Asia/Jakarta");

$emp_Number = $_POST['Emp_Number'];
$Emp_Name = $_POST['Emp_Name'];
$Tgl_Lahir = $_POST['Tgl_Lahir'];
$Telp = $_POST['Telp'];
$Email = $_POST['email'];
$imei = $_POST['Imei'];


$image = $emp_Number. date("YmdHis") . str_ireplace(" ","", basename($_FILES['Employee']['name']));
$path = "Employee/$image";

move_uploaded_file($_FILES['Employee']['tmp_name'], $path);

$connect-> query("UPDATE msemployee SET fotoProfil = '".$image."', Emp_Name = '".$Emp_Name."', Tgl_Lahir = '".$Tgl_Lahir."',Telp = '".$Telp."', email = '".$Email."' WHERE Emp_Number = '".$emp_Number."'");


// $connect-> query("UPDATE msemployee SET fotoProfil = '".$image."' WHERE Emp_Number = '".$emp_Number."'");

?>



