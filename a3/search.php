<?php
session_start();
include('includes/db_connect.inc'); 

// 获取用户输入
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$petType = isset($_GET['type']) ? $_GET['type'] : '';

// 创建查询
$sql = "SELECT * FROM pets WHERE 1=1";
if (!empty($keyword)) {
    $sql .= " AND (petname LIKE ? OR description LIKE ?)";
}
if (!empty($petType)) {
    $sql .= " AND type = ?";
}

// 预处理查询
$stmt = $conn->prepare($sql);
if (!empty($keyword) && !empty($petType)) {
    $searchTerm = '%' . $keyword . '%';
    $stmt->bind_param('sss', $searchTerm, $searchTerm, $petType);
} elseif (!empty($keyword)) {
    $searchTerm = '%' . $keyword . '%';
    $stmt->bind_param('ss', $searchTerm, $searchTerm);
} elseif (!empty($petType)) {
    $stmt->bind_param('s', $petType);
}

// 执行查询
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Search Results - Pets Victoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/search.css?v=<?php echo time(); ?>"> <!-- 引入独立的CSS文件 -->
</head>
<body>

<?php include('includes/header.inc'); ?>

<main class="page">
    <div class="container mt-5">
        <h1 class="text-center search-title">Search Results</h1>
        <p class="text-center search-info">Showing results for: <strong><?php echo htmlspecialchars($keyword); ?></strong></p>

        <div class="gallery">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="gallery-item">
                        <a href="details.php?id=<?php echo $row['petid']; ?>">
                            <img src="images/<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['petname']); ?>" class="d-block w-100">
                            <div class="overlay">
                                <div class="overlay-text">
                                    <img class="search-icon" src="images/search.png" alt="Search Icon"> Discover more!
                                </div>
                            </div>
                        </a>
                        <div class="text-container">
                            <h3><?php echo htmlspecialchars($row['petname']); ?> (<?php echo htmlspecialchars($row['type']); ?>)</h3>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center no-results">No pets found matching your search criteria.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include('includes/footer.inc'); ?>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// 关闭数据库连接
$conn->close();
?>
