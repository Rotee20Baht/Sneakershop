<?php
    session_start();
    include 'php/config.php';
    // if($_SESSION['userlevel'] != 'a'){
    //     // header('Location : login.php');
    //     // exit();
    //     echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    //     echo '<script>';
    //     echo "Swal.fire({
    //         position: 'center',
    //         icon: 'error',
    //         title: 'กรุณาเข้าสู่ระบบ',
    //         showConfirmButton: false,
    //         timer: 2000
    //     }).then((result) =>{
    //         window.location.href='login.php';
    //     })";
    //     // echo "window.location.href='index.php';";
    //     echo '</script>';
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakershop.com | รองเท้า</title>
    <link rel="stylesheet" href="css/addproduct.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <style>
        a{
            text-decoration: none;
            color: black;
        }

        article{
            /* width: 212vh;
            height: 100%; */
            display: grid;
            /* border: 1px solid red; */
        }

        .shoes-container{
            padding-top: 15px;
            width: 100%;
            height: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            flex-direction: row;
            align-content: flex-start;
        }

        .shoes-box{
            /* margin-top: 20px;
            margin-left: 25px; */
            margin: 5px;
            margin-top: 10px;
            width: 450px;
            height: 400px;
            background-color: blue;
            border-radius: 15px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 1px 3px 15px rgba(0, 0, 0, 0.10);
            padding: 15px 10px;
            /* cursor: pointer; */
            transition: 0.3s all ease;
            display: flex;
            flex-direction: column;
        }

        .img-box{
            width: 100%;
            height: 240px;
            border-radius: 8px;
            /* overflow: hidden; */
            /* border: 1px solid red; */
            margin-bottom: 10px;
            /* position: relative; */
            display: flex;
            justify-content: center;
        }
        .shoes-box img{
            width: 300px;
            height: 240px;
            object-fit: cover;
            /* position: absolute; */
        }

        .shoes-box .sname{
            /* margin-top: 5px; */
            font-size: 24px;
        }

        .insert-basket{
            /* position: absolute; */
            /* border: 1px solid red; */
            display: block;
            float: right;
            text-align: center;
            font-size: 18px;
            padding: 4px;
            background-color: rgb(28 , 27, 27);
            box-shadow: inset 0 0 0 0 #fff;
            border-radius: 14px;
            border: 1px solid rgb(119, 119, 119);
            width: 160px;
            color: #fff;
            transition: all 0.3s ease-out;
            cursor: pointer;
        }

        .insert-basket:hover{
            box-shadow: inset 180px 0 0 #fff;
            border: 1px solid rgb(119, 119, 119);
            color: rgb(28 , 27, 27);
        }

        .srating i{
            color: black;
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
                    <button type="submit" required><i class="fa fa-search" aria-hidden="true"></i></button>
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
                <div class="cart-box"><div class="amount">
                        <?php
                            if(isset($_SESSION['userid'])){
                                $user_id = $_SESSION['userid'];
                                $cart_amount = mysqli_query($conn, "SELECT COUNT(*) AS CartAmount FROM `cart` WHERE user_id = '$user_id'") or die('Query Failed');
                                if($cart_amount){
                                    while($rows = mysqli_fetch_assoc($cart_amount)){
                                        echo $rows['CartAmount'];
                                    }
                                }
                            }else{
                                echo '0';
                            }
                        ?>
                </div><a href="cart.php"> ตะกร้าของคุณ</a></div>
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
        <div class="shoes-container">
            <?php 
                $select_product = mysqli_query($conn, "SELECT * FROM `shoes`") or die('Query Failed');
                if(mysqli_num_rows($select_product) > 0){
                    while($fetch_product = mysqli_fetch_assoc($select_product)){
            ?>
                <div class="shoes-box">
                    <form action="" method="post">
                        <div class="img-box"><img src="shoes_image/<?php echo $fetch_product['image_url']; ?>" alt=""></div>
                        <div class="sname"><?php echo $fetch_product['brand']; echo " "; echo $fetch_product['model']; ?></div>
                        <div class="sprice">฿ <?php echo $fetch_product['price'];?> | Size: <?php echo $fetch_product['size'];?></div>
                        <div class="srating">
                            <?php
                                if($fetch_product['rating'] == 0){
                            ?>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            <?php }else if($fetch_product['rating'] > 0){?>
                                <?php for($count = 0; $count < $fetch_product['rating']; $count++){?>
                                    <!-- <i class="fa-solid fa-star-exclamation"></i> -->
                                    <i class="fa-solid fa-star"></i>
                                <?php }; ?>
                            <?php }; ?>
                        </div>
                        <input type="hidden" name="product_id" value="<?php echo $fetch_product['shoes_id']; ?>">
                        <input type="hidden" name="product_img" value="<?php echo $fetch_product['image_url']; ?>">
                        <input type="hidden" name="product_brand" value="<?php echo $fetch_product['brand']; ?>">
                        <input type="hidden" name="product_model" value="<?php echo $fetch_product['model']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                        <input type="hidden" name="product_size" value="<?php echo $fetch_product['size']; ?>">
                        <input type="hidden" name="product_color" value="<?php echo $fetch_product['color']; ?>">
                        <input type="submit" class="insert-basket" name="addCart" value="เพิ่มลงในตะกร้า">
                        <!-- <div class="insert-basket">เพิ่มลงในตะกร้า <i class="fa-solid fa-basket-shopping"></i></div> -->
                    </form>
                </div>
            <?php
                    };
                };
            ?>
        </div>      
    </article>
    <?php
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if(isset($_POST['addCart'])){
            $product_id = $_POST['product_id'];
            $product_brand = $_POST['product_brand'];
            $product_model = $_POST['product_model'];
            $product_color = $_POST['product_color'];
            $product_price = $_POST['product_price'];
            $product_size = $_POST['product_size'];
            $product_img = $_POST['product_img'];
            
            if(isset($_SESSION['userid'])){
                $user_id = $_SESSION['userid'];
                $sql = "SELECT * FROM `cart` WHERE user_id='$user_id' AND shoes_id='$product_id' AND brand='$product_brand' AND model='$product_model' 
                        AND color='$product_color' AND size='$product_size' ";
                $select_cart = mysqli_query($conn,$sql) or die('query failed');
                // if(mysqli_num_rows($select_cart) > 0){
                    // echo '<script>';
                    // echo "Swal.fire({
                    //     position: 'center',
                    //     icon: 'info',
                    //     title: 'มีสินค้าอยู่ในตะกร้าแล้ว',
                    //     showConfirmButton: false,
                    //     timer: 2000
                    // })";
                    // echo '</script>';
                // }else{
                    mysqli_query($conn, "INSERT INTO `cart`(user_id,shoes_id, brand, model, color, price, size, image) VALUES
                    ('$user_id', '$product_id', '$product_brand', '$product_model', '$product_color', '$product_price', '$product_size', '$product_img')") 
                    or die('query failed');
                    echo '<script>';
                    echo "Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'เพิ่มสินค้นในตะกร้าแล้ว',
                        showConfirmButton: false,
                        timer: 2000
                    })";
                    echo '</script>';
                // }
            }else{
                echo '<script>';
                echo "Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'กรุณาเข้าสู่ระบบ',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) =>{
                    window.location.href='login.php';
                })";
                echo '</script>';
            }
            
        }
    ?>
</body>
</html>