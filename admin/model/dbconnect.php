<?php
function connectDB() {
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "databasedvmaytinh";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }
    return $conn;
}
function executeQuery($conn, $query) {
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }
    return $result;
}
?>
