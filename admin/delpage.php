<?php 
    include "../lib/Session.php"; 
    Session::checkSession();
?>
<?php include "../config/config.php"; ?>
<?php include "../lib/Database.php"; ?>

<?php 
    $db = new Database();  
?>
<?php
    if (!isset($_GET['delid']) || $_GET['delid'] == NULL) {
        echo "<script>window.location = 'index.php'; </script>";
    }else{
        $delid = $_GET['delid'];

        $delQuery = "DELETE FROM tbl_page WHERE id='$delid'";
        $delData = $db->delete($delQuery);
        if ($delData) {
        	echo "<script>alert('Page Deleted Successfully..');</script>";
        	echo "<script>window.location = 'index.php'; </script>";

        }else{
        	echo "<script>alert('Error, Page Not Delete..');</script>";
        	echo "<script>window.location = 'index.php'; </script>";
        }
    }
?>