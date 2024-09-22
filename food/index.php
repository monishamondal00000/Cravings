<?php include('partials-front/menu.php'); ?>

<!-- Food Search Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="post">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- Food Search Section Ends Here -->

<?php
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>

<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
            // Query to get featured and active categories
            $sql = "SELECT * FROM tbl_catagory WHERE active='Yes' AND featured='Yes' LIMIT 3"; 
            $res = mysqli_query($conn, $sql);

            // Check whether categories are available
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = htmlspecialchars($row['title']);
                    $image_name = htmlspecialchars($row['image_name']);
                    ?>
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                                if ($image_name == "") {
                                    echo "<div class='error'>Image not Available</div>";
                                } else {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo "<div class='error'>Category not Added.</div>";
            }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- Food Menu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        
        <?php
            // Fetch active food items from database
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' LIMIT 6"; // Adjust limit as needed
            $res2 = mysqli_query($conn, $sql2);

            // Check whether food items are available
            if (mysqli_num_rows($res2) > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id = $row2['id'];
                    $title = htmlspecialchars($row2['title']);
                    $price = htmlspecialchars($row2['price']);
                    $image_name = htmlspecialchars($row2['image_name']);
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                if ($image_name == "") {
                                    echo "<div class='error'>Image not Available</div>";
                                } else {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                Made with Italian Sauce, Chicken, and organic vegetables.
                            </p>
                            <br>
                            <a href="<?php echo SITEURL; ?> order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='error'>No Foods Available.</div>";
            }
        ?>

        <div class="clearfix"></div>

        <p class="text-center">
            <a href="all-foods.php">See All Foods</a>
        </p>
    </div>
</section>
<!-- Food Menu Section Ends Here -->

<!-- Social Section Starts Here -->
<?php include('partials-front/footer.php'); ?>
