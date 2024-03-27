<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên</title>
    <link rel="stylesheet" href="css/add_employee.css">
</head>
<body>
    <div class="container">
        <div class="user-info">
            <?php echo "Xin chào, " . $_SESSION["username"] . " | Role: " . ucfirst($_SESSION["role"]); ?> | <button class="logout-btn" onclick="location.href='logout.php'">Đăng xuất</button>
        </div>
        <h2 class="center info">THÊM NHÂN VIÊN MỚI</h2>
        <div class="form-wrapper">
            <form action="process_add_employee.php" method="post">
                <label for="ma_nv">Mã Nhân Viên:</label>
                <input type="text" id="ma_nv" name="ma_nv" required><br>

                <label for="ten_nv">Tên Nhân Viên:</label>
                <input type="text" id="ten_nv" name="ten_nv" required><br>

                <label for="phai">Giới Tính:</label>
                <input type="text" id="phai" name="phai" required><br>

                <label for="noi_sinh">Nơi Sinh:</label>
                <input type="text" id="noi_sinh" name="noi_sinh" required><br>

                <label for="ma_phong">Mã Phòng:</label>
                <input type="text" id="ma_phong" name="ma_phong" required><br>

                <label for="luong">Lương:</label>
                <input type="number" id="luong" name="luong" required><br>

                <input type="submit" value="Thêm nhân viên">
            </form>
        </div>
    </div>
</body>
</html>
