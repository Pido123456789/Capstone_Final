<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");

    if (!$con) {
        die("Sorry, you can't connect to the database.");
    }

    $orderID = $_GET['id'];
    $email = $_SESSION['email'];

    $sql = "UPDATE order_tbl SET status = 'Delivered' WHERE orderID = $orderID AND storeEmail = '$email'";

    if (mysqli_query($con, $sql)) {
        echo "<script>
            alert('Order status updated');
            window.location.href = 'stores_owner.php#orders';
        </script>";
    } else {
        echo "<script>
            alert('Failed to update order status');
            window.location.href = 'stores_owner.php#orders';
        </script>";
    }

    mysqli_close($con);
}
?>
