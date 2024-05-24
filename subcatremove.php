<?php
require_once('Connection.php');
session_start();

$catid=$_SESSION['user_id'];

$user_id=mysqli_real_escape_string($conn,$_GET['user_id']);

$sql_fetch="SELECT * FROM tbl_subcat WHERE SubCat_id='$user_id'";
$sql_fetch_details=mysqli_query($conn,$sql_fetch);
$subcat=mysqli_fetch_assoc($sql_fetch_details);

$sid=$subcat['SubCat_id'];

if($_SESSION['user_type']=="admin")
{
    if($subcat['SubCat_Status']=='Active')
    {
        $del_login="UPDATE tbl_subcat SET SubCat_Status='Inactive' WHERE SubCat_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);

        $del_item="UPDATE tbl_item SET I_Status='Inactive' WHERE SubCat_id='$sid'";
        $del_item_exe=mysqli_query($conn,$del_item);

        $sql_fetch_cat="SELECT * FROM tbl_category WHERE Cat_id='$catid'";
        $sql_fetch_cat_details=mysqli_query($conn,$sql_fetch_cat);
        while($row=mysqli_fetch_assoc($sql_fetch_cat_details))
        {
            header("refresh:0; url=SubCategory.php?user_id=".$row['Cat_id']);
            $_SESSION['status']="Inactive";
        }
    }
    else
    {
        $del_login="UPDATE tbl_subcat SET SubCat_Status='Active' WHERE SubCat_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);

        $sql_fetch_cat="SELECT * FROM tbl_category WHERE Cat_id='$catid'";
        $sql_fetch_cat_details=mysqli_query($conn,$sql_fetch_cat);
        while($row=mysqli_fetch_assoc($sql_fetch_cat_details))
        {
            header("refresh:0; url=SubCategory.php?user_id=".$row['Cat_id']);
            $_SESSION['status']="Active";
        }
    }
}

else if($_SESSION['user_type']=="Staff")
{
    if($subcat['SubCat_Status']=='Active')
    {
        $del_login="UPDATE tbl_subcat SET SubCat_Status='Inactive' WHERE SubCat_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);

        $del_item="UPDATE tbl_item SET I_Status='Inactive' WHERE SubCat_id='$sid'";
        $del_item_exe=mysqli_query($conn,$del_item);

        $sql_fetch_cat="SELECT * FROM tbl_category WHERE Cat_id='$catid'";
        $sql_fetch_cat_details=mysqli_query($conn,$sql_fetch_cat);
        while($row=mysqli_fetch_assoc($sql_fetch_cat_details))
        {
            header("refresh:0; url=SubCat_Staff.php?user_id=".$row['Cat_id']);
            $_SESSION['status']="Inactive";
        }
    }
    else
    {
        $del_login="UPDATE tbl_subcat SET SubCat_Status='Active' WHERE SubCat_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);

        $sql_fetch_cat="SELECT * FROM tbl_category WHERE Cat_id='$catid'";
        $sql_fetch_cat_details=mysqli_query($conn,$sql_fetch_cat);
        while($row=mysqli_fetch_assoc($sql_fetch_cat_details))
        {
            header("refresh:0; url=SubCat_Staff.php?user_id=".$row['Cat_id']);
            $_SESSION['status']="Active";
        }
    }
}


mysqli_close($conn);
?>