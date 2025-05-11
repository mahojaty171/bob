<?php
# لود کردن فایل header که احتمالاً شروع صفحه HTML و استایل‌هاست
include("includes/header.php");
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>مدیریت محصولات</h2>
        <!-- دکمه برای رفتن به صفحه افزودن محصول جدید -->
        <a class="btn btn-success" href="bekh_add.php">
            <i class="fas fa-plus"></i> افزودن محصول جدید
        </a>
    </div>

    <div class="row">
        <?php
        # اتصال به دیتابیس
        $link = mysqli_connect("localhost", "root", "", "bekharino");
        
        # اگه اتصال ناموفق بود، پیام خطا چاپ میشه و اجرای ادامه نمی‌یابه
        if (!$link) {
            die("خطا در اتصال به دیتابیس: " . mysqli_connect_error());
        }

        # گرفتن همه محصولات از جدول products به ترتیب نزولی (آخرین محصول بیاد اول)
        $result = mysqli_query($link, "SELECT * FROM `products` ORDER BY ID DESC");
        
        # اگه محصولی پیدا شد، با while همه‌شون رو یکی‌یکی نمایش می‌ده
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                # اگه عکس وجود داشته باشه از خودش استفاده می‌کنیم، وگرنه یه عکس پیش‌فرض
                $imagePath = !empty($row["ImageURL"]) ? $row["ImageURL"] : "images/default_product.png";
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <!-- نشون دادن عکس محصول -->
                        <img src="<?php echo $imagePath; ?>" 
                             class="card-img-top product-image" 
                             alt="<?php echo htmlspecialchars($row["ProductName"]); ?>"
                             onerror="this.src='images/default_product.png'">
                        <div class="card-body">
                            <!-- اسم محصول -->
                            <h5 class="card-title product-title"><?php echo htmlspecialchars($row["ProductName"]); ?></h5>
                            <div class="product-details">
                                <!-- اطلاعات برند، مدل، مصرف انرژی و قیمت -->
                                <p><strong>برند:</strong> <?php echo htmlspecialchars($row["Brand"]); ?></p>
                                <p><strong>مدل:</strong> <?php echo htmlspecialchars($row["Model"]); ?></p>
                                <p><strong>مصرف انرژی:</strong> <?php echo htmlspecialchars($row["EnergyConsumption"]); ?></p>
                                <p><strong>قیمت:</strong> <span class="text-danger"><?php echo number_format($row["Price"]); ?> تومان</span></p>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <!-- لینک ویرایش محصول -->
                                <a href="products_edit.php?id=<?php echo $row["ID"]; ?>" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> ویرایش
                                </a>
                                <!-- لینک حذف محصول با تایید از کاربر -->
                                <a href="products_delete.php?id=<?php echo $row["ID"]; ?>" 
                                   class="btn btn-danger" 
                                   onclick="return confirm('آیا از حذف این محصول مطمئن هستید؟')">
                                    <i class="fas fa-trash"></i> حذف
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            # اگه دیتابیس خالی باشه، یه پیام نشون می‌ده که چیزی پیدا نشده
            echo '<div class="col-12"><div class="alert alert-info">هیچ محصولی یافت نشد.</div></div>';
        }

        # بستن اتصال به دیتابیس بعد از تموم شدن عملیات
        mysqli_close($link);
        ?>
    </div>
</div>

<?php
# در نهایت، فوتر صفحه هم لود میشه
include("includes/footer.php");
?>
