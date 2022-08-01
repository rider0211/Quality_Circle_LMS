<style>
	.ui-pnotify-container {
		height: 130px;
	}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Quiz Management</h2>
	
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url(); ?>home">
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li><span><?=$term["exam"]?></span></li>

				<li><span>Quiz List</span></li>
			</ol>

		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">	
						<a data-toggle="modal" data-target="#Type_Modal" class="btn btn-default"><i class="fas fa-plus"></i> New Quiz </a>
					</div>

					<h2 class="card-title">Quiz List</h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-striped table-hover mb-0" id="datatable_quizlist" >
					</table>
				</div>

                <form id="quiz_create_form" action="<?php echo base_url()?>admin/exam/create_quiz" method="post"  novalidate="novalidate" enctype="multipart/form-data">
                <input type="hidden" name="quiz_type" id="quiz_type">
                <input type="hidden" name="quiz_id" id="quiz_id">
                </form>
			</section>
		</div>
	</div>
	
	<!-- end: page -->
</section>
<div id="Type_Modal" class="modal fade">
    <div class="modal-dialog" style = "width: 350px;">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h4 class="modal-title">Select Quiz Type</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-sm-3 control-label" style="text-align: center">Quiz Type</label>
                    <div class="col-sm-9">
                        <select id="quiz_type_select" name="quiz_type_select" class="form-control mb3">
                            <option value="1"> Multiple Choice</option>
                            <option value="2"> Checkbox</option>
                            <option value="3"> True/False</option>
                            <option value="4"> Fill in the blank</option>
                            <option value="5"> Matching</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="createExam()">Create</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>
	var $table = $('#datatable_quizlist');

	function deleteExam(id) {
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
                url: '<?=base_url()?>admin/exam/delete_quiz',
                type: 'POST',
                data: {'id': id},
                success: function (data, status, xhr) {	
                	$table.DataTable().ajax.reload('', false);	
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
		/*.on('pnotify.cancel', function(){
			//console.log("cancel");
		});
		*/
	}
	function createExam() {

		$('#quiz_type').val($('#quiz_type_select').val());
		$('#quiz_create_form').submit();
	}
	function changeExam(id) {

		$('#quiz_id').val(id);
        $('#quiz_create_form').submit();
	}


	jQuery(document).ready(function() { 
		
		$table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
                "type": "POST",
                "async": true,
				"url": "<?php echo base_url()?>admin/exam/getQuizList",
				"data": '',		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            "columnDefs": [{
				"targets": [5],
				"createdCell": function (td, cellData, rowData, row, col) {
					$(td).html('<a class="btn btn-default" href="javascript:changeExam('+cellData+')">Edit</a><span class="w-20"></span><a class="btn btn-default" href="javascript:deleteExam('+cellData+')">Delete</a><span class="w-20"></span>');
				}
			} ],     
            "columns": [
				{ "title": "#", "data": "no", "class": "center", "width":20 },
            	{ "title": "Title", "data": "ques_title", "class": "text-left", "width":200 },
				{ "title": "Type", "data": "type", "class": "text-left", "width":50 },
                { "title": "Quiz Code", "data": "quiz_code", "class": "text-left", "width":50 },
				{ "title": "Create Date", "data": "updated_at", "class": "text-left", "width":100 },
				{ "title": "Action", "data": "id", "class": "text-left", "width":200 },
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