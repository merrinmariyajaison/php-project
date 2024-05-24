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
    header("Location: AddStaff.php");
    $_SESSION['status']="Nomatch";
      exit;
  }

  $sql_insert_login="INSERT INTO tbl_login (Username, Password, User_type, L_Status) VALUES ('$username', '$password', 'Staff', 'Active')";

  $sql_insert_staff="INSERT INTO tbl_staff (Username,S_FName,S_LName,S_PhNo,S_HNo,S_Street,S_Dist,S_pin) VALUES ('$username', '$firstname', '$lastname', '$phone', '$housename', '$street', '$district', '$zip')";

  $sql_get_login="SELECT Username FROM tbl_login WHERE Username='$username'";

  if(mysqli_num_rows(mysqli_query($conn,$sql_get_login)))
  {
    echo "User already exists! ";
    exit;
  }

  else
  {
    if(mysqli_query($conn,$sql_insert_login))
    {
        
        if(mysqli_query($conn,$sql_insert_staff))
        {
            header("Location: Staff.php");
            $_SESSION['status']="Add";
            $_SESSION['fname']=$firstname;
            $_SESSION['lname']=$lastname;
            $_SESSION['user']=$username;
            exit;
        }

        else
        {
          header("Location: Staff.php");
          $_SESSION['status']="Noadd";
        }
    }
  }
  mysqli_close($conn);
?>