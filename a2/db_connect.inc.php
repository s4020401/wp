<?php
$servername = "localhost";
$username = "s4020401";
$password = "jackliu0165";
$dbname = "petsvictoria";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
?>
