<?php

global $conn;
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      echo '<script language="javascript">alert("Tên sản phẩm đã tồn tại!"); window.location="products.php";</script>';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `products`(name, details, price, image_01) VALUES(?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01]);

      if($insert_products){
         if($image_size_01 > 20000000 OR $image_size_02 > 20000000 OR $image_size_03 > 20000000){
            echo '<script language="javascript">alert("Kích thước ảnh quá lớn!"); window.location="products.php";</script>';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            echo '<script language="javascript">alert("Đã thêm sản phẩm mới!"); window.location="products.php";</script>';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sản phẩm</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_main.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="search-form">
    <form method="POST" action="placed_orders.php">
        <input type="text" name="search_user" placeholder="search here..." maxlength="100" class="box" required>
        <button type="submit" class="fas fa-search" name="search_btn"></button>
    </form>
</section>

<section class="add-products">

   <h1 class="heading">Thêm sản phẩm</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>Tên sản phẩm (bắt buộc)</span>
            <input type="text" class="box" required maxlength="100" placeholder="Nhập tên sản phẩm" name="name">
         </div>
         <div class="inputBox">
            <span>Giá sản phẩm (bắt buộc)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="Nhập giá sản phẩm" onkeypress="if(this.value.length == 15) return false;" name="price">
         </div>
        <div class="inputBox">
            <span>Ảnh (bắt buộc)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         <div class="inputBox">
            <span>Mô tả sản phẩm (bắt buộc)</span>
            <textarea name="details" placeholder="Nhập mô tả sản phẩm" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
      </div>
      
      <input type="submit" value="Thêm sản phẩm" class="btn" name="add_product">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">Sản phẩm đã thêm</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="price"><span><?= $fetch_products['price']; ?></span> VND</div>
      <div class="details"><span><?= $fetch_products['details']; ?></span></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Cập nhật</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Xóa sản phẩm này?');">Xóa</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Không có sản phẩm nào đã thêm!</p>';
      }
   ?>
   
   </div>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>