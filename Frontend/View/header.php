<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your head content here -->
</head>
<body>
    <header>
        <div class="hed">
            <img src="../../access/imagess/logoss.jpg" alt="">
            
            <!-- Thêm ô tìm kiếm -->

            <div class="search-box">
                <!-- <form action="search.php" method="get"> -->
                    <input type="text" name="search" placeholder="Tìm kiếm...">
                    <button type="submit"><i class="fa-sharp fa-solid fa-search"></i></button>
                <!-- </form> -->
            </div>
            <a href=""><i class="fa-sharp fa-solid fa-phone"></i> Hotline:0867127278</a>
        </div>
    </header>

    <?php

        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            displayDichVu($searchTerm);
        }
    ?>
    
    <!-- Add the rest of your HTML content here -->

</body>
<!-- </html>
dịch vụ
-exportServiceToExcel()
-getNextMaDichVu()
-displayDichVuData()
-searchDichVuData()
-getDichVuByMaDichVu()
-addDichVu()
-updateDichVu()
-deleteDichVu()


nhanvien
-exportEmployeeToExcel()
-getNextMaNhanVien()
-getNhanVienByMaNhanVien()
-addEmployee()
-displayEmployeeData()
-searchEmployeeData()
-getUserIDByEmail()
-deleteEmployee()
-editEmployee()

khách hàng
-exportCustomerToExcel() 
-addCustomer()
-getKhachHangByMaKhachHang()
-displayCustomerData()
-updateCustomer()
-getNextMaKhachHang()
-deleteCustomer()
-searchCustomer()


đơn hàng
-exportOrderToExcel()
-displayOrderDataWithDetails()
-searchdisplayOrderDataWithDetails()
-getOderByMaDonHang()
-deleteOrder()
-addOrder()
-getNextMaDonHang()
-searchOrderByMaDonHang() 

taikhoan

-exportAccountTypeToExcel()
-displayUserData()
-getNextUserID()
-getTaiKhoanByUserID()
-addAccount()
-searchAccount()

-->