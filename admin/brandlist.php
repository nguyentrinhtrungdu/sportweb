<?php 
include "header.php";
include "slider.php";
include "class/brand_class.php";
?>

<?php
    $brand = new brand;
    $show_brand= $brand -> show_brand();
?>

<div class="admin-content-right">
<div class="admin-content-right-category_list">
                <h1>Danh sách danh mục</h1>
                <table>
                    <tr>
                        <th>
                            Stt
                        </th>
                        <th>Id</th>
                        <th>Category_id</th>
                        <th>Danh mục</th>
                        <th>Tùy biến</th>
                    </tr>
                    <?php
                    if($show_category){$i=0;
                        while($result = $show_category->fetch_assoc()) {$i++;

                       
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['brand_id'] ?></td>

                        <td><?php echo $result['category_id'] ?></td>
                        <td><?php echo $result['brand_name'] ?></td>
                        <td><a href="brandedit.php?brand_id= <?php echo $result['brand_id']?>">Sửa</a>|<a href="branddelete.php?brand_id= <?php echo $result['brand_id']?>">Xóa</a></td>
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