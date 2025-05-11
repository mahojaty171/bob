<!DOCTYPE html>
<html lang="fa">
<head>
    <!-- 
    متا تگ‌ها برای تنظیمات صفحه: 
    charset مشخص می‌کنه که صفحه باید با چه کدگذاری کار کنه (UTF-8 یعنی تمام کاراکترها به درستی نمایش داده می‌شوند).
    meta name="viewport" برای اطمینان از ریسپانسیو بودن صفحه است، یعنی صفحه در دستگاه‌های موبایل و دسکتاپ به درستی نمایش داده می‌شود.
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login</title> <!-- عنوان صفحه در مرورگر -->

    <!-- 
    لینک به استایل‌های CSS: 
    اینجا از یک فایل CSS خارجی به نام "login.css" استفاده می‌شود که مربوط به طراحی صفحه لاگین است.
    همچنین از Boxicons برای استفاده از آیکن‌ها در کنار فیلدهای ورودی (مثل آیکن‌های نام کاربری و رمز عبور) استفاده می‌شود.
    -->
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    
<?php 
// بررسی می‌کنیم که آیا کاربر قبلاً وارد شده است یا نه.
// اگر کاربر قبلاً وارد شده باشد (یعنی مقدار session["state_login"] برابر با true باشد)،
    // در این صورت صفحه لاگین نباید نمایش داده شود و کاربر باید به صفحه اصلی هدایت شود.
if(isset($_SESSION["state_login"]) && $_SESSION["state_login"] == true){
?>
<script type="text/javascript">
    // اینجا از جاوا اسکریپت برای هدایت به صفحه اصلی (index.php) استفاده می‌کنیم.
    location.replace("index.php");  <!-- اگر کاربر لاگین کرده باشد، به صفحه اصلی هدایت می‌شود -->
</script>
<?php
}
?>

<!-- 
    فرم لاگین (ورود به سایت):
    این فرم به کاربر امکان می‌دهد که با وارد کردن نام کاربری و رمز عبور، وارد سایت شود.
-->
<div class="wrapper">
    <!-- 
        action="login_action.php": یعنی زمانی که فرم ارسال می‌شود، داده‌ها به فایل "login_action.php" ارسال می‌شود.
        method="POST": یعنی داده‌ها از طریق متد POST ارسال می‌شوند (در مقایسه با GET که داده‌ها در URL ارسال می‌شود، POST امن‌تر است).
    -->
    <form action="login_action.php" method="POST">
        <!-- عنوان فرم -->
        <h1>Login</h1>

        <!-- بخش ورودی نام کاربری -->
        <div class="input-box">
            <!-- input برای وارد کردن نام کاربری -->
            <input type="text" placeholder="UserName" name="user" required> <!-- این فیلد برای نام کاربری است -->
            <i class='bx bxs-user'></i> <!-- آیکن نمایشی برای فیلد نام کاربری -->
        </div>

        <!-- بخش ورودی رمز عبور -->
        <div class="input-box">
            <!-- input برای وارد کردن رمز عبور -->
            <input type="password" placeholder="Password" name="pass" required> <!-- این فیلد برای رمز عبور است -->
            <i class='bx bxs-lock-alt'></i> <!-- آیکن نمایشی برای فیلد رمز عبور -->
        </div>

        <!-- بخش یادآوری ورود و فراموشی رمز عبور -->
        <div class="rememmber-forgot">
            <!-- چک‌باکس برای "یادآوری ورود" -->
            <label><input type="checkbox" name="remember_me"> Remember me</label> 
            <!-- لینک به صفحه فراموشی رمز عبور (در اینجا هنوز لینکی برای آن نوشته نشده) -->
            <a href="#">Forget Password</a>
        </div>

        <!-- دکمه برای ارسال فرم (ورود به سایت) -->
        <button type="submit" class="btn">Login</button>

        <!-- بخش ثبت‌نام برای کاربرانی که حساب ندارند -->
        <div class="register-link">
            <!-- لینک به صفحه ثبت‌نام -->
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </form>
</div>

</body>
</html>
