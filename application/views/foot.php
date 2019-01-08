	<!-- JS theme files -->
    <script src="<?php echo asset_url();?>js/jquery.min.js"></script>
    <script src="<?php echo asset_url();?>js/popper.min.js"></script>
    <script src="<?php echo asset_url();?>js/inview.min.js"></script>
    <script src="<?php echo asset_url();?>js/counterup.min.js"></script>
    <script src="<?php echo asset_url();?>js/waypoints.min.js"></script>
    <script src="<?php echo asset_url();?>js/slick.min.js"></script>
    <script src="<?php echo asset_url();?>js/jquery-te.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="<?php echo asset_url();?>js/gmaps.min.js"></script>
    <script src="<?php echo asset_url();?>js/main.js"></script>


	<script src="<?php echo asset_url();?>js/general.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!--<script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-73239902-1', 'auto');
      ga('send', 'pageview');
    </script>-->


	<script type="text/javascript" src="<?php echo asset_url();?>js/api/api.js" defer></script>
	<script type="text/javascript" src="<?php echo asset_url();?>js/scripts/sweetalert2.all.min.js"></script>
<?php if (!empty($JavaScripts)): ?>
	<?php foreach ($JavaScripts as $JS): ?>
		<script src="<?php echo $JS; ?>"></script>
	<?php endforeach; ?>
<?php endif; ?>



</body>
</html>