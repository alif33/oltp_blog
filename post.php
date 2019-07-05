<?php include('inc/header.php');?>
<?php
if(isset($_GET['pid'])){	
	$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['pid']) ;
	}
?>
<div class="contentsection contemplete clear">
<div class="maincontent clear">	
	<div class="about">
	<?php 
	$getPst = $pst->each_post($id);
	if($getPst){
	while($value = $getPst->fetch_assoc()){
	?>				
		<h2><?php echo $value['title'];?></h2>
		<h4><?php echo $fm->formatDate($value['date']);?>, By <?php echo $value['author'];?></h4>
		<img src="admin/<?php echo $value['image'];?>" alt="MyImage"/>
		<p><?php echo $value['body'];?></p>
		<?php $cat_r =$value['catId']; }} ?>						
		<div class="relatedpost clear">
			<h2>Related articles</h2>
	<?php 
	$get_rel_post = $pst->ral_post($cat_r);
	if($get_rel_post){
	while($value = $get_rel_post->fetch_assoc()){
	?>		
<a href="?pid=<?php echo $value['id'];?>"><img src="admin/<?php echo $value['image'];?>" alt="MyImage"/></a>
	<?php }} ?>			
		</div>
	</div>
</div>
<?php include('inc/sidebar.php');?>
<?php include('inc/footer.php');?>