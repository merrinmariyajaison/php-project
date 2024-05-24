<?php
require_once('Connection.php');
session_start();
$i=0;
$sql_fetch_item="SELECT * FROM tbl_item WHERE I_Status='Active' AND Stock>'0'";
$sql_exe_item=mysqli_query($conn,$sql_fetch_item);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Head -->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GLOWUP </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="Home.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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

  <!-- Carousel -->
  <div id="carouselid" class="carousel  slide" data-bs-ride="carousel">

    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselid" data-bs-slide-to="0" class="active" aria-current="true"
        aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselid" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselid" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">

      <div class="carousel-item active carousel-dark" data-bs-interval="3000">
        <img style=" object-position: 0 0%;" id="carouselid"
          src="a4.jpg"
          class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Glow is the essence of beauty!!</h5>
          
        </div>
      </div>

      <div class="carousel-item" data-bs-interval="3000">
        <img style=" object-position: 0 75%;" id="carouselid"
          src="a2.jpg"
          class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Be the star of the show with our makeup!</h5>
          <p>glow is the essence of beauty.</p>
        </div>
      </div>

      <div class="carousel-item " data-bs-interval="3000">
        <img style=" object-position: 0 45%;" id="carouselid"
          src="a3.jpg"
          class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <!-- <h5>Succulent Plants, Great For Indoors!</h5>
          <p>Survives easily in dry indoor environments.</p>
        </div> -->
      </div>

    </div>

    <!-- Carousel Control -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselid" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselid" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>

  </div>

  <div class="container align-items-center" style="min-height: calc(200vh - 200px);">
    <!-- Banner -->
    <!-- <div class=" px-4 py-5 d-flex justify-content-center ">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-5 ">

        <div class="col d-flex align-items-start">
          <i class="bi bi-trophy" id="bannericon"></i>
          <div>
            <h5>High Quality</h4>
              <p>Grown by giving the at most care</p>
          </div>
        </div>

        <div class="col d-flex align-items-start">
          <i class="bi bi-patch-check" id="bannericon"></i>
          <div>
            <h5>Secure Packaging</h4>
              <p>To deliver healthy plants</p>
          </div>
        </div>

        <div class="col d-flex align-items-start">
          <i class="bi bi-truck" id="bannericon"></i>
          <div>
            <h5>Free Shipping</h4>
              <p>For all oders</p>
          </div>
        </div>

        <div class="col d-flex align-items-start">
          <i class="bi bi-headset" id="bannericon"></i>
          <div>
            <h5>24 / 7 Support</h4>
              <p>Dedicated support</p>
          </div>
        <!-- </div> -->

      </div>
    </div> -->

    <!-- Item Cards -->
    <h4 style="text-align: center; margin-bottom: 50px; margin-top: 30px;">Best Selling Products</h4>

    <div class="row row-cols-1 row-cols-md-4 g-0 " id="cards">

      <?php
              while($item=mysqli_fetch_array($sql_exe_item))
              {

                if($i<8)
                {$i++;
                          
      ?>

      <div class="col d-flex mb-5 justify-content-center">
        <a href="ItemDetails.php?user_id=<?php echo $item['Item_id'];?>" style="text-decoration: none; color: ;">
          <div class="card h-100" id="itemcard">
            <img class="card-img-top"
              src="data: image/jpg; charset=UTF-8; base64, <?php echo base64_encode($item['Image']);?>">
            <div class="card-body">
              <h5>
                <?php print_r($item['Item_Name']);?>
              </h5>
              <h6>Rs.
                <?php print_r($item['Selling_Price']);?>
              </h6>
              <form method="post" action="cartins.php">
                <input name="qty" type="hidden" value="1">
                <input name="item" type="hidden" value="<?php print_r($item['Item_id']);?>">
                <input name="price" type="hidden" value="<?php print_r($item['Selling_Price']);?>">
                <input name="subcat" type="hidden" value="<?php print_r($item['SubCat_id']);?>">
                <input name="val" type="hidden" value="0" id="val">

                <?php
                if($item['Stock']==0 || $item['I_Status']=='Inactive')
                {
              ?>
                <button class="btn mt-3 btn-sm btn-outline-danger col-md-12" disabled><i style="margin-right: 10px;"
                    class="bi bi-cart-x"></i>Out Of Stock</button>
                <?php
                }
                else
                {
              ?>
                <button type="submit" class="btn mt-3 btn-sm btn-outline-dark col-md-12"><i style="margin-right: 10px;"
                    class="bi bi-cart3"></i>Add To Cart</button>
                <?php
                }
            ?>
              </form>
            </div>
          </div>
        </a>
      </div>

      <?php                  
      }
    }
      ?>

    </div>

  </div>

  <!-- Footer -->
  <footer class="page-footer font-small pt-4" style="height: 160px; background-color:#97c1fc; color: black;">

    <!-- Footer Text -->
    <div class="container-fluid d-flex justify-content-between">

      <!-- Grid column -->
      <div class=" mt-md-0 mt-3">
        <h5 class="font-weight-bold">GLOWUP</h5>
        <p>Worldwide Products since 2021.<br></p>
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


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>