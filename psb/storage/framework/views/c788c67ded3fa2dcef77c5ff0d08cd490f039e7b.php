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

    <title>Aplikasi PSB | 2020-2021</title>

    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper" id="app">
  <div class="content-wrapper">
      <div class="row justify-content-center">
          <?php echo $__env->yieldContent('content'); ?>
      </div>
      <div class="text-center">
        <?php if(auth()->user()->isAdmin()): ?>
          <a class="btn btn-primary btn-lg" href="<?php echo e(url('/home')); ?>">Home </a>
        <?php endif; ?>
        <?php if(auth()->user()->isUser()): ?>
          <a class="btn btn-primary btn-lg" href="<?php echo e(url('/psb')); ?>">Home</a>
        <?php endif; ?>
      </div>
  </div>

    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            IT Team - SIT Nurul Fikri
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2019 <a href="https://nurulfikri.sch.id">SIT Nurul Fikri</a>.</strong>
    </footer>
</div>
<!-- ./wrapper -->

<script src="/js/app.js"></script>
</body>
</html>
<?php /**PATH /home/tik/psb/resources/views/layouts/error.blade.php ENDPATH**/ ?>