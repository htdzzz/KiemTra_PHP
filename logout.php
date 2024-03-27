<?php
// Bắt đầu session
session_start();

// Hủy tất cả các biến session
session_unset();

// Hủy session
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập sau khi đăng xuất
header("Location: login.php");
exit();
?>
