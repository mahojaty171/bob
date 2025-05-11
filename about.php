<!DOCTYPE html>
<html lang="fa"> <!-- تعیین زبان صفحه به فارسی -->
<head>
    <meta charset="UTF-8"> <!-- تنظیم کدگذاری کاراکترها به UTF-8 برای پشتیبانی از کاراکترهای فارسی -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- تنظیمات ریسپانسیو برای نمایش صحیح صفحه در دستگاه‌های مختلف -->
    <title>Bekharino - درباره ما</title> <!-- عنوان صفحه که در تب مرورگر نمایش داده می‌شود -->

    <style>
        /* استایل مخصوص این صفحه بدون تغییر قالب اصلی */
        .content {
            display: flex; /* استفاده از فلیکسباکس برای چینش عناصر */
            flex-direction: column; /* چینش المان‌ها به صورت عمودی */
            align-items: center; /* وسط‌چین کردن محتویات */
            margin-top: 50px; /* فاصله از بالا */
        }

        .box {
            background-color: rgba(255, 255, 255, 0.1); /* پس‌زمینه نیمه‌شفاف */
            padding: 20px; /* فاصله داخلی باکس */
            border-radius: 10px; /* گوشه‌های گرد برای باکس */
            width: 60%; /* عرض باکس به اندازه 60% عرض صفحه */
            margin-bottom: 20px; /* فاصله پایین باکس‌ها */
            text-align: center; /* مرکز چین کردن متن‌ها */
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1); /* سایه برای برجسته کردن باکس‌ها */
        }

        .box h2 {
            color: #ffcc00; /* رنگ عنوان باکس */
            margin-bottom: 10px; /* فاصله زیر عنوان */
        }

        .box p {
            font-size: 16px; /* سایز فونت پاراگراف */
            line-height: 1.6; /* فاصله خطوط پاراگراف برای خوانایی بهتر */
        }

        .profile-img {
            width: 120px; /* عرض تصویر */
            height: 120px; /* ارتفاع تصویر */
            border-radius: 50%; /* گرد کردن تصویر برای ساخت تصویر پروفایل */
            margin-top: 10px; /* فاصله از بالای تصویر */
        }
    </style>
</head>
<body>

    <?php include 'includes/header.php'; ?> <!-- هدر سایت بدون تغییر باقی می‌ماند -->

    <!-- محتوا -->
    <div class="content">
        <!-- بخش درباره ما -->
        <div class="box">
            <h2>درباره ما</h2> <!-- عنوان بخش -->
            <p>به مدیریت <strong>محمد امین حجتی</strong> فعالیت می‌کند.  
                وبسایت <strong>Bekharino</strong> با هدف ارائه بهترین تجربه خرید آنلاین ایجاد شده است.</p>
        </div>
        
        <!-- بخش معرفی مدیر -->
        <div class="box">
            <h2>محمد امین حجتی</h2> <!-- عنوان معرفی مدیر -->
            <p>مدیر و توسعه‌دهنده وبسایت Bekharino</p>
            <img src="images/6.png" alt="محمد امین حجتی" class="profile-img"> <!-- تصویر مدیر -->
        </div>
    </div>

    <?php include 'includes/footer.php'; ?> <!-- فوتر سایت بدون تغییر باقی می‌ماند -->

</body>
</html>
