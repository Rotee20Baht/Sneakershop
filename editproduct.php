<?php
    session_start();
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
    <title>Sneakershop.com | แก้ไขข้อมูลสินค้า</title>
    <link rel="stylesheet" href="css/addproduct.css">
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
       <?php 
            include 'php/config.php';
            $shoes_id = $_POST['id'];
            $sql = "SELECT * FROM `shoes` WHERE shoes_id ='$shoes_id'";
            $query = mysqli_query($conn, $sql);

            if($query){
                while($row = mysqli_fetch_array($query)){
                    ?>
                <div class="regis-box">
                    <form enctype="multipart/form-data" action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['shoes_id']?>">
                    <p>แก้ไขข้อมูลสินค้า</p>
                    <hr>
                        <div class="input-box">
                            <label>ยี่ห้อของรองเท้า</label>
                            <input type="text" name="sbrand" placeholder="Shoes Brand..." value="<?php echo $row['brand']?>">
                        </div>
                        <div class="input-box">
                            <label>รุ่นของรองเท้า</label>
                            <input type="text" name="smodel" placeholder="Shoes Model..." value="<?php echo $row['model']?>">
                        </div>
                        <div class="input-box">
                            <label>สีของรองเท้า</label>
                            <input type="text" name="scolor" placeholder="Shoes Color..." value="<?php echo $row['color']?>">
                        </div>
                        <div class="input-box">
                            <label>ราคา</label>
                            <input type="text" name="sprice" placeholder="Shoes Price..." value="<?php echo $row['price']?>">
                        </div>
                        <div class="input-box">
                            <label>วันที่ผลิต</label>
                            <input type="date" name="rdate" value="<?php echo $row['released']?>">
                        </div>  
                        <div class="input-box">
                            <label>ไซส์รองเท้า</label>
                            <input type="text" name="ssize" placeholder="Shoes Size..." value="<?php echo $row['size']?>">
                        </div>
                        <div class="input-box">
                            <label>รูปภาพรองเท้า</label>
                            <input type="file" name="shoes_image">
                        </div>
                        <div class="submit-btn">
                            <input type="submit" value="อัปเดทข้อมูล" name="update" required>
                        </div>
                        <div class="login">
                        <span>หรือ</span><a href="shoesdata.php">ย้อนกลับ</a>
                        </div>
                    </form>
                </div>
        <?php 
                }
            }else{
                echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo '<script>';
                echo "Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'ไม่สามารถติดต่อฐานข้อมูลได้',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) =>{
                        window.location.href='shoesdata.php';
                    })";
                echo '</script>';
            }
        ?>
    </article>
    <?php
                        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                        if(isset($_POST['update'])){
                            $file = $_FILES['shoes_image']['name'];
                            if($file!="") {
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

                                        $sbrand = $_POST['sbrand'];
                                        $smodel = $_POST['smodel'];
                                        $scolor = $_POST['scolor'];
                                        $sprice = $_POST['sprice'];
                                        $rdate = $_POST['rdate'];
                                        $ssize = $_POST['ssize'];
                                        
                                        $sql = "UPDATE `shoes` SET brand='$sbrand', model='$smodel', color='$scolor', price='$sprice', released='$rdate', 
                                                size='$ssize', image_url='$new_img_name' WHERE shoes_id='$shoes_id'";
                                                                                                
                                        if(mysqli_query($conn, $sql)){
                                            echo "<script>";
                                            echo "Swal.fire({
                                                position: 'center',
                                                icon: 'success',
                                                title: 'แก้ไขข้อมูลสินค้าสำเร็จ',
                                                showConfirmButton: false,
                                                timer: 2000
                                            }).then((result) =>{
                                                window.location.href='shoesdata.php';
                                            })";
                                            echo "</script>"; 
                                        }else{
                                            echo '<script>';
                                            echo "Swal.fire({
                                                position: 'center',
                                                icon: 'error',
                                                title: 'แก้ไขข้อมูลสินค้าไม่สำเร็จ',
                                                showConfirmButton: false,
                                                timer: 2000
                                            })";
                                            echo '</script>';
                                            echo '<script> alert("Error CODE : FAIL1");</script>';
                                        }
                                    }
                                }else{
                                    echo '<script>';
                                    echo "Swal.fire({
                                                    position: 'center',
                                                    icon: 'error',
                                                    title: 'ปัญหาที่ไฟล์รูปภาพ',
                                                    showConfirmButton: false,
                                                    timer: 2000
                                        })";
                                    echo '</script>';
                                }
                            }else{
                            $file = $row['image_url'];
                            $sbrand = $_POST['sbrand'];
                            $smodel = $_POST['smodel'];
                            $scolor = $_POST['scolor'];
                            $sprice = $_POST['sprice'];
                            $rdate = $_POST['rdate'];
                            $ssize = $_POST['ssize'];
                            
                            $sql = "UPDATE `shoes` SET brand='$sbrand', model='$smodel', color='$scolor', price='$sprice', released='$rdate', 
                                    size='$ssize' WHERE shoes_id='$shoes_id'";
                                                                                       
                            if(mysqli_query($conn, $sql)){
                                echo "<script>";
                                echo "Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'แก้ไขข้อมูลสินค้าสำเร็จ',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then((result) =>{
                                    window.location.href='shoesdata.php';
                                })";
                                echo "</script>"; 
                            }else{
                                echo '<script>';
                                echo "Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'แก้ไขข้อมูลสินค้าไม่สำเร็จ',
                                    showConfirmButton: false,
                                    timer: 2000
                                })";
                                echo '</script>';
                                echo '<script> alert("Error CODE : FAIL1");</script>';
                            }
                            }
                        }
                        
                    ?>
</body>
</html>