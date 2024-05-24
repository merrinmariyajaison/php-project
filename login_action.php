<?php
require_once('Connection.php');
session_start();

$username= $password="";
function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $username=test_input($_POST["username"]);
    $password=test_input($_POST["password"]);
  }

  $sql_login_check="SELECT * FROM tbl_login WHERE Username='$username' AND L_Status='Active'";
  $sql_login_cust="SELECT * FROM tbl_customer WHERE Username='$username'";
  $sql_cust_details=mysqli_query($conn,$sql_login_cust);
  $sql_login_staff="SELECT S_FName,S_LName FROM tbl_staff WHERE Username='$username'";
  $sql_staff_details=mysqli_query($conn,$sql_login_staff);

  if(empty(mysqli_fetch_array(mysqli_query($conn,$sql_login_check))))
  {
    header("refresh:0; url=Login.php");
    $_SESSION['status']="Nologin";
      exit;
  }

  $sql_cust_role=mysqli_fetch_assoc($sql_cust_details);
  $sql_staff_role=mysqli_fetch_assoc($sql_staff_details);

  while($row=mysqli_fetch_assoc(mysqli_query($conn,$sql_login_check)))
  {
    if($username==$row['Username'] && $password==$row['Password'])
    {
        if($row['User_Type']=="admin")
        {
          header("refresh:0; url=Staff.php"); 
          $_SESSION['status']="Login";
          $_SESSION['user_type']=$row['User_Type'];
          $_SESSION['user']=$row['Username'];
          exit;
        }

        else if($row['User_Type']=="Staff")
        {
            header("refresh:0; url=Profile_Staff.php");
            $_SESSION['status']="Login";
            $_SESSION['user_type']=$row['User_Type'];
            $_SESSION['user']=$row['Username'];
            $_SESSION['fname']=$sql_staff_role['S_FName'];
            $_SESSION['lname']=$sql_staff_role['S_LName'];
            exit;
        }

        else
        {
            header("refresh:0; url=Personal.php");
          
            $_SESSION['status']="Login";
            $_SESSION['user_type']=$row['User_Type'];
            $_SESSION['user']=$row['Username'];
            $_SESSION['Cust_id']=$sql_cust_role['Cust_id'];
            $_SESSION['fname']=$sql_cust_role['C_FName'];
            $_SESSION['lname']=$sql_cust_role['C_LName'];
            exit;
        }    
    }

    else
    {
      header("refresh:0; url=Login.php");
      $_SESSION['status']="Nologin";
        exit;
    }
  }