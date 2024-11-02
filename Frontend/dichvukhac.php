<?php
session_start();
if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: ./View/dangnhapdangky.php");
  exit;
}
?>
<?php
include "./model/dcFrontend.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-pzjw8f+ua/CXf5BBdOJJtCea9djHjEXIpY8TMW5Y7vJmMqUK3lP97JQpIQhF5J" crossorigin="anonymous">
    <link rel="stylesheet" href="../access/css/dv.css">
    <link rel="stylesheet" href="../access/css/style.css">
    <title>Dịch vụ chăm sóc máy tính khác </title>
</head>
<body>
<?php include __DIR__."/View/header.php"; ?>
<?php include __DIR__."/View/nav.php"; ?>
    <div class="content">
    <div class="content-item">
    <?php 
    displayDichVuk() ;
    ?>
  </div>
  </div>

  <?php include __DIR__."/View/footer.php"; ?>

</body>

</html>
