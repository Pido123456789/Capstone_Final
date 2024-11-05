<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location:login.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FreshBasket</title>
    
    <script src="https://kit.fontawesome.com/c37001a085.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/about.css">
    <link rel="shortcut icon" href="img/mylogo3.png" type="image/x-icon">
    
</head>
<body>
    
    <section id="header">
        <a href="index.php"><img src="./img/sitelogo.png" class="logo"></a>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="store_list.php">Store</a></li>
                <li><a href="recipe.php">Recipe</a></li>
                <li><a class="active" href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            </ul>
        </div>
    </section>


    <section id="page-header" class="about-header" style="background-image: url('img/banner/b1.png');">
        <h2>Get to know us</h2>
        <p>Our sevices, privacy policy, conditions</p>
    </section>


    <section id="about-head" class="section-p1">

        <img src="img/about/bgabout.png">
        <div>
            <center><h2>About Us</h2></center><br>
            <p>Welcome to FreshBasket, your premier online marketplace for fresh and high-quality groceries. At FreshBasket, we specialize in delivering a wide range of products, including meats, dairy, fruits, and vegetables, right to your doorstep. Our mission is to provide you with a seamless and enjoyable shopping experience, ensuring that you receive only the best. We partner with trusted farmers and suppliers to guarantee that our products meet the highest standards of freshness and quality. 
                <br>
                <br>
                Whether you're looking for premium meats, fresh dairy, ripe fruits, or crisp vegetables, you can count on FreshBasket to bring the best of the market to you. Our commitment to quality, convenience, and sustainability drives everything we do, making FreshBasket your reliable source for all your grocery needs. Thank you for choosing FreshBasket – we look forward to serving you!            </p>

            <marquee loop="-1" scrollamount="10" width="100%">
                Discover freshly products came from farm.
            </marquee>
        </div>

    </section>

    
    <center><h2 id="abt-title">Our Services</h2></center>
    <section id="feature" class="section-p1">

        <div class="fe-box">
            <i class="fas fa-shipping-fast" style="font-size: 90px;"></i>
            <h6>Fast shipping</h6>
        </div>
        
        <div class="fe-box">
            <i class="fas fa-headset" style="font-size: 90px;"></i>
            <h6>Customer support</h6>
        </div>
        
        <div class="fe-box">
            <i class="fas fa-leaf" style="font-size: 90px;"></i>
            <h6>Fresh products</h6>
        </div>
        
        <div class="fe-box">
            <i class="fas fa-truck" style="font-size: 90px;"></i>
            <h6>Free shipping</h6>
        </div>
        
        <div class="fe-box">
            <i class="fas fa-clock" style="font-size: 90px;"></i>
            <h6>Open everyday</h6>
        </div>
        
    </section>


    <center><h2 id="abt-title">Privacy Policy</h2></center>
    <div>
        <p id="abt-para2">
            At FreshBasket, we are committed to protecting the privacy and security of our customers' personal information. We may collect personal information from you when you visit our website, create an account, make a purchase, or interact with us in any other way. This personal information may include your name, contact details, billing and shipping address, and payment information. 
            <br>
            <br>
            We do not sell or rent your personal information to any third parties. However, we may share your personal information with our trusted partners who assist us in providing our services, such as our delivery partners and payment gateway providers. We ensure that our partners only use your personal information for the purposes that we have authorized and that they maintain appropriate security measures to protect your personal information. If you have any questions or concerns about our Privacy Policy or the way we process your personal information, please contact us at sample@gmail.com.
        </p>
    </div>
    <br>

    <center><h2 id="abt-title">Terms & Conditions</h2></center>
    <div>
        <p id="abt-para2">By accessing or using our website, you agree to comply with and be bound by the following terms and conditions. Please review them carefully before placing an order. All content, products, and services available on or through our website are subject to these terms. We reserve the right to update, change, or replace any part of these terms at our discretion. Your continued use of the website after any such modifications constitutes your acceptance of the new terms. Should you disagree with any part of these terms, we kindly ask that you refrain from using our website. Enjoy your shopping experience at FreshBasket!
        </p>
    </div>
    <br><br><br>


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