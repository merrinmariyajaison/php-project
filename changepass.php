<?php
require_once('Connection.php');
session_start();
if($_SESSION['user_type']=="admin")
{
 $newpassword= $repass="";
function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    
    $newpassword=test_input($_POST["newpassword"]);
    $repass=test_input($_POST["repass"]);
  }

  $username=$_SESSION['user'];


            if($newpassword==$repass)
      {
        $sql_update_login="UPDATE tbl_login SET Password='$newpassword' WHERE Username='$username'";
        $sql_exe_login=mysqli_query($conn,$sql_update_login);

        $sql_fetch="SELECT * FROM tbl_login WHERE Username='$username'";
        $sql_fetch_details=mysqli_query($conn,$sql_fetch);
        $row=mysqli_fetch_assoc($sql_fetch_details);

        if($sql_exe_login)
        {
            header("refresh:0; url=EditStaff.php?user=".$row['Username']);
            $_SESSION['status']="Change";
        }
      }

      else
      {
        $sql_fetch="SELECT * FROM tbl_login WHERE Username='$username'";
        $sql_fetch_details=mysqli_query($conn,$sql_fetch);
        $row=mysqli_fetch_assoc($sql_fetch_details);
        
        header("refresh:0; url=EditStaff.php?user=".$row['Username']);
            $_SESSION['status']="Nomatch";
      }
    }  
else if($_SESSION['user_type']=="customer")
{
    $oldpassword= $newpassword= $repass="";
function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $oldpassword=test_input($_POST["oldpassword"]);
    $newpassword=test_input($_POST["newpassword"]);
    $repass=test_input($_POST["repass"]);
  }

  $username=$_SESSION['user'];

  $oldpass=$_SESSION['pass'];

  if($oldpassword==$oldpass)
  {
      if($newpassword==$repass)
      {
        $sql_update_login="UPDATE tbl_login SET Password='$newpassword' WHERE Username='$username'";
        $sql_exe_login=mysqli_query($conn,$sql_update_login);
        if($sql_exe_login)
        {
                header("refresh:0; url=Personal.php");
                $_SESSION['status']="Change";
            
        }
      }
      else
      {
        header("refresh:0; url=Personal.php");
                $_SESSION['status']="Nomatch";
      }

    }

  else
      {
        header("refresh:0; url=Personal.php");
                $_SESSION['status']="Incorrect";
      }

}

else
{
  $oldpassword= $newpassword= $repass="";
function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $oldpassword=test_input($_POST["oldpassword"]);
    $newpassword=test_input($_POST["newpassword"]);
    $repass=test_input($_POST["repass"]);
  }

  $username=$_SESSION['user'];

  $oldpass=$_SESSION['pass'];

  if($oldpassword==$oldpass)
  {
      if($newpassword==$repass)
      {
        $sql_update_login="UPDATE tbl_login SET Password='$newpassword' WHERE Username='$username'";
        $sql_exe_login=mysqli_query($conn,$sql_update_login);
        if($sql_exe_login)
        {
                header("refresh:0; url=Profile_Staff.php");
                $_SESSION['status']="Change";
            
        }
      }
      else
      {
        header("refresh:0; url=Profile_Staff.php");
                $_SESSION['status']="Nomatch";
      }

    }

  else
      {
        header("refresh:0; url=Profile_Staff.php");
                $_SESSION['status']="Incorrect";
      } 
}
mysqli_close($conn);
?>