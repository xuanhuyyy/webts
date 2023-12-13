<?php

global $conn;
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tìm kiếm</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/main.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="about">
      <div class="row">
         <div class="content">
            <?php
            if (isset($_POST['search_box'])) {
               $searchKeyword = htmlspecialchars($_POST['search_box']);
               echo "<p><h3>Kết quả tìm kiếm với từ khóa: '$searchKeyword'</h3></p>";
            } else {
               echo "<p>Không có từ khóa tìm kiếm.</p>";
            }
            ?>
         </div>
      </div>
   </section>

   <section class="products1" style="padding-top: 0; min-height:100vh;">

      <div class="box-container">

         <?php
         if (isset($_POST['search_box']) or isset($_POST['search_btn'])) {
            $search_box = $_POST['search_box'];
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
               while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <form action="" method="post" class="box">
                     <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                     <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                     <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                     <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                     <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                     <div class="name">
                        <?= $fetch_product['name']; ?>
                     </div>
                     <div class="flex">
                        <div class="price"><span></span>
                           <?= $fetch_product['price']; ?><span> VND</span>
                        </div>
                        <input type="number" name="qty" class="qty" min="1" max="99"
                           onkeypress="if(this.value.length == 2) return false;" value="1">
                     </div>
                     <input type="submit" value="Thêm vào giỏ hàng" class="btn" name="add_to_cart">
                  </form>
                  <?php
               }
            } else {
               echo '<p class="empty">Không tìm thấy sản phẩm nào!</p>';
            }
         }
         ?>

      </div>

   </section>

   <?php include 'components/footer.php'; ?>
   <script src="js/script.js"></script>
</body>

</html>