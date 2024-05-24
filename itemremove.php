<?php
require_once('Connection.php');
session_start();

$subcatid=$_SESSION['user_id'];

$user_id=mysqli_real_escape_string($conn,$_GET['user_id']);

$sql_fetch="SELECT * FROM tbl_item WHERE Item_id='$user_id'";
$sql_fetch_details=mysqli_query($conn,$sql_fetch);

$item=mysqli_fetch_assoc($sql_fetch_details);

if($_SESSION['user_type']=="admin")
{
    if($item['I_Status']=='Active')
    {
        $del_login="UPDATE tbl_item SET I_Status='Inactive' WHERE Item_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);

        $sql_fetch_subcat="SELECT * FROM tbl_subcat WHERE SubCat_id='$subcatid'";
        $sql_fetch_subcat_details=mysqli_query($conn,$sql_fetch_subcat);
        while($row=mysqli_fetch_assoc($sql_fetch_subcat_details))
        {
            header("refresh:0; url=Item.php?user_id=".$row['SubCat_id']);
            $_SESSION['status']="Inactive";
        }
    }
    else
    {
        $del_login="UPDATE tbl_item SET I_Status='Active' WHERE Item_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);

        $sql_fetch_subcat="SELECT * FROM tbl_subcat WHERE SubCat_id='$subcatid'";
        $sql_fetch_subcat_details=mysqli_query($conn,$sql_fetch_subcat);
        while($row=mysqli_fetch_assoc($sql_fetch_subcat_details))
        {
            header("refresh:0; url=Item.php?user_id=".$row['SubCat_id']);
            $_SESSION['status']="Active";
        }
    }
}

else if($_SESSION['user_type']=="Staff")
{
    if($item['I_Status']=='Active')
    {
        $del_login="UPDATE tbl_item SET I_Status='Inactive' WHERE Item_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);

        $sql_fetch_subcat="SELECT * FROM tbl_subcat WHERE SubCat_id='$subcatid'";
        $sql_fetch_subcat_details=mysqli_query($conn,$sql_fetch_subcat);
        while($row=mysqli_fetch_assoc($sql_fetch_subcat_details))
        {
            header("refresh:0; url=Item_Staff.php?user_id=".$row['SubCat_id']);
            $_SESSION['status']="Inactive";
        }
    }
    else
    {
        $del_login="UPDATE tbl_item SET I_Status='Active' WHERE Item_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);

        $sql_fetch_subcat="SELECT * FROM tbl_subcat WHERE SubCat_id='$subcatid'";
        $sql_fetch_subcat_details=mysqli_query($conn,$sql_fetch_subcat);
        while($row=mysqli_fetch_assoc($sql_fetch_subcat_details))
        {
            header("refresh:0; url=Item_Staff.php?user_id=".$row['SubCat_id']);
            $_SESSION['status']="Active";
        }
    }
}


mysqli_close($conn);
?>