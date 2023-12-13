<?php
include '../components/connect.php';

session_start();

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
} else {
    $admin_id = '';
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
   
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/' . $image;

    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
    $select_admin->execute([$admin_id]);

    if ($select_admin->rowCount() > 0) {
        $update_profile = $conn->prepare("UPDATE `admins` SET name = ?, image = ? WHERE id = ?");
        $update_profile->execute([$name, $image, $admin_id]);
        move_uploaded_file($image_tmp_name, $image_folder);
        $select_user = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
        $select_user->execute([$admin_id]);
        $fetch_profile = $select_admin->fetch(PDO::FETCH_ASSOC);
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

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_main.css">

</head>

<body>

    <?php include '../components/admin_header.php'; ?>
    <section class="form-container1">
        <img src="../uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Thông tin</h3>
            <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>">
            <input type="text" name="name" required placeholder="Nhập tên đăng nhập" maxlength="20" class="box"
                value="<?= $fetch_profile["name"]; ?>">
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            <input type="submit" value="Cập nhật ngay" class="btn" name="submit">
        </form>
    </section>

    <script src="../js/admin_script.js"></script>

</body>

</html>