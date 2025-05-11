<?php 
  include("includes/header.php"); // وارد کردن هدر سایت (شامل منو، استایل‌ها، و غیره)
?>

<?php 
// دریافت مقادیر نام کاربری و کلمه عبور از فرم ارسال شده (POST)
$user = $_POST["user"]; // نام کاربری وارد شده
$pass = $_POST["pass"]; // کلمه عبور وارد شده

// اتصال به دیتابیس
$link = mysqli_connect("localhost", "root", "", "bekharino");

// جستجو در جدول Users برای پیدا کردن کاربری که نام کاربری و کلمه عبور وارد شده برابر با اطلاعات دیتابیس باشد
$result = mysqli_query($link, "SELECT * FROM `Users` WHERE UserName='$user' AND PassWord='$pass'");

// بستن ارتباط با دیتابیس بعد از انجام کوئری
mysqli_close($link);

// خواندن نتیجه‌ی کوئری
$row = mysqli_fetch_array($result);

// بررسی اینکه آیا کاربر پیدا شده یا نه
if ($row == true) {
    // اگر اطلاعات درست باشد، وضعیت ورود را true قرار می‌دهیم (کاربر وارد سیستم شده)
    $_SESSION["state_login"] = true;
    $_SESSION["name"] = $row["Name"]; // ذخیره نام کاربری در session

    // بررسی اینکه نوع کاربر عمومی است یا ادمین
    if ($row["admin"] == 0) {
        $_SESSION["user_type"] = "public"; // کاربر عمومی
    } else if ($row["admin"] == 1) {
        $_SESSION["user_type"] = "admin"; // کاربر ادمین
    }

    // نمایش پیام خوش‌آمدگویی و انتقال به صفحه اصلی سایت
    ?>
    <div class="alert alert-success" role="alert">
        <p class="pc"> Welcome to your web </p> <!-- پیام خوش آمد گویی -->
    </div>
    
    <script type="text/javascript">
        location.replace("index.php"); // انتقال به صفحه اصلی (index.php)
    </script>

    <?php
} else {
    // اگر اطلاعات وارد شده صحیح نباشد، نمایش پیام خطا
    ?>
    <div class="alert alert-danger" role="alert">
        <p class="pc">!! The entered information is not correct </p> <!-- پیام خطا -->
    </div>
    <?php
}
?>

<?php 
  include("includes/footer.php"); // وارد کردن فوتر سایت
?>
