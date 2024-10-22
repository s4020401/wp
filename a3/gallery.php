<?php
session_start();
?>

<?php

include('includes/header.inc');  
include('includes/db_connect.inc');


$query = "SELECT petid, petname, image FROM pets";
$result = $conn->query($query);
?>

<main>
<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> 
    <h1>Pets Victoria has a lot to offer!</h1>
    <p1>
        For almost two decades, Pets Victoria has helped in creating true social change by bringing pet adoption into the mainstream. Our work has helped make a difference to the Victorian rescue community and thousands of pets in need of rescue and rehabilitation. But, until every pet is safe, respected, and loved, we all still have big, hairy work to do.
    </p1>

    <div class="gallery">
        <?php
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="gallery-item">';
                
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

include('includes/footer.inc');


$conn->close();
?>
