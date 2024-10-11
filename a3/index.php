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
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        // 查询最新的4个宠物信息
                        $sql = "SELECT * FROM pets ORDER BY petid DESC LIMIT 4";
                        $result = $conn->query($sql);
                        $active = "active"; // 将第一项设为 active
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="carousel-item ' . $active . '">';
                            echo '<img src="images/' . $row['image'] . '" class="d-block w-100" alt="' . $row['petname'] . '">';
                            echo '</div>';
                            $active = ""; // 只有第一个项目有 active 类
                        }
                        ?>
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
                <!-- Add more options dynamically if needed -->
            </select>
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>

    <!-- About Section -->
    <div class="about-section">
        <h3>Discover Pets Victoria</h3>
        <p>PETS VICTORIA IS A DEDICATED PET ADOPTION ORGANIZATION BASED IN VICTORIA, AUSTRALIA, FOCUSED ON PROVIDING A SAFE AND LOVING ENVIRONMENT FOR PETS IN NEED. WITH A COMPASSIONATE APPROACH, PETS VICTORIA WORKS TIRELESSLY TO RESCUE, REHABILITATE, AND REHOME DOGS, CATS, AND OTHER ANIMALS. THEIR MISSION IS TO CONNECT THESE DESERVING PETS WITH CARING INDIVIDUALS AND FAMILIES, CREATING LIFELONG BONDS. THE ORGANIZATION OFFERS A RANGE OF SERVICES, INCLUDING ADOPTION COUNSELING, PET EDUCATION, AND COMMUNITY SUPPORT PROGRAMS, ALL AIMED AT PROMOTING RESPONSIBLE PET OWNERSHIP AND REDUCING THE NUMBER OF HOMELESS ANIMALS.</p>
    </div>
</main>

<?php
// Include footer
include('includes/footer.inc');
?>

<!-- Add Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
