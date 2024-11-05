<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location:login.php");
}
?>

<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
if (!$con) {
    die("Sorry, you can't connect to the database.");
}

// Get the recipeID from the URL
if (isset($_GET['id'])) {
    $recipeID = $_GET['id'];
} else {
    die("Recipe ID not provided.");
}

// Fetch the recipe details from the database
$sql = "SELECT * FROM `recipe_tbl` WHERE `recipeID` = $recipeID";
$result = mysqli_query($con, $sql);

// Check if recipe is found
if (mysqli_num_rows($result) > 0) {
    $recipe = mysqli_fetch_assoc($result);
} else {
    die("Recipe not found.");
}

// Extract ingredients
$ingredients = explode(",", $recipe['ingredients']);
$ingredients = array_map('trim', $ingredients); // Trim whitespace

// Split each ingredient into individual words and use LIKE for each word
$wordConditions = array();
foreach ($ingredients as $ingredient) {
    $words = explode(" ", $ingredient); // Split the ingredient into words
    foreach ($words as $word) {
        $word = trim($word);
        if (!empty($word)) {
            $wordConditions[] = "`productName` LIKE '%" . mysqli_real_escape_string($con, $word) . "%'";
        }
    }
}

// Combine conditions with OR operator
$likeQuery = implode(' OR ', $wordConditions);

// Final SQL query to fetch products
$sql = "SELECT * FROM `product_tbl` WHERE ($likeQuery) AND `stock` > 0";
$productResults = mysqli_query($con, $sql);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshBasket</title>
    <script src="https://kit.fontawesome.com/c37001a085.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/shop.css">
    <link rel="shortcut icon" href="img/mylogo3.png">
    <link rel="stylesheet" href="./CSS/recipe_detail.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back" />
    
</head>
<body>

<section id="header">
    <a href="#"><img src="./img/sitelogo.png" class="logo"></a>
    <div>
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="store_list.php">Store</a></li>
            <li><a href="recipe.php" class="active">Recipe</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
            <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
        </ul>
    </div>
</section>
<section id="recipe-details" class="section-p1">
<a href="javascript:void(0);" onclick="history.back();"> < Return</a>


    <div class="recipe-detail-container">
        
        <div class="recipe-details-info">
            <h2><?php echo $recipe['recipeName']; ?></h2>
            <div class="recipe-image">
                <img src="<?php echo $recipe['imagePath']; ?>" alt="<?php echo $recipe['recipeName']; ?>">
            </div>
            <div class="recipe-info">
                <h3>Ingredients</h3>
                <ul>
                    <?php
                    // Display the ingredients
                    foreach ($ingredients as $ingredient) {
                        echo "<li>" . htmlspecialchars($ingredient) . "</li>";
                    }
                    ?>
                </ul>

                <h3>Description</h3>
                <p><?php echo $recipe['description']; ?></p>
            </div>
        </div>
        
        <div class="list-of-recipe-products">
            <h2>Related Products</h2>
            <?php
            if (mysqli_num_rows($productResults) > 0) {
                ?>
                <table border="1" cellpadding="10" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Store</th>
                            <th>Stock</th>
                            <th>Add to Cart</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($productResults)) {
                            if($row['stock'] == 0){
                                $stock = 'Out of Stock';
                            }else{
                                $stock = $row['stock'];
                            }
                            ?>
                            <tr>
                                <td><img src="<?php echo $row["imagePath"]; ?>" alt="<?php echo $row["productName"]; ?>" style="width: 100px;"></td>
                                <td><?php echo $row["productName"]; ?></td>
                                <td>₱ <?php echo number_format($row["price"]); ?></td>
                                <td><?php echo ($row["email"]); ?></td>
                                <td><?php echo $stock ?></td>
                                <td><a href='CartHandlerRecipe.php?id=<?php echo $row["productID"]; ?>&quantity=1' class="add-to-cart"><button class="normal">Add to cart</button></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                
            } else {
                echo "<p>No related products found.</p>";
            }
            ?>
        </div>
    </div>
</section>

<footer class="section-p1">
    <div class="col">
        <img class="logo-footer" src="img/sitelogo.png">
        <h4>Contact</h4>
        <p><strong>Address: &nbsp</strong>Andeng's Litson Manok Cabadbaran City, Agusan Del Norte</p>
        <p><strong>Phone: &nbsp</strong>+64 987 654 3210</p>
        <p><strong>Email: &nbsp</strong>sample@gmail.com</p>

        <div class="follow">
            <h4>Follow us</h4>
            <div class="icon">
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-pinterest"></i>
                <a href="https://github.com/ashfaaqrifath/Novatech-Website-Project" target="_blank">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <h4>Quick Links</h4>
        <a href="shop.php">Shop</a>
        <a href="about.php">About us</a>
        <a href="contact.php">Contact us</a>
        <a href="#">Privacy Policy</a>
        <a href="about.php">Terms & Conditions</a>
    </div>

    <div class="col">
        <h4>My Account</h4>
        <a href="login.php">Sign in</a>
        <a href="cart.php">View cart</a>
        <a href="profile.php">My wishlist</a>
        <a href="profile.php">Order history</a>
    </div>

    <div class="col install">
        <h4>Payment Methods</h4>
        <p>Cash on delivery</p>
        <p>Secure payment gateway</p>
        <img src="img/pay.png">
    </div>

    <div class="copyright">
        <p>Copyright © 2024 FreshBasket - Developed by <a href="admin.php">Aivan-kun</a></p>
    </div>
</footer>

</body>
</html>
