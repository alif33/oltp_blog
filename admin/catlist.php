<?php include('inc/header.php');?>
<?php include('inc/sidebar.php');?>
<style>
tr.odd td, tr.even td {text-align: center;padd
                <div class="block">        
                    <table class="data display datae" id="example">
					<thead>
						<tr>
							<th width="20%">Serial No.</th>
		="30%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$get_cat = $cat->get_all_cat();
						if($get_cat){
						$i = 0;
						while ($value = $get_cat->fetch_assoc()) {
						$i++; ?>	
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $value['catName'];?></td>
							<td><a href="<?php echo $value['catId'];?>">Edit</a> || <a href="?did=<?php echo $value['catId'];?>">Delete</a></td>
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
<?php include('inc/footer.php');?>