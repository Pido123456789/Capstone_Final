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
    <link rel="stylesheet" href="./CSS/contact.css">
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
                <li><a href="about.php">About</a></li>
                <li><a class="active" href="contact.php">Contact</a></li>
                <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            </ul>
        </div>
    </section>


    <section id="page-header" class="about-header" style="background-image: url('img/banner/b1.png');">
        <h2>Get in touch</h2>
        <p>Leave a message, We appreciate your feedback</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
            
            <h2>Visit our new showroom or contact us today</h2>
            <h3>New showroom</h3>
            <div>
                <li>
                    <i class="fa-solid fa-location-dot"></i>
                    <p>
                        Andeng's Litson Manok
                        Cabadbaran City, Agusan Del Norte</p>
                </li>

                <li>
                    <i class="fa-solid fa-clock"></i>
                    <p>Open everyday 5 AM to 11 PM</p>
                </li>

                <li>
                    <i class="fa-solid fa-envelope"></i>
                    <p>sample@gmail.com</p>
                </li>

                <li>
                    <i class="fa-solid fa-phone"></i>
                    <p>+64 987 654 3210</p>
                </li>
            </div>
        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1623.4626344438545!2d125.53767023829796!3d9.118523546052376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3301bd347af47889%3A0x8d2e5a009f164982!2sAndeng&#39;s%20Litson%20Manok!5e1!3m2!1sen!2sph!4v1721887639534!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <section id="form-details">
        <form action="">
            <h2>Customer feedback</h2>
            <h3 style="color: #4b4b4b;">Leave a message or give us a call, We appreciate your feedback</h3><br><br>
            <input type="text" placeholder="Your name">
            <input type="text" placeholder="Email address">
            <input type="text" placeholder="Subject">
            <textarea name="" id="" cols="30" rows="5" placeholder="Your message..."></textarea>
            <button class="normal">Submit</button>
        </form>

        <div class="contact-img">
            <img src="img/about/contact (Custom).jpg">
        </div>



    </section>


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