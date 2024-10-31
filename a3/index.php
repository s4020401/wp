<?php
session_start();
include('includes/db_connect.inc'); 
include('includes/header.inc');// 包含数据库连接文件

// 默认图片数组
$defaultImages = [
    ["image" => "dog3.jpeg", "caption" => "Default Image 1"],
    ["image" => "dog2.jpeg", "caption" => "Default Image 2"],
    ["image" => "dog1.jpeg", "caption" => "Default Image 3"],
    ["image" => "dog4.jpeg", "caption" => "Default Image 4"]
];

// 从数据库中获取 gallery.php 中的图片
$query = "SELECT image, petname AS caption FROM pets";
$result = $conn->query($query);

$additionalImages = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $additionalImages[] = $row;
    }
}

// 将默认图片和数据库中的图片合并
$images = array_merge($defaultImages, $additionalImages);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pets Victoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>

<main class="page">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="row">
            <div class="col-md-6">
                <div id="galleryCarousel" class="carousel slide mb-3" data-bs-ride="carousel" data-bs-interval="3000">
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <?php foreach ($images as $index => $image): ?>
                            <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="<?php echo $index; ?>" <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?>></button>
                        <?php endforeach; ?>
                    </div>

                    <!-- 幻灯片内容 -->
                    <div class="carousel-inner">
                        <?php foreach ($images as $index => $image): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <img src="images/<?php echo $image['image']; ?>" alt="<?php echo htmlspecialchars($image['caption']); ?>" class="d-block w-100" style="height: 450px;">
                                <div class="carousel-caption d-none d-md-block">
                                    <p><?php echo htmlspecialchars($image['caption']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
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
            <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 text-left">
                <h3>Discover Pets Victoria</h3>
                <p>
                PETS VICTORIA IS A DEDICATED PET ADOPTION ORGANIZATION BASED IN VICTORIA, AUSTRALIA, FOCUSED ON PROVIDING A SAFE AND LOVING ENVIRONMENT FOR PETS IN NEED. WITH A COMPASSIONATE APPROACH, PETS VICTORIA WORKS TIRELESSLY TO RESCUE, REHABILITATE, AND REHOME DOGS, CATS, AND OTHER ANIMALS. THEIR MISSION IS TO CONNECT THEIR DESERVING PETS WITH CARING INDIVIDUALS AND FAMILIES, CREATING LIFELONG BONDS. THE ORGANIZATION OFFERS A RANGE OF SERVICES, INCLUDING ADOPTION COUNSELING, PET EDUCATION, AND COMMUNITY SUPPORT PROGRAMS, ALL AIMED AT PROMOTING RESPONSIBLE PET OWNERSHIP AND REDUCING THE NUMBER OF HOMELESS ANIMALS.
                </p>
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
</body>
</html>



