<?php

include 'dbconnect.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


// Service:------------------------------------------------------------------                         Service 
function exportServiceToExcel($searchKeyword = '') {
    $spreadsheet = new Spreadsheet();


    $sheet = $spreadsheet->getActiveSheet();

    // Set column headers
    $sheet->setCellValue('A1', 'STT');
    $sheet->setCellValue('B1', 'Mã Dịch Vụ');
    $sheet->setCellValue('C1', 'Tên Dịch Vụ');
    $sheet->setCellValue('D1', 'Image');
    $sheet->setCellValue('E1', 'Mô Tả Dịch Vụ');
    $sheet->setCellValue('F1', 'Đơn Giá Dịch Vụ');

    // Fetch service data based on the search criteria
    $conn = connectDB();
    $query = "SELECT * FROM DichVu WHERE TenDichVu LIKE '%$searchKeyword%'";
    $result = executeQuery($conn, $query);

    // Set initial row index
    $rowIndex = 2;

    while ($row = mysqli_fetch_assoc($result)) {
        // Populate the worksheet with service data
        $sheet->setCellValue('A' . $rowIndex, $rowIndex - 1);
        $sheet->setCellValue('B' . $rowIndex, $row['MaDichVu']);
        $sheet->setCellValue('C' . $rowIndex, $row['TenDichVu']);
        $sheet->setCellValue('D' . $rowIndex, $row['Anh']);
        $sheet->setCellValue('E' . $rowIndex, $row['MoTaDichVu']);
        $sheet->setCellValue('F' . $rowIndex, $row['DonGiaDichVu']);

        // Increment row index
        $rowIndex++;
    }

    // thể hiện mới của lớp Xlsx được tạo ra, đây là một lớp viết được cung cấp bởi thư viện PhpSpreadsheet. 
    // Lớp này được sử dụng để viết tệp Excel trong định dạng XLSX
    $writer = new Xlsx($spreadsheet);
    $excelFileName = 'service_data.xlsx';
    $writer->save($excelFileName);

    // Provide a download link for the generated Excel file
    echo '<script>';
    echo 'window.location.href = "' . $excelFileName . '";';
    echo '</script>';

    mysqli_close($conn);
}


