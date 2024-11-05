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
            <li><i class="fa-solid fa-upload"></i><a href="#upload">Upload Product</a></li>
            <li><i class="fa-solid fa-utensils"></i><a href="#recipes">Recipes</a></li>
            <li><i class="fa-solid fa-file-upload"></i><a href="#upload_recipe">Upload Recipe</a></li>
            <li><i class="fa-solid fa-truck"></i><a href="#orders">Orders</a></li>
            <li><i class="fa-solid fa-cash-register"></i><a href="#pos">POS</a></li> 
            <li><i class="fa-solid fa-user"></i><a href="logout.php">Logout</a></li>
        </div>
        
    </section>

    <?php
        $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
        if (!$con) {
            die("Sorry, you can't connect to the database.");
        }
        $email = $_SESSION["email"];
        $product_sql = "SELECT * FROM `product_tbl`WHERE `email` = '$email'";
        $product_num = mysqli_query($con, $product_sql);
        $num_results = mysqli_num_rows($product_num);

        $user_sql = "SELECT * FROM `user_tbl`";
        $user_num = mysqli_query($con, $user_sql);
        $num_results2 = mysqli_num_rows($user_num);

        $order_sql = "SELECT * FROM `order_tbl` WHERE `storeEmail` = '$email'";
        $order_num = mysqli_query($con, $order_sql);
        $num_results3 = mysqli_num_rows($order_num);

        $order_sql = "SELECT * FROM `order_tbl` WHERE `status` = 'Delivered'";
        $order_num = mysqli_query($con, $order_sql);
        $num_results4 = mysqli_num_rows($order_num);

        $income_sql = "SELECT SUM(payment) AS income FROM `order_tbl`  WHERE `storeEmail` = '$email' ";
        $results = mysqli_query($con, $income_sql);
        $row = mysqli_fetch_assoc($results);
        $income = number_format($row['income']);

        $inventory_sql = "SELECT SUM(stock) AS stock FROM `product_tbl` WHERE `email` = '$email'  ";
        $results = mysqli_query($con, $inventory_sql);
        $row = mysqli_fetch_assoc($results);
        $stock = $row['stock'];

        
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
            <a href="#upload">
                <center><button class="normal"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Add product</button></center>
            </a>
    
        </section>

        <?php
            }
        ?>

<br><br><br>
        <hr>
        <br><br>
        <section id="cart" class="section-p1" >
            <h2>Upload Product</h2>
            <div id="upload" class="update-profile">
                <form  action="AddProduct.php" method="post" enctype="multipart/form-data">
                    <br>
                    <div class="flex">
                
                        <div class="inputBox">

                            <input type="text" name="txtTitle" placeholder="Product name *" class="box" required>
                            <input type="number" name="price" placeholder="Product price *" class="box" required>
                            <input type="number" name="stock" placeholder="Available stock *" class="box" required>
            
                        </div>

                        <div class="inputBox">

                            <input type="file" name="imageFile" placeholder="Upload an image" class="box" required>
                            <textarea name="txtDescription" placeholder="Product description" class="box" rows="6"></textarea>
            
                        </div>

                    </div>

                    <div class="publish-pro">
                        <label for="txtPublish">Publish to website: 
                            <input type="checkbox" name="txtPublish">
                        </label>
                    </div>

                    <button type="submit" name="btnSubmit" class="normal">Add product</button>
                </form>

                <?php
                    if(isset($_POST["btnSubmit"])){
                        $productName = $_POST["txtTitle"];
                        $desc = $_POST["txtDescription"];
                        $price = $_POST["price"];
                        $stock = $_POST["stock"];
                        
                        if(isset($_POST["txtPublish"])){
                            $status = 1;
                        }
                        else{
                            $status = 0;
                        }
                        
                        $image = "uploads/" . basename($_FILES["imageFile"]["name"]);
                        move_uploaded_file($_FILES["imageFile"]["tmp_name"], $image);
                        
                        $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
                    
                        if(!$con){
                            die("Sorry, you can't connect to the database.");
                        }
                        
                        $sql = "INSERT INTO `product_tbl` (`productID`, `productName`, `description`, `publish`, `price`, `stock`, `imagePath`, `email`) VALUES (NULL, '$productName', '$desc', '$status', '$price', '$stock', '$image', '" . $_SESSION["email"] . "')";
                        
                        if(mysqli_query($con, $sql)){
                            echo "<script>
                                alert('Product added successfully');
                                window.location.href = 'stores_owner.php';
                                </script>";
                        }
                        else{
                            echo "<script>
                                alert('Something went wrong');
                                window.location.href = 'stores_owner.php';
                                </script>";
                        }
                    }

                ?>
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
        $sql = "SELECT * FROM `recipe_tbl` WHERE 1";
        $results = mysqli_query($con, $sql);
        $num_results = mysqli_num_rows($results);

        if (mysqli_num_rows($results) > 0) {
        ?>

        <section id="cart" class="section-p1">
            <h2 id="my-products">My Recipes</h2>
            <table width="100%">
                <thead>
                    <tr>
                        <td>RECIPE IMG</td>
                        <td>RECIPE NAME</td>
                        <td>DESCRIPTION</td>
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
                        <td><?php echo $row["recipeName"]; ?></td>
                        <td style='padding-right: 100px;'><?php echo $row["description"]; ?> items left</td>

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
        </section>
        <?php } ?>
        <br><br><br>
        <hr>
        <br><br>

        <!-- Recipe Upload Section -->
        <section id="upload_recipe" class="section-p1">
            <h2>Upload Recipe</h2>
            <div id="upload" class="update-profile">
                <form action="AddRecipe.php" method="post" enctype="multipart/form-data">
                    <br>
                    <div class="flex">
                        <div class="inputBox">
                            <input type="text" name="txtRecipeName" placeholder="Recipe name *" class="box" required>
                            <textarea name="txtIngredients" placeholder="Ingredients (separate with commas) *" class="box" rows="6" required></textarea>
                        </div>

                        <div class="inputBox">
                            <input type="file" name="recipeImageFile" placeholder="Upload an image" class="box" required>
                            <textarea name="txtRecipeDescription" placeholder="Recipe description" class="box" rows="6" required></textarea>
                        </div>
                    </div>

                    <button type="submit" name="btnSubmitRecipe" class="normal">Add Recipe</button>
                </form>
            </div>
        </section>   
        <br><br><br>
        <hr>
        <br><br>



        <?php
            $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");

            if (!$con) {
                die("Sorry, you can't connect to the database.");
            }
        
            $sql = "SELECT * FROM `order_tbl` WHERE storeEmail = '$email' ORDER BY orderDate DESC";
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
                        <td style='color: #200741; padding-right: 10px;'>STATUS</td>
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
                            <a href='stores_owner.php?id=<?php echo $row["orderID"]; ?>'>
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
                
                $sql = "UPDATE order_tbl SET status = 'Delivered' WHERE orderID =" . $_GET["id"];
            
                if (mysqli_query($con, $sql)) {
                    echo "<script>
                        alert('Order status updated');
                        window.location.href = 'stores_owner.php#orders';
                        </script>";
                }
            }
        ?>
<br><br><br>
        <hr>
        <br><br>
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
                        $fetch_pos_logs_sql = "SELECT * FROM pos_logs WHERE storeEmail = '$email' ORDER BY date DESC";
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