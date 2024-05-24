<?php
require('subcat_action.php');
require('Connection.php');
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GLOWUP | Item Addition</title>
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
        <div class="row d-flex flex-column flex-shrink-0 p-3 text-white container align-items-center " style="width: 250px; background-color: #97c1fc;">
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
                <a href="Customer.php" class="nav-link text-white">
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
                <a href="Category.php" class="nav-link text-white active" style="background-color: rgb(50, 50, 50);"  aria-current="page">
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
            <h4 class="panel-title">Item Details</h4>
            <?php
            if(isset($_SESSION['status']))
            {
              if($_SESSION['status']=='Add')
              {

              ?>
              <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check2-circle me-2" viewBox="0 0 16 16">
                  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                </svg>
                <div>
                  Item Added Successfully!
                </div>
              </div> 
          <?php
              unset($_SESSION['status']);
            }

            else if($_SESSION['status']=='Remove')
              {

              ?>
              <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check2-circle me-2" viewBox="0 0 16 16">
                  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
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
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-circle me-2" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                </svg>
                <div>
                  Coudn't Add Item!
                </div>
              </div> 
           <?php
           unset($_SESSION['status']);
           }

           else if($_SESSION['status']=='Update')
              {

              ?>
              <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check2-circle me-2" viewBox="0 0 16 16">
                  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                </svg>
                <div>
                  Successfully Updated!
                </div>
              </div> 
          <?php
              unset($_SESSION['status']);
            }

            else if($_SESSION['status']=='Noupdate')
              {
              ?>
              <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-circle me-2" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                </svg>
                <div>
                  Updation Failed!
                </div>
              </div> 
           <?php
           unset($_SESSION['status']);
           }

           else if($_SESSION['status']=='Inactive')
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
              <form class="needs-validation" action="itemins.php" method="POST" enctype="multipart/form-data" >

                <div class="card mb-5" style="width:1100px; margin-top: 30px; border-color: white;">
                  <div class="row g-0">

                    <!-- <div class="col-md-4" style="text-align: center;">
                      <label for="UploadImage">
                        <img src="" style="width: 500px; height: 500px; border-radius: 00.3rem;" id="output"/>
                    </label>
                    <input accept="image/*" onchange="loadFile(event)" id="UploadImage" type="file" class="form-control" aria-label="category name" name="img" accept=".jpg, .png, .jpeg" required>
                   
                    </div> -->

                    <div class="col-md-5" style="margin-left: 180px;">
                      <div class="card-body">
                        <p class="card-text"><small class="text-muted"><?php print_r($_SESSION['name']);?></small></p>

                        <h5 class="card-title">Title:
                          <div style="margin-top: 10px; margin-bottom: 10px;" class="input-group has-validation">
                            <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-box"></i></span> -->
                            <input name="name" type="text" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="Product Name"  required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        </h5>
        
                        <p class="card-text">
                          <h5>Description: 
                          <div style="margin-top: 10px; margin-bottom: 10px;" class="input-group has-validation">
                            <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-blockquote-left"></i></span> -->
                            <textarea name="dsc" type="text" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="Description"  required></textarea>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                          </h5>

                            <!-- <span class="input-group-text" id="form1edit"><i class="bi bi bi-tag"></i></span> -->
                            <input name="price" class="form-control " type="hidden" style="border-left-color: white;" id="exampleinput" placeholder="Product Price"  required value=0>
                         
                      <h5>Brand: 
                            <div style="margin-top: 10px; margin-bottom: 10px;" class="input-group has-validation">
                            <!-- <span class="input-group-text" id="form1edit"><i class="bi bi bi-tag"></i></span> -->
                            <input name="brand" type="text" class="form-control" style="border-left-color: white;" id="exampleinput" placeholder="Brand Name"  required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                      </h5>

                     
                          <!-- <span class="input-group-text" id="form1edit"><i class="bi bi-inboxes"></i></span>  -->
                          <input name="stock"  class="form-control "type="hidden" style="border-left-color: white;" id="exampleinput" placeholder="Stock"  required value=0>
                       
                      <h5 class="card-title">upload the image:
                      <label for="UploadImage">
                      <img src="image.png" style="width: 100px; height:25px; border-radius: 00.3rem;" id="output"/>
                         
                    </label>
                    <input accept="image/*" onchange="loadFile(event)" id="UploadImage" type="file" class="form-control" aria-label="category name" name="img" accept=".jpg, .png, .jpeg" required>
                   
                        </div>
                        </h5>
        
                          
                        <div>
                          <button type="submit" class="btn btn-dark d-block mt-4">Add Item</button>
                      </div>
                      
                        </p>
                        
                      </div>
                    </div>
                  </div>
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
                <p>Worldwide  since 2021.</p>
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
            <div class="footer-copyright text-center py-1" id="copyright">© 2020 Copyright
            </div>
            
        </footer>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="jquery.js"></script>
        <script>
          $(".alert").delay(2000).slideUp(200, function() {
           $(this).alert('close');
            });
        </script> 
        <script>
          var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
              URL.revokeObjectURL(output.src) // free memory
            }
          };
        </script>
    </body>

</html>