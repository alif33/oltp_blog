<?php include("inc/header.php");?>
 <?php include("inc/sidebar.php");?>
 <?php
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../classes/Category.php');
    $cat = new Category();
 ?>

<?php
if(isset($_GET['eid'])){	
		$cid = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['eid']) ;
	}
?>
        <div class="grid_10">		
            <div class="box round first grid">
                <h2>Add New Category</h2>
                <?php
                    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
                    $setCat = $cat->setCategory($_POST , $cid);
                    }
                    if(isset($setCat)){
                        echo $setCat;
                    }
                    ?>  
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                        <?php
                        $catName = $cat->getCategory($cid);
                        if($catName){                           
			while($print = $catName->fetch_assoc()){
                        ?>
                        <input type="text"  name="catName" value="<?php echo $print['catName']?>" class="medium" />
                        <?php }} ?>
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