<?php

include 'Conn.php';

$emp_Number = $_POST['Emp_Number'];
$imei = $_POST['Imei'];
$connect-> query("UPDATE msemployee SET Imei = '".$imei."' WHERE Emp_Number = '".$emp_Number."'");

?>




