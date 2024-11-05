<?php
$con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
if (!$con) {
    die("Connection failed");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `recipe_tbl` WHERE `recipeID`=$id";
    $result = mysqli_query($con, $sql);
    $recipe = mysqli_fetch_assoc($result);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipeName = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $imagePath = $recipe['imagePath']; // Keep the old image

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $imagePath = $target_file; // Update with new image
        }
    }
    $sql = "UPDATE `recipe_tbl` SET `recipeName`='$recipeName', `description`='$description', `ingredients`='$ingredients', `instructions`='$instructions', `imagePath`='$imagePath' WHERE `recipeID`=$id";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Recipe updated');window.location.href='admin.php#recipes';</script>";
    }
}
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 50%;
        margin: 50px auto;
        background: white;
        padding: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }
    h2 {
        text-align: center;
        color: #333;
    }
    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }
    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    input[type="file"] {
        margin: 10px 0;
    }
    button {
        display: inline-block;
        background-color: #3a2f8c;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
        margin-top: 10px;
    }
    .delete-btn {
        background-color: #dc3545;
    }
    .delete-btn:hover {
        background-color: #c82333;
    }
</style>

<div class="container">
    <h2>Edit Recipe</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $recipe['recipeName']; ?>"><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo $recipe['description']; ?></textarea><br>

        <label for="ingredients">Ingredients:</label>
        <textarea id="ingredients" name="ingredients"><?php echo $recipe['ingredients']; ?></textarea><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image"><br>

        <button type="submit">Update Recipe</button>
    </form>
</div>
