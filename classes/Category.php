<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

class Category{
private $db;
private $fm;
public function __construct(){
$this->db = new Database();
$this->fm = new Format();
}
public function addCategory($catName){
$catName = $this->fm->validation($catName);
$catName = mysqli_real_escape_string($this->db->link , $catName);
if($catName == ""){
    $catadd_msg = "Category must not be empty .";
    return $catadd_msg;
}else{
    $query  = "INSERT INTO tbl_category(catName) Values('$catName')";
    $result = $this->db->insert($query); 
    if($result){
    $catadd_msg = "<span class='success'>Category Inserted Successfully .</span>";
    return $catadd_msg;
    }else{
    $catadd_msg = "Category Not Inserted .";
    return $catadd_msg;   
    }    
    }
}
public function Category_list(){
        $query  = "SELECT * FROM tbl_category";
        $result = $this->db->select($query); 
        return $result;         
    }
public function Category_del($delid){
    $query  = "DELETE FROM tbl_category WHERE catId='$delid' ";
    $result = $this->db->delete($query); 
    if($result){
        $delmsg = "<span class='success'>Category Deleted successfully !</span>";
        return $delmsg;
    }        
}
public function Category_edit($editid){
    $query  = "SELECT * FROM tbl_category WHERE catId='$editid'";
    $result = $this->db->select($query); 
    return $result;         
}

public function update_Category($catName,$editid){
$catName = $this->fm->validation($catName);
$catName = mysqli_real_escape_string($this->db->link , $catName);
if($catName == ""){
    $msg = "<span class='error'>Category must not be empty !</span>";
    return $msg;
}else{
    $query  = "UPDATE  tbl_category 
    SET catName = '$catName'
    WHERE catId = '$editid' ";
    $result = $this->db->update($query); 
     if($result){
        $msg = "<span class='error'>Category Updated successfully !</span>";
        return $msg;  
     }else{
        $msg = "<span class='error'>Category Not Updated !</span>";
        return $msg; 
     }

     }   
}
//end brackets  
}
