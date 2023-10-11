<?php

include 'Conn.php';

date_default_timezone_set("Asia/Jakarta");

//Data yang di kirim dari handphone
$Emp_number = $_POST['Emp_Number'];
// $Jam_Absen = $_POST['Jam_Absen']; 
// $Tanggal = $_POST['Tanggal'];
$Remark = $_POST['Remark'];
$Jam_Absen = date("H:i:s");
$Tanggal = date("Y-m-d H:i:s");
$Koordinat = $_POST['Koordinat'];
$Tempat_absen = $_POST['Tempat_Absen'];

$image = $Emp_number. date("YmdHis") . $Remark . str_ireplace(" ","", basename($_FILES['image']['name']));
$path = "image/$image";

move_uploaded_file($_FILES['image']['tmp_name'], $path);

$connect-> query("INSERT INTO msabsen (Emp_Number, Jam_Absen, tanggal, Remark, Koordinat, Tempat_absen, image) 
VALUES ('".$Emp_number."','".$Jam_Absen."','".$Tanggal."','".$Remark."','".$Koordinat."','".$Tempat_absen."', '".$image."')");


?>