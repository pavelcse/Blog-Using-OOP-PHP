<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
            <?php
                if ($_SERVER['REQUEST_METHOD']== 'POST') {
                $title          = $fm->validation($_POST['title']);
                $cat            = $fm->validation($_POST['cat']);
                $body           = $_POST['body'];
                $author         = $fm->validation($_POST['author']);
                $tag            = $fm->validation($_POST['tag']);
                $desctiption    = $fm->validation($_POST['desctiption']);
                $userid         = $fm->validation($_POST['userid']);
                

                $title          = mysqli_real_escape_string($db->link, $title);
                $cat            = mysqli_real_escape_string($db->link, $cat);
                $body           = mysqli_real_escape_string($db->link, $body);
                $author         = mysqli_real_escape_string($db->link, $author);
                $tag            = mysqli_real_escape_string($db->link, $tag);
                $desctiption    = mysqli_real_escape_string($db->link, $desctiption);
                $userid         = mysqli_real_escape_string($db->link, $userid);

                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "uploads/".$unique_image;


                if ($title == "" || $cat == "" || $body == "" || $author == "" || $tag == "" || $desctiption == "" || $file_name == "") {
                     echo "<span class='error'>Error. Field Must Not Be Empty...!!!</span>";
                } elseif ($file_size >1048567) {
                    echo "<span class='error'>Image Size should be less then 1MB!</span>";
                } elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                } else{
                    move_uploaded_file($file_temp, $uploaded_image);

                    $query = "INSERT INTO tbl_post(cat, title, body, image, author, tag, desctiption, userid) VALUES('$cat', '$title', '$body', '$uploaded_image', '$author', '$tag', '$desctiption', '$userid')";
                    $inserted_rows = $db->insert($query);
                    if ($inserted_rows) {
                        echo "<span class='success'>Post Submited Successfully.</span>";
                    }else {
                        echo "<span class='error'>Sorry, Post not Submited...!!!</span>";
                    }
                 }

                
                }
            ?>
                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
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

                                    <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                <?php
                                        }
                                    }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo Session::get('username'); ?>" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo Session::get('userid'); ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tag</label>
                            </td>
                            <td>
                                <input type="text" name="tag" placeholder="Enter Tags here..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Description</label>
                            </td>
                            <td>
                                <input type="text" name="desctiption" placeholder="Enter desctiption here..." class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Post" />
                            </td>
                        </tr>
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