<?php

include "./model/dungchung.php";


if (isset($_GET['MaKhachHang'])) {
    $MaKhachHang = $_GET['MaKhachHang'];
    
   
    $KhachHang = getKhachHangByMaKhachHang($MaKhachHang);

   
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['UPDATE'])) {
        
        $MaKhachHang = $_POST['MaKhachHang'];
        $TenKhachHang = $_POST['TenKhachHang'];
        $DiaChi = $_POST['DiaChi'];
        $Email = $_POST['Email'];
        $SDT = $_POST['SDT'];
        $UserID = $_POST['UserID'];

        
        updateCustomer($MaKhachHang, $TenKhachHang, $DiaChi, $Email, $SDT, $UserID);
    }
}

?>
<div class="update-form-dv">
    <div class="dv-update">
        <form action="index.php?act=updatekh&MaKhachHang=<?php echo $MaKhachHang; ?>" method="post">
            <input type="hidden" name="MaKhachHang" value="<?php echo $KhachHang['MaKhachHang']; ?>">
            <label for="TenKhachHang">Tên Khách Hàng:</label>
            <input type="text" name="TenKhachHang" value="<?php echo $KhachHang['TenKhachHang']; ?>" required>
            <label for="DiaChi">Địa Chỉ:</label>
            <input type="text" name="DiaChi" value="<?php echo $KhachHang['DiaChi']; ?>" required>
            <label for="Email">Email:</label>
            <input type="email" name="Email" value="<?php echo $KhachHang['Email']; ?>" required>
            <label for="SDT">Số Điện Thoại:</label>
            <input type="text" name="SDT" value="<?php echo $KhachHang['SDT']; ?>" required>
            <input type="hidden" name="UserID" value="<?php echo $KhachHang['UserID']; ?>" required>
            <button type="submit" name="UPDATE" class="btn-update-dv"><i class="fas fa-save"></i> UPDATE</button>
            <button type="button" class="btn-close"><a href="../admin/index.php?act=khachhang"><i class="fas fa-times"></i> EXIT</a></button>
        </form>
    </div>
</div>
