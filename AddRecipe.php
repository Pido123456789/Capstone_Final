<?php
session_start();

if (isset($_POST["btnSubmitRecipe"])) {
    $recipeName = $_POST["txtRecipeName"];
    $description = $_POST["txtRecipeDescription"];
    $ingredients = $_POST["txtIngredients"];
    
    // Handle image upload
    $image = "uploads/recipe/" . basename($_FILES["recipeImageFile"]["name"]);
    move_uploaded_file($_FILES["recipeImageFile"]["tmp_name"], $image);

    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");

    if (!$con) {
        die("Sorry, you can't connect to the database.");
    }

    // Insert the recipe data into the database
    $sql = "INSERT INTO `recipe_tbl` (`recipeID`, `recipeName`, `description`, `imagePath`, `ingredients`, `email`) 
            VALUES (NULL, '$recipeName', '$description', '$image', '$ingredients', '" . $_SESSION["email"] . "')";
    
    if (mysqli_query($con, $sql)) {
        echo "<script>
            alert('Recipe added successfully');
            window.location.href = 'stores_owner.php#upload_recipe';
            </script>";
    } else {
        echo "<script>
            alert('Something went wrong');
            window.location.href = 'stores_owner.php#upload_recipe';
            </script>";
    }

    mysqli_close($con);
}
?>
