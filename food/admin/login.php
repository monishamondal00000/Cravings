<?php include('./config/constants.php'); ?>

<html>
    <head>
        <title>
            Login
        </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
    <div class="login">
            <h1 class="text-center">Login</h1><br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                    if(isset($_SESSION['no-login-message']))
                    {
                        echo $_SESSION['no-login--message'];
                        unset($_SESSION['no-login-message']);
                    }
                ?>
            <form action="" method="POST" class="text-center">
                Username:
                <input type="text" name="username" placeholder="Enter your username"><br><br>
                Password:
                <input type="text" name="password" placeholder="Enter Password"><br><br>
                <input type="submit" name="submit" value="login" class="primary">
            </form>
        </div>
    </body>
</html>

<?php
    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        echo $password;

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password = '$password'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class='success text-center'>Login Successful</div>";
            $_SESSION['user'] = $username;
            header("location:manage-admin.php");
        }
        else
        {
            $_SESSION['login'] = "<div class='error text-center'>Invalid username or password</div>";
            header("location:login.php");
        }
    }
?>