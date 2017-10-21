<?php

session_start();
$address = "localhost";
$username = "frost_root";
$password = "frost#0";
$database = "frost";
$conn = new mysqli($address,$username,$password,$database);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

function esc($value){
  global $conn;
  return mysqli_real_escape_string($conn, $value);
}

?>
