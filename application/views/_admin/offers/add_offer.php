<?php
  $headerParams = array('SiteTitle' => "Добавяне на фирма");
?>
<?php $this->load->view('elements/head',$headerParams)?>
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
                $this->load->view("_admin/sidebar");
                ?>
            </div>
            <div class="col-12 col-sm-8 col-md-9">
                <h1>Добави оферта</h1>
                
                <br /><br />
                <form class="form-horizontal" id="upl_form">
                    <fieldset>
                      <div class="form-group p-1">
                        <label for="description">Избери Фирма</label>

                        <select class="form-control select2 firms" name="creator">
                          <?php foreach ($Firms['firms'] as $key => $Firm): ?>
                            <option value="<?php echo $Firm->firm_id;?>"><?php echo $Firm->firm_name?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    <div class="form-group p-1">
                        <label for="description">Избери Обява</label>

                        <select class="form-control select2 firms" name="creator">
                          <?php foreach ($Ads['ads'] as $key => $Ad): ?>
                            <option value="<?php echo $Ad->ad_id;?>"><?php echo $Ad->title?></option>
                          <?php endforeach ?>
                        </select>
                      </div>

                       <div class="form-group">
                          <label for="description" class="col-md-2 control-label">Description</label>
                          <div class="col-md-5 col-sm-4">
                              <textarea class="form-control" name="description" ></textarea> 


                          </div>
                      </div>
                    <div class="form-group">
                          <label for="price" class="col-md-2 control-label">Price</label>
                          <div class="col-md-5 col-sm-4">
                              <input type="text" class="form-control" name="price" />
                             

                          </div>
                      </div>
                   
                    <div class="form-group p-1">
                      <label for="description"></label>

                      <div class="btn btn-primary" style="    border: 1px solid #40100e;position:relative;background: #6fa45f;">
                                <span>Добави файлове</span>
                                <input type="file" id="upload_file" name="userfile[]" onchange="readURL_file(this);" multiple="" style="position: absolute;
                                opacity: 0;
                                font-size: 100px;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                cursor: pointer;">
                            </div>
                    </div>
                    <div class="row " id="image_preview">
                          

                            <div class="clearfix"></div>
                          </div>
                    <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="image-gallery-title"></h4>
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                    </button>

                                    <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    </fieldset>
                    
                    <hr />
                    
                    <button type="button" class="btn btn-primary" onclick="Offers.add();">Запази</button>
                    &nbsp;&nbsp;&nbsp;<a href="/offers" class="btn btn-link">Отказ</a>
                </form>
            </div>
        </div>
    </div>
</section>
</main>
    <?php $this->load->view('elements/foot');?>
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

      function readURL_file(input) {
    console.log(input.files[0].type);
    // return false;
        if (input.files && input.files[0]) {
            var product_id = 1;
            var myForm = document.getElementById('upl_form');
      var formData = new FormData(myForm);

      formData.append('parent_type', "<?php echo $this->uri->segment(1)?>");
      formData.append('parent_id', '5');

      //console.log(<?php echo $this->uri->segment(1)?>);

      //return false;
      $.ajax({
                type: "POST",
                url: "/Upload_files/do_upload/",
                data: formData,
                processData: false,
        contentType: false,
        enctype: 'multipart/form-data'
                
              }).
                done(function(response){
                  console.log(response);

                  // return false;
                    data = JSON.parse(response);
                    let item= '';
          if (data.msg == "Success") {
                     for (let i = 0; i < data.files_names.length; i++) {
                          
                          let li1= '';
                     if (data.ext_files[i] == "application/pdf" ) {

                      item = `<div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <iframe src="/upldocs/${data.files_names[i]}" 
                  style="width:600px; height:500px;" frameborder="0"></iframe>
                </div>`;

                     }
                     else if(data.ext_files[i] == "text\/plain" || data.ext_files[i] == "application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
              item = `<div class="col-lg-3 col-md-4 col-xs-6 thumb" data-file-id="${data.ids[i]}">
              
                <div class="card" style="width: 18rem;">
                  
                  <div class="card-body">
                    <h5 class="card-title">${data.files_names[i]}</h5>
                    
                    <a href='/upldocs/${data.files_names[i]}' target='_blank' download >Download</a>
                  </div>
                </div>
                </div>`;
                     }else{
                      item = `<div class="col-lg-3 col-md-6 col-xs-6 thumb image-thumb" data-file-id="${data.ids[i]}">
                      <div class="box box-default">
                        <div class="fx-card-item">
                          <div class="fx-card-avatar fx-overlay-1"> <img src="/upldocs/${data.files_names[i]}" class="img-thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="" data-image="/upldocs/${data.files_names[i]}" data-target="#image-gallery"alt="user">
                            <div class="fx-overlay">
                              <ul class="fx-info">
                                <li style="display:inline-block;"><a class="btn default btn-outline image-popup-vertical-fit thumbnail" data-image-id="" data-toggle="modal" data-title="" data-image="/upldocs/${data.files_names[i]}" data-target="#image-gallery"><i class="fa fa-search"></i></a></li>
                              <li style="display:inline-block;"><a class="btn default btn-outline" href="javascript:void(0);" onclick="deleteGaleryImage(this, ${data.ids[i]})"><i class="fa fa-trash"></i></a></li>
                              </ul>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>`;
                          
                      
                     }
                           $('#image_preview').append(item);

                  }
                    
                }
                    // },1500);
                }).fail(function(err){
                  console.log(err);
                });
      // console.log(formData);
      // return false;
            
            
            // var dialog = bootbox.dialog({
            //                         message: '<p class="text-center" style="background:#000;color:#fff;padding:10px;">The Image has been uploaded.</p>',
            //                         closeButton: false
            //                     });
        }


    }
</script>
<script src="/assets/js/offers.js"></script>


<?php $this->load->view('image_galery');?>

