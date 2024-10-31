<?php
// Start session
session_start();

// Include database connection and header
include('includes/db_connect.inc');
include('includes/header.inc');

// Check if pet ID is provided in URL
if (!isset($_GET['id'])) {
    echo "<p class='error'>No pet ID provided. <a href='gallery.php'>Go back to gallery</a>.</p>";
    exit();
}

// Fetch pet details from the database
$petid = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM pets WHERE petid = ?");
$stmt->bind_param("i", $petid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<p class='error'>Pet not found. <a href='gallery.php'>Go back to gallery</a>.</p>";
    exit();
}

$pet = $result->fetch_assoc();
?>

<main>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

    <div class="pet-detail-container">
        <div class="row pet-row mb-5 align-items-center">
            <!-- Pet Image Section -->
            <div class="col-md-4">
                <div class="pet-image-wrapper text-center">
                    <img class="pet-image img-fluid" src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['caption']); ?>">

                    <!-- Pet Info Icons below image -->
                    <div class="pet-info-icons mt-3 d-flex justify-content-around">
                        <div class="icon-detail">
                            <img src="images/alarm-clock.png" class="icon-small" alt="Age">
                            <p><?php echo htmlspecialchars($pet['age']); ?> years</p>
                        </div>
                        <div class="icon-detail">
                            <img src="images/favicon.png" class="icon-small" alt="Type">
                            <p><?php echo ucfirst(htmlspecialchars($pet['type'])); ?></p>
                        </div>
                        <div class="icon-detail">
                            <img src="images/map-pin.png" class="icon-small" alt="Location">
                            <p><?php echo htmlspecialchars($pet['location']); ?></p>
                        </div>
                    </div>

                    <!-- Edit and Delete Buttons for Logged-in Users -->
                    <?php if (isset($_SESSION['username'])): ?>
                        <div class="pet-buttons mt-3">
                            <a href="edit.php?petid=<?php echo $pet['petid']; ?>" class="btn btn-primary">Edit</a>
                            <a href="delete.php?petid=<?php echo $pet['petid']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this pet?');">Delete</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Pet Details Section -->
            <div class="col-md-8">
                <h1><?php echo htmlspecialchars($pet['petname']); ?></h1>
                <p class="pet-description"><?php echo htmlspecialchars($pet['description']); ?></p>
            </div>
        </div>
    </div>
</main>

<?php
include('includes/footer.inc');
$stmt->close();
$conn->close();
?>
