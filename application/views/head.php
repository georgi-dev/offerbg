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
    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?php echo asset_url();?>css/jquery-te.css"> 
    <link rel="stylesheet" href="<?php echo asset_url();?>css/slick.css">  
    <link rel="stylesheet" href="<?php echo asset_url();?>css/main.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/responsive.css">
  
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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!-- Aries_admin skins. choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	<!-- <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/skins/_all-skins.css"> -->
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link href="<?php echo asset_url()?>css/styles/sweetalert2.min.css" rel="stylesheet" />
<!-- <script type="text/javascript" src="<?php echo asset_url();?>js/scripts/sweetalert2.all.min.js"></script> -->
  </head>

  <body>
    <header class="tr-header">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"><i class="fa fa-align-justify"></i></span>
                      </button>
            <a class="navbar-brand" href="index.html"><img class="img-fluid" src="images/logo.png" alt="Logo"></a>
          </div>
          <!-- /.navbar-header -->
          
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav navbar-nav">
              <li class="tr-dropdown"><a href="#">Home</a>
                <ul class="tr-dropdown-menu left tr-list fadeInUp" role="menu">
                      <li><a href="index.html">Home Page V-1</a></li>
                      <li><a href="index1.html">Home Page V-2</a></li>
                </ul>
              </li>
              <li><a href="job-post.html">Post A Job</a></li>
              <li><a href="listing.html">Job List</a></li>
              <li><a href="job-details.html">Job Details</a></li>
              <li class="tr-dropdown active"><a href="#">Pages</a>
                <ul class="tr-dropdown-menu tr-list fadeInUp" role="menu">
                      <li class="active"><a href="employee-profile.html">Employee Profile</a></li>
                      <li><a href="employer-profile.html">Employer Profile</a></li>
                      <li><a href="view-compnay.html">View Compnay</a></li>
                      <li><a href="view-resume.html">View Resume</a></li>
                      <li><a href="coming-soon.html">Coming Soon</a></li>
                      <li><a href="notification.html">Notification</a></li>
                      <li><a href="contact.html">Contact</a></li>
                      <li><a href="pricing.html">Pricing</a></li>
                      <li><a href="signup.html">Sign Up</a></li>
                      <li><a href="signin.html">Sign In</a></li>
                      <li><a href="500.html">500 Opsss</a></li>
                      <li><a href="404.html">404 Error</a></li>
                </ul>
              </li>
            </ul>
          </div>

          <div class="navbar-right">      
            <div class="dropdown tr-change-dropdown">
              <i class="fa fa-globe"></i>
              <a data-toggle="dropdown" href="#" aria-expanded="false"><span class="change-text">United Kingdom</span><i class="fa fa-angle-down"></i></a>
              <ul class="dropdown-menu tr-change tr-list">
                <li><a href="#">United Kingdom</a></li>
                <li><a href="#">United States</a></li>
                <li><a href="#">China</a></li>
                <li><a href="#">Russia</a></li>
              </ul>               
            </div><!-- /.language-dropdown -->          
            <ul class="sign-in tr-list">
              <li><i class="fa fa-user"></i></li>
              <li><a href="#"> Sign In </a></li>
              <li><a href="#">Register</a></li>
            </ul><!-- /.sign-in -->         

            <a href="job-post.html" class="btn btn-primary">Post Job</a>
          </div><!-- /.nav-right -->
        </div><!-- /.container -->
      </nav><!-- /.navbar -->
    </header><!-- /.tr-header -->

    <div class="tr-breadcrumb bg-image section-before">
      <div class="container">
        <div class="breadcrumb-info text-center">
          <div class="user-image">
            <img src="images/others/author.png" alt="Image" class="img-fluid">
          </div>
          <div class="user-title">
            <h1>Jhon Doe</h1>
          </div>    
          <ul class="job-meta tr-list list-inline">
            <li><i class="fa fa-map-marker" aria-hidden="true"></i>San Francisco, CA, US</li>
            <li><i class="fa fa-phone" aria-hidden="true"></i>+0123 456 789</li>
            <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="#">jhondoe@gmail.com</a></li>
            <li><i class="fa fa-briefcase" aria-hidden="true"></i>UI & UX Designer</li>
          </ul>
          <ul class="breadcrumb-social social-icon-bg  tr-list">
            <li><a href="#"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i> <span>Twitter</span> </a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i> <span>Google Plus</span> </a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i><span>Linkedin</span> </a></li>
            <li><a href="#"><i class="fa fa-dribbble"></i> <span>Dribbble</span></a></li>
            <li><a href="#"><i class="fa fa-behance"></i> <span>Behance</span></a></li>
            <li><a href="#"><i class="fa fa-globe"></i> <span>Website</span> </a></li>
          </ul>     
        </div>
      </div><!-- /.container -->
    </div><!-- /.tr-breadcrumb -->  


  <div class="modal" id="header_modal">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">
                      <?php echo ApplicationName; ?>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p></p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" id="proceed">Да</button>
                  <button type="button" class="btn btn-secondary" id="cancel_action" data-dismiss="modal">Отказ</button>
              </div>
          </div>
      </div>
  </div>





