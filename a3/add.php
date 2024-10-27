<?php
// Start session
session_start();

// Include database connection and header
include('includes/db_connect.inc');
include('includes/header.inc');

// Ensure the user is logged in to add a pet
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle add pet form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $petname = $_POST['pet-name'];
    $description = $_POST['description'];
    $type = $_POST['pet-type'];
    $age = $_POST['age'];
    $location = $_POST['location'];
    $imageCaption = $_POST['image-caption'];
    $username = $_SESSION['username']; // Get the logged-in user's username

    // Handle image upload
    $target_dir = "images/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;

    // Check if the images/ directory exists, and create it if not
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Attempt to move the uploaded file to the images directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Prepare the statement to insert new pet record into the database
        $stmt = $conn->prepare("INSERT INTO pets (petname, description, type, age, location, image, caption, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssissss", $petname, $description, $type, $age, $location, $image_name, $imageCaption, $username);

        if ($stmt->execute()) {
            // Redirect to user page to view the added pet
            $_SESSION['msg'] = "New pet added successfully!";
            header("Location: user.php");
            exit();
        } else {
            echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        // Display an error message if the file upload fails
        echo "<p class='error-message'>Error uploading image. Please check the images/ folder permissions.</p>";
    }
}
?>

<main>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> 
    <div class="add-pet-container">
        <h1>Add a Pet</h1>
        <p>You can add a new pet here</p>

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
                <button type="reset" class="styled-button clear-button">
                    <img src="images/close_small_24dp_5F6368_FILL0_wght400_GRAD0_opsz24.png" alt="Clear Icon"> clear
                </button>
            </div>
        </form>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
<script src="js/main.js"></script>
