<?php
require_once('Connection.php');
session_start();

$user_id=mysqli_real_escape_string($conn,$_GET['user_id']);

  $sql_fetch="SELECT * FROM tbl_item WHERE Item_id='$user_id'";

  $sql_fetch_details=mysqli_query($conn,$sql_fetch);

  while($row=mysqli_fetch_assoc($sql_fetch_details))
  {
    
        $_SESSION['user_id']=$row['Item_id'];
        $_SESSION['id']=$row['SubCat_id'];
        $_SESSION['name']=$row['Item_Name'];
        $_SESSION['dsc']=$row['Description'];
        $_SESSION['sp']=$row['Selling_Price'];
        $_SESSION['brand']=$row['brand_name'];
        $_SESSION['stock']=$row['Stock'];
        $_SESSION['image']=$row['Image'];
        $_SESSION['stat']=$row['I_Status'];
        
  }


?>