function getNextMaDichVu() {
    $conn = connectDB(); // Giả sử bạn có một hàm để kết nối đến cơ sở dữ liệu

    // Lấy Mã Dịch Vụ lớn nhất từ bảng DICHVU
    $query = "SELECT MAX(CAST(SUBSTRING(MaDichVu, 3) AS UNSIGNED)) AS maxMaDichVu FROM DICHVU";
    $result = executeQuery($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $maxMaDichVu = $row['maxMaDichVu'];

    // Tăng giá trị Mã Dịch Vụ lớn nhất để có được mã tiếp theo
    $nextMaDichVu = "DV" . str_pad($maxMaDichVu + 1, 2, '00', STR_PAD_LEFT);

    mysqli_close($conn);

    return $nextMaDichVu;
}


function displayDichVuData() {
    $conn = connectDB();
    $query = "SELECT * FROM DichVu";
    $result = executeQuery($conn, $query);
    $STT=1;
while ($row = mysqli_fetch_assoc($result)) {
    $thanhTienFormatted = number_format($row['DonGiaDichVu'], 0, ',', '.') . " VND";
    echo "<tr>";
    echo "<td style='width: 2%;' class='STT'>" . $STT++ . "</td>";
    echo "<td style='width: 10%;' class='maDichVu'>" . $row['MaDichVu'] . "</td>";
    echo "<td style='width: 20%;' class='tenDichVu'>" . $row['TenDichVu'] . "</td>";

    echo "<td style='width: 15%;' class='anh'>";
    echo "<span class='filename'>" . $row['Anh'] . "</span>";
    echo "<img src=\"../access/images/{$row['Anh']}\" alt=\"Anh\" class='img-hover'>";
    echo "</td>";

    echo "<td style='width: 25%;' class='moTaDichVu'>" . $row['MoTaDichVu'] . "</td>";
    echo "<td style='width: 10%;' class='DonGiaDichVu'>" .  $thanhTienFormatted . "</td>";
    echo "<td style='width: 7%;' class='hanhdong'>
        <a href='../admin/index.php?act=upddv&MaDichVu=" . $row['MaDichVu'] . "'><i class='fas fa-wrench'></i></a>
        <a href='../admin/index.php?act=deldv&MaDichVu=" . $row['MaDichVu'] . "'><i class='fas fa-trash-alt'></i></a>
    </td>";
    echo "</tr>";
}
    mysqli_close($conn);
}

function searchDichVuData($tendv) {
    $conn = connectDB();
    $query = "SELECT * FROM DichVu WHERE TenDichVu LIKE '%$tendv%'";
    $result = executeQuery($conn, $query);
    $STT=1;
    while ($row = mysqli_fetch_assoc($result)) {
        $thanhTienFormatted = number_format($row['DonGiaDichVu'], 0, ',', '.')." VND";
        echo "<tr>";
        echo "<td style='width: 5%;' class='STT'>".$STT++ ."</td>";
        echo "<td style='width: 10%;'class='maDichVu'>" . $row['MaDichVu'] . "</td>";
        echo "<td style='width: 20%;' class='tenDichVu'>" . $row['TenDichVu'] . "</td>";
        echo "<td style='width: 15%;'class='anh' title='<img src=\"" . $row['Anh'] . "\" alt=\"Anh\" style=\"width:100%\">'>" . $row['Anh'] . "</td>";
        echo "<td style='width: 30%;'class='moTaDichVu'>" . $row['MoTaDichVu'] . "</td>";
        echo "<td style='width: 10%;'class='DonGiaDichVu'>" .  $thanhTienFormatted  . "</td>";
        echo "<td style='width: 10%;'class='hanhdong'>
        <a href='../admin/index.php?act=upddv&MaDichVu=" . $row['MaDichVu'] . "'><i class='fas fa-wrench'></i></a>
        <a href='../admin/index.php?act=deldv&MaDichVu=" . $row['MaDichVu'] . "'><i class='fas fa-trash-alt'></i></a>
        </td>";

        echo "</tr>";
    }
    mysqli_close($conn);
}





function getDichVuByMaDichVu($maDichVu) {
    $conn = connectDB();
    $query = "SELECT * FROM DichVu WHERE MaDichVu = '$maDichVu'";
    $result = executeQuery($conn, $query);

    // Kiểm tra xem có dữ liệu trả về hay không
    if ($row = mysqli_fetch_assoc($result)) {
        mysqli_close($conn);
        return $row;
    } else {
        mysqli_close($conn);
        return null;
    }
}
function addDichVu($maDichVu, $tenDichVu, $anh, $moTaDichVu, $donGiaDichVu, $loaiDichVu) {
    $conn = connectDB();

    // Sử dụng câu lệnh chuẩn bị để ngăn chặn injection SQL
    $query = "INSERT INTO DichVu (MaDichVu, TenDichVu, Anh, MoTaDichVu, DonGiaDichVu, LoaiDichVu) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Kiểm tra lỗi câu lệnh chuẩn bị
    if (!$stmt) {
        die('Error: ' . mysqli_error($conn));
    }

    // Liên kết các tham số
    mysqli_stmt_bind_param($stmt, "ssssii", $maDichVu, $tenDichVu, $anh, $moTaDichVu, $donGiaDichVu, $loaiDichVu);

    // Thực hiện câu lệnh
    mysqli_stmt_execute($stmt);

    // Đóng câu lệnh chuẩn bị
    mysqli_stmt_close($stmt);

    // Đóng kết nối
    mysqli_close($conn);

    echo '<script>';
    echo 'window.location.href = "../admin/index.php?act=dichvu";';
    echo 'alert("Thêm Dịch Vụ Thành Công.");';
    echo '</script>';
}




// Hàm sửa thông tin dịch vụ
function updateDichVu($maDichVu, $tenDichVu, $anh, $moTaDichVu, $donGiaDichVu, $loaiDichVu) {
    $conn = connectDB();

    // Sử dụng câu lệnh chuẩn bị để ngăn chặn injection SQL
    $query = "UPDATE DichVu SET TenDichVu=?, Anh=?, MoTaDichVu=?, DonGiaDichVu=?, LoaiDichVu=? WHERE MaDichVu=?";
    $stmt = mysqli_prepare($conn, $query);

    // Kiểm tra lỗi câu lệnh chuẩn bị
    if (!$stmt) {
        die('Error: ' . mysqli_error($conn));
    }
    // Liên kết các tham số
    mysqli_stmt_bind_param($stmt, "sssiis", $tenDichVu, $anh, $moTaDichVu, $donGiaDichVu, $loaiDichVu, $maDichVu);
    // Thực hiện câu lệnh
    mysqli_stmt_execute($stmt);
    // Đóng câu lệnh chuẩn bị
    mysqli_stmt_close($stmt);
    // Đóng kết nối
    mysqli_close($conn);

    echo '<script>';
    echo 'window.location.href = "../admin/index.php?act=dichvu";';
    echo 'alert("Đã cập nhật thông tin dịch vụ thành công!.");';
    echo '</script>';
}


// Hàm xóa dịch vụ
function deleteDichVu($maDV) {
    $conn = connectDB();
    $query = "DELETE FROM DichVu WHERE MaDichVu='$maDV'";
    executeQuery($conn, $query);
    echo '<script>';
    echo 'alert("Xóa Dịch Vụ Thành Công.");';
    echo 'window.location.href = "../admin/index.php?act=dichvu";';
    echo '</script>';
exit; 

}


// Service:------------------------------------------------------------------                        end  Service 



// :--------------------------------------------------                                                   Employees
function exportEmployeeToExcel() {
    
    $spreadsheet = new Spreadsheet();
    
    // Add a worksheet
    $sheet = $spreadsheet->getActiveSheet();
    
    // Set column headers
    $sheet->setCellValue('A1', 'STT');
    $sheet->setCellValue('B1', 'Mã Nhân Viên');
    $sheet->setCellValue('C1', 'Tên Nhân Viên');
    $sheet->setCellValue('D1', 'UserID');
    
    // Fetch employee data
    $conn = connectDB();
    $query = "SELECT * FROM NhanVien";
    $result = executeQuery($conn, $query);

    // Set initial row index
    $rowIndex = 2;
    
    while ($row = mysqli_fetch_assoc($result)) {
        // Populate the worksheet with employee data
        $sheet->setCellValue('A' . $rowIndex, $rowIndex - 1);
        $sheet->setCellValue('B' . $rowIndex, $row['MaNhanVien']);
        $sheet->setCellValue('C' . $rowIndex, $row['TenNhanVien']);
        $sheet->setCellValue('D' . $rowIndex, $row['UserID']);

        // Increment row index
        $rowIndex++;
    }

    // Save the spreadsheet to a file
    $writer = new Xlsx($spreadsheet);
    $excelFileName = 'employee_data.xlsx';
    $writer->save($excelFileName);

    // Provide a download link for the generated Excel file
    echo '<script>';
    echo 'window.location.href = "' . $excelFileName . '";';
    echo '</script>';

    mysqli_close($conn);
}

function getNextMaNhanVien() {
    $conn = connectDB(); 

    // Lấy Mã Nhân Viên lớn nhất từ bảng NhanVien
    $query = "SELECT MAX(CAST(SUBSTRING(MaNhanVien, 3) AS UNSIGNED)) AS maxMaNhanVien FROM NhanVien";
    $result = executeQuery($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $maxMaNhanVien = $row['maxMaNhanVien'];

    // Tăng giá trị Mã Nhân Viên lớn nhất để có được mã tiếp theo
    $nextMaNhanVien = "NV" . str_pad($maxMaNhanVien + 1, 3, '0', STR_PAD_LEFT);

    mysqli_close($conn);

    return $nextMaNhanVien;
}
function getNhanVienByMaNhanVien($MaNhanVien) {
    $conn = connectDB();
    $query = "SELECT * FROM NhanVien WHERE MaNhanVien = '$MaNhanVien'";
    $result = executeQuery($conn, $query);

    // Kiểm tra xem có dữ liệu trả về hay không
    if ($row = mysqli_fetch_assoc($result)) {
        mysqli_close($conn);
        return $row;
    } else {
        mysqli_close($conn);
        return null;
    }
}

function addEmployee($tenNhanVien, $email) {
    $conn = connectDB();

    // Lấy Mã Nhân Viên tự động tăng
    $nextMaNhanVien = getNextMaNhanVien();

    // Lấy UserID từ email
    $userID = getUserIDByEmail($email);
    if (!$userID) {
        // Nếu không tìm thấy UserID, hiển thị thông báo lỗi và kết thúc hàm
        echo '<script>';
        echo 'alert("Không tìm thấy UserID cho Email: ' . $email . '");';
        echo '</script>';
        return;
    }

    // Sử dụng prepared statement để tránh SQL injection
    $query = "INSERT INTO NhanVien (MaNhanVien, TenNhanVien, Email, UserID) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $nextMaNhanVien, $tenNhanVien, $email, $userID);

    // Thực hiện truy vấn
    $success = mysqli_stmt_execute($stmt);

    // Đóng kết nối và trả về kết quả (true nếu thêm thành công, false nếu thất bại)
    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    return $success;
}
function displayEmployeeData() {
    $conn = connectDB();
    $query = "SELECT * FROM NhanVien";
    $result = executeQuery($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['MaNhanVien']}</td>
                <td>{$row['TenNhanVien']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['UserID']}</td>
                <td class='hanhdong'>
                    <a href='../admin/index.php?act=updatenv&MaNhanVien=" . $row['MaNhanVien'] . "'><i class='fas fa-wrench'></i></a>
                    <a href='../admin/index.php?act=delnv&MaNhanVien=" . $row['MaNhanVien'] . "'><i class='fas fa-trash-alt'></i></a>
                </td>
            </tr>";
    }

    echo "</table>";
    mysqli_close($conn);
}
function searchEmployeeData($tennhanvien) {
    $conn = connectDB();
    $query = "SELECT * FROM NhanVien WHERE TenNhanVien LIKE '%$tennhanvien%'";
    $result = executeQuery($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['MaNhanVien']}</td>
                <td>{$row['TenNhanVien']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['UserID']}</td>
                <td class='hanhdong'>
                    <a href='../admin/index.php?act=updatenv&MaNhanVien=" . $row['MaNhanVien'] . "'><i class='fas fa-wrench'></i></a>
                    <a href='../admin/index.php?act=delnv&MaNhanVien=" . $row['MaNhanVien'] . "'><i class='fas fa-trash-alt'></i></a>
                </td>
            </tr>";
    }

    echo "</table>";
    mysqli_close($conn);
}


