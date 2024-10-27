<?php
session_start();
?>

<?php 
include('includes/db_connect.inc'); // 包含数据库连接
include('includes/header.inc'); // 包含 header

// 确保数据库连接成功
if ($conn === false || $conn->connect_error) {
    die("<p class='error-message'>数据库连接失败: " . $conn->connect_error . "</p>");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 使用 SHA1() 加密密码
    $hashedPassword = sha1($password);

    // 插入用户数据到数据库
    $stmt = $conn->prepare("INSERT INTO users (username, password, reg_date) VALUES (?, ?, NOW())");
    if ($stmt === false) {
        die("<p class='error-message'>SQL 准备语句错误: " . $conn->error . "</p>");
    }

    $stmt->bind_param('ss', $username, $hashedPassword);

    if ($stmt->execute()) {
        echo "<p class='success-message'>Account registered successfully! You can <a href='login.php'>login</a> now.</p>";
    } else {
        echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<main>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> 
    <div class="register-container">
        <h2>Create Your Account</h2>
        <p>Join us to adopt your next best friend!</p>

        <form action="register.php" method="POST" class="register-form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Create a password" required>
            </div>

            <button type="submit" class="styled-button">Register</button>
        </form>

        <p class="login-link">Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</main>

<?php include('includes/footer.inc'); ?>