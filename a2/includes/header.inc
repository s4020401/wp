<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Victoria</title> 
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>
    <header>
        <div class="header-container">
            <img class="about-logo-image" alt="company logo" src="images/logo.png">
            <div class="nav-container">
                <select id="nav-select" onchange="location = this.value;">
                    <option value="">Select an Option...</option>
                    <option value="index.php">Home</option>
                    <option value="gallery.php">Gallery</option>
                    <option value="pets.php">Pets</option>
                    <option value="add.php">Add More</option>
                </select>
            </div>
            <div class="search-container">
                <input type="text" placeholder="Search...">
                <button>
                    <img src="images/search_icon.png" alt="Search">
                </button>
            </div>
        </div>
    </header>
