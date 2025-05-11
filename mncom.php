<?php
include("includes/header.php");?>

<?php
$link = mysqli_connect("localhost", "root", "", "bekharino");
if (!$link) die("اتصال ناموفق به دیتابیس");

// حذف نظر
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($link, "DELETE FROM comments WHERE id = $id");
    header("Location: mncom.php");  // تغییر به mncom.php
    exit;
}

// ویرایش نظر (نمایش فرم)
$edit_comment = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $res = mysqli_query($link, "SELECT * FROM comments WHERE id = $id");
    $edit_comment = mysqli_fetch_assoc($res);
}

// ذخیره ویرایش
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
    $id = intval($_POST['update_id']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $comment = mysqli_real_escape_string($link, $_POST['comment']);
    mysqli_query($link, "UPDATE comments SET name='$name', comment='$comment' WHERE id=$id");
    header("Location: mncom.php");  // تغییر به mncom.php
    exit;
}

$result = mysqli_query($link, "SELECT * FROM comments ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>مدیریت نظرات</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="p-4 bg-light">
<div class="container">
    <h3>🛠️ مدیریت نظرات</h3>

    <?php if ($edit_comment): ?>
    <div class="card p-3 mb-4">
        <h5>✏️ ویرایش نظر</h5>
        <form method="POST">
            <input type="hidden" name="update_id" value="<?php echo $edit_comment['id']; ?>">
            <div class="form-group">
                <label>نام:</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($edit_comment['name']); ?>" required>
            </div>
            <div class="form-group">
                <label>نظر:</label>
                <textarea name="comment" class="form-control" rows="3" required><?php echo htmlspecialchars($edit_comment['comment']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">💾 ذخیره</button>
            <a href="mncom.php" class="btn btn-secondary">❌ انصراف</a>
        </form>
    </div>
    <?php endif; ?>

    <table class="table table-bordered bg-white">
        <thead>
        <tr>
            <th>کاربر</th>
            <th>نظر</th>
            <th>زمان</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($row['comment'])); ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
                <a href="mncom.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">✏️ ویرایش</a>
                <a href="mncom.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('حذف شود؟')">🗑 حذف</a>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php mysqli_close($link); ?>
