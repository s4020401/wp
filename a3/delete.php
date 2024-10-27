<?php
// Start session
session_start();

// Include database connection and header
include('includes/db_connect.inc');
include('includes/header.inc');

// Handle the delete confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm-delete'])) {
    $petid = $_POST['petid'];

    // Prepare and execute delete statement
    $stmt = $conn->prepare("DELETE FROM pets WHERE petid = ?");
    $stmt->bind_param("i", $petid);

    if ($stmt->execute()) {
        $_SESSION['usrmsg'] = "Pet record deleted successfully.";
    } else {
        $_SESSION['err'] = "Failed to delete pet record.";
    }

    // Redirect back to user collection
    header("Location: user.php");
    exit();
}

// Check if pet ID is provided in URL
if (!isset($_GET['petid'])) {
    echo "<p class='error'>No pet ID provided. <a href='gallery.php'>Go back to gallery</a>.</p>";
    exit();
}

// Fetch pet details from the database
$petid = $_GET['petid'];
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

    <div class="pet-detail-container text-center">
        <h1>Are you sure you want to delete this record?</h1>

        <!-- Pet Image -->
        <div class="pet-image-wrapper my-4">
            <img class="pet-image img-fluid" src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['caption']); ?>">
        </div>

        <!-- Pet Name -->
        <h2><?php echo htmlspecialchars($pet['petname']); ?></h2>

        <!-- Confirm and Cancel Buttons -->
        <div class="confirm-buttons mt-4">
            <form action="delete.php" method="post">
                <input type="hidden" name="petid" value="<?php echo $petid; ?>">
                <button type="submit" name="confirm-delete" class="btn btn-danger">Delete</button>
                <a href="user.php" class="btn btn-primary">Cancel</a>
            </form>
        </div>
    </div>
</main>

<?php
include('includes/footer.inc');
$stmt->close();
$conn->close();
?>
