<?php
session_start();
include 'dbconnect.php';

function getNextUserID() {
    $conn = connectDB();
    $query = "SELECT MAX(UserID) AS maxUserID FROM LoaiTaiKhoan";
    $result = executeQuery($conn, $query);

    $row = mysqli_fetch_assoc($result);
    $nextUserID = $row['maxUserID'] + 1;

    mysqli_close($conn);

    return $nextUserID;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["Username"];
    $email = $_POST["Email"];
    $password = $_POST["Password"];
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Sử dụng hàm để lấy UserID tiếp theo
    $UserID = getNextUserID();

    $role = 0;

    $insertQuery = "INSERT INTO LoaiTaiKhoan (UserID, TenTaiKhoan, Password, Email, role) 
                    VALUES ('$UserID', '$username', '$password', '$email', '$role')";

    $conn = connectDB();

    executeQuery($conn, $insertQuery);
    mysqli_close($conn);
    echo '<script>';
    echo 'alert("Registration successful. Please log in.");';
    echo 'window.location.href = "../View/DangNhapDangKy.php";'; // Redirect after alert
    echo '</script>';
    exit();
}
?>
