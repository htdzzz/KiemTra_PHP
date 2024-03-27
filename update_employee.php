<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên Mới</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .success-message {
            color: green;
            font-weight: bold;
        }

        .error-message {
            color: red;
            font-weight: bold;
        }

        .button-wrapper {
            margin-top: 20px;
        }

        .button-wrapper button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .button-wrapper button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        session_start();

        include 'connect.php';

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION["username"])) {
            header("Location: login.php");
            exit();
        }

        // Kiểm tra quyền của người dùng
        if ($_SESSION["role"] !== "admin") {
            echo "Bạn không có quyền truy cập vào trang này.";
            exit();
        }

        // Kiểm tra xem phương thức của request có phải là POST không
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form
            $ma_nv = $_POST['ma_nv'];
            $ten_nv = $_POST['ten_nv'];
            $phai = $_POST['phai'];
            $noi_sinh = $_POST['noi_sinh'];
            $ma_phong = $_POST['ma_phong'];
            $luong = $_POST['luong'];

            // Thêm nhân viên mới vào cơ sở dữ liệu
            $sql = "INSERT INTO NhanVien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES ('$ma_nv', '$ten_nv', '$phai', '$noi_sinh', '$ma_phong', '$luong')";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='success-message'>Thêm nhân viên mới thành công.</p>";
            } else {
                echo "<p class='error-message'>Lỗi: " . $conn->error . "</p>";
            }

            // Đóng kết nối
            $conn->close();
        } else {
            // Nếu không phải là phương thức POST, chuyển hướng người dùng điều hướng về trang khác
            header("Location: index.php");
            exit();
        }
        ?>

        <div class="button-wrapper">
            <a href="index.php"><button>Trở về</button></a>
        </div>
    </div>
</body>
</html>
