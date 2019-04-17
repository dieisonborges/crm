<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  

  <!-- CSRF Token -->
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title><?php echo e(config('app.name')); ?></title>
  <!-- Tell the browser to be responsive to screen width -->

  <link rel="stylesheet" type="text/css" href="#teste">


  <link rel="shortcut icon" href="<?php echo e(asset('img/logo/favicon.ico')); ?>" type="image/x-icon">
  <link rel="icon" href="<?php echo e(asset('img/logo/favicon.ico')); ?>" type="image/x-icon">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo e(asset('abower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <!-- Antigo -->
  <link rel="stylesheet" href="<?php echo e(asset('abower_components/font-awesome/css/font-awesome.min.css')); ?>">
  <!-- Font Awesome 5.8.1 -->
  <!-- Instalar depois -->    

  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo e(asset('abower_components/Ionicons/css/ionicons.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/AdminLTE.min.css')); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/skins/_all-skins.min.css')); ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo e(asset('abower_components/morris.js/morris.css')); ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo e(asset('abower_components/jvectormap/jquery-jvectormap.css')); ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo e(asset('abower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo e(asset('abower_components/bootstrap-daterangepicker/daterangepicker.css')); ?>">
    <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo e(asset('abower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')); ?>">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/timepicker/bootstrap-timepicker.min.css')); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo e(asset('abower_components/select2/dist/css/select2.min.css')); ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?php echo e(asset('js/ie/html5shiv.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/ie/respond.min.js')); ?>"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="<?php echo e(asset('css/fonts.googleapis.css')); ?>">

  <!-- CSS Customizado-->
  <link rel="stylesheet" href="<?php echo e(asset('css/customize.css')); ?>">
   

</head>