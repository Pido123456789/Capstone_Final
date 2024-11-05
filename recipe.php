<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}
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
</head>
<body>
    
    <!-- Header -->
    <section id="header">
        <a href="index.php"><img src="./img/sitelogo.png" class="logo"></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="store_list.php">Store</a></li>
                <li><a class="active" href="recipe.php">Recipe</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="profile.php"><i class="fa-solid fa-user"></i></a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            </ul>
        </div>
    </section>

    <section id="page-header" style="background-image: url('img/banner/b1.png');">
        <h2>Food Recipes</h2>
        <p>List of Filipino Food Recipe</p>
    </section>


    <!-- Search for Recipes -->
    <section id="search" class="section-p1">
        <form method="GET" action="recipe.php" style="float:right">
            <h5>Search Here</h5>
            <input type="text" name="search" placeholder="Search Filipino Recipes (e.g., Adobo)" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="search-btn">Search</button>
        </form>
    </section>

    <!-- Search Results Section -->
    <section id="search-results" class="section-p1">
        <h2 class="heading1">Search Results</h2>
        <div class="recipe-container">

            <?php
            $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
            if (!$con) {
                die("Sorry, you can't connect to the database.");
            }

            $searchQuery = "";
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search = mysqli_real_escape_string($con, $_GET['search']);
                $searchQuery = "WHERE recipeName LIKE '%$search%' OR description LIKE '%$search%'";
            }

            $sql = "SELECT * FROM `recipe_tbl` $searchQuery";
            $results = mysqli_query($con, $sql);

            if (mysqli_num_rows($results) > 0) {
                $index = 1;

                while ($row = mysqli_fetch_assoc($results)) {
                    ?>
                    <div class="recipe-box" data-name="r-<?php echo $index; ?>">
                        <img src="<?php echo $row["imagePath"]; ?>" alt="Recipe Image">
                        <div class="recipe-info">
                            <h3><?php echo $row["recipeName"]; ?></h3>
                            <p><?php echo substr($row["description"], 0, 100) . '...'; ?></p>
                            <a href="recipe-details.php?id=<?php echo $row["recipeID"]; ?>">View Recipe</a>
                        </div>
                    </div>
                    <?php
                    $index++;
                }
            } else {
                echo "<p>No recipes found for '" . htmlspecialchars($search) . "'. Try searching for another recipe.</p>";
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="section-p1">
        <div class="col">
            <img class="logo-footer" src="img/sitelogo.png">
            <h4>Contact</h4>
            <p><strong>Address: </strong>Andeng's Litson Manok, Cabadbaran City, Agusan Del Norte</p>
            <p><strong>Phone: </strong>+64 987 654 3210</p>
            <p><strong>Email: </strong>sample@gmail.com</p>
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
            <a href="logiprofile.php">Order history</a>
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
