<?php
require_once('Connection.php');
session_start();

$user_id=mysqli_real_escape_string($conn,$_GET['user_id']);

  $sql_fetch="SELECT * FROM tbl_category WHERE Cat_id='$user_id'";

  $sql_fetch_details=mysqli_query($conn,$sql_fetch);

  while($row=mysqli_fetch_assoc($sql_fetch_details))
  {
    
        $_SESSION['user_id']=$row['Cat_id'];
        $_SESSION['name']=$row['Cat_Name'];
        $_SESSION['stat']=$row['Cat_Status'];
        
  }


?>
