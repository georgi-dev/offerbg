<!-- SPECIFIC CSS -->
<?php $this->load->view('head');?>



<a href="<?php echo site_url();?>users/login">Вход</a></br>
<a href="<?php echo site_url();?>users/registration">Регистрация</a></br>
<a href="<?php echo site_url();?>users/logout">Излез</a>

<?php $this->load->view('foot');?>

<script type="text/javascript">
	
	$(function(){
		API.post("Dashboard/getcount", {}, {}, function(response) {
			// General.showModal("Обявата беше добавена!", function() {
			// 	window.location.href = "/dashboard";
			// }, false);
			console.log(response);
			$('.users_cnt').text(response.count.users_cnt);
			$('.firms_cnt').text(response.count.firms_cnt);
			$('.ads_cnt').text(response.count.ads_cnt);
		});

		API.post("Firms/get_all", {}, {page:1,filter:''}, function(response) {
			// General.showModal("Обявата беше добавена!", function() {
			// 	window.location.href = "/dashboard";
			// }, false);
			console.log(response);
			
		});

		API.post("Ads/get_all", {}, {page:1,filter:''}, function(response) {
			// General.showModal("Обявата беше добавена!", function() {
			// 	window.location.href = "/dashboard";
			// }, false);
			console.log(response);
			
		});
	});
</script>