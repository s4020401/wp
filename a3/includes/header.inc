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
                <input type="text" placeholder="Search...">
                <button>
                    <img src="images/search_24dp_5F6368_FILL0_wght400_GRAD0_opsz24.png" alt="Search">
                </button>
            </div>
        </div>
    </header>
</body>
</html>



