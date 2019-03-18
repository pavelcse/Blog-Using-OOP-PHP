<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
<?php

if (isset($_GET['seenid'])){
	$msgid = $_GET['seenid'];

        $query = "UPDATE tbl_contact SET status ='1' WHERE id = '$msgid' ";
        $seen = $db->update($query);
            if ($seen) {
                echo "<span class='success'>Message Seen..!!!</span>";
            }else{
                echo "<span class='error'>Something Seems Wrong...!!!</span>";
                    }
    }
    if (isset($_GET['unseenid'])){
	$msgid = $_GET['unseenid'];

        $query = "UPDATE tbl_contact SET status ='0' WHERE id = '$msgid' ";
        $seen = $db->update($query);
            if ($seen) {
                echo "<span class='success'>Message Unseen..!!!</span>";
            }else{
                echo "<span class='error'>Something Seems Wrong...!!!</span>";
                    }
    }

    if (isset($_GET['deleteid'])){
	$deleteid = $_GET['deleteid'];

        $query = "DELETE FROM tbl_contact WHERE id='$deleteid'";
        $delete = $db->delete($query);
            if ($deleteid) {
        	echo "<script>alert('Message Deleted Successfully..');</script>";
        	echo "<script>window.location = 'inbox.php'; </script>";

        }else{
        	echo "<script>alert('Error, Message Not Delete..');</script>";
        	echo "<script>window.location = 'inbox.php'; </script>";
        }
    }
?>
                <div class="block">  

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Date</th>
							<th>Message</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
				<?php 
                    $query = "SELECT * FROM tbl_contact WHERE status='0' ORDER BY id DESC";
                    $msg = $db->select($query); 
                    if ($msg) {
                    	$sl = 0;
            	        while ($result = $msg->fetch_assoc()) {  
            	        $sl++;   	
                ?>
						<tr class="odd gradeX">
							<td><?php echo $sl ?></td>
							<td><?php echo $result['firstname']." ".$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $fm->readMore($result['body'], 30); ?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> || 
								<a href="replaymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a> || 
								<a onclick = "return confirm('Are You Sure to Move?')" href="?seenid=<?php echo $result['id']; ?>">Seen</a>
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

            <div class="box round first grid">
                <h2>Seen Message</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Date</th>
							<th>Message</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
				<?php 
                    $query = "SELECT * FROM tbl_contact WHERE status='1' ORDER BY id DESC";
                    $msg = $db->select($query); 
                    if ($msg) {
                    	$sl = 0;
            	        while ($result = $msg->fetch_assoc()) {  
            	        $sl++;   	
                ?>
						<tr class="odd gradeX">
							<td><?php echo $sl ?></td>
							<td><?php echo $result['firstname']." ".$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $fm->readMore($result['body'], 30); ?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> || 
								<a onclick = "return confirm('Are You Sure to Move?')" href="?unseenid=<?php echo $result['id']; ?>">Unseen</a> || 
								<a onclick = "return confirm('Are You Sure to Delete?')" href="?deleteid=<?php echo $result['id']; ?>">Delete</a>
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