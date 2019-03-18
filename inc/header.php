<?php include "config/config.php"; ?>
<?php include "lib/Database.php"; ?>
<?php include "helpers/Format.php"; ?>
<?php 
    $db = new Database();  
    $fm = new Format(); 
?>
<?php
// Cash Controll
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000"); 
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "script/meta.php";?>
    <?php include "script/css.php";?>
    <?php include "script/js.php";?>
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">
				<?php
                    $query = "SELECT * FROM tbl_title_slogan WHERE id='1'";
                    $getData = $db->select($query);
                    if ($getData) {
                       while ($data = $getData->fetch_assoc()) {
                ?>
				<img src="admin/<?php echo $data['logo']; ?>" alt="Logo"/>
				<h2><?php echo $data['title']; ?></h2>
				<p><?php echo $data['slogan']; ?></p>
				<?php           
                       }
                    }
                ?> 
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<?php
                    $query = "SELECT * FROM tbl_social WHERE id='1'";
                    $getData = $db->select($query);
                    if ($getData) {
                       while ($data = $getData->fetch_assoc()) {
                ?>
				<a href="<?php echo $data['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $data['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $data['ln']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $data['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				<?php           
                       }
                    }
                ?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<?php
        $path = $_SERVER['SCRIPT_FILENAME'];
        $currentpage = basename($path, '.php');
	?>
	<ul>
		<li><a  
            <?php 
                if ($currentpage == 'index') {
                	echo 'id="active"';
                }
            ?>
			href="index.php">Home</a></li>
		<?php 
            $cat_query = "SELECT * FROM tbl_page";
            $page = $db->select($cat_query); 
            if ($page ) {
            	while ($data = $page->fetch_assoc()) {           	
        ?>
        <li>
        	<a 
            <?php 
                if (isset($_GET['pageid']) && $_GET['pageid'] == $data['id']) {
                    echo 'id="active"';
                }
            ?>
        	href="page.php?pageid=<?php echo $data['id'];?>">
        		<?php echo $data['name']; ?>
        	</a>
        </li>
        <?php 
                }
            }
        ?>	
		<li><a 
            <?php 
                if ($currentpage == 'contact') {
                	echo 'id="active"';
                }
            ?>
			href="contact.php">Contact</a></li>
	</ul>
</div>