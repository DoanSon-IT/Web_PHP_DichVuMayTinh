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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-pzjw8f+ua/CXf5BBdOJJtCea9djHjEXIpY8TMW5Y7vJmMqUK3lP97JQpIQhF5J" crossorigin="anonymous">
    <link rel="stylesheet" href="../access/css/style.css">
    <title>Đơn Hàng Đã Đặt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .containers {
            width: 70%;
            margin: 20px auto;
            margin-top: 120px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        .btn-allmoney {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f2f2f2;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .money {
            font-size: 18px;
            font-weight: bold;
        }

        button {
            padding: 10px 15px;
            background-color: black;
            color: white;
            border: none;
            /* border-radius: 5px; */
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php include __DIR__."/View/header.php"; ?>
<?php include __DIR__."/View/nav.php"; ?>
<div class="containers">
    <h2>Đơn Hàng Của Bạn</h2>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <!-- <th>Mã Đơn Hàng</th> -->
                <!-- <th>Tên Khách Hàng</th> -->
                <th>Tên Dịch Vụ</th>
                <th>Thành Tiền</th>
                <th>Ngày Đặt</th>
                <th>Hình Thức Thanh Toán</th>
                <th>Trạng Thái</th>
                <th class="hanhdong">Hành Động</th>
            </tr>
        </thead>
        <tbody id="order-table-body">
            
       
         <?php
         if (isset($_SESSION['username'])) {
             $tenKhachHang = $_SESSION['username'];
             displayOrderDataWithDetails($tenKhachHang);
         } else {
            echo  '<script>alert("Không tìm thấy thông tin khách hàng.");</script>';
         }
         ?>
        
        </tbody>
    </table>


    <div class="btn-allmoney">
    <?php
        if (isset($_SESSION['username'])) {
            $tenKhachHang = $_SESSION['username'];
            $totalAmount = getTotalAmountByTenKhachHang($tenKhachHang);
            echo "<label for='' class='money'>Tổng Tiền : " . number_format($totalAmount, 0, ',', '.') . " VNĐ</label>";
        } else {
            echo '<label for="" class="money">Tổng Tiền 0 VND</label>';
        }
    ?>

    <button>THANH TOÁN</button>
</div>
</div>
<script>
    function confirmDelete(maDonHang) {
        var result = confirm("Bạn có chắc chắn muốn hủy đơn hàng?");
        if (result) {
            window.location.href = "./delete_order.php?maDonHang=" + maDonHang;
        }
    }
</script>



</body>
</html>
