<?php
    ob_start();
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php 

    if (Session::get('userrole') !== '3') {
        header('Location: index.php');
    }

?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 

        <?php
            if ($_SERVER['REQUEST_METHOD']== 'POST') {
                $username = $fm->validation($_POST['username']);
                $password = $fm->validation(md5($_POST['password']));
                $email = $fm->validation($_POST['email']);
                $role = $fm->validation($_POST['role']);

                $username = mysqli_real_escape_string($db->link, $username);
                $password = mysqli_real_escape_string($db->link, $password);
                $email = mysqli_real_escape_string($db->link, $email);
                $role = mysqli_real_escape_string($db->link, $role);

                if (empty($username) || empty($password) || empty($email) || empty($role)) {
                   echo "<span class='error'>Field Must Not be Empty..!!!</span>";
                }else{
                    $mailQuery = "SELECT * FROM tbl_user WHERE email= '$email' LIMIT  1";
                    $checkEmail = $db->select($mailQuery);
                    if ($checkEmail) {
                        echo "<span class='error'>Email Already Exist...!!!</span>";
                    }
                    else{
                        $query = "INSERT INTO tbl_user(username, password, email, role) VALUES('$username', '$password', '$email', '$role')";
                        $user = $db->insert($query);
                        if ($user) {
                            echo "<span class='success'>New User Added Successfully...</span>";
                        }else{
                            echo "<span class='error'>Failed to Added New User...!!!</span>";
                        }
                    }
                }
                
            }
        ?>
                 <form action="" method="post"> 
                    <table class="form">					
                        <tr>
                            <td>
                                <lebel>UserName</lebel>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter your UserName..." class="medium" name="username" required="1" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <lebel>Password</lebel>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter your password..." class="medium" name="password" required="1" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <lebel>Email</lebel>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter your email..." class="medium" name="email" required="1" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <lebel>Role</lebel>
                            </td>
                            <td>
                                <select name="role" id="select">
                                    <option value="0">Select User Role</option>
                                    <option value="1">Editor</option>
                                    <option value="2">Author</option>
                                    <option value="3">Admin</option>
                                </select>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Add User" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php
    include 'inc/footer.php';
?>