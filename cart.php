<?php
    session_start();
    include 'php/config.php';
    if(!isset($_SESSION['userlevel'])){
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
    <title>Sneakershop.com | ตะกร้าของคุณ</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <style>
        *{
            box-sizing: border-box;
        }

        a{
            text-decoration: none;
            color: black;
        }

        article{
            height: 100%;
        }
        .table-con{
            height: 75vh;
            /* max-width: 1000px; */
            width: 1300px;
            /* border: 1px solid red; */
            box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.20);
            border-radius: 8px;
            margin-top: 18px;
            padding: 10px 15px;
        }

        .flex-con{
            /* border: 1px solid red; */
            display: flex;
        }

        .product-side{
            width: 70%;
            height: 457px;
            /* border: 1px solid green; */
            overflow: auto;
            margin-top: 10px;
        }
        
        .detail-side{
            /* border: 1px solid red; */
            width: 30%;
            padding:15px;
        }

        .price-box{
            width: 100%;
            height: 125px;
            background-color: #ccc;
            border-radius: 8px;
        }

        .pay-box{
            margin-top: 10px;
            padding: 5px 0;
            background-color: rgb(28 , 27, 27);
            text-align: center;
            color: white;
            font-size: 24px;
            font-weight: 600;
            border-radius: 8px;
            border: 1px solid rgb(28 , 27, 27);
            box-shadow: inset 0 0 0 0 #ccc;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .pay-box:hover{
            letter-spacing: 2px;
            box-shadow: inset 360px 0 0 #fff;
            color: rgb(28 , 27, 27);
        }

        .product-con{
            margin-top: 10px;
            /* max-height: 140px; */
            width: 100%;
            background-color: #ccc;
            border-radius: 6px;
            display: flex;
        }

        .image-box{
            width:150px; 
            height:140px;
            /* border: 1px solid red; */
            display: flex;
            align-items: center;
            margin-left: 10px;
            margin-right: 10px;
        }

        .detail-box{
            margin: auto 10px;
        }

        .image-box img{
            width:200px; 
            height:120px;
            object-fit: cover;
            border-radius: 8px;
        }
        .action-box{
            /* border: 1px solid red; */
            margin-left: auto;
            margin-right: 20px;
            align-self: center;
            /* width: 80%; */
        }

        .delete-order{
            font-size: 18px;
            width: 120px;
            height: 40px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            box-shadow: inset 0 0 0 0 #ccc;
            background-color: #F27474;
            border: 1px solid #F27474;
            transition: all 0.3s ease-out;
        }

        .delete-order:hover{
            box-shadow: inset 190px 0 0 #fff;
            color: #F26161;
            font-weight: 600;
        }

        .price-box{
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
            font-size: 32px;
        }

        main{
            position: relative;
            z-index: 3;
        }

        .payment-con{
            position: absolute;
            /* top: 1rem; */
            width: 100%;
            height: 80.9vh;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            display: none;
            transition: all 0.3s linear;
        }

        .payment-wrapper{
            width: 70%;
            height: 75vh;
            background-color: white;
            border-radius: 0.4rem;
            padding: 1rem 1rem;
        }

        .top-bar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 24px;
            font-weight: 600;
            /* width: 100%; */
        }

        .title i{
            color: #11998e;
        }

        .action{
            cursor: pointer;
            font-size: 26px;
            transition: all 0.15s linear;
        }

        .action:hover{
            color: #F26161;
        }

        #hr{
            margin-bottom:0.55rem;
        }

        .main-bar{
            display: flex;
        }

        .qr{
            width: 40%;
            height: 64vh;
            display: flex;
            /* border: 1px solid red; */
        }

        .qr img{
            object-fit: cover;
            width: 100%;
            border-radius: 0.5rem;
        }

        .user-info{
            /* border: 1px solid red; */
            margin-left: 1rem;
            font-size: 22px;
            font-weight: 500;
            width: 75%;
        }

        .info{
            display: flex;
            flex-direction: column;
            /* row-gap: 0.2rem; */
        }

        .user-name{
            display: flex;
            column-gap: 1rem;
        }

        .input-box{
            width: 100%;
            outline: none;
            border: 1px solid #ccc;
            border-bottom: 3px solid #ccc;
            border-radius: 4px;
            font-size: 18px;
            padding: 0.4rem;
            margin-bottom: 1rem;
        }

        .input-box:focus{
            border-color: black;
        }

        .user-name .input-box{
            width: 50%;
        }

        #uaddress{
            outline: none;
            border: 1px solid #ccc;
            border-bottom: 3px solid #ccc;
            border-radius: 4px;
            font-size: 18px;
            padding: 0.4rem;
        }

        #uaddress:focus{
            border-color: black;
        }

        .submit-box{
            padding: 0.5rem;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 4px;
            border: 1px solid rgb(28 , 27, 27);
            outline: none;
            background-color: rgb(28 , 27, 27);
            box-shadow: inset 0 0 0 0 #fff;
            color: #fff;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .submit-box:hover{
            box-shadow: inset 50rem 0 0 0 #fff;
            color: rgb(28 , 27, 27);
        }
        
        #bankslip{
            font-size: 16px;
        }

        .cart-box{
            display: flex;
        }

        .cart-box .amount{
            padding: 1px 5px;
            background-color: rgb(28 , 27, 27);
            border-radius: 5px;
            color: #fff;
            margin: 0 0.3rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo"><a href="user.php">Sneakershop</a></div>
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
                <div class="cart-box">
                    <div class="amount">
                        <?php
                            $user_id = $_SESSION['userid'];
                            $cart_amount = mysqli_query($conn, "SELECT COUNT(*) AS CartAmount FROM `cart` WHERE user_id = '$user_id'") or die('Query Failed');
                            if($cart_amount){
                                while($rows = mysqli_fetch_assoc($cart_amount)){
                                    echo $rows['CartAmount'];
                                }
                            }
                        ?>
                </div> ตะกร้าของคุณ</div>
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
    <main>
        <div class="payment-con">
            <div class="payment-wrapper">
                <div class="top-bar">
                    <div class="title">
                        <i class="fa-solid fa-money-bill-1-wave"></i> การชำระเงิน
                    </div>
                    <div class="action" onclick="closePayment()">
                        <i class="fa-solid fa-rectangle-xmark"></i>
                    </div>
                </div>
                <hr id="hr">
                <div class="main-bar">
                    <div class="qr">
                        <img src="shoes_image/qr.png" alt="">
                    </div>
                    <div class="user-info">
                        <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="info">
                                <p><label for="user-name">ชื่อ-นามสกุล</label></p>
                                <div class="user-name">
                                    <?php
                                        $user_id = $_SESSION['userid'];
                                        $select_username = "SELECT firstname, lastname FROM `user` WHERE id='$user_id'";
                                        $select_sql = mysqli_query($conn,$select_username) or die('query failed');
                                        if(mysqli_num_rows($select_sql) > 0){
                                            while($fetch_username = mysqli_fetch_assoc($select_sql)){
                                    ?>
                                        <input type="text" class="input-box" name="fname" placeholder="ชื่อจริง..." value="<?php echo $fetch_username['firstname']?>" required>
                                        <input type="text" class="input-box" name="lname" placeholder="นามสกุล..." value="<?php echo $fetch_username['lastname']?>" required>
                                    <?php 
                                            }
                                        }else{                                    
                                    ?>
                                        <input type="text" class="input-box" name="fname" placeholder="ชื่อจริง..." required>
                                        <input type="text" class="input-box" name="lname" placeholder="นามสกุล..." required>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <!-- <br> -->
                                <p><label for="uaddress">สถานที่จัดส่ง</label></p>
                                <textarea id="uaddress" name="uaddress" id="" cols="30" rows="3" maxlength="150" placeholder="ที่อยู่..." required></textarea>
                                <!-- <br> -->
                                <p><label for="bankslip">เบอร์โทรศัพท์</label></p>
                                <?php
                                        $user_id = $_SESSION['userid'];
                                        $select_phone = "SELECT * FROM `user` WHERE id='$user_id'";
                                        $select_sql = mysqli_query($conn,$select_phone) or die('query failed');
                                        if(mysqli_num_rows($select_sql) > 0){
                                            while($fetch_phone = mysqli_fetch_assoc($select_sql)){
                                    ?>
                                        <input type="text" class="input-box" name="phone" placeholder="เบอร์โทรศัพท์..." value="<?php echo $fetch_phone['phone']?>" required>
                                    <?php 
                                            }
                                        }else{                                    
                                    ?>
                                        <input type="text" class="input-box" name="phone" placeholder="เบอร์โทรศัพท์..." required>
                                    <?php
                                        }
                                    ?>
                                <!-- <br> -->
                                <p><label for="bankslip">หลักฐานการโอนเงิน</label></p>
                                <input type="file" class="input-box" id="bankslip" name="bankslip" required>
                                <!-- <br> -->
                                
                                <input type="submit" class="submit-box" name="ordersubmit" value="ยืนยันคำสั่งซื้อ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <article>
        <div class="table-con">
            <h2>ตะกร้าสินค้าของคุณ</h2>
            <hr>
            <div class="flex-con">
                <div class="product-side">
                    <?php
                    $user_id = $_SESSION['userid'];
                    $cart_select = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('Query Failed');
                    $total_price = 0;
                    if(mysqli_num_rows($cart_select) > 0){
                        while($fetch_product = mysqli_fetch_assoc($cart_select)){
                    ?>

                    <div class="product-con">
                        <div class="image-box">
                            <img src="shoes_image/<?php echo $fetch_product['image'];?>" alt="">
                        </div>
                        <div class="detail-box">
                            <span style="font-size: 24px;"><?php echo $fetch_product['brand'].' '.$fetch_product['model']?></span>
                            <br>
                            <span ><?php echo $fetch_product['color'].' | Size: '.$fetch_product['size']?></span>
                            <br>
                            <?php
                                $shoes_id = $fetch_product['shoes_id'];
                                $price_sql = mysqli_query($conn, "SELECT price FROM `shoes` WHERE shoes_id='$shoes_id'")or die('Query Failed');
                                $price_select = 0;
                                if(mysqli_num_rows($price_sql) > 0){
                                    while($fetch_price = mysqli_fetch_assoc($price_sql)){
                                        $price_select = $fetch_price['price'];
                                    }
                                }
                                $total_price+=$price_select;
                            ?>
                            <span ><?php echo $price_select.' บาท'?></span>
                        </div>
                        <div class="action-box">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="hidden" name="orderid" value="<?php echo $fetch_product['id'];?>">
                                <input type="submit" name="delete" class="delete-order" value="ลบสินค้า">
                            </form>
                        </div>                   
                    </div>
                    <?php                          
                        };
                    };
                    ?>
                </div>
                <div class="detail-side">
                    <h1>ยอดที่ต้องชำระ</h1>
                    <div class="price-box">
                        <?php echo "฿ ".$total_price." /-"; ?>
                    </div>
                    <div class="pay-box" onclick="showPayment()">ชำระเงิน</div>
                </div>
            </div>
        </div>
    </article>
    <?php
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if(isset($_POST['delete'])){
            $order_id = $_POST['orderid'];
            $sql = "DELETE FROM `cart` WHERE id='$order_id' AND user_id='$user_id'";
            $query = mysqli_query($conn, $sql) or die('query failed');

            if($query){
                echo "<script>";
                echo "Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'ลบสินค้าแล้ว',
                    showConfirmButton: false,
                    timer: 2000
                    }).then((result) =>{
                        window.location.href='cart.php';
                    })";
                echo "</script>";
            }else{
                echo "<script>";
                echo "Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'ลบสินค้าไม่สำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                  })";
                echo "</script>";
            }
        }
    ?>
    <?php
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if(isset($_POST['ordersubmit'])){
            $img_name = $_FILES['bankslip']['name'];
            $error = $_FILES['bankslip']['error'];
            $img_dir_tmp = $_FILES['bankslip']['tmp_name'];
            $img_type_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_type = strtolower($img_type_ex); 
            $allowed_type = array("jpeg", "jpg", "png");

            if($error === 0){
                if(in_array($img_type, $allowed_type)){
                    $new_img_name = uniqid("IMG-", true).'.'.$img_type;
                    $img_upload_path = 'bank_slip/'.$new_img_name;
                    move_uploaded_file($img_dir_tmp, $img_upload_path);
                    $fullname = $_POST['fname']." ".$_POST['lname'];
                    $address = $_POST['uaddress'];
                                        
                    $order_sql = "INSERT INTO `order_record`(user_id, customer_name, customer_address, send_date, order_status, total_price, image_slip)
                                    VALUES('$user_id', '$fullname', '$address', NOW(), 'pre', '$total_price', '$new_img_name')";
                    if(mysqli_query($conn, $order_sql)){
                        $last_id = mysqli_insert_id($conn);
                        $product_select = "INSERT INTO order_product SELECT order_record.order_id, cart.shoes_id FROM cart, order_record WHERE cart.user_id = '$user_id' AND order_record.order_id = '$last_id'";
                        if(mysqli_query($conn, $product_select)){
                            $delete_cart = "DELETE FROM cart WHERE user_id = '$user_id'";
                            if(mysqli_query($conn,$delete_cart)){
                                echo "<script>";
                                echo "Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'สั่งซื้อสินค้าแล้ว',
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then((result) =>{
                                        window.location.href='cart.php';
                                    })";
                                echo "</script>";
                                die;
                            }
                        }
                    }else{
                        echo "<script>";
                        echo "Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'เกิดปัญหาขึ้นในการสั่งซื้อ',
                                showConfirmButton: false,
                                timer: 2000
                            })";
                        echo "</script>";
                        
                    }
                }
            }
        }
    ?>
    <script>
        function closePayment(){
            const paymentCon = document.querySelector(".payment-con");
            paymentCon.style.display = "none";
        }

        function showPayment(){
            const paymentCon = document.querySelector(".payment-con");
            paymentCon.style.display = "flex";
        }
</script>
</body>
</html>