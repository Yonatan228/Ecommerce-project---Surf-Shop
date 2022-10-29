<?php
  add_brand();
  delete_brand();
?>

  <form action="" method="post">
      <div class="add-product-box-container" style="padding-top:100px">
        <input type="text" placeholder="Brand Name" name="brand-name"><br><br>
        <input type="submit" name="add-brand" value="Add Brand" style="background-color: rgb(48, 55, 118); color: white; cursor: pointer;">     
      </div>
    </form>
  <div class="cat-grid-container">
    <div class="grid-item">NAME</div>
    <div class="grid-item">NUM OF PRODUCT</div>
    <div class="grid-item">ACTION</div>
    <?php
      get_brands();
    ?>
  </div>
 