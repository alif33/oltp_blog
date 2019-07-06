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

/*####################---------Social media section start------------#########################*/

public function get_social(){
    $query = "SELECT * FROM tbl_social";
    $value = $this->db->select($query);
    return $value;
}
public function update_social($post){
    $fa = $this->fm->validation($post['fa']);
    $tw = $this->fm->validation($post['tw']);
    $ln = $this->fm->validation($post['ln']);
    $gp = $this->fm->validation($post['gp']);
//---------mysqli_part
    $fa = mysqli_real_escape_string($this->db->link , $fa);
    $tw = mysqli_real_escape_string($this->db->link , $tw); 
    $ln = mysqli_real_escape_string($this->db->link , $ln);
    $gp = mysqli_real_escape_string($this->db->link , $gp); 
    
    if ($fa == "" || $tw == "" || $ln == "" || $gp == ""){
        $msg = "<span class='error'>Field must not be empty !</span>";
        return $msg;
    } else {
        $query = "UPDATE tbl_social
        SET
        fa ='$fa',
        tw ='$tw',
        ln ='$ln',
        gp ='$gp'         
        WHERE id = 1 ";
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

public function get_copy(){
    $query = "SELECT * FROM tbl_copyright";
    $value = $this->db->select($query);
    return $value;
}
public function update_copy($post){
    $copy = $this->fm->validation($post['copy']);
//---------mysqli_part
    $copy = mysqli_real_escape_string($this->db->link , $copy);  
    if ($copy == ""){
        $msg = "<span class='error'>Field must not be empty !</span>";
        return $msg;
    } else {
        $query = "UPDATE tbl_copyright
        SET
        copy ='$copy'        
        WHERE id = 1 ";
            $update = $this->db->update($query);
            if ($update) {
                $msg = "<span class='success'>Copyright Updated Successfully .</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Copyright Not Updated !</span>";
                return $msg;
            }
        }  

}


//End brackets
}