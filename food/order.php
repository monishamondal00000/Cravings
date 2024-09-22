<?php include('partials-front/menu.php'); ?>

<?php
    if (isset($_GET['food_id'])) {
        $food_id = $_GET['food_id'];
        $sql = "SELECT * FROM tbl_food WHERE id = '$food_id'"; // Make sure the table name is correct
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);

            $title = htmlspecialchars($row['title']);
            $price = htmlspecialchars($row['price']);
            $image_name = htmlspecialchars($row['image_name']);
        } else {
            header('location:' . SITEURL);
            exit; // Ensure no further code is executed after the redirect
        }
    } else {
        header('location:' . SITEURL);
        exit; // Ensure no further code is executed after the redirect
    }
?>

<!-- FOOD SEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order"> <!-- Added method POST -->
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php 
                        if ($image_name != "") {
                            echo "<img src='" . SITEURL . "images/food/" . $image_name . "' alt='$title' class='img-responsive img-curve'>";
                        } else {
                            echo "<div class='error'>Image not Available</div>";
                        }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    
                    <p class="food-price">$<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                    
                    <!-- Hidden fields to pass food title and price -->
                    <input type="hidden" name="food_title" value="<?php echo $title; ?>">
                    <input type="hidden" name="food_price" value="<?php echo $price; ?>">
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $order_date = date("Y-m-d h:i:sa");
                $status = "ordered";
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                $sql2 = "INSERT INTO tbl_order SET
                    food = $food,
                    price =$price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                ";
                $res2 = mysqli_query($conn, $sql2);
                if($res2==true)
                {
                    $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                    header('location:'.SITEURL.'index.php');
                }
                else
                {
                    $_SESSION['order'] = "<div class='error text-center'>Failed to order.</div>";
                    header('location:'.SITEURL.'index.php');
                }
            }
        ?>

    </div>
</section>
<!-- FOOD SEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
