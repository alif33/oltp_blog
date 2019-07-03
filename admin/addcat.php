<?php include("inc/header.php");?>
 <?php include("inc/sidebar.php");?>
 <?php
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../classes/Category.php');
    $cat = new Category();
 ?>
        <div class="grid_10">		
            <div class="box round first grid">
                <h2>Add New Category</h2>
                <?php
                    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
                    $addCat = $cat->add_Category($_POST);
                    }
                    if(isset($addCat)){
                        echo $addCat;
                    }
                    ?>  
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>                    
                        <input type="text"  name="catName" placeholder="Enter a category name .." />
                        </td>
                        </tr>
						<tr> 
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