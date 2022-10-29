<?php

//include this file for first time use - to create database
include 'create-db.php';


function db_connect(){
  $conn = mysqli_connect("localhost", "root", "","surf_shop_db");
  if(!$conn){
    die(mysqli_error($conn));
  }
  return $conn;
}
  
function CloseCon($conn){
 $conn -> close();
 }

function add_product(){

  $conn = db_connect();
  if(isset($_POST['add-product'])){
    $sku = $_POST['sku'];
    $name =  $conn -> real_escape_string($_POST['name']);
    $desc =  $conn -> real_escape_string($_POST['description']);
    $price = $_POST['price'];
    $cat = $_POST['category'];
    $brand = $_POST['brand'];
    $img = $_POST['img'];

    $query = "select count(*) as count from product where sku=$sku";
    $result = mysqli_query($conn, $query);
    if(mysqli_fetch_assoc($result)['count']>0){
        echo "<script>alert('sku allready exists')</script>";
      }
    else{
      $query = "INSERT INTO product(sku, name, description, price, category, brand, image)
      VALUES ('$sku', '$name', '$desc', '$price', '$cat', '$brand', '$img')";
      $result = mysqli_query($conn, $query);
      if($result){
        echo "<script>alert('Item has been added succefully')</script>";
      }
    }
  }
  CloseCon($conn);
}

function get_all_product(){
  $conn = db_connect();
  $query = "select * from product";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result)){
    $id = $row['id'];
    $sku = $row['sku'];
    $name = $row['name'];
    $price = $row['price'];
    $cat = $row['category'];
    $brand = $row['brand'];
    $stock = $row['in_stock'];
    $img =  $row['image'];
    if (stripos($_SERVER['REQUEST_URI'], 'dashboard.php')){
      echo "<div class='grid-item'>$sku</div>";
      echo "<div class='grid-item'>$name</div>";
      echo "<div class='grid-item'>$price</div>";
      echo "<div class='grid-item'>$cat</div>";
      echo "<div class='grid-item'>$brand</div>";
      echo "<div class='grid-item'>$stock</div>";
      echo "<div class='grid-item'><img src='../img/$img'  width='50' height='50'></div>";
      echo "<div class='grid-item'>
            <form action='edit-product.php?products=$id' method='post'>
              <input type='submit' name='edit' value='edit' style='height:30px; width:50px;'>
            </form>
            <form action='../product.php?id=$id' method='post'>
              <input type='submit' name='view' value='view' style='height:30px; width:50px; margin: 0 20px;'>
            </form>
            <form action='dashboard.php?products=$id' method='post'>
              <input type='submit' name='delete' value='delete' style='height:30px; width:50px; color:red;'>
            </form></div>";
    }
    else{
      echo "<div class='product'>
            <div class='image'><a href='product.php?id=$id'><img src='img/$img' width='200' height='200'></a></div>
            <div class='name'>$name</div>
            <div class='price'>$price$</div>
            <button class='cart-btn' onclick='location.href='home.php''>add to cart</button>
          </div>";
    }
    
  }
  CloseCon($conn);
}

function get_product(){
  $conn = db_connect();
  $id = $_GET['id'];
  $query = "select * from product where id=$id";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $sku = $row['sku'];
  $name = $row['name'];
  $price = $row['price'];
  $description = $row['description'];
  $cat = $row['category'];
  $brand = $row['brand'];
  $stock = $row['in_stock'];
  $img =  $row['image'];
  if($stock == 1){
    $stock = "<input type='submit' class='add-to-cart-btn' value='ADD TO CART'>";
  }
  else {
    $stock = "<p class='out-of-stock'>OUT OF STOCK</p>";
  }
  echo "<div class='product-img'>
          <img src='img/$img'>
        </div>
        <div class='details'>
          <ul>
            <li class='title'>$name</li>
            <li class='price'>$$price</li>
            <li class='description'><br>$description<br><br>BRAND: $brand<br><br>SKU: $sku</li>
          </ul>
          $stock
        </div>";
  CloseCon($conn);
}


function delete_product(){
  $conn = db_connect();
  if(isset($_POST['delete'])){
    $id = $_GET['products'];
    $query = "delete from product where id=$id";
    $result = mysqli_query($conn, $query);
    if($result){
      echo "<script>alert('Item has been deleted')</script>";
    }
    
  }
  CloseCon($conn);
}



function get_categories($cat = NULL){
  $conn = db_connect();
  $query = "select * from category";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result)){
    $name = $row['name'];
    $id = $row['id'];
    if (isset($_GET["categories"])){
      $query = "select count(*) as count from product where category='$name'";
      $result2 = mysqli_query($conn, $query);
      $count = mysqli_fetch_assoc($result2)['count'];
      echo "<div class='grid-item'>$name</div>";
      echo "<div class='grid-item'>$count</div>";
      echo "<div class='grid-item' style='padding:0 10px;'>
          <form action='../shop.php?category=$name' method='post'>
            <input type='submit' name='view' value='view' style='height:30px; width:60px; margin-right:15px;'>
          </form>
          <form action='dashboard.php?categories=$name' method='post'>
            <input type='submit' name='delete' value='delete' style='height:30px; width:60px; margin-left:15px;  color:red;'>
          </form></div>";
    }
    else if(isset($_GET["add-product"])){
      echo "<option value='$name'>$name</option>";
    }
    else if(strpos($_SERVER['REQUEST_URI'], 'edit-product.php')){
      if($cat==$name){
        echo "<option value='$name' selected>$name</option>";
      }
      else echo "<option value='$name'>$name</option>";
    }
    else{
          echo "<li><a href='shop.php?category=$name'>$name</a></li>";
    }
  
  }
  CloseCon($conn);
}


