     <header class="tr-header">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"><i class="fa fa-align-justify"></i></span>
                      </button>
            <a class="navbar-brand" href="index.html"><img class="img-fluid" src="<?php echo asset_url(); ?>images/logo.png" alt="Logo"></a>
          </div>
          <!-- /.navbar-header -->
          
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav navbar-nav">
              <li class="tr-dropdown"><a href="#">Обяви</a>

              </li>
              <li><a href="job-post.html">Фирми</a></li>
              <li class="tr-dropdown"><a data-toggle="dropdown" href="#" aria-expanded="false">Как работи? <i class="fa fa-angle-down"></i></a> 
                <ul class="tr-dropdown-menu left tr-list fadeInUp" role="menu">
                      <li><a href="<?php echo site_url(); ?>kak-raboti-za-klientite">За клиентите</a></li>
                      <li><a href="<?php echo site_url(); ?>kak-raboti-za-firmite">За фирмите</a></li>
                </ul>
              </li>
              <!-- <li><a href="job-details.html">Job Details</a></li>
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
              </li> -->
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
              <li><a href="<?php echo site_url(); ?>users/login">Вход</a></li>
              <li><a href="<?php echo site_url(); ?>users/registration">Регистрация</a></li> 
              <li><a href="<?php echo site_url();?>users/logout">Излез</a></li>
            </ul><!-- /.sign-in -->         

            <a href="job-post.html" class="btn btn-primary"><i class="fa fa-bars"></i></a>
          </div><!-- /.nav-right -->
        </div><!-- /.container -->
      </nav><!-- /.navbar -->
    </header><!-- /.tr-header -->


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

