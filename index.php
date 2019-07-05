<?php include('inc/header.php');?>
<?php include('inc/slider.php');?>	
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<?php 
			$getPst = $pst->get_post();
			if($getPst){
			while($value = $getPst->fetch_assoc()){
			?>			
		    		<div class="samepost clear">
				<h2><a href=""><?php echo $value['title'];?></a></h2>
				<h4><?php echo $fm->formatDate($value['date']);?> By <a href="#"><?php echo $value['author'];?></a></h4>
				 <a href="#"><img src="admin/<?php echo $value['image'];?>" alt="post image"/></a>
				<p>
				<?php echo $fm->textShorten($value['body'],300);?>
				</p>
				<div class="readmore clear">
					<a href="post.html">Read More</a>
				</div>
			</div>
		<?php }} ?>	
		</div>
<?php include('inc/sidebar.php');?>
<?php include('inc/footer.php');?>
