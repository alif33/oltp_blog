<?php include("inc/header.php");?>
 <?php include("inc/sidebar.php");?>
 <?php
$filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../classes/Post.php');
 include_once ($filepath.'/../helpers/Format.php');
 $pst = new Post();
 $fm = new Format();
?>
<?php
if(isset($_GET['did'])){	
$did = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['did']) ;
$delpost = $pst->del_post($did);
}
?>
<div class="grid_10">
	<div class="box round first grid">
	<h2>Post List</h2>
<?php
if(isset($delpost)){
echo $delpost;
}
?>
	<div class="block">  
	<table class="data display datatable" id="example">
		<thead>
		<tr>
			<th>Id</th>
			<th>Category</th>
			<th>Author</th>
			<th>Title</th>
			<th>Date</th>
			<th>Image</th>
			<th>Description</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>	
		<?php 
                    $getPost = $pst->post_list();
                    if($getPost){
                        $i = 0;
                        while($value = $getPost->fetch_assoc()){
                        $i++;
                    ?>		
		<tr class="odd gradeX" style="text-align:center;">		
			<td><?php echo $i ;?></td>
			<td><?php echo $value['catName']?></td>
			<td><?php echo $value['author']?></td>
			<td><?php echo $value['title']?></td>
			<td><?php echo $value['date']?></td>
			<td><img src="<?php echo $value['image']?>" alt="" height="40px" width="40px"> </td>
			<td><?php echo $fm->textShorten($value['body'] , 30)?></td>
			<td><a href="editpost.php?eid=<?php echo $value['id']?>">Edit</a> || <a href="?did=<?php echo $value['id']?>">Delete</a></td>
		</tr>
		<?php }} ?>
		</tbody>
	</table>

	</div>
	</div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>
<script type="text/javascript">
$(document).ready(function () {
	setupLeftMenu();
	$('.datatable').dataTable();
		setSidebarHeight();
});
</script>
<?php include('inc/footer.php');?> 