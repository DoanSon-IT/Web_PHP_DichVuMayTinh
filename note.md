CREATE TABLE `LoaiTaiKhoan` (
  `UserID` INT PRIMARY KEY,
  `TenTaiKhoan` varchar(30),
  `Password` varchar(10),
  `Email` varchar(50),
  `role` TINYINT CHECK (Role IN (0, 1))
);

CREATE TABLE `NhanVien` (
  `MaNhanVien` char(10) PRIMARY KEY,
  `TenNhanVien` varchar(30),
  `Email` varchar(30),
  `UserID` INT
);

CREATE TABLE `KhachHang` (
  `MaKhachHang` char(10) PRIMARY KEY,
  `TenKhachHang` varchar(30),
  `DiaChi` varchar(30),
  `Email` varchar(30),
  `SDT` int,
  `UserID` INT
);

CREATE TABLE `DICHVU` (
  `MaDichVu` char(10) PRIMARY KEY,
  `TenDichVu` varchar(30),
  `Anh` VARCHAR(50),
  `MoTaDichVu` varchar(255),
  `DonGiaDichVu` int,
  `LoaiDichVu` varchar(20)
);

CREATE TABLE `DonHang` (
  `MaDonHang` char(10) PRIMARY KEY,
  `MaKhachHang` char(10),
  `MaDichVu` char(10),
  `ThanhTien` int,
  `ngaydat` date,
  `MaThanhToan` char(10),
  `MaTrangThai` char(10)
);

CREATE TABLE `PhanHoi` (
  `MaPhanHoi` char(10) PRIMARY KEY,
  `NoiDungPhanHoi` varchar(255),
  `MaKhachHang` char(10),
  `MaNhanVien` char(10)
);

CREATE TABLE `HinhThucThanhToan` (
  `MaThanhToan` char(10) PRIMARY KEY,
  `TenHinhThucThanhToan` varchar(50)
);

CREATE TABLE `TrangThai` (
  `MaTrangThai` char(10) PRIMARY KEY,
  `TenTrangThai` varchar(50)
);
ALTER TABLE `NhanVien` ADD FOREIGN KEY (`UserID`) REFERENCES `LoaiTaiKhoan` (`UserID`);
ALTER TABLE `KhachHang` ADD FOREIGN KEY (`UserID`) REFERENCES `LoaiTaiKhoan` (`UserID`);






INSERT INTO `DICHVU` (`MaDichVu`, `TenDichVu`, `Anh`, `MoTaDichVu`, `DonGiaDichVu`, `LoaiDichVu`)
VALUES 
  ('DV001', 'Chăm sóc máy tính cơ bản', 'images1.jpg', 'Dịch vụ chăm sóc máy tính cung cấp kiểm tra và sửa chữa cơ bản cho máy tính của bạn.', 100000, '3'),
  ('DV002', 'Dọn dẹp và tối ưu hóa', 'images2.jpg', 'Dịch vụ này bao gồm việc dọn dẹp ổ đĩa, tối ưu hóa hệ thống để cải thiện hiệu suất máy tính.', 150000, '3'),
  ('DV003', 'Diệt virus và bảo mật', 'images3.jpg', 'Chúng tôi sẽ quét và diệt virus, đồng thời cài đặt các phần mềm bảo mật để bảo vệ máy tính của bạn.', 120000, '2'),
  ('DV004', 'Nâng cấp phần cứng', 'images4.jpg', 'Nâng cấp các thành phần phần cứng để cải thiện hiệu suất máy tính.', 200000, '1'),
  ('DV005', 'Khắc phục sự cố phần mềm', 'images5.jpg', 'Khắc phục sự cố phần mềm và sửa lỗi để đảm bảo máy tính hoạt động mượt mà.', 120000, '2'),
  ('DV006', 'Bảo mật mạng', 'images6.jpg', 'Tăng cường bảo mật mạng để ngăn chặn các tấn công mạng.', 180000, '1'),
  ('DV007', 'Dữ liệu sao lưu và phục hồi', 'images7.jpg', 'Thực hiện sao lưu dữ liệu định kỳ và khôi phục dữ liệu khi cần thiết.', 160000, '2'),
  ('DV008', 'Cài đặt và cấu hình hệ điều hành', 'images8.jpg', 'Hỗ trợ cài đặt và cấu hình hệ điều hành theo yêu cầu.', 140000, '2'),
  ('DV009', 'Tư vấn nâng cấp hệ thống', 'images9.jpg', 'Tư vấn về cách nâng cấp hệ thống để đáp ứng nhu cầu người dùng.', 120000, '1'),
  ('DV010', 'Dịch vụ tận nơi', 'images10.jpg', 'Hỗ trợ kỹ thuật tận nơi để khắc phục sự cố và thực hiện bảo trì.', 220000, '3'),
  ('DV011', 'Kiểm tra và đánh giá hiệu suất', 'images11.jpg', 'Kiểm tra hiệu suất hệ thống và đưa ra đánh giá chi tiết.', 150000, '3'),
  ('DV012', 'Hỗ trợ trực tuyến 24/7', 'images12.jpg', 'Dịch vụ hỗ trợ trực tuyến liên tục 24/7 để giải quyết mọi vấn đề.', 180000, '3'),
  ('DV013', 'Bảo mật dữ liệu cá nhân', 'images13.jpg', 'Chú trọng đến bảo mật thông tin cá nhân trên máy tính.', 130000, '3'),
  ('DV014', 'Hướng dẫn sử dụng', 'images14.jpg', 'Hướng dẫn người dùng về cách sử dụng máy tính hiệu quả.', 100000, '2'),
  ('DV015', 'Dịch vụ tư vấn mua sắm', 'images15.jpg', 'Tư vấn về việc mua sắm phần cứng và phần mềm phù hợp.', 160000, '1'),
  ('DV016', 'Xử lý sự cố khẩn cấp', 'images16.jpg', 'Xử lý sự cố ngay lập tức để đảm bảo không có thời gian chờ đợi.', 200000, '3'),
  ('DV017', 'Dịch vụ đào tạo người dùng', 'images17.jpg', 'Đào tạo người dùng về cách sử dụng máy tính và phần mềm.', 120000, '3'),
  ('DV018', 'Quản lý và duy trì hệ thống', 'images18.jpg', 'Quản lý và duy trì hệ thống máy tính để đảm bảo ổn định và hiệu quả.', 190000, '1'),
  ('DV019', 'Bảo dưỡng định kỳ', 'images19.jpg', 'Dịch vụ bảo dưỡng định kỳ để giữ cho máy tính của bạn luôn ổn định và hiệu quả.', 180000, '1'),
  ('DV020', 'Hỗ trợ từ xa', 'images20.jpg', 'Hỗ trợ từ xa để giải quyết vấn đề mà không cần phải đến trực tiếp.', 150000, '2');





