<?php 
 
// Load the database configuration file 
require_once('connection.php');
session_start(); 

$from=mysqli_real_escape_string($conn,$_GET['from']);

$to=mysqli_real_escape_string($conn,$_GET['to']);

$op=mysqli_real_escape_string($conn,$_GET['op']);

// Fetch records from database 
if($op=="All")
  {
  $sql="SELECT * FROM tbl_order WHERE Order_id IN (SELECT Order_id FROM tbl_payment WHERE Pay_Date BETWEEN '$from' AND '$to') ORDER BY Order_id DESC";
  $query=mysqli_query($conn,$sql);
  }

  else if($op=="Placed / Successful")
  {
    $sql="SELECT * FROM tbl_order WHERE Order_id IN (SELECT Order_id FROM tbl_payment WHERE Pay_Status='Payment Successful' AND Pay_Date BETWEEN '$from' AND '$to') ORDER BY Order_id DESC";
    $query=mysqli_query($conn,$sql);
  }

  else if($op=="Cancelled / Refunded")
  {
    $sql="SELECT * FROM tbl_order WHERE Order_id IN (SELECT Order_id FROM tbl_payment WHERE Pay_Status='Payment Refunded' AND Pay_Date BETWEEN '$from' AND '$to') ORDER BY Order_id DESC";
    $query=mysqli_query($conn,$sql);
  }
 
if($query){ 
    $delimiter = ","; 
    $filename = "sales-data" . date('Y-m-d') . ".csv"; 

    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 

    // Set column headers 
    $fields = array('Order Id', 'Customer', 'Payment ID', 'Total Amount', 'Order Status', 'Payment Status','Date'); 
    fputcsv($f, $fields, $delimiter); 

    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 

        $oid=$row['Order_id'];
        $sql_fetch_pay="SELECT * FROM tbl_payment WHERE Order_id='$oid'";
        $sql_exe_pay=mysqli_query($conn,$sql_fetch_pay);
        $pay=mysqli_fetch_array($sql_exe_pay);

        $cmid=$row['CMaster_id'];
        $sql_fetch_cm="SELECT * FROM tbl_cartmaster WHERE CMaster_id='$cmid'";
        $sql_exe_cm=mysqli_query($conn,$sql_fetch_cm);
        $cm=mysqli_fetch_array($sql_exe_cm);

        $cid=$cm['Cust_id'];
        $sql_fetch_cust="SELECT * FROM tbl_customer WHERE Cust_id='$cid'";
        $sql_exe_cust=mysqli_query($conn,$sql_fetch_cust);
        $cust=mysqli_fetch_array($sql_exe_cust);

        $lineData = array($row['Order_id'], $cust['C_LName'], $pay['Pay_id'],  $cm['Tot_Amt'], $cm['Cart_Status'], $pay['Pay_Status'], $pay['Pay_Status'] ); 
        fputcsv($f, $lineData, $delimiter); 
    } 

    // Move back to beginning of file 
    fseek($f, 0); 

    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>