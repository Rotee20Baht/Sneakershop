<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakershop.com | ยินดีต้อนรับ</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <style>
        a{
            text-decoration: none;
            color: black;
        }

        main{
            width: 100%;
            height: 100%;
            /* border: 1px solid blue; */
            overflow: hidden;
        }

        .slideshow-container {
            /* border: 1px solid red; */
            width: 100%;
            height: 74vh;
            position: relative;
            margin: auto;
        }

        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }

        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active, .dot:hover {
            background-color: #717171;
        }

        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {opacity: .4} 
            to {opacity: 1}
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
</body>
<main>
    <div class="slideshow-container">

    <div class="mySlides fade">
    <div class="numbertext">1 / 3</div>
    <img src="slide-img/slide-1.png" style="width:100%; object-fit: cover;">
    </div>

    <div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
    <img src="slide-img/slide-2.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
    <div class="numbertext">3 / 3</div>
    <img src="slide-img/slide-3.jpg" style="width:100%">
    </div>

    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>

    </div>
    <br>

    <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span> 
    <span class="dot" onclick="currentSlide(2)"></span> 
    <span class="dot" onclick="currentSlide(3)"></span> 
    </div>
</main>
</html>
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

    function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    }
</script>
<?php 
    if (isset($_SESSION['success']) || isset($_SESSION['error'])) {
        session_start();
    // include 'php/config.php';
        session_destroy();
    }
?>