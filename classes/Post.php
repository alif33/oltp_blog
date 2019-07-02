<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

class Product{
    private $db;
    private $fm;
public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
public function add_Product($_post , $_file){
        $productName= $this->fm->validation($_post['productName']);
        $catId = $this->fm->validation($_post['catId']);
        $brandId = $this->fm->validation($_post['brandId']);
        $body = $this->fm->validation($_post['body']);
        $price = $this->fm->validation($_post['price']);
        $type = $this->fm->validation($_post['type']);
        //mysqli_part
        $productName = mysqli_real_escape_string($this->db->link , $productName);
        $catId = mysqli_real_escape_string($this->db->link , $catId);
        $brandId = mysqli_real_escape_string($this->db->link , $brandId);
        $body = mysqli_real_escape_string($this->db->link , $body);
        $price = mysqli_real_escape_string($this->db->link , $price);
        $type = mysqli_real_escape_string($this->db->link , $type);
        //image validation(http://www.trainingwithliveproject.com/2016/04/upload-image-with-validation-php-oop-bangla.html)
        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_file['image']['name'];
        $file_size = $_file['image']['size'];
        $file_temp = $_file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;
        if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" ){
            $msg = "<span class='error'>Field must not be empty !</span>";
            return $msg;
        }elseif ($file_size >1048567) {
            $msg =  "<span class='error'>Image Size should be less then 1MB! </span>";
            return $msg;
        } elseif (in_array($file_ext, $permited) === false) {
            $msg = "<span class='error'>You can upload only:-"
                .implode(', ', $permited)." file .</span>";
            return $msg;
        }
        else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query  = "INSERT INTO tbl_product(productName ,catId ,brandId, body, price, image, type) Values('$productName','$catId','$brandId','$body','$price','$uploaded_image' ,'$type')";
            $result = $this->db->insert($query);
            if($result){
                $msg = "<span class='success'>Product Inserted Successfully .</span>";
                return $msg;
            }else{
                $msg = "<span class='error'> Product Not Inserted !</span>";
                return $msg;
            }
        }
    }
    //Archive product list
    public function product_list(){
        /*--INNER JOIN
$query = "SELECT  tbl_product.*, tbl_category.catName, tbl_brand.brandName
FROM tbl_product
INNER JOIN tbl_category
ON tbl_product.catId = tbl_category.catId
INNER JOIN tbl_brand
ON tbl_product.brandId = tbl_brand.brandId
ORDER BY tbl_product.productId DESC";
*/
        //Alliasis(Banglai_Uponam)
        $query = "SELECT p.* ,c.catName, b.brandName
FROM tbl_product as p, tbl_category as c,tbl_brand as b
WHERE p.catId = c.catId AND p.brandId = b.brandId
ORDER BY p.productId DESC ";
        $result = $this->db->select($query);
        return $result;
    }
    //Delete product list
    public function del_product($id){
        $query = "SELECT * FROM tbl_product WHERE productId='$id'";
        $data = $this->db->select($query);
        if($data){
            while($img = $data->fetch_assoc()){
                $link = $img['image'];
                unlink($link );
            }
        }
        $query = "DELETE FROM tbl_product WHERE productId='$id'";
        $result = $this->db->delete($query);
        if($result){
            $msg ="Product deleted successfully !";
            return $msg;
        }else{
            $msg ="Product Not deleted";
            return $msg;
        }
    }
    public function get_product($id){
        $query = "SELECT * FROM tbl_product WHERE productId='$id'";
        $value = $this->db->select($query);
        return $value;
    }
    public function update_Product($_post , $_file ,$id){
        $productName = $this->fm->validation($_post['productName']);
        $catId = $this->fm->validation($_post['catId']);
        $brandId = $this->fm->validation($_post['brandId']);
        $body = $this->fm->validation($_post['body']);
        $price = $this->fm->validation($_post['price']);
        $type = $this->fm->validation($_post['type']);
        //mysqli_part
        $productName = mysqli_real_escape_string($this->db->link , $productName);
        $catId = mysqli_real_escape_string($this->db->link , $catId);
        $brandId = mysqli_real_escape_string($this->db->link , $brandId);
        $body = mysqli_real_escape_string($this->db->link , $body);
        $price = mysqli_real_escape_string($this->db->link , $price);
        $type = mysqli_real_escape_string($this->db->link , $type);
        //image validation
        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_file['image']['name'];
        $file_size = $_file['image']['size'];
        $file_temp = $_file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;
        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
            $msg = "<span class='error'>Field must not be empty !</span>";
            return $msg;
        } else {
            if (!empty($file_name)) {
                if ($file_size > 1048567) {
                    $msg =  "<span class='error'>Image Size should be less then 1MB! </span>";
                    return $msg;
                } elseif (in_array($file_ext, $permited) === false) {
                    $msg = "<span class='error'>You can upload only:-"
                        . implode(', ', $permited) . " file .</span>";
                    return $msg;
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product
                SET
                productName ='$productName',
                catId ='$catId', 
                brandId ='$brandId', 
                body ='$body', 
                price ='$price', 
                image ='$uploaded_image', 
                type ='$type' 
                WHERE productId='$id' ";
                    $update = $this->db->insert($query);
                    if ($update) {
                        $msg = "<span class='success'>Product Updated Successfully .</span>";
                        return $msg;
                    } else {
                        $msg = "<span class='error'> Product Not Updated !</span>";
                        return $msg;
                    }
                }
            } else {
            $query = "UPDATE tbl_product
            SET
            productName ='$productName',
            catId ='$catId', 
            brandId ='$brandId', 
            body ='$body', 
            price ='$price', 
            type ='$type' 
            WHERE productId='$id' ";
                $update = $this->db->insert($query);
                if ($update) {
                    $msg = "<span class='success'>Product Updated Successfully .</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'> Product Not Updated !</span>";
                    return $msg;
                }
            }
        }
    }
