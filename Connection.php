<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "cosmeticsss";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db_name);

// Check connection
if (!$conn) {
  die("Connection Failed! " . mysqli_connect_error());
}
?>