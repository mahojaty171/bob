<?php 
  include("includes/header.php");  // گنجاندن فایل هدر سایت
?>

<?php 

// دریافت اطلاعات ثبت‌نام از فرم
$name = $_POST["name"];
$user = $_POST["user"];
$pass = $_POST["pass"];
$gmail = $_POST["gmail"];

// اتصال به دیتابیس
$link = mysqli_connect("localhost", "root", "", "bekharino");

// اجرای کوئری INSERT برای ثبت اطلاعات کاربر جدید در جدول Users
$result = mysqli_query($c, "INSERT INTO `Users` (`Name`, `UserName`, `PassWord`, `Gmail`) VALUES ('$name', '$user', '$pass', '$gmail')");

// بررسی نتیجه عملیات
if($result == true){
    ?>
    <div class="alert alert-success" role="alert">
        <p class="pc"> ثبت نام شما با موفقیت انجام گردید </p>  // نمایش پیغام موفقیت
    </div>
    <?php
}else{
    ?>
    <div class="alert alert-danger" role="alert">
        <p class="pc">ثبت نام شما با خطا مواجه شد</p>  // نمایش پیغام خطا در صورت بروز مشکل
    </div>
    <?php
}

// بستن اتصال به دیتابیس
mysqli_close($c);
?>

<?php 
  include("includes/footer.php");  // گنجاندن فایل فوتر سایت
?>
