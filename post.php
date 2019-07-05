<?php include('inc/header.php');?>
<?php
if(isset($_GET['pid'])){	
	$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['pid']) ;
	}
?>
<div class="contentsection contemplete clear">
<div class="maincontent clear">
	<?php 
	$getPst = $pst->each_post($id);
	if($getPst){
	while($value = $getPst->fetch_assoc()){
	?>
	<div class="about">				
		<h2><?php $value['title'];?></h2>
		<h4><?php $fm->formatDate($value['date']);?>, By <?php $value['author'];?></h4>
		<img src="admin/<?php $value['image'];?>" alt="MyImage"/>
		<p><?php $value['body'];?></p>					
		<div class="relatedpost clear">
			<h2>Related articles</h2>
			<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
			<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
			<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
			<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
			<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
			<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
		</div>
	</div>
	<?php }} ?>	
</div>
<?php include('inc/sidebar.php');?>
<?php include('inc/footer.php');?>