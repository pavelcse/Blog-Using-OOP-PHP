<?php include "inc/header.php"; ?>


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
		<?php 
		    $id = mysqli_real_escape_string($db->link, $_GET['id']);
		    if (!isset($id) || $id == NULL) {
		    	header('Location: 404.php');
		    }else{
		    	$id = $id;
		    }
		    	$query = "SELECT * FROM tbl_post WHERE id=$id";
                $post = $db->select($query); 
                if ($post ) {
            	    while ($result = $post->fetch_assoc()) {   
            ?>
			<div class="about">
				<h2>
					<?php echo $result['title']; ?>
				</h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
				<img src="admin/<?php echo $result['image']; ?>" alt="post image"/>
				<p>
					<?php echo $result['body']; ?>
				</p>
				

<div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://techbd-1.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>






				<div class="relatedpost clear">
					<h2>Related articles</h2>
				<?php
                        $catId = $result['cat'];
                        $rel_query = "SELECT * FROM tbl_post WHERE cat=$catId ORDER BY rand() LIMIT 6";
                        $rel_post = $db->select($rel_query); 
                        if ($rel_post) {
                        	while ($rel_result = $rel_post->fetch_assoc()) {
                ?>
                        <a href="post.php?id=<?php echo $rel_result['id']; ?>">
						    <img src="admin/<?php echo $rel_result['image']; ?>" alt="post image"/>
					    </a>
                <?php    		
                        	}
                        }else{
                        	echo "No Related Article Available...";
                        }
				?>
				</div>
	        </div>
	        <?php
	            
			        }
              }else{
              	header("Location: 404.php");
              }  
            ?>
        </div>
		<?php include "inc/sidebar.php"; ?>
	</div>

<?php include "inc/footer.php"; ?>