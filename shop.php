<?php
  include 'admin/functions.php';
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Delius&display=swap" rel="stylesheet">
  <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <title>ecommerce</title>
</head>
<body>

  <!-- HEADER -->
  <section class="header">
    <a class="logo" href="home.html"><img src="img/logo.jpg" alt="" width="90" height="90" style="border-radius: 50%"></a>
    <div>
      <ul class="navbar">
        <li><a href="home.php">Home</a></li>
        <li><a href="shop.php">Surf Shop ▾</a>
        <div class="submenu-box-container">
            <ul class="submenu">
            <?php
              get_categories();
            ?>
            </ul>
          </div>
        </li>
        <li><a href="home.php">About</a></li>
        <li><a href="home.php">Contact</a></li>
        <li><a href="home.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
        <li><a href="home.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
      </ul>
    </div>
    <div class="search-bar">
      <input type="text" placeholder="Search">
      <button><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
  </section>

<div class="path">
  <a href="home.php">Home</a>
  <a href="shop.php"> / Surf Shop</a>
  <?php
    if(isset($_GET['category'])){
      $value = $_GET['category'];
      echo "<a href='shop.php?category=$value'> / $value</a>";
    }
  ?>
</div>

<!-- PRODUCTS -->
  <section class="shop-product-list">

    <div class="side-bar">
      <div class="inner-box">
        <div class="sort-by">
          <select name="" id="" >
            <option value="" disabled selected hidden>Sort By</option>
            <option value="">Popularity</option>
            <option value="">Price - smallest to largest</option>
            <option value="">Price - Largest to smallest</option>
          </select>
        </div>
        <form action="" method="post">
        <div class="brand-check-box">Brands<br>
          <?php
          get_brands();
          ?>
        </div>
        <input type="submit" value="Filter" class="filter-btn" name="filter">
        </form>
        
      </div>
    </div>

    <div class="products-container">
      <?php
      $ans = true;
      if(isset($_POST['filter'])){
        $ans = filter();
      }
      if($ans){
        if(isset($_GET['category'])){
          get_product_per_category();
        }
        else{
          get_all_product();
        }
      } 
      ?>
    </div>
  </section>

  <!-- FOOTER -->
  <section class="footer">
  </section>
  

<!-- JAVASCRIPT -->
  <script>
    
  </script>
  
</body>
</html>