<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Add a Pet</title>
</head>
<body class="index">
    <header>
        <div class="header-container">
            <img class="about-logo-image" alt="company logo" src="images/logo.png">
            <div class="nav-container">
                <select id="nav-select">
                    <option value="">Select an option...</option>
                    <option value="index.html">Home</option>
                    <option value="gallery.html">Gallery</option>
                    <option value="pets.html">Pets</option>
                    <option value="add.php">Add</option> 
                </select>
            </div>
            <div class="search-container">
                <input type="text" placeholder="Search...">
                <button>
                    <img src="images/search.png" alt="Search"> 
                </button>
            </div>
        </div>
    </header>

    <main>
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
                        <img src="images/close.png" alt="Clear Icon"> clear
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="footer-whole">
        <div class="footer-container">
            <p>&copy; 2024 Pets Victoria</p>
        </div>
    </footer>
   
    <script src="js/main.js"></script>
</body>
</html>