function getUserIDByEmail($email) {
    $conn = connectDB();

    // Sử dụng prepared statement để tránh SQL injection
    $query = "SELECT UserID FROM LoaiTaiKhoan WHERE LOWER(Email) = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);

    // Thực hiện truy vấn
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $userID);

    // Lấy kết quả
    mysqli_stmt_fetch($stmt);

    // Đóng kết nối và trả về UserID
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $userID;
}
// Hàm thêm mới nhân viên với tự động nhập UserID từ bảng TaiKhoan




// Hàm xóa nhân viên
function deleteEmployee($maNhanVien) {
    $conn = connectDB();
    $query = "DELETE FROM NhanVien WHERE MaNhanVien='$maNhanVien'";
    executeQuery($conn, $query);
    echo '<script>';
    echo 'window.location.href = "../admin/index.php?act=nhanvien";';
    echo 'alert("Xóa Nhân Viên Thành Công.");';
    echo '</script>';
    mysqli_close($conn);
}
// Hàm sửa thông tin nhân viên
function editEmployee($maNhanVien, $tenNhanVien, $email, $userID) {
    $conn = connectDB();
    $query = "UPDATE NhanVien SET TenNhanVien='$tenNhanVien', Email='$email', UserID=$userID WHERE MaNhanVien='$maNhanVien'";
    executeQuery($conn, $query);
    echo '<script>';
    echo 'window.location.href = "../admin/index.php?act=nhanvien";';
    echo 'alert("Cập nhật thông tin nhân viên  thành công!.");';
    echo '</script>';
    mysqli_close($conn);
}

// :--------------------------------------------------                                           end     Employees



// customer:-------------------------------------------------------------------                  customer
function exportCustomerToExcel() {
    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    
    // Add a worksheet
    $sheet = $spreadsheet->getActiveSheet();
    
    // Set column headers
    $sheet->setCellValue('A1', 'STT');
    $sheet->setCellValue('B1', 'Mã Khách Hàng');
    $sheet->setCellValue('C1', 'Tên Khách Hàng');
    $sheet->setCellValue('D1', 'Địa Chỉ');
    $sheet->setCellValue('E1', 'Email');
    $sheet->setCellValue('F1', 'Số Điện Thoại');
    $sheet->setCellValue('G1', 'UserID');
    
    // Fetch customer data
    $conn = connectDB();
    $query = "SELECT * FROM KhachHang";
    $result = executeQuery($conn, $query);

    // Set initial row index
    $rowIndex = 2;
    
    while ($row = mysqli_fetch_assoc($result)) {
        // Populate the worksheet with customer data
        $sheet->setCellValue('A' . $rowIndex, $rowIndex - 1);
        $sheet->setCellValue('B' . $rowIndex, $row['MaKhachHang']);
        $sheet->setCellValue('C' . $rowIndex, $row['TenKhachHang']);
        $sheet->setCellValue('D' . $rowIndex, $row['DiaChi']);
        $sheet->setCellValue('E' . $rowIndex, $row['Email']);
        $sheet->setCellValue('F' . $rowIndex, $row['SDT']);
        $sheet->setCellValue('G' . $rowIndex, $row['UserID']);

        // Increment row index
        $rowIndex++;
    }

    // Save the spreadsheet to a file
    $writer = new Xlsx($spreadsheet);
    $excelFileName = 'customer_data.xlsx';
    $writer->save($excelFileName);

    // Provide a download link for the generated Excel file
    echo '<script>';
    echo 'window.location.href = "' . $excelFileName . '";';
    echo '</script>';

    mysqli_close($conn);

}

