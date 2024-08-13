<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <?php
session_start(); // Ensure session_start() is called here only

// Other code here
include_once __DIR__ . "/path/to/header.php"; // Include the header
?>
    <div class="main">
        <?php
        include ("./header.php");
        ?>
   
<!-- Slider -->
        <div class="slider">
            <div class="slides">
                <div class="slide">
                    <img src="/assets/img/slider-banner/slide1.jpg" alt="Slide 1">
                </div>
                <div class="slide">
                    <img src="/assets/img/slider-banner/slide2.webp" alt="Slide 2">
                </div>
                <div class="slide">
                    <img src="/assets/img/slider-banner/slide3.webp" alt="Slide 3">
                </div>
                <div class="slide">
                    <img src="/assets/img/slider-banner/slide4.webp" alt="Slide 4">
                </div>
                <div class="slide">
                    <img src="/assets/img/slider-banner/slide5.webp" alt="Slide 5">
                </div>
                <div class="slide">
                    <img src="/assets/img/slider-banner/slide6.jpg" alt="Slide 6">
                </div>
            </div>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        
        <div class="dots">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
            <span class="dot" onclick="currentSlide(6)"></span>
            
        </div>

        <!-- container -->
        <div class="container-home"> 
            <div class="want-to-find">
                <h1 class="footer-header">BẠN ĐANG TÌM</h1>
                <div class="shoes-category">
                    <div class="category-to-want">
                        <a href=""><img src="https://theme.hstatic.net/1000061481/1001035882/14/index_banner_1.jpg?v=1897" alt="Giày cỏ nhân tạo"></a>
                        
                        <h2 class="category-to-want-heading">GIÀY CỎ NHÂN TẠO (ĐẾ TF)</h2>
                        <p class="category-to-want-description">GIÀY ĐÁ BÓNG DÀNH CHO MẶT SÂN CỎ NHÂN TẠO 5-7 NGƯỜI</p>
                    </div>
                    <div class="category-to-want">
                        <a href=""><img src="https://theme.hstatic.net/1000061481/1001035882/14/index_banner_2.jpg?v=1897" alt="Giày cỏ tự nhiên"></a>
                        
                        <h2 class="category-to-want-heading">GIÀY CỎ TỰ NHIÊN (ĐẾ FG, AG, SG)</h2>
                        <p class="category-to-want-description">GIÀY ĐÁ BÓNG DÀNH CHO MẶT SÂN CỎ TỰ NHIÊN 11 NGƯỜI</p>
                    </div>
                    <div class="category-to-want">
                        <a href=""><img src="https://theme.hstatic.net/1000061481/1001035882/14/index_banner_3.jpg?v=1897" alt="Giày futsal"></a>
                        
                        <h2 class="category-to-want-heading">GIÀY FUTSAL (ĐẾ IC)</h2>
                        <p class="category-to-want-description">GIÀY ĐÁ BÓNG DÀNH CHO SÂN XI MĂNG VÀ SÂN FUTSAL TRONG NHÀ</p>
                    </div>
                    
                </div>
            </div>        
          
            <div class="brand-home">
                <h1 class="footer-header">THƯƠNG HIỆU</h1>
                <div class="shoes-category">
                    <div class="category-to-want">
                        <a href=""><img src="https://theme.hstatic.net/1000061481/1001035882/14/brand_banner_1.jpg?v=1897" alt="Giày cỏ nhân tạo"></a>
                        <p class="category-to-want-description">GIÀY BÓNG ĐÁ NIKE</p>
                    </div>
                    <div class="category-to-want">
                        <a href=""><img src="https://theme.hstatic.net/1000061481/1001035882/14/brand_banner_2.jpg?v=1897" alt="Giày cỏ tự nhiên"></a>
                        
                
                        <p class="category-to-want-description">GIÀY BÓNG ĐÁ ADIDAS</p>
                    </div>
                    <div class="category-to-want">
                        <a href=""><img src="https://theme.hstatic.net/1000061481/1001035882/14/brand_banner_3.jpg?v=1897" alt="Giày futsal"></a>
                        
                        <p class="category-to-want-description">GIÀY ĐÁ BANH PUMA</p>
                    </div>
                    <div class="category-to-want">
                        <a href=""><img src="https://theme.hstatic.net/1000061481/1001035882/14/brand_banner_4.jpg?v=1897" alt="Giày futsal"></a>
                        
                        <p class="category-to-want-description">GIÀY ĐÁ BANH MIZUNO</p>
                    </div>

                    <div class="category-to-want">
                        <a href=""><img src="https://theme.hstatic.net/1000061481/1001035882/14/brand_banner_6.jpg?v=1897" alt="Giày futsal"></a>
                        
                        <p class="category-to-want-description">GIÀY ĐÁ BANH KAMITO</p>
                    </div>

                    <div class="category-to-want">
                        <a href=""><img src="https://theme.hstatic.net/1000061481/1001035882/14/brand_banner_11.jpg?v=1897" alt="Giày futsal"></a>
                        
                        <p class="category-to-want-description">GIÀY ĐÁ BANH ZOCKER</p>
                    </div>
            </div>
        </div>
        
        </div>


    <!-- footer -->
    <?php include ("./footer.php"); ?>

<!-- Modal layout -->

      
    <script src="banner.js"></script>
</body>
</html>