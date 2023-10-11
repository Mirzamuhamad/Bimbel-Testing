<?php

include 'Conn.php';

$empNumber = $_POST['Emp_Number'];

$QueryGetdata = $connect-> query("SELECT * FROM v_msabsen WHERE Emp_Number = '".$empNumber."' ORDER BY Tanggal DESC");

$QueryResult = array();

while($fetchData = $QueryGetdata->fetch_assoc()){
    $QueryResult[]=$fetchData;
}

echo json_encode($QueryResult);