<?php
require_once('Connection.php');
session_start();

$num= $vid= $date= $iid= $cp= $p= $qty= $tp= $purmastid="";
$ta=0;
$sp=0;
function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $num=test_input($_POST["num"]);
    $vid=test_input($_POST["vid"]);
    $date=test_input($_POST["date"]);
  }

  $username=$_SESSION['user'];

  if($_SESSION['user_type']=="admin")
  {

  $sql_insert_purmast="INSERT INTO tbl_purmaster (Vendor_id, Staff_id, Tot_Amt, P_Date, P_Status) VALUES ('$vid','0','0','$date', 'Inactive')";
  if(mysqli_query($conn,$sql_insert_purmast))
  {

  $sql_fetch_purmast="SELECT * FROM tbl_purmaster WHERE P_Status='Inactive'";
  $sql_fetch_details_purmast=mysqli_query($conn,$sql_fetch_purmast);
  $purmast=mysqli_fetch_assoc($sql_fetch_details_purmast);
  $purmastid=$purmast['PMaster_id'];

  for($i=1;$i<=$num;$i++)
  {

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $iid=test_input($_POST["iid$i"]);
        $cp=test_input($_POST["cp$i"]);
        $p=test_input($_POST["p$i"]);
        $qty=test_input($_POST["qty$i"]);
    }

    $tp=$cp*$qty;
    $ta+=$tp;
$sp=$cp+(($cp*$p)/100);
    $sql_insert_purchild="INSERT INTO tbl_purchild (PMaster_id, Item_id, Cost_Price, Quantity, Tot_Price) VALUES ('$purmastid','$iid','$cp', '$qty', '$tp')";
    mysqli_query($conn,$sql_insert_purchild);

    $sql_update_item="UPDATE tbl_item SET Stock=Stock+'$qty' ,Selling_Price='$sp' WHERE Item_id='$iid'";
    mysqli_query($conn,$sql_update_item);
    }

  }

  $sql_update_purmast="UPDATE tbl_purmaster SET Tot_Amt='$ta', P_Status='Active' WHERE PMaster_id='$purmastid'";

        if(mysqli_query($conn,$sql_update_purmast))
        {
            header("Location: PurMaster.php");
            $_SESSION['status']="Add";
            exit;
        }

        else
        {
          header("Location: PurMaster.php");
          $_SESSION['status']="Noadd";
        }
  }

  else if($_SESSION['user_type']=="Staff")
{
    $sql_fetch="SELECT * FROM tbl_staff WHERE Username='$username'";
    $sql_fetch_details=mysqli_query($conn,$sql_fetch);
    $row=mysqli_fetch_assoc($sql_fetch_details);
    $staff_id=$row['Staff_id'];

    $sql_insert_purmast="INSERT INTO tbl_purmaster (Vendor_id, Staff_id, Tot_Amt, P_Date, P_Status) VALUES ('$vid','$staff_id','0','$date', 'Inactive')";
  if(mysqli_query($conn,$sql_insert_purmast))
  {

  $sql_fetch_purmast="SELECT * FROM tbl_purmaster WHERE P_Status='Inactive'";
  $sql_fetch_details_purmast=mysqli_query($conn,$sql_fetch_purmast);
  $purmast=mysqli_fetch_assoc($sql_fetch_details_purmast);
  $purmastid=$purmast['PMaster_id'];

  for($i=1;$i<=$num;$i++)
  {

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $iid=test_input($_POST["iid$i"]);
        $cp=test_input($_POST["cp$i"]);
        $p=test_input($_POST["p$i"]);
        $qty=test_input($_POST["qty$i"]);
    }

    $tp=$cp*$qty;
    $ta+=$tp;
    $sp=$cp+(($cp*$p)/100);
    $sql_insert_purchild="INSERT INTO tbl_purchild (PMaster_id, Item_id, Cost_Price, Quantity, Tot_Price) VALUES ('$purmastid','$iid','$cp', '$qty', '$tp')";
    mysqli_query($conn,$sql_insert_purchild);

    $sql_update_item="UPDATE tbl_item SET Stock=Stock+'$qty',Selling_Price='$sp'  WHERE Item_id='$iid'";
    mysqli_query($conn,$sql_update_item);
    }

  }

  $sql_update_purmast="UPDATE tbl_purmaster SET Tot_Amt='$ta', P_Status='Active' WHERE PMaster_id='$purmastid'";

        if(mysqli_query($conn,$sql_update_purmast))
        {
            header("Location: PurMaster_Staff.php");
            $_SESSION['status']="Add";
            exit;
        }

        else
        {
          header("Location: PurMaster_Staff.php");
          $_SESSION['status']="Noadd";
        }
  }

 

  

  mysqli_close($conn);
?>