<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 

        <?php
            if ($_SERVER['REQUEST_METHOD']== 'POST') {
                $name = $fm->validation($_POST['name']);
                $name = mysqli_real_escape_string($db->link, $name);

                if (empty($name)) {
                   echo "<span class='error'>Something Wrong...!!!</span>";
                }else{
                    $query = "INSERT INTO tbl_category(name) VALUES('$name')";
                    $catinsert = $db->insert($query);
                    if ($catinsert) {
                        echo "<span class='success'>Category Inserted Successfully...</span>";
                    }else{
                         echo "<span class='error'>Failed to Insert Category...!!!</span>";
                    }
                }
            }
        ?>
                 <form action="" method="post"> 
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." class="medium" name="name" required="" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Add" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php
    include 'inc/footer.php';
?>