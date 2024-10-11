<?php
include('includes/db_connect.inc');

// 获取用户输入
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$petType = isset($_GET['pet-type']) ? $_GET['pet-type'] : '';

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

// 显示结果
if ($result->num_rows > 0) {
    echo "<h2>Search Results:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><a href='details.php?id=" . $row['petid'] . "'>" . $row['petname'] . " (" . $row['type'] . ")</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No pets found matching your search criteria.</p>";
}

$conn->close();
?>
