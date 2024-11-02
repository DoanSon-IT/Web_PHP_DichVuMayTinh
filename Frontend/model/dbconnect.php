<?php
// Hàm thiết lập kết nối cơ sở dữ liệu
function connectDB() {
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "databasedvmaytinh";

    // Tạo kết nối
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }

    return $conn;
}

// Hàm thực hiện truy vấn
function executeQuery($conn, $query) {
    $result = mysqli_query($conn, $query);

    // Kiểm tra và xử lý lỗi nếu có
    if (!$result) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }

    return $result;
}


?>
