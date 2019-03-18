<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Slider List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">SL</th>
							<th width="25%">Slider Title</th>
							<th width="55%">Slider Image</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
                        $query = "SELECT * FROM tbl_slider ORDER BY id DESC";
                        $getData = $db->select($query);
                        if ($getData) {
                        	$i=0;
                        	while ($result = $getData->fetch_assoc()) {
                        		$i++;
                    ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td class="center"><img src="<?php echo $result['slider']; ?>" width="500px" height="100px" alt=""></td>
							<td>
                        <?php 
                            if (Session::get('userrole') == '3'){
                        ?>
								|| <a href="editslider.php?editid=<?php echo $result['id']; ?>">Edit</a> || 
								<a onclick = "return confirm('Are You Sure to Delete?')" href="delslider.php?sliderid=<?php echo $result['id']; ?>">Delete</a>
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
