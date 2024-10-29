<?php 
session_start();
?>

<?php
// Include database connection and header
include('includes/db_connect.inc');
include('includes/header.inc');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pets Victoria</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>

<main class="page">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="row">
            <!-- Image Carousel (using Bootstrap) -->
            <div class="col-md-6">
                <div id="demo" class="carousel slide mb-3" data-bs-ride="carousel" data-bs-interval="3000">
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active" aria-current="true"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                    </div>

                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/dog3.jpeg" alt="animal" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="images/dog2.jpeg" alt="animal" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="images/dog1.jpeg" alt="animal" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="images/dog4.jpeg" alt="animal" class="d-block w-100">
                        </div>
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Heading Text -->
            <div class="col-md-6 hero-text">
                <h1 class="hero-title">PETS VICTORIA</h1>
                <h2 class="hero-subtitle">WELCOME TO PET ADOPTION</h2>
            </div>
        </div>

        <!-- Search Section -->
        <div class="row search-section mt-5">
            <div class="col-md-8 offset-md-2 text-center">
                <form action="search.php" method="get" class="search-form">
                    <input type="text" name="keyword" class="form-control d-inline-block w-50" placeholder="I am looking for..." required>
                    <select name="type" class="form-control d-inline-block w-25">
                        <option value="">Select your pet type</option>
                        <option value="cat">Cat</option>
                        <option value="dog">Dog</option>
                        <option value="rabbit">Rabbit</option>
                        <option value="bird">Bird</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        <!-- Introduction Section -->
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2 text-center">
                <h3>Discover Pets Victoria</h3>
                <p>Pets Victoria is a dedicated pet adoption organization based in Victoria, Australia, focused on providing a safe and loving environment for pets in need...</p>
            </div>
        </div>
    </div>
</main>

<?php
// Include footer
include('includes/footer.inc');
?>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="js folder/main.js"></script>

</body>
</html>



