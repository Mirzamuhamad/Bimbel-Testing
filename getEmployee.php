    <?php

include 'Conn.php';

$emp_Number = $_POST['Emp_Number'];

$QueryGetdata = $connect-> query("SELECT * FROM msemployee WHERE Emp_Number = '".$emp_Number."'");
// $QueryGetdata = $connect-> query("SELECT * FROM msemployee ");

$QueryResult = array();

while($fetchData = $QueryGetdata->fetch_assoc()){
    $QueryResult[]=$fetchData;
}

echo json_encode($QueryResult);