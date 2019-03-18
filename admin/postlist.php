<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">SL</th>
							<th width="10%">Category</th>
							<th width="10%">Title</th>
							<th width="15%">Content</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tag</th>
							<th width="10%">Description</th>
							<th width="10%">Date</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
                        $query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat = tbl_category.id ORDER BY tbl_post.id DESC";
                        $getData = $db->select($query);
                        if ($getData) {
                        	$i=0;
                        	while ($result = $getData->fetch_assoc()) {
                        		$i++;
                    ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td><?php echo $fm->readMore($result['body'], 50); ?></td>
							<td class="center"><img src="<?php echo $result['image']; ?>" width="50px" height="40px" alt=""></td>
							<td><?php echo $result['author']; ?></td>
							<td><?php echo $result['tag']; ?></td>
							<td><?php echo $fm->readMore($result['desctiption'], 30); ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td>
								<a href="viewpost.php?viewid=<?php echo $result['id']; ?>">View</a> 
                        <?php 
                            if (Session::get('userid') == $result['userid'] || Session::get('userrole') == '3'){
                        ?>
								|| <a href="editpost.php?editid=<?php echo $result['id']; ?>">Edit</a> || 
								<a onclick = "return confirm('Are You Sure to Delete?')" href="delpost.php?deleteid=<?php echo $result['id']; ?>">Delete</a>
						<?php 
                            }
                        ?>
							</td>
						</tr>
					<?php
					     	}
                        }
					?>
					</tbody>
				</table>
	
               </div>
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
