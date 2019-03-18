<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location = 'catlist.php'; </script>";
        //header('Location: catlist.php');
    }else{
        $catid = $_GET['catid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 

        <?php
            if ($_SERVER['REQUEST_METHOD']== 'POST') {
                $name = $fm->validation($_POST['name']);
                $name = mysqli_real_escape_string($db->link, $name);

                if (empty($name)) {
                   echo "<span class='error'>Something Wrong...!!!</span>";
                }else{
                    $query = "UPDATE tbl_category SET name ='$name' WHERE id = '$catid' ";
                    $catinsert = $db->update($query);
                    if ($catinsert) {
                        echo "<span class='success'>Category Updated Successfully...</span>";
                    }else{
                         echo "<span class='error'>Failed to Update Category...!!!</span>";
                    }
                }
            }
        ?>
        <?php
            $query = "SELECT * FROM tbl_category WHERE id='$catid' ORDER BY id DESC";
            $cat = $db->select($query);
            while ($result = $cat->fetch_assoc()) {
        ?>
                    <form action="" method="post"> 
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['name']; ?>" class="medium" name="name" required="" />
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