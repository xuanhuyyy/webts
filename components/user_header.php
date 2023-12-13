<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
         <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
   }
}
?>

<head>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/main.css">
</head>
<header class="header">
   <section class="flex">
      <a href="home.php"><img src="image/bgrr.png" class="logo"></img></a>
      <nav class="navbar">
         <a href="about.php">Giới thiệu</a>
         <a href="orders.php">Đơn hàng</a>
         <a href="shop.php">Sản phẩm</a>
         <a href="contact.php">Liên hệ</a>
      </nav>
      <div class="icons">
         <?php
         $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
         $count_wishlist_items->execute([$user_id]);
         $total_wishlist_counts = $count_wishlist_items->rowCount();

         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <section class="search-form">
            <form action="search_page.php" method="post">
               <input type="text" name="search_box" placeholder="search here..." maxlength="100" class="box" required>
               <button type="submit" class="fas fa-search" name="search_btn"></button>
            </form>
         </section>
      </div>
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(
               <?= $total_cart_counts; ?>)
            </span></a>
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <img id="user-btn" class="fas fa-user" src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
            <?php
         } else {
            ?>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
         }
         ?>
      </div>
      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <p>
               Xin chào,
               <?= $fetch_profile["name"]; ?>
            </p>
            <a href="update_user1.php" class="option-btn">Cập nhật thông tin</a>
            <a href="update_user.php" class="btn">Đổi mật khẩu</a>
            <a href="components/user_logout.php" class="delete-btn"
               onclick="return confirm('Đăng xuất khỏi website?');">Đăng xuất</a>
            <?php
         } else {
            ?>
            <p>Vui lòng đăng nhập hoặc đăng ký!</p>
            <div class="flex-btn">
               <a href="user_register.php" class="option-btn">Đăng ký</a>
               <a href="user_login.php" class="option-btn">Đăng nhập</a>
            </div>
            <?php
         }
         ?>
      </div>
   </section>


</header>
<div class="home-bg">
   <section class="home">
      <div class="swiper home-slider">
         <div class="swiper-wrapper">
            <div class="swiper-slide slide">
               <div class="image">
                  <img src="image/antique-cafe-bg-03.jpg" alt="">
               </div>
               <div class="content">
                  <h3>Vùng nguyên liệu tin cậy</h3>
                  <span>Tại C4 Coffee, hạt cà phê được tuyển chọn từ vùng nguyên liệu nổi tiếng: Đắk Lắk, Lâm Đồng,
                     Quảng Trị. Quả cà phê được chọn lọc, hái chín 100% bởi bàn tay cần mẫn của người nông
                     dân.</span>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="image">
                  <img src="image/1b2f3b6e76ce850312de20d045c019e2.jpg" alt="">
               </div>
               <div class="content">
                  <h3>Đóng gói theo tiêu chuẩn</h3>
                  <span>Cà phê sau khi được rang xay sẽ được đóng gói bằng túi chuyên dụng có van 1 chiều, giúp bảo
                     quản cafe tốt hơn, cafe giữ được hương vị lâu hơn sau khi mở bao bì.</span>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="image">
                  <img src="image/antique-cafe-bg-04.jpg" alt="">
               </div>
               <div class="content">
                  <h3>Thưởng thức sự tuyệt hảo</h3>
                  <span>Hạt cà phê rang xay, cafe bột nguyên chất được phân phối đến người tiêu dùng qua dịch vụ
                     chuyển phát. Bạn có thể chọn cafe pha phin hoặc pha máy để thưởng thức.</span>
               </div>
            </div>
         </div>
         <div class="swiper-pagination"></div>
      </div>
   </section>
</div>

<script src="js/script.js"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
   var swiper = new Swiper(".home-slider", {
      loop: true,
      spaceBetween: 20,
      pagination: {
         el: ".swiper-pagination",
         clickable: true,
      },
   });
</script>