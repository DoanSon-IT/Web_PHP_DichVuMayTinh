<?php
include "./model/dcFrontend.php";

session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ./View/dangnhapdangky.php");
    exit;
}
?>
<?php
 include ("./View/header.php"); 
 include ("./View/nav.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../access/css/style.css">
    <style>
    .lienhe-container {
        display: flex;
    }

    .cottrai {
        margin: 50px 100px;
        width: 50%;
    }

    .cotphai {
        width: 50%;
    }

    .cottrai strong {
        font-weight: 700;
    }

    .cottrai a {
        color: red;
    }

    .thongtin h2 {
        margin-bottom: 10px;
    }

    .thongtin p {
        margin-bottom: 8px;
    }

    form {
        max-width: 400px;
        margin: 50px auto;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input,
    textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 12px;
        box-sizing: border-box;
    }

    textarea {
        resize: none;
    }

    input[type="submit"] {
        background-color: #3498db;
        /* Màu nền cho nút submit */
        color: #fff;
        /* Màu chữ cho nút submit */
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #2980b9;
        /* Màu nền khi hover trên nút submit */
    }

    /* Tùy chỉnh các phần tử khi có lỗi nhập liệu */
    input:invalid,
    textarea:invalid {
        border: 1px solid #2980b9;
        /* Đổi màu viền thành đỏ */
    }

    /* Thông báo lỗi */
    input:invalid+span,
    textarea:invalid+span {
        color: #2980b9;
        display: block;
        margin-top: 4px;
    }

    /* Ẩn thông báo lỗi khi không có lỗi */
    input:valid+span,
    textarea:valid+span {
        display: none;
    }
    </style>
</head>

<body>
    <div class="lienhe-container">
        <div class="cottrai">
            <div class="thongtin">
                <h2>Thông tin liên hệ </h2>
                <p><strong>Computer care</strong></p>
                <p><strong>Hotline: <a>0123456789</a> - Tel: <a>0987654321</a></strong></p>
                <p><strong>Email:</strong> son12ekm2@gmail.com</p>
                <p><strong>Địa chỉ:</strong> Khu 2, Hoàng Cương, Thanh Ba, Bắc Ninh </p>
                <p><strong>Chí Nhánh Cơ sở 2:</strong> 63 Xóm Củi, p11, quận 8, TPHCM</p>
            </div>
        </div>
        <div class="cotphai">
            <form action="" method="post">
                <label for="name">Họ và Tên:</label>
                <input type="text" id="name" name="name"><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email"><br>

                <label for="message">Nội dung:</label>
                <textarea id="message" name="message"></textarea><br>

                <input type="submit" name="submit" value="Gửi Yêu Cầu Liên Hệ">
            </form>
        </div>
    </div>
    <?php include ("./View/footer.php") ?>
</body>

</html>