<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../../classes/Slogan.php');
$slo = new Slogan();
?>
<div id="site_info">
        <?php
        $copy = $slo->get_copy();
        if($copy){
        while($val = $copy->fetch_assoc()){ 
        ?>
        <p>       
         &copy; <?php echo $val['copy'];?>
        </p>
        <?php }} ?>
    </div>
</body>
</html>
