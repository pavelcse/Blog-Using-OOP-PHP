
<?php include "inc/header.php"; ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
        <?php 
            $search = mysqli_real_escape_string($db->link, $_GET['search']);
            if (!isset($search) || $search == NULL) {
                header('Location: 404.php');
            }else{
                $search = $search;
            }
                $query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
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
            }else{
               echo "<p>No Search Result Found...!!!</p>";
            }
            ?>

		</div>
		<?php include "inc/sidebar.php"; ?>
	</div>

	<?php include "inc/footer.php"; ?>