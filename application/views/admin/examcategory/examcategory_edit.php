<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["categorymanagement"]?></h2>
	
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url(); ?>home">
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li><span><?=$term["exam"]?></span></li>

				<li><span><?=$term["category"]?></span></li>
			</ol>

		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">	
						<a class="btn btn-default" href="<?php echo base_url(); ?>admin/examcategory"><i class="fas fa-table"></i><?=$term["categorylist"]?></a>
					</div>

					<h2 class="card-title"><?=$term["examcategory"]?> </h2>
				</header>
				
				<div class="row">
		            <div class="col-md-12">
		                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
		            </div>
			    </div>
				
				<?php echo form_open('admin/examcategory/add', array("id"=>"frm_category")); ?>
					
					<input type="hidden" name="row_id" id="row_id" value="<?php echo isset($category)&&isset($category['id'])?$category['id']:0; ?>">
				<div class="card-body">
					<div class="form-group row">
						<label class="col-sm-3 control-label text-sm-right pt-2"><?=$term["categoryname"]?> <span class="required">*</span></label>
						<div class="col-sm-6">
							<input type="text" name="exam_category_name" class="form-control" placeholder="eg.: Class A" required="" value="<?php echo isset($category)&&isset($category['exam_category_name'])?$category['exam_category_name']:''; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-sm-right pt-2"><?=$term[categorycode]?> <span class="required">*</span></label>
						<div class="col-sm-6">
							<input type="text" name="exam_category_code" class="form-control" placeholder="eg.: A" required="" value="<?php echo isset($category)&&isset($category['exam_category_name'])?$category['exam_category_name']:''; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label text-sm-right pt-2"><?=$term["description"]?> </label>
						<div class="col-sm-6">
							<textarea name="description" rows="5" class="form-control" placeholder="Describe your skills"><?php echo isset($category)&&isset($category['description'])?$category['description']:""; ?></textarea>
						</div>
					</div>	
				</div>
				<footer class="card-footer">
					<div class="row justify-content-end">
						<div class="col-sm-6">
							<button type="submit" id="btn_save" class="btn btn-primary"><?=$term["save"]?></button>
							<button type="reset" class="btn btn-default"><?=$term["reset"]?></button>
						</div>
					</div>
				</footer>
				</form>				
			</section>
			
		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>
	jQuery(document).ready(function() { 	

		$("#frm_category").validate({
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

		
	});
</script>
