<?php

include "./model/dungchung.php";


if (isset($_GET['MaNhanVien'])) {
    $MaNhanVien = $_GET['MaNhanVien'];
    
   
    $NhanVien = getNhanVienByMaNhanVien($MaNhanVien);

   
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['UPDATE'])) {
 
        $MaNhanVien = $_POST['MaNhanVien'];
        $TenNhanVien = $_POST['TenNhanVien'];
        $Email = $_POST['Email'];
        $UserID = $_POST['UserID'];

    
        editEmployee($MaNhanVien, $TenNhanVien, $Email, $UserID);
    }
}

?>

<div class="update-form-dv">
    <div class="dv-update">
        <form action="index.php?act=updatenv&MaNhanVien=<?php echo $MaNhanVien; ?>" method="post">
            <input type="hidden" name="MaNhanVien" value="<?php echo $NhanVien['MaNhanVien']; ?>">
            <label for="TenNhanVien">Tên Nhân Viên:</label>
            <input type="text" name="TenNhanVien" value="<?php echo $NhanVien['TenNhanVien']; ?>" required>
            <label for="Email">Email:</label>
            <input type="Email" name="Email" value="<?php echo $NhanVien['Email']; ?>" required>
            <input type="hidden" name="UserID" value="<?php echo $NhanVien['UserID']; ?>" required>
            <button type="submit" name="UPDATE" class="btn-update-dv"><i class="fas fa-save"></i> UPDATE</button>
            <button type="button" class="btn-close"><a href="../admin/index.php?act=nhanvien"><i class="fas fa-times"></i> EXIT</a></button>
        </form>
    </div>
</div>
