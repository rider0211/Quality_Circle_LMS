<section role="main" class="content-body">
	<header class="page-header">
		<h2>Evening Work & Excercise</h2>	
	</header>
	<!-- start: page -->
	<div class="row">		
		<div class="col-lg-12">			
				<article class="card">
					<header class="card-header">
						<div class="card-actions">
							<!--  -->
							<a class="btn btn-default" href="<?php echo base_url();?>instructor/eveningwrk" id="btn_list"><i class="fa fa-table"></i> Evening Work & Excercise List </a>
						</div>
						<h2 class="card-title">Evening Work & Excercise</h2>
					</header>
					<div class="card-body">
						<form id="category_add_form" action="<?php echo base_url();?>instructor/eveningwrk/saveExcercise" enctype="multipart/form-data" method="POST" novalidate="novalidate">                        
							<input type="hidden" name="id" id="id" value="<?php echo $id;?>">							
							<div class="form-group row">
								<label class="col-sm-3 control-label text-sm-right pt-2">Student<span class="required">*</span></label>
								<div class="col-lg-6 col-sm-8">
									<select data-plugin-selectTwo name="student_id" id="student_id" class="form-control" required>
                                    	<option value="">Select Student</option>
                                        <?php if(isset($allstudents) && !empty($allstudents) && count($allstudents) > 0){ ?>
                                        	<?php foreach($allstudents as $sKey => $sVal){ ?>
                                            	<option <?php if($excercise['student_id'] == $sVal['id']) {echo 'selected';} ?> value="<?php echo $sVal['id']; ?>"><?php echo $sVal['fullname']; ?></option>
                                        <?php } } ?>
                                    </select>
								</div>
							</div>
                            <div class="form-group row">
								<label class="col-sm-3 control-label text-sm-right pt-2">Categories<span class="required">*</span></label>
								<div class="col-lg-6 col-sm-8">
									<select name="category_id" id="category_id" class="form-control" required>
                                    	<option value="">Select Category</option>
                                        <?php if(isset($categories) && !empty($categories) && count($categories) > 0){ ?>
                                        	<?php foreach($categories as $cKey => $cVal){ ?>
                                            	<option <?php if($excercise['category_id'] == $cVal['id']) {echo 'selected';} ?> value="<?php echo $cVal['id']; ?>"><?php echo $cVal['name']; ?></option>
                                        <?php } } ?>
                                    </select>
								</div>
							</div>
                            <div class="form-group row">
                            	<label class="col-sm-3 control-label text-sm-right pt-2">Title<span class="required">*</span></label>
								<div class="col-lg-6 col-sm-8">
                                	<input type="text" name="title" id="title" class="form-control" value="<?php echo $excercise['title']; ?>" required/>
								</div>
                            </div>
                            <div class="form-group row">
                            	<label class="col-sm-3 control-label text-sm-right pt-2">Session<span class="required">*</span></label>
								<div class="col-lg-6 col-sm-8">
                                	<input type="text" name="session" id="session" class="form-control" value="<?php echo $excercise['session']; ?>" required/>
								</div>
                            </div>
                            <div class="form-group row">
                            	<label class="col-sm-3 control-label text-sm-right pt-2">Evening Work<span class="required">*</span></label>
								<div class="col-lg-6 col-sm-8">
                                	<input type="text" name="evening_work" id="evening_work" class="form-control" value="<?php echo $excercise['evening_work']; ?>" required/>
								</div>
                            </div>
                            <div class="form-group row">
                            	<label class="col-sm-3 control-label text-sm-right pt-2">Excercise<span class="required">*</span></label>
								<div class="col-lg-6 col-sm-8">
                                	<input type="text" name="excercise" id="excercise" class="form-control" value="<?php echo $excercise['excercise']; ?>" required/>
								</div>
                            </div>
                            <?php
								$upload_path_chk = 'assets/uploads/excercise/';
								$file_path_chk = FCPATH.$upload_path_chk.$excercise['document'];
								if(file_exists($file_path_chk) && isset($excercise['document'])){
							?>
                            <div class="form-group row">
                            	<label class="col-sm-3 control-label text-sm-right pt-2">Document preview</label>
								<div class="col-lg-6 col-sm-8">
                                	<a target="_blank" href="<?php echo base_url('assets/uploads/excercise/').$excercise['document']; ?>">Download document 1</a>
								</div>
                            </div>
                            <?php } ?>
							<div class="form-group row">
								<label class="col-sm-3 control-label text-sm-right pt-2"></label>
								<div class="col-lg-6 col-sm-8 editArea">
                                	<input type="file" name="document" class="file-input-overwrite" id="document" class="form-control"/>
								</div>
							</div>
                            
                            <!------------------------document 2---------------------------------->
                            <?php
								$upload_path_chk = 'assets/uploads/excercise/';
								$file_path_chk = FCPATH.$upload_path_chk.$excercise['document2'];
								if(file_exists($file_path_chk) && isset($excercise['document2'])){
							?>
                            <div class="form-group row">
                            	<label class="col-sm-3 control-label text-sm-right pt-2">Document preview 2</label>
								<div class="col-lg-6 col-sm-8">
                                	<a target="_blank" href="<?php echo base_url('assets/uploads/excercise/').$excercise['document2']; ?>">Download document 2</a>
								</div>
                            </div>
                            <?php } ?>
							<div class="form-group row">
								<label class="col-sm-3 control-label text-sm-right pt-2">Document 2</label>
								<div class="col-lg-6 col-sm-8 editArea">
                                	<input type="file" name="document2" class="file-input-overwrite2" id="document2" class="form-control"/>
								</div>
							</div>
                            
                            <!---------------------------document 3--------------------------------->
                            <?php
								$upload_path_chk = 'assets/uploads/excercise/';
								$file_path_chk = FCPATH.$upload_path_chk.$excercise['document3'];
								if(file_exists($file_path_chk) && isset($excercise['document3'])){
							?>
                            <div class="form-group row">
                            	<label class="col-sm-3 control-label text-sm-right pt-2">Document preview 3</label>
								<div class="col-lg-6 col-sm-8">
                                	<a target="_blank" href="<?php echo base_url('assets/uploads/excercise/').$excercise['document3']; ?>">Download document 3</a>
								</div>
                            </div>
                            <?php } ?>
							<div class="form-group row">
								<label class="col-sm-3 control-label text-sm-right pt-2">Document 3</label>
								<div class="col-lg-6 col-sm-8 editArea">
                                	<input type="file" name="document3" class="file-input-overwrite3" id="document3" class="form-control"/>
								</div>
							</div>
                            
							<div class="form-group row">
								<label class="col-sm-3 control-label text-sm-right pt-2">Status<span class="required">*</span></label>
								<div class="col-lg-6 col-sm-8">
									<select class="form-control" name="status">
										<option value="">Select Status</option>
										<option value="1" <?php echo isset($excercise['status']) && ($excercise['status'] == 1) ? 'selected' : '' ?> selected="">Active</option>
										<option <?php echo isset($excercise['status']) && ($excercise['status'] == 0) ? 'selected' : '' ?> value="0">InActive</option>
									</select>
								</div>
							</div>	
						</form>
						<!--<div class="row">
							<div class="col-md-2">
								<a class="btn btn-default modal-basic" href="#modalBasic" id="btn_add"><i class="fa fa-plus"></i> <?=$term["addnew"]?></a>
							</div>
							<div class="col-md-8">
								<table class="table table-responsive-md table-bordered mb-0" id="datatable_category_standard">
								</table>
							</div>
						</div>-->

					</div>
					<footer class="card-footer">
						<div class="row">
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-primary" id="btn_save"><?=$term["save"]?></button>
								<button type="reset" class="btn btn-default"><?=$term["reset"]?></button>
							</div>
						</div>
					</footer>
				</article>			
		</div>						
	</div>
	
	<!-- end: page -->
