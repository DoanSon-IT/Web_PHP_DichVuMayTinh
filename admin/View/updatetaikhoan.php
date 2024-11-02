<?php

include "./model/dungchung.php";

if (isset($_GET['UserID'])) {
    $UserID = $_GET['UserID'];
    
  
    $taikhoan = getTaiKhoanByUserID($UserID);

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['UPDATE'])) {
       
        $UserID = $_POST['UserID'];
        $TenTaiKhoan = $_POST['TenTaiKhoan'];
        $Password = $_POST['Password'];
        $Email = $_POST['Email'];
        $role = $_POST['role'];
      
        editAccount($UserID, $TenTaiKhoan, $Password, $Email, $role);
    }
}

?>

<div class="update-form-dv">
    <div class="dv-update">
        <form action="index.php?act=updatetaikhoan&UserID=<?php echo $UserID; ?>" method="post">
            <input type="hidden" name="UserID" value="<?php echo $taikhoan['UserID']; ?>">
            <label for="Username">Username:</label>
            <input type="text" name="TenTaiKhoan" value="<?php echo $taikhoan['TenTaiKhoan']; ?>" required>
            <label for="Password">Password:</label>
            <input type="text" name="Password" value="<?php echo $taikhoan['Password']; ?>" required>
            <label for="Email">Email:</label>
            <input type="text" name="Email" value="<?php echo $taikhoan['Email']; ?>" required>
            <input type="hidden" name="role" value="<?php echo $taikhoan['role']; ?>">
            <button type="submit" name="UPDATE" class="btn-update-dv"><i class="fas fa-save"></i> UPDATE</button>
            <button type="button" class="btn-close"><a href="../admin/index.php?act=taikhoan"><i class="fas fa-times"></i> EXIT</a></button>
        </form>
    </div>
</div>
