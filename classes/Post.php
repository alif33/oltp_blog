<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
class Post{
    private $db;
    private $fm;
public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }


 public function add_Post($post , $file){
        $title= $this->fm->validation($post['title']);
        $catId = $this->fm->validation($post['catId']);
        $date = $this->fm->validation($post['date']);    
        $body = $this->fm->validation($post['body']);
        //mysqli_part
        $title = mysqli_real_escape_string($this->db->link , $title);
        $catId = mysqli_real_escape_string($this->db->link , $catId);
        $date = mysqli_real_escape_string($this->db->link , $date);
        $body = mysqli_real_escape_string($this->db->link , $body);
//image validation(http://www.trainingwithliveproject.com/2016/04/upload-image-with-validation-php-oop-bangla.html)
        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;
        if($title == "" || $catId == "" || $date == "" || $body == ""){
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
            $query  = "INSERT INTO tbl_post(title ,catId , date, image, body) Values('$title','$catId','$date','$uploaded_image','$body')";
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


public function post_list(){
//Alliasis(Banglai_Uponam)    
    $query = "SELECT p.* ,c.catName
        FROM tbl_post as p, tbl_category as c
        WHERE p.catId = c.catId 
        ORDER BY p.id DESC ";
    $result = $this->db->select($query);
    return $result;
/*--INNER JOIN
$query = "SELECT  tbl_product.*, tbl_category.catName, tbl_brand.brandName
FROM tbl_product
INNER JOIN tbl_category
ON tbl_product.catId = tbl_category.catId
INNER JOIN tbl_brand
ON tbl_product.brandId = tbl_brand.brandId
ORDER BY tbl_product.productId DESC";
*/ 
}
    //Delete product list
public function del_post($id){
    $query = "SELECT * FROM tbl_post WHERE id='$id'";
    $data = $this->db->select($query);
    if($data){
        while($img = $data->fetch_assoc()){
            $link = $img['image'];
            unlink($link );
        }
    }
    $query = "DELETE FROM tbl_post WHERE id='$id'";
    $result = $this->db->delete($query);
    if($result){
        $msg ="<span class='success'>Product deleted successfully !</span>";
        return $msg;
    }else{
        $msg ="<span class='error'>Product Not deleted !!</span>";
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
/***********-------------Font view section-------------**********/

public function get_post(){
    $query = "SELECT * FROM tbl_post LIMIT 3 ";
    $value = $this->db->select($query);
    return $value;
}
public function get_new_post(){
    $query = "SELECT * FROM tbl_post ORDER BY id DESC LIMIT 4 ";
    $value = $this->db->select($query);
    return $value;
}  
public function each_post($id){       
$query = "SELECT * FROM  tbl_post WHERE id='$id' ";
        $result = $this->db->select($query);
        return $result;
    } 
public function ral_post($id){       
    $query = "SELECT * FROM  tbl_post WHERE catId='$id' ";
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
