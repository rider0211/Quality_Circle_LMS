<style>
	.ui-pnotify-container {
		height: 130px;
	}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["exammanagement"]?></h2>
	
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url(); ?>home">
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li><span><?=$term["exam"]?></span></li>

				<li><span><?=$term["examlist"]?></span></li>
			</ol>

		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">	
						<a data-toggle="modal" data-target="#Type_Modal" class="btn btn-default"><i class="fas fa-plus"></i> <?=$term["newexam"]?> </a>
					</div>

					<h2 class="card-title"><?=$term["examlist"]?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-striped table-hover mb-0" id="datatable_examlist" >
					</table>
				</div>
				<?php echo form_open('instructor/exam/create', array("id"=>"frm_examlist")); ?>
					<input type="hidden" name="row_id" id="row_id">
					<input type="hidden" name="exam_type" id="exam_type">
				</form>
			</section>
		</div>
	</div>
	
	<!-- end: page -->
</section>
<div id="Type_Modal" class="modal fade">
    <div class="modal-dialog" style = "width: 300px;">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h4 class="modal-title">Select Exam Type</h4>
            </div>
            <div class="modal-body">
                    <div class="radio" >
                        <label><input type="radio" class="styled" id="auto_exam" name="map" value="1" checked>Auto Exam</label>
                    </div>
                    <div class="radio" >
                        <label><input type="radio" class="styled" id="manual_exam" name="map" value="2">Manual Exam</label>
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
	var $table = $('#datatable_examlist');

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
                url: '<?=base_url()?>instructor/exam/delete',
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
		var exam_type = $('#auto_exam').prop("checked");
		$frm_category = $('#frm_examlist');
		if (exam_type == true){
			$('#exam_type').val("Auto");
		}else{
			$('#exam_type').val("Manual");
		}

		$frm_category.submit();
	}

	function changeExam(id) {
		var exam_type = $('#auto_exam').prop("checked");
		if (exam_type == true){
			$('#exam_type').val("Auto");
		}else{
			$('#exam_type').val("Manual");
		}
		$frm_category = $('#frm_examlist');
		$('#row_id').val(id);
		$frm_category.submit();
	}

	function inactiveExam(id) {
		$.ajax({
            url: 'exam/inactive',
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

	function activeExam(id) {
		$.ajax({
            url: 'exam/active',
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
				"url": "exam/getlist",
				"data": '',		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            "columnDefs": [{
				"targets": [6],
				"createdCell": function (td, cellData, rowData, row, col) {
					$(td).html('<a class="btn btn-default" href="javascript:changeExam('+cellData+')">Edit</a><span class="w-20"></span><a class="btn btn-default" href="javascript:deleteExam('+cellData+')">Delete</a><span class="w-20"></span><a class="btn btn-default" href="<?php echo base_url()?>instructor/exam/showPreviewQuestion/'+cellData+'" style="margin-right: 10px;"> Preview</a>');
					//$(td).addClass('actions-hover actions-fade');								
				}
			} ],     
            "columns": [
				{ "title": "#", "data": "no", "class": "center", "width":20 },
            	{ "title": "<?=$term["examtitle"]?>", "data": "title", "class": "text-left", "width":200 },
				{ "title": "<?=$term["examtype"]?>", "data": "type", "class": "text-left", "width":50 },
				{ "title": "<?=$term["quizcount"]?>", "data": "quiz_num", "class": "text-center", "width":50},
				{ "title": "<?=$term["limitedtime"]?>", "data": "limit_time", "class": "text-right", "width":50},
				{ "title": "<?=$term["regdate"]?>", "data": "reg_date", "class": "text-left", "width":100 },
				{ "title": "<?=$term["action"]?>", "data": "id", "class": "text-left", "width":200 },
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