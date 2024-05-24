<?php
require_once('Connection.php');
session_start();

$user_id=mysqli_real_escape_string($conn,$_GET['user_id']);

$sql_fetch_item="SELECT * FROM tbl_item WHERE I_Status='Active' AND Item_id='$user_id'";
$sql_exe_item=mysqli_query($conn,$sql_fetch_item);
$item=mysqli_fetch_array($sql_exe_item);

$id=$item['SubCat_id'];

$sql_fetch="SELECT * FROM tbl_subcat WHERE SubCat_id='$id'";
$sql_exe=mysqli_query($conn,$sql_fetch);
$row=mysqli_fetch_array($sql_exe);

?>
<!DOCTYPE html>
<html lang="en">

  <!-- Head -->
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GLOWUP| Item List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="Home.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script>
      function change(value){
      document.getElementById("val").value= 2;}
   </script>
  </head>

  <!-- Body -->
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

        }
            ?>


              <div class="card mb-5" style="width:1100px; margin-top: 30px; border-color: white;">
                <div class="row g-0">

                  <div class="col-md-6">
                      <img width="500" height="500" class=" img-fluid rounded" src="data: image/jpg; charset=UTF-8; base64, <?php echo base64_encode($item['Image']);?>">
                  </div>

                  <div class="col-md-6" >
                    <div class="card-body">
                      <a style="text-decoration: none;" href="ItemList.php?user_id=<?php echo $row['SubCat_id'];?>"> <p class="card-text text-muted"><?php print_r($row['SubCat_Name']);?></p></a>

                      <h3 style="margin-top: 10px;" class="card-title"><?php print_r($item['Item_Name']);?></h3>
      
                        <p style="margin-top: 20px; font-size: 16px;"><?php print_r($item['Description']);?></p>
                        <p style="margin-top: 20px; font-size: 16px;"><?php print_r($item['brand_name']);?></p>

                        <h4 style="margin-top: 35px;">Price: <?php print_r($item['Selling_Price']);?>/-</h4>
                        

                        <form  class="row needs-validation mt-3" method="post" action="cartins.php">
                          <label for="validationCustom01" class="form-label">Quantity:</label>
                          <div class="input-group has-validation" style="width: 100px; margin-right: 300px;">
                            <input name="qty" type="number" min="1" class="form-control"  value="1"  placeholder="No."  required>
                          </div>
                          <input name="item" type="hidden" value="<?php print_r($item['Item_id']);?>">
                          <input name="brand" type="hidden" value="<?php print_r($item['brand_name']);?>">
                          <input name="price" type="hidden" value="<?php print_r($item['Selling_Price']);?>">
                          <input name="subcat" type="hidden" value="<?php print_r($item['SubCat_id']);?>">
                        
                          <input name="val" type="hidden" value="1"id="val">

                          <?php
                            if($item['Stock']==0 || $item['I_Status']=='Inactive')
                            {
                          ?>
                          <button class="btn btn-danger mt-5 col-md-5" disabled><i style="margin-right: 10px;" class="bi bi-cart-x"></i>Out Of Stock</button>
                          <?php
                            }
                            else
                            {
                          ?>
                          <button  style="margin-left: 12px;" type="submit" class="btn btn-success mt-5 col-md-5"><i style="margin-right: 10px;" class="bi bi-cart3"></i>Add To Cart</button>
                        <?php
                            }
                        ?>
                          <!-- <button onclick="change(2)" style="margin-left: 10px;" type="submit" class="btn btn-success mt-5 col-md-5"><i style="margin-right: 10px;" class="bi bi-bag-check"></i>Buy Now</button> -->
                        </form>

                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>


    <!-- Footer -->
    <footer class="page-footer font-small pt-4" style="height: 160px; background-color: #97c1fc; color: black;">

        <!-- Footer Text -->
        <div class="container-fluid d-flex justify-content-between" >
  
            <!-- Grid column -->
            <div class=" mt-md-0 mt-3">
              <h5 class="font-weight-bold">GLOWUP</h5>
              <p>Worldwide  since 2021.<br></p>
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
                    <p>Ernakulam, Kerala, India.</p>
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