<?php
require_once('Connection.php');
session_start();

$name= $dsc= $price= $brand= $img= $stock="";
function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $name=test_input($_POST["name"]);
    $dsc=test_input($_POST["dsc"]);
    $price=test_input($_POST["price"]);
    $brand=test_input($_POST["brand"]);
    $stock=test_input($_POST["stock"]);
    $img=addslashes(file_get_contents($_FILES["img"]["tmp_name"]));
  }

  $user_id=$_SESSION['user_id'];

  if($_SESSION['user_type']=="admin")
  {
  $sql_insert_item="INSERT INTO tbl_item (SubCat_id, Item_Name, Description, Selling_Price, brand_name, Stock, Image, I_Status) VALUES ('$user_id','$name', '$dsc', '$price','$brand', '$stock', '$img', 'Active')";

        if(mysqli_query($conn,$sql_insert_item))
        {
            $sql_fetch="SELECT * FROM tbl_subcat WHERE SubCat_id='$user_id'";
            $sql_fetch_details=mysqli_query($conn,$sql_fetch);
            while($row=mysqli_fetch_assoc($sql_fetch_details))
            {
                header("refresh:0; url=Item.php?user_id=".$row['SubCat_id']);
                $_SESSION['status']="Add";
            }
        }

        else
        {
            $sql_fetch="SELECT * FROM tbl_Subcat WHERE SubCat_id='$user_id'";
            $sql_fetch_details=mysqli_query($conn,$sql_fetch);
            while($row=mysqli_fetch_assoc($sql_fetch_details))
            {
                header("refresh:0; url=Item.php?user_id=".$row['SubCat_id']);
                $_SESSION['status']="Noadd";
            }
        }
  }

  else if($_SESSION['user_type']=="Staff")
{
    $sql_insert_item="INSERT INTO tbl_item (SubCat_id, Item_Name, Description, Selling_Price, brand_name, Stock, Image, I_Status) VALUES ('$user_id','$name', '$dsc', '$price',' $brand', '$stock', '$img', 'Active')";

    if(mysqli_query($conn,$sql_insert_item))
    {
        $sql_fetch="SELECT * FROM tbl_subcat WHERE SubCat_id='$user_id'";
        $sql_fetch_details=mysqli_query($conn,$sql_fetch);
        while($row=mysqli_fetch_assoc($sql_fetch_details))
        {
                header("refresh:0; url=Item_Staff.php?user_id=".$row['SubCat_id']);
                $_SESSION['status']="Add";
            }
        }

        else
        {
            $sql_fetch="SELECT * FROM tbl_subcat WHERE SubCat_id='$user_id'";
            $sql_fetch_details=mysqli_query($conn,$sql_fetch);
            while($row=mysqli_fetch_assoc($sql_fetch_details))
            {
                header("refresh:0; url=Item_Staff.php?user_id=".$row['SubCat_id']);
                $_SESSION['status']="Noadd";
            }
        }
  }

  mysqli_close($conn);
?>