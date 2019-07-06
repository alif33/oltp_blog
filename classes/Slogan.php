<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
class Slogan{
        private $db;
        private $fm;
public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

public function get_slogan(){
    $query = "SELECT * FROM tbl_slogan";
    $value = $this->db->select($query);
    return $value;
}

public function update_slogan($_post , $file){
    $title = $this->fm->validation($_post['title']);
    $slogan = $this->fm->validation($_post['slogan']);
  
    //mysqli_part
    $title = mysqli_real_escape_string($this->db->link , $title);
    $slogan = mysqli_real_escape_string($this->db->link , $slogan);
    //image validation
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;
    
    if ($title == "" || $slogan == "" ) {
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
                $query = "UPDATE tbl_slogan
            SET
            title ='$title',
            slogan ='$slogan',          
            image ='$uploaded_image', 
            WHERE sId='1' ";
                $update = $this->db->update($query);
                if ($update) {
                    $msg = "<span class='success'>Product Updated Successfully .</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'> Product Not Updated !</span>";
                    return $msg;
                }
            }
        } else {
        $query = "UPDATE tbl_slogan
        SET
        title ='$title',
        slogan ='$slogan',     
        WHERE sId='1' ";
            $update = $this->db->update($query);
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
//End brackets
}