<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

<?php
        if ($_SERVER['REQUEST_METHOD']== 'POST') {
            $copyright = $fm->validation($_POST['note']);
            $copyright = mysqli_real_escape_string($db->link, $copyright);

            if ($copyright == "") {
                echo "<span class='error'>Error. Field Must Not Be Empty...!!!</span>";
            }else{
                    $query = "UPDATE tbl_footer SET
                            note   ='$copyright' 
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
                <h2>Update Copyright Text</h2>
                <div class="block copyblock">
            <?php
                $query = "SELECT * FROM tbl_footer WHERE id='1'";
                $getData = $db->select($query);
                if ($getData) {
                    while ($data = $getData->fetch_assoc()) {
            ?> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $data['note']; ?>" name="note" class="large" />
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
                }
            ?>
                </div>
            </div>
<?php
    include 'inc/footer.php';
?>
