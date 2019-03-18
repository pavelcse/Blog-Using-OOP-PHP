
<?php include "inc/header.php"; ?>



	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
        <?php 
            $category = mysqli_real_escape_string($db->link, $_GET['category']);
            if (!isset($category) || $category == NULL) {
                header('Location: 404.php');
            }else{
                $category = $category;
            }
                $query = "SELECT * FROM tbl_post WHERE cat=$category";
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
                echo "<h3>No Post Available in this Category...!!!</h3>";
            }
            ?>

		</div>
		<?php include "inc/sidebar.php"; ?>
	</div>

	<?php include "inc/footer.php"; ?>