 <?php include("inc/header.php");?>
 <?php include("inc/sidebar.php");?>
 <?php
$filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../classes/Post.php');
 include_once ($filepath.'/../classes/Category.php');
 $pst = new Post();
 $cat = new Category();
?>
<div class="grid_10">		
<div class="box round first grid">
    <h2>Add New Post</h2>
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
        $addpost = $pst->add_Post($_POST , $_FILES);
        }
        if(isset($addpost)){
            echo $addpost;
        }
    ?>  
    <div class="block">
                <!-- from start here -->               
        <form action="" method="post" enctype="multipart/form-data">
        <table class="form">            
            <tr>
                <td>
                    <label>Title</label>
                </td>
                <td>
                    <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                </td>
            </tr>
            
            <tr>
                <td>
                    <label>Category</label>
                </td>
                <td>
                    <select id="select" name="catId">
                    <option value="">Select Category</option>
                    <?php
                        $catName = $cat->Cat_list();
                        if($catName){                           
			            while($print = $catName->fetch_assoc()){
                        ?>   
                        <option value="<?php echo $print['catId'];?>"><?php echo $print['catName'];?></option>
                        <?php }} ?>
                    </select>
                </td>
            </tr>
        
        
            <tr>
                <td>
                    <label>Date Picker</label>
                </td>
                <td>
                    <input name="date" type="text" id="date-picker" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Upload Image</label>
                </td>
                <td>
                    <input type="file"  name="image">
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea  name="body" class="tinymce"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Save" />
                </td>
            </tr>
        </table>
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
