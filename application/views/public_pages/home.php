<!-- SPECIFIC CSS -->
<?php $this->load->view('head');?>



<a href="<?php echo site_url();?>users/login">Вход</a></br>
<a href="<?php echo site_url();?>users/registration">Регистрация</a></br>
<a href="<?php echo site_url();?>users/logout">Излез</a>

<?php $this->load->view('foot');?>

<script type="text/javascript">
	
	// $(function(){
	// 	API.post("Users/deleteUser/6", {}, {}, function(response) {
	// 		// General.showModal("Обявата беше добавена!", function() {
	// 		// 	window.location.href = "/dashboard";
	// 		// }, false);
	// 		console.log(response);
	// 	});
	// });
</script>