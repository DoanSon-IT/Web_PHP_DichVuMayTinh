<?php include "./model/dungchung.php";
?>
<div class="content">
<form action="#" method="post">
        <div class="content-item">
        <div class="table-container">
                <table class="account-table">
                    <thead class="tt">
                        <tr class="table-header" >
                            <th class="STT" style="width: 5%; ">STT</th>
                            <th class="maDichVu" style="width: 10%;">Mã Dịch Vụ</th>
                            <th class="tenDichVu" style="width: 20%;">Tên Dịch Vụ</th>
                            <th class="anh" style="width: 15%;">Image</th>
                            <th class="moTaDichVu" style="width: 30%;">Mô Tả Dịch Vụ</th>
                            <th class="DonGiaDichVu" style="width: 10%;">Đơn Giá</th>
                            <th class="HanhDong" style="width: 10%;">Hành Động</th>
                            
                        </tr>
                    </thead>
                    <div class="keo">
                    <tbody class="nd">
                        <?php 
                        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
                           
                            $searchKeyword = $_POST['search'];
                            
                            searchDichVuData($searchKeyword);
                        }else {
                            
                            displayDichVuData();
                        }
                        ?>
                    </tbody>
                    </div>
                </table>
            </div>
        </div>
        <div class="action-buttons">
        <a href="#"><button type="button" class="btn-add" onclick="toggleAddForm()"><i class="fas fa-plus"></i> Add</button></a>
        <form action="#" method="post">
            <input style="display: none;" type="text " name="exportReport" value="<?php echo isset($searchKeyword) ? htmlspecialchars($searchKeyword) : ''; ?>">
            <button type="submit" name="exportdv" class="btn-xuat"><i class="fas fa-file-export"></i> Export</button>
        </form>
        <form action="#" method="post" class="forms_timkiem">
            <input type="text" id="searchInput" name="search" placeholder="Tìm Kiếm (Tên Dịch Vụ)" value="<?php echo isset($searchKeyword) ? htmlspecialchars($searchKeyword) : ''; ?>">
            <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
        </form>      
        </div>
        <div class="add-form" style="display: none;">
    <div class="add-form-boder">
        <form action="#" method="post" enctype="multipart/form-data">
            <input placeholder="Tên dịch vụ" type="text" id="TenDichVu" name="newTenDichVu" required><br>
            <input placeholder="Mô tả dịch vụ" type="text" id="MoTaDichVu" name="MoTaDichVu" required><br>
            <input placeholder="Đơn giá dịch vụ" type="number" id="DonGiaDichVu" name="DonGiaDichVu" required><br>
            <label for="Anh">Chọn ảnh:</label>
            <input type="file" id="Anh" name="Anh" accept="images/*"><br>
            <!-- Thêm trường select để chọn loại dịch vụ -->
            <select id="LoaiDichVu" name="LoaiDichVu" required>
                <option value="1">Dịch vụ phần cứng </option>
                <option value="2">Dịch vụ phần mềm </option>
                <option value="3">Dịch vụ khác</option>
            </select><br>

            <button type="submit" class="btn-add-dv"><i class="fas fa-plus"></i> ADD</button>
            <button type="button" class="btn-close" onclick="toggleAddForm()"><i class="fas fa-times"></i> EXIT</button>
        </form>
    </div>
</div>


    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['newTenDichVu'])) {
        // Validate và lấy dữ liệu từ form
        $tenDichVu = isset($_POST['newTenDichVu']) ? $_POST['newTenDichVu'] : '';
        $moTaDichVu = isset($_POST['MoTaDichVu']) ? $_POST['MoTaDichVu'] : '';
        $donGiaDichVu = isset($_POST['DonGiaDichVu']) ? $_POST['DonGiaDichVu'] : '';
        $loaidv = isset($_POST['LoaiDV']) ? $_POST['LoaiDV'] : '';
    
        if (isset($_FILES['Anh']) && $_FILES['Anh']['error'] == 0) {
            $fileTmpPath = $_FILES['Anh']['tmp_name'];
            $fileName = $_FILES['Anh']['name'];
          
            move_uploaded_file($fileTmpPath, "images/" . $fileName);
            $anh = $fileName; 
        } else {
            echo 'Vui lòng chọn ảnh.';
        }
        
        if (!empty($tenDichVu) && !empty($moTaDichVu) && isset($donGiaDichVu)) {
         
            $nextMaDichVu = getNextMaDichVu();
            // Gọi hàm addDichVu
            addDichVu($nextMaDichVu, $tenDichVu, $anh, $moTaDichVu, $donGiaDichVu ,$loaidv);
        } else {
            echo 'Vui lòng điền vào tất cả các trường bắt buộc.';
        }
    }
    

    ?>
    <?php
     if (isset($_GET['MaDichVu']))
     {
         $maDichVu = $_GET['MaDichVu'];
         deleteDichVu($maDichVu);
     }

     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['exportdv'])) {
        // Xử lý xuất Excel dựa trên từ khóa tìm kiếm
        $searchK = isset($_POST['exportReport']) ? $_POST['exportReport'] : '';
        exportServiceToExcel($searchK);
    }
    ?>
    

    </form>
   


</div>
