<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>افزودن محصول</title>

    <!-- استایل‌های داخلی برای دارک مود -->
    <style>
        /* کل صفحه پس‌زمینه تیره داره و متن روشن */
        body {
            background-color: #121212; /* رنگ پس‌زمینه تاریک */
            color: #f1f1f1; /* رنگ نوشته‌ها روشن */
            font-family: Tahoma, sans-serif; /* فونت ساده و خوانا */
            padding: 20px;
        }

        /* استایل فرم کلی */
        form {
            background-color: #1e1e1e; /* رنگ پس‌زمینه فرم کمی روشن‌تر از بک‌گراند کلی */
            padding: 20px; /* فاصله داخلی */
            border-radius: 10px; /* گوشه‌های گرد */
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.05); /* سایه نرم اطراف فرم */
            max-width: 500px; /* حداکثر عرض فرم */
            margin: auto; /* وسط‌چین کردن فرم */
        }

        /* استایل لیبل‌ها */
        label {
            display: block; /* هر لیبل در یک خط مجزا باشه */
            margin-bottom: 5px; /* فاصله پایین هر لیبل */
            margin-top: 15px; /* فاصله بالا برای جداسازی آیتم‌ها */
            font-weight: bold; /* لیبل‌ها پررنگ‌تر باشن */
        }

        /* استایل input ها */
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%; /* پهنای کامل بگیره */
            padding: 10px; /* فاصله داخلی */
            border: none; /* بدون بوردر پیش‌فرض */
            border-radius: 5px; /* گوشه‌های نرم */
            background-color: #2a2a2a; /* بک‌گراند تیره برای input */
            color: #fff; /* رنگ متن داخل input */
        }

        /* دکمه ارسال فرم */
        input[type="submit"] {
            background-color: #4caf50; /* رنگ سبز برای دکمه */
            color: white; /* متن سفید */
            padding: 10px 20px; /* فضای داخلی دکمه */
            border: none; /* بدون بوردر */
            border-radius: 5px; /* گوشه‌های نرم */
            cursor: pointer; /* وقتی روش می‌ری موس شبیه دست میشه */
            margin-top: 20px; /* فاصله از بالا */
        }

        /* حالت hover روی دکمه */
        input[type="submit"]:hover {
            background-color: #45a049; /* سبز تیره‌تر وقتی موس روش میره */
        }
    </style>
</head>
<body>

<!-- فرم داره از روش POST داده‌ها رو می‌فرسته به یه فایل PHP -->
<!-- چون type فرم multipart هست، می‌تونه فایل هم آپلود کنه -->
<form action="products_add_action.php" method="post" enctype="multipart/form-data">

    <!-- یه input که وقتی فرم ارسال بشه، مقدارش با کلید ProductName فرستاده میشه -->
    <!-- خاصیت required باعث میشه کاربر نتونه فرم رو بدون پر کردن این فیلد بفرسته -->
    <label>نام محصول:</label>
    <input type="text" name="ProductName" required><br>

    <!-- این یکی هم دقیقاً مثل بالاییه ولی برای برند -->
    <label>برند:</label>
    <input type="text" name="Brand" required><br>

    <!-- فیلدی که توش مدل نوشته میشه، با همون ساختار بالا -->
    <label>مدل:</label>
    <input type="text" name="Model" required><br>

    <!-- یه input که رشته مصرف انرژی رو می‌گیره -->
    <!-- مثل بقیه required هست پس بدون پر کردنش نمی‌شه ارسال کرد -->
    <label>مصرف انرژی:</label>
    <input type="text" name="EnergyConsumption" required><br>

    <!-- این یکی از نوع عددی هست -->
    <!-- وقتی کاربر عدد وارد کنه، توی name="Warranty" ذخیره میشه -->
    <label>گارانتی (ماه):</label>
    <input type="number" name="Warranty" required><br>

    <!-- ورودی عددی برای قیمت. توی فرم ارسال میشه -->
    <label>قیمت:</label>
    <input type="number" name="Price" required><br>

    <!-- لیبل و فیلد برای وارد کردن ابعاد محصول -->
    <label>ابعاد:</label>
    <input type="text" name="Dimensions"><br>
    <!-- این فیلد اجباری نیست و کاربر می‌تونه خالی بذاره -->

    <!-- لیبل و فیلد برای وزن محصول -->
    <label>وزن:</label>
    <input type="number" step="0.1" name="Weight"><br>
    <!-- نوع عددی با step یعنی می‌تونه اعشار وارد کنه، مثلاً ۲.۵ یا ۰.۷ -->

    <!-- لیبل و فیلد آپلود عکس محصول -->
    <label>عکس محصول:</label>
    <input type="file" name="ImageURL" accept="image/*"><br><br>
    <!-- فقط عکس قابل انتخابه چون accept="image/*" -->

    <!-- دکمه‌ای که وقتی کلیک شه فرم رو ارسال می‌کنه -->
    <input type="submit" value="ثبت محصول">
    <!-- وقتی کلیک بشه فرم به فایل products_add_action.php ارسال میشه -->
</form>

</body>
</html>
