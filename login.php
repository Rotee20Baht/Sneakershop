<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakershop.com | เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <style>
        a{
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo"><a href="index.php">Sneakershop</a></div>
            <div class="serch-box">
                <form action="#">
                    <input type="text" placeholder="ค้นหาสินค้า..." required>
                    <button type="#" required><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="action-list-box">
                <div class="login-box"><a href="">เข้าสู่ระบบ </a><i class="fa fa-lock" aria-hidden="true"></i></div>
                <div class="cart-box"><a href="cart.php">ตะกร้าของคุณ <i class="fa fa-shopping-basket" aria-hidden="true"></i></a></div>
            </div>
        </div>
    </header>
    <nav>
        <div class="nav-contrainer">
            <ul>
                <li>สินค้ามาใหม่ <i class="fa fa-angle-down" aria-hidden="true"></i></li>
                <li>สินค้ายอดนิยม <i class="fa fa-angle-down" aria-hidden="true"></i></li>
                <li>สินค้าโปรโมชั่น <i class="fa fa-angle-down" aria-hidden="true"></i></li>
                <li><a href="showshoes.php">รองเท้า <i class="fa-solid fa-bag-shopping"></i></a></li>
                <li><a href="orderdetail.php">รายละเอียดการสั่งซื้อ <i class="fa-solid fa-box-archive"></i></a></li>
            </ul>
        </div>
    </nav>
    <article>
        <div class="regis-box">
            <form action="#" method="post">
                <p>เข้าสู่ระบบ</p>
                <hr>
                    <div class="input-box">
                        <label>ชื่อผู้ใข้งาน</label>
                        <input type="text" name="username" placeholder="Your Username..." required>
                    </div>
                    <div class="input-box">
                        <label>รหัสผ่าน</label>
                        <input type="password" name="password" placeholder="Your Password..." required>
                    </div>    
                    <div class="submit-btn">
                        <input type="submit" value="เข้าสู่ระบบ" name="submit">
                    </div>
                    <div class="login">
                        <span>หรือ</span><a href="register.php">สมัครสมาชิก?</a>
                    </div>
            </form>
        </div>
    </article>
    <footer>
    </footer>
    <?php
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if(isset($_POST['submit'])){
            include 'php/config.php';
            $username = $_POST['username'];
            $password = $_POST['password'];
            $passwordenc = md5($password);
            
            $query = "SELECT * FROM user WHERE username = '$username' AND password = '$passwordenc'";

            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) == 1) {

                $row = mysqli_fetch_array($result);

                $_SESSION['userid'] = $row['id'];
                $_SESSION['user'] = $row['username'];
                $_SESSION['userlevel'] = $row['level'];

                echo '<script>';
                if($_SESSION['userlevel'] == 'a') {
                echo "Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'เข้าสู่ระบบสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) =>{
                    window.location.href='admin.php';
                })";
                echo '</script>';
                }elseif($_SESSION['userlevel'] == 'm'){
                    echo "Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'เข้าสู่ระบบสำเร็จ',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) =>{
                        window.location.href='user.php';
                    })";
                    echo '</script>';
                }
                // if($_SESSION['userlevel'] == 'a') {
                //     header("Location: admin.php");
                // }
                // if ($_SESSION['userlevel'] == 'm') {
                //     header("Location: user.php");
                // }
            }else{
                echo '<script>';
                echo "Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง',
                    showConfirmButton: false,
                    timer: 2000
                })";
                echo '</script>';
            }
        }
    ?>  
</body>
</html>