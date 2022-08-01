	</form>
	<footer class="pt-4 border-top bg-white">
		<div class="row">
			
		</div>
	</footer>
    <script>
		var  baseurl = "<?php echo base_url(); ?>";
	</script>

	<style>
		.form-group{
			margin-bottom: 1rem !important;
		}
	</style>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/style1.css">
    <script src="<?php echo base_url(); ?>assets/js/custom-edit.js"></script>
	<script>
		$(function(){
			if(!$("html").hasClass("sidebar-left-collapsed"))
			{
				$("html").addClass("sidebar-left-collapsed");
				$("html").removeClass("sidebar-left-opened");
			}
		});
	</script>