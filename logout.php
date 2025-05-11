<?php 
  include("includes/header.php");  // گنجاندن فایل هدر سایت
?>

<?php
    unset($_SESSION["state_login"]);  // پاک کردن اطلاعات جلسه (خروج از حساب کاربری)
?>
<div class="alert alert-primary" role="alert">
  <p class="pc">شما با موفقیت از حسابتان خارج شدید</p>
</div>

<script type="text/javascript">
  location.replace("index.php");  // انتقال به صفحه اصلی
</script>

<?php
  include("includes/footer.php");  // گنجاندن فایل فوتر سایت
?>
