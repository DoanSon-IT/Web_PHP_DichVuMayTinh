<?php
include 'dbconnect.php';

function displayDichVupc() {
    $conn = connectDB(); // Kết nối đến cơ sở dữ liệu

    // Truy vấn để lấy thông tin từ bảng DICHVU
    $query = "SELECT * FROM DICHVU WHERE LoaiDichVu = 1";
    $result = executeQuery($conn, $query);

    // Kiểm tra xem có dữ liệu hay không
    if (mysqli_num_rows($result) > 0) {
        // Hiển thị dữ liệu ra form
        while ($row = mysqli_fetch_assoc($result)) {
            $thanhTienFormatted = number_format($row['DonGiaDichVu'], 0, ',', '.') . " VND";

            echo '<div class="dichvu">
                    <ul class="dichvu-item">
                        <li><img src="../access/images/' . $row['Anh'] . '" alt=""></li>
                        <li style="display: none;">Mã Dịch Vụ: ' . $row['MaDichVu'] . '</li>
                        <li><strong>' . $row['TenDichVu'] . '</strong></li>
                        <li style="display: none;">Mô Tả Dịch Vụ: ' . $row['MoTaDichVu'] . '</li>
                        <strong style="display: none;" ><li style="color: red;">Giá : ' . $thanhTienFormatted . '</li></strong>
                        <a href="chitietdichvu.php?MaDichVu=' . $row['MaDichVu'] . '"><button><strong>Xem Chi Tiết>></strong></button></a>
                    </ul>
                </div>';
        }
    } else {
        echo "Không có dữ liệu.";
    }

    // Đóng kết nối
    mysqli_close($conn);
}

