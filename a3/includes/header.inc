<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Victoria</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <!-- Logo Section -->
            <div class="logo-container">
                <a href="index.php"><img class="about-logo-image" alt="company logo" src="images/logo.png"></a>
            </div>

            <!-- Navigation Menu (from nav.inc) -->
            <div class="nav-container">
                <?php include('includes/nav.inc'); ?>
            </div>

            <!-- Search Section -->
            <div class="search-container">
                <form action="search.php" method="get" style="display: flex;">
                    <input type="text" name="keyword" placeholder="Search..." class="form-control" required>
                    <button type="submit" class="btn btn-outline-secondary">
                        <img src="images/search_24dp_5F6368_FILL0_wght400_GRAD0_opsz24.png" alt="Search">
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Display login success message if it exists -->
        <?php if (isset($_SESSION['usrmsg'])): ?>
            <div class="alert alert-success alert-dismissible fade show text-center" 
                 style="background-color: #e0f7fa; color: #00695c; border: none; border-radius: 0; margin: 0; padding: 10px;" 
                 role="alert">
                <?php echo $_SESSION['usrmsg']; unset($_SESSION['usrmsg']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </header>
</body>
</html>

