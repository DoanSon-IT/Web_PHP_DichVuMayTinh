<?php
include "./model/dungchung.php";

?>
<div class="content">
<form action="#" method="post">
        <div class="content-item">
        <div class="table-container">
                <table class="account-table">
                    <thead>
                        <tr class="table-header">
                            <th class="stt">STT</th>
                            <th class="maDonHang">Mã Đơn Hàng</th>
                            <th class="maKhachHang">Khách Hàng</th>
                            <th class="maDichVu">Tên Dịch Vụ</th>
                            <th class="ThanhTien">Thành Tiền</th>
                            <th class="ngayDat">Ngày Đặt</th>
                            <th class="MaThanhToan">Hình thức Thanh Toán</th>
                            <th class="MaTrangThai"> Trạng Thái</th>
                            <th class="HanhDong">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
                         
                            $startDate = $_POST['startDate'];
                            $endDate = $_POST['endDate'];
                            $search = $_POST['search'];
                        
                           
                            searchdisplayOrderDataWithDetails($startDate, $endDate, $search);
                        }else{
                        displayOrderDataWithDetails();}
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="action-buttons">
        <form action="#" method="get">
                <div class="search-container" style="margin: 0 20px ;">
                    <strong><label  for="startDate">Từ ngày:</label></strong>
                    <input type="date" id="startDate" name="startDate" value="<?php echo $startDate?>">

                    <strong><label for="endDate">Đến ngày:</label></strong>
                    <input type="date" id="endDate" name="endDate" value="<?php echo $endDate?>">
                    <input type="text" id="search" name="search"  placeholder="Tìm kiếm">

                    <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                </div>
        </form>
        <form action="#" method="post">
            <div style="display: none;">
                    <strong><label  for="startDate">Từ ngày:</label></strong>
                    <input type="date" id="startDate" name="startDate" value="<?php echo $startDate?>">
                    <strong><label for="endDate">Đến ngày:</label></strong>
                    <input type="date" id="endDate" name="endDate" value="<?php echo $endDate?>">
            </div>       
            <input style="display: none;" type="hidden" name="exportReport" value="<?php echo $search?>">
            <button type="submit" name="exportOrder" class="btn-xuat"><i class="fas fa-file-export"></i> Export</button>
        </form>


    <?php
        
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['exportReport'])) {
           
            $search=$_POST['exportReport'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            exportOrderToExcel($startDate, $endDate, $search);
            }
            
        if (isset($_GET['MaDonHang'])) {
            $maDonHangToDelete = $_GET['MaDonHang'];
            deleteOrder($maDonHangToDelete);
        }
    ?>
        </form>

</div>