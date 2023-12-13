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
   <title>Trang chủ</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

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
            <h3>CHÚNG TÔI LÀ</h3>
            <h4 class="h4">C4 Coffee & Tea</h4>
            <p>Thứ 2 đến Chủ Nhật hàng tuần: 07 am - 11 pm</p>
            <p>------------------------------</p>
            <p>Chúng tôi đi khắp thế giới để tìm kiếm cà phê tuyệt vời. Trong quá trình đó, chúng tôi phát hiện ra những
               hạt đậu đặc biệt và hiếm đến nỗi chúng tôi có thể chờ đợi để mang chúng về.</p>
         </div>
         <div class="image">
            <img src="image/cfxoaphong.png" alt="">
         </div>
      </div>
   </section>

   <section class="home-products">
      <h3 class="heading">Sản phẩm mới nhất</h3>
      <a href="shop.php" class="xemthem">Xem thêm</a>
      <div class="swiper products-slider">
         <div class="swiper-wrapper">
            <?php
            $select_products = $conn->prepare("SELECT * FROM products LIMIT 6");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
               while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <form action="" method="post" class="swiper-slide slide">
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
                           <?= number_format($fetch_product['price']); ?><span> VND</span>
                        </div>
                        <input type="number" name="qty" class="qty" min="1" max="99"
                           onkeypress="if(this.value.length == 2) return false;" value="1">
                     </div>
                     <input type="submit" value="Thêm vào giỏ hàng" class="btn" name="add_to_cart">
                  </form>
                  <?php
               }
            } else {
               echo '<p class="empty">Chưa có sản phẩm nào!</p>';
            }
            ?>
         </div>
         <div class="swiper-pagination"></div>
      </div>
   </section>
   <div class="container">
      <div class="item">
         <img src="image/MIEN-PHI-VAN-CHUYEN-removebg-preview.png" alt="">
         <p>MIỄN PHÍ VẬN CHUYỂN</p>
         <p>Cho đơn hàng 1kg</p>
      </div>
      <div class="item">
         <img src="image/MIEN-PHI-DOI-TRA-removebg-preview.png" alt="Tea cup icon">
         <p>MIỄN PHÍ ĐỔI TRẢ</p>
         <p>Do lỗi sản phẩm hoặc vận chuyển</p>
      </div>
      <div class="item">
         <img src="image/hatcf-removebg-preview.png" alt="Bird icon">
         <p>CÀ PHÊ XÂY MỚI 100%</p>
         <p>Chỉ xay cà phê khi khách đặt</p>
      </div>
      <div class="item">
         <img src="image/LIEN-HE-MUA-HANG-min-removebg-preview.png" alt="Phone icon">
         <p>LIÊN HỆ MUA HÀNG</p>
         <p>Hotline: 0327565878</p>
      </div>
   </div>
   <section class="about1">
      <div class="row">
         <div class="content">
            <p>
            <h3>HÌNH ẢNH QUÁN CAFE</h3>
            </p>
         </div>
         <div class="row1">
            <div class="image">
               <img src="image/quan7.webp" id="img1" alt="">
            </div>
            <div class="content1">
               <div>
                  <img src="image/quan1.jpg" alt="">
                  <img src="image/quan.jpg" alt="">
               </div>
               <div>
                  <img src="image/quan2.jpg" alt="">
                  <img src="image/quan3.jpg" alt="">
               </div>
            </div>
         </div>
      </div>
   </section>
   <div class="category">
      <h1>“THƯ GIÃN CÙNG C4 MỖI BUỔI SÁNG, SỰ TÍCH CỰC TRÀN NGẬP TRONG BẠN”</h1>
      <h2>C4 Team</h2>
   </div>
   <?php include 'components/footer.php'; ?>
   <script src="js/script.js"></script>
   <script>
      var swiper = new Swiper(".products-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            550: {
               slidesPerView: 2,
            },
            768: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });
   </script>
</body>

</html>