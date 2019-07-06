<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
class Page{
        private $db;
        private $fm;
public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
public function page_list(){
    $query = "SELECT * FROM tbl_page";
    $value = $this->db->select($query);
    return $value;
}
public function page_list_one($id){
    $query = "SELECT * FROM tbl_page WHERE id='$id'";
    $value = $this->db->select($query);
    return $value;
}
public function add_page($post){
    $name = $this->fm->validation($post['name']);
    $body = $this->fm->validation($post['body']);
  
    //mysqli_part
    $name = mysqli_real_escape_string($this->db->link , $name);
    $body = mysqli_real_escape_string($this->db->link , $body);
    //image validation
   
    if ($name == "" || $body == "" ) {
        $msg = "<span class='error'>Field must not be empty !</span>";
        return $msg;
    } else {        
        $query = "INSERT INTO tbl_page (name , body) VALUES ('$name','$body')";      
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span class='success'>Page Created Successfully .</span>";
                return $msg;
            } else {
                $msg = "<span class='error'> Page Not Created !</span>";
                return $msg;
            }
        }
}
public function update_page_one($post ,$id){
$name = $this->fm->validation($post['name']);
$body = $this->fm->validation($post['body']);
//mysqli_part
$name = mysqli_real_escape_string($this->db->link , $name);
$body = mysqli_real_escape_string($this->db->link , $body);
//image validation      
if ($name == "" || $body == "" ) {
    $msg = "<span class='error'>Field must not be empty !</span>";
    return $msg;
} else {
$query = "UPDATE tbl_page
    SET
    name ='$name',
    body ='$body'               
    WHERE id='$id' ";
$update = $this->db->update($query);
if ($update) {
    $msg = "<span class='success'>Page updated Successfully .</span>";
    return $msg;
} else {
    $msg = "<span class='error'>Page Not Updated !</span>";
    return $msg;
        }
    }

//End brackets...
}








}