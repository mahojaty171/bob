<?php
include("includes/header.php");
if (session_status() === PHP_SESSION_NONE) session_start();

// اتصال به دیتابیس
$link = mysqli_connect("localhost", "root", "", "bekharino");
if (!$link) die("خطا در اتصال: " . mysqli_connect_error());

// گرفتن آیدی محصول از URL
if (!isset($_GET['id'])) die("شناسه محصول مشخص نیست.");
$product_id = intval($_GET['id']);

// گرفتن اطلاعات محصول
$result = mysqli_query($link, "SELECT * FROM products WHERE ID = $product_id");
if (!$result || mysqli_num_rows($result) == 0) die("محصولی با این شناسه پیدا نشد.");
$product = mysqli_fetch_assoc($result);

// ثبت نظر
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name']) && !empty($_POST['comment'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $comment = mysqli_real_escape_string($link, $_POST['comment']);
    mysqli_query($link, "INSERT INTO comments (news_id, name, comment) VALUES ($product_id, '$name', '$comment')");
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['ProductName']); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">

    <!-- نمایش اطلاعات محصول -->
    <div class="card">
        <img src="<?php echo htmlspecialchars($product['ImageURL']); ?>" class="card-img-top" alt="تصویر محصول">
        <div class="card-body">
            <h3 class="card-title"><?php echo htmlspecialchars($product['ProductName']); ?></h3>
            <p><strong>برند:</strong> <?php echo htmlspecialchars($product['Brand']); ?></p>
            <p><strong>مدل:</strong> <?php echo htmlspecialchars($product['Model']); ?></p>
            <p><strong>مصرف انرژی:</strong> <?php echo htmlspecialchars($product['EnergyConsumption']); ?></p>
            <p><strong>قیمت:</strong> <?php echo number_format($product['Price']); ?> تومان</p>
        </div>
    </div>

    <hr>

    <!-- فرم نظر -->
    <div class="card mt-4">
        <div class="card-body">
            <h5>📝 ارسال نظر</h5>
            <form method="POST">
                <div class="form-group">
                    <label for="name">نام شما:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="comment">نظر شما:</label>
                    <textarea name="comment" id="comment" rows="3" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-success mt-2">ارسال نظر</button>
            </form>
        </div>
    </div>

    <!-- نمایش نظرات -->
    <div class="mt-4">
        <h5>💬 نظرات کاربران:</h5>
        <?php
        $comments = mysqli_query($link, "SELECT * FROM comments WHERE news_id = $product_id ORDER BY created_at DESC");
        if (mysqli_num_rows($comments) > 0):
            while ($row = mysqli_fetch_assoc($comments)):
        ?>
        <div class="border p-3 mb-2 bg-white rounded">
            <strong><?php echo htmlspecialchars($row['name']); ?>:</strong>
            <p><?php echo nl2br(htmlspecialchars($row['comment'])); ?></p>
            <small class="text-muted"><?php echo $row['created_at']; ?></small>
        </div>
        <?php endwhile; else: ?>
            <p>هنوز نظری ثبت نشده است.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>

<?php
mysqli_close($link);
include("includes/footer.php");
?>
