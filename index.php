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

<body onLoad="heroSlides()">

    <!-- js for banner slider -->
    <script>
		let slideIndex = 0;

		function heroSlides(){
			
			let i;
			let slides = document.getElementsByClassName("mySlides");

			for (i = 0; i < slides.length; i++){
				slides[i].style.display = "none";
			}

			slideIndex++;

			if (slideIndex > slides.length){
				slideIndex = 1
			}

			slides[slideIndex-1].style.display = "block";
			setTimeout(heroSlides, 3000); //Change image every 3 seconds
		}
	</script>
    <script src="./js/popup.js" defer></script>

    
    <section id="header">
        <a href="index.php"><img src="./img/sitelogo.png" class="logo"></a>
        <div>
            <ul id="navbar">
                <li><a class="active"href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="store_list.php">Store</a></li>
                <li><a href="recipe.php">Recipe</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            </ul>
        </div>
    </section>


    <div class="slideshow-container">
		
		<div class="mySlides Fresh from the Farm to Your Table">
			<section id="hero1" cl style="background-image: url('img/vege.png');">
                <h4 class="fade" >Fresh from the Farm to Your Table</h4>
                <h2 class="fade">Vegetable</h2>
                <h1 class="fade">Products</h1>
                <a href="#product1">
                    <button>Shop Now &nbsp&nbsp<i class="fa-solid fa-bag-shopping"></i></button>
                </a>
            </section>
		</div>
		
		<div class="mySlides Fresh from the Farm to Your Table">
			<section id="hero2" style="background-image: url('img/meat.png');">
                <h4 class="fade">Fresh from the Farm to Your Table</h4>
                <h2 class="fade">Meat</h2>
                <h1 class="fade">Products</h1>
                <a href="#product1">
                    <button>Shop Now &nbsp&nbsp<i class="fa-solid fa-bag-shopping"></i></button>
                </a>
            </section>
		</div>
		
		<div class="mySlides Fresh from the Farm to Your Table">
			<section id="hero3" style="background-image: url('img/dairy.png');">
                <h4 class="fade">Fresh from the Farm to Your Table</h4>
                <h2 class="fade">Dairy</h2>
                <h1 class="fade">Products</h1>
                <a href="#product1">
                    <button>Shop Now &nbsp&nbsp<i class="fa-solid fa-bag-shopping"></i></button>
                </a>
            </section>
		</div>
        
	</div>

    
    <!-- logo display cards -->
    <section id="feature" class="section-p1">

        <div class="fe-box">
            <a href="stores.php?store=Sm@gmail.com">
                <img src="img/features/sm.png">
                <h6>SM Mall</h6>
            </a>
        </div>

        <div class="fe-box">
            <a href="stores.php?store=GM@gmail.com">
                <img src="img/features/gaisano.png">
                <h6>Gaisano Mall</h6>
            </a>
        </div>

        <div class="fe-box">
            <a href="stores.php?store=prince@gmail.com">
                <img src="img/features/prince.jpg">
                <h6>Prince Town Mall</h6>
            </a>
        </div>

        <div class="fe-box">
            <a href="stores.php?store=vross@gmail.com">
                <img src="img/features/vross.png">
                <h6>Vross</h6>
            </a>
        </div>

        <div class="fe-box">
            <a href="stores.php?store=novo@gmail.com">
                <img src="img/features/novo.png">
                <h6>Novo Supermarket</h6>
            </a>
        </div>

    </section>



    <!-- featured products -->
    <?php
        $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
        if (!$con) {
            die("Sorry, you can't connect to the database.");
        }
        $sql = "SELECT * FROM `product_tbl` LIMIT 8";
        $results = mysqli_query($con, $sql);

        if (mysqli_num_rows($results) > 0) {
    ?>

    <section id="product1" class="section-p1">
        <h2 class="heading1">Featured Products</h2>
        <p class="sub1">Discover the latest products from a wide range of brands</p>
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
        <br>
        <a href="shop.php">
            <button class="shop-btn">Shop More &nbsp&nbsp<i class="fa-solid fa-bag-shopping"></i></button>
        </a>
        <br><br><br><br>
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
                <button class="normal" onclick="this.innerHTML = 'Item added'">Add to cart</button>

                <a href='wishlist.php?id=<?php echo $row["productID"]; ?>'>
                    <button class="wishlist-btn"><i class="fa-solid fa-heart"></i></button>
                </a>



                <div class="single-pro-details">
                    <h2><?php echo $row["productName"]; ?></h2>
                    <h4>₱ <?php echo number_format($row["price"]); ?></h4>

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