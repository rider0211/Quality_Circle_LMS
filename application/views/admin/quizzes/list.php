<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["quizzesmanagement"]?></h2>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<span class="pull-right">	
						<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
							<i class="fas fa-plus"></i> <?=$term["newquiz"]?>
						</a>
						<div class="dropdown-menu" role="menu">
							<?php foreach($this->Quiz_model->TYPES as $t) { ?>
								<a class="dropdown-item text-1" href="<?= site_url("admin/quizzes/create") ?>/<?= $t ?>"><?= $t ?></a>
							<?php } ?>
						</div>
					</span>

					<h2 class="card-title"><?=$term["quizzeslist"]?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-striped table-hover mb-0" id="datatable_quizlist" >
					</table>
				</div>
				<?php echo form_open('admin/quizzes/create', array("id"=>"frm_quizlist")); ?>
					<input type="hidden" name="row_id" id="row_id">
				</form>
			</section>
		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>
	var $table = $('#datatable_quizlist');

	function deleteQuiz(id) {
		(new PNotify({
            title: "<?php echo $term['confirmation']; ?>",
            text: "<?php echo $term['areyousuretodelete']; ?>",
			type: 'custom',
			icon: 'fas fa-question',
			confirm: {
				confirm: true
			},
			button: {
				closer: false,
				sticker: false
			},
			addclass: 'stack-modal',
			stack: {
				'dir1': 'up',
				'dir2': 'right',
				'modal':true
			}
		})).get().on('pnotify.confirm', function(){
			$.ajax({
                url: '<?= site_url("admin/quizzes/delete") ?>',
                type: 'POST',
                data: {'id': id},
                success: function (data, status, xhr) {	
                	$table.DataTable().ajax.reload('', false);	
				},
				error: function(){
					new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
						type: 'error'
					});		
				}
			});	
		});
		/*.on('pnotify.cancel', function(){
			//console.log("cancel");
		});
		*/
	}

	function changeQuiz(id) {
		window.location = "<?= site_url("admin/quizzes/edit") ?>/"+id;
	}

	function inactiveQuiz(id) {
		$.ajax({
            url: 'quizzes/inactive',
            type: 'POST',
            data: {'id': id},
            success: function (data, status, xhr) {	
            	$table.DataTable().ajax.reload('', false);	
			},
			error: function(){
				new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
					type: 'error'
				});		
			}
		});	
	}

	function activeQuiz(id) {
		$.ajax({
            url: 'quizzes/active',
            type: 'POST',
            data: {'id': id},
            success: function (data, status, xhr) {	
            	$table.DataTable().ajax.reload('', false);	
			},
			error: function(){
				new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
					type: 'error'
				});		
			}
		});	
	}

	jQuery(document).ready(function() { 
		
		$table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
                "type": "POST",
                "async": true,
				"url": "<?= site_url("admin/quizzes/getlist") ?>",
				"data": '',		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            "columnDefs": [ {
				"targets": [4],
				"createdCell": function (td, cellData, rowData, row, col) {
					$(td).html('<a href="javascript:changeQuiz('+cellData+')"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteQuiz('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
					//$(td).addClass('actions-hover actions-fade');								
				}
			} ],     
            "columns": [
            	{ "title": "<?=$term["title"]?>", "data": "quiz_title", "class": "text-left" },
            	{ "title": "<?=$term["categoryname"]?>", "data": "category_name", "class": "text-left", "width":"100" },
				/*{ "title": "Topic Title", "data": "training_title", "class": "text-left", "width":"100" },*/
				{ "title": "<?=$term["type"]?>", "data": "quiz_type", "class": "text-left", "width":"50"},
				/*{ "title": "Marks", "data": "marks", "class": "text-right", "width":"50"},*/
			/*	{ "title": "Limited Time", "data": "limited_time", "class": "text-right", "width":"50"},	*/
				{ "title": "<?=$term["regdate"]?>", "data": "created_at", "class": "text-left", "width":150 },
				{ "title": "<?=$term["action"]?>", "data": "id", "class": "text-center", "width":"80" },
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