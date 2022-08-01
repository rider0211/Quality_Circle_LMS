<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["sccquestionslist"]?></h2>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<span class="pull-right">	
						<a class="btn btn-default">
							<i class="fas fa-plus"></i> <?=$term["importquestions"]?>
						</a>
					</span>

					<h2 class="card-title"><?=$term["sccquestionslist"]?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-striped table-hover mb-0" id="datatable_questionslist" >
					</table>
					<?php echo form_open('admin/sccquestions/preview', array("id"=>"frm_quizlist")); ?>
						<input type="hidden" name="sgu_id" id="row_id">
					</form>
				</div>				
			</section>
		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>
	var $table = $('#datatable_questionslist');

	function previewQuestions(sgu_id){
		$('#row_id').val(sgu_id);
		$('#frm_quizlist').submit();
	}

	jQuery(document).ready(function() { 
		
		$table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
                "type": "POST",
                "async": true,
				"url": "<?= site_url("admin/sccquestions/getlist") ?>",
				"data": '',		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            "columnDefs": [ {
				"targets": [5],
				"createdCell": function (td, cellData, rowData, row, col) {
					$(td).html('<a href="javascript:previewQuestions('+cellData+')" class=""><i class="far fa-"></i>preview</a>');
					//$(td).addClass('actions-hover actions-fade');								
				}
			} ],     
            "columns": [
            	{ "title": "<?=$term["sgu"]?>", "data": "sgu_id", "class": "text-center", "width":"50" },
            	{ "title": "<?=$term["categoryname"]?>", "data": "category", "class": "text-left", "width":"100" },
				{ "title": "<?=$term["question"]?>", "data": "question", "class": "text-left", "width":"*" },
				{ "title": "<?=$term["availableanswers"]?>", "data": "answers", "class": "text-left", "width":"150"},
				{ "title": "<?=$term["correctanswer"]?>", "data": "right_answer", "class": "text-left", "width":"50"},
				//{ "title": "Reg Date", "data": "created_at", "class": "text-left", "width":150 },				
				{ "title": "<?=$term["action"]?>", "data": "sgu_id", "class": "text-center", "width":"60" },
			],
			"lengthMenu": [
                [5, 10, 20, 50, 150, -1],
                [5, 10, 20, 50, 150, "All"] // change per page values here
            ],
            "scrollY": false,
			"scrollX": true,
			"scrollCollapse": false,
			"jQueryUI": true,							
			
			"paging": true,
			"pagingType": "full_numbers",			
            "pageLength": 150, // default record count per page

			dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			bProcessing: true,			
		});
	});
</script>
