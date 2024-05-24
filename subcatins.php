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
  $sql_insert_subcat="INSERT INTO tbl_subcat (Cat_id, SubCat_Name, SubCat_Status) VALUES ('$user_id','$name', 'Active')";

        if(mysqli_query($conn,$sql_insert_subcat))
        {
            $sql_fetch="SELECT * FROM tbl_category WHERE Cat_id='$user_id'";
            $sql_fetch_details=mysqli_query($conn,$sql_fetch);
            while($row=mysqli_fetch_assoc($sql_fetch_details))
            {
                header("refresh:0; url=SubCategory.php?user_id=".$row['Cat_id']);
                $_SESSION['status']="Add";
            }
        }

        else
        {
            $sql_fetch="SELECT * FROM tbl_category WHERE Cat_id='$user_id'";
            $sql_fetch_details=mysqli_query($conn,$sql_fetch);
            while($row=mysqli_fetch_assoc($sql_fetch_details))
            {
                header("refresh:0; url=SubCategory.php?user_id=".$row['Cat_id']);
                $_SESSION['status']="Noadd";
            }
        }
  }

  else if($_SESSION['user_type']=="Staff")
{
    $sql_insert_subcat="INSERT INTO tbl_subcat (Cat_id, SubCat_Name, SubCat_Status) VALUES ('$user_id','$name',''Active)";

        if(mysqli_query($conn,$sql_insert_subcat))
        {
            $sql_fetch="SELECT * FROM tbl_category WHERE Cat_id='$user_id'";
            $sql_fetch_details=mysqli_query($conn,$sql_fetch);
            while($row=mysqli_fetch_assoc($sql_fetch_details))
            {
                header("refresh:0; url=SubCat_Staff.php?user_id=".$row['Cat_id']);
                $_SESSION['status']="Add";
            }
        }

        else
        {
            $sql_fetch="SELECT * FROM tbl_category WHERE Cat_id='$user_id'";
            $sql_fetch_details=mysqli_query($conn,$sql_fetch);
            while($row=mysqli_fetch_assoc($sql_fetch_details))
            {
                header("refresh:0; url=SubCat_Staff.php?user_id=".$row['Cat_id']);
                $_SESSION['status']="Noadd";
            }
        }
  }

  mysqli_close($conn);
?>