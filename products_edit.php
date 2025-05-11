<?php
# فایل header.php رو لود می‌کنه که احتمالاً شامل HTML اولیه و استایل‌هاست
include("includes/header.php");

# اتصال به دیتابیس با اطلاعات localhost
$link = mysqli_connect("localhost", "bekhio_root", "n123456", "bekhio_root");

# اگه وصل نشد، یه پیام خطا نشون میده و کد رو متوقف می‌کنه
if (!$link) {
    die("خطا در اتصال به دیتابیس: " . mysqli_connect_error());
}

# بررسی می‌کنه آیا id داخل URL هست یا نه
# همچنین چک می‌کنه که مقدارش عددی باشه
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("آیدی ارسال نشده یا غیرمعتبر است.");
}

# اگه همه‌چی اوکی بود، مقدار id رو از URL می‌گیره و تبدیل به عدد صحیح می‌کنه
$id = intval($_GET["id"]);

# ساختن یه کوئری امن برای جلوگیری از SQL Injection
# از ? استفاده شده که بعداً مقدارش با bind پر میشه
$query = "SELECT * FROM `products` WHERE ID = ?";
$stmt = mysqli_prepare($link, $query);  # ##########
mysqli_stmt_bind_param($stmt, "i", $id); # بایند کردن id به کوئری، نوعش عدد صحیحه
mysqli_stmt_execute($stmt);             # اجرای کوئری
$result = mysqli_stmt_get_result($stmt); # گرفتن نتیجه اجرای کوئری

# گرفتن اطلاعات ردیف پیدا شده
$row = mysqli_fetch_array($result);

# بعد از اینکه نتیجه گرفته شد، اتصال به دیتابیس بسته میشه
mysqli_close($mysql);

# اگه محصولی با این id پیدا بشه، اطلاعاتش توی متغیرها ریخته میشه
if ($row) {
    $ProductName = $row["ProductName"];
    $Brand = $row["Brand"];
    $Model = $row["Model"];
    $EnergyConsumption = $row["EnergyConsumption"];
    $Price = $row["Price"];
    $ImageURL = $row["ImageURL"];
} else {
    # اگه محصول وجود نداشت، یه پیام خطا می‌ده
    die("محصول مورد نظر پیدا نشد.");
}
?>

<!-- یه پیام ساده به کاربر نشون می‌ده که می‌تونه اطلاعات رو تغییر بده -->
<div class="row">
    <p class="col">تغییرات را اعمال نمایید</p>
</div>

<!-- فرم ویرایش محصول؛ مقادیر فعلی محصول به عنوان مقدار پیش‌فرض نمایش داده شدن -->
<form action="products_edit_action.php" method="post" enctype="multipart/form-data" class="row m-2">

    <!-- input پنهان که id محصول رو به صفحه مقصد می‌فرسته -->
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

    <!-- هر کدوم از فیلدهای زیر مقدار فعلی رو از دیتابیس می‌گیرن و داخل input نمایش می‌دن -->
    <input type="text" class="col-12 col-md card m-1" name="ProductName" placeholder="Product Name" value="<?php echo htmlspecialchars($ProductName); ?>">
    <input type="text" class="col-12 col-md card m-1" name="Brand" placeholder="Brand" value="<?php echo htmlspecialchars($Brand); ?>">
    <input type="text" class="col-12 col-md card m-1" name="Model" placeholder="Model" value="<?php echo htmlspecialchars($Model); ?>">
    <input type="text" class="col-12 col-md card m-1" name="EnergyConsumption" placeholder="Energy Consumption" value="<?php echo htmlspecialchars($EnergyConsumption); ?>">
    <input type="text" class="col-12 col-md card m-1" name="Price" placeholder="Price" value="<?php echo htmlspecialchars($Price); ?>">

    <!-- نشون دادن عکس فعلی محصول -->
    <label class="col-12 m-1">عکس فعلی:</label>
    <img src="<?php echo htmlspecialchars($ImageURL); ?>" alt="Product Image" class="col-12 col-md-4 card m-1" style="max-height:200px;">

    <!-- فیلدی برای آپلود عکس جدید اگه کاربر بخواد تغییر بده -->
    <input type="file" class="col-12 col-md card m-1" name="image">

    <!-- دکمه‌ای که فرم رو می‌فرسته برای ذخیره تغییرات -->
    <input type="submit" class="col-12 col-md card m-1 btn btn-success" value="ذخیره">
</form>

<!-- فایل footer.php هم احتمالاً شامل انتهای HTML و اسکریپت‌هاست -->
<?php include("includes/footer.php"); ?>

