<?php

include 'Conn.php';

$emp_Number = $_POST['Emp_Number'];
$Imei = $_POST['Imei'];

$QueryGetdata = $connect-> query("SELECT * FROM msemployee WHERE Emp_Number = '".$emp_Number."' AND Imei = '".$Imei."'");

$QueryResult = array();

while($fetchData = $QueryGetdata->fetch_assoc()){
    $QueryResult[]=$fetchData;
}

echo json_encode($QueryResult);