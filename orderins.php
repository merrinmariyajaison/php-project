<?php
require_once('Connection.php');
session_start();

$cardid= $oid= $date= $iid= $qty= $cmid="";
function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $cardid=test_input($_POST["cardid"]);
    $cmid=test_input($_POST["cmid"]);
    $date=test_input($_POST["date"]);
  }


$sql_insert_order="INSERT INTO tbl_order (CMaster_id, O_Date) VALUES ('$cmid','$date')";

if(mysqli_query($conn,$sql_insert_order))
{
    $sql_fetch_order="SELECT * FROM tbl_order WHERE CMaster_id='$cmid'";
    $sql_cart_order=mysqli_query($conn,$sql_fetch_order);
    $order=mysqli_fetch_assoc($sql_cart_order);

    $oid=$order['Order_id'];

    if($order)
    {
        $sql_insert_pay="INSERT INTO tbl_payment (Order_id, Card_id, Pay_Status, Pay_Date) VALUES ('$oid','$cardid','Payment Successful','$date')";

        if(mysqli_query($conn,$sql_insert_pay))
        {
            $sql_update_cmast="UPDATE tbl_cartmaster SET Cart_Status='Order Placed' WHERE CMaster_id='$cmid'";

            if(mysqli_query($conn,$sql_update_cmast))
            {

                $sql_update_cc="UPDATE tbl_cartchild SET CC_Status='Order Placed' WHERE CMaster_id='$cmid'";
                if(mysqli_query($conn,$sql_update_cc))
                {
                $sql_fetch_cc="SELECT * FROM tbl_cartchild WHERE CMaster_id='$cmid'";
                $sql_cart_cc=mysqli_query($conn,$sql_fetch_cc);
                
                while($cc=mysqli_fetch_assoc($sql_cart_cc))
                {
                    $iid=$cc['Item_id'];
                    $qty=$cc['Quantity'];

                    $sql_update_item="UPDATE tbl_item SET Stock=Stock-'$qty' WHERE Item_id='$iid'";
                    $item=mysqli_query($conn,$sql_update_item);
                }
                if($item)
                {
                    header("refresh:0; url=Orders.php");
                    $_SESSION['status']="Add";
                    exit;
                }

                else
                {
                    header("refresh:0; url=PlaceOrder.php?cid=".$cmid);
                    $_SESSION['status']="Noadd";
                    exit;
                }
                }
            }

            else
            {
                header("refresh:0; url=PlaceOrder.php?cid=".$cmid);
                $_SESSION['status']="Noadd";
                exit;
            }
        }

        else
        {
            header("refresh:0; url=PlaceOrder.php?cid=".$cmid);
            $_SESSION['status']="Noadd";
            exit;
        }


    }

    else
    {
        header("refresh:0; url=PlaceOrder.php?cid=".$cmid);
        $_SESSION['status']="Noadd";
        exit;
    }
}

else
{
    header("refresh:0; url=PlaceOrder.php?cid=".$cmid);
    $_SESSION['status']="Noadd";
    exit;
}

mysqli_close($conn);
?>