<?php
include("includes/header.php");

// اتصال به دیتابیس
$link = mysqli_connect("localhost", "root", "", "bekharino");

// بررسی اتصال
if (!$link) {
    die("اتصال به دیتابیس ناموفق بود: " . mysqli_connect_error());
}

// بررسی مقدار `id` که از GET دریافت شده
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("خطا: شناسه معتبر نیست.");
}

$id = intval($_GET["id"]); // تبدیل `id` به عدد

// بررسی وجود رکورد قبل از حذف
$stmt = mysqli_prepare($link, "SELECT ImageURL FROM `products` WHERE `ID`=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if ($row) {
    // حذف فایل تصویر اگر وجود دارد
    if (!empty($row["ImageURL"]) && file_exists("images/" . basename($row["ImageURL"]))) {
        unlink("images/" . basename($row["ImageURL"]));
    }

    // حذف رکورد از دیتابیس
    $stmt = mysqli_prepare($link, "DELETE FROM `products` WHERE `ID`=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    // بررسی موفقیت حذف
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>alert('محصول با موفقیت حذف شد.'); location.replace('manage.php');</script>";
    } else {
        echo "حذف محصول ناموفق بود: " . mysqli_error($link);
    }
} else {
    echo "محصولی با این id وجود ندارد.";
}

// بستن اتصال
mysqli_close($link);

include("includes/footer.php");
?>
