<?php
// Start session
session_start();

// Include database connection and header
include('includes/db_connect.inc');
include('includes/header.inc');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p class='error'>You must be logged in to view this page. <a href='login.php'>Login here</a>.</p>";
    exit();
}

// Fetch all pets uploaded by the logged-in user
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM pets WHERE username = ?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
?>

<main>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

    <div class="user-pets-container">
        <h1><?php echo htmlspecialchars($_SESSION['username']); ?>'s Collection</h1>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($pet = $result->fetch_assoc()): ?>
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

                            <!-- Edit and Delete Buttons -->
                            <div class="pet-buttons mt-3">
                                <a href="edit.php?petid=<?php echo $pet['petid']; ?>" class="btn btn-primary">Edit</a>
                                <a href="confirm.php?petid=<?php echo $pet['petid']; ?>" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>

                    <!-- Pet Details Section -->
                    <div class="col-md-8">
                        <h1><?php echo htmlspecialchars($pet['petname']); ?></h1>
                        <p class="pet-description"><?php echo htmlspecialchars($pet['description']); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No pets found. You can <a href="add.php">add a pet here</a>.</p>
        <?php endif; ?>

    </div>
</main>

<?php
include('includes/footer.inc');
$stmt->close();
$conn->close();
?>