function addCustomer($tenKhachHang, $diaChi, $email, $sdt) {
    $conn = connectDB();

    // Lấy Mã Khách Hàng tự động tăng
    $maKhachHang = getNextMaKhachHang();

    // Lấy UserID từ email
    $userID = getUserIDByEmail($email);
    if (!$userID) {
        // Nếu không tìm thấy UserID, hiển thị thông báo lỗi và kết thúc hàm
        echo '<script>';
        echo 'alert("Không tìm thấy UserID cho Email: ' . $email . '");';
        echo '</script>';
        return;
    }

    // Thực hiện truy vấn để thêm khách hàng mới
    $query = "INSERT INTO KhachHang (MaKhachHang, TenKhachHang, DiaChi, Email, SDT, UserID) 
              VALUES (?,?,?,?,?,?)";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $maKhachHang, $tenKhachHang,$diaChi, $email,$sdt, $userID);

    // Thực hiện truy vấn
    $success = mysqli_stmt_execute($stmt);

    // Đóng kết nối và trả về kết quả (true nếu thêm thành công, false nếu thất bại)
    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    return $success;
}
function getKhachHangByMaKhachHang($MaKhachHang) {
    $conn = connectDB();
    $query = "SELECT * FROM KhachHang WHERE MaKhachHang = '$MaKhachHang'";
    $result = executeQuery($conn, $query);

    // Kiểm tra xem có dữ liệu trả về hay không
    if ($row = mysqli_fetch_assoc($result)) {
        mysqli_close($conn);
        return $row;
    } else {
        mysqli_close($conn);
        return null;
    }
}

function displayCustomerData() {
    $conn = connectDB();
    $query = "SELECT * FROM KhachHang";
    $result = executeQuery($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['MaKhachHang']}</td>
                <td>{$row['TenKhachHang']}</td>
                <td>{$row['DiaChi']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['SDT']}</td>
                <td>{$row['UserID']}</td>
                <td class='hanhdong'>
                    <a href='../admin/index.php?act=updatekh&MaKhachHang=" . $row['MaKhachHang'] . "'><i class='fas fa-wrench'></i></a>
                    <a href='../admin/index.php?act=delkh&MaKhachHang=" . $row['MaKhachHang'] . "'><i class='fas fa-trash-alt'></i></a>
                </td>
            </tr>";
    }

    echo "</table>";
    mysqli_close($conn);
}

function updateCustomer($maKhachHang, $tenKhachHang, $diaChi, $email, $sdt, $userID) {
    $conn = connectDB();
    $query = "UPDATE KhachHang SET TenKhachHang='$tenKhachHang', DiaChi='$diaChi', Email='$email', SDT='$sdt', UserID='$userID' WHERE MaKhachHang='$maKhachHang'";
    executeQuery($conn, $query);
    echo '<script>';
    echo 'window.location.href = "../admin/index.php?act=khachhang";';
    echo 'alert("Cập nhật thông tin khách hàng thành công!");';
    echo '</script>';
    mysqli_close($conn);
}
// Hàm tự động tăng mã khách hàng
function getNextMaKhachHang() {
    $conn = connectDB();

    // Lấy Mã Khách Hàng lớn nhất từ bảng KhachHang
    $query = "SELECT MAX(CAST(SUBSTRING(MaKhachHang, 3) AS UNSIGNED)) AS maxMaKhachHang FROM KhachHang";
    $result = executeQuery($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $maxMaKhachHang = $row['maxMaKhachHang'];

    // Tăng giá trị Mã Khách Hàng lớn nhất để có được mã tiếp theo
    $nextMaKhachHang = "KH" . str_pad($maxMaKhachHang + 1, 3, '0', STR_PAD_LEFT);

    mysqli_close($conn);

    return $nextMaKhachHang;
}



// Xóa khách hàng
function deleteCustomer($maKhachHang) {
    $conn = connectDB();
    $query = "DELETE FROM KhachHang WHERE MaKhachHang='$maKhachHang'";
    executeQuery($conn, $query);
    echo '<script>';
    echo 'window.location.href = "../admin/index.php?act=khachhang";';
    echo 'alert("Xóa Khách Hàng Thành Công.");';
    echo '</script>';
    exit; // Ensure that the script stops execution after the redirect
}

// Tìm kiếm khách hàng theo Tên Khách Hàng
function searchCustomer($tenKhachHang) {
    $conn = connectDB();
    $query = "SELECT * FROM KhachHang WHERE TenKhachHang LIKE '%$tenKhachHang%'";
    $result = executeQuery($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['MaKhachHang']}</td>
                <td>{$row['TenKhachHang']}</td>
                <td>{$row['DiaChi']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['SDT']}</td>
                <td>{$row['UserID']}</td>
                <td class='hanhdong'>
                    <a href='../admin/index.php?act=updatekh&MaKhachHang=" . $row['MaKhachHang'] . "'><i class='fas fa-wrench'></i></a>
                    <a href='../admin/index.php?act=delkh&MaKhachHang=" . $row['MaKhachHang'] . "'><i class='fas fa-trash-alt'></i></a>
                </td>
            </tr>";
    }

    echo "</table>";
    mysqli_close($conn);
}

// customer:-------------------------------------------------------------------                    end customer



