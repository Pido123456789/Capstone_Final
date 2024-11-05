<?php
session_start();
	if(!isset($_SESSION["email"])){
		header("Location:login.php");
	}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FreshBasket</title>
    
    <script src="https://kit.fontawesome.com/c37001a085.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/admin.css">
    
    <link rel="shortcut icon" href="img/sitelogo.png">
    
</head>

<body>

    <section id="menu">
        <div class="logo">
            <a href="index.php"><img src="./img/sitelogo.png" class="logo"></a>
        </div>

        <div class="items">
            <li><i class="fa-solid fa-screwdriver-wrench"></i><a href="#interface">Dashboard</a></li>
            <li><i class="fa-solid fa-bag-shopping"></i><a href="#cart">Products</a></li>
            <li><i class="fa-solid fa-pen-to-square"></i><a href="#my-products">My products</a></li>
            <li><i class="fa-solid fa-truck"></i><a href="#orders">Orders</a></li>
            <li><i class="fa-solid fa-users"></i><a href="#users">Users</a></li>
            <li><i class="fa-solid fa-book"></i><a href="#recipes">Recipes</a></li>
            <li><i class="fa-solid fa-cash-register"></i><a href="#pos">POS</a></li> 
            <li><i class="fa-solid fa-user"></i><a href="logout.php">Logout</a></li>
        </div>
        
    </section>

    <?php
        $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
        if (!$con) {
            die("Sorry, you can't connect to the database.");
        }
        
        $product_sql = "SELECT * FROM `product_tbl`";
        $product_num = mysqli_query($con, $product_sql);
        $num_results = mysqli_num_rows($product_num);

        $user_sql = "SELECT * FROM `user_tbl`";
        $user_num = mysqli_query($con, $user_sql);
        $num_results2 = mysqli_num_rows($user_num);

        $order_sql = "SELECT * FROM `order_tbl`";
        $order_num = mysqli_query($con, $order_sql);
        $num_results3 = mysqli_num_rows($order_num);

        $order_sql = "SELECT * FROM `order_tbl` WHERE `status` = 'Delivered'";
        $order_num = mysqli_query($con, $order_sql);
        $num_results4 = mysqli_num_rows($order_num);

        $income_sql = "SELECT SUM(payment) AS income FROM `order_tbl`";
        $results = mysqli_query($con, $income_sql);
        $row = mysqli_fetch_assoc($results);
        $income = number_format($row['income']);

        $inventory_sql = "SELECT SUM(stock) AS stock FROM `product_tbl`";
        $results = mysqli_query($con, $inventory_sql);
        $row = mysqli_fetch_assoc($results);
        $stock = $row['stock'];

        $email = $_SESSION["email"];
        $sql = "SELECT * FROM `user_tbl` WHERE `email` = '$email'";
        $results = mysqli_query($con, $sql);
        $user = mysqli_fetch_assoc($results);
    ?>

    
    <section id="interface">
        <div class="navigation">
            <div class="n1">

                <?php
                    echo "<div class='counter' style='padding-top: 10px;'><a>" . $_SESSION['email'] . "</a></div>";
                ?>
                
                <div class="profile">
                    <h4><?php echo date('Y-m-d'); ?></h4>
                    <i class="fa-solid fa-gear"></i>
                </div>
            </div>
        </div>

        <h3 class="i-name">
            Dashboard
            <a href="index.php">
                <button type="button" class="normal">View site</button>
            </a>
        </h3>


        <div class="values">

            <div class="val-box">
                <i class="fa-solid fa-shapes"></i>
                <div>
                    <span>Inventory</span>
                    <?php
                        echo "<h3>$stock</h3>";
                    ?>
                </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-bag-shopping"></i>
                <div>
                    <span>Products</span>
                    <?php
                        echo "<h3>$num_results</h3>";
                    ?>
                </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-truck"></i>
                <div>
                    <span>Total orders</span>
                    <?php
                        echo "<h3>$num_results3</h3>";
                    ?>
                    
                </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-money-bill"></i>
                <div>
                    <span>Income</span>
                    <?php
                        echo "<h3>$income</h3>";
                    ?>
                </div>
            </div>
        </div>


        <br><br>
        <section id="feature" class="section-p1">

            <div class="fe-box">
                <img src="img/about/truck-solid (1).svg" style="width: 90px; height: 90px;">
                <h6>Orders completed: <?php echo $num_results4; ?></h6>
            </div>
    
            <div class="fe-box">
                <img src="img/about/headset-solid (2).svg" style="width: 90px; height: 90px;">
                <h6>Customer feedback: 35</h6>
            </div>
    
            <div class="fe-box">
                <img src="img/about/award-solid (1).svg" style="width: 90px; height: 90px;">
                <h6>Warranty up to 1 year</h6>
            </div>
    
            <div class="fe-box">
                <img src="img/about/screwdriver-wrench-solid (1).svg" style="width: 90px; height: 90px;">
                <h6>Product inventory: <?php echo $row['stock']; ?></h6>
            </div>
    
            <div class="fe-box">
                <img src="img/about/clock-solid (1).svg" style="width: 90px; height: 90px;">
                <h6>Site status: active</h6>
            </div>
    
        </section>

        <br><br><br>
        <hr>
        <br><br><br>

        <?php
            $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
            if (!$con) {
                die("Sorry, you can't connect to the database.");
            }
            $sql = "SELECT * FROM `product_tbl`";
            $results = mysqli_query($con, $sql);
            $num_results = mysqli_num_rows($results);

            if (mysqli_num_rows($results) > 0) {
        ?>

        <section id="cart" class="section-p1">

            <form action="PublishHandler.php" method="post" style="position: absolute; right: 70px;">
                <button type="submit" class="normal" name="unpublishBtn">Unpublish all</button>&nbsp&nbsp
                <button type="submit" class="normal" name="publishBtn">Publish all</button>
            </form>

            <h2>Product settings</h2>
            <table width="100%">
                <thead>
                    <tr>
                        <td style="color: #200741;">PRODUCT</td>
                        <td style="color: #200741;">NAME</td>
                        <td style="color: #200741;">PRICE</td>
                        <td style="color: #200741;">STOCK</td>
                        <td style="padding-left: 60px; color: #200741;">PUBLISHED BY</td>
                        <td></td>
                    </tr>
                </thead>
    

                <?php
                    while ($row = mysqli_fetch_assoc($results)) {
                ?>
                <tbody>
                    <tr>
                        
                        <td><img src="<?php echo $row["imagePath"]; ?>"></td>
    
                        <td><?php echo $row["productName"]; ?></td>
                        <td>₱ <?php echo number_format($row["price"]); ?></td>
                        <td><?php echo $row["stock"]; ?> items left</td>
                        <td style='padding-left: 40px; font-weight: 450;'><?php echo $row["email"]; ?></td>
                    </tr>
    
                </tbody>
                <?php
                    }
                ?>

            </table>
            <br>
            <?php
                echo "<div class='counter'><a>Number of products: $num_results</a></div>";
            ?>
            <a href="AddProduct.php">
                <center><button class="normal"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Add product</button></center>
            </a>
    
        </section>

        <?php
            }
        ?>

        <br><br><br>
        <hr>
        <br><br><br>

        <?php
            $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");

            if (!$con) {
                die("Sorry, you can't connect to the database.");
            }
            $sql = "SELECT * FROM `product_tbl` WHERE `email` = '$email'";
            $results = mysqli_query($con, $sql);
            $num_results = mysqli_num_rows($results);

            if (mysqli_num_rows($results) > 0) {
        ?>

        <section id="cart" class="section-p1">

            <h2 id="my-products">My products</h2>
            <table width="100%">
                <thead>
                    <tr>
                        <td>PRODUCT</td>
                        <td>NAME</td>
                        <td>PRICE</td>
                        <td style='padding-right: 60px;'>STOCK</td>
                        <td>
                            <?php
                                echo "<div class='counter'><a>" . $_SESSION['email'] . "</a></div>";
                            ?>
                        </td>
                        <td></td>
                    </tr>
                </thead>
    
                <?php
                    while ($row = mysqli_fetch_assoc($results)) {
                ?>
                <tbody>
                
                    <tr>
                        
                        <td><img src="<?php echo $row["imagePath"] ?>"></td>
    
                        <td><?php echo $row["productName"]; ?></td>
                        <td>₱ <?php echo number_format($row["price"]); ?></td>
                        <td style='padding-right: 100px;'><?php echo $row["stock"]; ?> items left</td>

                        <td>
                        <a href='EditProduct.php?id=<?php echo $row["productID"]; ?>'>
                            <button class="normal"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Edit</button>
                        </a></td>

                        <td>
                            <form action='DeleteHandler.php?id=<?php echo $row["productID"]; ?>' method="post">
                                <button type="submit" class="normal" name="deleteProductBtn"><i class="fa-solid fa-trash"></i>&nbsp;&nbsp;Remove</button>
                            </form>
                        </td>
                        
                    </tr>
    
                </tbody>
                <?php
                    }
                ?>

            </table>
            <br>
            <?php
                echo "<div class='counter'><a>Number of products: $num_results</a></div>";
            ?>
            <a href="AddProduct.php">
                <center><button class="normal"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Add product</button></center>
            </a>
    
        </section>

        <?php
            }
        ?>

        <br><br><br>
        <hr>
        <br><br>



        <?php
            $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");

            if (!$con) {
                die("Sorry, you can't connect to the database.");
            }
        
            $sql = "SELECT * FROM `order_tbl`";
            $results = mysqli_query($con, $sql);
            $num_results = mysqli_num_rows($results);

            if (mysqli_num_rows($results) > 0) {
        ?>

        <br><br>
        <section id="cart" class="section-p1">

            <h2 id="orders">Customer orders</h2>
            <table width="100%">
                <thead>
                    <tr>
                        <td style='font-weight: 600; color: #200741;'>ORDER ID</td>
                        <td style='color: #200741;'>PRODUCTS</td>
                        <td style='color: #200741;'>PAYMENT</td>
                        <td style='color: #200741; padding-right: 120px;'>DATE</td>
                        <td style='color: #200741; padding-right: 10px;'>EMAIL</td>
                        <td></td>
                    </tr>
                </thead>

                <?php
                    while ($row = mysqli_fetch_assoc($results)) {
                ?>

                <tbody>
                    <tr>
                        <td style='font-weight: 600;'>#<?php echo $row["orderID"]; ?></td>
                        <td style='padding: 15px 0px 15px;'><?php echo $row["productNames"]; ?></td>
                        <td>₱ <?php echo number_format($row["payment"]); ?></td>
                        <td style='padding-right: 150px;'><?php echo $row["orderDate"]; ?></td>
                        <td style='font-size: 10px; padding-right: 150px;'><?php echo $row["email"]; ?></td>
                        
                        <td style='padding: 20px 0px 20px 0px;'>
                            <a href='admin.php?id=<?php echo $row["orderID"]; ?>'>
                                <button class="normal"><?php echo $row["status"]; ?></button>
                            </a>
                        </td>
                    </tr>
                </tbody>
                <?php
                    }
                ?>

            </table>
            <br>
            <?php
                echo "<div class='counter'><a>Number of orders: $num_results</a></div>";
            ?>

        </section>
        <?php
            }
        ?>



        <?php
            
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
                
                if (!$con) {
                    die("Sorry, you can't connect to the database.");
                }
                
                $sql = "UPDATE `order_tbl` SET `status` = 'Delivered' WHERE `orderID` =" . $_GET["id"];

                if (mysqli_query($con, $sql)) {
                    echo "<script>
                        alert('Order status updated');
                        window.location.href = 'admin.php#orders';
                        </script>";
                }
            }
        ?>






        <br><br><br>
        <hr>
        <br><br>

        <?php
            $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
            if (!$con) {
                die("Sorry, you can't connect to the database.");
            }
            $sql = "SELECT * FROM `user_tbl`";
            $results = mysqli_query($con, $sql);
            $num_results = mysqli_num_rows($results);

            $sql = "
                SELECT usr.*, COUNT(ord.orderID) as order_count
                FROM user_tbl usr
                LEFT JOIN order_tbl ord ON usr.email = ord.email
                GROUP BY usr.userID";

            $results = mysqli_query($con, $sql);

            if (mysqli_num_rows($results) > 0) {
        ?>

        <section id="cart" class="section-p1">

            <h2 id="users">Manage users</h2>
            <table width="100%">
                <thead>
                    <tr>
                        <td style='font-weight: 600; color: #200741;'>USERNAME</td>
                        <td style='color: #200741;'>EMAIL</td>
                        <td style='color: #200741;'>PHONE</td>  
                        <td style='color: #200741;'>ORDERS</td>
                        <td></td>
                    </tr>
                </thead>

                <?php
                    while ($row = mysqli_fetch_assoc($results)) {
                ?>

                <tbody>
                    <td style='font-weight: 600;'><?php echo $row["name"]; ?></td>
                    <td style='font-weight: 600;'><?php echo $row["email"]; ?></td>
                    <td style='font-weight: 600;'><?php echo $row["contactNumber"]; ?></td>
                    <td style='font-weight: 600;'><?php echo $row["order_count"]; ?></td>
                    
                    <td style='padding: 20px 0px 20px 0px;'>
                        <form action='DeleteHandler.php?id=<?php echo $row["userID"]; ?>' method="post">
                            <button type="submit" class="normal" name="deleteUserBtn"><i class="fa-solid fa-trash"></i>&nbsp;&nbsp;Remove</button>
                        </form>
                    </td>
                </tbody>
                <?php
                    }
                ?>
            </table>
            <br>
            <?php
                echo "<div class='counter'><a>Number of users: $num_results</a></div>";
            ?>

        </section>
        
        <?php
            }
        ?>
    <br><br><br>
        <hr>
        <br><br><br>

        <section id="recipes" class="section-p1">
            <h2>Recipes</h2>
            <a href="add_recipe.php">
                <button class="normal"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Add Recipe</button>
            </a>
            <br><br>
            <table width="100%">
                <thead>
                    <tr>
                        <td>IMAGE</td>
                        <td>RECIPE NAME</td>
                        <td>DESCRIPTION</td>
                        <td>ACTIONS</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
                    if (!$con) {
                        die("Sorry, you can't connect to the database.");
                    }
                    $sql = "SELECT * FROM `recipe_tbl`";
                    $results = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_assoc($results)) {
                        echo "<tr>";
                        echo "<td><img src='{$row['imagePath']}' alt='{$row['recipeName']}' style='width: 100px; height: 100px;'></td>";
                        echo "<td>{$row['recipeName']}</td>";
                        echo "<td>{$row['description']}</td>";
                        echo "<td>
                                <a href='edit_recipe.php?id={$row['recipeID']}'><button class='normal'><i class='fa-solid fa-pen-to-square'></i>&nbsp;&nbsp;Edit</button></a>
                                <form action='delete_recipe.php?id={$row['recipeID']}' method='post' style='display:inline;'>
                                    <button type='submit' class='normal' name='deleteRecipeBtn'><i class='fa-solid fa-trash'></i>&nbsp;&nbsp;Delete</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <br><br><br>
        <hr>
        <br><br><br>
        <section id="pos">
            <h1>POS Logs</h1>
            <form action="update_pos_logs.php" method="post">
                <button type="submit">Update POS Logs</button>
            </form>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Orders Count</th>
                            <th>Total Income</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch POS logs from the database
                        $fetch_pos_logs_sql = "SELECT * FROM pos_logs ORDER BY date DESC";
                        $pos_logs_result = mysqli_query($con, $fetch_pos_logs_sql);

                        while ($row = mysqli_fetch_assoc($pos_logs_result)) {
                            echo "<tr>";
                            echo "<td>{$row['date']}</td>";
                            echo "<td>{$row['orders_count']}</td>";
                            echo "<td>" . number_format($row['total_income']) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>




        <br><br><br><br>
        <div class="copyright">
            <br>
            <p>Copyright © 2024 <a href="index.php">FreshBasket</a> - Developed by Aivan-kun</p>
        </div>
        <br><br>

    </section>



</body>
</html>