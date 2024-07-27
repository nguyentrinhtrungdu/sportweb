<?php
include_once __DIR__ . "/../database.php";

class product {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function show_product() {
        $query = "SELECT tbl_product.*, tbl_category.category_name, tbl_brand.brand_name
                  FROM tbl_product
                  INNER JOIN tbl_category ON tbl_product.category_id = tbl_category.category_id
                  INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
                  ORDER BY tbl_product.product_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_category() {
        $query = "SELECT * FROM tbl_category ORDER BY category_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_category($category_id) {
        $query = "SELECT * FROM tbl_category WHERE category_id= '$category_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_brand() {
        $query= "SELECT tbl_brand.*, tbl_category.category_name
                 FROM tbl_brand 
                 INNER JOIN tbl_category ON tbl_brand.category_id = tbl_category.category_id 
                 ORDER BY tbl_brand.brand_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_product($data, $files) {
        $product_name = $data['product_name'];
        $category_id = $data['category_id'];
        $brand_id = $data['brand_id'];
        $product_price = $data['product_price'];
        $product_img = $files['product_img']['name'];
        $file_target = basename($files['product_img']['name']);
        $file_size = $files['product_img']['size'];
        $file_type = strtolower(pathinfo($product_img, PATHINFO_EXTENSION));

        if (file_exists("./uploads/$file_target")) {
            $alert = "File đã tồn tại";
            return $alert;
        } else {
            if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg") {
                $alert = "Chỉ chọn file jpg, png, jpeg";
                return $alert;
            } else {
                if ($file_size > 1000000) {
                    $alert = "File không được lớn hơn 1MB";
                    return $alert;
                } else {
                    move_uploaded_file($files['product_img']['tmp_name'], "./uploads" . $product_img);

                    $query = "INSERT INTO tbl_product (
                                product_name,
                                category_id,
                                brand_id,
                                product_price,
                                product_img
                              )
VALUES (
                                '$product_name',
                                '$category_id',
                                '$brand_id',
                                '$product_price',
                                '$product_img'
                              )";
                    $result = $this->db->insert($query);
                    return $result;
                }
            }
        }
    }

    public function show_brand_ajax($category_id) {
        $query = "SELECT * FROM tbl_brand WHERE category_id= '$category_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_brand($brand_id) {
        $query = "SELECT * FROM tbl_brand WHERE brand_id= '$brand_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_brand($category_id, $brand_name, $brand_id) {
        $query = "UPDATE tbl_brand SET brand_name='$brand_name', category_id='$category_id' WHERE brand_id='$brand_id'";
        $result = $this->db->update($query);
        header('Location:brandlist.php');
        return $result;
    }

    public function delete_product($product_id) {
        // Lấy tên ảnh của sản phẩm cần xóa
        $query = "SELECT product_img FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this->db->select($query);

        if ($result) {
            $product = $result->fetch_assoc();
            $product_img = $product['product_img'];

            // Xóa sản phẩm khỏi cơ sở dữ liệu
            $query = "DELETE FROM tbl_product WHERE product_id = '$product_id'";
            $delete = $this->db->delete($query);

            if ($delete) {
                // Xóa ảnh khỏi thư mục uploads
                $file_path = "./uploads/$product_img";
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
 
    public function update_product($product_name, $category_id, $brand_id, $product_price, $product_img, $product_id) {
        $query = "UPDATE tbl_product SET
                    product_name='$product_name',
                    category_id='$category_id',
                    brand_id='$brand_id',
                    product_price='$product_price',
                    product_img='$product_img'
                  WHERE product_id='$product_id'";
        $result = $this->db->update($query);
        header('Location:productlist.php');
        return $result;
    }
    
    public function get_product($product_id) {
        $query = "SELECT * FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>