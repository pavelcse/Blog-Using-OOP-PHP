<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
        echo "<script>window.location = 'index.php'; </script>";
    }else{
        $pageid = $_GET['pageid'];
    }
?>

<style>
    .actiondel{margin-left: 10px;}
    .actiondel a{border: 1px solid #ddd; color: #444; cursor: pointer; font-size: 20px; padding: 2px 10px; background: #F0F0F0; font-weight: normal;}
</style>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Page</h2>
            <?php
                if ($_SERVER['REQUEST_METHOD']== 'POST') {
                $name = $fm->validation($_POST['name']);
                $body = $_POST['body'];

                $name = mysqli_real_escape_string($db->link, $name);
                $body = mysqli_real_escape_string($db->link, $body);


                if ($name == "" || $body == "") {
                     echo "<span class='error'>Error. Field Must Not Be Empty...!!!</span>";
                }else{
                   
                    $query = "UPDATE tbl_page SET name ='$name', body = '$body' WHERE id = '$pageid' ";
                    $updatePage = $db->update($query);
                    if ($updatePage) {
                        echo "<span class='success'>Page Updated Successfully.</span>";
                    }else {
                        echo "<span class='error'>Sorry, Page not Updated...!!!</span>";
                    }
                 }

                
                }
            ?>
                <div class="block"> 
                <?php
                    $query = "SELECT * FROM tbl_page WHERE id='$pageid'";
                    $getData = $db->select($query);
                    if ($getData) {
                       while ($data = $getData->fetch_assoc()) {
                ?>              
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $data['name']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $data['body']; ?></textarea>
                            </td>
                        </tr>
                       
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update Page" />
                                <span class="actiondel"><a onclick = "return confirm('Are You Sure to Delete?')" href="delpage.php?delid=<?php echo $data['id']; ?>">Delete</a></span>
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php           
                       }
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