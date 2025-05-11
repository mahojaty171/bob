<?php
// اتصال به دیتابیس
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database"; // نام دیتابیس شما

$link = mysqli_connect("localhost", "root", "", "bekharino");

// بررسی اتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // دریافت اطلاعات از فرم
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    // آماده‌سازی و اجرای کوئری
    $stmt = $conn->prepare("INSERT INTO comments (name, comment) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $comment);

    if ($stmt->execute()) {
        echo "نظر با موفقیت ارسال شد!";
    } else {
        echo "خطا در ارسال نظر: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
