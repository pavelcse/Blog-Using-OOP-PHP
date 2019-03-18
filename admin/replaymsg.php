<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
        echo "<script>window.location = 'inbox.php'; </script>";
    }else{
        $msgid = $_GET['msgid'];
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD']== 'POST'){
/*        $to         = $fm->validation($_POST['to']);
        $from       = $fm->validation($_POST['from']);
        $subject    = $fm->validation($_POST['subject']);
        $message    = $fm->validation($_POST['message']);*/

        $to         = $fm->mysqli_real_escape_string($_POST['to']);
        $from       = $fm->mysqli_real_escape_string($_POST['from']);
        $subject    = $fm->mysqli_real_escape_string($_POST['subject']);
        $message    = $fm->mysqli_real_escape_string($_POST['message']);


        $sendEmail = mail($to, $subject, $message, $from);
        if ($sendEmail) {
            echo "<span class='success'>Message Sent Successfully.</span>";
        }else{
            echo "<span class='error'>Sorry, Message not Sent...!!!</span>";
        }
    }


?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Message</h2>

                <div class="block">               
                 <form action="" method="post">
                    <table class="form">
                <?php 
                    $query = "SELECT * FROM tbl_contact WHERE id='$msgid'";
                    $msg = $db->select($query); 
                    if ($msg) {
                        while ($result = $msg->fetch_assoc()) {       
                ?>
                       
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" readonly name="to" value="<?php echo $result['email']; ?> " class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text"  name="from" placeholder="Please enter your email here"  class="medium" />

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text"  name="subject" placeholder="Please enter subject here"  class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="message"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
                            </td>
                        </tr>
                    <?php 
                            }
                        }
                    ?>
                    </table>
                    </form>
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