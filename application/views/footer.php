


	<script src="<?php echo asset_url();?>js/jquery.js"></script>
<?php if (!empty($JavaScripts)): ?>
	<?php foreach ($JavaScripts as $JS): ?>
		<script src="<?php echo $JS; ?>"></script>
	<?php endforeach; ?>
<?php endif ?>

<script type="text/javascript" src="<?php echo asset_url();?>js/api/api.js"></script>

</body>
</html>