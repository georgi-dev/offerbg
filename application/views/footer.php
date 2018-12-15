


	<script src="<?php echo asset_url();?>js/jquery.js"></script>
<?php if (!empty($JavaScripts)): ?>
	<?php foreach ($JavaScripts as $JS): ?>
		<script src="<?php echo $JS; ?>"></script>
	<?php endforeach; ?>
<?php endif ?>



</body>
</html>