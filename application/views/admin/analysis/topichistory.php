<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["analysisstatistics"]?></h2>
	
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<h2 class="card-title"><?=$term["topichistory"]?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover mb-0" id="datatable_training_history" >
					</table>
					<form id="form_topic_history" action="<?php echo base_url(); ?>admin/traininghistory/viewlesson" method="POST">
						<input type="hidden" name="log_id">
					</form>
				</div>
			</section>
		</div>
	</div>
<script>
	var $history_table = $('#datatable_training_history');

	jQuery(document).ready(function() { 	

		var tbdata = $history_table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
	            "type": "POST",
	            "async": true,
				"url": "gettopiclist",
				"data": '',		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
	        },
	        
	        "columnDefs": [
				{
					"targets": [8],
					"createdCell": function (td, cellData, rowData, row, col) {
						$(td).html('<a href="javascript:godetail('+cellData+')"><i class="fas fa-eye"></i></a><span class="w-20"></span>');
					}
				}
			],
	        "columns": [
	        	{ "title": "<?=$term["companyname"]?>", "data": "company_name", "class": "text-left", "width":"*" },
	        	{ "title": "<?=$term["firstname"]?>", "data": "first_name", "class": "text-left", "width":60 },
	        	{ "title": "<?=$term["lastname"]?>", "data": "last_name", "class": "text-left", "width":60 },
				{ "title": "<?=$term["category"]?>", "data": "category_name", "class": "text-left", "width":100, "visible": true },
				{ "title": "<?=$term["topictitle"]?>", "data": "training_title", "class": "text-left", "width":"*" },
                { "title": "<?=$term["duration"]?>", "data": "duration", "class": "left", "width":100 },
				{ "title": "<?=$term["startdate"]?>", "data": "start_date", "class": "text-left", "width":"100"},
				{ "title": "<?=$term["enddate"]?>", "data": "end_date", "class": "text-left", "width":"100" },
				{ "title": "<?=$term["action"]?>", "data": "log_id", "class": "text-center", "width":60 },
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

		$('#datatable_training_history tbody').on( 'click', 'tr', function () {			
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
			} else {
				tbdata.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}
		} );

		$('#datatable_training_history tbody').on( 'dblclick', 'tr', function () {
			if ( !$(this).hasClass('selected') ) {
				tbdata.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}
			var selected_rowdata = tbdata.api( true ).row( '.selected' ).data() ;
			godetail(selected_rowdata['log_id']);
		} );

	});

	function godetail(log_id){
		$('input[name="log_id"').val(log_id);
		$('#form_topic_history').submit();
	}

	</script>
	<!-- end: page -->
</section>