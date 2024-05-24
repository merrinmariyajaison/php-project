<?php
require_once('Connection.php');
session_start();

$itemid= $tp= $ta= $sp= $qty= $cmid= $ccid="";
function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $itemid=test_input($_POST["item"]);
    $qty=test_input($_POST["qty"]);
    $sp=test_input($_POST["sp"]);
    $tp=test_input($_POST["tp"]);
    $ta=test_input($_POST["ta"]);
    $ccid=test_input($_POST["ccid"]);
    $cmid=test_input($_POST["cmid"]);
    
  }

  $ta=$ta-$tp;

  $tp=$qty*$sp;

  $ta=$ta+$tp;

  if($_SESSION['user_type']=='customer')
{

  $sql_fetch_item="SELECT * FROM tbl_item WHERE Item_id='$itemid'";
  $sql_item_details=mysqli_query($conn,$sql_fetch_item);
  $sql_item=mysqli_fetch_assoc($sql_item_details);

  if($sql_item['Stock']>$qty)
  {

  $sql_update_cc="UPDATE tbl_cartchild SET Tot_Price='$tp', Quantity='$qty' WHERE CChild_id='$ccid' AND Item_id='$itemid'";
  $sql_cchild=mysqli_query($conn,$sql_update_cc);
  }
  
  if($sql_cchild)
  {

  $sql_update_cm="UPDATE tbl_cartmaster SET Tot_Amt='$ta' WHERE CMaster_id='$cmid' AND Cart_Status='Order Pending'";
  $sql_cm=mysqli_query($conn,$sql_update_cm);
  }

  if($sql_cm)
  {
    header('Location: Cart.php');
    $_SESSION['status']="Add";
  }

  else
  {
    header('Location: Cart.php');
    $_SESSION['status']="Noadd";
  }
}

else
{
  header("refresh:0; url=Cart.php");
    $_SESSION['status']="Nocart";
}
  mysqli_close($conn);
  ?>