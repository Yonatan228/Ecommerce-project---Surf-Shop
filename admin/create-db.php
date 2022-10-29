<?php

  $conn = mysqli_connect("localhost","root", "");
  $query = "CREATE DATABASE IF NOT EXISTS surf_shop_db;";

  $query .= "use surf_shop_db;";

  $query .= "CREATE TABLE IF NOT EXISTS product(
              id int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              sku varchar(10),
              name varchar(150),
              description text,
              price int,
              category varchar(50),
              brand varchar(50),
              image varchar(255),
              in_stock bit default 1
              );";

  $query .= "CREATE TABLE IF NOT EXISTS category(
              id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              name varchar(50) not null
              );";

  $query .= "CREATE TABLE IF NOT EXISTS brand(
              id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              name varchar(50) not null
              );";

  if ($conn->multi_query($query) === TRUE) {
    echo "<script>console.log('Database created successfully')</script>";
  } else {
    echo "Error creating database: " . $conn->error;
  }

  $conn -> close();


?>