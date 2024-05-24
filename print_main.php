<?php

//DBMS connection
require_once('connection.php');
$count =1 ;
session_start();

$impdata = $_POST;




  // $from=date('2021-01-01'); $to=date('Y-m-d'); 
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if(isset($_GET['from'])){
    $from=mysqli_real_escape_string($conn,$_GET['from']);
  }
  if(isset($_GET['to'])){
    $to=mysqli_real_escape_string($conn,$_GET['to']);
  }
  
  
  
  
  $c=mysqli_real_escape_string($conn,$_GET['op']);
  
  
  $ta=mysqli_real_escape_string($conn,$_GET['ta']);

  // if(isset($_GET['from']) && isset($_GET['to'])){
  //   $from = test_input($_GET['from']);
  //   $to = test_input($_GET['to']);
  // }

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../styles/index.css" rel="stylesheet">
    <link href="../styles/control.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="Home.css" rel="stylesheet">
    <title>Report</title>
</head>

<body>
  <!--Navbar -->
  <!-- <nav class="navbar navbar-light sticky-top">
    <div class="container-fluid custom-nav-container">
      <a class="navbar-brand" href="/onlinemobile">
        <img class="logo-img" src="../assets/logo/logo.png" alt="" width="40" height="35">
      </a>
      <div class="contact mt-3" style="flex: 0.2;">
          <p><i class="bi bi-envelope"></i> bc@support.com </p>
        </div>
        <div class="contact mt-3">
          <p><i class="bi bi-geo-alt"></i> 12/11 Skylark, Ernakulam, Kerala </p>
        </div>
      
    </div>
  </nav> -->

  
  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <div class="container-fluid">
    
                <!-- Title and Dropdowns -->
                <!-- <div class="d-flex">
                <a class="navbar-brand " id="logo" href="/project">Plant Nursery.</a> -->

                <!-- Search Bar -->
                <div class="d-flex" style="width: 30%; margin-center;">
                <a class="navbar-brand " id="logo" href="/project">GLOWUP</a>
        
      <!-- Cart and Login -->
      
    </div>
  </nav>


  <!-- Main -->
  <section class="section-content overflow-hidden controlpanel-main">
      <div class="row">
          <main class="col-lg-12 p-5">
              

              <?php  if($ta == 'order'){ ?>
                <div class="d-flex justify-content-between align-items-center">
              <h2 class="fw-bold mb-4">Sales Report</h2>
              <button class="btn btn-primary" onclick="myPrint()">Print</button>
            </div>


              <div class="card">
                <table class="table mb-0">
                
                    <thead>
                          <tr>
                          <th>Sl. No.</th>
                          <th scope="col">Order ID</th>
                          <th scope="col">Order Date</th>
                          <th scope="col">Customer Name</th>
                          <th scope="col">Amount</th>
                          <th>Cart Status</th>
                          <th>Pay Status</th>
                          <th>Pay Date</th>
                          

                        </tr>
                    </thead>
            
                    <tbody>
                      
                      <?php   
                        
                        if($c=="All")
                        {
                        $sql_fetch_order="SELECT * FROM tbl_order WHERE Order_id IN (SELECT Order_id FROM tbl_payment WHERE Pay_Date BETWEEN '$from' AND '$to') ORDER BY Order_id DESC";
                        $sql_exe_order=mysqli_query($conn,$sql_fetch_order);
                        }
                      
                        else if($c=="Placed / Successful")
                        {
                          $sql_fetch_order="SELECT * FROM tbl_order WHERE Order_id IN (SELECT Order_id FROM tbl_payment WHERE Pay_Status='Payment Successful' AND Pay_Date BETWEEN '$from' AND '$to') ORDER BY Order_id DESC";
                          $sql_exe_order=mysqli_query($conn,$sql_fetch_order);
                        }
                      
                        else if($c=="Cancelled / Refunded")
                        {
                          $sql_fetch_order="SELECT * FROM tbl_order WHERE Order_id IN (SELECT Order_id FROM tbl_payment WHERE Pay_Status='Payment Refunded' AND Pay_Date BETWEEN '$from' AND '$to') ORDER BY Order_id DESC";
                          $sql_exe_order=mysqli_query($conn,$sql_fetch_order);
                        }
                        
                        while($row1=mysqli_fetch_assoc($sql_exe_order)){
                            $oid=$row1['Order_id'];
                            $sql_fetch_pay="SELECT * FROM tbl_payment WHERE Order_id='$oid'";
                            $sql_exe_pay=mysqli_query($conn,$sql_fetch_pay);
                            $pay=mysqli_fetch_array($sql_exe_pay);

                            $cmid=$row1['CMaster_id'];
                            $sql_fetch_cm="SELECT * FROM tbl_cartmaster WHERE CMaster_id='$cmid'";
                            $sql_exe_cm=mysqli_query($conn,$sql_fetch_cm);
                            $cm=mysqli_fetch_array($sql_exe_cm);

                            $cid=$cm['Cust_id'];
                            $sql_fetch_cust="SELECT * FROM tbl_customer WHERE Cust_id='$cid'";
                            $sql_exe_cust=mysqli_query($conn,$sql_fetch_cust);
                            $cust=mysqli_fetch_array($sql_exe_cust);
                          

                      ?>
                          <tr>
                          <th scope="row"><?php echo $count++; ?></th>
                            <th scope="row"><?php echo $oid;?></th>
                            <td><?php echo $row1['O_Date'];?></td>
                            <td><a style="text-decoration: none;" ><?php echo $cust['C_FName']; ?></a></td>
                            <td><?php echo $cm['Tot_Amt']; ?></td>
                            <td><?php echo $cm['Cart_Status']; ?></td>
                            <td><?php echo $pay['Pay_Status']; ?></td>
                            <td><?php echo $pay['Pay_Date']; ?></td>
                          
                          </tr>
                        <?php } ?>
                      </tbody>
                </table>
              </div>
              <?php } ?>
          </main>
      </div>
  </section>


  <!-- JS -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    function myPrint(){
      window.print();
    }
  </script>
 
</body>
</html>

