<?php
require_once('Connection.php');
session_start();

$user=mysqli_real_escape_string($conn,$_GET['user']);

$sql_fetch="SELECT * FROM tbl_login WHERE Username='$user'";
$sql_fetch_details=mysqli_query($conn,$sql_fetch);

$log=mysqli_fetch_assoc($sql_fetch_details);

if($log['L_Status']=='Active')
    {
        $del_login="UPDATE tbl_login SET L_Status='Inactive' WHERE Username='$user'";
        $del_login_exe=mysqli_query($conn,$del_login);
        header('Location: Staff.php');
        $_SESSION['status']="Inactive";
    }
    else
    {
        $del_login="UPDATE tbl_login SET L_Status='Active' WHERE Username='$user'";
        $del_login_exe=mysqli_query($conn,$del_login);
        header('Location: Staff.php');
        $_SESSION['status']="Active";
    }

mysqli_close($conn);
?>