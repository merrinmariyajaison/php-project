<?php
require_once('Connection.php');
session_start();

$itemid= $tp= $ta= $qty= $price= $val= $subcatid="";
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
    $price=test_input($_POST["price"]);
    $val=test_input($_POST["val"]);
    $subcatid=test_input($_POST["subcat"]);
  }

  $tp=$price*$qty;

 
if(!empty($_SESSION['user_type']))
{
  if($_SESSION['user_type']=='customer')
{

  $custid=$_SESSION['Cust_id'];
  $sql_fetch="SELECT * FROM tbl_cartmaster WHERE Cust_id='$custid' AND Cart_Status='Order Pending'";
  $sql_fetch_details=mysqli_query($conn,$sql_fetch);
  $sql_cmast=mysqli_fetch_assoc($sql_fetch_details);


if(empty($custid))
{
    header("refresh:0; url=cart.php");
}

else if(empty($sql_cmast))
{

  $sql_fetch_item="SELECT * FROM tbl_item WHERE Item_id='$itemid'";
  $sql_item_details=mysqli_query($conn,$sql_fetch_item);
  $sql_item=mysqli_fetch_assoc($sql_item_details);
    $cart=0;
    $sql_cchild=0;
  if($sql_item['Stock']>$qty)
    {

    $sql_insert_cmast="INSERT INTO tbl_cartmaster (Cust_id, Tot_Amt, Cart_Status) VALUES ('$custid','$tp','Order Pending')";
    mysqli_query($conn,$sql_insert_cmast);

    $sql_fetch_cart="SELECT * FROM tbl_cartmaster WHERE Cust_id='$custid' AND Cart_Status='Order Pending'";
    $sql_cart_details=mysqli_query($conn,$sql_fetch_cart);
    $cart=mysqli_fetch_assoc($sql_cart_details);

    $cmastid=$cart['CMaster_id'];
    }
    if($cart!=0)
    {
        $sql_insert_cchild="INSERT INTO tbl_cartchild (CMaster_id, Item_id, Quantity, Tot_Price, CC_Status) VALUES ('$cmastid','$itemid','$qty', '$tp', 'Order Pending')";
        $sql_cchild=mysqli_query($conn,$sql_insert_cchild);
    }

    if($val==0)
    {
        
        
            if($sql_cchild!=0)
            {
                header("refresh:0; url=ItemList.php?user_id=".$subcatid);
                $_SESSION['status']="Add";
                exit;
            }

            else
            {
                header("refresh:0; url=ItemList.php?user_id=".$subcatid);
            $_SESSION['status']="Noadd";
            exit;
            }
    }

    else if($val==1)
    {
        if($sql_cchild!=0)
        {
            header("refresh:0; url=ItemDetails.php?user_id=".$itemid);
            $_SESSION['status']="Add";
            exit;
        }

        else
        {
            header("refresh:0; url=ItemDetails.php?user_id=".$itemid);
        $_SESSION['status']="Noadd";
        exit;
        }
    }

    else if($val==2)
    {
        if($sql_cchild!=0)
        {
            header("refresh:0; url=Order.php?user_id=".$cmastid);
            $_SESSION['status']="Add";
            exit;
        }

        else
        {
            header("refresh:0; url=Order.php?user_id=".$cmastid);
        $_SESSION['status']="Noadd";
        exit;
        }
    }
    
  }



  else if($sql_cmast['Cart_Status']=='Order Pending')
  {

   
    
    $ta=$sql_cmast['Tot_Amt']+$tp;
    
    $cmastid=$sql_cmast['CMaster_id'];

    $sql_cc="SELECT * FROM tbl_cartchild WHERE CMaster_id='$cmastid' AND Item_id='$itemid'";
    $sql_cc_details=mysqli_query($conn,$sql_cc);
    $sql_cc=mysqli_fetch_assoc($sql_cc_details);

    if($sql_cc)
    {
    $tp=$sql_cc['Tot_Price']+$tp;
    $qty=$sql_cc['Quantity']+$qty;
    }

    $sql_fetch_item="SELECT * FROM tbl_item WHERE Item_id='$itemid'";
    $sql_item_details=mysqli_query($conn,$sql_fetch_item);
    $sql_item=mysqli_fetch_assoc($sql_item_details);
    $cmast=0;
    $sql_cchild=0;
    if($sql_item['Stock']>$qty)
    {

    $sql_update_cmast="UPDATE tbl_cartmaster SET Tot_Amt='$ta' WHERE CMaster_id='$cmastid' AND Cart_Status='Order Pending'";
    $cmast=mysqli_query($conn,$sql_update_cmast);
    }

    if($cmast!=0)
    {

        if($sql_cc)
        {

            $sql_update_cc="UPDATE tbl_cartchild SET Tot_Price='$tp', Quantity='$qty' WHERE CMaster_id='$cmastid' AND Item_id='$itemid'";
            $sql_cchild=mysqli_query($conn,$sql_update_cc);
            
        }

        else
        {
            $sql_insert_cchild="INSERT INTO tbl_cartchild (CMaster_id, Item_id, Quantity, Tot_Price, CC_Status) VALUES ('$cmastid','$itemid','$qty', '$tp', 'Order Pending')";
            $sql_cchild=mysqli_query($conn,$sql_insert_cchild);
        }
    }

    if($val==0)
    {
        

            if($sql_cchild!=0)
            {
                header("refresh:0; url=ItemList.php?user_id=".$subcatid);
                $_SESSION['status']="Add";
                exit;
            }

            else
            {
                header("refresh:0; url=ItemList.php?user_id=".$subcatid);
            $_SESSION['status']="Noadd";
            exit;
            }
    }

    else if($val==1)
    {
        if($sql_cchild!=0)
        {
            header("refresh:0; url=ItemDetails.php?user_id=".$itemid);
            $_SESSION['status']="Add";
            exit;
        }

        else
        {
            header("refresh:0; url=ItemDetails.php?user_id=".$itemid);
        $_SESSION['status']="Noadd";
        exit;
        }
    }

    else if($val==2)
    {
        if($sql_cchild!=0)
        {
            header("refresh:0; url=Order.php?user_id=".$cmastid);
            $_SESSION['status']="Add";
            exit;
        }

        else
        {
            header("refresh:0; url=Order.php?user_id=".$cmastid);
        $_SESSION['status']="Noadd";
        exit;
        }
    }

  }
}
else
{
    header("refresh:0; url=Cart.php");
    $_SESSION['status']="Nocart";
}
}

else
{
    header("refresh:0; url=Cart.php");
    $_SESSION['status']="Nocart";
}
    mysqli_close($conn);
?>

