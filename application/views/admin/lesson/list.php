<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["lessonlist"]?></h2>
	
		
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">	
						<a href="<?php echo base_url(); ?>admin/lesson/create" class="btn btn-default"><i class="fas fa-plus"></i> <?=$term["newlesson"] ?></a>
					</div>

					<h2 class="card-title"><?=$term["lessonlist"]?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover mb-0" id="datatable_lesson" >
					</table>
				</div>
			</section>
		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>
	var $table = $('#datatable_lesson');

	function deleteLesson(id) {
		
		(new PNotify({
            title: "<?php echo $term['confirmation']; ?>",
            text: "<?php echo $term['areyousuretodelete']; ?>",
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
				'dir1': 'down',
				'dir2': 'right',
				'modal':true
			}
		})).get().on('pnotify.confirm', function(){
			$.ajax({
                url: 'lesson/delete/'+id,
                type: 'GET',
                success: function (data, status, xhr) {	
                	if(data["status"] == "Success") {
                		$table.DataTable().ajax.reload('', false);	
                	} else {
                		new PNotify({
							title: 'Fail!',
							text: result["message"],
							type: 'danger'
						});	
                	}						
				},
				error: function(){
					new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['youcantdeletethisitem']; ?>',
						type: 'error'
					});		
				}
			});
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
				"url": "lesson/getlist",
				"data": '',		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            "columnDefs": [ {
				"targets": [5],
				"createdCell": function (td, cellData, rowData, row, col) {
					$(td).html('<a href="lesson/edit/'+cellData+'"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteLesson('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
					//$(td).addClass('actions-hover actions-fade');					
				}
			} ],     
            "columns": [
				{ "title": "#", "data": "no", "class": "center", "width":20 },
				{ "title": "<?=$term["categoryname"]?>", "data": "category_name", "class": "text-left", "width":150, "visible": true },
				{ "title": "<?=$term["lessoncode"]?>", "data": "lesson_code", "class": "text-left", "width":"70", "visible": true },
				{ "title": "<?=$term["lessontitle"]?>", "data": "lesson_title", "class": "text-left", "width":"*", "visible": true },
				{ "title": "<?=$term["lessontype"]?>", "data": "lesson_type", "class": "text-left", "width":100, "render":upperString },
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