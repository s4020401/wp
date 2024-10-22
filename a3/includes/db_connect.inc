<?php
// 检查服务器名称来设置数据库连接参数
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $host = "localhost";
    $username = "root"; // 注意这里的变量名是 $username 而不是 $user
    $password = "";
    $database = "pets"; // 数据库名称为 "pets"
} else {
    $host = "talsprddb02.int.its.rmit.edu.au";
    $username = "s4020401";
    $password = "jackliu0165";
    $database = "s4020401";
}

// 使用 mysqli 创建连接
$conn = new mysqli($host, $username, $password, $database);

// 检测连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 设置字符集为 utf8mb4，确保支持特殊字符
if (!$conn->set_charset("utf8mb4")) {
    printf("Error loading character set utf8mb4: %s\n", $conn->error);
    exit();
}

?>
