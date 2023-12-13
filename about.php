<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

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
            <br><h4>Chào mừng bạn đến với</h4>
            <div class="background"><p><h1 class="h3">C4 Coffee & tea</h1></p></div>
            <p><h4>CÔNG TY TNHH C4 COFFEE & TEA ĐƯỢC THÀNH LẬP NĂM 2023.</h4></p>
         </div>
      </div>
   </section>

   <section class="about">
      <div class="row">
         <div class="image">
            <img src="image/hinh-cafe-buon-nen-xanh.jpg" alt="">
         </div>
         <div class="content">
            <h3>GIỜ MỞ CỬA</h3>
            <p><h4>Hàng ngày</h4></p>
            <p>07am - 11am</p>
            <p>01pm - 11pm</p>
            <p>------------------------------</p>
            <p><h4>Số điện thoại: </h4></p>
            <h3>0327 565 878</h3>
         </div>
      </div>
   </section>
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
   <section class="reviews">
      <p>
      <h3>C4 TRONG BẠN</h3>
      </p>
      <p>Tại C4 coffee, chúng tôi luôn mong muốn khách hàng có sự trải nghiệm mùi vị cà phê thơm ngon nhất đến từ vùng
         đất Tây Nguyên
         Tiên phong trong nhiệm vụ của chúng tôi là làm sao khách hàng được thưởng thức trọn vẹn hương vị tự nhiên nhất,
         quy trình rang xay một cách khắt khe, chế biến hoàn toàn không pha những chất liệu.</p>
      <p>Chúng tôi luôn mong muốn mang đến quý khách hàng những giọt cà phê thơm ngon, chất lượng nhất từ vùng đất tây
         nguyên, với kinh nghiệm được truyền lại từ những thế hệ 1994,C4 luôn khắt khe từ khâu trồng trọt, thu hoạch,
         rang, xay để quý khách hàng có thể thưởng thức được mùi vị thơm ngon nhất.</p>
      <p><a href="contact.php" class="btn">Liên hệ với chúng tôi</a></p>
   </section>

   <?php include 'components/footer.php'; ?>
   <script src="js/script.js"></script>
</body>

</html>