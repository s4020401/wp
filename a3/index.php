<?php
// Include database connection and header
include('includes/db_connect.inc');
include('includes/header.inc');
?>

<main>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="row">
            <!-- Image Carousel (using Bootstrap) -->
            <div class="col-md-6">
                <div id="carouselExampleControls" class="carousel slide mb-3" data-bs-ride="carousel"> 
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="3"></button>
                    </div>

                    <!-- The slideshow -->
                    <div class="carousel-inner bg-secondary">
                        <div class="carousel-item active">
                            <img src="images/dog3.jpeg alt="animal" class="d-block w-25 mx-auto">
                        </div>
                        <div class="carousel-item">
                            <img src="images/dog2.jpeg" alt="animal" class="d-block w-25 mx-auto">
                        </div>
                        <div class="carousel-item">
                            <img src="images/dog1.jpeg" alt="animal" class="d-block w-25 mx-auto">
                        </div>
                        <div class="carousel-item">
                            <img src="images/dog4.jpeg" alt="animal" class="d-block w-25 mx-auto">
                        </div>
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
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
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <form action="search.php" method="get">
            <input type="text" name="keyword" placeholder="I AM LOOKING FOR ..." class="search-input">
            <select name="pet-type" class="search-dropdown">
                <option value="">Select your pet type</option>
                <option value="cat">Cat</option>
                <option value="dog">Dog</option>
            </select>
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>

    <!-- About Section -->
    <div class="about-section">
        <h3>Discover Pets Victoria</h3>
        <p>PETS VICTORIA IS A DEDICATED PET ADOPTION ORGANIZATION BASED IN VICTORIA, AUSTRALIA, FOCUSED ON PROVIDING A SAFE AND LOVING ENVIRONMENT FOR PETS IN NEED. WITH A COMPASSIONATE APPROACH, PETS VICTORIA WORKS TIRELESSLY TO RESCUE, REHABILITATE, AND REHOME DOGS, CATS, AND OTHER ANIMALS. THEIR MISSION IS TO CONNECT THESE DESERVING PETS WITH CARING INDIVIDUALS AND FAMILIES, CREATING LIFELONG BONDS.</p>
    </div>
</main>

<?php
// Include footer
include('includes/footer.inc');
?>

<!-- Add Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Carousel JavaScript -->
<script>
    // Initialize Carousel manually
    var myCarousel = document.querySelector('#carouselExampleControls');
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: false, // Disable auto-sliding
        wrap: true // Enable carousel wrapping
    });

    // Manual slide control
    document.querySelector('.carousel-control-prev').addEventListener('click', function() {
        carousel.prev();
    });

    document.querySelector('.carousel-control-next').addEventListener('click', function() {
        carousel.next();
    });
</script>
