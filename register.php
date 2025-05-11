<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">  <!-- لینک به فایل استایل مخصوص فرم -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>  <!-- لینک به آیکون‌ها -->
</head>
<body>

<?php 
// بررسی می‌کنیم که کاربر وارد سایت شده یا نه
if(isset($_SESSION["state_login"]) && $_SESSION["state_Login"] == true){
    // اگر کاربر وارد شده باشد، اون رو به صفحه اصلی هدایت می‌کنیم
?>
<script type="text/javascript">
    location.replace("index.php");  <!-- هدایت به صفحه اصلی -->
</script>
<?php
}
?>

<!-- فرم ثبت نام -->
<div class="wrapper">
    <form action="register_action.php" method="Post">  <!-- اطلاعات فرم به register_action.php ارسال می‌شود -->
        <h1>Register</h1>  <!-- عنوان فرم ثبت‌نام -->
        
        <!-- فیلد نام کاربر -->
        <div class="input-box">
            <input type="text" placeholder="Your Name" name="name" required>  <!-- ورودی برای نام -->
        </div>

        <!-- فیلد نام کاربری -->
        <div class="input-box">
            <input type="text" placeholder="UserName" name="user" required>  <!-- ورودی برای نام کاربری -->
        </div>

        <!-- فیلد رمز عبور -->
        <div class="input-box">
            <input type="password" placeholder="Password" name="pass" required>  <!-- ورودی برای رمز عبور -->
        </div>

        <!-- فیلد ایمیل -->
        <div class="input-box">
            <input type="text" placeholder="Gmail" name="gmail" required>  <!-- ورودی برای ایمیل -->
        </div>

        <!-- دکمه ارسال فرم -->
        <button type="submit" class="btn">Register</button>  <!-- دکمه ثبت‌نام -->

        <!-- لینک به صفحه ورود -->
        <div class="register-link">
            <p>Do you have an account? <a href="login.php">Login</a></p>  <!-- اگر حساب کاربری دارید، به صفحه ورود بروید -->
        </div>
    </form>
</div>

</body>
</html>
