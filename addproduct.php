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
    <title>Sneakershop.com | เพิ่มสินค้า</title>
    <link rel="stylesheet" href="css/addproduct.css">
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
    <article>
        <div class="regis-box">
            <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <p>เพิ่มสินค้า</p>
                <hr>
                    <div class="input-box">
                        <label>ยี่ห้อของรองเท้า</label>
                        <input type="text" name="sbrand" placeholder="Shoes Brand..." required>
                    </div>
                    <div class="input-box">
                        <label>รุ่นของรองเท้า</label>
                        <input type="text" name="smodel" placeholder="Shoes Model..." required>
                    </div>
                    <div class="input-box">
                        <label>สีของรองเท้า</label>
                        <input type="text" name="scolor" placeholder="Shoes Color..." required>
                    </div>
                    <div class="input-box">
                        <label>ราคา</label>
                        <input type="text" name="sprice" placeholder="Shoes Price..." required>
                    </div>
                    <div class="input-box">
                        <label>วันที่ผลิต</label>
                        <input type="date" name="rdate" required>
                    </div>  
                    <div class="input-box">
                        <label>ไซส์รองเท้า</label>
                        <input type="text" name="ssize" placeholder="Shoes Size..." required>
                    </div>
                    <div class="input-box">
                        <label>รูปภาพรองเท้า</label>
                        <input type="file" name="shoes_image" required>
                    </div>
                    <div class="submit-btn">
                        <input type="submit" value="เพิ่มสินค้า" name="submit" required>
                    </div>
            </form>
        </div>
    </article>
    <?php
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if(isset($_POST['submit'])){
            // echo "<pre>";
            // print_r($_FILES['shoes_image']);
            // echo "</pre>";

            $img_name = $_FILES['shoes_image']['name'];
            $error = $_FILES['shoes_image']['error'];
            $img_dir_tmp = $_FILES['shoes_image']['tmp_name'];
            $img_type_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_type = strtolower($img_type_ex); 
            $allowed_type = array("jpeg", "jpg", "png");

            if($error === 0 ){
                if(in_array($img_type, $allowed_type)){
                    $new_img_name = uniqid("IMG-", true).'.'.$img_type;
                    $img_upload_path = 'shoes_image/'.$new_img_name;
                    move_uploaded_file($img_dir_tmp, $img_upload_path);

                    include 'php/config.php';

                    $sbrand = $_POST['sbrand'];
                    $smodel = $_POST['smodel'];
                    $scolor = $_POST['scolor'];
                    $sprice = $_POST['sprice'];
                    $rdate = $_POST['rdate'];
                    $ssize = $_POST['ssize'];

                    $sql = "INSERT INTO `shoes`(brand, model, color, price, released, size, rating, image_url, instockAt) 
                            VALUES('$sbrand', '$smodel', '$scolor', '$sprice', '$rdate', '$ssize', 0,  '$new_img_name', NOW())";
                    
                    if(mysqli_query($conn, $sql)){
                        echo "<script>";
                        echo "Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'เพิ่มสินค้าสำเร็จ',
                            showConfirmButton: false,
                            timer: 2000
                        })";
                        echo "</script>"; 
                        $_SESSION['success'] = "Insert product successfully";
                    }else{
                        echo '<script>';
                        echo "Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'เพิ่มสินค้าไม่สำเร็จ',
                            showConfirmButton: false,
                            timer: 2000
                        })";
                        echo '</script>';
                        $_SESSION['error'] = "Something went wrong";
                    }
                }else{
                    echo '<script>';
                    echo "Swal.fire({
                                position: 'center',
                                icon: 'warning',
                                title: 'ประเทภไฟล์รูปภาพไม่ถูกต้อง',
                                showConfirmButton: false,
                                timer: 2000
                        }).then((result) =>{
                            window.location.href='addproduct.php';
                        })";
                    echo '</script>';
                }
            }else{
                echo '<script>';
                echo "Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'เพิ่มสินค้าไม่สำเร็จ',
                                showConfirmButton: false,
                                timer: 2000
                    }).then((result) =>{
                        window.location.href='addproduct.php';
                    })";
                echo '</script>';
            }
        }
    ?>
</body>
</html>