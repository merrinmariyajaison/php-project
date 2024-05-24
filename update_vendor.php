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

  $user_id=$_SESSION['user_id'];

  if($_SESSION['user_type']=="admin")
  {

  $sql_update_vendor="UPDATE tbl_vendor SET Staff_id='0', V_Email='$email',V_Name='$name',V_PhNo='$phone',V_BNo='$bno',V_Street='$street',V_Dist='$district',V_pin='$zip' WHERE Vendor_id='$user_id'";

  $sql_exe_vendor=mysqli_query($conn,$sql_update_vendor);

    if($sql_exe_vendor)
    {
        
        $sql_fetch="SELECT * FROM tbl_vendor WHERE Vendor_id='$user_id'";
        $sql_fetch_details=mysqli_query($conn,$sql_fetch);
        while($row=mysqli_fetch_assoc($sql_fetch_details))
        {
            header("refresh:0; url=EditVendor.php?user_id=".$row['Vendor_id']);
            $_SESSION['status']="Update";
        }
       
      
    }
    else
    {
      header("refresh:0; url=EditVendor.php?user_id=".$row['Vendor_id']);
            $_SESSION['status']="Noupdate";
    }
  }

else if($_SESSION['user_type']=="Staff")
{
    $user=$_SESSION['user'];
    $sql_fetch="SELECT * FROM tbl_staff WHERE Username='$user'";
    $sql_fetch_details=mysqli_query($conn,$sql_fetch);
    $row=mysqli_fetch_assoc($sql_fetch_details);
    $staff_id=$row['Staff_id'];

    $sql_update_vendor="UPDATE tbl_vendor SET Staff_id='$staff_id', V_Email='$email',V_Name='$name',V_PhNo='$phone',V_BNo='$bno',V_Street='$street',V_Dist='$district',V_pin='$zip' WHERE Vendor_id='$user_id'";

    $sql_exe_vendor=mysqli_query($conn,$sql_update_vendor);

    if($sql_exe_vendor)
    {
        
        $sql_fetch="SELECT * FROM tbl_vendor WHERE Vendor_id='$user_id'";
        $sql_fetch_details=mysqli_query($conn,$sql_fetch);
        while($row=mysqli_fetch_assoc($sql_fetch_details))
        {
            header("refresh:0; url=S_EditVendor.php?user_id=".$row['Vendor_id']);
            $_SESSION['status']="Update";
        }
    }
    else
    {
      header("refresh:0; url=S_EditVendor.php?user_id=".$row['Vendor_id']);
      $_SESSION['status']="Noupdate";
    }
}

  mysqli_close($conn);
?>