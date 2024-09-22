<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Enter current password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="passwrod" name="new_password" placeholder="Enter new password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                    <input type="passwrod" name="confirm_password" placeholder="Enter confirm password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        // echo "Button Clicked";
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_pasword']);

        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            $count=mysqli_num_rows($res);
            if($count==1)
            {
            //    echo "User found"; 
                if($new_password==$confirm_password)
                {
                    $sql2 = "UPDATE tbl_admin SET 
                        password='$new_password' 
                            WHERE id=$id"
                    ;
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2==true)
                    {
                        $_SESSION['change-password'] = "<div class='success'>Password Changed Successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        $_SESSION['change-password'] = "<div class='error'>Fail.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['wrong-password'] = "<div class='error'>Wrong Password</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }

        }
    } 
?>

<?php include('partials/footer.php'); ?>