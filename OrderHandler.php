<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");

if (!$con) {
    die("Sorry, you can't connect to the database.");
}

$email = $_SESSION["email"];

// Get cart items
$sql = "SELECT * FROM `cart_tbl` WHERE `email` = '$email'";
$cart_results = mysqli_query($con, $sql);

if (mysqli_num_rows($cart_results) > 0) {
    
    // Get total price
    $sql = "SELECT SUM(price) AS total_price FROM `cart_tbl` WHERE `email` = '$email'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $total_price = $row['total_price'] + 100; // Adding shipping fee

    // Get user details
    $sql = "SELECT * FROM `user_tbl` WHERE email = '$email'";
    $user_result = mysqli_query($con, $sql);
    $user = mysqli_fetch_assoc($user_result);
    $address = $user['address'];

    $orderDate = date('Y-m-d');
    $productNames = '';
    $storeEmails = '';

    // Process each cart item
    while ($cart_item = mysqli_fetch_assoc($cart_results)) {
        $product_id = $cart_item['productID'];
        $quantity = $cart_item['quantity'];
        $price = $cart_item['price'];
        $productName = $cart_item['productName'];
        $storeEmail = $cart_item['storeEmail'];

        if ($productNames != '') {
            $productNames .= "<br>";
        }
        if ($storeEmails != '') {
            $storeEmails .= "<br>";
        }
        $productNames .= $productName;
        $storeEmails .= $storeEmail;

        // Deduct stock based on quantity
        $update_stock_sql = "UPDATE product_tbl SET stock = stock - $quantity WHERE productID = '$product_id'";
        mysqli_query($con, $update_stock_sql);
    }

    // Insert order into order_tbl
    $order_sql = "INSERT INTO `order_tbl` (`orderID`, `email`, `productNames`, `payment`, `orderDate`, `address`, `status`, `storeEmail`) VALUES (NULL, '$email', '$productNames', '$total_price', '$orderDate', '$address', 'Processing', '$storeEmails')";
    mysqli_query($con, $order_sql);

    // Clear the cart
    $clear_cart_sql = "DELETE FROM `cart_tbl` WHERE `email` = '$email'";
    mysqli_query($con, $clear_cart_sql);

    echo "<script>
        alert('Your order is placed');
        window.location.href = 'profile.php#my-orders';
        </script>";

} else {
    echo "<script>
        alert('Something went wrong');
        window.location.href = 'cart.php';
        </script>";
}

mysqli_close($con);
?>
