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
    <title>Sneakershop.com | รายละเอียดการสั่งซื้อ</title>
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        a{
            text-decoration: none;
            color: black;
        }

        main{
            padding-top: 3rem;
            display: grid;
            place-items: center;
        }
        
        .table-con{
            /* border: 1px solid red; */
            width: 80%;
        }

        table{
            border-collapse: collapse;
            width: 100%;
            border-radius: 0.7rem;
            margin-top: 1rem;
            overflow: hidden;
        }

        table>thead{
            background-color: black;
            color: #fff;
        }

        table>thead>tr>th{
            padding: 1rem 0;
            font-weight: 400;
        }

        table>tbody>tr{
            text-align: center;
            /* border: 1px solid blue; */
        }

        table>tbody>tr>td{
            padding: 0.7rem 0;
        }

        tr:nth-child(even){
            background: rgb(224, 224, 224);
        }

        tr:last-child{
            border-bottom: 2px solid rgb(224, 224, 224);
        }
        
        .btn{
            margin: 0 auto;
            background-color: #b4ecb4;
            color: #259625;
            font-weight: 600;
            width: 6rem;
            padding: 0.5rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
        }

        .wrapper{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: grid;
            place-items: center;
        }

        .detail-box{
            width: 35rem;
            max-height: 80vh;
            background-color: #fff;
            padding: 0.9rem 1rem;
            border-radius: 0.7rem;
            overflow: auto;
        }

        .detail-title{
            display: flex;
            justify-content: space-between;
            font-size: 18px;
        }

        .detail-title-text i{
            color: #11998e;
        }
        
        .detail-close i{
            cursor: pointer;
            font-size: 25px;
            transition: all 0.15s linear;
        }

        .detail-close i:hover{
            color: #F26161;
        }

        .data-box{
            display: flex;
            justify-content: start;
            align-items: center;
            /* border: 1px solid blue; */
            margin: 0.3rem 0;
            border: 1px solid rgb(224, 224, 224);
            border-bottom: 3px solid rgb(224, 224, 224);
            border-radius: 8px;
        }

        .data-img{
            /* border: 1px solid orange; */
            padding: 0;
            margin: 0;
        }

        .data-img img{
            object-fit: cover;
            width: 160px;
            height: 120px;
            border-radius: 0.4rem;
        }

        .data-info{
            margin-left: 1rem;
            text-align: start;
        }

        .order-status{
            padding: 0.3rem 0.6rem;
            border-radius: 0.6rem;
            font-weight: 600;
        }

        .uaddess{
            max-width: 9rem;
            word-break: break-all;
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
                            $user_id = $_SESSION['userid'];
                            $cart_amount = mysqli_query($conn, "SELECT COUNT(*) AS CartAmount FROM `cart` WHERE user_id = '$user_id'") or die('Query Failed');
                            if($cart_amount){
                                while($rows = mysqli_fetch_assoc($cart_amount)){
                                    echo $rows['CartAmount'];
                                }
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
    <main>
        <div class="table-con">
            <div>
                <h2>รายละเอียดการสั่งซื้อ <i class="fa-solid fa-box-archive"></i></h2>
                <hr>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>วันที่สั่งซื้อ</th>
                        <th>เลขออเดอร์</th>
                        <th>รายละเอียดสินค้า</th>
                        <th>ราคารวม</th>
                        <th>ชื่อผู้รับ</th>
                        <th>ที่อยู่จัดส่ง</th>
                        <th>สถานะการสั่งซื้อ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $user_id = $_SESSION['userid'];
                        $select_product = mysqli_query($conn, "SELECT * FROM `order_record` WHERE user_id='$user_id'") or die('Query Failed');
                        if(mysqli_num_rows($select_product) > 0){
                            while($rows = mysqli_fetch_assoc($select_product)){
                    ?>
                    <tr>
                        <td><?php echo $rows['send_date']?></td>
                        <td><?php echo $rows['order_id']?></td>
                        <td class="btn-td">
                            <form action="" method="POST">
                                <input type="hidden" name="order_id" value="<?php echo $rows['order_id']?>">
                                <input type="submit" class="btn" value="ดูสินค้า" name="order_detail" onclick="openDetail()">
                            </form>
                            <!-- <div class="btn" onclick="openDetail()">ดูสินค้า</div> -->
                        </td>
                        <td><?php echo $rows['total_price']?> บาท</td>
                        <td><?php echo $rows['customer_name']?></td>
                        <td class="uaddess"><?php echo $rows['customer_address']?></td>
                        <td>
                            <span class="order-status">
                                <?php
                                    if($rows['order_status'] == 'pre'){
                                        echo 'จัดเตรียมสินค้า';
                                    }elseif($rows['order_status'] == 'send1'){
                                        echo 'นำพัสดุส่งให้ขนส่ง';
                                    }elseif($rows['order_status'] == 'send2'){
                                        echo 'ขนส่งนำส่งพัสดุ';
                                    }elseif($rows['order_status'] == 'suc'){
                                        echo 'ได้รับพัสดุแล้ว';
                                    }elseif($rows['order_status'] == 'err1'){
                                        echo 'เกิดปัญหาระหว่างการขนส่ง';
                                    }elseif($rows['order_status'] == 'err2'){
                                        echo 'เกิดปัญหาการชำระเงิน';
                                    }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
<?php 
    if(isset($_POST['order_detail'])){
?>
        <div class="wrapper">
            <div class="detail-box">
                <div class="detail-title">
                    <div class="detail-title-text">
                        <i class="fa-solid fa-circle-info"></i> รายละเอียดสินค้า
                    </div>
                    <div class="detail-close" onclick="closeDetail()">
                        <i class="fa-solid fa-rectangle-xmark"></i>
                    </div>
                </div>
                <hr>
                <?php
                    $order_id = $_POST['order_id'];
                    $detail =  "SELECT order_product.shoes_id, brand, model, color, price, size, image_url FROM `order_product` LEFT JOIN order_record
                                ON order_product.order_id = order_record.order_id LEFT JOIN shoes
                                ON order_product.shoes_id = shoes.shoes_id
                                WHERE order_record.order_id = '$order_id'";
                    $shoes_detail = mysqli_query($conn, $detail) or die('Query Failed');
                            if(mysqli_num_rows($shoes_detail) > 0){
                                while($sDetail = mysqli_fetch_assoc($shoes_detail)){
                ?>  
                                    <div class="data-box">
                                        <div class="data-img">
                                            <img src="shoes_image/<?php echo $sDetail['image_url']?>" alt="">                                          
                                        </div>
                                        <div class="data-info">
                                            <h3><?php echo $sDetail['brand']." ".$sDetail['model']?></h3>
                                            <?php echo $sDetail['color']?><br>
                                            <?php echo '฿ '.$sDetail['price'].' | Size: '.$sDetail['size']?>
                                        </div>
                                    </div>
                    <?php
                                }
                            }
                    ?>
                </div>
            </div>
<?php
    }
?>
<script>
    const status = document.getElementsByClassName("order-status");
    for(let i = 0; i < status.length; i++){
        if(status[i].innerText == "จัดเตรียมสินค้า"){
            status[i].style.backgroundColor = "#fdfd96";
            status[i].style.color = "#abab03";
        }else if(status[i].innerText == "นำพัสดุส่งให้ขนส่ง"){
            status[i].style.backgroundColor = "#9adcff";
            status[i].style.color = "#035397";
        }else if(status[i].innerText == "ขนส่งนำส่งพัสดุ"){
            status[i].style.backgroundColor = "#9adcff";
            status[i].style.color = "#035397";
        }else if(status[i].innerText == "ได้รับพัสดุแล้ว"){
            status[i].style.backgroundColor = "#b4ecb4";
            status[i].style.color = "#259625";
        }else if(status[i].innerText == "เกิดปัญหาระหว่างการขนส่ง"){
            status[i].style.backgroundColor = "#ffcbcb";
            status[i].style.color = "#ff3333";
        }else if(status[i].innerText == "เกิดปัญหาการชำระเงิน"){
            status[i].style.backgroundColor = "#ffcbcb";
            status[i].style.color = "#ff3333";
        }
    }

    function openDetail(){
        const detailBox = document.getElementsByClassName("wrapper");
        console.log(detailBox);
        detailBox[0].style.display = "grid";
    }

    function closeDetail(){
        const detailBox = document.getElementsByClassName("wrapper");
        console.log(detailBox);
        detailBox[0].style.display = "none";
        // for(let i = 0; i < detailBox.length; i++){
        //     detailBox[i].style.display = "none";
        // }        
    }
</script>
</html>