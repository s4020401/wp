<?php
// 检查服务器名称
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

// 创建连接
$conn = new mysqli($host, $user, $password, $database);

// 检测连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
