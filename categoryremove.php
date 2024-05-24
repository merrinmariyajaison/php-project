<?php
require_once('Connection.php');
session_start();
$user_id=mysqli_real_escape_string($conn,$_GET['user_id']);


$sql_fetch="SELECT * FROM tbl_category WHERE Cat_id='$user_id'";
$sql_fetch_details=mysqli_query($conn,$sql_fetch);
$cat=mysqli_fetch_assoc($sql_fetch_details);

$cid=$cat['Cat_id'];

$sql_fetch_subcat="SELECT * FROM tbl_subcat WHERE Cat_id='$cid'";
$sql_fetch_details_subcat=mysqli_query($conn,$sql_fetch_subcat);


if($_SESSION['user_type']=="admin")
{
    if($cat['Cat_Status']=='Active')
    {
        $del_login="UPDATE tbl_category SET Cat_Status='Inactive' WHERE Cat_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);

        $del_subcat="UPDATE tbl_subcat SET SubCat_Status='Inactive' WHERE Cat_id='$cid'";
        $del_subcat_exe=mysqli_query($conn,$del_subcat);

        while($subcat=mysqli_fetch_assoc($sql_fetch_details_subcat))
        {
        $sid=$subcat['SubCat_id'];

        $del_item="UPDATE tbl_item SET I_Status='Inactive' WHERE SubCat_id='$sid'";
        $del_item_exe=mysqli_query($conn,$del_item);
        }

        header('Location: Category.php');
        $_SESSION['status']="Inactive";
    }
    else
    {
        $del_login="UPDATE tbl_category SET Cat_Status='Active' WHERE Cat_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);

        header('Location: Category.php');
        $_SESSION['status']="Active";
    }
}

else if($_SESSION['user_type']=="Staff")
{
    if($cat['Cat_Status']=='Active')
    {
        $del_login="UPDATE tbl_category SET Cat_Status='Inactive' WHERE Cat_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);

        $del_subcat="UPDATE tbl_subcat SET SubCat_Status='Inactive' WHERE Cat_id='$cid'";
        $del_subcat_exe=mysqli_query($conn,$del_subcat);

        while($subcat=mysqli_fetch_assoc($sql_fetch_details_subcat))
        {
        $sid=$subcat['SubCat_id'];

        $del_item="UPDATE tbl_item SET I_Status='Inactive' WHERE SubCat_id='$sid'";
        $del_item_exe=mysqli_query($conn,$del_item);
        }

        header('Location: Category_Staff.php');
        $_SESSION['status']="Inactive";
    }
    else
    {
        $del_login="UPDATE tbl_category SET Cat_Status='Active' WHERE Cat_id='$user_id'";
        $del_login_exe=mysqli_query($conn,$del_login);

        header('Location: Category_Staff.php');
        $_SESSION['status']="Active";
    }
}

mysqli_close($conn);
?>