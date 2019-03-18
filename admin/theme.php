<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Theme</h2>
               <div class="block copyblock"> 

        <?php
            if ($_SERVER['REQUEST_METHOD']== 'POST') {
                $theme = $_POST['theme'];

                    $query = "UPDATE tbl_theme SET theme ='$theme' WHERE id = 1 ";
                    $update = $db->update($query);
                    if ($update) {
                        echo "<span class='success'>Theme Changed Successfully...</span>";
                    }else{
                         echo "<span class='error'>Failed to Change Theme...!!!</span>";
                    }
            }
        ?>
        <?php
            $query = "SELECT * FROM tbl_theme WHERE id= 1 ORDER BY id DESC";
            $theme = $db->select($query);
            while ($result = $theme->fetch_assoc()) {
        ?>
                    <form action="" method="post"> 
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="radio" <?php if($result['theme']=='default'){echo "Checked";}?> name="theme" value="default">Default
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" <?php if($result['theme']=='blue'){echo "Checked";}?> name="theme" value="blue">Blue
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" <?php if($result['theme']=='green'){echo "Checked";}?> name="theme" value="green">Green
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" <?php if($result['theme']=='white'){echo "Checked";}?> name="theme" value="white">White
                                </td>
                            </tr>
						    <tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
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
<?php
    include 'inc/footer.php';
?>