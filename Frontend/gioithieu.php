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
    <title>Giới thiệu</title>
    <link rel="coputer care icon" href="../access/images/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../access/css/style.css">

    <style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: sans-serif;
    }

    .gioi-thieu {
        background: #fff;
    }

    .gioi-thieu h2 {
        text-align: center;
        color: #FF9900;
    }

    /* Style cho section */
    .dich-vu {
        padding: 50px 0;
        background-color: #f9f9f9;
        text-align: center;
        display: flex;
    }

    /* Style cho tiêu đề */
    .dich-vu h2 {
        font-size: 32px;
        margin-bottom: 30px;
        color: #FF9900;
    }

    /* Style cho từng dịch vụ */
    .dich-vu-item {
        margin-bottom: 30px;
        text-align: left;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Style cho ảnh của dịch vụ */
    .dich-vu-item img {
        width: 100%;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    /* Style cho tiêu đề của dịch vụ */
    .dich-vu-item h3 {
        color: #FF9900;
        font-size: 24px;
        margin-bottom: 10px;
    }

    /* Style cho mô tả của dịch vụ */
    .dich-vu-item p {
        font-size: 16px;
        color: #666;
        margin-bottom: 8px;
    }

    .thanh-tuu {
        background-color: #f5f5f5;
    }

    .thanh-tuu h2 {
        text-align: center;
        padding-top: 20px;
        margin-top: 20px;
        color: #FF9900;
    }

    .thanh-tuu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .thanh-tuu li {
        font-size: 16px;
        margin-bottom: 10px;
    }

    /* Reset CSS */

    /* Style cho section */
    .thanh-vien {
        padding: 50px 0;
        background-color: #f9f9f9;
        text-align: center;
    }

    /* Style cho container */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Style cho tiêu đề */
    .thanh-vien h2 {
        font-size: 32px;
        margin-bottom: 30px;
        color: #FF9900;
    }

    /* Style cho card của từng thành viên */
    .thanh-vien-cards {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    /* Style cho từng card */
    .thanh-vien-card {
        flex-basis: calc(20% - 20px);
        margin-bottom: 30px;
        text-align: left;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Style cho ảnh thành viên */
    .thanh-vien-card img {
        width: 100%;
        border-radius: 50%;
        margin-bottom: 20px;
    }

    /* Style cho tiêu đề của thành viên */
    .thanh-vien-card h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    /* Style cho thông tin công việc và mô tả */
    .thanh-vien-card p {
        font-size: 16px;
        color: #666;
        margin-bottom: 8px;
    }

    .lien-he {
        background-color: #00aeef;
        padding: 20px;
    }

    .lien-he h2 {
        color: #fff;
    }

    .lien-he p {
        color: #fff;
        font-size: 14px;
    }
    </style>
</head>

<body>


    <!-- Subtitle -->
    <div class="subtitle">
        <h1><span style="color:#696687;">THÔNG TIN VỀ</span> <span style="color:#FF9900;">CHÚNG TÔI</span> </h1>
        <h2>Chăm sóc máy tính-Giúp máy tính được tối ưu hoàn hảo</h2>
        <p>Giải quyết nhanh chóng các vấn đề thường mắc phải với máy vi tính</p>

    </div>

    <!-- Dịch vụ -->
    <section class="dich-vu">
        <div class="container">
            <h2>Dịch vụ chăm sóc máy tính</h2>
            <div class="dich-vu-item">
                <img src="https://saigontdc.com/storage/images/onsite-support.jpg" alt="Bảo trì máy tính">
                <h3>Bảo trì máy tính</h3>
                <p>N2 cung cấp dịch vụ bảo trì máy tính chuyên nghiệp,tận tâm hết mình. Đảm bảo hệ thống và máy tính của
                    bạn luôn hoạt động ổn định và hiệu quả.</p>
            </div>
            <div class="dich-vu-item">
                <img src="https://icdn.dantri.com.vn/2021/10/29/nghe-sua-chua-lap-rap-may-tinh-truong-tc-nguyen-tat-thanh-3-crop-1635480228095.jpeg"
                    alt="Sửa chữa máy tính">
                <h3>Sửa chữa máy tính</h3>
                <p>N2 cung cấp dịch vụ sửa chữa máy tính chuyên nghiệp, với đội ngũ kỹ thuật viên giàu kinh nghiệm thực
                    chiến hoạt động luôn thường trục 12/7. Sẵn sàng khắc phục sự cố một cách nhanh chóng và tối ưu nhất
                    cho khách hàng.</p>
            </div>
            <div class="dich-vu-item">
                <img src="https://www.iccs-bpo.com/admin/images/upload_images/63627183_10-Importance-of-Live-Chat-in-Customer-Support.jpg"
                    alt="Tư vấn máy tính">
                <h3>Tư vấn máy tính</h3>
                <p>" Hạnh phúc của khách hàng là thàng công của công ty" Nhân viên luôn thường trực giúp bạn chọn lựa
                    thiết bị và giải pháp phù hợp nhất cho nhu cầu và ví tiền của bạn.</p>
            </div>
            <div class="dich-vu-item">
                <img src="https://cdn1.walsworthyearbooks.com/wyb/2019/09/05090507/Level-Up-Final-02-copy-1-1413x1444.jpg"
                    alt="Nâng cấp máy tính">
                <h3>Nâng cấp máy tính</h3>
                <p>Nguồn linh kiện tiên tiến và mới hàng đầu thế giới. N2 lấy chữ tín đặt lên hàng đầu. chúng tôi kho
                    chỉ sửa chữa mà còn nâng cấp máy tính để người dùng luôn có những công nghệ siêu việt đi trước thời
                    đại. </p>
            </div>
        </div>
    </section>


    <section class="thanh-tuu">
        <div class="container">
            <h2>Thành tựu</h2>
            <ul>
                <li>Giành giải thưởng "Nhà cung cấp dịch vụ truyền thông tốt nhất năm 2022"</li>
                <li>Top 10 công ty thiết kế website uy tín nhất Việt Nam năm 2023</li>
                <li>Top 5 công ty SEO hàng đầu Việt Nam năm 2024</li>
                <li> chuyên gia sửa chữa KOW 2018,2020.</li>
            </ul>
        </div>
    </section>
    <section class="thanh-vien">
        <div class="container">
            <h2>Đội ngũ của chúng tôi</h2>
            <div class="thanh-vien-cards">
                <div class="thanh-vien-card">
                    <!-- <img src="https://scontent.fsgn2-9.fna.fbcdn.net/v/t39.30808-6/327237647_1222348148662357_206603014997775276_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=9c7eae&_nc_eui2=AeE1iyEXa26BPhKp5aTOcloZHKJyotyqhtgconKi3KqG2J0QDM0dvDvkpFnVUP_WiADb0Im4ET9JswuSlLF1j4Mg&_nc_ohc=toQH3DtkdpYAX_hcNLR&_nc_ht=scontent.fsgn2-9.fna&oh=00_AfChjnUFw9l5m9rHuq9UOVqmhwhGJwJznppwX8l1dBdA3w&oe=6597987C" alt="Người 1"> -->
                    <h3>Lường Văn Chung </h3>
                    <p>Công việc:CEO </p>
                    <p>Thông tin: lãnh đạo sáng suốt với 7 năm kinh nhiệm. với đường lối lãnh đạo tài tình đưa công ti
                        lên đỉnh vinh quang chỉ với 5 năm.</p>
                </div>
                <div class="thanh-vien-card">
                    <!-- <img src="https://scontent.fsgn2-3.fna.fbcdn.net/v/t39.30808-6/415031934_394203822961086_4840905034912614174_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=524774&_nc_eui2=AeHGY8Rsd1DLBDyxRUlJSaugcdO-GPJRURhx074Y8lFRGH9xHBDdqtBLI4UIVymgk-kPmk8M43GSJ0CWKfY4oYSn&_nc_ohc=kgFD-4IQa7UAX9Um4GO&_nc_ht=scontent.fsgn2-3.fna&oh=00_AfBFNc83SRn9_z9Wos-J9w_G3P_bT8jX6dOxJ07KrlTydg&oe=6597AD46" alt="Người 2"> -->
                    <h3>Đoàn Văn Sơn </h3>
                    <p>Công việc: marketing </p>
                    <p>Thông tin: "khách hàng là thượng đế". thông thạo 7 thứ tiếng! hoạt bát năng động với công việc,
                        tận tâm hết mình vì khách hàng.</p>
                </div>
                <div class="thanh-vien-card">
                    <!-- <img src="https://scontent.fsgn2-3.fna.fbcdn.net/v/t39.30808-6/414961586_394206999627435_3727691027362250997_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=524774&_nc_eui2=AeFknMNlhS-B5gnC5Fy_BOr-eno9-WL7oaZ6ej35YvuhptodednKPkMeo4E4XESYWRLd2pszwnj5g5cBz01t6eV5&_nc_ohc=hCTt5K4-geQAX_e19ST&_nc_ht=scontent.fsgn2-3.fna&oh=00_AfCs7QjIXUhubbAdGYG1PRfBoU3i_uMZ8OM8CpG5G4EfIA&oe=6598E7C0" alt="Người 3"> -->
                    <h3>Nguyễn Trọng Tấn </h3>
                    <p>Công việc: trưởng ban điều dưỡng </p>
                    <p>Thông tin: Du học sinh mĩ với tấm bằng thạc sĩ ở tuổi 20. tài năng trẻ nhưng lại sất siêu việt
                        từng tham gia và đạt giải tài năng trẻ 'Talent of world' </p>
                </div>
                <div class="thanh-vien-card">
                    <!-- <img src="https://scontent.fsgn2-7.fna.fbcdn.net/v/t39.30808-6/415010327_394210509627084_1734152718209986326_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=524774&_nc_eui2=AeHO3eNS5LFPqd7YlmDBzKZSN4hE48zzPJ03iETjzPM8nbFLDhFdzZmh7hIJCtM-Ad1ozcjBI2tfNMNpROVNce9q&_nc_ohc=JAMfxNh_jPgAX8exl2k&_nc_ht=scontent.fsgn2-7.fna&oh=00_AfB42yXClZ2u0SdneEobvu55_nZ1OxWd96PthYa9AnSkAQ&oe=6598E427" alt="Người 4"> -->
                    <h3>Đỗ Quốc Trung </h3>
                    <p>Công việc: nhân viên bth</p>
                    <p>Thông tin: yeh sure. nhân viên bth riel, ko có gì để nói </p>
                </div>
            </div>
        </div>
    </section>
    </main>
    <!-- footer -->
    <!-- Footer -->
    <?php include ("./View/footer.php")?>
    <!--  -->
</body>

</html>