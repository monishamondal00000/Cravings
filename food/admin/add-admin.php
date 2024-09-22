<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['add']))//Checking whether session is not set
            {
                echo $_SESSION['add'];//Display the Session Message page 
                unset($_SESSION['add']);//Remove session message
            }
        ?>
        <form action="add-admin.php" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your username">
                    </td>
                </tr>
                <tr>
                    <td>
                        password:
                    </td>
                    <td>
                        <input type="password" name="password" placeholder="password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit"  value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    // process the value from form and save it in database
    // check wheather the submit button is clicked or not
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
       //Burron clicked 
       //get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encrypted

        // sql to save data in database
        $sql = "INSERT INTO `tbl_admin`(`full_name`, `username`, `password`) VALUES ('$full_name',' $username',' $password')";
        
         $res = mysqli_query($conn,$sql);
         if($res){
            // Data Inserted
            // echo "Admin Added Successfully";
            // Create a session variable to Display Message
            $_SESSION['add'] = "Admin added successfully";
            // Redirect page to manage admin
            header("Location: ./manage-admin.php");
         }
         else{
            // Failed to Insert
            // echo "Error in adding admin";
            // Create a session variable to Display Message
            $_SESSION['add'] = "Failed";
            // Redirect page to add admin
            header("Location: ./manage-admin.php");
         }
    }
?>