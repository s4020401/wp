<?php
include('includes/db_connect.inc');
include('includes/header.inc');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Pet</title>
</head>
<body class="index">
    <main>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> 
        <div class="add-pet-container">
            <h1>Add a pet</h1>
            <p>You can add a new pet here</p>

            <?php
            include('includes/db_connect.inc');
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

     
            <form action="add.php" method="post" enctype="multipart/form-data">
                <label for="pet-name">Pet Name *</label>
                <input type="text" id="pet-name" name="pet-name" placeholder="Provide a name for the pet" required>

                <label for="pet-type">Type *</label>
                <select id="pet-type" name="pet-type" required>
                    <option value="" disabled selected>--Choose an option--</option>
                    <option value="cat">Cat</option>
                    <option value="dog">Dog</option>
                </select>

                <label for="description">Description *</label>
                <textarea id="description" name="description" placeholder="Describe the pet briefly" required></textarea>

                <label for="image">Select an Image: *</label>
                <input type="file" id="image" name="image" accept="image/*" required>
                <small>Max image size: 500px</small>

                <label for="image-caption">Image Caption: *</label>
                <input type="text" id="image-caption" name="image-caption" placeholder="Describe the image in one word" required>

                <label for="age">Age (months): *</label>
                <input type="number" id="age" name="age" placeholder="Age of a pet in months" required>

                <label for="location">Location: *</label>
                <input type="text" id="location" name="location" placeholder="Location of the pet" required>

                <div class="form-buttons">
                    <button type="submit" class="styled-button">
                        <img src="images/add_task_24dp_5F6368_FILL0_wght400_GRAD0_opsz24.png" alt="Submit Icon"> submit
                    </button>
                    <button type="reset" class="styled-button outlined-button">
                        <img src="images/close_small_24dp_5F6368_FILL0_wght400_GRAD0_opsz24.png" alt="Clear Icon"> clear
                    </button>
                </div>
            </form>
        </div>
    </main>

    <?php include('includes/footer.inc'); ?>
   
    <script src="js/main.js"></script>
</body>
</html>
