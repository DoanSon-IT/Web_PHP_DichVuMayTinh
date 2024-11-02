<?php
include "./model/dcFrontend.php";

session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ./View/dangnhapdangky.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../access/css/style.css">
    <title>Thông tin</title>
    <!-- Định dạng CSS cho bảng và nút -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .containers {
            width: 70%;
            margin: 30px auto;
            margin-top: 150px;

        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .hanhdong a {
            margin-right: 10px;
            text-decoration: none;
            color: #333;
        }

        .hanhdong a i {
            color: #007bff;
        }
    </style>
</head>
<body>

<?php include __DIR__."/View/header.php"; ?>
<?php include __DIR__."/View/nav.php"; ?>
<div class="containers">
    <h2>Thông Tin Cá Nhân</h2>
    <table>
        <thead>
            <tr>
                <!-- <th >Mã Khách Hàng</th> -->
                <th>Tên Khách Hàng</th>
                <th>Địa Chỉ</th>
                <th>Email</th>
                <th>SĐT</th>
                <!-- <th>User ID</th> -->
                <!-- <th class='hanhdong'>Hành Động</th> -->
            </tr>
        </thead>
        <tbody id="thongtin-table-body">
       
        <?php
            if (isset($_SESSION['username'])) {
                $tenKhachHang = $_SESSION['username'];
                $maKhachHang = getMaKhachHangFromTenKhachHang($tenKhachHang);
                displayCustomerData($maKhachHang);
            } else {
                echo "Bạn chưa đăng nhập.";
            }
        ?>
        
        </tbody>
    </table>
</div>




</body>
</html>
