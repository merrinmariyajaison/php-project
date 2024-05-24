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

  if($_SESSION['user_type']=="admin")
  {
    $sql_insert_category="INSERT INTO tbl_category (Cat_Name, Cat_Status) VALUES ('$name','Active')";

        if(mysqli_query($conn,$sql_insert_category))
        {
            header("Location: Category.php");
            $_SESSION['status']="Add";
            exit;
        }

        else
        {
          header("Location: Category.php");
          $_SESSION['status']="Noadd";
        }
  }

  else if($_SESSION['user_type']=="Staff")
{
    $sql_insert_category="INSERT INTO tbl_category (Cat_Name,Cat_Status) VALUES ('$name','Active')";

        if(mysqli_query($conn,$sql_insert_category))
        {
            header("Location: Category_Staff.php");
            $_SESSION['status']="Add";
            exit;
        }

        else
        {
          header("Location: Category_Staff.php");
          $_SESSION['status']="Noadd";
        }
  }

  mysqli_close($conn);
?>