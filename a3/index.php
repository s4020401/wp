<?php
session_start();
?>

<?php
// Include database connection and header
include('includes/db_connect.inc');
include('includes/header.inc');
?>

<main class="page">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="row">
            <!-- Image Carousel (using Bootstrap) -->
            <div class="col-md-6">
                <div id="demo" class="carousel slide mb-3" data-bs-ride="carousel" data-bs-interval="3000">
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                    </div>

                    <!-- The slideshow -->
                    <div class="carousel-inner bg-secondary">
                        <div class="carousel-item active">
                            <img src="images/dog3.jpeg" alt="animal" class="d-block w-100 mx-auto">
                        </div>
                        <div class="carousel-item">
                            <img src="images/main.jpg" alt="animal" class="d-block w-100 mx-auto">
                        </div>
                        <div class="carousel-item">
                            <img src="images/dog1.jpeg" alt="animal" class="d-block w-100 mx-auto">
                        </div>
                        <div class="carousel-item">
                            <img src="images/dog4.jpeg" alt="animal" class="d-block w-100 mx-auto">
                        </div>
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                         <span class="carousel-control-next-icon"></span>
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
                <p>Pets Victoria is a dedicated pet adoption organization based in Victoria, Australia, focused on providing a safe and loving environment for pets in need. With a compassionate approach, Pets Victoria works tirelessly to help residents foster, care, and adopt animals. Their mission is to connect their residents with caring individuals and families, creating lifelong bonds. The organization offers a range of services, including adoption counseling, pet education, and community support programs, all aimed at promoting responsible pet ownership and reducing the number of homeless animals.</p>
            </div>
    </div>

</main>

<?php
// Include footer
include('includes/footer.inc');
?>

