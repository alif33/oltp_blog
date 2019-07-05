<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
				<?php 
				$getCat = $cat->Cat_list();
				if($getCat){
				while($value = $getCat->fetch_assoc()){
				?>
				<li><a href="<?php echo $value['catId'];?>"><?php echo $value['catName'];?></a></li>

				<?php }} ?>								
					</ul>
			</div>
			
			<div class="samesidebar clear">				
				<h2>Latest articles</h2>
				<?php 
				$getPost = $pst->get_new_post();
				if($getPost){
				while($value = $getPost->fetch_assoc()){
				?>
				<div class="popular clear">
					<h3><a href="#"><?php echo $value['title'];?></a></h3>
					<a href="post.php?pid=<?php echo $value['id'];?>"><img src="admin/<?php echo $value['image'];?>" alt="post image"/></a>
					<p><?php echo $fm->textShorten($value['body'],40);?></p>
					<a id="det_lie" href="post.php?pid=<?php echo $value['id'];?>">Details </a>
				</div>
				<?php }} ?>	
					
			</div>
			
		</div>
	</div>
