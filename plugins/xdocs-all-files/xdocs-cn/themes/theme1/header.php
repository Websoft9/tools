<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php xdocs_the_title(); ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" type="text/css" href="<?php xdocs_path();?>/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php xdocs_path();?>/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="<?php xdocs_path();?>/css/prism.css">
    <link rel="stylesheet" type="text/css" href="<?php xdocs_path();?>/css/layout.css">
    <link rel="stylesheet" type="text/css" href="<?php xdocs_path();?>/css/skin-blue.css">

    <link rel="stylesheet" type="text/css" href="<?php xdocs_path();?>/css/style.css">

    <!-- All dynamic styles -->
    <?php  $primary_color  = get_field('primary_color',$post_id);
           $secondary_color  = get_field('secondary_color',$post_id); 

     ?>
    <style type="text/css">
    <?php  if($primary_color) : ?>
        .social,.content-header .version, .steps > li,aside::after{
          background: <?php echo $primary_color; ?>;
        }
        .main-header .sidebar-toggle::before,.skin-blue .sidebar-menu > li:hover > a, .skin-blue .sidebar-menu > li.active > a,.nav > li > a:hover, .nav > li > a:active, .nav > li > a:focus{
          color: <?php echo $primary_color; ?>
        }
        .nav.treeview-menu{
            border-color:<?php echo $primary_color; ?> ;
        }
    <?php endif; ?>
    <?php  if($secondary_color) : ?>
    .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side{
      background: <?php echo $secondary_color; ?>;
    }
 
  <?php endif; ?>

    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <?php xdocs_head(); ?>
  </head>
  <body class="skin-blue fixed" data-spy="scroll" data-target="#scrollspy">


    
    <?php xdocs_preloader(); ?>
    <div class="wrapper">
      <header class="main-header">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
      </header>
      <!-- Left side column. contains the logo and sidebar -->