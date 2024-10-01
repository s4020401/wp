<?php
// 包含头部和数据库连接文件
include('includes/header.inc');  
include('includes/db_connect.inc');

// 查询数据库以获取宠物信息
$query = "SELECT petid, petname, image FROM pets";
$result = $conn->query($query);
?>

<main>
<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> 
    <h1>Pets Victoria has a lot to offer!</h1>
    <p class="p-text">
        For almost two decades, Pets Victoria has helped in creating true social change by bringing pet adoption into the mainstream. Our work has helped make a difference to the Victorian rescue community and thousands of pets in need of rescue and rehabilitation. But, until every pet is safe, respected, and loved, we all still have big, hairy work to do.
    </p>

    <div class="gallery">
        <?php
        // 动态加载宠物信息并显示在画廊中
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="gallery-item">';
                // 动态生成每个宠物图片的链接，使用 petid 作为查询参数
                echo '<a href="details.php?id=' . $row['petid'] . '">';
                echo '<img src="images/' . $row['image'] . '" alt="' . $row['petname'] . '">';
                echo '</a>';
                echo '<div class="overlay">';
                echo '<div> <a href="details.php?id=' . $row['petid'] . '"> <img class="search-icon" src="images/search.png" alt="Search"> Discover more!</a></div>';
                echo '</div>';
                echo '<h3>' . $row['petname'] . '</h3>';
                echo '</div>';
            }
        } else {
            echo '<p>No pets found in the gallery.</p>';
        }
        ?>
    </div>
</main>

<?php
// 包含页脚文件
include('includes/footer.inc');

// 关闭数据库连接
$conn->close();
?>
