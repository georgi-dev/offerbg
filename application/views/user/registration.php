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

              <select class="form-control select2 city" name="city[]" multiple="multiple">
                <?php foreach ($Cities as $key => $City): ?>

                  <option value="<?php echo $City->id;?>" data-test="<?php echo $City->id;?>"><?php echo $City->name;?></option>
               
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

<script type="text/javascript">
  
  $(document).ready(function() {

    //custom matcher for option text and data-attr 

    // function customMatcher(params, data) {
    //     // Always return the object if there is nothing to compare
    //     if ($.trim(params.term) === '') {
    //         return data;
    //     }

    //     ... OTHER MATCHING CODE


    //     // Check if the text contains the term
    //     if (original.indexOf(term) > -1) {
    //         return data;
    //     }

    //     // Check if the data occurs
    //     if ($(data.element).data('test').toString().indexOf(params.term) > -1) {
    //         return data;
    //     }

    //     // If it doesn't contain the term, don't return anything
    //     return null;
    // }


    function matchCustom(params, data) {
        // If there are no search terms, return all of the data
        if ($.trim(params.term) === '') {
          return data;
        }

        // Do not display the item if there is no 'text' property
        if (typeof data.text === 'undefined') {
          return null;
        }

        // `params.term` should be the term that is used for searching
        // `data.text` is the text that is displayed for the data object
        if (data.text.indexOf(params.term) > -1) {
          var modifiedData = $.extend({}, data, true);
          modifiedData.text += ' (matched)';

          // You can return modified objects from here
          // This includes matching the `children` how you want in nested data sets
          return modifiedData;
        }

        if ($(data.element).data('test').toString().indexOf(params.term) > -1) {
            return data;
        }
        // Return `null` if the term should not be displayed
        return null;
    }



        $('.city').select2({
       minimumInputLength: 3,
        matcher: matchCustom // only start searching when the user has input 3 or more characters
      });
});
</script>