// order:-------------------------------------------------------------                              order
function exportOrderToExcel($startDate, $endDate, $search) {
    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();

    // Add a worksheet
    $sheet = $spreadsheet->getActiveSheet();

    // Set column headers
    $sheet->setCellValue('A1', 'STT');
    $sheet->setCellValue('B1', 'Mã Đơn Hàng');
    $sheet->setCellValue('C1', 'Khách Hàng');
    $sheet->setCellValue('D1', 'Dịch Vụ');
    $sheet->setCellValue('E1', 'Thành Tiền');
    $sheet->setCellValue('F1', 'Ngày Đặt');
    $sheet->setCellValue('G1', 'Thanh Toán');
    $sheet->setCellValue('H1', 'Trạng Thái');

    // Fetch order data with details based on search criteria
    $conn = connectDB();
    $query = "SELECT DonHang.*, KHACHHANG.TenKhachHang, DICHVU.TenDichVu, HinhThucThanhToan.TenHinhThucThanhToan, TrangThai.TenTrangThai
              FROM DonHang
              JOIN KHACHHANG ON DonHang.MaKhachHang = KHACHHANG.MaKhachHang
              JOIN DICHVU ON DonHang.MaDichVu = DICHVU.MaDichVu
              JOIN HinhThucThanhToan ON DonHang.MaThanhToan = HinhThucThanhToan.MaThanhToan
              JOIN TrangThai ON DonHang.MaTrangThai = TrangThai.MaTrangThai
              WHERE (DonHang.ngaydat BETWEEN '$startDate' AND '$endDate') AND (DonHang.MaDonHang LIKE '%$search%' OR KHACHHANG.TenKhachHang LIKE '%$search%' OR DICHVU.TenDichVu LIKE '%$search%')";

    $result = executeQuery($conn, $query);

    // Set initial row index
    $rowIndex = 2;
    while ($row = mysqli_fetch_assoc($result)) {
        // Populate the worksheet with order data
        $sheet->setCellValue('A' . $rowIndex, $rowIndex - 1);
        $sheet->setCellValue('B' . $rowIndex, $row['MaDonHang']);
        $sheet->setCellValue('C' . $rowIndex, $row['TenKhachHang']);
        $sheet->setCellValue('D' . $rowIndex, $row['TenDichVu']);
        $sheet->setCellValue('E' . $rowIndex, $row['ThanhTien']);
        $sheet->setCellValue('F' . $rowIndex, $row['ngaydat']);
        $sheet->setCellValue('G' . $rowIndex, $row['TenHinhThucThanhToan']);
        $sheet->setCellValue('H' . $rowIndex, $row['TenTrangThai']);

        // Increment row index
        $rowIndex++;
    }

    // Save the spreadsheet to a file
    $writer = new Xlsx($spreadsheet);
    $excelFileName = 'order_data.xlsx';
    $writer->save($excelFileName);

    // Provide a download link for the generated Excel file
    echo '<script>';
    echo 'window.location.href = "' . $excelFileName . '";';
    echo '</script>';

    mysqli_close($conn);
}

// Hiển thị thông tin tất cả đơn hàng
function displayOrderDataWithDetails() {
    $conn = connectDB();
    $query = "SELECT DonHang.*,KHACHHANG.TenKhachHang, DICHVU.TenDichVu, HinhThucThanhToan.TenHinhThucThanhToan, TrangThai.TenTrangThai
              FROM DonHang
              JOIN KHACHHANG ON DonHang.MaKhachHang = KHACHHANG.MaKhachHang
              JOIN DICHVU ON DonHang.MaDichVu = DICHVU.MaDichVu
              JOIN HinhThucThanhToan ON DonHang.MaThanhToan = HinhThucThanhToan.MaThanhToan
              JOIN TrangThai ON DonHang.MaTrangThai = TrangThai.MaTrangThai";
    $result = executeQuery($conn, $query);
    $stt = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        $thanhTienFormatted = number_format($row['ThanhTien'], 0, ',', '.')." VND";

        echo "<tr>
                <td>".$stt++."</td>
                <td>{$row['MaDonHang']}</td>
                <td>{$row['TenKhachHang']}</td>
                <td>{$row['TenDichVu']}</td>
                <td>{$thanhTienFormatted}</td>
                <td>{$row['ngaydat']}</td>
                <td>{$row['TenHinhThucThanhToan']}</td>
                <td>{$row['TenTrangThai']}</td>
                <td class='hanhdong'>
                    <a href='../admin/index.php?act=upddh&MaDonHang=" . $row['MaDonHang'] . "'><i class='fas fa-check'></i></a>
                    <a href='../admin/index.php?act=deldh&MaDonHang=" . $row['MaDonHang'] . "'><i class='fas fa-trash-alt'></i></a>
                </td>
              </tr>";
    }

    echo "</table>";
    mysqli_close($conn);
}
function searchdisplayOrderDataWithDetails($startDate, $endDate, $search) {
    $conn = connectDB();

    $query = "SELECT DonHang.*, KHACHHANG.TenKhachHang, DICHVU.TenDichVu, HinhThucThanhToan.TenHinhThucThanhToan, TrangThai.TenTrangThai
              FROM DonHang
              JOIN KHACHHANG ON DonHang.MaKhachHang = KHACHHANG.MaKhachHang
              JOIN DICHVU ON DonHang.MaDichVu = DICHVU.MaDichVu
              JOIN HinhThucThanhToan ON DonHang.MaThanhToan = HinhThucThanhToan.MaThanhToan
              JOIN TrangThai ON DonHang.MaTrangThai = TrangThai.MaTrangThai
              WHERE (DonHang.ngaydat BETWEEN '$startDate' AND '$endDate') AND (DonHang.MaDonHang LIKE '%$search%' OR KHACHHANG.TenKhachHang LIKE '%$search%' OR DICHVU.TenDichVu LIKE '%$search%')";

    $result = executeQuery($conn, $query);
    $stt = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        $thanhTienFormatted = number_format($row['ThanhTien'], 0, ',', '.')." VND";

        echo "<tr>
                <td>".$stt++."</td>
                <td>{$row['MaDonHang']}</td>
                <td>{$row['TenKhachHang']}</td>
                <td>{$row['TenDichVu']}</td>
                <td>{$thanhTienFormatted}</td>
                <td>{$row['ngaydat']}</td>
                <td>{$row['TenHinhThucThanhToan']}</td>
                <td>{$row['TenTrangThai']}</td>
                <td class='hanhdong'>
                    <a href='../admin/index.php?act=upddh&MaDonHang=" . $row['MaDonHang'] . "'><i class='fas fa-check'></i></a>
                    <a href='../admin/index.php?act=deldh&MaDonHang=" . $row['MaDonHang'] . "'><i class='fas fa-times'></i></a>
                </td>
              </tr>";
    }

    echo "</table>";
    mysqli_close($conn);
}
function getOderByMaDonHang($MaDonHang) {
    $conn = connectDB();
    $query = "SELECT DonHang.*, TrangThai.TenTrangThai
              FROM DonHang
            --   JOIN DICHVU ON DonHang.MaDichVu = DICHVU.MaDichVu
            --   JOIN KHACHHANG ON DonHang.MaKhachHang = KHACHHANG.MaKhachHang
              JOIN TrangThai ON DonHang.MaTrangThai = TrangThai.MaTrangThai
            --   JOIN HinhThucThanhToan ON DonHang.MaThanhToan = HinhThucThanhToan.MaThanhToan
              WHERE DonHang.MaDonHang = '$MaDonHang'";
    $result = executeQuery($conn, $query);

    // Kiểm tra xem có dữ liệu trả về hay không
    if ($row = mysqli_fetch_assoc($result)) {
        mysqli_close($conn);
        return $row;
    } else {
        mysqli_close($conn);
        return null;
    }
}

