<?php include("inc/header.php");?>
 <?php include("inc/sidebar.php");?>
 <?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Page.php');
$page = new Page();
?>
<div class="grid_10">		
<div class="box round first grid">
    <h2>Add New Post</h2>
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
        $addpage = $page->add_page($_POST);
        }
        if(isset($addpage)){
            echo $addpage;
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
                    <input type="text" name="name" placeholder="Enter Post Title..." class="medium" />
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
