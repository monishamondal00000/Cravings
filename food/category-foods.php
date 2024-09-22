<?php include('partials-front/menu.php'); ?>

<?php
    // Check if category_id is passed
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];
        
        // Get the Category Title based on Category ID
        $sql = "SELECT title FROM tbl_catagory WHERE id=$category_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        
        $category_title = $row['title'];
    }
    else
    {
        // If no category is passed, redirect to homepage
        header('location:'.SITEURL);
    }
?>

<!-- FOOD SEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
    </div>
</section>
<!-- FOOD SEARCH Section Ends Here -->

<!-- FOOD MENU Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
            // Get foods based on selected category
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id AND active='Yes'";
            $res2 = mysqli_query($conn, $sql2);
            $count = mysqli_num_rows($res2);

            if($count > 0)
            {
                // Foods available
                while($row2 = mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>
                    
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                // Check if the image is available
                                if($image_name == "")
                                {
                                    echo "<div class='error'>Image not available.</div>";
                                }
                                else
                                {
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
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?> order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                // Food not available
                echo "<div class='error'>Food not available in this category.</div>";
            }
        ?>

        <div class="clearfix"></div>

    </div>
</section>
<!-- FOOD MENU Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
