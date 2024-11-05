<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if recipeID is passed via GET
if (isset($_GET['id'])) {
    $recipeID = $_GET['id'];

    // Delete the recipe
    $deleteQuery = "DELETE FROM recipe_tbl WHERE recipeID='$recipeID'";
    if (mysqli_query($con, $deleteQuery)) {
        echo "<script>alert('Recipe deleted successfully!'); window.location.href='admin.php#recipes';</script>";
    } else {
        echo "<script>alert('Error deleting recipe!');</script>";
    }
} else {
    echo "No recipe ID provided!";
}
?>
