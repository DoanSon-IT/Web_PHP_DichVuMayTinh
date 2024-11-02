
<?php
include "./model/dungchung.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['TenNhanVien']) && isset($_POST['Email'])) {
    $tenNhanVien = $_POST['TenNhanVien'];
    $email = $_POST['Email'];
   
    $success = addEmployee($tenNhanVien, $email);
    if ($success) {
        
        echo '<script>';
        echo 'alert("Thêm Nhân Viên Thành Công.");';
        echo 'window.location.href = "../admin/index.php?act=nhanvien";';
        echo '</script>';
    } else {
       
        echo '<script>';
        echo 'alert("Thêm Nhân Viên Thất Bại.");';
        echo '</script>';
    }

}

if (isset($_GET['MaNhanVien'])) {
    $maNhanVien = $_GET['MaNhanVien'];
    
    deleteEmployee($maNhanVien);
}
?>
   <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['exportnv'])) {
            
            exportEmployeeToExcel();
      }
    ?>

<div class="content">
    <form action="#" method="post">
       
        <div class="content-item">
        <div class="table-container">
                <table class="account-table">
                    <thead>
                        <tr class="table-header">
                            
                            <th class="maNhanVien">Mã Nhân Viên</th>
                            <th class="tenNhanVien">Tên Nhân Viên</th>
                            <th class="email">Email</th>
                            <th class="UserID">UserID</th>
                            <th style="width: 10%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                         if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
                           
                            $searchKeyword = $_POST['search'];
                            
                            searchEmployeeData($searchKeyword);
                        }else {
                            
                            displayEmployeeData();
                        }
                       
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Nút thêm nhân viên -->
        <div class="action-buttons">
        <a href="#"><button type="button" class="btn-add" onclick="toggleAddForm()"><i class="fas fa-plus"></i> Add</button></a>
        <form action="#" method="post">
            <!-- <input type="hidden " name="exportReport"> -->
            <button type="submit" name="exportnv" class="btn-xuat"><i class="fas fa-file-export"></i> Export</button>
        </form>
        <form action="#" method="post" class="forms_timkiem">
            <input type="text" id="searchInput" name="search" placeholder="Tìm Kiếm (Tên Nhân Viên)">
            <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
        </form>      
        </div>

        <!-- Form thêm nhân viên -->
        <div class="add-form" style="display: none;">
            <div class="add-form-boder">
                <form action="#" method="post">
                    <input placeholder="Tên Nhân Viên" type="text" id="TenNhanVien" name="TenNhanVien" required><br>
                    <input placeholder="Email" type="text" id="Email" name="Email" required><br>
                   

                    <!-- Nút thêm nhân viên -->
                    <button type="submit" class="btn-add-NhanVien"><i class="fas fa-plus"></i>ADD</button>
                    <!-- Nút đóng form -->
                    <button type="button" class="btn-close" onclick="toggleAddForm()"><i class="fas fa-times"></i>EXIT</button>
                </form>
            </div>
        </div>
    </form>
</div>
