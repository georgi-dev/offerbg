<?php
  $headerParams = array('SiteTitle' => "Добавяне на обява");
  // print_r($Firms);
  print_r($_SESSION);
?>
<?php $this->load->view('elements/head',$headerParams)?>

<main>
	<section class="container">
		<div class="row">
			<div class="col-12 col-sm-4 col-md-3">
			<?php
				$this->load->view("admin/sidebar");
			?>
			</div>
			<div class="col-12 col-sm-8 col-md-9">
				<h1>Здравей, <?php echo $Admin_Name;?></h1>
			</div>
		</div>
	</section>
</main>

<?php $this->load->view('elements/foot');?>