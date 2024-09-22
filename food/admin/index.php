<?php include('partials/menu.php')?>

        <!-- main -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                    <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>
                <div class="col-4 text-center">
                    <?php
                        $sql = "SELECT * FROM tbl_catagory";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count ?></h1>
                    <br>
                    Catagories
                </div>
                <div class="col-4 text-center">
                    <?php
                        $sql2 = "SELECT * FROM tbl_food";
                        $res2 = mysqli_query($conn, $sql);
                        $count2 = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count2 ?></h1>
                    <br>
                    Foods
                </div>
                <div class="col-4 text-center">
                    <?php
                        $sql3 = "SELECT * FROM tbl_order";
                        $res3 = mysqli_query($conn, $sql);
                        $count3 = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count3 ?></h1>
                    <br>
                    Orders
                </div>
                <div class="col-4 text-center">
                    <?php
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                        $res4 = mysqli_query($conn, $sql4);
                        $row4 = mysqli_fetch_assoc($res4);

                        $total_revinue = $row4['Total'];
                    ?>
                    <h1>$<?php echo $total_revinue; ?></h1>
                    <br>
                    Revenue
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- /main -->

<?php include('partials/footer.php')?>