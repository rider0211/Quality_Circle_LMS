<script type="text/javascript">
	var course_id = <?php echo $course_id?>;
	var user_id = <?php echo $user_id?>;
</script>

<section role="main" class="content-body">
	<header class="page-header">
		<h2>Quiz History</h2>
	
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<h2 class="card-title">Quiz History</h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover mb-0" id="datatable_exam_history" >
					</table>
				</div>
			</section>
		</div>
	</div>
    
<script>
	var $history_table = $('#datatable_exam_history');

	jQuery(document).ready(function() { 	

		var tbdata = $history_table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
	            "type": "POST",
	            "async": true,
				"url": "<?=base_url()?>instructor/coursecreation/getQuizHistoryList"+"?course_id="+course_id+"&user_id="+user_id,
				"data": {'type':'general'},		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
	        },
	        
	        "columnDefs": [
                {
                    "targets": [4],
                    "createdCell": function (td, cellData, rowData, row, col) {
                        if(cellData != null){
                            $(td).html(cellData);
                        } else {
                            $(td).html('---');
                        }
                    }
                },{         //http://localhost/ols/instructor/examhistory/preview_history/24
                    "targets": [6],
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).html('<a class="btn btn-default btn-sm" target="blank" href="<?= base_url()?>instructor/coursecreation/view_quiz_answers/'+rowData['group_id']+'/'+rowData['user_id']+'">View Quiz Answers</a>');
                        }                    
                }
                ],
	        "columns": [
	        	{ "title": "No", "data": "no", "class": "text-left", "width":50},
				{ "title": "Learner Name", "data": "learner_name", "class": "text-left", "width":60 },
              
				{ "title": "Title", "data": "group_title", "class": "text-left", "width":200 },
	        	{ "title": "Quiz Count", "data": "quiz_num", "class": "text-left", "width":200 },
				{ "title": "Result Mark", "data": "result_mark", "class": "text-left", "width":200},
				{ "title": "Attempt Num", "data": "attempt_num", "class": "text-left", "width":200 },
				{ "title": "Action", "data": "group_id", "class": "text-left", "width":200 },
				
			],
			"lengthMenu": [
	            [5, 10, 20, 50, 150, -1],
	            [5, 10, 20, 50, 150, "All"] // change per page values here
	        ],
	        "scrollY": true,
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

	<!-- end: page -->
</section>