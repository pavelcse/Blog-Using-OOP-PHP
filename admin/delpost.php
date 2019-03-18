<?php 
    include "../lib/Session.php"; 
    Session::checkSession();
?>
<?php include "../config/config.php"; ?>
<?php include "../lib/Database.php"; ?>
<?php include "../helpers/Format.php"; ?>

<?php 
    $db = new Database();  
?>
<?php
    if (!isset($_GET['deleteid']) || $_GET['deleteid'] == NULL) {
        echo "<script>window.location = 'postlist.php'; </script>";
    }else{
        $deleteid = $_GET['deleteid'];

        $query = "SELECT * FROM tbl_post WHERE id='$deleteid'";
        $getData = $db->select($query);
        if ($getData) {
        	while ($delImg = $getData->fetch_assoc()) {
        		$delImg  = $delImg['image'];
        		unlink($delImg);
        	}
        }

        $delQuery = "DELETE FROM tbl_post WHERE id='$deleteid'";
        $delData = $db->delete($delQuery);
        if ($delData) {
        	echo "<script>alert('Data Delete Successfully..');</script>";
        	echo "<script>window.location = 'postlist.php'; </script>";

        }else{
        	echo "<script>alert('Error, Data Not Delete..');</script>";
        	echo "<script>window.location = 'postlist.php'; </script>";
        }
    }
?>