<?php
include("includes/header.php");

// اتصال به دیتابیس bekharino
$link = mysqli_connect("localhost", "root", "", "bekharino");
if (!$link) {
    die("خطا در اتصال به دیتابیس: " . mysqli_connect_error());
}

// بررسی وجود ID
if (!isset($_POST["id"]) || !is_numeric($_POST["id"])) {
    die("شناسه محصول نامعتبر است.");
}
$id = intval($_POST["id"]);

// دریافت اطلاعات محصول برای بررسی وجود آن
$check_query = "SELECT * FROM products WHERE ID = ?";
$stmt = mysqli_prepare($link, $check_query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    die("محصول پیدا نشد.");
}

// پردازش فرم
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($link, $_POST["ProductName"]);
    $brand = mysqli_real_escape_string($link, $_POST["Brand"]);
    $model = mysqli_real_escape_string($link, $_POST["Model"]);
    $energy = mysqli_real_escape_string($link, $_POST["EnergyConsumption"]);
    $price = floatval($_POST["Price"]);
    $imagePath = $product["ImageURL"]; // مقدار پیش‌فرض: تصویر قبلی

    // بررسی و آپلود تصویر جدید
    if (!empty($_FILES["image"]["name"])) {
        $imageName = basename($_FILES["image"]["name"]);
        $targetDir = "images/";
        $targetFile = $targetDir . $imageName;
        
        // بررسی نوع فایل (اختیاری)
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        
        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $imagePath = $targetFile;
            } else {
                echo "خطا در آپلود تصویر.";
            }
        } else {
            echo "فرمت تصویر مجاز نیست.";
        }
    }

    // به‌روزرسانی محصول با استفاده از prepared statement
    $update_query = "UPDATE products SET 
                    ProductName = ?, 
                    Brand = ?, 
                    Model = ?, 
                    EnergyConsumption = ?, 
                    Price = ?,
                    ImageURL = ? 
                    WHERE ID = ?";
    
    $stmt = mysqli_prepare($link, $update_query);
    mysqli_stmt_bind_param($stmt, "ssssdsi", $name, $brand, $model, $energy, $price, $imagePath, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "محصول با موفقیت به‌روزرسانی شد.";
        header("refresh:2;url=index.php"); // تغییر مسیر پس از 2 ثانیه
        exit;
    } else {
        echo "خطا در به‌روزرسانی محصول: " . mysqli_error($link);
    }
}

mysqli_close($link);
include("includes/footer.php");
?>