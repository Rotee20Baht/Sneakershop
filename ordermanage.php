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
    <title>Sneakershop.com | จัดการออเดอร์ทั้งหมด</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
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
            width: 90%;
            height: 70vh;
            overflow:auto;
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
            color:whitesmoke;
        }

        table>thead>tr>th>a{
            color: white;
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
            transition: 0.2s all linear;
        }

        .btn:hover{
            opacity: 70%;
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

        .edit-box{
            background-color: #fff;
            width: 25%;
            height: 25vh;
            padding: 0.9rem 1rem;
            border-radius: 0.7rem;
            overflow: auto;
            position: relative;
        }

        .sub-btn{
            border: none;
            background-color: transparent;
            font-size: 24px;
            transition: 0.2s all linear;
            /* border: 1px solid red; */
        }

        .sub-btn:hover{
            color:#F26161;
        }

        .edit-data{
            /* border: 1px solid red; */
            text-align: center;
        }

        .option{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form.option>select{
            margin: 0.3rem 0 0.5rem 0;
            font-size: 16px;
        }

        form.option>button{
            padding: 0.3rem 0.4rem;
            cursor: pointer;
            width: 40%;
            border: none;
            border-radius: 0.7rem;
            background-color: #b4ecb4;
            color: #259625;
            font-weight: 500;
            font-size: 18px;
            transition: 0.2s all ease;
        }

        form.option>button:hover{
            opacity: 50%;
        }

        .img{
            margin-top: 0.5rem;
        }

        .slip-box{
            background-color: #fff;
            padding: 0.9rem 1rem;
            border-radius: 0.7rem;
        }

        .slip-box img{         
            object-fit: contain;
            border-radius: 0.5rem;
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
    <main>
        <div class="table-con">
            <div>
                <h2>จัดการคำสั่งซื้อ <i class="fa-solid fa-box-archive"></i></h2>
                <hr>
            </div>
            <table>
                <?php
                    if(isset($_GET['order'])){
                        $order = $_GET['order'];
                    }else{
                        $order = 'order_id';
                    }

                    if(isset($_GET['sort'])){
                        $sort = $_GET['sort'];
                    }else{
                        $sort = 'ASC';
                    }
                    $select_product = mysqli_query($conn, "SELECT * FROM `order_record` ORDER BY $order $sort");
                    if(mysqli_num_rows($select_product) > 0){
                        $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';
                        echo "<thead>
                                <tr>
                                    <th><a href='?order=send_date&&sort=$sort'>วันที่สั่งซื้อ</a></th>
                                    <th><a href='?order=order_id&&sort=$sort'>เลขออเดอร์</a></th>
                                    <th><a href='?order=user_id&&sort=$sort'>ไอดีผู้สั่ง</a></th>
                                    <th>รายละเอียดสินค้า</th>
                                    <th><a href='?order=total_price&&sort=$sort'>ราคารวม</a></th>
                                    <th><a href='?order=customer_name&&sort=$sort'>ชื่อผู้รับ</a></th>
                                    <th>ที่อยู่จัดส่ง</th>
                                    <th>หลักฐานการโอนเงิน</th>
                                    <th><a href='?order=order_status&&sort=$sort'>สถานะการสั่งซื้อ</a></th>
                                    <th>แก้ไขสถานะ</th>
                                </tr>
                            </thead>";
                    ?>
                <tbody>
                    <?php
                    while($rows = mysqli_fetch_assoc($select_product)){
                    ?>
                    <tr>
                        <td><?php echo $rows['send_date']?></td>
                        <td><?php echo $rows['order_id']?></td>
                        <td><?php echo $rows['user_id']?></td>
                        <td class="btn-td">
                            <form action="" method="POST">
                                <input type="hidden" name="order_id" value="<?php echo $rows['order_id']?>">
                                <input type="submit" class="btn" value="ดูสินค้า" name="order_detail">
                            </form>
                        </td>
                        <td><?php echo $rows['total_price']?> บาท</td>
                        <td><?php echo $rows['customer_name']?></td>
                        <td style="max-width:9rem; word-break:break-all;"><?php echo $rows['customer_address']?></td>
                        <td>
                            <form action="" method="post" name="slipForm">
                                <input type="hidden" name="order_id" value="<?php echo $rows['order_id']?>">
                                <input type="submit" class="btn" value="ดูสลิป" name="openSlip" style="color:#004b73; background-color:#9adcff;">
                            </form>
                        </td>
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
                        <td>
                            <form action="" method="post" name="editForm">
                                <input type="hidden" name="order_id" value="<?php echo $rows['order_id']?>">
                                <button type="submit" name="editOrder" class="sub-btn"><i class="fa-solid fa-pen-to-square" style="font-size: 20px; cursor:pointer;"></i></button>
                            </form>
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
    if(isset($_POST['openSlip'])){
        $order_id = $_POST['order_id'];
?>
    <div class="wrapper">
        <div class="slip-box">
            <div class="detail-title">
                <div class="detail-title-text">
                    <i class="fa-solid fa-circle-info"></i> หลักฐานการโอนเงิน   
                </div>
                <div class="detail-close" onclick="closeDetail()">
                    <i class="fa-solid fa-rectangle-xmark"></i>
                </div>
            </div>
            <hr>
            <div class="img">
                <?php
                    $slip_sql = mysqli_query($conn, "SELECT image_slip FROM `order_record` WHERE order_id = '$order_id'");
                    if(mysqli_num_rows($slip_sql) > 0){
                        while($image = mysqli_fetch_assoc($slip_sql)){
                ?>
                    <img src="bank_slip/<?php echo $image['image_slip']?>" width="400" height="600">
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
<?php
    }
?>

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
<?php
    if(isset($_POST['editOrder'])){
        $order_id = $_POST['order_id'];
?>
    <div class="wrapper">
        <div class="edit-box">
            <div class="detail-title">
                <div class="detail-title-text">
                    <i class="fa-solid fa-circle-info"></i><span style="font-size:22px"> แก้ไขสถานะ</span>
                </div>
                <div class="detail-close" onclick="closeDetail()">
                    <i class="fa-solid fa-rectangle-xmark"></i>
                </div>
            </div>
            <hr style="margin-bottom: 0.3rem;">
            <!-- <br> -->
            <h3>เลือกสถาะการจัดส่งสินค้า</h3>
            <div class="edit-data">
                <form action="" method="post" class="option">
                    <select name="select_status" required>
                        <option value="">- เลือกสถานะ -</option>
                        <option value="1">จัดเตรียมสินค้า</option>
                        <option value="2">นำพัสดุส่งให้ขนส่ง</option>
                        <option value="3">ขนส่งนำส่งพัสดุ</option>
                        <option value="4">ได้รับพัสดุแล้ว</option>
                        <option value="5">เกิดปัญหาระหว่างการขนส่ง</option>
                        <option value="6">เกิดปัญหาการชำระเงิน</option>
                    </select>
                    <input type="hidden" name="order_id" value="<?php echo $order_id?>">
                    <button type="submit" name="status_submit">บันทึกการแก้ไข</button>
                </form>
            </div>
        </div>
    </div>
<?php
    }
?>
<?php
    if(isset($_POST['status_submit'])){
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        $order_id = $_POST['order_id'];
        $option = $_POST['select_status'];
        if($option == 1)
            $option = "pre";
        elseif($option == 2)
            $option = "send1";
        elseif($option == 3)
            $option = "send2";
        elseif($option == 4)
            $option = "suc";
        elseif($option == 5)
            $option = "err1";
        elseif($option == 6)
            $option = "err2";
        
        $select_sql = mysqli_query($conn, "UPDATE `order_record` SET order_status='$option' WHERE order_id='$order_id'") or die('Query Failed');
        if($select_sql){
            echo "<script>";
            echo "Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'อัพเดทสถานะสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) =>{
                    window.location.href='ordermanage.php';
                })";
            echo "</script>"; 
        }else{
            echo "<script>";
            echo "Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'อัพเดทสถานะไม่สำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) =>{
                    window.location.href='ordermanage.php';
                })";
            echo "</script>"; 
        }
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
</body>
</html>