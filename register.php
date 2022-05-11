<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakershop.com | สมัครสมาชิก</title>
    <link rel="stylesheet" href="css/register.css">
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
                <div class="login-box">
                    <?php if(isset($_SESSION['userlevel'])){
                        echo '<a href="logout.php">ออกจากระบบ </a><i class="fa-solid fa-arrow-right-from-bracket"></i>';
                    ?>
                    <?php }else{
                        echo '<a href="login.php"> เข้าสู่ระบบ </a><i class="fa fa-lock" aria-hidden="true"></i>';
                    }?>
                </div>
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
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <p>สมัครสมาชิก</p>
                <hr>
                    <div class="input-box">
                        <label>ชื่อผู้ใข้งาน</label>
                        <input type="text" name="username" placeholder="Your Username..." required>
                    </div>
                    <div class="input-box">
                        <label>รหัสผ่าน</label>
                        <input type="password" name="password" placeholder="Your Password..." required>
                    </div>
                    <div class="input-box">
                        <label>ยืนยันรหัสผ่าน</label>
                        <input type="password" name="conpassword" placeholder="Confirm Your Password..." required>
                    </div> 
                    <div class="input-box">
                        <label>ชื่อจริง</label>
                        <input type="text" name="fname" placeholder="Your First Name..." required>
                    </div>  
                    <div class="input-box">
                        <label>นามสกุล</label>
                        <input type="text" name="lname" placeholder="Your Last Name..." required>
                    </div>
                    <div class="input-box">
                        <label>เบอร์โทรศัพท์มือถือ</label>
                        <input type="text" name="phone" placeholder="Your Mobile Phone Number..." required>
                    </div>
                    <div class="input-box">
                        <label>อีเมลล์</label>
                        <input type="email" name="email" placeholder="Your Email Address..." required>
                    </div>    
                    <div class="submit-btn">
                        <input type="submit" value="สมัครสมาชิก" name="submit">
                    </div>
                    <div class="login">
                        <span>หรือ</span><a href="login.php">เข้าสู่ระบบ?</a>
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
            $password = md5($_POST['password']);
            $conpassword = md5($_POST['conpassword']);
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];

            // $username = mysqli_real_escape_string($conn, $_POST['username']);
            // $password = mysqli_real_escape_string($conn, md5($_POST['password']));
            // $conpassword = mysqli_real_escape_string($conn, md5($_POST['conpassword']));
            // $fname = mysqli_real_escape_string($conn, $_POST['fname']);
            // $lname = mysqli_real_escape_string($conn, $_POST['lname']);
            // $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            // $email = mysqli_real_escape_string($conn, $_POST['email']);

            $user_check = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
            $result = mysqli_query($conn, $user_check);
            $user = mysqli_fetch_assoc($result);

            if($user['username'] === $username){
                echo "<script>";
                echo "Swal.fire({
                    position: 'warning',
                    icon: 'error',
                    title: 'มีชื่อผู้ใช้งานนี้ในระบบแล้ว',
                    showConfirmButton: false,
                    timer: 2000
                  })";
                echo "</script>";
            }else{
                $sql = "INSERT INTO `user`(username, password, firstname, lastname, phone, email, level, registerAt) VALUES('$username', '$password', '$fname', '$lname', '$phone', '$email', 'm', NOW())";

                if(mysqli_query($conn, $sql)){
                    echo "<script>";
                    echo "Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'สมัครสมาชิกสำเร็จ',
                        showConfirmButton: false,
                        timer: 2000
                    })";
                    // echo 'alert("New record created successfully!")';
                    echo "</script>"; 
                    $_SESSION['success'] = "Insert user successfully";
                    // header("Location: index.php);
                    // echo "New record created successfully";
                }else{
                    echo '<script>';
                    echo "Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'สมัครสมาชิกล้มเหลว',
                        showConfirmButton: false,
                        timer: 2000
                    })";
                    // echo 'alert("Query Error!")';
                    echo '</script>';
                    $_SESSION['error'] = "Something went wrong";
                    // header("Location: index.php");
                    // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }            
        }
    ?>
</body>
</html>