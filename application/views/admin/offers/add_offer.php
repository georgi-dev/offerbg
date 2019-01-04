<?php
  $headerParams = array('SiteTitle' => "Добавяне на фирма");
?>
<?php $this->load->view('head',$headerParams)?>
<style type="text/css">
    .ul-certificates{list-style: none;padding: 0;}
    .ul-certificates li {display:inline-block;padding: 10px;color:#fff;margin: 10px 15px 10px 0;}
    .ul-certificates li:last-child {display:inline-block;padding: 10px;color:#fff;margin: 10px 25px 10px -10px;}
</style>
<main>
    <section class="container mt-4">
        <div class="row">
            <div class="col-12 col-sm-4 col-md-3">
                <?php
                $this->load->view("admin/sidebar");
                ?>
            </div>
            <div class="col-12 col-sm-8 col-md-9">
                <h1>Добави фирма</h1>
                
                <br /><br />
                <form class="form-horizontal" id="frmFirms">
                    <fieldset>
                                            <div class="form-group">
                        <label for="EIK" class="col-md-2 control-label">EIK</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control" name="EIK" />

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Name</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control" name="name" />

                        </div>
                    </div>
                    <div style="border:2px solid red;" class="cloned-div">
                        <button class="add-new-address-block btn-success rounded-circle">+</button>
                        <div class="form-group">
                            <label for="verified" class="col-md-2 control-label">Град</label>
                            <div class="col-md-5 col-sm-4">
                               <select class="form-control select2 city" name="city" >
                                <option></option>
                                <?php foreach ($Cities as $key => $City): ?>
                                    <?php if ($City->type == 'region'): ?>
                                        <optgroup label="<?php echo $City->name?>">
                                            <?php elseif($City->type == 'city'): ?>
                                                <option value="<?php echo $City->id;?>"><?php echo $City->name;?></option>
                                            <?php else: ?>
                                            
                                        </optgroup>
                                    <?php endif ?>
                               
                                <?php endforeach ?>
                                
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="verified" class="col-md-2 control-label">Адрес</label>
                            <div class="col-md-5 col-sm-4">
                               <textarea class="form-control" name="address"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verified" class="col-md-2 control-label">Икономически дейности</label>
                        <div class="col-md-5 col-sm-4">
                           <select class="form-control select2 activities" multiple="multiple">
                            <?php foreach ($Activities as $key => $Activity): ?>

                              <option value="<?php echo $Activity->id;?>" data-activity-code="<?php echo $Activity->code;?>"><?php echo $Activity->code . " " . $Activity->name;?></option>
                           
                            <?php endforeach ?>
                            
                          </select>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="verified" class="col-md-2 control-label">Сертификати</label>
                        <ul style="position: relative; padding: 15px;" class="ul-certificates">
                            <li style="display:block;">
                              <input type="text" class="certificates_options form-control" placeholder="Separate options with a coma"/>
                            </li>
                        </ul>
                        <!-- <div class="col-md-5 col-sm-4">
                           <textarea class="form-control" name="certificates"></textarea>
                        </div> -->
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control" name="description" />

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verified" class="col-md-2 control-label">Verified</label>
                        <div class="col-md-5 col-sm-4">
                            <select class="form-control" name="verified">
                                <option value="yes">yes</option>
                                <option value="no">no</option>                           
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vat" class="col-md-2 control-label">Vat</label>
                        <div class="col-md-5 col-sm-4">
                            <select class="form-control" name="vat">
                                <option value="yes">yes</option>
                                <option value="no">no</option>                            
                            </select>
                        </div>
                       
                    </div>
                    

                    </fieldset>
                    
                    <hr />
                    
                    <button type="button" class="btn btn-primary" onclick="Firms.add();">Запази</button>
                    &nbsp;&nbsp;&nbsp;<a href="/firms" class="btn btn-link">Отказ</a>
                </form>
            </div>
        </div>
    </div>
</section>
</main>
    <?php $this->load->view('foot');?>
<script type="text/javascript">
  
  $(document).ready(function() {


    
  $(".add-new-address-block").on('click', function(e){
    e.preventDefault();
    $(this).closest('.cloned-div').find('.city').select2('destroy');
    var ele = $(this).closest('.cloned-div').clone(true);
    $(this).closest('.cloned-div').after(ele);
    ele.find('.city').select2();
  })

    $(document).on("keyup" ,'.certificates_options', function (e) {
        var el = $(this);
        console.log(e.keyCode);
        if (e.keyCode == 188) {
          
              console.log(el);
          //$('#add_variants_table').show();
              var input_value = el.val().slice(0, -1);
              var div_id = 2;

               let li_background = '';
               if (div_id == 1) {
                li_background = '#763eaf';
               };
               if (div_id == 2) {
                li_background = '#ff9517';
               };
               console.log(div_id);
                // el.parent().parent().prepend('<li><input type="hidden" name="option_values['+div_id+'][]" value="'+input_value+'"/>'+input_value+'</li>');
                 if (el.parent().parent().children().length == 1 && input_value !=='') {
                el.parent().parent().prepend('<li style="background:'+li_background+'"><input type="hidden" name="certificates_values" class="variants_values" value="'+input_value+'"/>'+input_value+'<span class="delete_option" style="padding-left:10px;cursor:pointer;">x</span></li>');

                 }
                 else if(input_value !==''){

                  console.log('test');
                  el.parent().parent().children().last().prev().after('<li style="background:'+li_background+'"><input type="hidden" name="certificates_values" class="variants_values" value="'+input_value+'"/>'+input_value+'<span class="delete_option" style="padding-left:10px;cursor:pointer;">x</span></li>');
                 
                 }
                el.val('');
        }
      });



        $(document).on("blur" ,'.certificates_options', function (e) {
        var el = $(this);
        
        
          
              console.log(el);
          //$('#add_variants_table').show();
              var input_value = el.val().slice(0, -1);
              var div_id = 2;

               let li_background = '';
               if (div_id == 1) {
                li_background = '#763eaf';
               };
               if (div_id == 2) {
                li_background = '#ff9517';
               };
               console.log(div_id);
                // el.parent().parent().prepend('<li><input type="hidden" name="option_values['+div_id+'][]" value="'+input_value+'"/>'+input_value+'</li>');
                 if (el.parent().parent().children().length == 1 && input_value !=='') {
                el.parent().parent().prepend('<li style="background:'+li_background+'"><input type="hidden" name="certificates_values" class="variants_values" value="'+input_value+'"/>'+input_value+'<span class="delete_option" style="padding-left:10px;cursor:pointer;">x</span></li>');

                 }
                 else if(input_value !==''){

                  console.log('test');
                  el.parent().parent().children().last().prev().after('<li style="background:'+li_background+'"><input type="hidden" name="certificates_values" class="variants_values" value="'+input_value+'"/>'+input_value+'<span class="delete_option" style="padding-left:10px;cursor:pointer;">x</span></li>');
                 
                 }
                el.val('');
        
      });

    $(document).on('click','.delete_option',function(e){
        e.preventDefault();
        $(this).parent().remove();
        //prepare_variants();
    });

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

        if ($(data.element).data('activity-code').toString().indexOf(params.term) > -1) {
            return data;
        }
        // Return `null` if the term should not be displayed
        return null;
    }
        $('.city').select2();
        // $('.city').select2({
        //     placeholder: "Въведи Град",
        //     minimumInputLength: 3,
        //     language: {
        //         inputTooShort: function() {
        //             return 'Въведете най-малко 3 символа';
        //         }
        //     }
        //     //matcher: matchCustom // only start searching when the user has input 3 or more characters
        // });

        $('.activities').select2({
            placeholder: "Въведи част от код или име на дейността",
            minimumInputLength: 1,
            matcher: matchCustom,
             language: {
                inputTooShort: function() {
                    return 'Въведете най-малко 4 символа';
                }
            } // only start searching when the user has input 3 or more characters
        });
       
});
</script>
    <script src="/assets/js/firms.js"></script>



