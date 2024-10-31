<?php
session_start();
include('includes/header.inc');

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include('includes/db_connect.inc');

// Handle form submission to update pet details
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['petid'])) {
    $petid = $_POST['petid'];
    $petname = $_POST['pet-name'];
    $description = $_POST['description'];
    $age = $_POST['age'];
    $location = $_POST['location'];
    $type = $_POST['pet-type'];
    $imageCaption = $_POST['image-caption'];
    $username = $_SESSION['username'];

    // Set the default image name to the existing image
    $image_name = $_POST['existing-image'];

    // Check if a new image file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "images/";
        $new_image_name = basename($_FILES["image"]["name"]); // New image file name
        $target_file = $target_dir . $new_image_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_name = $new_image_name; // Set image_name to new file name

            // Delete old image file if it exists
            if (!empty($_POST['existing-image']) && file_exists($target_dir . $_POST['existing-image'])) {
                unlink($target_dir . $_POST['existing-image']);
            }
        } else {
            echo "<p class='error-message'>Error uploading new image. Using existing image.</p>";
        }
    }

    // Update pet details in the database
    $stmt = $conn->prepare("UPDATE pets SET petname = ?, description = ?, type = ?, age = ?, location = ?, image = ?, caption = ? WHERE petid = ? AND username = ?");
    $stmt->bind_param('sssisisss', $petname, $description, $type, $age, $location, $image_name, $imageCaption, $petid, $username);

    if ($stmt->execute()) {
        // Success: redirect to user page
        $_SESSION['msg'] = "Pet updated successfully!";
        header("Location: user.php");
        exit();
    } else {
        echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

// Get pet details for editing
if (isset($_GET['petid'])) {
    $petid = $_GET['petid'];
    $username = $_SESSION['username'];

    // Fetch pet details from database
    $stmt = $conn->prepare("SELECT * FROM pets WHERE petid = ? AND username = ?");
    $stmt->bind_param('is', $petid, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $pet = $result->fetch_assoc();
    } else {
        echo "<p class='error-message'>Pet not found or access denied.</p>";
        exit();
    }

    $stmt->close();
}
?>

<main>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <div class="edit-pet-container">
        <h1>Edit Pet</h1>
        <p>You can edit the pet details here</p>

        <form action="edit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="petid" value="<?php echo $pet['petid']; ?>">
            <input type="hidden" name="existing-image" value="<?php echo htmlspecialchars($pet['image']); ?>">

            <div class="form-group">
                <label for="pet-name">Pet Name *</label>
                <input type="text" id="pet-name" name="pet-name" value="<?php echo htmlspecialchars($pet['petname']); ?>" required>
            </div>

            <div class="form-group">
                <label for="pet-type">Type *</label>
                <select id="pet-type" name="pet-type" required>
                    <option value="" disabled>--Choose an option--</option>
                    <option value="cat" <?php if ($pet['type'] == 'cat') echo 'selected'; ?>>Cat</option>
                    <option value="dog" <?php if ($pet['type'] == 'dog') echo 'selected'; ?>>Dog</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($pet['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="image">Select an Image:</label>
                <input type="file" id="image" name="image" accept="image/*">
                <small>Max image size: 500px</small>
                <div class="current-image">
                    <p>Current Image:</p>
                    <?php if (!empty($pet['image'])): ?>
                        <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="Current Image" style="max-width: 200px; max-height: 200px;">
                    <?php else: ?>
                        <p>No image available.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="image-caption">Image Caption: *</label>
                <input type="text" id="image-caption" name="image-caption" value="<?php echo htmlspecialchars($pet['caption']); ?>" required>
            </div>

            <div class="form-group">
                <label for="age">Age (months): *</label>
                <input type="number" id="age" name="age" value="<?php echo $pet['age']; ?>" required>
            </div>

            <div class="form-group">
                <label for="location">Location: *</label>
                <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($pet['location']); ?>" required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="styled-button">
                    <img src="images/add_task_24dp_5F6368_FILL0_wght400_GRAD0_opsz24.png" alt="Submit Icon"> Update
                </button>
                <button type="reset" class="styled-button clear-button">
                    <img src="images/close_small_24dp_5F6368_FILL0_wght400_GRAD0_opsz24.png" alt="Clear Icon"> Clear
                </button>
            </div>
        </form>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
<script src="js/main.js"></script>
