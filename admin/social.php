<?php include('inc/header.php');?>
<?php include('inc/sidebar.php');?>
<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/Slogan.php');
    $slo = new Slogan();
?>
        <div class="grid_10">		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <?php
                if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
                $upso = $slo->update_social($_POST);
                }
                if(isset($upso)){
                    echo $upso;
                }
                ?> 
                <div class="block">               
                 <form action="" method="post" >
                <?php
                    $soc = $slo->get_social();
                    if($soc){
                    while($val = $soc->fetch_assoc()){ 
                ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fa" value="<?php echo $val['fa'];?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?php echo $val['tw'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?php echo $val['ln'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp" value="<?php echo $val['gp'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }} ?>     
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
<?php include('inc/footer.php');?>