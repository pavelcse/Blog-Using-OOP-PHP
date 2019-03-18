<?php
        if (isset($_GET['pageid'])) {
        	$titleid = $_GET['pageid'];
        	$query = "SELECT * FROM tbl_page WHERE id='$titleid'";
            $getData = $db->select($query);
            if ($getData) {
                while ($data = $getData->fetch_assoc()) {

	?>
    <title><?php echo $data['name']; ?> - <?php echo TITLE; ?></title>

	<?php
	            }   
		    }
        }
        elseif (isset($_GET['id'])) {
        	$postid = $_GET['id'];
        	$query = "SELECT * FROM tbl_post WHERE id='$postid'";
            $getData = $db->select($query);
            if ($getData) {
                while ($data = $getData->fetch_assoc()) {

	?>
    <title><?php echo $data['title']; ?> - <?php echo TITLE; ?></title>

	<?php
	            }   
		    }
        }

        elseif (isset($_GET['category'])) {
        	$categoryid = $_GET['category'];
        	$query = "SELECT * FROM tbl_category WHERE id='$categoryid'";
            $getData = $db->select($query);
            if ($getData) {
                while ($data = $getData->fetch_assoc()) {

	?>
    <title><?php echo $data['name']; ?> - <?php echo TITLE; ?></title>

	<?php
	            }   
		    }
        }

        else{
    ?>
    <title><?php echo $fm->title(); ?> - <?php echo TITLE; ?></title>
    <?php
    }  
    ?>
	
	<meta name="language" content="English">
 <!-- Meta Description -->
    <?php
        if (isset($_GET['id'])) {
            $desid = $_GET['id'];
            $query = "SELECT * FROM tbl_post WHERE id='$desid'";
            $desctiption = $db->select($query);
            if ($desctiption) {
                while ($result = $desctiption->fetch_assoc()) {
    ?>
    <meta name="description" content="<?php echo $result['desctiption']; ?>">
    <?php
                }
            }
        }else{
    ?>
    <meta name="description" content="<?php echo DESCRIPTION; ?>">
    <?php
            }
    ?>

<!-- Meta Keywords -->
    <?php
        if (isset($_GET['id'])) {
            $keyid = $_GET['id'];
            $query = "SELECT * FROM tbl_post WHERE id='$keyid'";
            $keyword = $db->select($query);
            if ($keyword) {
                while ($result = $keyword->fetch_assoc()) {
    ?>
    <meta name="keywords" content="<?php echo $result['tag']; ?>">
    <?php
                }
            }
        }else{
    ?>
    <meta name="keywords" content="<?php echo KEYWORD; ?>">
    <?php
            }
    ?>
	<meta name="author" content="Pavel">