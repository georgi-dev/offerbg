<?php echo doctype('html5'); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="author" content="smpl-studio.com">
    <meta name="description" content="">

    <title><?php echo htmlspecialchars($SiteTitle); ?></title>
    <?php if (!empty($CSS)): ?>
      <?php foreach ($CSS as $key => $CSSLink): ?>
        <link rel="stylesheet" href="<?php echo $CSSLink; ?>">
      <?php endforeach ?>
    <?php endif ?>

    <!-- CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?php echo asset_url();?>css/jquery-te.css"> 
    <link rel="stylesheet" href="<?php echo asset_url();?>css/slick.css">  
    <link rel="stylesheet" href="<?php echo asset_url();?>css/main.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/responsive.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/simeon.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo asset_url()?>css/styles/sweetalert2.min.css" rel="stylesheet" />
  
    <!-- font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round" >
    <link rel="stylesheet" href="<?php echo asset_url();?>css/font-awesome.min.css"> 


    <!-- icons -->
    <link rel="icon" href="<?php echo asset_url();?>images/ico/favicon.ico"> 
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo asset_url();?>images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo asset_url();?>images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo asset_url();?>images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo asset_url();?>images/ico/apple-touch-icon-57-precomposed.png">
    <!-- icons -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Template Developed By ThemeRegion -->

	
	<!-- theme style -->
	<!-- <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/master_style.css"> -->
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"> -->
	<!-- Aries_admin skins. choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	<!-- <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/skins/_all-skins.css"> -->
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

<!-- <script type="text/javascript" src="<?php echo asset_url();?>js/scripts/sweetalert2.all.min.js"></script> -->
  </head>
  <body>

