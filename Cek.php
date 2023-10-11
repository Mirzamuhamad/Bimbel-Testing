<?php

include 'Conn.php';

date_default_timezone_set("Asia/Jakarta");


$empNumber = $_POST['Emp_Number'];
$remark = $_POST['Remark'];
$tanggal = date("Y-m-d");


$QueryGetdata = $connect-> query("SELECT * FROM v_msabsen WHERE Emp_Number = '".$empNumber."' AND Remark = '".$remark."' AND DATE_FORMAT(Tanggal,'%Y-%m-%d') = '".$tanggal."' ORDER BY Tanggal DESC");

$QueryResult = array();

while($fetchData = $QueryGetdata->fetch_assoc()){
    $QueryResult[]=$fetchData;
}

echo json_encode($QueryResult);

?>