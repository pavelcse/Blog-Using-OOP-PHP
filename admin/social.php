<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

<?php
        if ($_SERVER['REQUEST_METHOD']== 'POST') {
            $fb = $fm->validation($_POST['fb']);
            $tw = $fm->validation($_POST['tw']);
            $ln = $fm->validation($_POST['ln']);
            $gp = $fm->validation($_POST['gp']);

            $fb = mysqli_real_escape_string($db->link, $fb);
            $tw = mysqli_real_escape_string($db->link, $tw);
            $ln = mysqli_real_escape_string($db->link, $ln);
            $gp = mysqli_real_escape_string($db->link, $gp);

            if ($fb == "" || $tw == "" || $ln == "" || $gp == "") {
                echo "<span class='error'>Error. Field Must Not Be Empty...!!!</span>";
            }else{
                    $query = "UPDATE tbl_social SET
                            fb   ='$fb', 
                            tw    ='$tw', 
                            ln    ='$ln', 
                            gp    ='$gp' 
                            WHERE id = '1'";
                    $update_row = $db->update($query);
                    if ($update_row) {
                        echo "<span class='success'>Data Updated Successfully.</span>";
                    }else {
                        echo "<span class='error'>Sorry, Data not Updated...!!!</span>";
                    }
                }
        }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block">

            
                <?php
                    $query = "SELECT * FROM tbl_social WHERE id='1'";
                    $getData = $db->select($query);
                    if ($getData) {
                       while ($data = $getData->fetch_assoc()) {
                ?>              
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $data['fb']; ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?php echo $data['tw']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?php echo $data['ln']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp" value="<?php echo $data['gp']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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
<?php
    include 'inc/footer.php';
?>
