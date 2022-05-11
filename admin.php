<?php
    session_start();
    // include 'php/config.php';
    if($_SESSION['userlevel'] != 'a'){
        header('Location : login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakershop.com | ผู้ดูแล</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">Sneakershop.com</div>
            <div class="serch-box">
                <form action="#">
                    <input type="text" placeholder="ค้นหาสินค้า..." required>
                    <button type="submit" required><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="action-list-box">
                <div class="login-box"><a href="logout.php">ออกจากระบบ </a><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
                <!-- <div class="cart-box">ตะกร้าของคุณ <i class="fa fa-shopping-basket" aria-hidden="true"></i></div> -->
            </div>
        </div>
    </header>
    <nav>
        <div class="nav-contrainer">
            <ul>
                <li><a href="addproduct.php">เพิ่มสินค้า <i class="fa-solid fa-cart-plus"></i></a></li>
                <li><a href="shoesdata.php">รายการสินค้าทั้งหมด <i class="fa-solid fa-database"></i></a></li>
                <li><a href="summary.php">สรุปข้อมูล <i class="fa-solid fa-clipboard-list"></i></a></li>
                <li>รองเท้า <i class="fa fa-angle-down" aria-hidden="true"></i></li>
                <li><a href="ordermanage.php">จัดการคำสั่งซื้อ <i class="fa-solid fa-box-archive"></i></a></li>
            </ul>
        </div>
    </nav>
    <h1>ยินดีต้อนรับ Admin : <?php echo $_SESSION['user'];?></h1>
</body>
</html>