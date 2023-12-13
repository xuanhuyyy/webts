<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];
    $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
    $update_payment = $conn->prepare("UPDATE orders SET payment_status = ? WHERE id = ?");
    $update_payment->execute([$payment_status, $order_id]);
    echo '<script language="javascript">alert("Trạng thái thanh toán được cập nhật!"); window.location="placed_orders.php";</script>';
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_order = $conn->prepare("DELETE FROM orders WHERE id = ?");
    $delete_order->execute([$delete_id]);
    header('location:placed_orders.php');
}

if(isset($_POST['search_user'])){
    $search_user = $_POST['search_user'];
    $select_orders = $conn->prepare("SELECT * FROM orders WHERE name LIKE ?");
    $select_orders->execute(["%$search_user%"]);
} else {
    $select_orders = $conn->prepare("SELECT * FROM orders");
    $select_orders->execute();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đặt hàng</title>

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


<section class="orders">

    <h1 class="heading">Thông tin đặt hàng</h1>

    <div class="box-container">
        <?php
        if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="box">
                    <p> Thời gian đặt hàng : <span><?= date('d/m/Y H:i:s', strtotime($fetch_orders['placed_on'])); ?></span> </p>
                    <p> Họ tên : <span><?= $fetch_orders['name']; ?></span> </p>
                    <p> Số điện thoại : <span><?= $fetch_orders['number']; ?></span> </p>
                    <p> Địa chỉ : <span><?= $fetch_orders['address']; ?></span> </p>
                    <p> Tổng số đơn hàng : <span><?= $fetch_orders['total_products']; ?></span> </p>
                    <p> Tổng giá : <span><?= number_format($fetch_orders['total_price']); ?> VND</span> </p>
                    <p> Phương thức thanh toán : <span><?= $fetch_orders['method']; ?></span> </p>
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                        <select name="payment_status" class="select">
                            <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
                            <option value="đang xử lý">đang xử lý</option>
                            <option value="completed">completed</option>
                        </select>
                        <div class="flex-btn">
                            <input type="submit" value="update" class="option-btn" name="update_payment">
                            <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Xóa đơn hàng này?');">Xóa</a>
                        </div>
                    </form>
                </div>
                <?php
            }
        }else{
            echo '<p class="empty">Không có thông tin đơn hàng nào!</p>';
        }
        ?>
    </div>
</section>

</body>
</html>