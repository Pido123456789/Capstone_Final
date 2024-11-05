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
    $productName = $row["productName"];
    $price = $row["price"];
    $stock = $row["stock"];
    $imagePath = $row["imagePath"];
    $storeEmail = $row["email"];
    $totalPrice = $price * $quantity;

    if ($quantity > $stock) {
        echo "<script>
            alert('Not enough stock available');
            window.location.href = 'shop.php';
            </script>";
        exit();
    }

    if (isset($_SESSION["email"])) {
        $email = $_SESSION["email"];

        $sql = "INSERT INTO `cart_tbl` (`cartID`, `productName`, `price`, `quantity`, `stock`, `imagePath`, `email`, `storeEmail`) VALUES (NULL, '$productName', '$totalPrice', '$quantity', '$stock', '$imagePath', '$email', '$storeEmail')";

        if (mysqli_query($con, $sql)) {
            $newStock = $stock - $quantity;
            $updateStockSql = "UPDATE `product_tbl` SET `stock`=$newStock WHERE `productID`=$id";

            if (mysqli_query($con, $updateStockSql)) {
                echo "<script>
                    alert('Product added to cart');
                    window.location.href = 'shop.php';
                    </script>";
            } else {
                echo "<script>
                    alert('Failed to update stock');
                    window.location.href = 'shop.php';
                    </script>";
            }
        } else {
            echo "<script>
                alert('Something went wrong');
                window.location.href = 'shop.php';
                </script>";
        }
    } else {
        header('Location: login.php');
    }
}
?>
