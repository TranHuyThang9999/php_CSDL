<?php
$host = '127.0.0.1';
$db_user = 'root';
$db_pass = '1234';
$db_name = 'learn_php';

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $productId = $_GET['id'];

    $query = "SELECT * FROM qlnv WHERE MaVN = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sản phẩm.";
        exit();
    }

    $stmt->close();
} else {
    echo "Không tìm thấy sản phẩm.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh Sửa Thông Tin Sản Phẩm</title>
</head>
<body>
    <h2>Chỉnh Sửa Thông Tin Sản Phẩm</h2>
    <form action="xuli.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="updated_id" value="<?php echo $row["MaVN"]; ?>">
        
        <label for="updated_hoten">Họ và tên:</label>
        <input type="text" name="updated_hoten" value="<?php echo $row["HoTen"]; ?>" required><br><br>

        <label for="updated_xeploai">Xếp loại:</label>
        <input type="text" name="updated_xeploai" value="<?php echo $row["XepLoai"]; ?>" required><br><br>

        <label for="updated_luongngay">Lương ngày:</label>
        <input type="number" name="updated_luongngay" value="<?php echo $row["LuongNgay"]; ?>" required><br><br>

        <label for="updated_ngaycong">Ngày công:</label>
        <input type="number" name="updated_ngaycong" value="<?php echo $row["NgayCong"]; ?>" required><br><br>

        <label for="updated_image">Hình ảnh:</label>
        <input type="file" name="updated_image"><br><br>

        <input type="submit" value="Cập nhật Thông Tin">
    </form>
    <a href="index.php">Quay lại danh sách sản phẩm</a>
</body>
</html>
