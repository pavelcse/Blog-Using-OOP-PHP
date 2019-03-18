<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['userid']) || $_GET['userid'] == NULL) {
        echo "<script>window.location = 'userlist.php'; </script>";
        //header('Location: catlist.php');
    }else{
        $userid = $_GET['userid'];
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD']== 'POST') {
        echo "<script>window.location = 'userlist.php'; </script>";
    }
?>
        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>View Profile</h2>
                <div class="block">
                <?php
                    $query = "SELECT * FROM tbl_user WHERE id='$userid' ORDER BY id DESC";
                    $user = $db->select($query);
                    while ($user_result = $user->fetch_assoc()) {
                     ?>

                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input readonly type="text" name="name" value="<?php echo $user_result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>UserName</label>
                            </td>
                            <td>
                                <input readonly type="text" name="username" value="<?php echo $user_result['username']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input readonly type="text" name="email" value="<?php echo $user_result['email']; ?>" class="medium" />
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
                                <input type="submit" name="submit" Value="Back to List" />
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