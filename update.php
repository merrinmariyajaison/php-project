<?php
require_once('Connection.php');
session_start();
$username= $firstname= $middlename= $lastname= $phone= $housename= $street= $district= $zip= "";
function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $firstname=test_input($_POST["fname"]);
    // $middlename=test_input($_POST["mname"]);
    $lastname=test_input($_POST["lname"]);
    $username=test_input($_POST["username"]);
    $phone=test_input($_POST["phone"]);
    $housename=test_input($_POST["house"]);
    $street=test_input($_POST["street"]);
    $district=test_input($_POST["district"]);
    $zip=test_input($_POST["zip"]);
  }

  $old_username=$_SESSION['user'];

  $sql_update_login="UPDATE tbl_login SET Username='$username' WHERE Username='$old_username'";

  $sql_update_customer="UPDATE tbl_customer SET Username='$username',C_FName='$firstname',C_LName='$lastname',C_PhNo='$phone',C_HNo='$housename',C_Street='$street',C_Dist='$district',C_pin='$zip' WHERE Username='$old_username'";

  $sql_exe_login=mysqli_query($conn,$sql_update_login);

  // $sql_exe_customer=mysqli_query($conn,$sql_update_customer);

  if($sql_exe_login)
  {
    if(mysqli_query($conn,$sql_update_customer))
    {
       header("refresh:0; url=Personal.php");
       $_SESSION['status']="Update";
    }
    else 
    {
      header("refresh:0; url=Personal.php");
      $_SESSION['status']="Noupdate";
    }
  
  }

 
  mysqli_close($conn);
?>