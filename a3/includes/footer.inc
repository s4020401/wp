<?php
// Footer content
?>
<footer class="site-footer">
    <div class="footer-container">
        <p>&copy; Copyright 2024. zekun liu s4020401 All Rights Reserved | Designed for Pets Victoria</p>

        <?php if (isset($_SESSION['username'])): ?>
            <p class="user-link">
                <a href="user.php"><?php echo $_SESSION['username']; ?>'s Pets</a>
            </p>
        <?php else: ?>
            <p class="user-link">Not logged in. <a href="login.php">Login here</a>.</p>
        <?php endif; ?>
    </div>
</footer>
