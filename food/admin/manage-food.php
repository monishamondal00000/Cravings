<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>

        <!-- Button to add food -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br><br>

        <!-- Session Messages -->
        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add']; // Display add message
                unset($_SESSION['add']); // Remove session message
            }

            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete']; // Display delete message
                unset($_SESSION['delete']); // Remove session message
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload']; // Display upload message
                unset($_SESSION['upload']); // Remove session message
            }

            if (isset($_SESSION['unauthorize'])) {
                echo $_SESSION['unauthorize']; // Display unauthorized message
                unset($_SESSION['unauthorize']); // Remove session message
            }

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update']; // Display update message
                unset($_SESSION['update']); // Remove session message
            }
        ?>
        
        <!-- Table to display food -->
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                // Query to get all food items
                $sql = "SELECT * FROM tbl_food";
                $res = mysqli_query($conn, $sql);

                // Count rows to check if we have foods in the database
                $count = mysqli_num_rows($res);
                $sn = 1; // Create a serial number variable

                if ($count > 0) {
                    // We have food in the database
                    while ($row = mysqli_fetch_assoc($res)) {
                        // Get the values from the individual columns
                        $id = $row['id'];
                        $title = htmlspecialchars($row['title']);
                        $price = htmlspecialchars($row['price']);
                        $image_name = htmlspecialchars($row['image_name']);
                        $featured = htmlspecialchars($row['featured']);
                        $active = htmlspecialchars($row['active']);
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                                <?php 
                                    if ($image_name == "") {
                                        echo "<div class='error'>Image Not Added.</div>";
                                    } else {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                        <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Food</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    // No food found
                    echo "<tr><td colspan='7' class='error'>Food Not Added Yet.</td></tr>";
                }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
