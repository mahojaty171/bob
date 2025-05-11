<?php 
include("includes/header.php"); // هدر سایت

// شروع سشن فقط اگه هنوز شروع نشده
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// گرفتن اطلاعات فرم
$user = $_POST["user"] ?? '';
$pass = $_POST["pass"] ?? '';

// اتصال به دیتابیس
$link = mysqli_connect("localhost", "bekhio_root", "n123456", "bekhio_root");

// بررسی اتصال
if (!$link) {
    die("❌ خطا در اتصال به دیتابیس: " . mysqli_connect_error());
}

// جلوگیری از حملات SQL Injection (بهترین روش)
$user = mysqli_real_escape_string($link, $user);
$pass = mysqli_real_escape_string($link, $pass);

// اجرای کوئری با بررسی دقیق
$sql = "SELECT * FROM users WHERE UserName='$user' AND PassWord='$pass'";
$result = mysqli_query($link, $sql);

// بررسی اجرای کوئری
if (!$result) {
    die("❌ خطا در اجرای کوئری: " . mysqli_error($link));
}

// گرفتن نتیجه
$row = mysqli_fetch_array($result);

// بستن اتصال
mysqli_close($link);

// بررسی نتیجه
if ($row) {
    // ذخیره اطلاعات تو سشن
    $_SESSION["state_login"] = true;
    $_SESSION["UserName"] = $row["UserName"]; // ✅ ذخیره نام کاربری
    $_SESSION["name"] = $row["Name"];
    $_SESSION["user_type"] = ($row["admin"] == 1) ? "admin" : "public";

    // نمایش پیام و هدایت به صفحه اصلی
    ?>
    <div class="alert alert-success" role="alert">
        <p class="pc">✅ Welcome to your web</p>
    </div>
    <script>
        location.replace("index.php");
    </script>
    <?php
} else {
    // نمایش خطا
    ?>
    <div class="alert alert-danger" role="alert">
        <p class="pc">❌ The entered information is not correct</p>
    </div>
    <?php
}

include("includes/footer.php"); // فوتر سایت
?>