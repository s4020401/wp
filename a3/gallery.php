<?php
session_start();
include('includes/header.inc');  
include('includes/db_connect.inc');

// 获取用户选择的宠物类型
$petType = isset($_GET['type']) ? $_GET['type'] : '';

// 根据选择的类型构建 SQL 查询
$query = "SELECT petid, petname, image, type FROM pets";
if (!empty($petType)) {
    $query .= " WHERE type = ?";
}

$stmt = $conn->prepare($query);

if (!empty($petType)) {
    $stmt->bind_param("s", $petType);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<main>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> 
    <h1>Pets Victoria has a lot to offer!</h1>
    <p>
        For almost two decades, Pets Victoria has helped in creating true social change by bringing pet adoption into the mainstream. Our work has helped make a difference to the Victorian rescue community and thousands of pets in need of rescue and rehabilitation. But, until every pet is safe, respected, and loved, we all still have big, hairy work to do.
    </p>

    <!-- 居中显示的下拉选择框 -->
    <div class="text-center mb-4">
        <form action="gallery.php" method="get" class="d-inline-block">
            <label for="type">Filter by Pet Type:</label>
            <select name="type" id="type" class="form-select d-inline w-auto">
                <option value="">All Pets</option>
                <option value="dog" <?php echo $petType === 'dog' ? 'selected' : ''; ?>>Dog</option>
                <option value="cat" <?php echo $petType === 'cat' ? 'selected' : ''; ?>>Cat</option>
                <option value="rabbit" <?php echo $petType === 'rabbit' ? 'selected' : ''; ?>>Rabbit</option>
                <option value="bird" <?php echo $petType === 'bird' ? 'selected' : ''; ?>>Bird</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>

    <div class="gallery">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="gallery-item">';
                echo '<a href="details.php?id=' . $row['petid'] . '">';
                echo '<img src="images/' . $row['image'] . '" alt="' . $row['petname'] . '">';
                echo '</a>';
                echo '<div class="overlay">';
                echo '<div><a href="details.php?id=' . $row['petid'] . '"><img class="search-icon" src="images/search.png" alt="Search"> Discover more!</a></div>';
                echo '</div>';
                echo '<h3>' . htmlspecialchars($row['petname']) . ' (' . htmlspecialchars($row['type']) . ')</h3>';
                echo '</div>';
            }
        } else {
            echo '<p>No pets found in the gallery.</p>';
        }
        ?>
    </div>
</main>

<?php
include('includes/footer.inc');
$conn->close();
?>
