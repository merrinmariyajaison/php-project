<?php
require_once('Connection.php');
session_start();

$cardnum= $name= $cardtype= $expdate="";
function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $cardnum=test_input($_POST["cardnum"]);
    $name=test_input($_POST["name"]);
    $cardtype=test_input($_POST["cardtype"]);
    $expdate=test_input($_POST["expdate"]);
  }

  echo($cardnum);
  echo($name);
  echo($cardtype);
  echo($expdate);

  $username=$_SESSION['user'];

  $custid=$_SESSION['user_id'];
  echo($custid);
  $sql_insert_card="INSERT INTO tbl_card (Cust_id, Card_No, Name, Card_Type, Exp_Date) VALUES ('$custid','$cardnum','$name','$cardtype','$expdate')";

        if(mysqli_query($conn,$sql_insert_card))
        {
            header("Location: Cards.php");
            $_SESSION['status']="Add";
            exit;
        }

        else
        {
          header("Location: Cards.php");
          $_SESSION['status']="Noadd";
          exit;
        }

    mysqli_close($conn);
?>