// Sửa thông tin đơn hàng
function editOrder($maDonHang, $maKhachHang, $maDichVu, $thanhTien, $ngayDat, $maThanhToan,$maTrangThai) {
    $conn = connectDB();
    $query = "UPDATE DonHang SET MaKhachHang='$maKhachHang', MaDichVu='$maDichVu', ThanhTien=$thanhTien, 
              ngaydat='$ngayDat', MaThanhToan='$maThanhToan', MaTrangThai='$maTrangThai' WHERE MaDonHang='$maDonHang'";
    executeQuery($conn, $query);
    echo '<script>';
    echo 'window.location.href = "../admin/index.php?act=donhang";';
    echo 'alert("Cập nhật Đơn Hàng Thành Công. Mã Đơn Hàng: ' . $maDonHang . '");';
    echo '</script>';
    mysqli_close($conn);
}

// Xóa đơn hàng
function deleteOrder($maDonHang) {
    $conn = connectDB();

    $maDonHang = mysqli_real_escape_string($conn, $maDonHang);

    $query = "DELETE FROM DonHang WHERE MaDonHang = '$maDonHang'";

    $result = executeQuery($conn, $query);

    if ($result) {
        echo '<script>';
        echo 'alert("Xóa Đơn Hàng Thành Công.");';
        echo 'window.location.href = "../admin/index.php?act=donhang";';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Xóa Đơn Hàng Thất Bại. Vui lòng thử lại.");';
        echo 'window.location.href = "../admin/index.php?act=donhang";';
        echo '</script>';
    }

    mysqli_close($conn);
    exit;
}



function addOrder($maKhachHang, $maDichVu, $thanhTien, $ngayDat, $maTrangThai, $maThanhToan) {
    $conn = connectDB();

    $queryMaxID = "SELECT MAX(CAST(SUBSTRING(MaDonHang, 3) AS UNSIGNED)) AS maxID FROM DonHang";
    $resultMaxID = executeQuery($conn, $queryMaxID);
    $rowMaxID = mysqli_fetch_assoc($resultMaxID);
    $maxID = $rowMaxID['maxID'];
    $nextID = $maxID + 1;
    $maDonHang = "DH" . str_pad($nextID, 4, '0', STR_PAD_LEFT);

    // Thêm mới đơn hàng
    $query = "INSERT INTO DonHang (MaDonHang, MaKhachHang, MaDichVu, ThanhTien, ngaydat, MaTrangThai, MaThanhToan) 
              VALUES ('$maDonHang', '$maKhachHang', '$maDichVu', $thanhTien, '$ngayDat', '$maTrangThai', '$maThanhToan')";
    executeQuery($conn, $query);
    
    echo '<script>';
    echo 'window.location.href = "../admin/index.php?act=donhang";';
    echo 'alert("Thêm Đơn Hàng Thành Công. Mã Đơn Hàng: ' . $maDonHang . '");';
    echo '</script>';
    mysqli_close($conn);
}
function getNextMaDonHang() {
    $conn = connectDB();

    // Lấy Mã Khách Hàng lớn nhất từ bảng KhachHang
    $query = "SELECT MAX(CAST(SUBSTRING(MaDonHang, 3) AS UNSIGNED)) AS maxMaxMaDonHang FROM DonHang";
    $result = executeQuery($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $maxMaDonHang = $row['maxMaxMaDonHang'];

    // Tăng giá trị Mã Khách Hàng lớn nhất để có được mã tiếp theo
    $nextMaMaDonHang = "DH" . str_pad($maxMaDonHang + 1, 3, '0', STR_PAD_LEFT);

    mysqli_close($conn);

    return $nextMaMaDonHang;
}



// function deleteOrder($maDonHang) {
//     $conn = connectDB();
//     $query = "DELETE FROM DonHang WHERE MaDonHang='$maDonHang'";
//     executeQuery($conn, $query);
//     echo '<script>';
//     echo 'window.location.href = "../admin/index.php?act=donhang";';
//     echo 'alert("Xóa Đơn Hàng Thành Công.");';
//     echo '</script>';
//     exit; // Ensure that the script stops execution after the redirect
// }

// Tìm kiếm đơn hàng theo Mã Đơn Hàng
function searchOrderByMaDonHang($maDonHang) {
    $conn = connectDB();
    $query = "SELECT * FROM DonHang WHERE MaDonHang LIKE '%$maDonHang%'";
    $result = executeQuery($conn, $query);

    echo "<h2>Kết quả tìm kiếm đơn hàng</h2>";
    echo "<table border='1'>
            <tr>
                <th>Mã Đơn Hàng</th>
                <th>Mã Khách Hàng</th>
                <th>Mã Dịch Vụ</th>
                <th>Thành Tiền</th>
                <th>Ngày Đặt</th>
                <th>Mã Trạng Thái</th>
                <th>Mã Thanh Toán</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['MaDonHang']}</td>
                <td>{$row['MaKhachHang']}</td>
                <td>{$row['MaDichVu']}</td>
                <td>{$row['ThanhTien']}</td>
                <td>{$row['ngaydat']}</td>
                <td>{$row['MaTrangThai']}</td>
                <td>{$row['MaThanhToan']}</td>
            </tr>";
    }

    echo "</table>";
    mysqli_close($conn);
}



