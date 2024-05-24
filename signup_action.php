<?php
require_once('Connection.php');
session_start();

$username= $firstname= $lastname= $phone= $housename= $street= $district= $zip= $password="";
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
    $password=test_input($_POST["password"]);
  }

  if($password!==$_POST["repass"])
  {
    header("Location: SignUp.php");
      $_SESSION['status']="PassNoMatch";
      exit;
  }

  $sql_insert_login="INSERT INTO tbl_login (Username, Password, User_type, L_Status) VALUES ('$username', '$password', 'customer', 'Active')";

  $sql_insert_customer="INSERT INTO tbl_customer (Username,C_FName,C_LName,C_PhNo,C_HNo,C_Street,C_Dist,C_pin) VALUES ('$username', '$firstname',  '$lastname', '$phone', '$housename', '$street', '$district', '$zip')";

  $sql_get_login="SELECT * FROM tbl_login WHERE Username='$username' AND L_Status='Active'";

  if(mysqli_num_rows(mysqli_query($conn,$sql_get_login)))
  {
    header("Location: SignUp.php");
    $_SESSION['status']="UserExist";
    exit;
  }

  else
  {
    if(mysqli_query($conn,$sql_insert_login))
    {
        
        if(mysqli_query($conn,$sql_insert_customer))
        {
            header("Location: Personal.php");
           
            $sql_login_cust="SELECT * FROM tbl_customer WHERE Username='$username'";
          $sql_cust_details=mysqli_query($conn,$sql_login_cust);
          $sql_cust_role=mysqli_fetch_assoc($sql_cust_details);
          $_SESSION['Cust_id']=$sql_cust_role['Cust_id'];
            $_SESSION['status']="Reg";
            $_SESSION['fname']=$firstname;
            $_SESSION['lname']=$lastname;
            $_SESSION['user']=$username;
            $_SESSION['user_type']="customer";
            exit;
        }

        else
        {
            echo mysqli_error($conn);
        }
    }
  }
  mysqli_close($conn);
?>