<?php
include("includes/header.php");

// اگه سشن هنوز فعال نشده، فعالش می‌کنیم
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// اتصال به دیتابیس
$link = mysqli_connect("localhost", "bekhio_root", "n123456", "bekhio_root");
if (!$link) {
    die("مشکل در اتصال به دیتابیس");
}

// چک کردن نقش ادمین
$isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';

// گرفتن محصولات از دیتابیس
$result = mysqli_query($link, "SELECT * FROM products ORDER BY ID DESC");
?>

<div class="container mt-4">
    <h2 class="mb-4">لیست محصولات</h2>
    <div class="row">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php
                    $imagePath = !empty($row["ImageURL"]) ? $row["ImageURL"] : "images/default_product.png";
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 product-card">
                        <img src="<?php echo htmlspecialchars($imagePath); ?>" 
                             class="card-img-top product-image"
                             alt="<?php echo htmlspecialchars($row["ProductName"]); ?>"
                             onerror="this.src='images/default_product.png'">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($row["ProductName"]); ?></h5>
                            <p><strong>برند:</strong> <?php echo htmlspecialchars($row["Brand"]); ?></p>
                            <p><strong>مدل:</strong> <?php echo htmlspecialchars($row["Model"]); ?></p>
                            <p><strong>مصرف انرژی:</strong> <?php echo htmlspecialchars($row["EnergyConsumption"]); ?></p>
                            <p><strong>قیمت:</strong> <span class="text-danger"><?php echo number_format($row["Price"]); ?> تومان</span></p>

                            <!-- دکمه مشاهده یا خرید -->
                            <a href="news_view.php?id=<?php echo $row['ID']; ?>" class="btn btn-primary" target="_blank">مطالعه بیشتر</a>


                            <?php if ($isAdmin): ?>
                                <div class="mt-auto d-flex justify-content-between mt-3">
                                    <a href="products_edit.php?id=<?php echo $row["ID"]; ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> ویرایش
                                    </a>
                                    <a href="products_delete.php?id=<?php echo $row["ID"]; ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('آیا از حذف این محصول مطمئن هستید؟')">
                                        <i class="fas fa-trash"></i> حذف
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">هیچ محصولی یافت نشد.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
mysqli_close($link);
include("includes/footer.php");
?>
