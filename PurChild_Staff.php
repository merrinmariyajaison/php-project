<?php
require_once('Connection.php');
session_start();

$user_id=mysqli_real_escape_string($conn,$_GET['user_id']);

$sql_fetch_child="SELECT * FROM tbl_purchild WHERE PMaster_id='$user_id'";

$sql_exe_child=mysqli_query($conn,$sql_fetch_child);

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
        <div class="row d-flex flex-column flex-shrink-0 p-3 text-white container align-items-center " style="width: 250px; background-color: #97c1fc;">
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

        <!-- Staff Details -->
        <div style="margin-left: 100px;">
          <div class="container" style="width: 2000px; margin-top: 50px;">

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
                  Vendor Added Successfully!
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

            else if($_SESSION['status']=='Noadd')
              {
              ?>
              <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-circle me-2" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                </svg>
                <div>
                  Coudn't Add Vendor!
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

              <div class="row">
                <div class="col-md-10">
      
                    <div class="panel panel-default panel-table mb-2">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col">
                            <h4 class="panel-title">Purchase Details</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                    <table class="styled-table">
                      <thead>
                        <tr>
                          <th scope="col">PChild ID</th>
                          <th scope="col">PMaster ID</th>
                          <th scope="col">Item Name</th>
                          <th scope="col">Cost Price</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Total Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          while($row=mysqli_fetch_array($sql_exe_child))
                          {$iid=$row['Item_id'];

                          $sql_fetch_item="SELECT * FROM tbl_item WHERE Item_id='$iid'";
                          $sql_exe_item=mysqli_query($conn,$sql_fetch_item);
                          $item=mysqli_fetch_array($sql_exe_item);
                          ?>

                      <tr>
                        <th scope="row"><?php print_r($row['PChild_id']);?></th>
                        <td><?php print_r($row['PMaster_id']);?></td>
                        <td><?php print_r($item['Item_Name']);?></td>
                          <td><?php print_r($row['Cost_Price']);?></td>
                          <td><?php print_r($row['Quantity']);?></td>
                          <td><?php print_r($row['Tot_Price']);?></td>
                        </tr>
                        <?php
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
        <footer class="page-footer font-small pt-4 " style="height: 160px; background-color: black; color: white;">

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
        <script type="text/javascript" src="jquery.js"></script>
        <script>
          $(".alert").delay(2000).slideUp(200, function() {
           $(this).alert('close');
            });
        </script> 
    </body>

</html>