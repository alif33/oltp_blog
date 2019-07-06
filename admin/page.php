<?php include("inc/header.php");?>
 <?php include("inc/sidebar.php");?>
 <?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Page.php');
$page = new Page();
?>
<?php
if(isset($_GET['pgid'])){
    $pgid = $_GET['pgid']; 
}

?>
<div class="grid_10">		
<div class="box round first grid">
    <h2>Add New Post</h2>
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
        $addup = $page->update_page_one($_POST , $pgid);
        }
        if(isset($addup)){
            echo $addup;
        }
    ?>  
    <div class="block">
                <!-- from start here -->               
        <form action="" method="post" enctype="multipart/form-data">
        <?php                   
        $getpage = $page->page_list_one($pgid);
        if($getpage){
        while($val = $getpage->fetch_assoc()){
        ?>        
        <table class="form">            
            <tr>
                <td>
                    <label>Title</label>
                </td>
                <td>
                    <input type="text" name="name" value="<?php echo $val['name'];?>" class="medium" />
                </td>
            </tr>   
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea  name="body" class="tinymce">
                    <?php echo $val['body'];?>
                    </textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Save" />
                </td>
            </tr>
        </table>
        <?php }} ?>
        </form>
    </div>
</div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>
<?php include("inc/footer.php");?>