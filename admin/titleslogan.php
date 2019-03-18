<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
    <style>
        .left_side{float: left;width: 80%}
        .right_side{float: left;width: 20%}
        .right_side img{height: 160px;width: 160px;}
    </style>

    <?php
        if ($_SERVER['REQUEST_METHOD']== 'POST') {
            $title = $fm->validation($_POST['title']);
            $slogan = $fm->validation($_POST['slogan']);

                    

            $title = mysqli_real_escape_string($db->link, $title);
            $slogan = mysqli_real_escape_string($db->link, $slogan);
 

            $permited  = array('png');
            $file_name = $_FILES['logo']['name'];
            $file_size = $_FILES['logo']['size'];
            $file_temp = $_FILES['logo']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $image = 'logo'.'.'.$file_ext;
            $uploaded_image = "uploads/".$image;


            if ($title == "" || $slogan == "") {
                echo "<span class='error'>Error. Field Must Not Be Empty...!!!</span>";
            }else{
                if (!empty($file_name)) {
                        
                    if ($file_size >1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB!</span>";
                    } elseif (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                    } else{
                        move_uploaded_file($file_temp, $uploaded_image);

                        $query = "UPDATE tbl_title_slogan SET
                                title   ='$title', 
                                slogan    ='$slogan', 
                                logo   ='$uploaded_image'  
                                WHERE id = '1'";
                        $update_row = $db->update($query);
                        if ($update_row) {
                            echo "<span class='success'>Data Updated Successfully.</span>";
                        }else {
                            echo "<span class='error'>Sorry, Data not Updated...!!!</span>";
                        }
                    }
                }else{
                        $query = "UPDATE tbl_title_slogan SET
                                title   ='$title', 
                                slogan    ='$slogan' 
                                WHERE id = '1'";
                        $update_row = $db->update($query);
                        if ($update_row) {
                            echo "<span class='success'>Data Updated Successfully.</span>";
                        }else {
                            echo "<span class='error'>Sorry, Data not Updated...!!!</span>";
                        }
                }
            }
        }
    ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <div class="block sloginblock">  
                <?php
                    $query = "SELECT * FROM tbl_title_slogan WHERE id='1'";
                    $getData = $db->select($query);
                    if ($getData) {
                       while ($data = $getData->fetch_assoc()) {
                ?>


                 <div class="left_side">
                    <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">                    
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $data['title'];?>"  name="title" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $data['slogan'];?>" name="slogan" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Website Logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo" />
                            </td>
                        </tr>
                         
                        
                         <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                 </div>
                 <div class="right_side">
                     <img src="<?php echo $data['logo'];?>" alt="Logo">
                 </div>
            <?php           
                       }
                    }
                ?> 
                </div>
            </div>
        </div>
<?php
    include 'inc/footer.php';
?>