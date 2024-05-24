<?php
require_once('Connection.php');
session_start();
$cid=mysqli_real_escape_string($conn,$_GET['cid']);

$sql_fetch_cc="SELECT * FROM tbl_cartchild WHERE CChild_id='$cid'";
$sql_exe_cc=mysqli_query($conn,$sql_fetch_cc);
$cc=mysqli_fetch_array($sql_exe_cc);

$cmid=$cc['CMaster_id'];

$tp=$cc['Tot_Price'];

$sql_fetch_cm="SELECT * FROM tbl_cartmaster WHERE CMaster_id='$cmid'";
$sql_exe_cm=mysqli_query($conn,$sql_fetch_cm);
$cm=mysqli_fetch_array($sql_exe_cm);

$ta=$cm['Tot_Amt']-$tp;

$sql_update_cm="UPDATE tbl_cartmaster SET Tot_Amt='$ta' WHERE CMaster_id='$cmid'";
$sql_cmast=mysqli_query($conn,$sql_update_cm);

if($sql_cmast)
{
$del="DELETE FROM tbl_cartchild WHERE CChild_id='$cid'";
$del_exe=mysqli_query($conn,$del);
header('Location: Cart.php');
$_SESSION['status']="Remove";
}
else
{
    header('Location: Cart.php');
$_SESSION['status']="NoRemove";
}
mysqli_close($conn);
?>