<?php
$host = '127.0.0.1';
$db_user = 'root';
$db_pass = '1234';
$db_name = 'learn_php';

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maVN = $_POST['mavn'];
    $hoTen = $_POST['hoten'];
    $xepLoai = $_POST['xeploai'];
    $luongNgay = $_POST['luongngay'];
    $ngayCong = $_POST['ngaycong'];

    if ($result->num_rows > 0) {
        echo "Lỗi: Mã VN đã tồn tại.";
    } else {
        // Kiểm tra và xử lý upload ảnh (nếu có)
        if ($_FILES['image']['error'] === 0) {
            $newImageName = $_FILES['image']['name'];
            $newImagePath = 'uploads/' . $newImageName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $newImagePath)) {
                $insertQuery = "INSERT INTO qlnv (MaVN, HoTen, XepLoai, LuongNgay, NgayCong, HinhAnh) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param("ssddds", $maVN, $hoTen, $xepLoai, $luongNgay, $ngayCong, $newImagePath);
                if ($stmt->execute()) {
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Lỗi khi tạo mới sản phẩm: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Lỗi khi upload ảnh.";
            }
        }
    }

    $conn->close();
}
?>
