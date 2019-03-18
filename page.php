<?php include "inc/header.php"; ?>
<?php
    $pageid = mysqli_real_escape_string($db->link, $_GET['pageid']);
    if (!isset($pageid) || $pageid == NULL) {
       header('Location: 404.php');
    }else{
        $pageid = $pageid;
    }
?>
<?php
    $query = "SELECT * FROM tbl_page WHERE id='$pageid'";
    $getData = $db->select($query);
    if ($getData) {
        while ($data = $getData->fetch_assoc()) {
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $data['name']; ?></h2>
	            <?php echo $data['body']; ?>
	        </div>

		</div>
		<?php include "inc/sidebar.php"; ?>
	</div>
<?php
	            
		}
    }else{
        header("Location: 404.php");
    }  
?>

<?php include "inc/footer.php"; ?>