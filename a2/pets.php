<?php
include('includes/hearder.inc.php');
include('includes/nav.inc.php');
include('includes/db_connect.inc.php');

$query = "SELECT petid, petname, age, type, location FROM pets";
$result = $conn->query($query);

echo '<table>';
echo '<tr><th>Name</th><th>Type</th><th>Age</th><th>Location</th></tr>';

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td><a href='details.php?id={$row['petid']}'>{$row['petname']}</a></td>
            <td>{$row['type']}</td>
            <td>{$row['age']} months</td>
            <td>{$row['location']}</td>
          </tr>";
}
echo '</table>';

$conn->close();
include('includes/footer.inc');
?>
