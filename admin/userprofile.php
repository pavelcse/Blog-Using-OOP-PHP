<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    $userid = Session::get('userid');
    $userrole = Session::get('userrole');
?>
        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Update Post</h2>
            <?php
                if ($_SERVER['REQUEST_METHOD']== 'POST') {
                    $name = $fm->validation($_POST['name']);
                    $username = $fm->validation($_POST['username']);
                    //$password = $fm->validation(md5($_POST['password']));
                    $email = $fm->validation($_POST['email']);
                    $details = $_POST['details'];


                    $name = mysqli_real_escape_string($db->link, $name);
                    $username = mysqli_real_escape_string($db->link, $username);
                    //$password = mysqli_real_escape_string($db->link, $password);
                    $email = mysqli_real_escape_string($db->link, $email);
                    $details = mysqli_real_escape_string($db->link, $details);


                    if ($name == "" || $username == "" || $email == "" || $details == "") {
                        echo "<span class='error'>Error. Field Must Not Be Empty...!!!</span>";
                    }else{

                                $query = "UPDATE tbl_user SET 
                                name        ='$name', 
                                username    ='$username', 
                                email       ='$email', 
                                details     ='$details' 
                                WHERE id    = '$userid'";
                                $update_row = $db->update($query);
                                if ($update_row) {
                                    echo "<span class='success'>Post Updated Successfully.</span>";
                                }else {
                                    echo "<span class='error'>Sorry, Post not Updated...!!!</span>";
                                }
                            }
                        }
            ?>
                <div class="block">
                <?php
                    $query = "SELECT * FROM tbl_user WHERE id='$userid' AND role='$userrole' ORDER BY id DESC";
                    $userid = $db->select($query);
                    while ($user_result = $userid->fetch_assoc()) {
                     ?>

                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $user_result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>UserName</label>
                            </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $user_result['username']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $user_result['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details"><?php echo $user_result['details']; ?></textarea>
                            </td>
                        </tr> 
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update Profile" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php
                    }
                ?> 
                </div>
            </div>
        </div>

    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>

<?php
    include 'inc/footer.php';
?>