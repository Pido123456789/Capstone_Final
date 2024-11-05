<?php
// Include database connection
$con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipeName = $_POST['recipeName'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];

    // Handle file upload for recipe image
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $targetDir = "uploads/";
        $imagePath = $targetDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    // Insert the recipe into the database
    $sql = "INSERT INTO recipe_tbl (recipeName, description, imagePath, ingredients) VALUES ('$recipeName', '$description', '$imagePath', '$ingredients')";
    
    if (mysqli_query($con, $sql)) {
        echo "Recipe added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
}

h2 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

/* Container for the form */
.container {
    width: 100%;
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Form Elements */
form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 10px;
    font-weight: bold;
    color: #555;
}

input[type="text"],
textarea,
input[type="file"] {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 20px;
    width: 100%;
    box-sizing: border-box;
    font-size: 16px;
}

textarea {
    resize: vertical;
}

button {
    padding: 12px;
    background-color: #3a2f8c;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}


/* File Upload Input Styling */
input[type="file"] {
    padding: 5px;
}

/* Success/Error Message */
.message {
    text-align: center;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.message.success {
    background-color: #d4edda;
    color: #155724;
}

.message.error {
    background-color: #f8d7da;
    color: #721c24;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Add Recipe</h2>
        <form action="add_recipe.php" method="post" enctype="multipart/form-data">
            <label for="recipeName">Recipe Name</label>
            <input type="text" id="recipeName" name="recipeName" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="ingredients">Ingredients</label>
            <textarea id="ingredients" name="ingredients" rows="4" required></textarea>

            <label for="image">Upload Image</label>
            <input type="file" id="image" name="image" accept="image/*">

            <button type="submit">Add Recipe</button>
        </form>
    </div>
</body>
</html>
