<?php
include 'dbconnect.php'; // Nhúng tệp chứa các hàm liên quan đến cơ sở dữ liệu
// Thiết lập kết nối cơ sở dữ liệu  tk admin Admin    mk adminpass
session_start();
$conn = connectDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["Username"];
    $password = $_POST["Password"];

    // Sử dụng hàm executeQuery để thực hiện truy vấn
    $query = "SELECT * FROM LoaiTaiKhoan WHERE TenTaiKhoan='$username' AND Password='$password'";
    $result = executeQuery($conn, $query);

    // Lấy dữ liệu người dùng từ kết quả truy vấn
    $userData = mysqli_fetch_assoc($result);
    
    // ...

if ($userData) {
    $_SESSION["role"] = $userData["role"];
    $_SESSION["username"] =  $_POST["Username"];
    // $_SESSION["email"] =  $_POST["Email"];

    if ($userData["role"] == 1) {
        echo '<script>';
        echo 'alert("Đăng nhập thành công với tư cách Admin !");';
        echo 'window.location.href = "../../admin/index.php";'; // Redirect sau khi hiển thị thông báo
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Chúc Mừng Khách Hàng Đã Đăng Nhập Thành Công !");'; 
        echo 'window.location.href = "../index.php";';
        echo '</script>';
    }
} else {
    // Xử lý đăng nhập không hợp lệ
    echo '<script>';
    echo 'alert("Thông tin đăng nhập không hợp lệ.");';
    echo 'window.location.href = "..DangNhapDangKy.php";'; // Redirect sau khi hiển thị thông báo
    echo '</script>';
}



}

// Đóng kết nối cơ sở dữ liệu khi không cần thiết
mysqli_close($conn);

    exit();
?>
