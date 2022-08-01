<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["topicmanagement"]?></h2>
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li><a href="<?php echo base_url(); ?>admin/home"><i class="fas fa-home"></i></a></li>
				<li><span><?=$term["trainings"]?></span></li>
				<li><span><?=$term["topic"]?></span></li>
				<li><span><?=$term["add"]?> or <?=$term["edit"]?> </span></li>
			</ol>
		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<form id="frm_topic" action="<?php echo base_url(); ?>admin/topic/add" enctype="multipart/form-data" method="POST" novalidate="novalidate">				
				<section class="card">
					<header class="card-header">
						<div class="card-actions">	
							<a class="btn btn-default" href="<?php echo base_url(); ?>admin/topic"><i class="fas fa-table"></i> <?=$term["topiclist"]?></a>
						</div>

						<h2 class="card-title"><?=$term["topic"]?></h2>
					</header>
					<div class="card-body">
						<div class="row">
				            <div class="col-md-12">
				                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
				            </div>
				        </div>
				        <input type="hidden" name="row_id" id="row_id" value="<?php print $row_id; ?>">
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="col-form-label" for="input_training_title">Topic Title <span class="required">*</span></label>
									<input type="text" class="form-control" id="input_training_title" name="training_title" placeholder="eg.: Topic 1" required="" maxlength=100 value="<?php print $training_title; ?>">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label class="col-form-label" for="select_category_id"><?=$term["category"]?> <span class="required">*</span></label>
									<select data-plugin-selectTwo data-ajax-url="<?php echo base_url(); ?>admin/category/getcategorylist" data-plugin-options='{ "allowClear": true, "placeholder": "Category", "minimumInputLength": 0, "data" : [{"id":<?php print $category_id; ?>, "text": "<?php print $category_name; ?>" }]  }' class="form-control populate" required="" name="category_id" id="select_category_id">
									</select>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6" style="display: none;">
								<div class="form-group">
									<label class="col-form-label" for="spinner_training_timer"><?=$term["timemin"]?></label>
									<div data-plugin-spinner data-plugin-options='{ "value":<?php print $training_timer; ?>, "step": 5, "min": 0, "max": 9999 }'>
										<div class="input-group form-control-small">
											<input type="text" class="spinner-input form-control" name="training_timer" id="spinner_training_timer" readonly="readonly">
											<div class="spinner-buttons input-group-btn btn-group-vertical">
												<button type="button" class="btn spinner-up btn-xs btn-default">
													<i class="fas fa-angle-up"></i>
												</button>
												<button type="button" class="btn spinner-down btn-xs btn-default">
													<i class="fas fa-angle-down"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group">
									<label class="col-form-label" for="input_price"><?=$term["price"]?> (€) <span style="color: red;font-weight: bold;"><?=$term["trainingpricehint"]?></span></label>
									<div data-plugin-spinner data-plugin-options='{ "value":<?php echo $price; ?>, "step": 5, "min": 0, "max" : 10000 }'>
										<div class="input-group form-control-small">
											<input type="text" class="spinner-input form-control" name="price" id="spinner_input_price">
											<div class="spinner-buttons input-group-btn btn-group-vertical">
												<button type="button" class="btn spinner-up btn-xs btn-default">
													<i class="fas fa-angle-up"></i>
												</button>
												<button type="button" class="btn spinner-down btn-xs btn-default">
													<i class="fas fa-angle-down"></i>
												</button>
											</div>
										</div>
									</div>									
								</div>
							</div>


                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="col-form-label" for="fileupload_image"><?=$term["image"]?></label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="fas fa-file fileupload-exists"></i>
                                                <span class="fileupload-preview"><?php echo isset($image)?$image:''; ?></span>
                                            </div>
                                            <span class="btn btn-default btn-file">
												<span class="fileupload-exists">Change</span>
												<span class="fileupload-new">Select file</span>
												<input type="file" name="image" id="category_image"  />
											</span>
                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?=$term["remove"]?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1">
								<span data-plugin-lightbox data-plugin-options='{ "type":"image" }' >
			                        <img class="img-fluid" id="current_image" src="<?php echo $preview_image; ?>" width="40" height="30">
			                    </span>
                            </div>

						</div>

						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="col-form-label" for="email_notification"><?=$term["emailnotification"]?> </label>
									<div class="switch switch-primary">
										<input type="checkbox" name="email_notification" id="email_notification" data-plugin-ios-switch <?php echo $email_notification==1?'checked="checked"':'';?> />
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label class="col-form-label"><?=$term["smsnotification"]?></label>
									<div class="switch switch-info">
										<input type="checkbox" name="sms_notification" id="sms_notification" data-plugin-ios-switch <?php echo $sms_notification==1?'checked="checked"':'';?> />
									</div>
								</div>
							</div>
						</div>

						<!--<div class="form-group row">
							<div class="col-lg-3">
								<div class="form-group">
									<label class="col-form-label" for="email_notification">SCC EXAM</label>
									<div class="switch switch-primary">
										<input type="checkbox" name="email_notification" id="email_notification" data-plugin-ios-switch <?php /*echo $email_notification==1?'checked="checked"':'';*/?> />
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label class="col-form-label" for="email_notification">MINIMUM</label>
									<div class="switch switch-primary">
										<input type="checkbox" name="email_notification" id="email_notification" data-plugin-ios-switch <?php /*echo $email_notification==1?'checked="checked"':'';*/?> />
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label class="col-form-label" for="email_notification">COUNT</label>
									<div class="switch switch-primary">
										<input type="checkbox" name="email_notification" id="email_notification" data-plugin-ios-switch <?php /*echo $email_notification==1?'checked="checked"':'';*/?> />
									</div>
								</div>
							</div>
						</div>-->
						<div class="form-group row" >
							<div class="col-lg-6" style="display: none;">
								<div class="form-group">
									<label class="col-form-label" for="spinner_repeat_days"><?=$term["repeatdays"]?></label>
									<div data-plugin-spinner data-plugin-options='{ "value":<?php print $repeat_days; ?>, "step": 1, "min": 0, "max": 200 }'>
										<div class="input-group form-control-small">
											<input type="text" class="spinner-input form-control" name="repeat_days" id="spinner_repeat_days">
											<div class="spinner-buttons input-group-btn btn-group-vertical">
												<button type="button" class="btn spinner-up btn-xs btn-default">
													<i class="fas fa-angle-up"></i>
												</button>
												<button type="button" class="btn spinner-down btn-xs btn-default">
													<i class="fas fa-angle-down"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>


						</div>		

						<div class="form-group row">
							<div class="col-lg-6" style="margin-left: 15px;">
								<div class="form-group">
									<label class="col-form-label" for="text_summary"><?=$term["shortdescription"]?></label>
						<!--			<textarea style="height:100px;" class="ckeditor form-control" name="summary" id="text_summary" rows="3"><?php /*print $summary; */?></textarea>
						-->
                                    <textarea class="form-control" rows="3" name="summary" id="text_summary" data-plugin-maxlength maxlength="120"><?php print $summary; ?></textarea>
                                    <p>
                                        <code>max-length</code> set to 120.
                                    </p>

                                    <!--<textarea style="height:100px;" class=" form-control" name="summary" id="text_summary" rows="3"><?php /*print $summary; */?></textarea>
