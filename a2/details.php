<?php
include('includes/db_connect.inc');
include('includes/header.inc');


$petid = $_GET['id'];
$result = $conn->query("SELECT * FROM pets WHERE petid=$petid");
$pet = $result->fetch_assoc();
?>

<main>
<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> 

    <div class="pet-detail-container">
        <!-- Pet Image -->
        <div class="pet-image-wrapper">
            <img class="pet-image" src="images/<?php echo $pet['image']; ?>" alt="<?php echo $pet['caption']; ?>">
        </div>

        <!-- Pet Info -->
        <div class="pet-info">
            <div class="icon-detail">
                <img src="images/alarm-clock.png" class="icon-small" alt="Age">
                <p><?php echo $pet['age']; ?> months</p>
            </div>
            <div class="icon-detail">
                <img src="images/favicon.png" class="icon-small" alt="Type">
                <p><?php echo ucfirst($pet['type']); ?></p>
            </div>
            <div class="icon-detail">
                <img src="images/map-pin.png" class="icon-small" alt="Location">
                <p><?php echo $pet['location']; ?></p>
            </div>
        </div>

        <!-- Pet Name and Description -->
        <h4><?php echo $pet['petname']; ?></h4>
        <p class="pet-description"><?php echo $pet['description']; ?></p>
    </div>
</main>

<?php include('includes/footer.inc'); ?>
<script src="js/main.js"></script>
