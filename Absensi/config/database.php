<?php 

$server = "localhost"; // host
$username = "root"; // user
$pass = ""; //password
$db = "db_absensi"; //db

$conn = mysqli_connect($server, $username, $pass, $db);

if (mysqli_connect_errno()) {
  echo "Database tidak ditemukan : " . mysqli_connect_error();
}