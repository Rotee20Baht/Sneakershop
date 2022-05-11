<?php
    session_start();
    include 'php/config.php';
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
    <title>Sneakershop.com | สรุปข้อมูล</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <style>
        main{
            width: 100%;
            /* border: 1px solid red; */
        }

        .main-container{
            width: 60%;
            /* border: 1px solid red; */
            margin: 2rem auto;
            padding: 0.5rem;
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
            column-gap: 1rem;
            row-gap: 1rem;
            /* border-bottom: 2px solid #ccc; */
        }

        .data-con{
            flex: 0 0 45%;
        }

        .title{
            font-size: 20px;
            text-align: start;
        }

        .am-box{
            /* width: 30%; */
            height: 10vh;
            background-color: lime;
            border-radius: 0.6rem;
            padding: 0.9rem 1rem;
            margin-top: 0.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #data-con-1{
            background-image: linear-gradient(to right, #56ab2f, #a8e063);
        }

        #data-con-2{
            background-image: linear-gradient(to right, #0083B0, #00B4DB);
        }

        #data-con-3{
            background-image: linear-gradient(to right, #F37335, #FDC830);
        }

        #data-con-4{
            background-image: linear-gradient(to right, #834d9b, #d04ed6);
        }

        .text{
            font-size: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 0.3rem 0.6rem;
            border-radius: 5px;
            color: #fff;
        }
    </style>
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
</body>
<main>
    <div class="main-container">
        <div class="data-con">
            <div class="title"><i class="fa-solid fa-user-gear" style="color: #56ab2f;"></i> จำนวนผู้ดูแลทั้งหมด</div>
            <div class="am-box" id="data-con-1">
                <div class="text">
                    <?php
                        $sql = mysqli_query($conn, "SELECT COUNT(*) as Admin FROM `user` WHERE level = 'a'") or die('Query Failed');
                        if(mysqli_num_rows($sql)  > 0){
                            while($rows = mysqli_fetch_assoc($sql)){
                                echo "<span>".$rows['Admin']."</span>";
                            }
                        }
                    ?> <span style="color:#a8e063;">คน</span>
                </div>
            </div>
        </div>
        <div class="data-con">
            <div class="title"><i class="fa-solid fa-user-tag" style="color: #0083B0;"></i> จำนวนผู้ใช้งานทั้งหมด</div>
            <div class="am-box" id="data-con-2">
                <div class="text">
                    <?php
                        $sql = mysqli_query($conn, "SELECT COUNT(*) as Member FROM `user` WHERE level = 'm'") or die('Query Failed');
                        if(mysqli_num_rows($sql)  > 0){
                            while($rows = mysqli_fetch_assoc($sql)){
                                echo "<span>".$rows['Member']."</span>";
                            }
                        }
                    ?> <span style="color:#00B4DB;">คน</span>
                </div>
            </div>
        </div>
        <div class="data-con">
            <div class="title"><i class="fa-solid fa-box-open" style="color: #F37335;"></i> จำนวนรองเท้าทั้งหมด</div>
            <div class="am-box" id="data-con-3">
                <div class="text">
                    <?php
                        $sql = mysqli_query($conn, "SELECT COUNT(shoes_id) as Shoes FROM `shoes`") or die('Query Failed');
                        if(mysqli_num_rows($sql)  > 0){
                            while($rows = mysqli_fetch_assoc($sql)){
                                echo "<span>".$rows['Shoes']."</span>";
                            }
                        }
                    ?> <span style="color: #FDC830;">คู่</span>
                </div>
            </div>
        </div>
        <div class="data-con">
            <div class="title"><i class="fa-solid fa-wallet" style="color:#834d9b ;"></i> รายได้ทั้งหมด</div>
            <div class="am-box" id="data-con-4">
                <div class="text">
                    <?php
                        $sql = mysqli_query($conn, "SELECT SUM(total_price) as income FROM `order_record` 
                                                    WHERE order_status = 'suc'") or die('Query Failed');
                        if(mysqli_num_rows($sql)  > 0){
                            while($rows = mysqli_fetch_assoc($sql)){
                                echo "<span>".$rows['income']."</span>";
                            }
                        }
                    ?> <span style="color: #d04ed6;">บาท</span>
                </div>
            </div>
        </div>
    </div>
</main>
</html>