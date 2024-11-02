<?php

include "./model/dungchung.php";

if (isset($_GET['MaDichVu'])) {
    $maDichVu = $_GET['MaDichVu'];
   
    $dichVu = getDichVuByMaDichVu($maDichVu);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['UPDATE'])) {
  
        $maDichVu = $_POST['MaDichVu'];
        $tenDichVu = $_POST['TenDichVu'];
        $anh = $_POST['Anh'];
        $moTaDichVu = $_POST['MoTaDichVu'];
        $donGiaDichVu = $_POST['DonGiaDichVu'];
        $loaidv=$_POST['LoaiDichVu'];

        updateDichVu($maDichVu, $tenDichVu, $anh, $moTaDichVu, $donGiaDichVu, $loaidv);
    }
}

?>
<div class="update-form-dv">
    <div class="dv-update">
        <form action="index.php?act=upddv&MaDichVu=<?php echo $maDichVu; ?>" method="post">
            <input type="hidden" name="MaDichVu" value="<?php echo $dichVu['MaDichVu']; ?>">
            <label for="TenDichVu">Tên Dịch Vụ:</label>
            <input type="text" name="TenDichVu" value="<?php echo $dichVu['TenDichVu']; ?>" required>
            <label for="Anh">Ảnh:</label>
            <input type="file" name="Anh" value="<?php echo $dichVu['Anh']; ?>" required>
            <label for="MoTaDichVu">Mô Tả Dịch Vụ:</label>
            <textarea name="MoTaDichVu" required><?php echo $dichVu['MoTaDichVu']; ?></textarea>
            <label for="DonGiaDichVu">Đơn Giá Dịch Vụ:</label>
            <input type="text" name="DonGiaDichVu" value="<?php echo $dichVu['DonGiaDichVu']; ?>" required>
            <select  id="LoaiDichVu" name="LoaiDichVu" required>
                <option value="1" <?php echo ($dichVu['LoaiDichVu'] == 1) ? 'selected' : ''; ?>>Phần cứng</option>
                <option value="2" <?php echo ($dichVu['LoaiDichVu'] == 2) ? 'selected' : ''; ?>>Phần mềm</option>
                <option value="3" <?php echo ($dichVu['LoaiDichVu'] == 3) ? 'selected' : ''; ?>>Khác</option>
            </select><br>

            <button type="submit" name="UPDATE" class="btn-update-dv"><i class="fas fa-save"></i> UPDATE</button>
            <button type="button" class="btn-close"><a href="../admin/index.php?act=dichvu"><i class="fas fa-times"></i> EXIT</a></button>
        </form>
    </div>
</div>
