	<div id="footer">
		<hr>
		<div class="inner">
			<div class="container">
				<p class="right"><a href="#">Back to top</a></p>
				<p>
				</p>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/admin.min.js"></script>
<!-- 	<script async defer src="https://maps.googleapis.com/maps/api/js&sensor=false&amp;libraries=places" -->
<!--   type="text/javascript"></script> -->
	
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCMRas93f_-DGB4kUoYZIvOszZq3SgqKJ4&sensor=false&amp;libraries=places"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/logger.js"></script>
	<script>
      $(function(){
        
        $("#geocomplete").geocomplete()
          .bind("geocode:result", function(event, result){
            $.log("Result: " + result.formatted_address);
          })
          .bind("geocode:error", function(event, status){
            $.log("ERROR: " + status);
          })
          .bind("geocode:multiple", function(event, results){
            $.log("Multiple: " + results.length + " results found");
          });
        
        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });
        
        
        $("#examples a").click(function(){
          $("#geocomplete").val($(this).text()).trigger("geocode");
          return false;
        });
        
      });
    </script>
</body>
</html>