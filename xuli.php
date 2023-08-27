<?php
$host = '127.0.0.1';
$db_user = 'root';
$db_pass = '1234';
$db_name = 'learn_php';

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    $deleteQuery = "DELETE FROM qlnv WHERE MaVN = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $deleteId);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi khi xóa nhân viên: " . $stmt->error;
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedId = $_POST['updated_id'];
    $updatedHoTen = $_POST['updated_hoten'];
    $updatedXepLoai = $_POST['updated_xeploai'];
    $updatedLuongNgay = $_POST['updated_luongngay'];
    $updatedNgayCong = $_POST['updated_ngaycong'];

    echo $_FILES['updated_image']['error'];

    if ($_FILES['updated_image']['error'] == 0) {
        $newImagePath = 'uploads/' . basename($_FILES['updated_image']['name']);
        move_uploaded_file($_FILES['updated_image']['tmp_name'], $newImagePath);
        $updateImageQuery = "UPDATE qlnv SET HinhAnh = ? WHERE MaVN = ?";
        $stmt = $conn->prepare($updateImageQuery);
        $stmt->bind_param("ss", $newImagePath, $updatedId);
        $stmt->execute();
        $stmt->close();
    }

    $updateQuery = "UPDATE qlnv SET HoTen = ?, XepLoai = ?, LuongNgay = ?, NgayCong = ? WHERE MaVN = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssdds", $updatedHoTen, $updatedXepLoai, $updatedLuongNgay, $updatedNgayCong, $updatedId);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật thông tin nhân viên: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