function add_category(){
  $conn = db_connect();
  if(isset($_POST['add-category'])){
    $name = $_POST['cat-name'];
    if($name==''){
      echo "<script>alert('enter a category name')</script>";
    }
    else{
        $query = "select count(*) as count from category where name='$name'";
        $result = mysqli_query($conn, $query);
        if(mysqli_fetch_assoc($result)['count'] > 0){
          echo "<script>alert('category allready exists')</script>";
        }
      else{
        $query = "insert into category(name) values('$name')";
        $result = mysqli_query($conn, $query);
        if($result){
          echo "<script>alert('category has been added succefully')</script>";
        }
        else{
          echo "<script>alert('unable to add category')</script>";
        }
      }
    } 
  }
  CloseCon($conn);
}


function delete_category(){
  $conn = db_connect();
  if(isset($_POST['delete'])){
    $name = $_GET['categories'];
    $query = "delete from category where name='$name'; update product set category='' where category='$name';";
    $result = mysqli_multi_query($conn, $query);
    if($result){
      echo "<script>alert('category has been deleted')</script>";
    }
  }
  CloseCon($conn);
}




function get_brands($brand=NULL){
  $conn = db_connect();
  $query = "select * from brand";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result)){
    $name = $row['name'];
    $id = $row['id'];
    if (isset($_GET["brands"])){
      $query = "select count(*) as count from product where brand='$name'";
      $result2 = mysqli_query($conn, $query);
      $count = mysqli_fetch_assoc($result2)['count'];
      echo "<div class='grid-item'>$name</div>";
      echo "<div class='grid-item'>$count</div>";
      echo "<div class='grid-item' style='padding:0 10px'>
          <form action='dashboard.php?brands=$id' method='post'>
          <input type='submit' name='view' value='view' style='height:30px; width:60px; margin-right:15px; '>
          <input type='submit' name='delete' value='delete' style='height:30px; width:60px; margin-left:15px; color:red;'>
          </form></div>";
    }
    else if(isset($_GET["add-product"])){
      echo "<option value='$name'>$name</option>";
    }
    else if(strpos($_SERVER['REQUEST_URI'], 'edit-product.php')){
      if($brand==$name){
        echo "<option value='$name' selected>$name</option>";
      }
      else echo "<option value='$name'>$name</option>"; 
    }
    else{
      echo "<input type='checkbox' name='brand[]' value='$name'> $name<br/>";
    }
    
  }
  CloseCon($conn);
}



function add_brand(){
  $conn = db_connect();
  if(isset($_POST['add-brand'])){
    $name = $_POST['brand-name'];
    if($name==''){
      echo "<script>alert('enter a brand name')</script>";
    }
    else{
        $query = "select count(*) as count from brand where name='$name'";
        $result = mysqli_query($conn, $query);
        if(mysqli_fetch_assoc($result)['count'] > 0){
          echo "<script>alert('brand allready exists')</script>";
        }
      else{
        $query = "insert into brand(name) values('$name')";
        $result = mysqli_query($conn, $query);
        if($result){
          echo "<script>alert('brand has been added succefully')</script>";
        }
        else{
          echo "<script>alert('unable to add brand')</script>";
        }
      }
    } 
  }
  CloseCon($conn);
}


function delete_brand(){
  $conn = db_connect();
  if(isset($_POST['delete'])){
    $id = $_GET['brands'];
    $query = "delete from brand where id=$id";
    $result = mysqli_query($conn, $query);
    if($result){
      echo "<script>alert('brand has been deleted')</script>";
    }
    
  }
  CloseCon($conn);
}


function get_product_per_category(){
  $conn = db_connect();
  $name = $_GET['category'];
  $query = "select * from product where category='$name'";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result)){
    $id = $row['id'];
    $name = $row['name'];
    $price = $row['price'];
    $img =  $row['image'];
    echo "<div class='product'>
            <div class='image'><a href='product.php?id=$id'><img src='img/$img' width='200' height='200'></a></div>
            <div class='name'>$name</div>
            <div class='price'>$price$</div>
            <button class='cart-btn' onclick='location.href='home.php''>add to cart</button>
          </div>";
  }
  CloseCon($conn);
}

function filter(){
  
  if(!empty($_POST['brand'])) {
    $conn = db_connect();
    foreach($_POST['brand'] as $value){
      if(isset($_GET['category'])){
        $name = $_GET['category'];
        $query = "select * from product where category='$name' and brand='$value'";
        $result = mysqli_query($conn, $query);
      }
      else{
        $query = "select * from product where brand='$value'";
        $result = mysqli_query($conn, $query);
      }
      while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $img =  $row['image'];
        echo "<div class='product'>
                <div class='image'><a href='product.php?id=$id'><img src='img/$img' width='200' height='200'></a></div>
                <div class='name'>$name</div>
                <div class='price'>$price$</div>
                <button class='cart-btn' onclick='location.href='home.php''>add to cart</button>
              </div>";
      }
    }
    CloseCon($conn);
    return false;
  }
  return true;
} 


?>