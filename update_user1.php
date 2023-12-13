<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $diachi = $_POST['diachi'];
    $diachi = filter_var($diachi, FILTER_SANITIZE_STRING);
    $sdt = $_POST['sdt'];
    $sdt = filter_var($sdt, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_users->execute([$user_id]);

    if ($select_users->rowCount() > 0) {
        $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ?, image = ?, diachi = ?, sdt = ? WHERE id = ?");
        $update_profile->execute([$name, $email, $image, $diachi, $sdt, $user_id]);
        move_uploaded_file($image_tmp_name, $image_folder);
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
        $select_user->execute([$user_id]);
        $fetch_profile = $select_users->fetch(PDO::FETCH_ASSOC);
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/main.css">

</head>

<body>

    <?php include 'components/user_header.php'; ?>
    <section class="form-container">
        <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Thông tin</h3>
            <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>">
            <input type="text" name="name" required placeholder="Nhập tên đăng nhập" maxlength="20" class="box"
                value="<?= $fetch_profile["name"]; ?>">
            <input type="email" name="email" required placeholder="Nhập email" maxlength="50" class="box"
                oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile["email"]; ?>">
            <input type="text" name="diachi" required placeholder="Nhập địa chỉ" maxlength="50" class="box"
                oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile["diachi"]; ?>">
            <input type="text" name="sdt" required placeholder="Nhập số điện thoại" maxlength="50" class="box"
                oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile["sdt"]; ?>">
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            <input type="submit" value="Cập nhật ngay" class="btn" name="submit">
        </form>
    </section>

    <?php include 'components/footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>