</section>
<div id="modalBasic" class="modal-block mfp-hide">
	<section class="card">
		<header class="card-header">
			<h2 class="card-title" id="standard_modal"></h2>
		</header>
		<div class="card-body">
			<div class="modal-wrapper">
				<div class="modal-text row">
					<input type="hidden" id="standard_id" name="standard_id">
					<label class="col-sm-3 control-label text-sm-right pt-2">Name</label>
					<div class="col-sm-8">
						<input type="text" id="standard_name" name="standard_name" class="form-control" >
					</div>
					
				</div>
			</div>
		</div>
		<footer class="card-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-primary modal-confirm">Confirm</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</section>
</div>


<script>
	$(".file-input-overwrite").fileinput({
	   browseLabel: 'Browse',
	   browseIcon: '<i class="icon-file-plus"></i>',
	   uploadIcon: '<i class="icon-file-upload2"></i>',
	   removeIcon: '<i class="icon-cross3"></i>',
	   
	   initialPreviewAsData: true,
	   overwriteInitial: true, 
   });
   
   $(".file-input-overwrite2").fileinput({
	   browseLabel: 'Browse',
	   browseIcon: '<i class="icon-file-plus"></i>',
	   uploadIcon: '<i class="icon-file-upload2"></i>',
	   removeIcon: '<i class="icon-cross3"></i>',
	   
	   initialPreviewAsData: true,
	   overwriteInitial: true, 
   });
   
   $(".file-input-overwrite3").fileinput({
	   browseLabel: 'Browse',
	   browseIcon: '<i class="icon-file-plus"></i>',
	   uploadIcon: '<i class="icon-file-upload2"></i>',
	   removeIcon: '<i class="icon-cross3"></i>',
	   
	   initialPreviewAsData: true,
	   overwriteInitial: true, 
   });   
   

	var $table = $('#datatable_category_standard');

	var frm = $('#category_add_form');
	frm.validate({
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

	$('#btn_add').click (function(){
		$('#standard_modal').html('Add standard');
		$('#standard_id').val('0');
		$('#standard_name').val('');
	});

	function update(id,name){
		$('#btn_add').click();
		$('#standard_modal').html('Update standard');
		$('#standard_id').val(id);
		$('#standard_name').val(name);
	};
	
	$(document).on('click', '.modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});

	/*
	Modal Confirm
	*/
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		$.ajax({
            url: "<?php echo base_url() ?>instructor/category/saveStandard",
            type: 'POST',
            data: {'standard_id':$('#standard_id').val(),
        			'standard_name':$('#standard_name').val(),
        			'category_id':<?php echo $id;?>},
            dataType : 'json',
            success: function(data){
                
               $.magnificPopup.close();
               $table.DataTable().ajax.reload();
				new PNotify({
					title: 'Success!',
					text: 'Modal Confirm Message.',
					type: 'success'
				}); 		  
            }
        });
		
	});

	function deleteStandard(id) 
	{	
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
                url: '<?php echo base_url() ?>instructor/category/delete_standard',
                type: 'POST',
                data: {id:id},
                dataType : 'json',
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
	}
	// function deleteStandard(id) {
	// 	$.ajax({
 //            url: "<?php echo base_url() ?>admin/category/delete_standard",
 //            type: 'POST',
 //            data: {'id':id},
 //            dataType : 'json',
 //            success: function(data){
                
 //               $table.DataTable().ajax.reload();
	// 			new PNotify({
	// 				title: 'Success!',
	// 				text: 'Modal Confirm Message.',
	// 				type: 'success'
	// 			}); 		  
 //            }
 //        });
		
	// };

	jQuery(document).ready(function() { 
		$table.dataTable({
			"ordering": true,
			"info": true,
			"searching": false,

			"ajax": {
                "type": "POST",
                "async": true,
				"url": "<?php echo base_url()?>instructor/video/getStandardList",
				"data": {category_id: '<?php echo $id;?>'},		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            
            "columnDefs": [ {
				"targets": [2],
				"createdCell": function (td, cellData, rowData, row, col) {
				    if (rowData['video_title'] != "Online Courses" && rowData['video_title'] != "Live Classes" && rowData['video_title'] != "ILT")
					    $(td).html('<a href="javascript:update('+rowData.id+',\''+rowData.video_title+'\')"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteStandard('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
					else
					    $(td).html('');
				    //$(td).addClass('actions-hover actions-fade');
				}
			}],
            "columns": [
                { "title": "<?=$term["no"]?>", "data": "no", "class": "text-left", "width":"80" },
				{ "title": "Standard", "data": "video_title", "class": "text-left", "width":150, "visible": true },
				{ "title": "<?=$term["action"]?>", "data": "id", "class": "text-left", "width":"80" },
			],
			"lengthMenu": [
                [5, 10, 20, 50, 150, -1],
                [5, 10, 20, 50, 150, "All"] // change per page values here
            ],
            "scrollY": false,
			"scrollX": true,
			"scrollCollapse": false,
			"jQueryUI": true,							
			
			"paging": false,
			"pagingType": "full_numbers",			
            "pageLength": 150, // default record count per page

			dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			bProcessing: true,			
		});
		
		$('.modal-basic').magnificPopup({
			type: 'inline',
			preloader: false,
			modal: true
		});
		
	});

	$('#btn_save').on('click', function(e){

			event.preventDefault();

			if(frm.valid()) {

				console.log('submit');
				frm.submit();
			} else {
				console.log('invalide');
			}
		});
</script>
