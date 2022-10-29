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
    <a class="logo" href="home.html"><img src="img/logo.jpg" width="90" height="90" style="border-radius: 50%"></a>
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

  <div class="product-details">
  
    <?php
    get_product();
    ?>
    
</div>

<!-- FOOTER -->
<section class="footer">
  </section>