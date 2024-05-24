<?php
require_once('Connection.php');
session_start();
$cid=mysqli_real_escape_string($conn,$_GET['cid']);
$del="DELETE FROM tbl_card WHERE Card_id='$cid'";
$del_exe=mysqli_query($conn,$del);
header('Location: Cards.php');
$_SESSION['status']="Remove";
mysqli_close($conn);
?>