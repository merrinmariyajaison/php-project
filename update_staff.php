<?php
require_once('Connection.php');
session_start();
$username= $firstname= $lastname=$username= $phone= $housename= $street= $district= $zip="";
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

  $sql_update_staff="UPDATE tbl_staff SET Username='$username',S_FName='$firstname',S_LName='$lastname',S_PhNo='$phone',S_HNo='$housename',S_Street='$street',S_Dist='$district',S_pin='$zip' WHERE Username='$old_username'";

  $sql_exe_login=mysqli_query($conn,$sql_update_login);

  $sql_exe_staff=mysqli_query($conn,$sql_update_staff);

  if($_SESSION['user_type']=="admin")
{

  if($sql_exe_login)
  {
    if($sql_exe_staff)
    {
        
        $sql_fetch="SELECT * FROM tbl_staff WHERE Username='$username'";
        $sql_fetch_details=mysqli_query($conn,$sql_fetch);
        while($row=mysqli_fetch_assoc($sql_fetch_details))
        {
            header("refresh:0; url=EditStaff.php?user=".$row['Username']);
            $_SESSION['status']="Update";
        }
    }
    else
    {
      header("refresh:0; url=EditStaff.php?user=".$row['Username']);
            $_SESSION['status']="Noupdate";
    }
  }
  else
    {
      header("refresh:0; url=EditStaff.php?user=".$row['Username']);
            $_SESSION['status']="Noupdate";
    }
}

else if($_SESSION['user_type']=="Staff")
{
  if($sql_exe_login)
  {
    if($sql_exe_staff)
    {
            header("refresh:0; url=Profile_Staff.php");
            $_SESSION['status']="Update";
    }
    else
    {
      header("refresh:0; url=Profile_Staff.php");
            $_SESSION['status']="Noupdate";
    }
  }
  else
    {
      header("refresh:0; url=Profile_Staff.php");
            $_SESSION['status']="Noupdate";
    }
}

  mysqli_close($conn);
?>