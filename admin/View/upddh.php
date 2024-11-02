<?php
include "./model/dungchung.php";

if (isset($_GET['MaDonHang'])) {
    $maDonHang = $_GET['MaDonHang'];
    $donhang = getOderByMaDonHang($maDonHang);
    if (isset($_POST['UPDATE'])) {
       
        $maKhachHang = $_POST['MaKhachHang'];
        $maDichVu = $_POST['MaDichVu'];
        $thanhTien = $_POST['ThanhTien'];
        $ngayDat = $_POST['ngayDat'];
        $maThanhToan = $_POST['MaThanhToan'];
        $maTrangThai = $_POST['MaTrangThai'];

        editOrder($maDonHang, $maKhachHang, $maDichVu, $thanhTien, $ngayDat, $maThanhToan, $maTrangThai);
    }
}

?>

<div class="update-form-dv">
    <div class="dv-update">
        <form action="index.php?act=upddh&MaDonHang=<?php echo $maDonHang; ?>" method="post">
        <div style="display: none;"> 
            <input type="text" id="MaDonhHang" name="MaDonHang" value="<?php echo $donhang['MaDonHang']; ?>" >
            <label for="KhachHang">Tên Khách Hàng:</label>
            <input type="text" id="MaKhachHang" name="MaKhachHang" value="<?php echo $donhang['MaKhachHang']; ?>" >
            <label for="TenDichVu"> Dịch Vụ:</label>
            <input type="text" id="MaDichVu" name="MaDichVu" value="<?php echo $donhang['MaDichVu']; ?>" >
            <label for="ThanhTien">Thành Tiền:</label>
            <input type="text" id="ThanhTien" name="ThanhTien" value="<?php echo $donhang['ThanhTien']; ?>" >
            <label for="ngayDat">Ngày Đặt:</label>
            <input type="date" id="ngayDat" name="ngayDat" value="<?php echo $donhang['ngaydat']; ?>">
            <label for="MaThanhToan">Thanh Toán:</label>
            <input type="text" id="MaHinhThucThanhToan" name="MaThanhToan" value="<?php echo $donhang['MaThanhToan']; ?>" >
        </div>
        <div class="ud" style="display: flex; align-items: center; gap: 10px;">
    <label for="MaTrangThai">Trạng Thái:</label>
    <select id="MaTrangThai" name="MaTrangThai" required>
        <option value="TT001" <?php echo ($donhang['MaTrangThai'] == 'TT001') ? 'selected' : ''; ?>>Chờ xử lý</option>
        <option value="TT002" <?php echo ($donhang['MaTrangThai'] == 'TT002') ? 'selected' : ''; ?>>Đang xử lý</option>
        <option value="TT003" <?php echo ($donhang['MaTrangThai'] == 'TT003') ? 'selected' : ''; ?>>Đã hoàn thành</option>
    </select>

    <button type="submit" name="UPDATE" class="btn-update-dh"><i class="fas fa-save"></i>UPDATE TT</button>
    <button type="button" class="btn-close-a"><a href="../admin/index.php?act=donhang"><i class="fas fa-times"></i> EXIT</a></button>
</div>
  
        </form>
    </div>
</div>















<style>

.ud {
    display: flex;
    align-items: center;
    gap: 10px;
}

label {
    font-weight: bold;
}

select {
    padding: 8px;
    border-radius: 4px;
}

.btn-update-dh {
    padding: 10px 20px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-update-dh:hover {
    background-color: #2980b9;
}

.btn-close-a {
    padding: 10px 20px;
    background-color: #e74c3c;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.btn-close:hover {
    background-color: #c0392b;
}

</style>