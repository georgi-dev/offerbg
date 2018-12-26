<?php
  $headerParams = array('SiteTitle' => "Добавяне на обява");
  // print_r($Firms);
  print_r($_SESSION);
?>
<?php $this->load->view('header',$headerParams)?>
<main>
	<section>
		<div class="post_job_header bg-secondary">
			<div class="container p-4 ">
				<div class="row">
					<div class="col-md-8 offset-md-4">
						<h1>Публикувай обява</h1>
						<h3>***************************</h3>
					</div>
				</div>


			</div>
		</div>

		<div class="container">
			<div class="row mt-3">
				<div class="col-md-4 mt-3">
					
				</div>
				<div class="col-md-7">
					<form method="post" id="upl_form" class="mt-3 w-100 add_lead" enctype="multipart/form-data">
						<div class="form-group p-1 mb-4">
							<?php if (isset($_SESSION['user_id'])) {
							
								echo '<input type="hidden" class="form-control" id="creator" value="'.$_SESSION['user_id'].'" />';
							}
							else {
								echo '<input type="hidden" class="form-control" id="creator" value="" ';

							}
							?>
						</div>
						
						<div class="form-group p-1">
							<label for="title">Дайте заглавие на вашата обява</label>

							<div class="input-group">
								<input type="text" class="form-control " name="job_title" id="title" placeholder="Добавете заглавие">
								<div class="invalid-feedback d-none">Моля добавете заглавие на обявата!</div>
							</div>

						</div>

						<div class="form-group p-1">
							<label for="description">Описание на обявата</label>

							<div class="job_description">
								<textarea class="form-control" rows="6" name="job_description" id="description" aria-describedby="emailHelp" placeholder="Добавете описание"></textarea>
								<div class="invalid-feedback d-none">Моля добавете описание на обявата!</div>
							</div>
						</div>
						<div class="form-group p-1">
							<label for="description">Тип на обявата:</label>
							<label class="radio-inline">
						      <input type="radio" name="status" class="type" value="public">Публична
						    </label>
						    <label class="radio-inline">
						      <input type="radio" name="status" class="type" value="private">Частна
						    </label>
						</div>
						<div class="form-group p-1">
							<label for="description"></label>

							<div class="btn btn-primary" style="    border: 1px solid #40100e;position:relative;background: #6fa45f;">
				                <span>Добави файлове</span>
				                <input type="file" id="upload_file" name="userfiles[]" onchange="readURL_file(this);" multiple="" style="position: absolute;
				                opacity: 0;
				                font-size: 100px;
				                top: 0;
				                left: 0;
				                width: 100%;
				                height: 100%;
				                cursor: pointer;">
				            </div>
						</div>
						<div class="row fx-element-overlay" id="image_preview">
	              	

			            	<div class="clearfix"></div>
			            </div>
						<div class="form-group p-1">
							<label for="description">Покани Фирма</label>

							<select class="form-control select2 firms" name="invited_firms" multiple="multiple">
								<?php foreach ($Firms['firms'] as $key => $Firm): ?>
									<option value="<?php echo $Firm->firm_id;?>"><?php echo $Firm->firm_name?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group p-1">
							<label for="description">Валидна до:</label>

							<input type="text" class="form-control date_valid" name="date_valid"/>
						</div>
						<div class="mt-4"><label for="client_email">Завършете вашата обява</label></div>
						<div class="form-group">
							
								

								<div class="input-group-append">
									<button type="button" class="btn btn-success" id="btnAddLead">Публикуване</button>

								</div>


						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</main>



<!-- <script type="text/javascript" src="/js/leads.js"></script> -->
<script type="text/javascript">
	jQuery(function() {

			

		jQuery("#btnAddLead").on("click", function() {
			
			console.log($('.add_lead').serialize());
			var title = $('#title').val();
			var description = $('#description').val();
			var type = $('input[type="radio"]:checked').val();
			// var title = $('#title').val();
			if (title === "") {
				jQuery("#title").addClass("is-invalid");
				jQuery("#title").parent().parent().addClass("has-danger");
				jQuery("#title").next().removeClass("d-none");
				jQuery(window.document).scrollTop(jQuery("#title").offset().top);
				
				return;
			}

			if (description === "") {
				jQuery("#description").addClass("is-invalid");
				jQuery("#description").parent().parent().addClass("has-danger");
				jQuery("#description").next().removeClass("d-none");
				jQuery(window.document).scrollTop(jQuery("#description").offset().top);
				
				return;
			}

			// if (client_email === "") {
			// 	jQuery("#client_email").addClass("is-invalid");
			// 	jQuery("#client_email").parent().parent().addClass("has-danger");
			// 	jQuery("#client_email").next().removeClass("d-none");
			// 	jQuery(window.document).scrollTop(jQuery("#client_email").offset().top);
				
			// 	return;
			// }	
			
		
						var data = {
							"creator": jQuery("#creator").val(),
							"title": title,
							"description": description,
							"type": type,
							"firms" : $('.firms').val(),
							"date_valid" : $('.date_valid').val(),
							"files" : $('.files').val()
						};


						console.log(data);
// return false;
						API.post("add_ad", {}, data, function(response) {
							General.showModal("Обявата беше добавена!", function() {
								window.location.href = "/dashboard";
							}, false);
						});
			

		
			
		});
		
		jQuery("#title").on("keyup", function() {
			if(jQuery.trim(jQuery("#title").val()) !== "") {
				jQuery("#title").removeClass("is-invalid");
				jQuery("#title").parent().parent().removeClass("has-danger");
			}
		});

		jQuery("#description").on("keyup", function() {
			if(jQuery.trim(jQuery("#description").val()) !== "") {
				jQuery("#description").removeClass("is-invalid");
				jQuery("#description").parent().parent().removeClass("has-danger");
			}
		});

		jQuery("#client_email").on("keyup", function() {
			if(jQuery.trim(jQuery("#client_email").val()) !== "") {
				jQuery("#client_email").removeClass("is-invalid");
				jQuery("#client_email").parent().parent().removeClass("has-danger");
			}
		});


		$('.firms').select2({
            placeholder: "Въведи Фирма",
            
            language: {
                inputTooShort: function() {
                    return 'Въведете най-малко 3 символа';
                }
            }
           
            //matcher: matchCustom // only start searching when the user has input 3 or more characters
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
			formData.append('parent_id', $("#shipping_agent_id").val());
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

	                	 }else{
	                	 	item = `<div class="col-lg-3 col-md-6 col-xs-6 thumb image-thumb" data-file-id="${data.ids[i]}">
											<div class="box box-default">
												<div class="fx-card-item">
													<div class="fx-card-avatar fx-overlay-1"> <img src="/upldocs/${data.files_names[i]}" class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="" data-image="/upldocs/${data.files_names[i]}" data-target="#image-gallery"alt="user">
														<div class="fx-overlay">
															<ul class="fx-info">
																<li style="display:inline-block;"><a class="btn default btn-outline image-popup-vertical-fit thumbnail" href="../plugins/images/users/1.jpg" data-image-id="" data-toggle="modal" data-title="" data-image="/upldocs/${data.files_names[i]}" data-target="#image-gallery"><i class="ion-search"></i></a></li>
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
<?php $this->load->view('footer');?>