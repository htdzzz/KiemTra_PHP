<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include 'connect.php';

$limit = 5;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$start = ($page - 1) * $limit;

$sql = "SELECT NhanVien.Ma_NV, NhanVien.Ten_NV, NhanVien.Phai, NhanVien.Noi_Sinh, PhongBan.Ten_Phong, NhanVien.Luong FROM NhanVien INNER JOIN PhongBan ON NhanVien.Ma_Phong = PhongBan.Ma_Phong LIMIT $start, $limit";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="user-info">
            <?php echo "Xin chào, " . $_SESSION["username"] . " | Role: " . ucfirst($_SESSION["role"]); ?> | <button class="logout-btn" onclick="location.href='logout.php'">Đăng xuất</button>
        </div>
        <h2 class="info">THÔNG TIN NHÂN VIÊN</h2>
        <div class="add-button">
            <?php if ($_SESSION["role"] == "admin"): ?>
                <a href="add_employee.php"><button class="add-btn">Thêm nhân viên</button></a>
            <?php endif; ?>
        </div>
        <table border='1'>
            <tr class="first-column">
                <th>Mã Nhân Viên</th>
                <th>Tên Nhân Viên</th>
                <th>Giới Tính</th>
                <th>Nơi Sinh</th>
                <th>Tên Phòng</th>
                <th>Lương</th>
                <?php if ($_SESSION["role"] == "admin"): ?>
                    <th>Action</th>
                <?php endif; ?>
            </tr>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["Ma_NV"]; ?></td>
                        <td><?php echo $row["Ten_NV"]; ?></td>
                        <td><img src="<?php echo ($row["Phai"] == 'NU') ? 'images/woman.jpg' : 'images/man.jpg';
                         ?>" alt="<?php echo ($row["Phai"] == 'NU') ? 'Woman' : 'Man'; ?>" width="200" height="200"></td>                        
                        <td><?php echo $row["Noi_Sinh"]; ?></td>
                        <td><?php echo $row["Ten_Phong"]; ?></td>
                        <td><?php echo $row["Luong"]; ?></td>
                        <?php if ($_SESSION["role"] == "admin"): ?> 
                            <td>
                                <div class="edit-delete-wrapper">
                                    <a href="edit_employee.php?id=<?php echo $row['Ma_NV']; ?>"><img src="images/edit.jpg" alt="Sửa" width="60" height="60"></a>
                                    <a href="delete_employee.php?id=<?php echo $row['Ma_NV']; ?>"><img src="images/delete.jpg" alt="Xoá" width="60" height="60"></a>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan='6'>Không có nhân viên nào</td></tr>
            <?php endif; ?>
        </table>

        <div class="pagination">
            <?php
            if ($result) {
                $sql_count = "SELECT COUNT(*) AS total FROM NhanVien";
                $result_count = $conn->query($sql_count);
                $row_count = $result_count->fetch_assoc();
                $total_pages = ceil($row_count["total"] / $limit);

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?page=$i'>$i</a>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
