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
        <title>GLOWUP | Sign Up</title>
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
        <!-- Sign Up -->
        <div class="container align-items-center" style="min-height: calc(100vh - 160px);">
        <form class="row g-3 needs-validation" id="form1" action="signup_action.php" method="POST">

          <?php
            if(isset($_SESSION['status']))
            {
               if($_SESSION['status']=='UserExist')
              {
              ?>
              <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-circle me-2" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                </svg>
                <div>
                  User Already Exists!
                </div>
              </div> 
           <?php
           unset($_SESSION['status']);
           }

           else if($_SESSION['status']=='PassNoMatch')
              {

              ?>
              <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check2-circle me-2" viewBox="0 0 16 16">
                  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                </svg>
                <div>
                  Password Does Not Match!
                </div>
              </div> 
          <?php
              unset($_SESSION['status']);
            }

          }
          ?>

          <h4 class=" font-weight-bold mb-5" style="text-align: center;">Sign Up</h4>

          <div class="col-md-4">
            <label for="validationCustom01" class="form-label">First Name</label>
            <div class="input-group has-validation">
              <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-person"></i></span> -->
              <input name="fname" type="text" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder=""  required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
          </div>

          <!-- <div class="col-md-4">
              <label for="validationCustom01" class="form-label">Middle Name</label>
              <div class="input-group has-validation">
                  <span class="input-group-text" id="form1edit"><i class="bi bi-person"></i></span>
              <input name="mname" type="text" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="Middle Name" required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            </div> -->

          <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Last Name</label>
            <div class="input-group has-validation">
              <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-person"></i></span> -->
            <input name="lname" type="text" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
          </div>

          <div class="col-md-6">
              <label for="validationCustomUsername" class="form-label">Username</label>
              <div class="input-group has-validation">
                <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-envelope"></i></span> -->
                <input name="username" type="email" pattern=".+.com" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                  Please provide a valid username.
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label for="validationCustomUsername" class="form-label">Phone</label>
              <div class="input-group has-validation">
                <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-telephone" style="margin-right: 10px;"></i>+91</span> -->
                <input name="phone" type="text" minlength="10" maxlength="10" class="form-control" style="border-left-color: white;"id="exampleinput" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                  Please provide a valid 10 digit phone number.
                </div>
              </div>
            </div>

          <div class="col-md-6">
            <label for="validationCustom03" class="form-label">House</label>
            <div class="input-group has-validation">
              <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-house"></i></span> -->
            <input name="house" type="text" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
          </div>

          <div class="col-md-6">
              <label for="validationCustom03" class="form-label">City</label>
              <div class="input-group has-validation">
                  <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-signpost-split"></i></span> -->
              <input name="street" type="text" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="" required>
              <div class="invalid-feedback">
                Please provide a valid Street.
              </div>
            </div>
            </div>

            <div class="col-md-6">
              <label for="validationCustom03" class="form-label">District</label>
              <div class="input-group has-validation">
                  <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-building"></i></span> -->
              <input name="district" type="text" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="" required>
              <div class="invalid-feedback">
                Please provide a valid District.
              </div>
            </div>
            </div>

          <div class="col-md-6">
            <label for="validationCustom05" class="form-label">Pincode</label>
            <div class="input-group has-validation">
              <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-geo"></i></i></span> -->
            <input name="zip" type="text" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="" required>
            <div class="invalid-feedback">
              Please provide a valid pin.
            </div>
          </div>
          </div>

          <div class="col-md-6">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <div class="input-group has-validation">
                  <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-shield-lock"></i></span> -->
              <input name="password" type="password" minlength="4" class="form-control" style="border-left-color: white;"  id="exampleinput" placeholder="" required>
            </div>
            </div>

              <div class="col-md-6">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <div class="input-group has-validation">
                  <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-shield-lock"></i></span> -->
                  <input name="repass" type="password" minlength="4" class="form-control" style="border-left-color: white;"  id="exampleinput" placeholder="" required>
                  <div class="invalid-feedback">
                      Invalid password.
                  </div>
                </div>
              </div>

            <div class="d-grid gap-4 mt-3">
                <button type="submit" class="btn btn-dark d-block mt-4">Sign Up</button>
                <h8 style="text-align: center;">Already have an account? <a href="Login.php" role="button" style="text-align: center;">Login.</a></h8>
            </div>
            
          </form>
          </div>

        <!-- Footer -->
        <footer class="page-footer font-small pt-4" style="height: 160px; background-color:#97c1fc; color: black;">

            <!-- Footer Text -->
            <div class="container-fluid d-flex justify-content-between" >
    
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

</html>