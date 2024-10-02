<?php
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "petsvictoria";
} else {
    $host = "talsprddb02.int.its.rmit.edu.au";
    $user = "s4020401";
    $password = "jackliu0165";
    $database = "s4020401";
}
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
?>

