<section role="main" class="content-body">
	<header class="page-header">
		<h2><?php echo $term['topicmanagement']; ?></h2>

	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<h2 class="card-title"><?php echo $term['topiclist']; ?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover mb-0" id="datatable-topic" >
					</table>
				</div>
			</section>
		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>
	var $table = $('#datatable-topic');

	jQuery(document).ready(function() { 
		
		$table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
                "type": "POST",
                "async": true,
				"url": "topic/getlist",
				"data": '',		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            "columnDefs": [ {
                "targets": [2],
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).html('<span data-plugin-lightbox data-plugin-options=\'{ "type":"image" }\' title="">' +
                        '<img class="img-fluid" src="<?=base_url()?>'+'assets/uploads/topic/'+rowData['id']+'_'+cellData+'" width="32" height="32">' +
                        '</span>');
                }
            } ],     
            "columns": [
				{ "title": "<?php echo $term['categoryname']; ?>", "data": "category_name", "class": "text-left", "width":150 },
				{ "title": "<?php echo $term['topictitle']; ?>", "data": "training_title", "class": "text-left", "width":"*" },
				{ "title": "<?php echo $term['image']; ?>", "data": "image", "class": "text-center", "width":70},
				{ "title": "<?php echo $term['timemin']; ?>", "data": "training_timer", "class": "text-right", "width":100},
				{ "title": "<?php echo $term['price']; ?> (€)", "data": "price", "class": "text-right", "width":100},
				{ "title": "<?php echo $term['repeatdays']; ?>", "data": "repeat_days", "class": "text-right", "width":100},
				{ "title": "<?php echo $term['totallessons']; ?>", "data": "lesson_count", "class": "text-right", "width":80},
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