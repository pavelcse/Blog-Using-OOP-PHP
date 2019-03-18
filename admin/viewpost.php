<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['viewid']) || $_GET['viewid'] == NULL) {
        echo "<script>window.location = 'postlist.php'; </script>";
    }else{
        $viewid = $_GET['viewid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Post</h2>
                <div class="block">
                <?php
                    $query = "SELECT * FROM tbl_post WHERE id='$viewid' ORDER BY id DESC";
                    $edit = $db->select($query);
                    while ($post_result = $edit->fetch_assoc()) {
                     ?>

                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $post_result['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option>Select Category</option>
                                <?php
                                    $query = "SELECT * FROM tbl_category";
                                    $cat = $db->select($query);
                                    if ($cat) {
                                        while ($result = $cat->fetch_assoc()) {
                                ?>

                                    <option 
                                <?php
                                    if ($post_result['cat'] == $result['id']) {
                                        echo "selected='selected'";
                                    }
                                ?>
                                    value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                <?php
                                        }
                                    }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $post_result['image']; ?>" height="80px" width="150px" alt=""><br>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body" >
                                   <?php echo $post_result['body'];?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $post_result['author']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tag</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $post_result['tag']; ?>" class="medium" />
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <label>Desctiption</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $post_result['desctiption']; ?>" class="medium" />
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