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
    $val=$_POST["val"];
    if($val==2)
    {
      $img=addslashes(file_get_contents($_FILES["img"]["tmp_name"]));
    }
  }

  $user_id=$_SESSION['user_id'];

  if($_SESSION['user_type']=="admin")
  {

    if($val==2)
    {
      $sql_update_item="UPDATE tbl_item SET Item_Name='$name', Description='$dsc', Selling_Price='$price',brand_name='$brand', Stock='$stock', Image='$img'  WHERE Item_id='$user_id'";
    }
    else
    {
      $sql_update_item="UPDATE tbl_item SET Item_Name='$name', Description='$dsc', Selling_Price='$price',brand_name='$brand', Stock='$stock'  WHERE Item_id='$user_id'";
    }
  $sql_exe_item=mysqli_query($conn,$sql_update_item);

    if($sql_exe_item)
    {
        
        $sql_fetch="SELECT * FROM tbl_item WHERE Item_id='$user_id'";
        $sql_fetch_details=mysqli_query($conn,$sql_fetch);
        while($row=mysqli_fetch_assoc($sql_fetch_details))
        {
            header("refresh:0; url=Item.php?user_id=".$row['SubCat_id']);
            $_SESSION['status']="Update";
        }
       
      
    }
    else
    {
      header("refresh:0; url=Item.php?user_id=".$row['SubCat_id']);
            $_SESSION['status']="Noupdate";
    }
  }

else if($_SESSION['user_type']=="Staff")
{


  if($val==2)
  {
    $sql_update_item="UPDATE tbl_item SET Item_Name='$name', Description='$dsc', Selling_Price='$price',brand_name='$brand', Stock='$stock', Image='$img'  WHERE Item_id='$user_id'";
  }
  else
  {
    $sql_update_item="UPDATE tbl_item SET Item_Name='$name', Description='$dsc', Selling_Price='$price', brand_name='$brand', Stock='$stock'  WHERE Item_id='$user_id'";
  }

    $sql_exe_item=mysqli_query($conn,$sql_update_item);

    if($sql_exe_item)
    {
        
        $sql_fetch="SELECT * FROM tbl_item WHERE Item_id='$user_id'";
        $sql_fetch_details=mysqli_query($conn,$sql_fetch);
        while($row=mysqli_fetch_assoc($sql_fetch_details))
        {
            header("refresh:0; url=Item_Staff.php?user_id=".$row['SubCat_id']);
            $_SESSION['status']="Update";
        }
    }
    else
    {
      header("refresh:0; url=Item_Staff.php?user_id=".$row['SubCat_id']);
      $_SESSION['status']="Noupdate";
    }
}

  mysqli_close($conn);
?>