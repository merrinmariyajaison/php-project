<?php
require_once('Connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GLOWUP| Add Card</title>
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
                <a class="navbar-brand " id="logo" href="/project">GLOW UP.</a> -->

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
        
        <div class="row row-cols-1 row-cols-md-4 g-0 " style="min-height: calc(100vh - 160px);">

        <!-- Sidebar -->
        <div class="row d-flex flex-column flex-shrink-0 p-3 text-white container align-items-center " style="width: 250px; background-color: #97c1fc;">
            <a class="mb-3 mb-md-0 me-md-auto text-white text-decoration-none" style="text-align: center;">
              <span class="fs-5" >
                <?php
                print_r($_SESSION['fname']);
                print_r(" ");
                print_r($_SESSION['lname']);
              ?></span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
              <li >
                <a href="Personal.php" class="nav-link text-white" >
                  <!-- <svg class="bi me-2" width="16" height="16"><i class="bi bi-person-square"></i></svg> -->
                  Profile
                </a>
              </li>
              <li class="nav-item">
                <a href="Cards.php" class="nav-link active text-white" style="background-color: rgb(50, 50, 50);" aria-current="page">
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
                <a href="Orders.php" class="nav-link text-white">
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

        <!-- Add Card -->
        <div>
        <form class=" row g-3 needs-validation " style="margin-left: 280px;" action="cardins.php" method="POST" novalidate id="form2">
          <h4 class=" font-weight-bold mb-5" style="text-align: center;">Card Details</h4>

            <div class="col-md-6">
              <label for="validationCustom01" class="form-label">Card Number</label>
              <div class="input-group has-validation">
                <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-card-heading"></i></span> -->
                <input name="cardnum" type="number" minlength="16" maxlength="16" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="Card Number" required>
              <div class="invalid-feedback">
                Please enter a valid Card Number.
              </div>
            </div>
            </div>

            <div class="col-md-6">
                <label for="validationCustom01" class="form-label">Name On Card</label>
                <div class="input-group has-validation">
                    <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-person"></i></span> -->
                <input name="name" type="text" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="Name On Card" required>
                <div class="valid-feedback">
                  Please enter a valid Bank Name.
                </div>
              </div>
              </div>

            <div class="col-md-5">
              <label style="margin-top:  1px;" for="validationCustom02" class="form-label">Card Type</label>
              <div class="input-group has-validation">
              <input style="margin-top: 8px;" name="cardtype" type="radio" id="Credit" value="Credit Card"  id="exampleinput" required>
                <label style="margin-left: 5px; margin-top: 3px;" for="Credit">Credit Card</label>
              <input style="margin-left: 20px; margin-top: 8px;" name="cardtype" type="radio" id="Debit" value="Debit Card"  id="exampleinput" required>
              <label style="margin-left: 5px; margin-top: 3px;" for="Debit">Debit Card</label>
            </div>
            </div>

              <div class="col-md-5">
                <label for="validationCustomUsername" class="form-label">Expiry Date</label>
                <div class="input-group has-validation">
                  <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-calendar-day"></i></span> -->
                  <input name="expdate" type="month" class="form-control" style="border-left-color: white;"id="exampleinput"  required>
                  <div class="invalid-feedback">
                    Please provide a valid Date.
                  </div>
                </div>
              </div>

                <div class="col-12 mt-5">
                    <button class="btn btn-dark" type="submit">Save Card</button>
                </div>

          </form>
          </div>
          </div>
          

        <!-- Footer -->
        <footer class="page-footer font-small pt-4" style="height: 160px; background-color: black; color: white;">

            <!-- Footer Text -->
            <div class="container-fluid d-flex justify-content-between" >
    
                <!-- Grid column -->
                <div class=" mt-md-0 mt-3">
                <h5 class="font-weight-bold">GLOWUP</h5>
                <p>Worldwide since 2021.</p>
                </div>








































































































































                
                
                <!-- Grid column -->
                <div class=" mb-md-0 mb-3" style="margin-right: 20px;">
                <h5 class=" font-weight-bold">Contact Us</h5>
                <ul class="list-unstyled">
                    <li>
                        <p>GLOWUP@gmail.com</p>
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
            <div class="footer-copyright text-center py-1" id="copyright">© 2020 Copyright
            </div>
            
        </footer>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

</html>