-->
                                </div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label class="col-form-label" for="text_description"><?=$term["description"]?></label>
									<textarea class="ckeditor form-control" name="description" id="text_description" rows="6"><?php print $description; ?></textarea>
								</div>
							</div>
						</div>	

						<div class="row">
							<input type="hidden" class="form-control" name="lessons" id="input_lessons" value='<?php echo isset($content)&&!empty($content)?$content:"[]"; ?>' required="">
							<input type="hidden" class="form-control" name="lesson_count" id="input_lesson_count" value='<?php echo isset($content)&&!empty($content)?$content:"[]"; ?>' required="">
							<div class="col-lg-6">
								<div class="form-group">
									<div class="col-lg-12" style="margin-bottom:10px;">
										<div class="form-group row">
											<div class="col-lg-4">
												<label class="control-label" for="grid_selectable_lessonlist" style="font-size: 16px; font-weight: 600; color: #333;"> Selectable Lessons </label>
											</div>
											<div class="col-lg-4">
												<input class="form-control" placeholder="Type Lesson Code" id="lesson_code">
											</div>
											<div class="col-lg-4">
												<select data-plugin-selectTwo class="form-control" id="lesson_type">
													<option value="" selected >Select Lesson Type</option>
													<option value="text">TEXT</option>
													<option value="url">URL</option>
													<option value="image">IMAGE</option>
													<option value="video">VIDEO</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<table class="table table-responsive-md table-striped mb-0" id="datatable_selectable_lesson" ></table>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label class="col-form-label" for="grid_selectable_lessonlist" style="font-size: 16px; font-weight: 600; color: #333;"> Selected Lessons</label>
									<div class="col-lg-12">
										<table class="table table-responsive-md table-striped table-hover mb-0" id="datatable_selected_lesson" ></table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<footer class="card-footer">
						<div class="row justify-content-end">
							<div class="col-sm-7">
								<button type="submit" id="btn_save" class="btn btn-primary" onsubmit="javascript:checkvalue();"><?=$term["save"]?></button>
								<button type="reset" class="btn btn-default"><?=$term["reset"]?></button>
							</div>
						</div>
					</footer>
				</section>
			</form>				
		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>

	var editor;
	var selected_lessons = <?php print json_encode($lesson_list);?>;

	var input_lessons = '<?=(isset($content) && $content) ? $content : "[]"?>';
	var lesson_count = '<?=$lesson_count?>';
	var category_id = '<?=$category_id?>';

	var $selectable_table = $('#datatable_selectable_lesson');
	var $selected_table = $('#datatable_selected_lesson');

	function checkvalue() {
		console.log($('#select_lesson_list').val());
	}

	jQuery(document).ready(function() { 	

		$('[data-plugin-spinner]').each(function() {
			var $this = $( this ),
				opts = {};

			var pluginOptions = $this.data('plugin-options');
			if (pluginOptions)
				opts = pluginOptions;

			$this.themePluginSpinner(opts);
		});

		

		$('[data-plugin-selectTwo]').each(function() {
			var $this = $( this ),
				opts = {};

			var pluginOptions = $this.data('plugin-options');
			if (pluginOptions)
				opts = pluginOptions;

			$this.themePluginSelect2(opts);
		});

		$('[data-plugin-ios-switch]').each(function() {
			var $this = $( this );

			$this.themePluginIOS7Switch();
		});

		
		// The instanceReady event is fired, when an instance of CKEditor has finished
		// its initialization.
		CKEDITOR.on( 'instanceReady', function( ev ) {
			editor = ev.editor;
		});


		$("#frm_topic").validate({
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

		$('#email_notification').on('change', function(e){
			if(!$('#email_notification')[0]['checked'])
			{
				$($('#sms_notification')[0].previousSibling).removeClass("on");
				$($('#sms_notification')[0].previousSibling).addClass("off");
			} 
		});

		$('#sms_notification').on('change', function(e){
			if($('#sms_notification')[0]['checked'])
			{
				$($('#email_notification')[0].previousSibling).removeClass("off");
				$($('#email_notification')[0].previousSibling).addClass("on");
			}
		});

		$('#select_category_id').on('change', function(){
			var current_category_id = $('#select_category_id').val();
			if (current_category_id == category_id){
				$('#input_lessons').val(input_lessons);
				$('#input_lesson_count').val(lesson_count);
			}else{
				$('#input_lessons').val('[]');
				$('#input_lesson_count').val(0);
			}
			reload_table();
			tbl_first_reload = false;/*prevent first reload*/
		});

		if($('#select_category_id').val() > 0) {
			$('#select_category_id').trigger('change');
		}


		$selectable_table.dataTable({
			"ordering": false,
			"info": true,
			"searching": true,

			"ajax": {
				"type": "POST",
				"async": true,
				"url": "<?= site_url("admin/lesson/getselectablelessonlist") ?>",
				"data": function(d){
					d.ids = JSON.parse($('#input_lessons').val());
					d.category_id = $('#select_category_id').val();
					return d;
				},
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
			},
			"columnDefs": [ {
				"targets": [0],
				"createdCell": function (td, cellData, rowData, row, col) {
					$(td).html('<a href="javascript:addLesson('+cellData+')" class="btn btn-primary"><i class="fa fa-plus"></i></a>');
				}
			}, {
				"targets": [3],
				"visible" : false,
			}],
			"columns": [
				{ "title": "<?=$term["action"]?>", "data": "id", "class": "left", "width":"60" },
				{ "title": "<?=$term["title"]?>", "data": "lesson_title", "class": "left", "width":"*" },
				{ "title": "<?=$term["type"]?>", "data": "lesson_type", "class": "left", "width":"100"},
				{ "title": "Lesson Code", "data": "lesson_code", "class": "left", "width":"0"},
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
			"pageLength": 10, // default record count per page
			dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			bProcessing: true,
		});

		$selected_table.dataTable({
			"ordering": false,
			"info": true,
			"searching": true,

			"ajax": {
				"type": "POST",
				"async": true,
				"url": "<?= site_url("admin/lesson/getselectedlessonlist") ?>",
				"data": function(d){
					d.ids = JSON.parse($('#input_lessons').val());
					d.category_id = $('#select_category_id').val();
					return d;
				},
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
			},
			"columnDefs": [ {
				"targets": [0],
				"createdCell": function (td, cellData, rowData, row, col) {
					$(td).html('<a href="javascript:removeLesson('+cellData+')" class="btn btn-danger lesson_id" data-id="' + cellData + '"><i class="fa fa-times"></i></a>');
				}
			}],
			"columns": [
				{ "title": "<?=$term["action"]?>", "data": "id", "class": "left", "width":60 },
				{ "title": "<?=$term["title"]?>", "data": "lesson_title", "class": "left", "width":"*" },
				{ "title": "<?=$term["type"]?>", "data": "lesson_type", "class": "left", "width":100},
			],
			"scrollY": 500,
			"scrollX": true,
			"scrollCollapse": false,
			"jQueryUI": true,

			"paging": false,
			"pagingType": "full_numbers",
			"pageLength": 10, // default record count per page

			dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			bProcessing: true,
		});

		$('#datatable_selected_lesson tbody').sortable({
			start: function(event, ui){
			},
			stop: function(event, ui){
				var ids = [];
				$('.lesson_id').each(function() {
					var id = $(this).attr('data-id');
					ids.push(id);
				});
				$('#input_lessons').val(JSON.stringify(ids));
				$('#input_lesson_count').val(ids.length);
			}
		});

		$.fn.dataTable.ext.search.push(
				function( settings, data, dataIndex ) {
					if (settings && settings.sTableId == 'datatable_selected_lesson') return true;
					var lesson_type = $('#lesson_type').val();
					var lesson_code = $('#lesson_code').val();

					if (lesson_type){
						if (lesson_type != data[2]) return false;
					}

					if (lesson_code){
						if (!(data[3] && data[3].indexOf(lesson_code) >= 0)) return false;
					}

					return true;
				}
		);

		$('#lesson_code').on('keyup', function(){
			$selectable_table.DataTable().ajax.reload('', false);
		});

		$('#lesson_type').on('change', function(){
			$selectable_table.DataTable().ajax.reload('', false);
		});
	});

	function addLesson(qid) {
		var selected_lesson_ids = JSON.parse($('#input_lessons').val());
		selected_lesson_ids.push(qid.toString());
		var qcount = Number($('#input_lesson_count').val()).valueOf();
		qcount++;
		$('#input_lesson_count').val(qcount);
		$('#input_lessons').val(JSON.stringify(selected_lesson_ids));

		reload_table();

	}

	function removeLesson(qid) {
		var selected_lesson_ids = JSON.parse($('#input_lessons').val());
		selected_lesson_ids.splice(selected_lesson_ids.indexOf(qid.toString()), 1);
		var qcount = Number($('#input_lesson_count').val()).valueOf();
		qcount--;
		$('#input_lesson_count').val(qcount);
		$('#input_lessons').val(JSON.stringify(selected_lesson_ids));

		reload_table();
	}

	var tbl_first_reload = true;
	function reload_table(){
		/*prevent first reload*/
		if (tbl_first_reload) return;
		$selectable_table.DataTable().ajax.reload('', false);
		$selected_table.DataTable().ajax.reload('', false);
	}

</script>

<script src="<?php echo base_url('assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js'); ?>"></script>
