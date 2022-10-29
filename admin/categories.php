<?php
  add_category();
  delete_category();
 ?>

  <form action="" method="post">
    <div class="add-product-box-container" style="padding-top:100px">
      <input type="text" placeholder="Category Name" name="cat-name"><br><br>
      <input type="submit" name="add-category" value="Add Category" style="background-color: rgb(48, 55, 118); color: white; cursor: pointer;">     
    </div>
  </form>
  <div class="cat-grid-container">
    <div class="grid-item">NAME</div>
    <div class="grid-item">NUM OF PRODUCT</div>
    <div class="grid-item">ACTION</div>
    <?php
      get_categories();
    ?>
  </div>
