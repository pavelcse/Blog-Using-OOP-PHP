<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
			<?php 
                    $cat_query = "SELECT * FROM tbl_category";
                    $cat = $db->select($cat_query); 
                    if ($cat ) {
            	        while ($result = $cat->fetch_assoc()) {           	
            ?>
						<li><a href="posts.php?category=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
            <?php 
                }
            }else{
            ?>
						<li><a href="#">No Category Found</a></li>
			<?php
                }
			?>						
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
			<?php 
                $query = "SELECT * FROM tbl_post ORDER BY id DESC LIMIT 8";
                $post = $db->select($query); 
                if ($post ) {
            	    while ($result = $post->fetch_assoc()) {           	
            ?>
					<div class="popular clear">
						<h3><a href="post.php?id=<?php echo $result['id']; ?>"> <?php echo $result['title']; ?></a></h3>
						<a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
						<p>
							<?php echo $fm->readMore($result['body'], 120); ?>
								
							</p>	
					</div>
            <?php
                }
            }else{
                header('Location: 404.php');
            }
            ?>
	
			</div>
			
		</div>