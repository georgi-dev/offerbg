<?php
// global $container;

// include_once(dirname(__DIR__) . '/head.php');
// include_once(dirname(__DIR__) . '/header.php');

 //print_r($firm);
 $firm = json_decode(json_encode($firm), true);
  // print_r($firm);


 // print_r($firm['activities']);
 // die();
?>
<?php
  $headerParams = array('SiteTitle' => "Редакция на фирма");
?>
<?php $this->load->view('header',$headerParams)?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-sm-4 col-md-3">
<?php
   // include_once(__DIR__ . '/sidebar.php');
?>
            </div>
            <div class="col-12 col-sm-8 col-md-9">
                <h1>Редакция на - <?php echo $firm["firm_name"];?></h1>
                
                <br /><br />
                <form class="form-horizontal" id="frmFirms">
                    <fieldset>
                                            <input type="hidden" class="form-control" name="id" 
                    value="<?php echo $firm["firm_id"]; ?> "
                    />
                    <div class="form-group">
                        <label for="EIK" class="col-md-2 control-label">EIK</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control"  name="EIK" 
                            value="<?php echo $firm["firm_EIK"]; ?> "/>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Name</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control"  name="name" 
                            value="<?php echo $firm["firm_name"]; ?> "/>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verified" class="col-md-2 control-label">Град</label>
                        <div class="col-md-5 col-sm-4">
                           <select class="form-control select2 city" name="city" >
                            <option></option>
                            <?php foreach ($Cities as $key => $City): ?>

                              <option value="<?php echo $City->id;?>" <?php if ($City->id == $firm["firm_city_id"]): ?>
                                  selected
                              <?php endif ?>><?php echo $City->name;?></option>
                           
                            <?php endforeach ?>
                            
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verified" class="col-md-2 control-label">Адрес</label>
                        <div class="col-md-5 col-sm-4">
                           <textarea class="form-control" name="address"><?php echo $firm['firm_address']?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verified" class="col-md-2 control-label">Икономически дейности</label>
                        <div class="col-md-5 col-sm-4">
                                <input type="hidden" name="default_activities" value="<?php echo urlencode($firm['activities'])?>"/>
                           <select class="form-control select2 activities" multiple="multiple">
                            <?php foreach ($Activities as $key => $Activity): ?>

                              <option value="<?php echo $Activity->id;?>" data-activity-code="<?php echo $Activity->code;?>"><?php echo $Activity->name;?></option>
                           
                            <?php endforeach ?>
                            
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verified" class="col-md-2 control-label">Сертификати</label>
                        <div class="col-md-5 col-sm-4">
                           <textarea class="form-control"><?php echo json_decode($firm['certificates'])?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control" name="description" 
                            value="<?php echo $firm["firm_desc"]; ?> "/>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verified" class="col-md-2 control-label">Verified</label>
                        <div class="col-md-5 col-sm-4">
                            <select class="form-control" name="verified">
                                <option value="yes" <?php if ($firm["verified"] == "yes"): ?> selected <?php endif ?>>yes</option>
                                <option value="no" <?php if ($firm["verified"] == "no"): ?> selected <?php endif ?>>no</option>                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vat" class="col-md-2 control-label">Vat</label>
                        <div class="col-md-5 col-sm-4">
                           
                            <select class="form-control" name="vat">
                                <option value="yes" <?php if ($firm["vat"] == "yes"): ?> selected <?php endif ?>>yes</option>
                                <option value="no" <?php if ($firm["vat"] == "no"): ?> selected <?php endif ?>>no</option>                           
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="created" class="col-md-2 control-label">Created</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control" readonly name="created" 
                            value="<?php echo $firm["firm_created"]; ?> "/>

                        </div>
                    </div>

                    </fieldset>
                    
                    <hr />
                    
                    <button type="button" class="btn btn-primary" onclick="Firms.update();">Запази</button>
                    &nbsp;&nbsp;&nbsp;<a href="/firms" class="btn btn-link">Отказ</a>
                </form>
            </div>
        </div>
    </div>
    <script src="/assets/js/firms.js"></script>

<?php $this->load->view('footer');?>
<?php
// include_once(dirname(__DIR__) . '/foot.php');
?>

<script type="text/javascript">
  
  $(document).ready(function() {

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

        $('.city').select2({
            placeholder: "Въведи Град",
            minimumInputLength: 3,
            language: {
                inputTooShort: function() {
                    return 'Въведете най-малко 3 символа';
                }
            }
           
            //matcher: matchCustom // only start searching when the user has input 3 or more characters
        });

        $('.activities').select2({
            placeholder: "Въведи част от код или име на дейността",
            minimumInputLength: 3,
            matcher: matchCustom,
             language: {
                inputTooShort: function() {
                    return 'Въведете най-малко 4 символа';
                }
            } // only start searching when the user has input 3 or more characters
        });
        var default_activities = $('input[name="default_activities"]').val();

        console.log(typeof(JSON.parse(decodeURIComponent(default_activities)) ));
        $('.activities').val(JSON.parse(decodeURIComponent(default_activities))).trigger('change');

});
</script>