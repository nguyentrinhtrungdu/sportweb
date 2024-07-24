<?php 
include "header.php";
include "slider.php";
include "class/product_class.php"
?>

<?php 
 $product = new product;
// if($_SERVER['REQUEST_METHOD']==='POST'){
//     $category_id=$_POST['category_id'];
//     $brand_name=$_POST['brand_name'];
//     $insert_brand = $brand -> insert_brand($category_id,$brand_name);
// }
?>

<div class="admin-content-right">
<div class="admin-content-right-product_add">
                <h1>Thêm sản phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Nhập tên sản phẩm <span style="color: red;">*</span></label>
                    <input required type="text">
                    <label for="">Chọn danh mục <span style="color: red;">*</span></label>
                    <select name="" id="">
                    <option value="#">--Chọn--</option>
                        <?php 
                        $show_category = $product -> show_category();
                        if ($show_category){while($result=$show_category -> fetch_assoc()){

                       
                        ?>
                        <option value="<?php echo $result['category_id'] ?>"><?php echo $result['category_name'] ?></option>
                        <?php 
                         }}
                        ?>
                    </select>
                    <label for="">Chọn loại sản phẩm <span style="color: red;">*</span></label>
                    <select name="" id="">
                        <label for="">Chọn loại sản phẩm <span style="color: red;">*</span></label>
                        <option value="#">--Chọn--</option>
                    </select>
                    <label for="">Giá sản phẩm <span style="color: red;">*</span></label>
                    <input required type="text">
                    <label for="">Giá khuyến mãi <span style="color: red;">*</span></label>
                    <input required type="text">
                    <label for="">Mô tả sản phẩm<span style="color: red;">*</span></label>
                    <textarea required name="" id="" cols="30" rows="10"></textarea>
                    <label for="">Ảnh sản phẩm <span style="color: red;">*</span></label>
                    <input required type="file">
                    <label for="">Ảnh mô tả <span style="color: red;">*</span></label>
                    <input required multiple type="file">
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>