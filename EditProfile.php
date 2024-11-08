<?php
session_start();
	if(!isset($_SESSION["email"])){
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
    <link rel="stylesheet" href="./CSS/forms.css">
    <link rel="shortcut icon" href="img/mylogo3.png" type="image/x-icon">
</head>

<body style="background-image: url('img/login1.png');">

    <?php
        
        $id = $_GET["id"];
        
        $con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");

        if (!$con) {
            die("Sorry, you can't connect into the database.");
        }
        
        $sql = "SELECT * FROM `user_tbl` WHERE `userID`=". $id;
        
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        
    ?>



    <section id="product1" class="section-p1">

        <a href="profile.php">
            <button type="button" class="normal" style="position: absolute; top: 20px; left: 20px;"><i class="fa-solid fa-arrow-left"></i>&nbsp&nbspBack</button>
        </a>

        <div class="wrapper">

            <div class="update-profile">
                <form method="post" action="EditHandler.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                    <h1><i class="fa-solid fa-user"></i>&nbsp;&nbsp;Edit profile</h1>
                    <br>
                    <div class="flex">
                
                        <div class="inputBox">

                            <input type="text" name="txtName" placeholder="Username *" value="<?php echo $row["name"]; ?>" class="box" required>
                            <input type="text" name="txtEmail" placeholder="Email *" value="<?php echo $row["email"]; ?>" class="box" required>
                            <input type="text" name="txtPhone" placeholder="Contact number" value="<?php echo $row["contactNumber"]; ?>" class="box">
            
                        </div>

                        <div class="inputBox">

                            <input type="text" name="txtAddress" placeholder="Address *" value="<?php echo $row["address"]; ?>" class="box" required>
                            <input type="text" name="txtPassword" placeholder="Change password *" class="box" required>
                            <input type="file" name="imageFile" placeholder="Upload an image" value="<?php echo $row["imagePath"];?>" class="box" required>

                        </div>

                    </div>

                    <button type="submit" name="btnSubmitProfile" class="normal">Save changes</button>
                </form>

            </div>
        </div>

    </section>

</body>
</html>