<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM NhanVien WHERE Ma_NV='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $ma_nv = $row['Ma_NV'];
        $ten_nv = $row['Ten_NV'];
        $phai = $row['Phai'];
        $noi_sinh = $row['Noi_Sinh'];
        $ma_phong = $row['Ma_Phong'];
        $luong = $row['Luong'];
    } else {
        echo "Không tìm thấy nhân viên";
        exit();
    }
} else {
    echo "Yêu cầu không hợp lệ";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin nhân viên</title>
    <link rel="stylesheet" href="css/edit_employee.css">
</head>
<body>
    <div class="container">
        <h2 class="title">Sửa thông tin nhân viên</h2>
        <form action="update_employee.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="ma_nv">Mã Nhân Viên:</label>
                <input type="text" id="ma_nv" name="ma_nv" value="<?php echo $ma_nv; ?>" required>
            </div>
            <div class="form-group">
                <label for="ten_nv">Tên Nhân Viên:</label>
                <input type="text" id="ten_nv" name="ten_nv" value="<?php echo $ten_nv; ?>" required>
            </div>
            <div class="form-group">
                <label for="phai">Giới Tính:</label>
                <input type="text" id="phai" name="phai" value="<?php echo $phai; ?>" required>
            </div>
            <div class="form-group">
                <label for="noi_sinh">Nơi Sinh:</label>
                <input type="text" id="noi_sinh" name="noi_sinh" value="<?php echo $noi_sinh; ?>" required>
            </div>
            <div class="form-group">
                <label for="ma_phong">Mã Phòng:</label>
                <input type="text" id="ma_phong" name="ma_phong" value="<?php echo $ma_phong; ?>" required>
            </div>
            <div class="form-group">
                <label for="luong">Lương:</label>
                <input type="text" id="luong" name="luong" value="<?php echo $luong; ?>" required>
            </div>
            <div class="form-group text-center">
                <input type="submit" value="Cập nhật">
            </div>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>