<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
if (!$con) {
    die("Sorry, you can't connect to the database.");
}

$email = $_SESSION["email"];
$date = date('Y-m-d');

// Calculate total orders and income for the day
$order_sql = "SELECT COUNT(orderID) AS orders_count, SUM(payment) AS total_income FROM order_tbl WHERE storeEmail = '$email' AND orderDate = '$date'";
$order_result = mysqli_query($con, $order_sql);
$order_data = mysqli_fetch_assoc($order_result);

$orders_count = $order_data['orders_count'];
$total_income = $order_data['total_income'];

// Check if a log already exists for today
$check_sql = "SELECT * FROM pos_logs WHERE storeEmail = '$email' AND date = '$date'";
$check_result = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    // Update existing log
    $update_sql = "UPDATE pos_logs SET orders_count = '$orders_count', total_income = '$total_income' WHERE storeEmail = '$email' AND date = '$date'";
    mysqli_query($con, $update_sql);
} else {
    // Insert new log
    $insert_sql = "INSERT INTO pos_logs (date, orders_count, total_income, storeEmail) VALUES ('$date', '$orders_count', '$total_income', '$email')";
    mysqli_query($con, $insert_sql);
}

echo "<script>
    alert('POS Logs Updated');
    window.location.href = 'stores_owner.php#pos';
</script>";

mysqli_close($con);
?>
