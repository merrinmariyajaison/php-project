<?php
require_once('Connection.php');
session_start();

$username=$_SESSION['user'];

  $sql_login="SELECT * FROM tbl_login WHERE username='$username'";

  $sql_login_execute=mysqli_query($conn,$sql_login);

  $sql_fetch="SELECT * FROM tbl_customer WHERE username='$username'";

  $sql_fetch_details=mysqli_query($conn,$sql_fetch);

  $sql_fetch_2=mysqli_fetch_assoc($sql_fetch_details);

  while($row=mysqli_fetch_assoc($sql_login_execute))
  {
    $_SESSION['user']=$row['Username'];
    $_SESSION['pass']=$row['Password'];
    $_SESSION['stat']=$row['L_Status'];
    $_SESSION['fname']=$sql_fetch_2['C_FName'];
    $_SESSION['lname']=$sql_fetch_2['C_LName'];
        $_SESSION['user_id']=$sql_fetch_2['Cust_id'];
        // $_SESSION['mname']=$sql_fetch_2['C_MName'];
        $_SESSION['phone']=$sql_fetch_2['C_PhNo'];
        $_SESSION['house']=$sql_fetch_2['C_HNo'];
        $_SESSION['street']=$sql_fetch_2['C_Street'];
        $_SESSION['dist']=$sql_fetch_2['C_Dist'];
        $_SESSION['pin']=$sql_fetch_2['C_pin'];
  }

  mysqli_close($conn);
?>