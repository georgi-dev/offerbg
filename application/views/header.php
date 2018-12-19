<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="<?php echo site_url(); ?>images/favicon.ico"> -->

    <title><?php echo htmlspecialchars($SiteTitle); ?></title>
    <?php if (!empty($CSS)): ?>
    	<?php foreach ($CSS as $key => $CSSLink): ?>
			
			<link rel="stylesheet" href="<?php echo $CSSLink; ?>">

		<?php endforeach ?>
    <?php endif ?>
	
	
	<!-- theme style -->
	<!-- <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/master_style.css"> -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!-- Aries_admin skins. choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	<!-- <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/skins/_all-skins.css"> -->
	

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

     <style type="text/css">
     .fas.fa-bars{
      padding:20px !important;color:#fff !important;
     }

     .fas.fa-bars:hover{
      color:#fff;
     }

     </style>
  </head>

<body class="hold-transition skin-blue sidebar-mini fixed">






