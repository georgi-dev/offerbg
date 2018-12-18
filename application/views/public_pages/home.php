<!-- SPECIFIC CSS -->
<?php $this->load->view('header');?>






<?php $this->load->view('footer');?>

<script type="text/javascript">
	
	$(function(){
		API.post("Users/deleteUser/6", {}, {}, function(response) {
			// General.showModal("Обявата беше добавена!", function() {
			// 	window.location.href = "/dashboard";
			// }, false);
			console.log(response);
		});
	});
</script>