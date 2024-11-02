<?php
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ./View/dangnhapdangky.php");
    exit;
}
?>
<?php
include "./model/dcFrontend.php";
$serviceDetails = [];
if (isset($_GET['MaDichVu'])) {
    $maDichVu = $_GET['MaDichVu'];
    $serviceDetails = getDichVuByMaDichVu($maDichVu);
    if (!$serviceDetails) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenKhachHang = $_POST["hoTen"];
    $email = $_POST["email"];
    $diaChi = $_POST["DiaChi"];
    $sdt = $_POST["soDienThoai"];
    $ngayDat = $_POST["ngaydat"];
    $maThanhToan = $_POST["MaThanhToan"];

    if (!empty($tenKhachHang) && !empty($email) && !empty($diaChi) && !empty($sdt) && !empty($ngayDat) && !empty($maThanhToan)) {
        
        // Kiểm tra xem khách hàng đã tồn tại hay chưa
        $maKhachHang = getMaKhachHangByEmail($email);

        if (empty($maKhachHang)) {
            // Nếu khách hàng chưa tồn tại, thêm mới thông tin khách hàng
            $successCustomer = addCustomer($tenKhachHang, $diaChi, $email, $sdt);

            if (!$successCustomer) {
                echo '<script>alert("Thêm thông tin khách hàng thất bại!");</script>';
                exit; // Thoát khỏi xử lý nếu không thêm được thông tin khách hàng
            }

            // Lấy mã khách hàng vừa thêm mới
            $maKhachHang = getMaKhachHangByEmail($email);
        }

        // Thêm đơn hàng
        $maDichVu = $_POST["MaDichVu"];
        $conn = connectDB();
        $maDonHang = getNextMaDonHang();

        $query = "INSERT INTO DonHang (MaDonHang, MaKhachHang, MaDichVu, ThanhTien, ngaydat, MaThanhToan, MaTrangThai)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        $thanhTien = getDonGiaDichVu($maDichVu);
        $maTrangThai = "TT001";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssss", $maDonHang, $maKhachHang, $maDichVu, $thanhTien, $ngayDat, $maThanhToan, $maTrangThai);

        $successOrder = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        if ($successOrder) {
            echo '<script>alert("Đặt dịch vụ thành công!");</script>';
        } else {
            echo '<script>alert("Đặt dịch vụ thất bại!");</script>';
        }
    } else {
        echo '<script>alert("Vui lòng điền đầy đủ thông tin!");</script>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="coputer care icon" href="../access/images/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../access/css/dv.css">
    <link rel="stylesheet" href="../access/css/style.css">
    <title>Your Website</title>
</head>
<body>
<?php include __DIR__."/View/header.php"; ?>
<?php include __DIR__."/View/nav.php"; ?>

<div class="subtitle"> 
            <h1><span style="color:#696687;">CHI TIẾT THÔNG TIN</span> <span style="color:#FF9900;">DỊCH VỤ</span> </h1>
            <h2>Chăm sóc máy tính-Giúp máy tính được tối ưu hoàn hảo</h2> 
           
</div>
    <!-- Content -->
    <div class="contentt">
        <div class="service-details">
           <div class="service-image">
                <img src="../access/images/<?php echo $serviceDetails['Anh']; ?>" alt="Ảnh Dịch Vụ">
                <p style="display: none;" class="service-title" >Mã Dịch Vụ: <?php echo $serviceDetails['MaDichVu']; ?></p>
           </div>
           
            <div class="computer-care">
                <br>
                <h2 class="service-title">Tên Dịch Vụ: <?php echo $serviceDetails['TenDichVu']; ?></h2>
                <p>Mô Tả: <?php echo $serviceDetails['MoTaDichVu']; ?></p>
                <span class="service-price">Giá: <?php echo number_format($serviceDetails['DonGiaDichVu'], 0, ',', '.'); ?> VND</span>
                <button class="book-appointment" onclick="openOverlay()">Đặt Lịch Ngay</button>
            </div>
        </div>
<div class="overlay" id="overlay">
    <div class="datdichvu">
    <form action="#" method="post">
        <input type="hidden" name="MaDichVu" value="<?php echo $serviceDetails['MaDichVu']; ?>">
        <!-- Thông tin khách hàng -->
        <p style="text-align: center;">FORM THÔNG TIN ĐẶT DỊCH VỤ</p>
        <label for="hoTen">Họ và Tên:</label>
        <input type="text" name="hoTen" placeholder="Nhập họ tên" required>

        <label for="email" >Email:</label>
        <input type="email " name="email" placeholder="Xin vui lòng nhập đúng email khi đăng kí tài khoản" required>

        <label for="dc" >Địa Chỉ:</label>
        <input type="text" name="DiaChi" placeholder="Nhập địa chỉ" required>

        <label for="soDienThoai">Số Điện Thoại:</label>
        <input type="tel" name="soDienThoai" placeholder="Nhập SDT" required>

        <label for="ngaydat">Ngày Đặt:</label>
        <input type="date" name="ngaydat" required>

        <label for="MaThanhToan">Hình Thức Thanh Toán</label>
        <select id="MaThanhToan" name="MaThanhToan" required>
        <option value="TT001" >Thẻ Tín Dụng</option>
        <option value="TT002" >Tiền Mặt</option>
        </select>
        <div class="bt">
        <button type="submit">Xác Nhận</button>
        <button type="button" onclick="closeOverlay()">Thoát</button>
        </div>
    </form>
    </div>
</div>
</div>
<?php include __DIR__."/View/pc.php"; ?>
<?php include __DIR__."/View/footer.php"; ?>
<script>
    function openOverlay() {
        document.getElementById('overlay').style.display = 'flex'; // Display the overlay
    }
    function closeOverlay() {
        document.getElementById('overlay').style.display = 'none'; // Hide the overlay
    }
</script>
</body>

</html>
