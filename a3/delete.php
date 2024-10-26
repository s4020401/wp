<?php
// Include header and start session
include('includes/header.inc');
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include('includes/db_connect.inc');

// Handle deletion confirmation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_delete']) && isset($_POST['petid'])) {
    $petid = $_POST['petid'];
    $username = $_SESSION['username'];

    // Delete pet from database
    $stmt = $conn->prepare("DELETE FROM pets WHERE petid = ? AND username = ?");
    $stmt->bind_param('is', $petid, $username);

    if ($stmt->execute()) {
        echo "<p class='success-message'>Pet deleted successfully!</p>";
    } else {
        echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

// Get pet details for confirmation
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
    <h1>Delete Pet</h1>
    <p>Are you sure you want to delete the pet "<?php echo htmlspecialchars($pet['petname']); ?>"?</p>

    <form action="delete.php" method="POST">
        <input type="hidden" name="petid" value="<?php echo $pet['petid']; ?>">
        <button type="submit" name="confirm_delete" value="yes">Yes, delete it</button>
        <a href="user.php">Cancel</a>
    </form>
</main>

<?php include('includes/footer.inc'); ?>
