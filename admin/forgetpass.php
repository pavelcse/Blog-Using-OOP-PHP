<?php 
    include "../lib/Session.php"; 
    Session::init();
    Session::checkLogin();
?>
<?php include "../config/config.php"; ?>
<?php include "../lib/Database.php"; ?>
<?php include "../helpers/Format.php"; ?>

<?php 
    $db = new Database();  
    $fm = new Format(); 
?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
            if ($_SERVER['REQUEST_METHOD']== 'POST') {
            	$email = $fm->validation($_POST['email']);
                $email = mysqli_real_escape_string($db->link, $email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<span style='color:red; font-size:18px;'>Invalid Email Address !!!</span>";
                }else{
            	    $query = "SELECT * FROM tbl_user WHERE email='$email' LIMIT 1";
            	    $result = $db->select($query);
            	    if ($result != false) {
            		    while ($value = $result->fetch_assoc()) {
                            $userId = $value['id'];
                            $userName = $value['username'];
                        }
                        $text       = substr($email, 0, 3);
                        $rand       = rand(10000, 99999);
                        $newpass    = "$text$rand";
                        $password   = md5($newpass);

                        $updateQue  = " UPDATE tbl_user
                                        SET
                                        password = '$password'
                                        WHERE id = '$userId'
                                        ";
                        $update_row = $db->update($updateQue);

                        $to = "$email";
                        $from = "pavel@gmail.com";
                        $headers = "From: $from\n";
                        $headers .= 'MIME-Version: 1.0'."\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                        $subject = "New Generated Password";
                        $message = "Your Username is: ".$username." and Password is: ".$newpass."<br/>Please go to admin panel to login.";
                        $sendEmail = mail($to, $subject, $message, $headers);
                        if ($sendEmail) {
                            echo "<span style='color:green; font-size:18px;'>An Auto Generated Password has been send in your email address. Please check your email.</span>";
                        }
                        else{
                             echo "<span style='color:red; font-size:18px;'>Sonething Wrong. Please try again leter...!!</span>";
                        }
            		    
            	    }else{
            		    echo "<span style='color:red; font-size:18px;'>Email Dosn't Match...!!</span>";
            	    }
                }
            }
		?>
		<form action="" method="post">
			<h1>Recover Password</h1>
			<div>
				<input type="text" placeholder="Email" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Recover" />
			</div>
		</form><!-- form -->
        <div class="button">
            <a href="login.php">Login</a>
        </div><!-- button -->
		<div class="button">
			<a href="#">Pavel Parvej</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>