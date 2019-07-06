<?php include('inc/header.php');?>
<?php include('inc/sidebar.php');?>
<div class="grid_10">
<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/Slogan.php');
    $slo = new Slogan();
?>		
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
$upSlo = $slo->update_slogan($_POST , $_FILES);
}
if(isset($upSlo)){
    echo $upSlo;
}
?> 
    <div class="block sloginblock">               
        <div class="slo-left">
        <form action="" method="post" >
        <?php
        $slo = $slo->get_slogan();
        if($slo){
            while($val = $slo->fetch_assoc()){ ?>
        <table class="form">					
                <tr>
                    <td>
                        <label>Website Title</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $val['title'];?>"  name="title" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Website Slogan</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $val['slogan'];?>" name="slogan" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Website Image</label>
                    </td>
                    <td>
                    <input type="file" name="image" />
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
            </div>
        <div class="slo-right"><img src="upload/<?php echo $val['image'];?>" alt=""></div>            
        </div>
    <?php }} ?>    
    </div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<?php include('inc/footer.php');?>