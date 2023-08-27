<?php 
$host = '127.0.0.1';
$db_user = 'root';
$db_pass = '1234';
$db_name = 'learn_php';

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$query = "SELECT MaVN, HoTen, HinhAnh, XepLoai, LuongNgay, NgayCong FROM qlnv";
$result = $conn->query($query);


function calculateTotalSalary($basicSalary, $day, $bonusLevel) {
    $bonusAmount = 0;
    if ($bonusLevel === "A") {
        $bonusAmount = 500000;
    } elseif ($bonusLevel === "B") {
        $bonusAmount = 300000;
    } elseif ($bonusLevel === "C") {
        $bonusAmount = 0;
    }

    $totalSalary = $basicSalary*$day + $bonusAmount;
    return $totalSalary;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Danh Sách Sản Phẩm</h2>
    <table border="1">
        <tr>
            <th>MaNV</th>
            <th>Ho và tên</th>
            <th>Hình Ảnh</th>
            <th>Xếp Loại</th>
            <th>Lương Ngày</th>
            <th>Ngày Công</th>
            <th>Tổng Lương</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["MaVN"] . "</td>";
            echo "<td>" . $row["HoTen"] . "</td>";
            echo "<td><img src='" . $row["HinhAnh"] . "' width='100'></td>";
            echo "<td>" . $row["XepLoai"] . "</td>";
            echo "<td>" . $row["LuongNgay"] . "</td>";
            echo "<td>" . $row["NgayCong"] . "</td>";
            echo "<td>" . calculateTotalSalary($row["LuongNgay"], $row["NgayCong"], $row["XepLoai"]) . "</td>";
            echo "<td><a href='xuli.php?delete_id=" . $row["MaVN"] . "'>Xóa</a></td>";
            echo "<td><a href='edit.php?id=" . $row["MaVN"] . "'>Sửa</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <a href="create.php">Tạo sản phẩm mới</a>
</body>
</html>