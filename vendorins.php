<?php
require_once('Connection.php');
session_start();

$email= $name= $phone= $bno= $street= $district= $zip="";
function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $name=test_input($_POST["name"]);
    $email=test_input($_POST["email"]);
    $phone=test_input($_POST["phone"]);
    $bno=test_input($_POST["bno"]);
    $street=test_input($_POST["street"]);
    $district=test_input($_POST["district"]);
    $zip=test_input($_POST["zip"]);
  }

  $username=$_SESSION['user'];

  if($_SESSION['user_type']=="admin")
  {
  $sql_insert_vendor="INSERT INTO tbl_vendor (Staff_id, V_Email,V_Name,V_PhNo,V_BNo,V_Street,V_Dist,V_pin,V_Status) VALUES ('0','$email','$name','$phone','$bno','$street','$district','$zip','Active')";

        if(mysqli_query($conn,$sql_insert_vendor))
        {
            header("Location: Vendor.php");
            $_SESSION['status']="Add";
            exit;
        }

        else
        {
          header("Location: Vendor.php");
          $_SESSION['status']="Noadd";
        }
  }

  else if($_SESSION['user_type']=="Staff")
{
    $sql_fetch="SELECT * FROM tbl_staff WHERE Username='$username'";
    $sql_fetch_details=mysqli_query($conn,$sql_fetch);
    $row=mysqli_fetch_assoc($sql_fetch_details);
    $staff_id=$row['Staff_id'];
    $sql_insert_vendor="INSERT INTO tbl_vendor (Staff_id, V_Email, V_Name, V_PhNo, V_BNo, V_Street, V_Dist, V_pin, V_Status) VALUES ('$staff_id','$email','$name','$phone','$bno','$street','$district','$zip','Active')";

        if(mysqli_query($conn,$sql_insert_vendor))
        {
            header("Location: Vendor_Staff.php");
            $_SESSION['status']="Add";
            exit;
        }

        else
        {
          header("Location: Vendor_Staff.php");
          $_SESSION['status']="Noadd";
        }
  }

  mysqli_close($conn);
?>