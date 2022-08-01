<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["categorymanagement"]?></h2>
	
	</header>

	<!-- start: page -->
	<div class="row">		
		<div class="col-lg-12">
			<form id="category_add_form" action="<?php echo base_url();?>instructor/category/add" enctype="multipart/form-data" method="POST" novalidate="novalidate">
				<article class="card">
					<header class="card-header">
						<div class="card-actions">	
							<!--  -->
							<a class="btn btn-default" href="<?php echo base_url();?>instructor/category" id="btn_list"><i class="fa fa-table"></i> <?=$term["categorylist"]?> </a>
						</div>
		
						<h2 class="card-title"><?=$term["category"]?></h2>
					</header>
					<div class="card-body">
					
						<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
						<div class="form-group row">
							<label class="col-sm-3 control-label text-sm-right pt-2"><?=$term["categoryname"]?> <span class="required">*</span></label>
							<div class="col-lg-4 col-sm-8">
								<input type="text" id="name" name="name" class="form-control" placeholder="eg.: Algebra" required="" maxlength="50" value="<?php echo isset($category['name'])?$category['name']:''; ?>">
							</div>
						</div>	

					</div>
					<footer class="card-footer">
						<div class="row">
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-primary" id="btn_save"><?=$term["save"]?></button>
								<button type="reset" class="btn btn-default"><?=$term["reset"]?></button>
							</div>
						</div>
					</footer>
				</article>
			</form>
		</div>						
	</div>
	
	<!-- end: page -->
</section>

<script>
	var frm = $('#category_add_form');
	frm.validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
			
		},
		errorPlacement: function( error, element ) {
			var placement = element.closest('.input-group');
			if (!placement.get(0)) {
				placement = element;
			}
			if (error.text() !== '') {
				placement.after(error);
			}
		}
	});


	jQuery(document).ready(function() { 
		
		$('#btn_save').on('click', function(e){

			event.preventDefault();

			if(frm.valid()) {

				console.log('submit');
				frm.submit();
			} else {
				console.log('invalide');
			}
		});
	});
</script>
