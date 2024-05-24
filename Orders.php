<?php
require_once('Connection.php');
session_start();

$custid=$_SESSION['user_id'];

$sql_fetch_cm="SELECT * FROM tbl_cartmaster WHERE Cust_id='$custid' AND (Cart_Status='Order Placed' OR Cart_Status='Order Cancelled') ORDER BY CMaster_id DESC";
$sql_exe_cm=mysqli_query($conn,$sql_fetch_cm);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GLOWUP | Order List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="Home.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>


<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <div class="container-fluid">
    
                <!-- Title and Dropdowns -->
                <!-- <div class="d-flex">
                <a class="navbar-brand " id="logo" href="/project">Plant Nursery.</a> -->

                <!-- Search Bar -->
                <form class="d-flex input-group col-md-10" style="width: 25%; margin-left: 15px;" action="SearchResult.php" method="POST">
                  <input class="form-control" id="searchbar" name="search" type="search" placeholder="Search "
                    aria-label="Search" required>
                  <button class="input-group-text" type="submit" id="searchbar"><i class="bi bi-search"></i></button>
                </form>
                <div class="d-flex" style="width: 30%; margin-center;">
                <a class="navbar-brand " id="logo" href="/project">GLOWUP</a>
        
                <ul class="navbar-nav col-md-8" style="margin-left: 50px;">

                  <?php
                  $sql_fetch_cat="SELECT * FROM tbl_category WHERE Cat_Status='Active'";
                  $sql_exe_cat=mysqli_query($conn,$sql_fetch_cat);
                  while($cat=mysqli_fetch_array($sql_exe_cat))
                  {
                    
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="plantsdp" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php print_r($cat['Cat_Name']);?></a>
            <ul class="dropdown-menu dropdown-menu" aria-labelledby="plantsdp">
              <?php
                $catid=$cat['Cat_id'];
                $sql_fetch_subcat="SELECT * FROM tbl_subcat WHERE Cat_id='$catid' AND SubCat_Status='Active'";
                $sql_exe_subcat=mysqli_query($conn,$sql_fetch_subcat);
                while($subcat=mysqli_fetch_array($sql_exe_subcat))
                {    
              ?>
              <li><a class="dropdown-item" href="ItemList.php?user_id=<?php echo $subcat['SubCat_id'];?>"><?php print_r($subcat['SubCat_Name']);?></a></li>
              <?php
                  
                }
              ?>
            </ul>
          </li>
          <?php
        }
    ?>
        
                    <li class="nav-item dropdown">
                    <a class="nav-link" href="About.php" role="button">AboutUs</a>
                    </li>
        
                    </ul>
                </div>
        
                
        
                <!-- Cart and Login -->
                <div>
                  <a href="Cart.php" class="btn" id="cartlogin" role="button" style="font-size: larger;"><i class="bi bi-cart3" role="button"></i></a>
                  <?php
                  if(empty($_SESSION['user']))
                  {?>
                      <a href="Login.php" class="btn btn-outline-dark " style="font-size: small;" id="cartlogin" role="button">Login</a>
                  <?php
                  }
                  else
                  {
                    if($_SESSION['user_type']=="customer")
                    {?>
                        <a href="Personal.php" class="btn btn-outline-dark " style="font-size: small;" id="cartlogin" role="button">
                      <?php
                      print_r($_SESSION['fname']);
                      print_r(" ");
                      print_r($_SESSION['lname']);
                    ?></a>
                    <?php
                    }
                    else if($_SESSION['user_type']=="Staff")
                    {?>
                        <a href="Profile_Staff.php" class="btn btn-outline-dark " style="font-size: small;" id="cartlogin" role="button">
                      <?php
                      print_r($_SESSION['fname']);
                      print_r(" ");
                      print_r($_SESSION['lname']);
                    ?></a>
                    <?php
                    }
                    else
                    {?>
                    <a href="Staff.php" class="btn btn-outline-dark " style="font-size: small;" id="cartlogin" role="button">Admin</a>
                    <?php
                }
                }
                ?>

                </div>
        
            </div>
        </nav>

  <div class="row row-cols-1 row-cols-md-4 g-0" style="min-height: calc(100vh - 160px);">

    <!-- Sidebar -->
    <div class="row d-flex flex-column flex-shrink-0 p-3 text-white container align-items-center "
      style="width: 250px; background-color: #97c1fc;">
      <a class="mb-3 mb-md-0 me-md-auto text-white text-decoration-none" style="text-align: center;">
        <span class="fs-5">
          <?php
                print_r($_SESSION['fname']);
                print_r(" ");
                print_r($_SESSION['lname']);
              ?>
        </span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li>
          <a href="Personal.php" class="nav-link text-white">
            <!-- <svg class="bi me-2" width="16" height="16"><i class="bi bi-person-square"></i></svg> -->
            Profile
          </a>
        </li>
        <li class="nav-item">
          <a href="Cards.php" class="nav-link  text-white" aria-current="page">
            <!-- <svg class=" bi me-2" width="16" height="16"></svg><i class="bi bi-credit-card-2-front"></i></svg> -->
            Cards
          </a>
        </li>
        <li>
          <a href="Cart.php" class="nav-link text-white">
            <!-- <svg class="bi me-2" width="16" height="16"><i class="bi bi-cart3" role="button"></i></svg> -->
            Cart
          </a>
        </li>
        <li>
          <a href="Orders.php" class="nav-link active text-white" style="background-color: rgb(50, 50, 50);">
            <!-- <svg class="bi me-2" width="16" height="16"><i class="bi bi-bag-check"></i></svg> -->
            Orders
          </a>
        </li>
      </ul>
      <hr>

      <a href="logout.php" class="nav-link text-white">
        <svg class="bi me-2" width="16" height="16"><i class="bi bi-power"></i></svg>
        Logout
      </a>
    </div>

    <!-- Order Details -->
    <!-- <div class=" row" style="margin-left: 280px;" id="form2">
      <h4 class=" font-weight-bold" style="text-align: center; ">Orders</h4>
      <p style="text-align: center; color: gray;">No Orders Yet!</p>
    </div> -->

    <div>

      <div class="row" style="width: 1500px; margin: 30px;">
        <aside class=" col-lg-10">

          <?php
        if(isset($_SESSION['status']))
        {
          if($_SESSION['status']=='Add')
          {

          ?>
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
              class="bi bi-check2-circle me-2" viewBox="0 0 16 16">
              <path
                d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
              <path
                d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
            </svg>
            <div>
              Purchase Successful!
            </div>
          </div>
          <?php
          unset($_SESSION['status']);
        }

        else if($_SESSION['status']=='Remove')
          {

          ?>
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
              class="bi bi-check2-circle me-2" viewBox="0 0 16 16">
              <path
                d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
              <path
                d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
            </svg>
            <div>
              Successfully Removed!
            </div>
          </div>
          <?php
          unset($_SESSION['status']);
        }


        else if($_SESSION['status']=='Noadd')
          {
          ?>
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
              class="bi bi-exclamation-circle me-2" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
              <path
                d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
            </svg>
            <div>
              Coudn't Place Order!
            </div>
          </div>
          <?php
       unset($_SESSION['status']);
       }
       else if($_SESSION['status']=='Cancelled')
          {

          ?>
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
              class="bi bi-check2-circle me-2" viewBox="0 0 16 16">
              <path
                d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
              <path
                d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
            </svg>
            <div>
              Order Cancelled Successfully!
            </div>
          </div>
          <?php
          unset($_SESSION['status']);
        }

       else if($_SESSION['status']=='NoCancel')
          {
          ?>
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
              class="bi bi-exclamation-circle me-2" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
              <path
                d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
            </svg>
            <div>
              Coudn't Cancel Order!
            </div>
          </div>
          <?php
       unset($_SESSION['status']);
       }

       else if($_SESSION['status']=='NoRemove')
          {
          ?>
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
              class="bi bi-exclamation-circle me-2" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
              <path
                d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
            </svg>
            <div>
              Couldn't Remove Item!
            </div>
          </div>
          <?php
       unset($_SESSION['status']);
       }
      }
          ?>

          <h4 class=" font-weight-bold mt-1 mb-4" style="text-align: center; ">Order Details</h4>

          <div class="card d-flex flex-row" style="margin-left: 100px; margin-right: 100px;">

            <div style="margin-left: 30px;">

              <div class=" table-responsive">

                <table class="table ">

                  <tbody>

                    <?php

              while($cm=mysqli_fetch_array($sql_exe_cm))
              {
                $cmid=$cm['CMaster_id'];

              $sql_fetch_cc="SELECT * FROM tbl_cartchild WHERE CMaster_id='$cmid'";
              $sql_exe_cc=mysqli_query($conn,$sql_fetch_cc);

              $sql_fetch_order="SELECT * FROM tbl_order WHERE CMaster_id='$cmid'";
              $sql_exe_order=mysqli_query($conn,$sql_fetch_order);
              $order=mysqli_fetch_array($sql_exe_order);

              $oid=$order['Order_id'];

              $sql_fetch_pay="SELECT * FROM tbl_payment WHERE Order_id='$oid'";
              $sql_exe_pay=mysqli_query($conn,$sql_fetch_pay);
              $pay=mysqli_fetch_array($sql_exe_pay);

              $cardid=$pay['Card_id'];

              $sql_fetch_card="SELECT * FROM tbl_card WHERE Card_id='$cardid'";
              $sql_exe_card=mysqli_query($conn,$sql_fetch_card);
              $card=mysqli_fetch_array($sql_exe_card);

              while($cc=mysqli_fetch_array($sql_exe_cc))
              {
              

              $iid=$cc['Item_id'];
              
              $sql_fetch_item="SELECT * FROM tbl_item WHERE Item_id='$iid'";
              $sql_exe_item=mysqli_query($conn,$sql_fetch_item);
              $item=mysqli_fetch_array($sql_exe_item);
                               
          ?>

                    <tr>
                      <td>
                        <a href="ItemDetails.php?user_id=<?php echo $item['Item_id'];?>" style="text-decoration: none;">
                          <figure class=" d-flex mt-3" style="margin-right: 20px;">
                            <div class="aside"><img style="margin-left: 10px;" width="100" height="100"
                                class=" img-fluid rounded"
                                src="data: image/jpg; charset=UTF-8; base64, <?php echo base64_encode($item['Image']);?>"
                                class="img-sm"></div>
                            <figcaption class="info" style="margin-left: 20px;">
                              <h5 class="title text-dark">
                                <?php print_r($item['Item_Name']);?>
                                <p class="text-muted mt-3" >
                                  Price : Rs.
                                  <?php print_r($item['Selling_Price']);?><br>
                                  Quantity :
                                  <?php print_r($cc['Quantity']);?><br>
                                </p>
                              </h5>
                              
                            </figcaption>
                          </figure>
                        </a>
                      </td>

                      <td>
                        <p class="mt-3" style="font-size: 16px;">
                          Total Price : Rs. <?php print_r($cc['Tot_Price']);?>
                        </p>
                        <p class="mt-3" style="font-size: 16px; margin-right: 50px;">
                          Card No. : <?php print_r($card['Card_No']);?><br>
                        </p>
                      </td>

                      <td>
                        <p class="mt-3" style="font-size: 14px;">
                        Order ID : <?php print_r($order['Order_id']);?><br>
                        </p>
                        <p style="font-size: 16px;  margin-right: 30px;">
                          Order Date : <?php print_r($order['O_Date']);?><br>
                        </p>
                      </td>

                      <td>

                        <?php
                          if($cc['CC_Status']=='Order Placed')
                          {
                        ?>
                        <p class="text-success mt-3" style="font-size: 14px;  margin-right: 30px;">
                          <?php print_r($cc['CC_Status']);?><br>
                        </p>

                        <a href="ordercancel.php?cid=<?php echo $cc['CChild_id'];?>" class="btn btn-outline-danger ">Cancel</a>

                        <?php
                          }
                          else if($cc['CC_Status']=='Cancelled, Refunded')
                          {
                        ?>

                        <p class="text-muted" style="font-size: 14px; margin-top: 30px;">
                          Order Cancelled,<br>Payment Refunded.
                        </p>

                        <?php
                          }
                        ?>

                      </td>

                    </tr>

                    <?php                  
      }
    }
      ?>

                  </tbody>
                </table>

              </div>



            </div>
          </div>
        </aside>
      </div>

    </div>

  </div>
  </div>
  </div>
  </div>


  <!-- Footer -->
  <footer class="page-footer font-small pt-4 " style="height: 160px; background-color:#97c1fc; color: black;">

    <!-- Footer Text -->
    <div class="container-fluid d-flex justify-content-between">

      <!-- Grid column -->
      <div class=" mt-md-0 mt-3">
        <h5 class="font-weight-bold">GLOWUP</h5>
        <p>Worldwide since 2021.<br></p>
      </div>

      <!-- Grid column -->
      <div class=" mb-md-0 mb-3" style="margin-right: 20px;">
        <h5 class=" font-weight-bold">Contact Us</h5>
        <ul class="list-unstyled">
          <li>
            <p>glowup@gmail.com</p>
          </li>
          <li>
            <p>+ 91 987 654 3210</p>
          </li>
        </ul>
      </div>

      <!-- Grid column -->
      <div class=" mb-md-0 mb-3">
        <h5 class=" font-weight-bold">Address</h5>
        <ul class="list-unstyled">
          <li>
            <p> Ernakulam, Kerala, India.</p>
          </li>
        </ul>
      </div>

    </div>

    <!-- Copyright -->
    <!-- <div class="footer-copyright text-center py-1" id="copyright">© 2020 Copyright
    </div> -->

  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="jquery.js"></script>
  <script>
    $(".alert").delay(2000).slideUp(200, function () {
      $(this).alert('close');
    });
  </script>
</body>

</html>