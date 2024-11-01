<?php
// Start session
session_start();

// Include database connection and header
include('includes/db_connect.inc');
include('includes/header.inc');

// Handle logout request
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: login.php");
    exit();
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare statement using SHA() for password hashing
    $stmt = $conn->prepare("SELECT userID, username FROM users WHERE username = ? AND password = SHA(?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Login successful, set session
        $_SESSION['user_id'] = $user['userID'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['usrmsg'] = "Login successful! Welcome, " . $_SESSION['username'] . ".";

        header("Location: index.php");
        exit();
    } else {
        // Login failed, set error message
        $_SESSION['err'] = "Login unsuccessful. Please check your username and password.";
        header("Location: login.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>

<main class="login-page">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    
    <div class="login-container">
        <h1>Login</h1>
        <?php if (isset($_SESSION['err'])): ?>
            <p class="error"><?php echo $_SESSION['err']; unset($_SESSION['err']); ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit" class="styled-button">Login</button>
        </form>

        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
