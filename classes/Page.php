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
}