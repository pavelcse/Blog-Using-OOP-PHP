<?php include "inc/header.php"; ?>
<?php include "inc/slider.php"; ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
        <?php
            // pagination start...
            $per_page = 5;
            if (isset($_GET['page'])) {
            	$page = $_GET['page'];
            }else{
            	$page = 1;
            }
            $start_form = ($page-1)*$per_page;
        ?>
        <?php 
            $query = "SELECT * FROM tbl_post ORDER BY id DESC LIMIT $start_form, $per_page";
            $post = $db->select($query); 
            if ($post ) {
            	while ($result = $post->fetch_assoc()) {           	
        ?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
				 <a href="post.php?id=<?php echo $result['id']; ?>">
				 	<img src="admin/<?php echo $result['image']; ?>" alt="post image"/>
				 </a>
				 
				<p>
					<?php echo $fm->readMore($result['body']); ?>
				</p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
				</div>
			</div>
			<?php
			        }
            // pagination start...
                $query = "SELECT * FROM tbl_post";
                $result = $db->select($query);
                $total_rows = mysqli_num_rows($result);
                $total_page = ceil($total_rows/$per_page);
                echo "<span class='pagination'> 
                    <a href='index.php?page=1'>".'First Page'."</a>";
                for ($i=1; $i <= $total_page; $i++) { 
                	echo "<a href='index.php?page=".$i."'>$i</a>";
                }
                echo "<a href='index.php?page=$total_page'>".'Last Page'."</a></span>";
            // pagination end...
              }else{
              	header("Location: 404.php");
              }  
            ?>
		</div>
		<?php include "inc/sidebar.php"; ?>
	</div>
	<?php include "inc/footer.php"; ?>