// order:-------------------------------------------------------------                          end    order



// AccountType:-------------------------------------------------                               AccountType
function exportAccountTypeToExcel() {
    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();

    // Add a worksheet
    $sheet = $spreadsheet->getActiveSheet();

    // Set column headers
    $sheet->setCellValue('A1', 'UserID');
    $sheet->setCellValue('B1', 'TenTaiKhoan');
    $sheet->setCellValue('C1', 'Password');
    $sheet->setCellValue('D1', 'Email');
    $sheet->setCellValue('E1', 'Role');

    // Fetch account type data
    $conn = connectDB();
    $query = "SELECT * FROM LoaiTaiKhoan";
    $result = executeQuery($conn, $query);

    // Set initial row index
    $rowIndex = 2;

    while ($row = mysqli_fetch_assoc($result)) {
        // Populate the worksheet with account type data
        $sheet->setCellValue('A' . $rowIndex, $row['UserID']);
        $sheet->setCellValue('B' . $rowIndex, $row['TenTaiKhoan']);
        $sheet->setCellValue('C' . $rowIndex, $row['Password']);
        $sheet->setCellValue('D' . $rowIndex, $row['Email']);
        $sheet->setCellValue('E' . $rowIndex, $row['role']);

        // Increment row index
        $rowIndex++;
    }

    // Save the spreadsheet to a file
    $writer = new Xlsx($spreadsheet);
    $excelFileName = 'account_type_data.xlsx';
    $writer->save($excelFileName);

    // Provide a download link for the generated Excel file
    echo '<script>';
    echo 'window.location.href = "' . $excelFileName . '";';
    echo '</script>';

    mysqli_close($conn);
}
// Hàm hiển thị tất cả các tài khoản
function displayUserData() {
    $conn = connectDB();
    $query = "SELECT * FROM LoaiTaiKhoan";
    $result = executeQuery($conn, $query);
    $stt=1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>".$stt++."</td>
        <td>{$row['UserID']}</td>
        <td>{$row['TenTaiKhoan']}</td>
        <td>{$row['Password']}</td>
        <td>{$row['Email']}</td>
        <td>{$row['role']}</td>
        <td class='hanhdong'>
        <a href='../admin/index.php?act=updatetaikhoan&UserID=" . $row['UserID'] . "'><i class='fas fa-wrench'></i></a>
        <a href='../admin/index.php?act=deltk&UserID=" . $row['UserID'] . "'><i class='fas fa-trash-alt'></i></a>
        </td>
        </tr>";
    }
    mysqli_close($conn);
}
function getNextUserID() {
    $conn = connectDB();

    $query = "SELECT MAX(UserID) AS maxUserID FROM LoaiTaiKhoan";
    $result = executeQuery($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nextUserID = $row['maxUserID'] + 1;

    mysqli_close($conn);

    return $nextUserID;
}
function getTaiKhoanByUserID($UserID) {
    $conn = connectDB();
    $query = "SELECT * FROM LoaiTaiKhoan WHERE UserID = '$UserID'";
    $result = executeQuery($conn, $query);

    // Kiểm tra xem có dữ liệu trả về hay không
    if ($row = mysqli_fetch_assoc($result)) {
        mysqli_close($conn);
        return $row;
    } else {
        mysqli_close($conn);
        return null;
    }
}


// Hàm thêm mới tài khoản
function addAccount($tenTaiKhoan, $password, $email, $role) {
    $conn = connectDB();
    $UserID = getNextUserID();
    $query = "INSERT INTO LoaiTaiKhoan (UserID,TenTaiKhoan, Password, Email, role) VALUES ( ' $UserID','$tenTaiKhoan', '$password', '$email', $role)";
    executeQuery($conn, $query);
    echo '<script>';
    echo 'window.location.href = "../admin/index.php?act=taikhoan";';
    echo 'alert("Thêm Tài Khoản Thành Công.");'; 
    echo '</script>';
    mysqli_close($conn);
}

// Hàm sửa thông tin tài khoản
function editAccount($userID, $tenTaiKhoan, $password, $email, $role) {
    $conn = connectDB();
    $query = "UPDATE LoaiTaiKhoan SET TenTaiKhoan='$tenTaiKhoan', Password='$password', Email='$email', role=$role WHERE UserID=$userID";
    executeQuery($conn, $query);
    echo '<script>';
    echo 'window.location.href = "../admin/index.php?act=taikhoan";';
    echo 'alert("Đã cập nhật thông tin tài khoản  thành công!.");';
    echo '</script>';
    mysqli_close($conn);
}


function deleteAccount($userID) {
    $conn = connectDB();
    $query = "DELETE FROM LoaiTaiKhoan WHERE UserID=$userID";
    executeQuery($conn, $query);
    echo '<script>';
    echo 'window.location.href = "../admin/index.php?act=taikhoan";';
    echo 'alert("Xóa Tài Khoản Thành Công.");'; 
    echo '</script>';
    mysqli_close($conn);
}
// Hàm tìm kiếm tài khoản theo Tên Tài Khoản
function searchAccount($tenTaiKhoan) {
    $conn = connectDB();
    $query = "SELECT * FROM LoaiTaiKhoan WHERE TenTaiKhoan LIKE '%$tenTaiKhoan%'";
    $result = executeQuery($conn, $query);
    $stt=1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>".$stt++."</td>
        <td>{$row['UserID']}</td>
        <td>{$row['TenTaiKhoan']}</td>
        <td>{$row['Password']}</td>
        <td>{$row['Email']}</td>
        <td>{$row['role']}</td>
        <td class='hanhdong'>
        <a href='../admin/index.php?act=updatetaikhoan&UserID=" . $row['UserID'] . "'><i class='fas fa-wrench'></i></a>
        <a href='../admin/index.php?act=deltk&UserID=" . $row['UserID'] . "'><i class='fas fa-trash-alt'></i></a>
        </td>
        </tr>";
    }
    mysqli_close($conn);
}


