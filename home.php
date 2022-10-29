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


<!-- TOP BANNER -->
  <div class="top-banner">
    <div class="inner-box">
      <p>GET THE BEST OF YOUR WAVES</p>
      <button>SHOP NOW</button>
    </div>
  </div>


<!-- CATEGORIES -->
  <h1 style="text-align: center; font-size: 35px; color:rgb(14, 14, 78);">Categories</h1>
  <div class="home-categories">
    <a href="home.php" style="background-image: url(img/surfboard.jpg);"><div></div></a>
    <a href="home.php" style="background-image: url(img/surfboard.jpg);"><div></div></a>
    <a href="home.php" style="background-image: url(img/surfboard.jpg);"><div></div></a>
  </div>


  <!-- MIDDLE BANNER -->
  <div class="middle-banner">
      <p>ALL YOUR FAVORITE BRANDS</p>
      <button>SHOP NOW</button>
  </div>


<!-- BEST SELLER -->
  <h1 style="text-align: center; font-size: 35px; color:rgb(14, 14, 78);">Best Seller</h1>
  <section class="product-list">
    <div class="products-container">
    </div>
  </section>

  <h1 style="text-align: center; font-size: 35px; color:rgb(14, 14, 78); margin-top: 100px;">Brands</h1>
  <section class="brands">
    <a href="home.php" style="background-image: url(img/brands/billabong.png);"></a>
    <a href="home.php" style="background-image: url(img/brands/quicksylver.jpg);"></a>
    <a href="home.php" style="background-image: url(img/brands/ripcurl.jpg);"></a>
    <a href="home.php" style="background-image: url(img/brands/oneill.png);"></a>
  </section>


  

  <!-- FOOTER -->
  <section class="footer">
  </section>
  

<!-- JAVASCRIPT -->
  <script>
    let div = '<div class="product">' +
        '<div class="image"><a href="home.php"><img src="img/product2.jpg" alt="" width="200" height="200"></a></div>'+
        '<div class="name">Surf Board</div>'+
        '<div class="price">15$</div>'+
        '<button class="cart-btn" onclick="location.href="home.php"">add to cart</button>'+
      '</div>';
    let temp = "";
    for (let index = 0; index < 8; index++) {
      temp = temp.concat(div);
    }
    document.querySelector('.products-container').innerHTML = temp;

 
  </script>
  
</body>
</html>