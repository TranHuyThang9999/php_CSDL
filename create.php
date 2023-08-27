<!DOCTYPE html>
<html>
<head>
    <title>Tạo Mới Sản Phẩm</title>
</head>
<body>
    <h2>Tạo Mới Sản Phẩm</h2>
    <form action="xuli_create.php" method="post" enctype="multipart/form-data">
        <label for="mavn">Mã VN:</label>
        <input type="text" name="mavn" required><br><br>

        <label for="hoten">Họ và tên:</label>
        <input type="text" name="hoten" required><br><br>

        <label for="xeploai">Xếp loại:</label>
        <input type="text" name="xeploai" required><br><br>

        <label for="luongngay">Lương ngày:</label>
        <input type="number" name="luongngay" required><br><br>

        <label for="ngaycong">Ngày công:</label>
        <input type="number" name="ngaycong" required><br><br>

        <label for="image">Hình ảnh:</label>
        <input type="file" name="image"><br><br>

        <input type="submit" value="Tạo Mới Sản Phẩm">
    </form>
    <a href="index.php">Quay lại danh sách sản phẩm</a>
</body>
</html>