function displayDichVupm() {
    $conn = connectDB(); // Kết nối đến cơ sở dữ liệu

    // Truy vấn để lấy thông tin từ bảng DICHVU
    $query = "SELECT * FROM DICHVU where LoaiDichVu=2";
    $result = executeQuery($conn, $query);

    // Kiểm tra xem có dữ liệu hay không
    if (mysqli_num_rows($result) > 0) {
        // Hiển thị dữ liệu ra form
        while ($row = mysqli_fetch_assoc($result)) {
            $thanhTienFormatted = number_format($row['DonGiaDichVu'], 0, ',', '.')." VND";
            echo '<div class="dichvu">
                    <ul class="dichvu-item">
                        <li><img src="../access/images/' . $row['Anh'] . '" alt=""></li>
                        <li style="display: none;">Mã Dịch Vụ: ' . $row['MaDichVu'] . '</li>
                        <li><strong>' . $row['TenDichVu'] . '</strong></li>
                        <li style="display: none;">Mô Tả Dịch Vụ: ' . $row['MoTaDichVu'] . '</li>
                        <strong style="display: none;"><li style="color: red;">Giá : ' . $thanhTienFormatted . '</li></strong>
                        <a href="chitietdichvu.php?MaDichVu=' . $row['MaDichVu'] . '"><button><strong>Xem Chi Tiết>></strong></button></a>
                    </ul>
        </div>';
        }
    } else {
        echo "Không có dữ liệu.";
    }
    // Đóng kết nối
    mysqli_close($conn);
}
function displayDichVuk() {
    $conn = connectDB(); // Kết nối đến cơ sở dữ liệu

    // Truy vấn để lấy thông tin từ bảng DICHVU
    $query = "SELECT * FROM DICHVU where LoaiDichVu=3";
    $result = executeQuery($conn, $query);

    // Kiểm tra xem có dữ liệu hay không
    if (mysqli_num_rows($result) > 0) {
        // Hiển thị dữ liệu ra form
        while ($row = mysqli_fetch_assoc($result)) {
            $thanhTienFormatted = number_format($row['DonGiaDichVu'], 0, ',', '.')." VND";
            echo '<div class="dichvu">
            <ul class="dichvu-item">
                <li><img src="../access/images/' . $row['Anh'] . '" alt=""></li>
                <li style="display: none;">Mã Dịch Vụ: ' . $row['MaDichVu'] . '</li>
                <li><strong>' . $row['TenDichVu'] . '</strong></li>
                <li style="display: none;">Mô Tả Dịch Vụ: ' . $row['MoTaDichVu'] . '</li>
                <strong style="display: none;"><li style="color: red;">Giá : ' . $thanhTienFormatted . '</li></strong>
                <a href="chitietdichvu.php?MaDichVu=' . $row['MaDichVu'] . '"><button><strong>Xem Chi Tiết>></strong></button></a>
            </ul>
        </div>';
        }
    } else {
        echo "Không có dữ liệu.";
    }
    // Đóng kết nối
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



function addCustomer($tenKhachHang, $diaChi, $email, $sdt) {
    $conn = connectDB();

    // Lấy Mã Khách Hàng tự động tăng
    $maKhachHang = getNextMaKhachHang();

    // Lấy UserID từ email
    $userID = getUserIDByEmail($email);
    if (!$userID) {
        // Nếu không tìm thấy UserID, hiển thị thông báo lỗi và kết thúc hàm
        echo '<script>';
        echo 'alert("Không Thể Xác định UserID cho Email: ' . $email . '");';
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
function getMaKhachHangByEmail($email) {
    $conn = connectDB();

    $query = "SELECT MaKhachHang FROM KhachHang WHERE Email = ?";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $maKhachHang);

    // Fetch the result
    mysqli_stmt_fetch($stmt);

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $maKhachHang;
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

function getDonGiaDichVu($maDichVu) {
    $conn = connectDB();

    $query = "SELECT DonGiaDichVu FROM DICHVU WHERE MaDichVu = ?";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $maDichVu);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $donGiaDichVu);

    // Fetch the result
    mysqli_stmt_fetch($stmt);

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $donGiaDichVu;
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


// Hàm lấy mã khách hàng từ tên khách hàng
function getMaKhachHangFromTenKhachHang($tenKhachHang) {
    $conn = connectDB();
    $query = "SELECT MaKhachHang FROM KHACHHANG WHERE TenKhachHang = '{$tenKhachHang}'";
    $result = executeQuery($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $maKhachHang = $row['MaKhachHang'];
        mysqli_close($conn);
        return $maKhachHang;
    }
    mysqli_close($conn);
    return null; // Trả về null nếu không tìm thấy
}

// Hiển thị thông tin đơn hàng của một tên khách hàng
function displayOrderDataWithDetails($tenKhachHang) {
    $maKhachHang = getMaKhachHangFromTenKhachHang($tenKhachHang);
    if ($maKhachHang === null) {
        echo '<script>';
        echo 'alert("Bạn Chưa Có Thông Tin Lịch Đặt Nào !");'; 
        echo '</script>';
        return;
    }

    $conn = connectDB();
    $query = "SELECT DonHang.*, KHACHHANG.TenKhachHang, DICHVU.TenDichVu, HinhThucThanhToan.TenHinhThucThanhToan, TrangThai.TenTrangThai
              FROM DonHang
              JOIN KHACHHANG ON DonHang.MaKhachHang = KHACHHANG.MaKhachHang
              JOIN DICHVU ON DonHang.MaDichVu = DICHVU.MaDichVu
              JOIN HinhThucThanhToan ON DonHang.MaThanhToan = HinhThucThanhToan.MaThanhToan
              JOIN TrangThai ON DonHang.MaTrangThai = TrangThai.MaTrangThai
              WHERE DonHang.MaKhachHang = '{$maKhachHang}'";

    $result = executeQuery($conn, $query);
    $stt = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        $thanhTienFormatted = number_format($row['ThanhTien'], 0, ',', '.')." VND";

echo "<tr>
        <td>".$stt++."</td>
        <td style='display: none;'>{$row['MaDonHang']}</td>
        <td style='display: none;'>{$row['TenKhachHang']}</td>
        <td>{$row['TenDichVu']}</td>
        <td>{$thanhTienFormatted}</td>
        <td>{$row['ngaydat']}</td>
        <td>{$row['TenHinhThucThanhToan']}</td>
        <td>{$row['TenTrangThai']}</td>
        <td class='hanhdong'>
            <a href='#' onclick='cd(\"{$row['MaDonHang']}\")'><i class='fas fa-check'></i></a>
            <a href='#' onclick='confirmDelete(\"{$row['MaDonHang']}\")'><i class='fas fa-times'></i></a>
        </td>
    </tr>";

    }

    echo "</table>";
    mysqli_close($conn);
}
function displayCustomerData($maKhachHang) {
    $conn = connectDB();
    $query = "SELECT * FROM KhachHang WHERE MaKhachHang = '{$maKhachHang}'";
    $result = executeQuery($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td style='display: none;'>{$row['MaKhachHang']}</td>
                <td>{$row['TenKhachHang']}</td>
                <td>{$row['DiaChi']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['SDT']}</td>
                <td style='display: none;'>{$row['UserID']}</td>
                <td style='display: none; class='hanhdong'>
                    <a href='../Frontend/updatekh.php=" . $row['MaKhachHang'] . "'><i class='fas fa-wrench'></i></a>
                    <a href='#=" . $row['MaKhachHang'] . "'><i class='fas fa-trash-alt'></i></a>
                </td>
            </tr>";
    }

    echo "</table>";
    mysqli_close($conn);
}

// Hàm lấy tổng số tiền đơn hàng theo tên khách hàng
function getTotalAmountByTenKhachHang($tenKhachHang) {
    $conn = connectDB();
    
    // Lấy mã khách hàng từ tên khách hàng
    $maKhachHang = getMaKhachHangFromTenKhachHang($tenKhachHang);

    if ($maKhachHang !== null) {
        // Lấy tổng số tiền đơn hàng cho mã khách hàng
        $query = "SELECT SUM(ThanhTien) AS TongThanhTien FROM DonHang WHERE MaKhachHang = '{$maKhachHang}'";
        $result = executeQuery($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $tongThanhTien = $row['TongThanhTien'];
            mysqli_close($conn);
            return $tongThanhTien;
        }
    }

    mysqli_close($conn);
    return 0; // Trả về 0 nếu không có đơn hàng hoặc không tìm thấy thông tin khách hàng
}


function deleteOrder($maDonHang) {
    $conn = connectDB();
    
    // You may want to perform additional checks before deleting, for example, checking if the order belongs to the logged-in user.

    $query = "DELETE FROM DonHang WHERE MaDonHang = '{$maDonHang}'";
    $result = executeQuery($conn, $query);

    if ($result) {
        echo '<script>alert("Đã xóa hủy hàng thành công!");</script>';
    } else {
        echo '<script>alert("Không thể xóa đơn hàng. Vui lòng thử lại!");</script>';
    }

    mysqli_close($conn);
}

function displayDichVu($searchTerm = "") {
    $conn = connectDB(); // Kết nối đến cơ sở dữ liệu

    // Truy vấn để lấy thông tin từ bảng DICHVU
    $query = "SELECT * FROM DICHVU";

    // Thêm điều kiện tìm kiếm nếu có
    if (!empty($searchTerm)) {
        $query .= " WHERE TenDichVu LIKE '%$searchTerm%'";
    }

    $result = executeQuery($conn, $query);

    // Kiểm tra xem có dữ liệu hay không
    if (mysqli_num_rows($result) > 0) {
        // Hiển thị dữ liệu ra form
        while ($row = mysqli_fetch_assoc($result)) {
            $thanhTienFormatted = number_format($row['DonGiaDichVu'], 0, ',', '.') . " VND";

            echo '<div class="dichvu">
                    <ul class="dichvu-item">
                        <li><img src="../access/images/' . $row['Anh'] . '" alt=""></li>
                        <li style="display: none;">Mã Dịch Vụ: ' . $row['MaDichVu'] . '</li>
                        <li><strong>' . $row['TenDichVu'] . '</strong></li>
                        <li style="display: none;">Mô Tả Dịch Vụ: ' . $row['MoTaDichVu'] . '</li>
                        <strong style="display: none;" ><li style="color: red;">Giá : ' . $thanhTienFormatted . '</li></strong>
                        <a href="chitietdichvu.php?MaDichVu=' . $row['MaDichVu'] . '"><button><strong>Xem Chi Tiết>></strong></button></a>
                    </ul>
                </div>';
        }
    } else {
        echo "Không có dữ liệu.";
    }

    // Đóng kết nối
    mysqli_close($conn);
}


?>