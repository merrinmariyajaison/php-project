<?php
require_once('Connection.php');
session_start();
$c=1;
$sql_fetch_cust="SELECT * FROM tbl_customer";

$sql_exe_cust=mysqli_query($conn,$sql_fetch_cust);

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GLOWUP | Customer Details</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                <div class="d-flex" style="width: 30%; margin:center;">
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
        <div class="row d-flex flex-column flex-shrink-0 p-3 text-white container align-items-center " style="width: 250px; background-color:#97c1fc ;">
            <a class="mb-3 mb-md-0 me-md-auto text-white text-decoration-none" style="text-align: center;">
              <span class="fs-5" >ADMIN PANEL</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <a href="Staff.php" class="nav-link text-white">
                  <!-- <svg class="bi me-2" width="16" height="16"><i class="bi bi-person-lines-fill"></i></svg> -->
                  Staff
                </a>
              </li>
              <li>
                <a href="Customer.php" class="nav-link active" style="background-color: rgb(50, 50, 50);" aria-current="page">
                  <!-- <svg class="bi me-2" width="16" height="16"></svg><i class="bi bi-people"></i></svg> -->
                  Customer
                </a>
              </li>
              <li>
                <a href="Vendor.php" class="nav-link text-white">
                  <!-- <svg class="bi me-2" width="16" height="16"><i class="bi bi-shop"></i></svg> -->
                  Vendor
                </a>
              </li>
              <li>
                <a href="PurMaster.php" class="nav-link text-white">
                  <!-- <svg class="bi me-2" width="16" height="16"><i class="bi bi-receipt"></i></svg> -->
                  Purchase
                </a>
              </li>
              <li>
                <a href="Category.php" class="nav-link text-white">
                  <!-- <svg class="bi me-2" width="16" height="16"><i class="bi bi-list-ul"></i></svg> -->
                  Category
                </a>
              </li>
              <li>
                <a href="OrderList.php" class="nav-link text-white">
                  <!-- <svg class="bi me-2" width="16" height="16"><i class="bi bi-graph-up"></i></svg> -->
                  Sales Report
                </a>
              </li>
              </ul>
            <hr>
            
                <a href="logout.php" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16"><i class="bi bi-power"></i></svg>
                  Logout
                </a>
          </div>

        <!-- Staff Details -->
        <div style="margin-left: 100px;">
          <div class="container" style="width: 2000px; margin-top: 50px;">

            <?php
            if(isset($_SESSION['status']))
            {
            if($_SESSION['status']=='Inactive')
              {

              ?>
              <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check2-circle me-2" viewBox="0 0 16 16">
                  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                </svg>
                <div>
                  Successfully Deactivated!
                </div>
              </div> 
          <?php
              unset($_SESSION['status']);
            }

            else if($_SESSION['status']=='Active')
              {

              ?>
              <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check2-circle me-2" viewBox="0 0 16 16">
                  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                </svg>
                <div>
                 Successfully Activated!
                </div>
              </div> 
          <?php
              unset($_SESSION['status']);
            }
          }
          ?>

            <div class="row">
                <div class="col-md-10">
      
                    <div class="panel panel-default panel-table mb-2">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col">
                            <h4 class="panel-title">Customer Details</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a href="custdownload.php" style="text-align: right;" role="button"  class="btn btn-outline-dark mt-4 mb-3"><i class="bi bi-download"></i></a> 
                    

                    <table class="styled-table">
                      <thead>
                        <tr> <th scope="col">SL.NO</th>
                          <th scope="col">Customer ID</th>
                          <th scope="col">Username</th>
                          <th scope="col">First Name</th>
                         
                          <th scope="col">Last Name</th>
                          <th scope="col">Phone</th>
                          <th scope="col">House</th>
                          <th scope="col">City</th>
                          <th scope="col">District</th>
                          <th scope="col">Pincode</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          while($row=mysqli_fetch_array($sql_exe_cust))
                          { 
                            $stat=$row['Username'];
                            $sql_fetch_log="SELECT * FROM tbl_login WHERE Username='$stat'";
                            $sql_exe_log=mysqli_query($conn,$sql_fetch_log);
                            while($rows=mysqli_fetch_array($sql_exe_log))
                            {
                            ?>
                        <tr>
                          <th scope="row"><?php print_r($c++);?></th>
                          <th scope="row"><?php print_r($row['Cust_id']);?></th>
                          <td><?php print_r($row['Username']);?></td>
                          <td><?php print_r($row['C_FName']);?></td>
                          <!-- <td><?php print_r($row['C_MName']);?></td> -->
                          <td><?php print_r($row['C_LName']);?></td>
                          <td><?php print_r($row['C_PhNo']);?></td>
                          <td><?php print_r($row['C_HNo']);?></td>
                          <td><?php print_r($row['C_Street']);?></td>
                          <td><?php print_r($row['C_Dist']);?></td>       
                          <td><?php print_r($row['C_pin']);?></td>
                          <td>
                            <?php
                            if($rows['L_Status']=='Active')
                            {
                            ?>
                            <a href="custremove.php?user=<?php echo $row['Username'];?>"  style="font-size: small;" class="btn btn-outline-danger">Deactivate</a>
                            <?php
                            }
                            else
                            {
                            ?>
                            <a href="custremove.php?user=<?php echo $row['Username'];?>" type="submit" style="font-size: small;" class="btn btn-outline-success">Activate</a>
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
          </div>
          </div>
          

        <!-- Footer -->
        <footer class="page-footer font-small pt-4 " style="height: 160px; background-color: #97c1fc; color: black;">

            <!-- Footer Text -->
            <div class="container-fluid d-flex justify-content-between" >
    
                <!-- Grid column -->
                <div class=" mt-md-0 mt-3">
                <h5 class="font-weight-bold">GLOWUP.</h5>
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
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="jquery.js"></script>
        <script>
          $(".alert").delay(2000).slideUp(200, function() {
           $(this).alert('close');
            });
        </script> 
    </body>

</html>