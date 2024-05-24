<?php
require_once('Connection.php');
session_start();

if($_SESSION['user_type']=="admin")
{
$user=mysqli_real_escape_string($conn,$_GET['user']);

$username=$_SESSION['user'];

  $sql_login="SELECT * FROM tbl_login WHERE Username='$user'";

  $sql_login_execute=mysqli_query($conn,$sql_login);

  $sql_fetch="SELECT * FROM tbl_staff WHERE Username='$user'";

  $sql_fetch_details=mysqli_query($conn,$sql_fetch);

  $sql_fetch_2=mysqli_fetch_assoc($sql_fetch_details);

  while($row=mysqli_fetch_assoc($sql_login_execute))
  {
    $_SESSION['user']=$row['Username'];
    $_SESSION['pass']=$row['Password'];
    $_SESSION['stat']=$row['L_Status'];
    $_SESSION['fname']=$sql_fetch_2['S_FName'];
    $_SESSION['lname']=$sql_fetch_2['S_LName'];
        $_SESSION['user_id']=$sql_fetch_2['Staff_id'];
        // $_SESSION['mname']=$sql_fetch_2['S_MName'];
        $_SESSION['phone']=$sql_fetch_2['S_PhNo'];
        $_SESSION['house']=$sql_fetch_2['S_HNo'];
        $_SESSION['street']=$sql_fetch_2['S_Street'];
        $_SESSION['dist']=$sql_fetch_2['S_Dist'];
        $_SESSION['pin']=$sql_fetch_2['S_Pin'];
        
  }

  mysqli_close($conn);

}

else if($_SESSION['user_type']=="Staff")
{
  $username=$_SESSION['user'];

  $sql_login="SELECT * FROM tbl_login WHERE Username='$username'";

  $sql_login_execute=mysqli_query($conn,$sql_login);

  $sql_fetch="SELECT * FROM tbl_staff WHERE Username='$username'";

  $sql_fetch_details=mysqli_query($conn,$sql_fetch);

  $sql_fetch_2=mysqli_fetch_assoc($sql_fetch_details);

  while($row=mysqli_fetch_assoc($sql_login_execute))
  {
    $_SESSION['user']=$row['Username'];
    $_SESSION['pass']=$row['Password'];
    $_SESSION['fname']=$sql_fetch_2['S_FName'];
    $_SESSION['lname']=$sql_fetch_2['S_LName'];
        $_SESSION['user_id']=$sql_fetch_2['Staff_id'];
        // $_SESSION['mname']=$sql_fetch_2['S_MName'];
        $_SESSION['phone']=$sql_fetch_2['S_PhNo'];
        $_SESSION['house']=$sql_fetch_2['S_HNo'];
        $_SESSION['street']=$sql_fetch_2['S_Street'];
        $_SESSION['dist']=$sql_fetch_2['S_Dist'];
        $_SESSION['pin']=$sql_fetch_2['S_Pin'];
        
  }

  mysqli_close($conn);

}

?>
