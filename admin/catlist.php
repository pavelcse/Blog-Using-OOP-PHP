<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <?php
                    if (isset($_GET['catid'])) {
                        $delcat = $_GET['catid'];
                        $del_query = "DELETE FROM tbl_category WHERE id='$delcat'";
                        $del = $db->delete($del_query);
                        if ($del) {
                            echo "<span class='success'>Category Deleted Successfully...</span>";
                        }else{
                            echo "<span class='error'>Failed to Delete Category...!!!</span>";
                        }
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
                    $cat_query = "SELECT * FROM tbl_category ORDER BY id DESC";
                    $cat = $db->select($cat_query); 
                    if ($cat) {
                    	$sl = 0;
            	        while ($result = $cat->fetch_assoc()) {  
            	        $sl++;   	
            ?>
						<tr class="odd gradeX">
							<td><?php echo $sl ?></td>
							<td><?php echo $result['name']; ?></td>
							<td>
								<a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a> || 
								<a onclick = "return confirm('Are You Sure to Delete?')" href="?catid=<?php echo $result['id']; ?>">Delete</a>
							</td>
						</tr>
			 <?php 
                }
            }else{
            	echo "No Category Found...!!";
            }
            ?>
					</tbody>
				</table>
               </div>
            </div>
    <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        }); 
    </script>
<?php
    include 'inc/footer.php';
?>