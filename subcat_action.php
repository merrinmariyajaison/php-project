<?php
require_once('Connection.php');
session_start();

$user_id=mysqli_real_escape_string($conn,$_GET['user_id']);

  $sql_fetch="SELECT * FROM tbl_subcat WHERE SubCat_id='$user_id'";

  $sql_fetch_details=mysqli_query($conn,$sql_fetch);

  while($row=mysqli_fetch_assoc($sql_fetch_details))
  {
    
        $_SESSION['user_id']=$row['SubCat_id'];
        $_SESSION['name']=$row['SubCat_Name'];
        $_SESSION['stat']=$row['SubCat_Status'];
        
  }


?>
