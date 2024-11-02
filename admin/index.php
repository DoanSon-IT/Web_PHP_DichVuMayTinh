<?php
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location:../../Frontend/View/dangnhapdangky.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../access/css/admin.css">
    <link rel="stylesheet" href="../access/css/taikhoan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-wZoUxMxVB48Y5NQ93uP25Yh2kEc+KKLHfYDz/IpqExxEqayfU3Ib1WqVttKQLqQgfeXyUpI+poU4mV4Kr1tOeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../access/js/dungchung.js"></script>
    <title>Admin</title>
</head>
<body>
    <?php include __DIR__."/View/header.php"; ?>
    <div class="menu_content">
    <?php include __DIR__."/View/menu.php";
        if(isset($_GET['act'])){
            switch($_GET['act']){
                case 'taikhoan':
                    include "View/taikhoan.php";
                    break;
                case 'updatetaikhoan':
                    include "View/updatetaikhoan.php";
                    break;
                case 'deltk':
                    include "View/taikhoan.php";
                    break;        
                case 'dichvu':
                    include "View/dichvu.php";
                    break;
                case 'deldv':
                     include "View/dichvu.php";
                    break; 
                case 'upddv':
                    include "View/upddv.php";
                    break;        
                case 'nhanvien':
                    include "View/nhanvien.php";
                    break; 
                case 'delnv':
                    include "View/nhanvien.php";
                    break;
                case 'updatenv':
                    include "View/updatenv.php";
                    break;    
                case 'khachhang':
                    include "View/khachhang.php";
                    break;
                case 'delkh':
                    include "View/khachhang.php";
                    break;
                case 'updatekh':
                    include "View/updatekh.php";
                    break;         
                case 'donhang':
                    include "View/donhang.php";
                    break;
                case 'upddh':
                    include "View/upddh.php";
                     break;
                case 'deldh':
                    include "View/donhang.php";
                     break;
                case 'thongke':
                    include "View/thongke.php";
                    break;
                // case 'dangxuat':
                //     include "../Frontend/index.php";
                //     break;
                default:
                    include __DIR__."View/content.php";
                    break;
            }
        }else {
            include __DIR__."/View/content.php";
        }
    ?>
   </div>
</body>
</html>
