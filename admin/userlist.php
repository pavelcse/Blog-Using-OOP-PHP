<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
                <?php
                    if (isset($_GET['userid'])) {
                        $deluser = $_GET['userid'];
                        $del_query = "DELETE FROM tbl_user WHERE id='$deluser'";
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
                            <th>Name</th>
                            <th>UserName</th>
                            <th>Email</th>
                            <th>Details</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
			<?php 
                    $query = "SELECT * FROM tbl_user ORDER BY id DESC";
                    $userlist = $db->select($query); 
                    if ($userlist) {
                    	$sl = 0;
            	        while ($result = $userlist->fetch_assoc()) {  
            	        $sl++;   	
            ?>
						<tr class="odd gradeX">
							<td><?php echo $sl ?></td>
                            <td><?php echo $result['name']; ?></td>
                            <td><?php echo $result['username']; ?></td>
                            <td><?php echo $result['email']; ?></td>
                            <td><?php echo $fm->readMore($result['details'], 20); ?></td>
							<td>
                                <?php 
                                    if ($result['role'] == '1') {
                                        echo "Editor";
                                    }elseif ($result['role'] == '2') {
                                        echo "Author";
                                    }elseif ($result['role'] == '3') {
                                        echo "Admin";
                                    }else{
                                        echo "Role Not Define ";
                                    }
                                 ?>
                            </td>
							<td>
								<a href="viewuser.php?userid=<?php echo $result['id']; ?>">View</a>  
					<?php 
                        if (Session::get('userrole') == '3') {
                    ?>
                              ||  <a onclick = "return confirm('Are You Sure to Delete?')" href="?userid=<?php echo $result['id']; ?>">Delete</a>
                    <?php 
                        }
                    ?>
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