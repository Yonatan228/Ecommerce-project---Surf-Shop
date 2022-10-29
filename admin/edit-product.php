<?php
 include 'functions.php';
 $conn = db_connect();
 $id = $_GET['products'];
 $query = "select * from product where id='$id'";
 $result = mysqli_query($conn, $query);
 $row = mysqli_fetch_assoc($result);
 $sku = $row['sku'];
 $name = $row['name'];
 $desc = $row['description'];
 $price = $row['price'];
 $cat = $row['category'];
 $brand = $row['brand'];
 $stock = $row['in_stock'];
 $img =  $row['image'];
 CloseCon($conn);
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
    <form method="post">
      <div class="add-product-box-container">
          <input type="text" placeholder="sku *" name="sku" required value="<?php echo $sku;?>"><br><br>
          <textarea name="name" class="name" placeholder="Name *" required cols="30" rows="10"><?php echo $name;?></textarea><br><br>
          <textarea name="description" class="description" placeholder="Description" cols="30" rows="10"><?php echo $desc;?></textarea><br><br>
          <input type="text" placeholder="Price *" name="price" required value="<?php echo $price;?>"><br><br>
          <select name="category" required>
            <option>select a category *</option>
            <?php
            get_categories($cat);
            ?>
          </select><br><br>
          <select name="brand">
            <option>select a brand</option>
            <?php
            get_brands($brand);
            ?>
          </select><br><br>
          <select name="in-stock">
           <?php
            if($stock==1){
              echo "<option value='1' selected>In Stock</option>
                    <option value='0'>Out of Stock</option>";
                
            }
            else echo "<option value='1'>In Stock</option>
                       <option value='0' selected>Out of Stock</option>";
           ?>
          </select><br><br>
          <?php
            $flag = 0;
            if($img!= NULL || $img!=''){
              $flag=1;
              echo "<div style='border:2px solid rgb(30, 35, 78); margin:2px 568px; margin-bottom:18px; padding:15px 0; border-radius: 5px;'>
                      <img src='../img/$img'  width='100' height='100'><br><br><br><br>
                      Replace Image<br><br>
                      <input type='file' name='img' style='padding-top:3px; width:300px'><br>
                    </div>";
            }
            else{
              echo "<input type='file' name='img' style='padding-top:3px;'><br><br>";
            }
          ?>
          <input type="submit" name="edit-product" value="Edit Product" style="background-color: rgb(48, 55, 118); color: white; cursor: pointer;"> 
          <?php
            if(isset($_POST['edit-product'])){
              $conn = db_connect();
              $sku = $_POST['sku'];
              $name = $_POST['name'];
              $desc = $_POST['description'];
              $price = $_POST['price'];
              $cat = $_POST['category'];
              $brand = $_POST['brand'];
              $stock = $_POST['in_stock'];
              if($flag==0 || ($flag==1 && $_POST['img']!=NULL)){
                $img =  $_POST['img'];
              }
              $query = "update product set sku='$sku', name='$name', description='$desc', price='$price', category='$cat', brand='$brand', `in-stock` = $stock, image='$img' where id=$id;";
              $result = mysqli_query($conn, $query);
              if($result){
                echo "<script>alert('product has been updated')</script>";
                header("refresh:0, edit-product.php?products=$id");
              }
              CloseCon($conn);
            }
          ?>    
      </div>
    </form>
  </body>
</html>
