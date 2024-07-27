
<?php 

include "header.php";
include "slider.php";
include "class/product_class.php";
?>

<?php 
$product = new product();
$show_product = $product->show_product();
?>

<div class="admin-content-right">
    <div class="admin-content-right-product_list">
        <h1>Danh sách sản phẩm</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Loại sản phẩm</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th>Thao tác</th>
            </tr>
            <?php 
            if($show_product){
                $i = 0;
                while($result = $show_product->fetch_assoc()){
                    $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $result['product_name']; ?></td>
                <td><?php echo $result['category_name']; ?></td>
                <td><?php echo $result['brand_name']; ?></td>
                <td><?php echo $result['product_price']; ?></td>
                <td><img src="./uploads/<?php echo $result['product_img']; ?>" alt="" width="80">
                </td>
                <td>
                    <a href="productedit.php?product_id=<?php echo $result['product_id']; ?>">Sửa</a> | 
                    <a href="productdelete.php?product_id=<?php echo $result['product_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                </td>
            </tr>
            <?php 
                }
            }
            ?>
        </table>
    </div>
</div>
</section>
</body>
</html>