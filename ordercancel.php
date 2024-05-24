<?php
require_once('Connection.php');
session_start();
$cid=mysqli_real_escape_string($conn,$_GET['cid']);

$sql_update_cc="UPDATE tbl_cartchild SET CC_Status='Cancelled, Refunded' WHERE CChild_id='$cid'";
if(mysqli_query($conn,$sql_update_cc))
{
    $sql_fetch_cc="SELECT * FROM tbl_cartchild WHERE CChild_id='$cid'";
    $sql_exe_cc=mysqli_query($conn,$sql_fetch_cc);
    $cc=mysqli_fetch_array($sql_exe_cc);

    $cmid=$cc['CMaster_id'];

    $iid=$cc['Item_id'];

    $qty=$cc['Quantity'];

    $tp=$cc['Tot_Price'];

    $sql_update_cm="UPDATE tbl_cartmaster SET Tot_Amt=Tot_Amt-'$tp' WHERE CMaster_id='$cmid'";
    $update_cm=mysqli_query($conn,$sql_update_cm);

    $sql_update_item="UPDATE tbl_item SET Stock=Stock+'$qty' WHERE Item_id='$iid'";
    $update_item=mysqli_query($conn,$sql_update_item);

    if($update_cm && $update_item)
    {
        $sql_fetch_cm="SELECT * FROM tbl_cartmaster WHERE CMaster_id='$cmid'";
        $sql_exe_cm=mysqli_query($conn,$sql_fetch_cm);
        $cm=mysqli_fetch_array($sql_exe_cm);

        if($cm['Tot_Amt']==0)
        {
            $sql_updatecm="UPDATE tbl_cartmaster SET Cart_Status='Order Cancelled' WHERE CMaster_id='$cmid'";
            if(mysqli_query($conn,$sql_updatecm))
            {
            $sql_fetch_order="SELECT * FROM tbl_order WHERE CMaster_id='$cmid'";
            $sql_cart_order=mysqli_query($conn,$sql_fetch_order);
            $order=mysqli_fetch_assoc($sql_cart_order);

            $oid=$order['Order_id'];
            
            $sql_update_pay="UPDATE tbl_payment SET Pay_Status='Payment Refunded', Pay_Date=NOW() WHERE Order_id='$oid'";
            if(mysqli_query($conn,$sql_update_pay))
            {
                header('Location: Orders.php');
                $_SESSION['status']="Cancelled";
            }

            else
            {
                header('Location: Orders.php');
                $_SESSION['status']="NoCancel";
            }
        }
        else
            {
                header('Location: Orders.php');
                $_SESSION['status']="Cancelled";
            }
        }

        else
            {
                header('Location: Orders.php');
                $_SESSION['status']="Cancelled";
            }
    }

    else
            {
                header('Location: Orders.php');
                $_SESSION['status']="NoCancel";
            }

}

else
    {
        header('Location: Orders.php');
        $_SESSION['status']="NoCancel";
    }

    mysqli_close($conn);
    ?>