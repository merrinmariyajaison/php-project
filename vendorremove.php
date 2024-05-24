<?php
require_once('Connection.php');
session_start();
$user_id=mysqli_real_escape_string($conn,$_GET['user_id']);

$sql_fetch="SELECT * FROM tbl_vendor WHERE Vendor_id='$user_id'";
$sql_fetch_details=mysqli_query($conn,$sql_fetch);

$vend=mysqli_fetch_assoc($sql_fetch_details);

if($_SESSION['user_type']=="admin")
{
    if($vend['V_Status']=='Active')
    {
        $del_login="UPDATE tbl_vendor SET Staff_id='0',V_Status='Inactive' WHERE Vendor_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);
        header('Location: Vendor.php');
        $_SESSION['status']="Inactive";
    }
    else
    {
        $del_login="UPDATE tbl_vendor SET Staff_id='0',V_Status='Active' WHERE Vendor_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);
        header('Location: Vendor.php');
        $_SESSION['status']="Active";
    }
}

else if($_SESSION['user_type']=="Staff")
{
    $user=$_SESSION['user'];
    $sql_fetch_id="SELECT * FROM tbl_staff WHERE Username='$user'";
    $sql_fetch_id_details=mysqli_query($conn,$sql_fetch_id);
    $row=mysqli_fetch_assoc($sql_fetch_id_details);
    $staff_id=$row['Staff_id'];

    if($vend['V_Status']=='Active')
    {
        $del_login="UPDATE tbl_vendor SET Staff_id='$staff_id',V_Status='Inactive' WHERE Vendor_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);
        header('Location: Vendor_Staff.php');
        $_SESSION['status']="Inactive";
    }
    else
    {
        $del_login="UPDATE tbl_vendor SET Staff_id='$staff_id',V_Status='Active' WHERE Vendor_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);
        header('Location: Vendor_Staff.php');
        $_SESSION['status']="Active";
    }
}


mysqli_close($conn);
?>