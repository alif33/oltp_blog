<?php include('inc/header.php');?>
<?php include('inc/sidebar.php');?>
<?php
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../classes/Category.php');
    $cat = new Category();
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
             <?php   
                if(isset($_GET['did'])){	
                    $id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['did']);
                    $delCat = $cat->Cat_del($id);
                } 
                if(isset($delCat)){
                    echo $delCat;
                }               
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php 
                    $getCat = $cat->Cat_list();
                    if($getCat){
                        $i = 0;
                        while($value = $getCat->fetch_assoc()){
                        $i++;
                    ?>
						<tr class="odd gradeX" style="text-align:center;" >
							<td><?php echo $i;?></td>
							<td><?php echo $value['catName'];?></td>
							<td><a href="catedit.php?eid<?php echo $value['catId']?>">Edit</a> || <a href="?did=<?php echo $value['catId']?>">Delete</a></td>
                        </tr>
                    <?php }}?>            				
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