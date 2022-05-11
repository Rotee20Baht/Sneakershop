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
    <title>Sneakershop.com | รายการสินค้าทั้งหมด</title>
    <link rel="stylesheet" href="css/addproduct.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <style>
        a{
            text-decoration: none;
            color: black;
        }
        
        article{
            /* width: 212vh;  */
            height: 100%;
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
            height: 385px;
            background-color: blue;
            border-radius: 15px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 1px 3px 15px rgba(0, 0, 0, 0.10);
            padding: 15px 10px;
            cursor: pointer;
            transition: 0.3s all ease;
            display: flex;
            flex-direction: column;
        }

        .shoes-box img{
            width: 100%;
            height: 100%;
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
            text-align: end;
            font-size: 18px;
        }

        .srating i{
            color: black;
        }

        .table-con{
            /* max-width: 1400px; */
            /* border:1px solid black; */
            border-radius: 6px;
            /* padding: 10px 0px; */
            overflow: hidden;
            margin-top: 25px;
        }

        table{
            width: 100%;
            /* white-space: nowrap; */
            border-collapse: collapse;
        }
        
        table>thead{
            background-color: black;
            color: #fff;
        }

        table>thead th{
            padding: 10px 35px;
        }

        table>tbody>tr>td{
            padding: 8px;
            text-align: center;
            font-size: 18px;
        }

        table th,
        table td{
            border: 1px solid #ccc;
        }

        table>tbody>tr>td>img{
            display: inline-block;
            width: 140px;
            height: 150px;
            object-fit: cover;
        }

        .tbcolor{
            /* word-break: break-all; */
            max-width: 170px;
        }

        .tbAdddate{
            /* word-break: break-all; */
            max-width: 130px;
        }

        .action_btn{
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .action_btn .edit_btn{
            width: 100%;
            padding: 5px 0px;
            font-size: 18px;
            box-shadow: inset 0 0 0 0 #fff;
            background-color: #F8BB86;
            border: 1px solid #F8BB86;
            border-radius: 4px;
            transition: all 0.3s ease-out;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .action_btn .edit_btn:hover{
            box-shadow: inset 150px 0 0 #fff;
            color: #F89B49;
            font-weight: 600;
        }

        .action_btn .delete_btn{
            width: 100%;
            padding: 5px 0px;
            font-size: 18px;
            box-shadow: inset 0 0 0 0 #fff;
            background-color: #F27474;
            border-radius: 4px;
            border: 1px solid #F27474;
            transition: all 0.3s ease-out;
            cursor: pointer;
        }

        .action_btn .delete_btn:hover{
            box-shadow: inset 150px 0 0 #fff;
            color: #F26161;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">Sneakershop</div>
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
        <div class="table-con">
            <table>
                <thead>
                    <tr>
                        <th>รหัสรองเท้า</th>
                        <th>รูปภาพ</th>
                        <th>แบรนด์</th>
                        <th>รุ่น</th>
                        <th class="tbcolor">สี</th>
                        <th>ราคา</th>
                        <th>วันที่ผลิต</th>
                        <th>ขนาด</th>
                        <th>คะแนน</th>
                        <th class="tbAdddate">วันที่เพิ่ม</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $select_product = mysqli_query($conn, "SELECT * FROM `shoes`") or die('Query Failed');
                    if(mysqli_num_rows($select_product) > 0){
                        while($fetch_product = mysqli_fetch_assoc($select_product)){
                    ?>
                    <tr>
                        <td><?php echo $fetch_product['shoes_id']?></td>
                        <td><img src="shoes_image/<?php echo $fetch_product['image_url']; ?>" alt="nike"></td>
                        <td><?php echo $fetch_product['brand']?></td>
                        <td><?php echo $fetch_product['model']?></td>
                        <td class="tbcolor"><?php echo $fetch_product['color']?></td>
                        <td><?php echo $fetch_product['price']?> ฿</td>
                        <td><?php echo $fetch_product['released']?></td>
                        <td><?php echo $fetch_product['size']?></td>
                        <td><?php echo $fetch_product['rating']?></td>
                        <td class="tbAdddate"><?php echo $fetch_product['instockAt']?></td>
                        <td>
                            <div class="action_btn">
                                <form action="editproduct.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $fetch_product['shoes_id']?>">
                                    <input type="submit" name="edit" class="edit_btn" value="แก้ไขสินค้า">
                                </form>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="hidden" name="id" value="<?php echo $fetch_product['shoes_id']?>">
                                    <input type="submit" name="delete" class="delete_btn" value="ลบสินค้า">
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        };
                    };?>
                </tbody>
            </table>
        </div>
    </article>
    <footer>
        
    </footer>
    <?php
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if(isset($_POST['delete'])){
            $id = $_POST['id'];

            $sql = "DELETE FROM `shoes` WHERE shoes_id='$id'";
            $query = mysqli_query($conn, $sql);

            if($query){
                echo "<script>";
                echo "Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'ลบสินค้าแล้ว',
                    showConfirmButton: false,
                    timer: 2000
                  }).then((result) =>{
                    window.location.href='shoesdata.php';
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
</body>
</html>