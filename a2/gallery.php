<?php
include('includes/header.inc');
include('includes/nav.inc');
include('includes/db_connect.inc');

$query = "SELECT petid, image, caption FROM pets";
$result = $conn->query($query);

echo '<div class="gallery">';
while ($row = $result->fetch_assoc()) {
    echo "<div class='gallery-item'>
            <a href='details.php?id={$row['petid']}'>
                <img src='images/{$row['image']}' alt='{$row['caption']}'>
            </a>
            <h3>{$row['caption']}</h3>
          </div>";
}
echo '</div>';

$conn->close();
include('includes/footer.inc');
?>
