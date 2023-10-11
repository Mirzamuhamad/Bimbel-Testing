<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "absensi";

// Create connection
$connect = new mysqli($servername, $username, $password, $dbname );
// Check connection

// if ($connect){
//     echo "berhasil";
// }

// if ($connect->connect_error) {
//   die("Connection failed: " . $connect->connect_error);
//  }