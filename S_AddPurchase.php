<?php
require_once('Connection.php');
session_start();

$num="1";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $num = test_input($_POST["number"]);
  }
  
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GLOWUP | Purchase List</title>
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
        
        <div class="row row-cols-1 row-cols-md-4 g-0" style="min-height: calc(100vh - 160px);">

        <!-- Sidebar -->
        <div class="row d-flex flex-column flex-shrink-0 p-3 text-white container align-items-center " style="width: 250px; background-color:#97c1fc;">
            <a class="mb-3 mb-md-0 me-md-auto text-white text-decoration-none" style="text-align: center;">
              <span class="fs-5" >
                <?php
                print_r($_SESSION['fname']);
                print_r(" ");
                print_r($_SESSION['lname']);
              ?>
              </span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <a href="Profile_Staff.php" class="nav-link text-white">
                  <!-- <svg class="bi me-2" width="16" height="16"><i class="bi bi-person-lines-fill"></i></svg> -->
                  Profile
                </a>
              </li>
              <li>
                <a href="Vendor_Staff.php" class="nav-link text-white">
                  <!-- <svg class="bi me-2" width="16" height="16"><i class="bi bi-shop"></i></svg> -->
                  Vendor
                </a>
              </li>
              <li>
                <a href="PurMaster_Staff.php" class="nav-link active" style="background-color: rgb(50, 50, 50);" aria-current="page">
                  <!-- <svg class="bi me-2" width="16" height="16"><i class="bi bi-receipt"></i></svg> -->
                  Purchase
                </a>
              </li>
              <li>
                <a href="Category_Staff.php" class="nav-link text-white">
                  <!-- <svg class="bi me-2" width="16" height="16"><i class="bi bi-list-ul"></i></svg> -->
                  Category
                </a>
              </li>
              </ul>
            <hr>
            
                <a href="logout.php" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16"><i class="bi bi-power"></i></svg>
                  Logout
                </a>
          </div>

          <div class="row">
            <div class="col-md-10" style="margin-left: 280px; margin-top: 80px;">
  
                <div class="panel panel-default panel-table ">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col">
                        <h4 class="panel-title">New Purchase</h4>
                      </div>
                      <div class="col col-xs-6" style="margin-left: 515px;">

                        <form style="width: 200px;" class="row needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <label for="validationCustom01" class="form-label">No. Of Items</label>
                                <div class="input-group has-validation">
                                  <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-list"></i></span> -->
                                  <input name="number" type="number" min="1" class="form-control" style="border-left-color: white;" value="<?php echo $num?>" id="num" placeholder="No."  required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                  <button id="go" class="btn btn-outline-dark">Go</button>
                                  
                              </div>
                              </form>
                      </div>
                    </div>
                  </div>
                </div>

                <form class="row g-4 needs-validation" style="width: 700px; margin: 0 auto; font-size: medium;" action="purchaseins.php" method="POST">
                  <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Vendor</label>
                    <div class="input-group has-validation">
                      <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-shop"></i></span> -->
                      <select  name="vid" class="form-control" style="border-left-color: white;" id="exampleinput"   required >
                    <option  disabled-selected hidden>Select Vendor</option>
                    <?php

                    $sql_fetch_vendor = "SELECT * FROM tbl_vendor WHERE V_Status='Active'";

                    $vendor_exe=mysqli_query($conn,$sql_fetch_vendor);

                    while($vendor=mysqli_fetch_array($vendor_exe))
                    { 

                    ?>

                    <option value="<?php echo $vendor['Vendor_id'];?>">
                      <?php echo $vendor['V_Name'];?>
                    </option>
                    <?php
                    }
                    ?>
                  </select>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                  </div>
                  </div>

                  <div class="col-md-6">
                    <label for="validationCustomUsername" class="form-label">Date</label>
                    <div class="input-group has-validation">
                      <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-calendar-day"></i></span> -->
                      <input name="date" type="date" class="form-control" style="border-left-color: white;"id="exampleinput"  required>
                      <div class="invalid-feedback">
                        Please provide a valid Date.
                      </div>
                    </div>
                  </div>


                <?php
                    for($i=1;$i<=$num;$i++)
                    {
                ?>

                  <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Item: <?php echo $i?></label>
                    <div class="input-group has-validation">
                      <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-box"></i></span> -->
                      <select  name="iid<?php echo $i?>" class="form-control" style="border-left-color: white;" id="exampleinput"   required >
                        <option  disabled-selected hidden>Select Item</option>
                        <?php
    
                        $sql_fetch_it = "SELECT * FROM tbl_item WHERE I_Status='Active'";
    
                        $it_exe=mysqli_query($conn,$sql_fetch_it);
    
                        while($it=mysqli_fetch_array($it_exe))
                        { 
    
                        ?>
    
                        <option value="<?php echo $it['Item_id'];?>">
                          <?php echo $it['Item_Name'];?>
                        </option>
                        <?php
                        }
                        ?>
                      </select>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                  </div>
                  </div>
        
                  <div class="col-md-3">
                    <label for="validationCustom05" class="form-label">Cost Price</label>
                    <div class="input-group has-validation">
                      <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-cash"></i></span> -->
                    <input name="cp<?php echo $i?>" type="text" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="Price" required>
                    <div class="invalid-feedback">
                      Please provide a valid zip.
                    </div>
                  </div>
                  </div>
                  <div class="col-md-3">
            <label for="validationCustom05" class="form-label">Profit Percentage</label>
            <div class="input-group has-validation">
              <span class="input-group-text" id="form1edit"><i class="bi bi-percent"></i></span>
              <input name="p<?php echo $i?>" type="text" class="form-control" style="border-left-color: white;"
                id="exampleinput" placeholder="Percentage" required>
              <div class="invalid-feedback">
                Please provide a valid zip.
              </div>
            </div>
          </div>

                  <div class="col-md-2">
                    <label for="validationCustom05" class="form-label">Quantity</label>
                    <div class="input-group has-validation">
                      <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-basket"></i></span> -->
                    <input name="qty<?php echo $i?>" type="number" min="1" value="1" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="Quantity" required>
                    <div class="invalid-feedback">
                      Please provide a valid zip.
                    </div>
                  </div>
                  </div>

                  <?php
                        }
                    ?>
               
                    <input type="hidden" name="num" value="<?php echo $num?>">
                  
                    <div class="gap-4 mt-3 mb-5">
                        <button type="submit" class="btn btn-dark d-block mt-4">Add Vendor</button>
                    </div>
                    
                  </form>
                  </div>
                  </div>
            </div>
          

        <!-- Footer -->
        <footer class="page-footer font-small pt-4 " style="height: 160px; background-color: #97c1fc; color: black;">

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
            </div>
             -->
        </footer>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="jquery.min.js"></script>
        <script>

          $(".alert").delay(2000).slideUp(200, function() {
           $(this).alert('close');
            });
        </script> 
    </body>

</html>