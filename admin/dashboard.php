<?php
  include 'functions.php';
?>

<html lang="en">
  <head>
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="title-panel">
      ADMIN PANEL
    </div>
    <div class="navbar">
      <a href="dashboard.php?products">All Product</a>
      <a href="dashboard.php?add-product">Add Products</a>
      <a href="dashboard.php?categories">Categories</a>
      <a href="dashboard.php?brands">Brands</a>
      <a href="#">Orders</a>
      <a href="#">Users</a>
    </div>

    <?php
      if(isset($_GET['products'])){
        include 'all-products.php';
      }
      if(isset($_GET['categories'])){
        include 'categories.php';
      }
      if(isset($_GET['brands'])){
        include 'brands.php';
      }
      if(isset($_GET['add-product'])){
        include 'add-product.php';
      }
    ?>
    
  </body>
</html>