-- Thêm dữ liệu vào bảng HinhThucThanhToan
INSERT INTO `HinhThucThanhToan` (`MaThanhToan`, `TenHinhThucThanhToan`)
VALUES ('TT001', 'Thẻ tín dụng'),
       ('TT002', 'Tiền mặt');

-- Thêm dữ liệu vào bảng TrangThai
INSERT INTO `TrangThai` (`MaTrangThai`, `TenTrangThai`)
VALUES ('TT001', 'Chờ xử lý'),
       ('TT002', 'Đang xử lý'),
       ('TT003', 'Đã hoàn thành');



-- Inserting data into LoaiTaiKhoan table
INSERT INTO `LoaiTaiKhoan` (`UserID`, `TenTaiKhoan`, `Password`, `Email`, `role`)
VALUES
  (1, 'Admin', 'admin123', 'admin@gmail.com', 1),
  (2, 'User', 'user123', 'user@gmail.com', 0),
  (3, 'chung', 'chung123', 'chung123@gmail.com', 0),
  (4, 'tan', 'tan123', 'tan123@gmail.com', 0);

-- Inserting data into NhanVien table
INSERT INTO `NhanVien` (`MaNhanVien`, `TenNhanVien`, `Email`, `UserID`)
VALUES
  ('NV001', 'admin','admin@gmail.com', 1);

-- Inserting data into KhachHang table
INSERT INTO `KhachHang` (`MaKhachHang`, `TenKhachHang`, `DiaChi`, `Email`, `SDT`, `UserID`)
VALUES
  ('KH001', 'Chung', 'Hà Nội', 'chung@gmail.com', 0867127278, 3),
  ('KH002', 'Tấn', 'Hà Nội', 'tan@gmail.com',123456789, 4);

-- Thêm dữ liệu vào bảng DonHang
INSERT INTO `DonHang` (`MaDonHang`, `MaKhachHang`, `MaDichVu`, `ThanhTien`, `ngaydat`, `MaThanhToan`, `MaTrangThai`)
VALUES ('DH001', 'KH001', 'DV001', 100000, '2024-01-07', 'TT001', 'TT001'),
       ('DH002', 'KH002', 'DV002', 150000, '2024-01-08', 'TT001', 'TT002');










 ALTER TABLE `PhanHoi` ADD FOREIGN KEY (`MaNhanVien`) REFERENCES `NhanVien` (`MaNhanVien`);

ALTER TABLE `PhanHoi` ADD FOREIGN KEY (`MaKhachHang`) REFERENCES `KhachHang` (`MaKhachHang`);

ALTER TABLE `DonHang` ADD FOREIGN KEY (`MaDonHang`) REFERENCES `KhachHang` (`MaKhachHang`);

ALTER TABLE `DonHang` ADD FOREIGN KEY (`MaDichVu`) REFERENCES `DICHVU` (`MaDichVu`);

ALTER TABLE `DonHang` ADD FOREIGN KEY (`MaTrangThai`) REFERENCES `TrangThai` (`MaTrangThai`);

ALTER TABLE `DonHang` ADD FOREIGN KEY (`MaThanhToan`) REFERENCES `HinhThucThanhToan` (`MaThanhToan`);







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