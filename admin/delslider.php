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
    if (!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL) {
        echo "<script>window.location = 'sliderlist.php'; </script>";
    }else{
        $sliderid = $_GET['sliderid'];

        $query = "SELECT * FROM tbl_slider WHERE id='$sliderid'";
        $getData = $db->select($query);
        if ($getData) {
        	while ($delImg = $getData->fetch_assoc()) {
        		$delImg  = $delImg['slider'];
        		unlink($delImg);
        	}
        }

        $delQuery = "DELETE FROM tbl_slider WHERE id='$sliderid'";
        $delData = $db->delete($delQuery);
        if ($delData) {
        	echo "<script>alert('Data Delete Successfully..');</script>";
        	echo "<script>window.location = 'sliderlist.php'; </script>";

        }else{
        	echo "<script>alert('Error, Data Not Delete..');</script>";
        	echo "<script>window.location = 'sliderlist.php'; </script>";
        }
    }
?>