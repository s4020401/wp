<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Pet</title>
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>

    <header>
        <h1>Add a New Pet</h1>
    </header>

    <?php
  
    include('includes/db_connect.inc.php');

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
        $petname = $_POST['pet-name'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $caption = $_POST['image-caption'];
        $age = $_POST['age'];
        $location = $_POST['location'];
        $type = $_POST['pet-type'];

        
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
          
            $sql = "INSERT INTO pets (petname, description, image, caption, age, location, type)
                    VALUES ('$petname', '$description', '$image', '$caption', '$age', '$location', '$type')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>New pet added successfully!</p>";
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }
        } else {
            echo "<p>Error uploading image.</p>";
        }
    }
    ?>


    <main>
        <form action="add.php" method="post" enctype="multipart/form-data">
            <label for="pet-name">Pet Name:</label>
            <input type="text" id="pet-name" name="pet-name" required><br>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br>

            <label for="age">Age (in months):</label>
            <input type="number" id="age" name="age" required><br>

            <label for="type">Type:</label>
            <input type="text" id="type" name="pet-type" required><br>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required><br>

            <label for="image">Pet Image:</label>
            <input type="file" id="image" name="image" required><br>

            <label for="caption">Image Caption:</label>
            <input type="text" id="caption" name="image-caption" required><br>

            <button type="submit">Add Pet</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Pets Victoria</p>
    </footer>

</body>
</html>

