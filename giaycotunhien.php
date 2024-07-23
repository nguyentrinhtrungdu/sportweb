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
    <div class="main">
    <?php
        include ("./header.php");
        ?>
         <!-- container -->
         <div class="app__container">
            <div class="grid">
             <div class="grid__row app_content">
                 <div class="grid__column-2">
                     <nav class="category">
                         <h3 class="category__heading">
                             <i class="category__heading-icon fa-solid fa-list"></i>
                             Danh mục
                             </h3>
                         <ul class="category-list">
                             <li class="category-item ">
                                 <a href="/allproduct.php" class="category-item__link">TẤT CẢ SẢN PHẨM </a>
                             </li>
                             <li class="category-item category-item--active">
                                 <a href="/giaycotunhien.php" class="category-item__link">GIÀY CỎ TỰ NHIÊN</a>
                             </li>
                             <li class="category-item">
                                 <a href="/giayconhantao.php" class="category-item__link">GIÀY CỎ NHÂN TẠO</a>
                             </li>
                             <li class="category-item">
                                <a href="/futsal.php" class="category-item__link">GIÀY FUTSAL</a>
                            </li>
                             <li class="category-item">
                                <a href="/phienbangioihan.php" class="category-item__link">PHIÊN BẢN GIỚI HẠN</a>
                            </li>
                         </ul>
                     </nav>

                     <nav class="category">
                        <h3 class="category__heading">
                            <i class="category__heading-icon fa-solid fa-list"></i>
                            THƯƠNG HIỆU
                            </h3>
                        <ul class="brand-list">
                                <li><a href="#"><input type="checkbox" id="nike"><label for="nike">Nike</label></a></li>
                                <li><a href="#"><input type="checkbox" id="adidas"><label for="adidas">Adidas</label></a></li>
                                <li><a href="#"><input type="checkbox" id="puma"><label for="puma">Puma</label></a></li>
                                <li><a href="#"><input type="checkbox" id="mizuno"><label for="mizuno">Mizuno</label></a></li>                               
                                <li><a href="#"><input type="checkbox" id="kamito"><label for="kamito">Kamito</label></a></li>
                                <li><a href="#"><input type="checkbox" id="zocker"><label for="zocker">Zocker</label></a></li>
                        </ul>
                    </nav>

                    <nav class="category">
                        <h3 class="category__heading">
                            <i class="category__heading-icon fa-solid fa-list"></i>
                            GIÁ
                            </h3>
                        <ul class="brand-list">
                                <li><a href="#"><input type="checkbox" id="nike"><label for="nike">Tất cả</label></a></li>
                                <li><a href="#"><input type="checkbox" id="adidas"><label for="adidas">0 VNĐ ~ 1.000.000 VNĐ</label></a></li>
                                <li><a href="#"><input type="checkbox" id="puma"><label for="puma">1.000.000 VNĐ ~ 2.000.000 VNĐ</label></a></li>
                                <li><a href="#"><input type="checkbox" id="mizuno"><label for="mizuno">2.000.000 VNĐ ~ 3.000.000VNĐ</label></a></li>                               
                                <li><a href="#"><input type="checkbox" id="kamito"><label for="kamito">3.000.000 VNĐ ~ 5.000.000 VNĐ</label></a></li>
                                <li><a href="#"><input type="checkbox" id="zocker"><label for="zocker">Trên 5.000.000 VNĐ</label></a></li>
                        </ul>
                    </nav>

                    <nav>
                        <a href="">
                            <img class ="banner-sale" src="https://theme.hstatic.net/1000061481/1001035882/14/banner-left-col.jpg?v=1897" alt="">

                        </a>
                    </nav>
                 </div>
 
            <div class="grid__column-10">
        <div class="home-filter">
            <div class="button-container">
                <button class="square-button">
                    <div class="squares">
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                    </div>
                </button>
            </div>
 
         <div class="home-filter__page">
             <span class="home-filter__page-num">
                 <span class="home-filter__page-current">1</span>/3
             </span>
             <div class="home-filter__page-control">
                 <a href="#" class="home-filter__page-btn home-filter__page-btn-disabled">
                     <i class="home-filter__page-icon fa-solid fa-chevron-left"></i>
                 </a>
                 <a href="/allproductpage2.php" class="home-filter__page-btn">
                     <i class="home-filter__page-icon fa-solid fa-chevron-right"></i>
                 </a>
             </div>
         </div>
     </div>
 
     <div class="home-product">
         <div class="grid__row">
             <!-- Loop through product items -->
             <div class="grid__column-2-4">
                 <div class="home-product-item">
                     <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/2991268d82be4271b87cf1256b863616_bdce0c98e52a4dfe9b62443363fe896a_1024x1024.jpg');"></div>
                     <h4 class="home-product-item__name">ÁO BÓNG ĐÁ CHÍNH HÃNG TOTTENHAM HOTSPUR SÂN NHÀ 2024/25</h4>
                     <div class="home-product-item__price home-product-item__price-no-sale">
                        
                         <span class="home-product-item__price-current">1.990.000đ</span>
                     </div>
                     
                    
                 </div>
             </div>

             <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/fb8dd697e1684b1f962734d8c7e99113_2ff96ccf298f46cf93fff3de8c0faf08_1024x1024.jpg');"></div>
                    <h4 class="home-product-item__name">ÁO BÓNG ĐÁ CHÍNH HÃNG ENGLAND SÂN KHÁCH EURO 2024</h4>
                    <div class="home-product-item__price home-product-item__price-no-sale">
                        <span class="home-product-item__price-current">1.990.000đ</span>
                    </div>
                    
                    
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-008_81-01-01_5b45733e378145f1b9fc9343562e2901_1024x1024.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA ULTRA 5 PRO CAGE TT FORMULA - LAPIS LAZULI/PUMA WHITE/SUNSET GLOW 107889-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">3.099.000đ</span>
                        <span class="home-product-item__price-current">2.789.000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">12%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_4-02-02-0102-01_5f41ab3123c043c29becd742268dc12f_1024x1024.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA ULTRA 5 PRO FG/ AG FORMULA - LAPIS LAZULI/PUMA WHITE/SUNSET GLOW 107685-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">3.629.000đ</span>
                        <span class="home-product-item__price-current">3.190.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">12%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>

            <div class="grid__column-2-4">
                <div class="home-product-item">
                    <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                    <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">2.259.000đ</span>
                        <span class="home-product-item__price-current">2.030.0000đ</span>
                    </div>
                    
                    <div class="home-product-item__sale-off">
                        <span class="home-product-item__sale-off-percent">10%</span>
                        <span class="home-product-item__sale-off-label">GIẢM</span>
                    </div>
                </div>
            </div>
             <!-- Repeat for other products -->
             <div class="grid__column-2-4">
                 <div class="home-product-item">
                     <div class="home-product-item__img" style="background-image: url('https://product.hstatic.net/1000061481/product/anh_sp_add_web_3-02-02-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01_4bf290d5f7974387ab4aa85a5ae7fa93_medium.jpg');"></div>
                     <h4 class="home-product-item__name">GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING 108075-01</h4>
                     <div class="home-product-item__price">
                         <span class="home-product-item__price-old">1.659.000đ</span>
                         <span class="home-product-item__price-current">1.111.000đ</span>
                     </div>
                     <div class="home-product-item__action">
                         <span class="home-product-item__sold">112 Đã bán</span>
                     </div>
                     <div class="home-product-item__sale-off">
                         <span class="home-product-item__sale-off-percent">10%</span>
                         <span class="home-product-item__sale-off-label">GIẢM</span>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Pagition end -->

     <div class="pagination-container">
        <ul class="pagination">
            <li><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="allproductpage2.php">2</a></li>
            <li><a href="allproductpage3.php">3</a></li>
            <li><a href="allproductpage2.php">&raquo;</a></li>
        </ul>
    </div>
     
 </div>
            </div>
            
            </div>
            
         </div>
        <!-- footer -->
        <?php
        include ("./footer.php");
        ?>
       
    </div>
    <!--Modal layout-->
    <?php
        include ("./modal.php");
        ?>
</body>
</html>