// Hàm thống kê số lượng tài khoản theo Role
function countAccountsByRole() {
    $conn = connectDB();
    $query = "SELECT role, COUNT(*) as SoLuong FROM LoaiTaiKhoan GROUP BY role";
    $result = executeQuery($conn, $query);

    echo "<h2>Thống kê số lượng tài khoản theo Role</h2>";
    echo "<table border='1'>
            <tr>
                <th>Role</th>
                <th>Số lượng</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['role']}</td>
                <td>{$row['SoLuong']}</td>
            </tr>";
    }

    echo "</table>";
    mysqli_close($conn);
}
// AccountType:-------------------------------------------------                          end     AccountType


// ----------------------------------------------------thống kê
// Hàm tổng số nhân viên:
function getTotalEmployees() {
    $conn = connectDB();

    $query = "SELECT COUNT(*) AS totalEmployees FROM NhanVien";
    $result = executeQuery($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalEmployees = $row['totalEmployees'];

    mysqli_close($conn);

    return $totalEmployees;
}
// Hàm tổng số khách hàng:
function getTotalCustomers() {
    $conn = connectDB();

    $query = "SELECT COUNT(*) AS totalCustomers FROM KhachHang";
    $result = executeQuery($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalCustomers = $row['totalCustomers'];

    mysqli_close($conn);

    return $totalCustomers;
}
// Hàm tổng số đơn hàng:
function getTotalOrders() {
    $conn = connectDB();
 
    $query = "SELECT COUNT(*) AS totalOrders FROM DonHang";
    $result = executeQuery($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalOrders = $row['totalOrders'];

    mysqli_close($conn);

    return $totalOrders;
}
// Hàm tổng số loại tài khoản:
function getTotalAccountTypes() {
    $conn = connectDB();

    $query = "SELECT COUNT(*) AS totalAccountTypes FROM LoaiTaiKhoan";
    $result = executeQuery($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalAccountTypes = $row['totalAccountTypes'];

    mysqli_close($conn);

    return $totalAccountTypes;
}
// Hàm tổng số dịch vụ:
function getTotalServices() {
    $conn = connectDB();

    $query = "SELECT COUNT(*) AS totalServices FROM DICHVU";
    $result = executeQuery($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalServices = $row['totalServices'];

    mysqli_close($conn);

    return $totalServices;
}
function calculateTotalRevenue() {
    $conn = connectDB();

    $query = "SELECT SUM(ThanhTien) AS totalRevenue FROM DonHang";
    $result = executeQuery($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalRevenue = $row['totalRevenue'];

    // Định dạng số tiền với dấu "," hoặc "."
    $formattedTotalRevenue = number_format($totalRevenue, 0, ',', '.');

    // Thêm " VND" vào cuối
    $formattedTotalRevenue .= ' VND';

    mysqli_close($conn);

    return $formattedTotalRevenue;
}

function getOrderDataForChart() {
    $conn = connectDB();
    $query = "SELECT COUNT(*) as order_count, MONTH(ngaydat) as order_month
              FROM DonHang
              GROUP BY order_month";
    $result = executeQuery($conn, $query);

    $months = [];
    $orders = [];

    while ($row = mysqli_fetch_assoc($result)) {
        // Chuyển đổi tháng số thành tên tháng (hoặc giữ nguyên số tùy theo nhu cầu)
        $month = date('F', mktime(0, 0, 0, $row['order_month'], 1));
        $months[] = $month;
        $orders[] = $row['order_count'];
    }

    mysqli_close($conn);

    return ['months' => $months, 'orders' => $orders];
}

function getStatusDataForChart() {
    $conn = connectDB();
    $query = "SELECT COUNT(*) as status_count, TrangThai.TenTrangThai
              FROM DonHang
              JOIN TrangThai ON DonHang.MaTrangThai = TrangThai.MaTrangThai
              GROUP BY DonHang.MaTrangThai";
    $result = executeQuery($conn, $query);

    $labels = [];
    $values = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $labels[] = $row['TenTrangThai'];
        $values[] = $row['status_count'];
    }

    mysqli_close($conn);

    return ['labels' => $labels, 'values' => $values];
}


// Hàm xuất tổng số đơn hàng theo tháng vào file Excel
function exportExcelTotalOrdersByMonth($conn) {
    // Tạo một đối tượng Spreadsheet
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Đặt tên các cột
    $sheet->setCellValue('A1', 'Tháng');
    $sheet->setCellValue('B1', 'Số Lượng Đơn Hàng');
    $sheet->setCellValue('C1', 'Doanh Thu');
    $sheet->setCellValue('D1', 'Tổng Doanh Thu');

    // Thực hiện truy vấn để lấy số lượng đơn hàng và doanh thu theo tháng
    $query = "SELECT MONTH(ngaydat) AS Thang, COUNT(*) AS TongDonHang, SUM(ThanhTien) AS TongDoanhThu FROM DonHang GROUP BY Thang";
    $result = executeQuery($conn, $query);
    
    // Duyệt qua kết quả và điền dữ liệu vào file Excel
    $row = 2;
    $totalAllMonths = 0;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $row, $row_data['Thang']);
        $sheet->setCellValue('B' . $row, $row_data['TongDonHang']);
        $sheet->setCellValue('C' . $row, $row_data['TongDoanhThu']);
        $totalAllMonths += $row_data['TongDoanhThu'];
        $row++;
    }

    // Điền tổng tiền tất cả các tháng vào dòng cuối cùng
    $sheet->setCellValue('D' . ($row), $totalAllMonths);

    // Thư mục lưu trữ file Excel
    $folderPath = '../access/file_xuat/';

    // Tạo tên file duy nhất bằng cách sử dụng timestamp
    $timestamp = time();
    $filename = 'month_' . $timestamp . '.xlsx';

    // Lưu file Excel vào thư mục
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save($folderPath . $filename);

    // Hiển thị thông báo và chuyển hướng
    echo '<script>';
    echo 'alert("Xuất Excel Thành Công.");';
    echo '</script>';
}



?>






