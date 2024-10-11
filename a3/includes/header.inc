<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Add Bootstrap 5 JavaScript (added at the bottom of index.php) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Victoria</title> 
    <link rel="stylesheet" href="css/style.css">
    <script>
        function handleNavSelection() {
            var selectElement = document.getElementById('nav-select');
            var selectedValue = selectElement.value;
            if (selectedValue) {
                window.location.href = selectedValue;
            }
        }
    </script>
</head>
<body>
    <header>
        <div class="header-container">
            <!-- Logo Section -->
            <div class="logo-container">
                <img class="about-logo-image" alt="company logo" src="images/logo.png">
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


