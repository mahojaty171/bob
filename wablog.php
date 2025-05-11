<?php
include("head.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$link = mysqli_connect("localhost", "bekhio_root", "n123456", "bekhio_root");
if (!$link) {
    die("خطا در اتصال به دیتابیس: " . mysqli_connect_error());
}

$result = mysqli_query($link, "SELECT * FROM news ORDER BY id DESC");
if (!$result) {
    die("خطا در اجرای کوئری: " . mysqli_error($link));
}
?>

<!DOCTYPE html>
<html lang="fa">
<head> 
    <meta charset="UTF-8">
    <title>وبلاگ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Tahoma;
            background-color: #f4f4f9;
            text-align: center;
        }
        img {
            height: 250px;
            width: 100%;
            object-fit: cover;
        }
        .card-body {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>📰 وبلاگ</h1>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?php while ($row = mysqli_fetch_array($result)) {
                    $full_text = htmlspecialchars($row['text']);
                    $first_sentence = preg_split('/(?<=[.!؟])\s+/', $full_text, 2)[0];
                ?>
                <div class="card mb-4">
                    <img src="<?php echo htmlspecialchars($row['imageurl']); ?>" class="card-img-top" alt="تصویر خبر">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p class="card-text"><?php echo $first_sentence . '...'; ?></p>
                        <a href="news_view.php?id=<?php echo $row['id']; ?>" class="btn btn-primary" target="_blank">مطالعه بیشتر</a>
                        <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'reza'): ?>
                            <a href="news_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">✏ ویرایش</a>
                            <a href="news_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('آیا مطمئن هستید؟');">🗑 حذف</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php mysqli_close($link); ?>
<?php
include("footer.php")
?>