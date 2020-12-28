
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta http-equiv="content-type" content="text/html; charset=UTF-8">
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <title><?php xdocs_the_title(); ?></title>

            <link href="<?php  xdocs_path();?>/css/bootstrap.css" rel="stylesheet">
            <link href="<?php  xdocs_path();?>/css/docs.css" rel="stylesheet">
            <!--[if lt IE 9]>
            <script src="<?php echo xdocs_path();?>/js/ie8-responsive-file-warning.js"></script><![endif]-->
            <script src="<?php echo xdocs_path();?>/ie-emulation-modes-warning.js"></script>
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
            
            <link rel="stylesheet" type="text/css" href="<?php xdocs_path();?>/css/font-awesome.min.css">
         

            <!-- All dynamic styles -->
            <?php  $primary_color  = get_field('primary_color',$post_id);
            $secondary_color  = get_field('secondary_color',$post_id);

            ?>
            <style type="text/css">
                <?php  if($primary_color) : ?>
                .bs-docs-header, .bs-docs-masthead{
                    background: <?php echo $primary_color; ?>;
                }
                ..bs-docs-sidebar .nav > .active:focus > a, .bs-docs-sidebar .nav > .active:hover > a, .bs-docs-sidebar .nav > .active > a{
                    border-left: <?php echo $primary_color; ?>;
                    color: <?php echo $primary_color; ?>
                }
                <?php endif; ?>
                <?php  if($secondary_color) : ?>
                .bs-docs-footer{
                    background: <?php echo $secondary_color; ?>;
                }

                <?php endif; ?>

            </style>
            <?php xdocs_head(); ?>
        </head>
        <body>
        <?php xdocs_preloader(); ?>
