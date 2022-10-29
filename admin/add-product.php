<?php
  add_product();
?>

<form method="post">
  <div class="add-product-box-container">
      <input type="text" placeholder="sku *" name="sku" required><br><br>
      <textarea name="name" class="name" placeholder="Name *" required cols="30" rows="10"></textarea><br><br>
      <textarea name="description" class="description" placeholder="Description" cols="30" rows="10"></textarea><br><br>
      <input type="text" placeholder="Price *" name="price" required><br><br>
      <select name="category" required>
        <option>Select a category *</option>
        <?php
        get_categories();
        ?>
      </select><br><br>
      <select name="brand">
        <option>Select a brand</option>
        <?php
        get_brands();
        ?>
      </select><br><br>
      <input type="file" name="img" style="padding-top:5px;"><br><br>
      <input type="submit" name="add-product" value="Add Product" style="background-color: rgb(48, 55, 118); color: white; cursor: pointer;">     
  </div>
</form>
