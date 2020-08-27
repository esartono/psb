<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title>Login | PPDB SIT Nurul Fikri 2020-2021</title>

  <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#">PPDB Online - SIT Nurul Fikri - Depok</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <?php echo $__env->yieldContent('content'); ?>
    </div>
  </div>
</div>
<script src="/js/app.js"></script>

</body>
</html>
<?php /**PATH /home/tik/psb/resources/views/layouts/login.blade.php ENDPATH**/ ?>