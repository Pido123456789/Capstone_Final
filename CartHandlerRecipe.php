<?php
session_start();

$id = $_GET["id"];
$quantity = isset($_GET["quantity"]) ? intval($_GET["quantity"]) : 1;

$con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");

if (!$con) {
    die("Sorry, you can't connect to the database.");
}

$sql = "SELECT * FROM `product_tbl` WHERE `productID`=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if ($row) {
    // Fetch the necessary product data
    $productName = $row["productName"];
    $price = $row["price"];
    $stock = $row["stock"];
    $imagePath = $row["imagePath"];
    $storeEmail = $row["email"];
    $totalPrice = $price * $quantity;

    // Check stock availability
    if ($quantity > $stock) {
        echo "<script>
            alert('Not enough stock available');
            window.history.back(); // Refreshes the current page
            </script>";
        exit();
    }

    // Check if user is logged in
    if (isset($_SESSION["email"])) {
        $email = $_SESSION["email"];

        // Insert into cart table
        $sql = "INSERT INTO `cart_tbl` (`cartID`, `productName`, `price`, `quantity`, `stock`, `imagePath`, `email`, `storeEmail`) 
                VALUES (NULL, '$productName', '$totalPrice', '$quantity', '$stock', '$imagePath', '$email', '$storeEmail')";

        // Handle database insertion
        if (mysqli_query($con, $sql)) {
            // Update stock after adding to cart
            $newStock = $stock - $quantity;
            $updateStockSql = "UPDATE `product_tbl` SET `stock`=$newStock WHERE `productID`=$id";

            if (mysqli_query($con, $updateStockSql)) {
                // Refresh the current page after the alert
                echo "<script>
                    alert('Product added to cart');
                    window.history.back(); // Refreshes the current page
                    </script>";
            } else {
                echo "<script>
                    alert('Failed to update stock');
                    window.history.back(); // Refresh the page in case of failure
                    </script>";
            }
        } else {
            echo "<script>
                alert('Something went wrong');
                window.history.back(); // Refresh the page in case of failure
                </script>";
        }
    } else {
        header('Location: login.php'); // Redirect to login if user is not logged in
    }
}
?>
