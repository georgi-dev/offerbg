<?php
// global $container;

// include_once(dirname(__DIR__) . '/head.php');
// include_once(dirname(__DIR__) . '/header.php');

 $user_info = json_decode(json_encode($user), true);
  // print_r($user);


 // print_r($firm['activities']);
 // die();
?>
<?php
  $headerParams = array('SiteTitle' => "Редакция на потребител");
?>
<?php $this->load->view('head',$headerParams)?>
<!-- Array
(
    [UserID] =&gt; 8
    [first_name] =&gt; Георги
    [last_name] =&gt; Иванов
    [email] =&gt; d1lgiq87@gmail.com
    [phone] =&gt; 0897018017
    [password] =&gt; $2y$10$1YhKUvS/VA1x1VJ3HDw80.zP2DG9Q/rVhUwej60w.wbTae9G/1o4i
    [type] =&gt; admin
    [city_id] =&gt; 1009
    [date_registration] =&gt; 2018-12-20 21:27:15
    [verified] =&gt; no
) -->

  <main>
    <section class="container mt-4">
        <div class="row">
            <div class="col-12 col-sm-4 col-md-3">
                <?php
                $this->load->view("admin/sidebar");
                ?>
            </div>
            <div class="col-12 col-sm-8 col-md-9">
                <h1>Редакция на - <?php echo $user_info["email"];?></h1>
                
                <br /><br />
                <form class="form-horizontal" id="frmFirms">
                    <fieldset>
                                            <input type="hidden" class="form-control" name="id" 
                    value="<?php echo $user_info["UserID"]; ?> "
                    />
                    <div class="form-group">
                        <label for="EIK" class="col-md-2 control-label">Име</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control"  name="fname" 
                            value="<?php echo $user_info["first_name"]; ?> "/>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="EIK" class="col-md-2 control-label">Фамилия</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control"  name="fname" 
                            value="<?php echo $user_info["last_name"]; ?> "/>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Имейл</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control"  name="email" 
                            value="<?php echo $user_info["email"]; ?> "/>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Телефон</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control"  name="phone" 
                            value="<?php echo $user_info["phone"]; ?> "/>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Тип</label>
                        <div class="col-md-5 col-sm-4">
                            <select class="form-control select2">
                                <option value="admin" <?php if ($user_info['type'] == "admin"): ?>
                                    selected
                                <?php endif ?>>admin</option>
                                <option value="user" <?php if ($user_info['type'] == "user"): ?>
                                    selected
                                <?php endif ?>>user</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verified" class="col-md-2 control-label">Град</label>
                        <div class="col-md-5 col-sm-4">
                           <select class="form-control select2 city" name="city" >
                            <option></option>
                            <?php foreach ($Cities as $key => $City): ?>

                              <option value="<?php echo $City->id;?>" <?php if ($City->id == $user_info["city_id"]): ?>
                                  selected
                              <?php endif ?>><?php echo $City->name;?></option>
                           
                            <?php endforeach ?>
                            
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verified" class="col-md-2 control-label">Verified</label>
                        <div class="col-md-5 col-sm-4">
                            <select class="form-control" name="verified">
                                <option value="yes" <?php if ($user_info["verified"] == "yes"): ?> selected <?php endif ?>>yes</option>
                                <option value="no" <?php if ($user_info["verified"] == "no"): ?> selected <?php endif ?>>no</option>                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="created" class="col-md-2 control-label">Дата на регистрация</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control" readonly
                            value="<?php echo $user_info["date_registration"]; ?> "/>

                        </div>
                    </div>

                    </fieldset>
                    
                    <hr />
                    
                    <button type="button" class="btn btn-primary" onclick="Users.update();">Запази</button>
                    &nbsp;&nbsp;&nbsp;<a href="/users" class="btn btn-link">Отказ</a>
                </form>
            </div>
        </div>
    </div>
</section>
</main>
    <script src="/assets/js/firms.js"></script>

<?php $this->load->view('foot');?>
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
        var default_activities = $('#default_activities').val();

        console.log(typeof(JSON.parse(decodeURIComponent(default_activities)) ));
        $('.activities').val(JSON.parse(decodeURIComponent(default_activities))).trigger('change');

});
</script>