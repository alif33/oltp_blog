<?php include('inc/header.php');?>
<?php include('inc/sidebar.php');?>
<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/Slogan.php');
    $slo = new Slogan();
?>
        <div class="grid_10">		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <?php
                if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
                $upcopy = $slo->update_copy($_POST);
                }
                if(isset($upcopy)){
                    echo $upcopy;
                } ?>
                <div class="block copyblock"> 
                <form action="" method="post" >
                    <table class="form">
                    <?php
                    $copy = $slo->get_copy();
                    if($copy){
                    while($val = $copy->fetch_assoc()){ 
                    ?>					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $val['copy']?>" name="copy" class="large" />
                            </td>
                        </tr>
					<?php }} ?>	
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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
<?php include('inc/footer.php');?>