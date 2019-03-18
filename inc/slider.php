<div class="slidersection templete clear">
        <div id="slider">
        	<?php
                $query = "SELECT * FROM tbl_slider ORDER BY id DESC LIMIT 5";
                $getData = $db->select($query);
                if ($getData) {
                    while ($result = $getData->fetch_assoc()) {
            ?>
            <a href="#"><img width="960px" height="280px" src="admin/<?php echo $result['slider']; ?>" alt="Slider 1" title="<?php echo $result['title']; ?>" /></a>
            <?php
                    }
                }
            ?>
        </div>
</div>