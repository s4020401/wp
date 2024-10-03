<?php
include('includes/db_connect.inc');
include('includes/header.inc');
?>

<main>
<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> 
    <div class="pet-info-container">
        <h1>Discover Pets Victoria</h1>
        <p>PETS VICTORIA IS A DEDICATED PET ADOPTION ORGANIZATION BASED IN VICTORIA, AUSTRALIA, FOCUSED ON PROVIDING A SAFE AND LOVING ENVIRONMENT FOR PETS IN NEED. WITH A COMPASSIONATE APPROACH, PETS VICTORIA WORKS TIRELESSLY TO RESCUE, REHABILITATE, AND REHOME DOGS, CATS, AND OTHER ANIMALS. THEIR MISSION IS TO CONNECT THESE DESERVING PETS WITH CARING INDIVIDUALS AND FAMILIES, CREATING LIFELONG BONDS. THE ORGANIZATION OFFERS A RANGE OF SERVICES, INCLUDING ADOPTION COUNSELING, PETEDUCATION, AND COMMUNITY SUPPORT PROGRAMS, ALL AIMED AT PROMOTING RESPONSIBLE PET OWNERSHIP AND REDUCING THE NUMBER OF HOMELESS ANIMALS.</p>
    </div>

    <div class="pet-display-container">
        <div class="pet-image-container">
            <img src="images/pets.jpeg" alt="Running dogs and cats" class="pet-image">
        </div>

        <div class="pet-table-container">
            <table>
                <thead>
                    <tr>
                        <th>Pet</th>
                        <th>Type</th>
                        <th>Age</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
               
                    $query = "SELECT petid, petname, type, age, location FROM pets";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><a href='details.php?id=" . $row['petid'] . "'>" . $row['petname'] . "</a></td>";
                            echo "<td>" . $row['type'] . "</td>";
                            echo "<td>" . $row['age'] . " months</td>";
                            echo "<td>" . $row['location'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No pets found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php

include('includes/footer.inc');
$conn->close();
?>