//Feature product list
public function get_feature_product(){
    $query = "SELECT * FROM tbl_product WHERE type='0' ";
    $value = $this->db->select($query);
    return $value;
}
public function get_new_product(){
    $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4 ";
    $value = $this->db->select($query);
    return $value;

}  
public function each_item($id){       
/*--INNER JOIN
$query = "SELECT  tbl_product.*, tbl_category.catName, tbl_brand.brandName
FROM tbl_product
INNER JOIN tbl_category
ON tbl_product.catId = tbl_category.catId
INNER JOIN tbl_brand
ON tbl_product.brandId = tbl_brand.brandId
ORDER BY tbl_product.productId DESC";
*/
//Alliasis(Banglai_Uponam)
$query = "SELECT p.* ,c.catName, b.brandName
FROM tbl_product as p, tbl_category as c,tbl_brand as b
WHERE p.catId = c.catId AND p.brandId = b.brandId 
/***condition for each product data***/AND p.productId ='$id'
ORDER BY p.productId DESC ";
        $result = $this->db->select($query);
        return $result;
    } 
public function get_first_brand(){
    $query = "SELECT * FROM tbl_product WHERE brandId='1' ORDER BY brandId DESC LIMIT 1";
    $value = $this->db->select($query);
    return $value;
}
public function get_second_brand(){
    $query = "SELECT * FROM tbl_product WHERE brandId='5' ORDER BY brandId DESC LIMIT 1";
    $value = $this->db->select($query);
    return $value;
}  
public function get_third_brand(){
    $query = "SELECT * FROM tbl_product WHERE brandId='8' ORDER BY brandId DESC LIMIT 1";
    $value = $this->db->select($query);
    return $value;
}  
public function get_forth_brand(){
    $query = "SELECT * FROM tbl_product WHERE brandId='10' ORDER BY brandId DESC LIMIT 1";
    $value = $this->db->select($query);
    return $value;
}     
public function get_cat_product($id){
    $query = "SELECT * FROM tbl_product WHERE catId='$id'";
    $value = $this->db->select($query);
    return $value;
} 
  //end brackets  
}
