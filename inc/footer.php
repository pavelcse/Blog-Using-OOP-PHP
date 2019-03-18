<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
        <?php
            $query = "SELECT * FROM tbl_footer WHERE id='1'";
            $getData = $db->select($query);
            if ($getData) {
                while ($data = $getData->fetch_assoc()) {
        ?>
	  <p>&copy; <?php echo $data['note']; ?> <?php echo date('Y'); ?> </p>
	  <?php           
                }
            }
        ?>

	</div>
	<div class="fixedicon clear">
		<?php
            $query = "SELECT * FROM tbl_social WHERE id='1'";
            $getData = $db->select($query);
            if ($getData) {
                while ($data = $getData->fetch_assoc()) {
        ?>
		<a href="<?php echo $data['fb']; ?>"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $data['tw']; ?>"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $data['ln']; ?>"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $data['gp']; ?>"><img src="images/gl.png" alt="GooglePlus"/></a>
		<?php           
                }
            }
        ?>
	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
<script id="dsq-count-scr" src="//techbd-1.disqus.com/count.js" async></script>
</body>
</html>