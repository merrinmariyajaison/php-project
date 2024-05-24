<?php
require_once('Connection.php');
session_start();
$name="";
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
  }

  $user_id=$_SESSION['user_id'];

  if($_SESSION['user_type']=="admin")
  {

  $sql_update_category="UPDATE tbl_subcat SET SubCat_Name='$name' WHERE SubCat_id='$user_id'";

  $sql_exe_category=mysqli_query($conn,$sql_update_category);

    if($sql_exe_category)
    {
        
        $sql_fetch="SELECT * FROM tbl_subcat WHERE SubCat_id='$user_id'";
        $sql_fetch_details=mysqli_query($conn,$sql_fetch);
        while($row=mysqli_fetch_assoc($sql_fetch_details))
        {
            header("refresh:0; url=Item.php?user_id=".$row['SubCat_id']);
            $_SESSION['status']="Update";
        }
       
      
    }
    else
    {
      header("refresh:0; url=Item.php?user_id=".$row['SubCat_id']);
            $_SESSION['status']="Noupdate";
    }
  }

else if($_SESSION['user_type']=="Staff")
{
    $user=$_SESSION['user'];

    $sql_update_category="UPDATE tbl_subcat SET SubCat_Name='$name' WHERE SubCat_id='$user_id'";

    $sql_exe_category=mysqli_query($conn,$sql_update_category);

    if($sql_exe_category)
    {
        
        $sql_fetch="SELECT * FROM tbl_subcat WHERE SubCat_id='$user_id'";
        $sql_fetch_details=mysqli_query($conn,$sql_fetch);
        while($row=mysqli_fetch_assoc($sql_fetch_details))
        {
            header("refresh:0; url=Item_Staff.php?user_id=".$row['SubCat_id']);
            $_SESSION['status']="Update";
        }
    }
    else
    {
      header("refresh:0; url=Item_Staff.php?user_id=".$row['SubCat_id']);
      $_SESSION['status']="Noupdate";
    }
}

  mysqli_close($conn);
?>