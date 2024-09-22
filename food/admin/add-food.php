<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of food" required>
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of food" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" step="0.01" required>
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" required>
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" required>
                            <?php
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                if ($count > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $id = $row['id'];
                                        $title = htmlspecialchars($row['title']);
                                        echo "<option value='$id'>$title</option>";
                                    }
                                } else {
                                    echo "<option value='0'>No Category Found</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if (isset($_POST['submit'])) {
                $title = htmlspecialchars($_POST['title']);
                $description = htmlspecialchars($_POST['description']);
                $price = $_POST['price'];
                $category = $_POST['category'];

                $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
                $active = isset($_POST['active']) ? $_POST['active'] : "No";

                // Handle file upload
                if (isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];

                    if ($image_name != "") {
                        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
                        $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

                        // Check if the uploaded file is of allowed type
                        if (in_array($ext, $allowed_ext)) {
                            if ($_FILES['image']['size'] <= 5242880) {
                                $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;
                                $src = $_FILES['image']['tmp_name'];
                                $dst = "../images/food/" . $image_name;

                                if (move_uploaded_file($src, $dst)) {
                                    $image_uploaded = true;
                                } else {
                                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                                    header('location: ' . SITEURL . 'admin/add-food.php');
                                    exit();
                                }
                            } else {
                                $_SESSION['upload'] = "<div class='error'>File size too large. Maximum allowed size is 5MB.</div>";
                                header('location: ' . SITEURL . 'admin/add-food.php');
                                exit();
                            }
                        } else {
                            $_SESSION['upload'] = "<div class='error'>Invalid file type. Only JPG, JPEG, PNG, and GIF allowed.</div>";
                            header('location: ' . SITEURL . 'admin/add-food.php');
                            exit();
                        }
                    }
                } else {
                    $image_name = "";
                }

                $sql2 = "INSERT INTO tbl_food (title, description, price, image_name, category, featured, active) 
                         VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql2);
                mysqli_stmt_bind_param($stmt, 'ssdssss', $title, $description, $price, $image_name, $category, $featured, $active);

                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location: ' . SITEURL . 'admin/manage-food.php');
                } else {
                    $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                    header('location: ' . SITEURL . 'admin/manage-food.php');
                }
                mysqli_stmt_close($stmt);
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
