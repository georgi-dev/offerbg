  <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>

<html lang="en">
<?php
  $headerParams = array('SiteTitle' => "Регистрация");
?>
<?php $this->load->view('header',$headerParams)?>

  <?php

    $Username = $this->session->flashdata('fusername');

    $FirstName = $this->session->flashdata('firstname');

    $LastName = $this->session->flashdata('lastname');
    $City = $this->session->flashdata('city');
    $Phone = $this->session->flashdata('phone');


   //print_r($Name);
    //$Rating = $this->session->flashdata('frating');
    //$Comment = $this->session->flashdata('fcomment');
  ?>
  <div class="container ">
    <div class="row col-md-8 offset-md-2">
      <h2>Регистрация</h2>
      <form class="form-horizontal form-element col-12" action="<?php echo site_url('/users/registration/do'); ?>" method="post">
        <div class="form-group row">

            <label for="inputEmail" class="col-sm-2 control-label">Email</label>



            <div class="col-sm-10">

              <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="<?php echo htmlspecialchars($Username); ?>">

            </div>

          </div>

          <div class="form-group row">

            <label for="inputPassword" class="col-sm-2 control-label">Password</label>



            <div class="col-sm-10">

              <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">

            </div>

          </div>

          <div class="form-group row">

            <label for="inputRepeatPassword" class="col-sm-2 control-label">Repeat Password</label>



            <div class="col-sm-10">

              <input type="password" class="form-control" id="inputRepeatPassword" placeholder="Repeat Password" name="password2">

            </div>

          </div>

          <div class="form-group row">

            <label for="inputFirstName" class="col-sm-2 control-label">First Name</label>



            <div class="col-sm-10">

              <input type="text" class="form-control" id="inputFirstName" placeholder="First Name" name="firstname" value="<?php echo htmlspecialchars($FirstName); ?>">

            </div>

          </div>

          <div class="form-group row">

            <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>



            <div class="col-sm-10">

              <input type="text" class="form-control" id="inputLastName" placeholder="Last Name" name="lastname" value="<?php echo htmlspecialchars($LastName); ?>">

            </div>
           
            
          </div>

          <div class="form-group row">

            <label for="inputLastName" class="col-sm-2 control-label">City</label>



            <div class="col-sm-10">

              <select class="form-control" name="city">
                <?php foreach ($Cities as $key => $City): ?>

                  <option value="<?php echo $City->id;?>"><?php echo $City->name;?></option>
               
                <?php endforeach ?>
                
              </select>

            </div>
           
            
          </div>

          <div class="form-group row">

            <label for="inputPhone" class="col-sm-2 control-label">Phone</label>



            <div class="col-sm-10">

              <input type="text" class="form-control" id="inputPhone" placeholder="Phone" name="phone" value="<?php echo htmlspecialchars($Phone); ?>">

            </div>
           
            
          </div>

           <div class="form-group row">
              <div class="col-sm-10">

                <button type="submit" class="btn btn-success">Registration</button>

              </div>
            </div>
      </form>
  </div>
</div>