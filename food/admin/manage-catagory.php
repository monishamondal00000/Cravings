<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>


        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
        ?>

        <br><br>

        <a href="<?php echo SITEURL;?>admin/add-catagory.php" class="btn-primary">Add Catagory</a>
        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php

            $sql = "SELECT * FROM tbl_catagory";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn=1;

            if($count>0)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php 
                                if($image_name!="")
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?> images/catagory<?php echo $image_name; ?>" width="100px">
                                    <?php
                                }
                                else
                                {
                                    echo "<div class='error'>Image not Added.</div>";
                                }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="#" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-catagory.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Catagory </a>
                        </td>
                    </tr>

                    <?php
                }
            }
            else
            {
                ?>
                <tr>
                    <td colspan="6"><div class="error">No Catagory Added.</div></td>
                </tr>
                <?php
            }

            ?>
            
    </div>

</div>
<?php include('partials/footer.php')?>