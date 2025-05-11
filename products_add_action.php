<?php
include("includes/header.php");

// فعال کردن نمایش خطاها برای دیباگ
error_reporting(E_ALL);
ini_set('display_errors', 1);

// اتصال به دیتابیس
$link = mysqli_connect("localhost", "root", "", "bekharino");
if (!$link) {
    die("❌ خطا در اتصال به دیتابیس: " . mysqli_connect_error());
}

// گرفتن داده‌ها از فرم و امن‌سازی اون‌ها برای جلوگیری از حملات SQL Injection
$name = mysqli_real_escape_string($link, $_POST['ProductName']);
$brand = mysqli_real_escape_string($link, $_POST['Brand']);
$model = mysqli_real_escape_string($link, $_POST['Model']);
$energy = mysqli_real_escape_string($link, $_POST['EnergyConsumption']);
$warranty = isset($_POST['Warranty']) ? intval($_POST['Warranty']) : null; // اگه گارانتی نباشه مقدار null می‌گیره
$price = floatval($_POST['Price']); // قیمت رو عدد اعشاری می‌کنیم
$dimensions = mysqli_real_escape_string($link, $_POST['Dimensions']);
$weight = floatval($_POST['Weight']); // وزن رو هم عدد اعشاری می‌کنیم

// مسیر پیش‌فرض عکس خالیه
$imagePath = "";                            

// بررسی اینکه فایلی برای عکس انتخاب شده یا نه
if (!empty($_FILES['ImageURL']['name'])) {
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif']; // فرمت‌های مجاز
    $file_type = strtolower(pathinfo($_FILES['ImageURL']['name'], PATHINFO_EXTENSION)); // گرفتن پسوند فایل

    // چک می‌کنه که فرمت فایل مجاز باشه
    if (!in_array($file_type, $allowed_types)) {
        die("❌ فقط فرمت‌های JPG, JPEG, PNG و GIF مجاز هستند");
    }

    // ساخت اسم فایل یکتا با استفاده از timestamp
    $imageName = time() . '_' . basename($_FILES['ImageURL']['name']);
    $targetDir = "images/";
    $targetFile = $targetDir . $imageName;

    // اگه پوشه images وجود نداشت، بسازش
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // انتقال فایل آپلود شده به مسیر نهایی
    if (move_uploaded_file($_FILES['ImageURL']['tmp_name'], $targetFile)) {
        $imagePath = $targetFile;
    } else {
        die("❌ خطا در آپلود عکس");
    }
}

// ساخت کوئری با استفاده از prepared statement
$query = "INSERT INTO products 
(ProductName, Brand, Model, EnergyConsumption, Warranty, Price, Dimensions, Weight, ImageURL) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// آماده‌سازی statement
$stmt = mysqli_prepare($link, $query);
if (!$stmt) {
    die("❌ خطا در آماده‌سازی کوئری: " . mysqli_error($link));
}

// بایند کردن متغیرها به کوئری با نوع‌های مشخص
mysqli_stmt_bind_param($stmt, "ssssidsds", 
    $name, $brand, $model, $energy, $warranty, $price, $dimensions, $weight, $imagePath);

// اجرای کوئری
if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success_message'] = "✅ محصول با موفقیت اضافه شد.";
    header("Location: index.php"); // ریدایرکت به صفحه اصلی
    exit;
} else {
    die("❌ خطا در ثبت محصول: " . mysqli_error($link));
}

// بستن statement فقط اگه ساخته شده باشه
if ($stmt) {
    mysqli_stmt_close($stmt);
}

// بستن اتصال به دیتابیس اگه وصل شده باشه
if ($link) {
    mysqli_close($link);
}

// وارد کردن فوتر فقط اگه فایلش باشه
if (file_exists("includes/footer.php")) {
    include("includes/footer.php");
}
?>
