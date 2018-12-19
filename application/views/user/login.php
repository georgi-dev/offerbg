<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>

<html lang="en">
<?php
  $headerParams = array('SiteTitle' => "Login");
?>
<?php $this->load->view('header',$headerParams)?>

<head>

  <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="icon" href="<?php echo site_url(); ?>images/favicon.ico">



    <title>Aries Admin - Log in</title>

  

	<!-- Bootstrap 4.0-->

	


</head>

<body class="hold-transition login-page">

<div class="login-box container row col-md-6 offset-md-4">

  <div class="login-logo">

    <a href="<?php echo site_url(); ?>"><b>Offer.bg</b>Admin</a>

  </div>
<br>
  <!-- /.login-logo -->

  <div class="login-box-body">

    <h3 class="login-box-msg">Sign in</h3>



	<?php

		$Message = $this->messages->GetMessage();

	?>

	<?php if (!empty($Message['Message'])): ?>

	<div class="alert alert-<?php echo $Message['Level']; ?>"><?php echo $Message['Message']; ?></div>

	<?php endif; ?>

	

	<?php

		$Username = $this->session->flashdata('username');

	?>

    <form action="<?php echo site_url('users/login/do'); ?>" method="post" class="form-element">

      <div class="form-group has-feedback">

        <input type="email" style="padding-right: 32px;" class="form-control" placeholder="Email" name="email" value="<?php echo htmlspecialchars($Username); ?>"<?php if (empty($Username)): ?> autofocus<?php endif; ?>>

        <span class="ion ion-email form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" style="padding-right: 32px;" class="form-control" placeholder="Password" name="password"<?php if (!empty($Username)): ?> autofocus<?php endif; ?>>

        <span class="ion ion-locked form-control-feedback"></span>

      </div>

      <div class="row">

        <div class="col-6">

          <div class="checkbox">

            <input type="checkbox" id="basic_checkbox_1" >

			<label for="basic_checkbox_1">Remember Me</label>

          </div>

        </div>

        <!-- /.col -->

        <div class="col-6">

         <div class="fog-pwd">

          	<a href="javascript:void(0)"><i class="ion ion-locked"></i> Can't login?</a><br>

          </div>

        </div>

        <!-- /.col -->

        <div class="col-12 text-center">

          <button type="submit" class="btn btn-info btn-block margin-top-10">SIGN IN</button>

        </div>

        <!-- /.col -->

      </div>

    </form>



  </div>

  <!-- /.login-box-body -->

</div>

<!-- /.login-box -->





<?php $this->load->view('footer');?>
	



</body>

</html>

