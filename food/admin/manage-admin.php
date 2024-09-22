<?php include('partials/menu.php')?>

        <!-- main -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br>
            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];//Display Session Message
                    unset($_SESSION['add']);//Remove Session Message
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);

                }
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
                if(isset($_SESSION['wrong-password']))
                {
                    echo $_SESSION['wrong-password'];
                    unset($_SESSION['wrong-password']);
                }

                if(isset($_SESSION["change-password"]))
                {
                    echo $_SESSION["change-password"];
                    unset($_SESSION["change-password"]);
                }

            ?>
            <br><br><br>
            <!-- button to add admin -->
             <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br> <br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        // Get admin
                        $sql="SELECT*FROM tbl_admin";
                        // Execute quary
                        $res = mysqli_query($conn, $sql);
                        // Check quary is exicuted
                        if($res==TRUE)
                        {
                            // Count rows to check data in database
                            $count = mysqli_num_rows($res); 

                            $sn=1; //create variable and assign value

                            // Check num rows
                            if($count>0)
                            {
                                // we have data
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //using while to get data
                                    // while will exicute as long as data present

                                    // get individual data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    // Display the value in table
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                            else
                            {
                                // no data
                            }
                        }
                    ?>

                    
                </table>

            </div>
        </div>
        <!-- /main -->

<?php include('partials/footer.php')?>