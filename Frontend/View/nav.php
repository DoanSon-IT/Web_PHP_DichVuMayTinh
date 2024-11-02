<style>
.fa-user {
    border: 2px solid #fff; 
    border-radius: 50%;
    padding: 8px; 
}
.fa-user:hover i{
    background-color: red;
}
</style>
<nav>
    <div class="containers">
        <ul class="menu">
            <li><a href="./index.php"><i style="font-size: 25px;" class="fa-solid fa-house"></i> Trang Chủ</a></li>
            <li><a href="./gioithieu.php">Giới Thiệu</a></li>
            <li><a href="#">Dịch Vụ<i class="fa-solid fa-chevron-down"></i></a>
                <ul id="submenu">
                    <li><a href="./dichvupm.php">chăm sóc (phần mềm)</a></li>
                    <li><a href="./dichvupc.php">chăm sóc (phần cứng)</a></li>
                    <li><a href="./dichvukhac.php">chăm sóc khác</a></li>
                </ul>
            </li>
            <li><a href="./lienhe.php">Liên Hệ</a></li>
            <li><a href="./hoidap.php">Hỏi Đáp</a></li>
            <?php if (isset($_SESSION['username'])) : ?>
                <li><a href="#"><i class="fas fa-user"></i> <?php echo $_SESSION['username']; ?></a>
                    <ul id="submenu">
                        <li><a href="./thongtincanhan.php">Thông tin cá nhân </a></li>
                        <li><a href="./donhang.php">Xem đơn đặt lịch  </a></li>
                        <!-- You can add a logout link here if needed -->
                        <li><a href="?logout=1"> Đăng Xuất</a></li>
                    </ul>
                </li>
            <?php else : ?>
                <li><a href="./View/dangnhapdangky.php"><i class="fas fa-user"></i> Tài Khoản</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>














































<script>window.onscroll = function() {
    var nav = document.querySelector('nav');
    if (window.scrollY > 0) {
        nav.style.position = 'fixed';
        nav.style.top = '0';
    } else {
        nav.style.position = 'relative';
    }
};</script>
<script>window.onscroll = function() {
    var nav = document.querySelector('nav');
    if (window.scrollY > 0) {
        nav.classList.add('sticky');
    } else {
        nav.classList.remove('sticky');
    }
};</script>

