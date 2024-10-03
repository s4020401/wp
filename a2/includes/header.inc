<!DOCTYPE html>
<html lang="en">
<head>
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
            <img class="about-logo-image" alt="company logo" src="images/logo.png">
            
            <div class="nav-container">
            <?php include('nav.inc'); ?>
            </div>
            
            <div class="search-container">
                <input type="text" placeholder="Search...">
                <button>
                    <img src="images/search_24dp_5F6368_FILL0_wght400_GRAD0_opsz24.png" alt="Search">
                </button>
            </div>
        </div>
    </header>
