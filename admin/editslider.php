<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['editid']) || $_GET['editid'] == NULL) {
        echo "<script>window.location = 'sliderlist.php'; </script>";
    }else{
        $editid = $_GET['editid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Slider</h2>
            <?php
                if ($_SERVER['REQUEST_METHOD']== 'POST') {
                    $title          = $fm->validation($_POST['title']);              

                    $title          = mysqli_real_escape_string($db->link, $title);

                    $permited  = array('jpg', 'jpeg', 'png', 'gif');
                    $file_name = $_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $file_temp = $_FILES['image']['tmp_name'];

                    $div = explode('.', $file_name);
                    $file_ext = strtolower(end($div));
                    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                    $uploaded_image = "uploads/slider/".$unique_image;


                    if ($title == "" ) {
                        echo "<span class='error'>Error. Field Must Not Be Empty...!!!</span>";
                    }else{
                        if (!empty($file_name)) {
                        
                            if ($file_size >5242880) {
                                echo "<span class='error'>Image Size should be less then 5MB!</span>";
                            } elseif (in_array($file_ext, $permited) === false) {
                                echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                            } else{
                                move_uploaded_file($file_temp, $uploaded_image);

                                $query = "UPDATE tbl_slider SET  
                                title       ='$title',  
                                slider       ='$uploaded_image'  
                                WHERE id    = '$editid'";
                                $update_row = $db->update($query);
                                if ($update_row) {
                                    echo "<span class='success'>Slider Updated Successfully.</span>";
                                }else {
                                    echo "<span class='error'>Sorry, Slider not Updated...!!!</span>";
                                }
                            }
                        }else{
                                $query = "UPDATE tbl_slider SET 
                                title       ='$title'
                                WHERE id    = '$editid'";
                                $update_row = $db->update($query);
                                if ($update_row) {
                                    echo "<span class='success'>Slider Updated Successfully.</span>";
                                }else {
                                    echo "<span class='error'>Sorry, Slider not Updated...!!!</span>";
                                }
                        }
                    }
                }
            ?>
                <div class="block">
                <?php
                    $query = "SELECT * FROM tbl_slider WHERE id='$editid' ORDER BY id DESC";
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
                                <input type="text" name="title" value="<?php echo $post_result['title']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $post_result['slider']; ?>" height="150px" width="500px" alt=""><br>
                                <input type="file" name="image" />
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update Slider" />
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