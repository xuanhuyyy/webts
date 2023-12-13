<?php
global $conn;
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

<header class="header">

   <section class="flex">

      <a href="../admin/dashboard.php" class="logo"><img src="../image/bgrr.png" class="logo"></a>

      <nav class="navbar">
         <a href="../admin/dashboard.php">Trang chủ</a>
         <a href="../admin/products.php">Sản phẩm</a>
         <a href="../admin/placed_orders.php">Đơn hàng</a>
         <a href="../admin/admin_accounts.php">Quản trị viên</a>
         <a href="../admin/users_accounts.php">Người dùng</a>
      </nav>
      
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="../admin/messages.php"><i class="fas fa-message"></i></a>
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
         $select_profile->execute([$admin_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <img id="user-btn" class="fas fa-user" src="../uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
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
         $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
         $select_profile->execute([$admin_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <p>
               Xin chào,
               <?= $fetch_profile["name"]; ?>
            </p>
            <a href="../admin/update_profile1.php" class="option-btn">Cập nhật thông tin</a>
            <a href="../admin/update_profile.php" class="btn">Đổi mật khẩu</a>
            <a href="../components/admin_logout.php" class="delete-btn"
               onclick="return confirm('Đăng xuất khỏi website?');">Đăng xuất</a>
            <?php
         }
         ?>
      </div>
   </section>
</header>