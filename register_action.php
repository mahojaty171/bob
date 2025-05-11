<?php 
include("includes/header.php"); // گنجاندن هدر سایت
?>

<?php 
// گرفتن اطلاعات فرم
$name  = $_POST["name"] ?? '';
$pass  = $_POST["pass"] ?? '';

// اتصال به دیتابیس
$link = mysqli_connect("localhost", "bekhio_root", "n123456", "bekhio_root");

// بررسی اتصال
if (!$link) {
    die("❌ خطا در اتصال به دیتابیس: " . mysqli_connect_error());
}

// اجرای کوئری ثبت کاربر جدید
$sql = "INSERT INTO users (UserName, password) VALUES ('$name', '$pass')";
$result = mysqli_query($link, $sql);

// بررسی نتیجه
if($result){
    ?>
    <div class="alert alert-success" role="alert">
        <p class="pc">✅ ثبت‌نام شما با موفقیت انجام شد</p>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-danger" role="alert">
        <p class="pc">❌ ثبت‌نام شما با خطا مواجه شد</p>
    </div>
    <?php
}

// بستن اتصال
mysqli_close($link);
?>

<?php 
include("includes/footer.php"); // گنجاندن فوتر سایت
?>
