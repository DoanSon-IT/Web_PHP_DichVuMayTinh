<?php
include "./model/dungchung.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['TenKhachHang']) && isset($_POST['DiaChi']) && isset($_POST['Email']) && isset($_POST['SDT'])) {
    $tenKhachHang = $_POST['TenKhachHang'];
    $diaChi = $_POST['DiaChi'];
    $emailKhachHang = $_POST['Email'];
    $sdt = $_POST['SDT'];

    
    $success= addCustomer($tenKhachHang, $diaChi, $emailKhachHang, $sdt);
    if ($success) {
       
        echo '<script>';
        echo 'alert("Thêm Khách Hàng Thành Công.");';
        echo 'window.location.href = "../admin/index.php?act=khachhang";';
        echo '</script>';
    } else {
        // Hiển thị thông báo thất bại
        echo '<script>';
        echo 'alert("Thêm Khách Hàng Thất Bại.");';
        echo '</script>';
    }
}
?>
<?php
       
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['exportkh'])) {
          
            exportCustomerToExcel();
      }
    ?>
<div class="content">
<form action="#" method="post">
        <div class="content-item">
        <div class="table-container">
                <table class="account-table">
                    <thead>
                        <tr class="table-header">
                           
                            <th class="makhachHang">Mã Khách Hàng</th>
                            <th class="tenKhachHang">Tên Khách Hàng</th>
                            <th class="DiaChi">Địa Chỉ</th>
                            <th class="Email">Email</th>
                            <th class="SDT">SDT</th>
                            <th class="UserId">UserID</th>
                            <th style="width: 10%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
                           
                            $searchKeyword = $_POST['search'];
                            
                            searchCustomer($searchKeyword);
                        }else {
                            
                            displayCustomerData() ;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="action-buttons">
            <!-- <a href="#"><button type="button" class="btn-update"><i class="fas fa-pencil-alt"></i> Update</button></a>
            <a href="#"><button type="button" class="btn-delete " onclick="toggleDeleteForm()"><i class="fas fa-trash-alt"></i> Delete</button></a> -->
           
            <a  style="display: none;"   href="#"><button type="button" class="btn-add" onclick="toggleAddForm()"><i class="fas fa-plus"></i> Add</button></a>
            
        <form action="#" method="post" class="button-cn">
            <!-- <input type="hidden" name="exportReport"> -->
            <button type="submit" name="exportkh" class="btn-xuat"><i class="fas fa-file-export"></i> Export</button>
        </form >
            <input type="text" name="search" placeholder="Tìm Kiếm (Tên Khách Hàng)">
            <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
        </div>

        <div class="add-form" style="display: none;">
            <div class="add-form-boder">
                <form action="#" method="post">
                    <input placeholder="Tên Khách Hàng" type="text" id="TenKhachHang" name="TenKhachHang" required><br>
                    <input placeholder="Địa Chỉ" type="text" id="DiaChi" name="DiaChi" required><br>
                    <input placeholder="Email" type="text" id="Email" name="Email" required><br>
                    <input placeholder="Số Điện Thoại" type="number" id="SDT" name="SDT" required><br>
                  
                    <!-- Nút thêm nhân viên -->
                    <button type="submit" class="btn-add-kh"><i class="fas fa-plus"></i>ADD</button>
                    <!-- Nút đóng form -->
                    <button type="button" class="btn-close" onclick="toggleAddForm()"><i class="fas fa-times"></i>EXIT</button>
                </form>
            </div>
        </div>
        <?php
     if (isset($_GET['MaKhachHang']))
     {
         $maKhachHang = $_GET['MaKhachHang'];
         deleteCustomer($maKhachHang);
     }
    ?>
     <?php
        
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['exportReport'])) {
            exportCustomerToExcel();
      }
    ?>
        </form>
</div>