<?php
include "./model/dcFrontend.php";

session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ./View/dangnhapdangky.php");
    exit;
}
?>
<?php include ("./View/header.php") ?>
<?php include ("./View/nav.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../access/css/style.css">
    <style>
    .cottrai {
        width: 70%;
        float: left;
    }

    .cotphai {
        margin-top: 50px;
        border: 1px solid black;
        width: 30%;
        float: right;
    }

    .faq-dd {
        margin-top: 50px;
        text-align: center;
    }

    .faq-dd span {
        color: #FF9900;
    }

    .faq-container {
        text-align: justify;
        max-width: 600px;
        margin: 50px auto;
    }

    .faq-item {
        margin-bottom: 20px;
        font-size: 20px;
    }

    .question {
        font-weight: bold;
        color: #FF9900;
    }

    .answer {
        margin-top: 5px;
    }

    .cotphai h2 {
        text-align: center;
    }

    .danhgia-container {
        margin: 20px;
    }

    .khach-hang span {
        font-weight: bold;
        color: #19918e;
    }

    .danh-gia {
        color: rgb(90, 90, 90);
    }

    .footer-container {
        clear: both;
    }
    </style>
</head>

<body>
    <div>
        <div class="cottrai">
            <div class="faq-dd">
                <h2>Một số câu hỏi mà khách hàng hay <span>thắc mắc</span> với chúng tôi</h2>
            </div>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="question">1. Làm thế nào tôi có thể đặt dịch vụ chăm sóc máy tính?</div>
                    <div class="answer"><i class="fa-solid fa-user-tie"></i> Bạn có thể đặt dịch vụ trực tuyến thông
                        qua
                        trang web của chúng tôi. Chỉ cần chọn
                        dịch
                        vụ bạn cần, điền thông tin liên hệ và mô tả vấn đề, sau đó chúng tôi sẽ liên hệ lại với bạn.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="question">2. Dịch vụ của bạn bao gồm những gì?</div>
                    <div class="answer"><i class="fa-solid fa-user-tie"></i> Chúng tôi cung cấp một loạt các dịch vụ
                        chăm
                        sóc
                        máy tính, bao gồm sửa chữa phần
                        cứng,
                        loại bỏ virus, tăng tốc độ hệ thống, và hỗ trợ kỹ thuật. Chi tiết hơn về các dịch vụ cụ thể
                        có
                        sẵn
                        trên
                        trang web của chúng tôi.</div>
                </div>
                <div class="faq-item">
                    <div class="question">3. Bảo hành của bạn kéo dài bao lâu?</div>
                    <div class="answer"><i class="fa-solid fa-user-tie"></i> Thời gian bảo hành có thể khác nhau tùy
                        thuộc vào loại dịch vụ bạn chọn.
                        Thông
                        thường, chúng tôi cung cấp một khoảng thời gian bảo hành cho mọi dịch vụ, và chi tiết này sẽ
                        được
                        hiển
                        thị rõ trên hóa đơn hoặc trong hợp đồng.</div>
                </div>
                <div class="faq-item">
                    <div class="question">4. Làm thế nào tôi có thể thanh toán cho dịch vụ của bạn?</div>
                    <div class="answer"><i class="fa-solid fa-user-tie"></i> Chúng tôi chấp nhận thanh toán qua
                        nhiều
                        phương
                        thức, bao gồm thẻ tín dụng, chuyển
                        khoản
                        ngân hàng và tiền mặt. Thông tin chi tiết về cách thanh toán sẽ được cung cấp khi bạn đặt
                        dịch
                        vụ.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="question">5. Tôi có thể theo dõi quá trình sửa chữa không?</div>
                    <div class="answer"><i class="fa-solid fa-user-tie"></i> Chúng tôi cung cấp một hệ thống theo
                        dõi
                        trực
                        tuyến để bạn có thể kiểm tra trạng
                        thái
                        của máy tính của mình. Bạn sẽ nhận được thông báo khi quá trình sửa chữa hoặc bảo dưỡng được
                        hoàn
                        tất.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="question">6. Làm thế nào để liên hệ với bộ phận hỗ trợ kỹ thuật của bạn?</div>
                    <div class="answer"><i class="fa-solid fa-user-tie"></i> Bạn có thể liên hệ với bộ phận hỗ trợ
                        của
                        chúng
                        tôi thông qua số điện thoại, email
                        hoặc
                        chat trực tuyến. Thông tin liên hệ chi tiết sẽ được hiển thị trên trang web của chúng tôi.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="question">7. Điều gì sẽ xảy ra khi máy tính của tôi được bảo dưỡng xong?</div>
                    <div class="answer"><i class="fa-solid fa-user-tie"></i> Máy tính của bạn sẽ được 99% so với lúc
                        mới
                        mua.
                    </div>
                </div>

            </div>
        </div>
        <div class="cotphai">
            <h2>Các đánh giá tiêu biểu</h2>
            <div class="danhgia-container">
                <div class="khach-hang">Khách hàng: <span>David D Son</span></div>
                <div class="sao-danh-gia">Đánh giá: 5<i class="fa-solid fa-star"></i></div>
                <div class="danh-gia">Dịch vụ rất chất lượng, bạn nhân viên rất xinh.</div>
            </div>
            <hr>
            <div class="danhgia-container">
                <div class="khach-hang">Khách hàng: <span>Mai Thanh Boong</span></div>
                <div class="sao-danh-gia">Đánh giá: 4<i class="fa-solid fa-star"></i></div>
                <div class="danh-gia">Sao nghe đồn shop có khuyến mãi ngày 1/4 giảm 50% cho tất cả các dịch vụ, lúc
                    thanh toán vẫn như bình thường vậy :<< </div>
                </div>
                <hr>
                <div class="danhgia-container">
                    <div class="khach-hang">Khách hàng: <span>Kevin Tấn</span></div>
                    <div class="sao-danh-gia">Đánh giá: 3<i class="fa-solid fa-star"></i></div>
                    <div class="danh-gia">Khách hàng không nói gì.</div>
                </div>
                <hr>
                <div class="danhgia-container">
                    <div class="khach-hang">Khách hàng: <span>Chung thích ăn bún</span></div>
                    <div class="sao-danh-gia">Đánh giá: 2<i class="fa-solid fa-star"></i></div>
                    <div class="danh-gia">Tìm dịch vụ sửa điện thoại mà không có??</div>
                </div>
                <hr>
                <div class="danhgia-container">
                    <div class="khach-hang">Khách hàng: <span>Trung Tám Ngón</span></div>
                    <div class="sao-danh-gia">Đánh giá: 1<i class="fa-solid fa-star"></i></div>
                    <div class="danh-gia">Dân IT mà không biết sửa máy giặt, xứng đáng 1 sao.</div>
                </div>
            </div>
        </div>
        <footer class="footer-container">
            <?php include ("./View/footer.php") ?>
        </footer>
</body>

</html>