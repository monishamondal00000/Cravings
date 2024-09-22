<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br><br><br>

        <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th> <!-- Changed from 'Contact Contact' -->
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
                // Fetch orders from the database
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1; // For serial number

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        // Get all order details
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo htmlspecialchars($food); ?></td>
                            <td><?php echo htmlspecialchars($price); ?></td>
                            <td><?php echo htmlspecialchars($qty); ?></td>
                            <td><?php echo htmlspecialchars($total); ?></td>
                            <td><?php echo htmlspecialchars($order_date); ?></td>

                            <td><?php echo htmlspecialchars($status); ?></td>

                            <td>
                                <?php
                                    if($status=="Ordered")
                                    {
                                        echo "<label>$status</label>";
                                    }
                                    elseif($status=="On Delivery")
                                    {
                                        echo "<label style='color: orange;'>$status</label>";
                                    }
                                    elseif($status=="Delivered")
                                    {
                                        echo "<label style='color: green;'>$status</label>";
                                    }
                                    elseif($status=="Cancelled")
                                    {
                                        echo "<label style='color: red;'>$status</label>";
                                    }
                                ?>
                            </td>

                            <td><?php echo htmlspecialchars($customer_name); ?></td>
                            <td><?php echo htmlspecialchars($customer_contact); ?></td>
                            <td><?php echo htmlspecialchars($customer_email); ?></td>
                            <td><?php echo htmlspecialchars($customer_address); ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // No orders found
                    echo "<tr><td colspan='12' class='error'>Orders not available</td></tr>";
                }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
