<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

// Get the store name from the URL and sanitize it
$store_name = filter_input(INPUT_GET, 'store', FILTER_SANITIZE_EMAIL);

$con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
if (!$con) {
    die("Sorry, you can't connect to the database.");
}

// Sanitize the store name for use in SQL query
$store_name = mysqli_real_escape_string($con, $store_name);

// Corrected SQL query
$sql = "SELECT * FROM store_tbl WHERE email='$store_name'";
$results = mysqli_query($con, $sql);

if ($results && mysqli_num_rows($results) > 0) {
    $row = mysqli_fetch_assoc($results);
    $avatar = htmlspecialchars($row['imagePath']);
    $name = htmlspecialchars($row['name']);
    $email = htmlspecialchars($row['email']);
    $address = htmlspecialchars($row['address']);
    $number = htmlspecialchars($row['contactNumber']);
} else {
    // Handle the case where no store was found
    $avatar = '';
    $name = 'Store not found';
    $address= '';
    $email = '';
    $number = '';
}

mysqli_close($con);
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
</head>
<body>

    <!-- js for products details popup and search bar -->
    <script src="js/popup.js" defer></script>
    <script src="js/search.js"></script>

    <section id="header">
        <a href="index.php"><img src="./img/sitelogo.png" class="logo"></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a class="active" href="shop.php">Shop</a></li>
                <li><a href="store_list.php">Store</a></li>
                <li><a href="recipe.php">Recipe</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            </ul>
        </div>
    </section>

    <section id="store-details">
        <div class="store-avatar">
            <img src="<?php echo $avatar; ?>" alt="Store Avatar">
        </div>
        <div class="store-info">
            <p>Name: <?php echo $name; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>Number: <?php echo $number; ?></p>
            <p>Address: <?php echo $address; ?></p>
            <div class="store-buttons">
                <button onclick="window.location.href='contact_now.php?store=<?php echo urlencode($store_name); ?>'">Contact Now</button>
                <button class="btnwhite" onclick="window.location.href='report_problem.php?store=<?php echo urlencode($store_name); ?>'">Report a Problem</button>
            </div>
        </div>
    </section>

    <section id="search-filter">
        <div class="search-engine">
            <div id="search-container">
                <center><input type="search" id="search-input" placeholder="Search for products..."/>
                <button id="search">Search</button></center>
            </div>
            <center><div id="buttons">
                <button id="category" class="button-value">All</button>
                <button id="category" class="button-value">Phones</button>
                <button id="category" class="button-value">Headphone</button>
                <button id="category" class="button-value">Earbuds</button>
                <button id="category" class="button-value">Speakers</button>
            </div></center>
        </div>
    </section>

    
    <?php
        $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
        if (!$con) {
            die("Sorry, you can't connect to the database.");
        }
        $sql = "SELECT * FROM `product_tbl` WHERE email = '$store_name '";
        $results = mysqli_query($con, $sql);

        if (mysqli_num_rows($results) > 0) {
    ?>

    <section id="product1" class="section-p1">
        <div class="pro-container">

            <?php
                $index = 1;
                while ($row = mysqli_fetch_assoc($results)) {

            ?>
            <div class="pro" data-name="p-<?php echo $index; ?>">
                <img src="<?php echo $row["imagePath"]; ?>">
                <div class="des">
                    <span><?php echo $row["productName"]; ?></span>
                    <h5><?php echo $row["email"]; ?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>4.6</span>
                    </div>
                    <h4>₱ <?php echo number_format($row["price"]); ?></h4>
                </div>
                <h6 class="cart">Details</h6>
            </div>
            <?php
                    $index++;
                }
            ?>
        </div>

    <!-- product details popup -->
    <div class="products-preview">
        <?php
            mysqli_data_seek($results, 0);
            $index = 1;
            while ($row = mysqli_fetch_assoc($results)) {
        ?>
        <div class="preview" data-target="p-<?php echo $index; ?>">
            <i class="fas fa-times"></i>
            <img src="<?php echo $row["imagePath"]; ?>">

            <a href='CartHandler.php?id=<?php echo $row["productID"]; ?>&quantity=1' class="add-to-cart">
                <button class="normal">Add to cart</button>
            </a>

            <a href='wishlist.php?id=<?php echo $row["productID"]; ?>'>
                <button class="wishlist-btn"><i class="fa-solid fa-heart"></i></button>
            </a>

            <div class="single-pro-details">
                <h2><?php echo $row["productName"]; ?></h2>
                <h4>₱ <?php echo number_format($row["price"]); ?></h4>

                <input type="number" value="1" min="1" class="quantity-input">
                <h6>Stock: <span><?php echo $row["stock"]; ?> items left</span></h6>

                <h4 id="details">Product details</h4>
                <a href="https://www.google.com/search?q=<?php echo $row['productName']; ?>" target="_blank">Specifications</a>

                <p><?php echo $row["description"]; ?></p>
            </div>
        </div>
        <?php
                $index++;
            }
        ?>
    </div>

<script>
    document.querySelectorAll('.quantity-input').forEach(function(input) {
        input.addEventListener('input', function() {
            const quantity = this.value;
            const addToCartLink = this.closest('.preview').querySelector('.add-to-cart');
            const href = new URL(addToCartLink.href);
            href.searchParams.set('quantity', quantity);
            addToCartLink.href = href.toString();
        });
    });
</script>
    </section>
    <?php
        }
    ?>



    <br><br><br>
    <footer class="section-p1">
        <div class="col">
            <img class="logo-footer" src="img/sitelogo.png">
            <h4>Contact</h4>
            <p><strong>Address : &nbsp </strong>Andeng's Litson Manok
            Cabadbaran City, Agusan Del Norte</p>
            <p><strong>Phone : &nbsp </strong>+64 987 654 3210</p>
            <p><strong>Email : &nbsp </strong>sample@gmail.com</p>

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
