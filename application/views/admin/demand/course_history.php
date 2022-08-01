<style type="text/css">
	.mt-5{
		margin-top:5px!important;
	}
	.mr-5{
		margin-right:5px!important
	}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Course History</h2>
	
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<h2 class="card-title">Course History</h2>
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
				"url": "<?=base_url()?>admin/demand/getCourseHistoryList",
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
                },{
                "targets": [5],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData == 1){
                        $(td).html('Pending');
                    }
                    if(cellData == 2){
                        $(td).html('Course Fail');
                    }
                    if(cellData == 3){
                        $(td).html('Exam Fail');
                    }
                    if(cellData == 4){
                        $(td).html('Pass');
                    }
                }
            },{         //http://localhost/ols/admin/examhistory/preview_history/24
                    "targets": [6],
                    "createdCell": function (td, cellData, rowData, row, col) {
                        if(cellData == 1){
                            $(td).html('<a class="btn btn-default btn-sm mt-5 mr-5" href="<?= base_url()?>admin/demand/view_row_assess/'+rowData['course_id']+'/'+rowData['user_id']+'">View Assessment</a>'+
                            '<a class="btn btn-default btn-sm mt-5 mr-5" target="blank" href="<?= base_url()?>admin/demand/view_quiz_history/'+rowData['course_id']+'/'+rowData['user_id']+'">View Quiz history</a>');
                        }
                        if(cellData == 2){
                            $(td).html('<a class="btn btn-default btn-sm mt-5 mr-5" href="<?= base_url()?>admin/demand/view_row_assess/'+rowData['course_id']+'/'+rowData['user_id']+'">View Assessment</a>'+
                            '<a class="btn btn-default btn-sm mt-5 mr-5" target="blank" href="<?= base_url()?>admin/demand/view_quiz_history/'+rowData['course_id']+'/'+rowData['user_id']+'">View Quiz history</a>');
                        }
                        if(cellData == 3){
                            $(td).html('<a class="btn btn-default btn-sm mt-5 mr-5" href="<?= base_url()?>admin/demand/view_row_assess/'+rowData['course_id']+'/'+rowData['user_id']+'">View Assessment</a>'+
                            '<a class="btn btn-default btn-sm mt-5 mr-5" target="blank" href="<?= base_url()?>admin/demand/view_quiz_history/'+rowData['course_id']+'/'+rowData['user_id']+'">View Quiz history</a>'+
                            '<a class="btn btn-default btn-sm mt-5 mr-5 mt-5 mr-5" target="blank" href="<?= base_url()?>admin/demand/view_exam_history/'+rowData['course_id']+'/'+rowData['user_id']+'">View Exam</a>'+
                            '<a class="btn btn-default btn-sm mt-5 mr-5" target="blank" href="<?= base_url()?>admin/demand/view_exam_feedback/'+rowData['course_id']+'/'+rowData['user_id']+'">Feedback</a>');
                        }
                        if(cellData == 4){
                            $(td).html('<a class="btn btn-default btn-sm mt-5 mr-5" href="<?= base_url()?>admin/demand/view_row_assess/'+rowData['course_id']+'/'+rowData['user_id']+'">View Assessment</a>'+
                            //'<a class="btn btn-default btn-sm" target="blank" href="<?= base_url()?>admin/demand/view_quiz_history/'+rowData['course_id']+'/'+rowData['user_id']+'">View Quiz</a>'+

                            '<a class="btn btn-default btn-sm mt-5 mr-5" target="blank" href="<?= base_url()?>admin/demand/view_quiz_history/'+rowData['course_id']+'/'+rowData['user_id']+'">View Quiz history</a>'+
                            '<br><a class="btn btn-default btn-sm mt-5 mr-5" target="blank" href="<?= base_url()?>admin/demand/view_exam_certificate/'+rowData['course_id']+'/'+rowData['user_id']+'">View Certificate</a>'+
                            '<a class="btn btn-default btn-sm mt-5 mr-5" target="blank" href="<?= base_url()?>admin/demand/view_exam_history/'+rowData['course_id']+'/'+rowData['user_id']+'">View Exam</a>'+
                            '<a class="btn btn-default btn-sm mt-5 mr-5" target="blank" href="<?= base_url()?>admin/demand/view_exam_feedback/'+rowData['course_id']+'/'+rowData['user_id']+'">Feedback</a>');
                        }
                    }
                }],
	        "columns": [
	        	{ "title": "No", "data": "no", "class": "text-left", "width":50},
				{ "title": "Learner Name", "data": "name", "class": "text-left", "width":200 },
	        	{ "title": "Course Title", "data": "title", "class": "text-left", "width":100 },
				{ "title": "Course Start Time", "data": "reg_date", "class": "text-left", "width":200},
				{ "title": "Course End Time", "data": "end_date", "class": "text-left", "width":200 },
				{ "title": "Status", "data": "status", "class": "text-left", "width":50 },
                { "title": "Action", "data": "status", "class": "text-left", "width":300 }
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