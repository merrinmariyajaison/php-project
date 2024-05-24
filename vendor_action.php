<?php
require_once('Connection.php');
session_start();

$user_id=mysqli_real_escape_string($conn,$_GET['user_id']);

  $sql_fetch="SELECT * FROM tbl_vendor WHERE Vendor_id='$user_id'";

  $sql_fetch_details=mysqli_query($conn,$sql_fetch);

  while($row=mysqli_fetch_assoc($sql_fetch_details))
  {
    
        $_SESSION['user_id']=$row['Vendor_id'];
        $_SESSION['stat']=$row['V_Status'];
        $_SESSION['name']=$row['V_Name'];
        $_SESSION['email']=$row['V_Email'];
        $_SESSION['phone']=$row['V_PhNo'];
        $_SESSION['bno']=$row['V_BNo'];
        $_SESSION['street']=$row['V_Street'];
        $_SESSION['dist']=$row['V_Dist'];
        $_SESSION['pin']=$row['V_pin'];
        
  }

  mysqli_close($conn);

?>
