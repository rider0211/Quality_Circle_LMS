<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term[lessonmanagement]?></h2>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<form id="frm_lesson" action="<?php echo base_url(); ?>admin/lesson/add"  enctype="multipart/form-data" method="POST" novalidate="novalidate">
				<section class="card">
					<header class="card-header">
						<div class="card-actions">	
							<a class="btn btn-default" href="<?php echo base_url(); ?>admin/lesson"><i class="fas fa-table"></i> <?=$term["lessonlist"]?></a>
						</div>

						<h2 class="card-title"><?=$term["lesson"]?></h2>
					</header>
					<div class="card-body">
						<div class="row">
				            <div class="col-lg-12">
				                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
				            </div>
				        </div>
				        <input type="hidden" name="row_id" id="row_id" value="<?php echo $row_id; ?>">
						<div class="form-group row">
							<label class="col-lg-2 control-label text-lg-right pt-2" for="input_lesson_title"><?=$term["lessontitle"]?> <span class="required">*</span></label>
							<div class="col-lg-4">
								<input type="text" class="form-control" id="input_lesson_title" name="lesson_title" placeholder="eg.: Lesson 1" required="" maxlength=50 value="<?php print $lesson_title; ?>">
							</div>
						
							<label class="col-lg-2 control-label text-lg-right pt-2" for="input_lesson_title"><?=$term["lessoncode"]?><span class="required">*</span></label>
							<div class="col-lg-4">
								<input type="text" class="form-control" id="input_lesson_code" name="lesson_code" placeholder="eg.: Ln01" required="" maxlength=10 value="<?php print $lesson_code; ?>">
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-2 control-label text-lg-right pt-2"><?=$term["category"]?> <span class="required">*</span></label>
							<div class="col-lg-4">
								<select data-plugin-selectTwo data-ajax-url="<?php echo base_url();?>admin/category/getcategorylist" data-plugin-options='{ "allowClear": true, "placeholder": "Select Category", "minimumInputLength": 0, "data" : [{"id":<?php print $category_id; ?>, "text": "<?php print $category_name; ?>" }] }' class="form-control populate" required="" name="category_id" id="select_category_id">
								</select>
							</div>							
						</div>

						<div class="form-group row">
							<label class="col-lg-2 control-label text-lg-right pt-2"><?=$term["contenttype"]?></label>
							<div class="col-lg-4">
								<select data-plugin-selectTwo class="form-control populate" name="lesson_type" id="select_lesson_type">
									<?php foreach ($lesson_types as $type) {
										$str_selected = $type==$lesson_type?'selected':'';
										print '<option value="'.$type.'" '.$str_selected.'>'.strtoupper($type).'</option>';
									} ?>
								</select>
							</div>							
						</div>

                        <div class="form-group row">

							<label class="col-lg-2 control-label text-lg-right pt-2"><?=$term["content"]?></label>
							<div class="col-lg-10">
								<div id="div_lesson_content">
								<textarea class="ckeditor form-control" name="lesson_content" id="text_lesson_content" rows="6"><?php print $lesson_content; ?></textarea>
								</div>
								<input type="text" class="form-control" id="input_lesson_url" name="lesson_url" placeholder="eg.: https://8solutions.cloud/index.php/s/QdRBXyaBgQDf9N6" <?php if($lesson_type!='url') echo "disabled='disabled'";?> value="<?php print $lesson_url; ?>">
								<div class="dropzone dz-square" name="dzuploadfile"  id="dzuploadfile"></div>
							</div>
						</div>		
						<div class="form-group row">
							<label class="col-lg-2"></label>
							<div class="col-lg-10">
								<div style="background:white" >
									<div id="preview_image">
										<?php if ($uploaded_files) foreach($uploaded_files as $files) : ?>
										<div class="" style="display: inline-block;vertical-align: top;margin: 16px;height: 120px; width=120px">
											<img style="height:120px;width:120px;" data-dz-thumbnail="" alt="1.png"
												 src="<?=base_url()?>assets/uploads/lesson/lesson_<?=$row_id?>/<?=$files?>">
										</div>
										<?php endforeach; ?>
									</div>
									<div id="preview_video">
										<?php if($lesson_video): ?>
										<video controls style="margin-bottom:30px;width: 100%;height: 100%;" autoplay>
											<source src="<?=base_url()?>assets/uploads/lesson/lesson_<?=$row_id?>/<?=$lesson_video?>" type="video/mp4">
										</video>
										<?php endif; ?>
									</div>
									<div id="preview_url">
										<?php if($lesson_url): ?>
											<iframe src="<?=$lesson_url?>" width="100%" height="100%" frameborder="0"></iframe>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="form-group row">
							<label class="col-lg-2 control-label text-lg-right pt-2">IMAGE / VIDEO / PPTX </label>
							<div class="col-lg-10">
								
							</div>
						</div> -->
					</div>
					<footer class="card-footer">
						<div class="row justify-content-end">
							<div class="col-sm-6">
								<button id="btn_save" class="btn btn-primary"><?=$term["save"]?></button>
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
	Dropzone.autoDiscover = false;
	var editor;

	jQuery(document).ready(function() {
        var dz;

        if($('#select_lesson_type').val() == "video"){

            dz = new Dropzone('#dzuploadfile', {
                url: "<?php echo base_url('admin/lesson/uploadfile'); ?>",
                addRemoveLinks: true,
                uploadMultiple: true,
                autoQueue: false,
                acceptedFiles: "video/mp4, video/avi",
                params: {
                }
            });
        }
        else if($('#select_lesson_type').val() == "image"){
            dz = new Dropzone('#dzuploadfile', {
                url: "<?php echo base_url('admin/lesson/uploadfile'); ?>",
                addRemoveLinks: true,
                uploadMultiple: true,
                autoQueue: false,
                acceptedFiles: "image/jpeg, image/png",
                params: {

                }
            });
        }
        else{
            dz = new Dropzone('#dzuploadfile', {
                url: "<?php echo base_url('admin/lesson/uploadfile'); ?>",
                addRemoveLinks: true,
                uploadMultiple: true,
                autoQueue: false,
                acceptedFiles: "image/jpeg, image/png",
                params: {

                }
            });
        }

        $('[data-plugin-selectTwo]').each(function() {
			var $this = $( this ),
				opts = {};

			var pluginOptions = $this.data('plugin-options');
			if (pluginOptions)
				opts = pluginOptions;

			$this.themePluginSelect2(opts);
		});

		

		// The instanceReady event is fired, when an instance of CKEditor has finished
		// its initialization.
		CKEDITOR.on( 'instanceReady', function( ev ) {
			editor = ev.editor;
			<?php if($lesson_type != "text" ) { ?>
				editor.setReadOnly( true );
			<?php } ?>
		});

		<?php if($lesson_type == "text" ) { ?>
			dz.disable();
			$('#dzuploadfile').hide();
			$('#input_lesson_url').hide();
			$('#div_lesson_content').show();
		<?php } else if($lesson_type == "url") { ?>
			dz.disable();
			$('#dzuploadfile').hide();
			$('#div_lesson_content').hide();			
		<?php } else { ?>
			dz.enable();
			$('#div_lesson_content').hide();
			$('#input_lesson_url').hide();
		<?php } ?>
			

		$('#select_lesson_type').on('change', function(){
			if($('#select_lesson_type').val() == "text" ) {
				$('#div_lesson_content').show();
				editor.setReadOnly( false ); 
				dz.removeAllFiles();
				dz.disable();
				$('#input_lesson_url').hide();
				$('#input_lesson_url').attr("disabled", "disabled");
				$('#dzuploadfile').hide();
			} else {
				editor.setReadOnly( true ); 
				$('#div_lesson_content').hide();
				$('#input_lesson_url').hide();
				dz.removeAllFiles();
				dz.disable();

				$('#input_lesson_url').attr("disabled", "disabled");
				//console.log(editor);
				$('#dzuploadfile').hide();

				if($('#select_lesson_type').val() == "url") {
					$('#input_lesson_url').show();
					$('#input_lesson_url').removeAttr("disabled");					
				} else if($('#select_lesson_type').val() == "video") {
					$('#dzuploadfile').show();
					dz.options.acceptedFiles = "video/mp4, video/avi";
					dz.options.uploadMultiple = false;
					dz.enable();
				} else if($('#select_lesson_type').val() == "pptx") {
					$('#dzuploadfile').show();					
					dz.options.acceptedFiles = ".pptx";
					dz.options.uploadMultiple = true;
					dz.enable();
				} else if($('#select_lesson_type').val() == "image") {
					$('#dzuploadfile').show();					
					dz.options.acceptedFiles = "image/jpeg, image/png, image/gif";
					dz.options.uploadMultiple = true;
					dz.enable();
				}
			}

		});


		$("#frm_lesson").validate({
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

		$('#btn_save').on('click', function(e){

            e.preventDefault();
            e.stopPropagation();


            if($('#select_lesson_type').val() == "url" && $('#input_lesson_url').val() == ""){
                new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: '<?php echo $term['youshoulinputurl']; ?>',
                    type: 'error'
                });
                return;
            }
            var content = CKEDITOR.instances['text_lesson_content'].getData();

		    if($('#select_lesson_type').val() == "text" && content == ""){
                new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: '<?php echo $term['youshoulinputcontent']; ?>',
                    type: 'error'
                });
		        return;
            }
            if( $('#select_lesson_type').val() == "text" || $('#select_lesson_type').val() == "url") {
                $("#frm_lesson").submit();
            }
            else {
                if (dz.files.length == 0 && $('#select_lesson_type').val() != "text" && $('#select_lesson_type').val() != "url") {


                    new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['youshoulduploadfile']; ?>',
                        type: 'error'
                    });

                    return;
                }
                else if (dz.files.length > 0 && $('#select_lesson_type').val() != "text" && $('#select_lesson_type').val() != "url") {

                    if ($('#select_lesson_type').val() == "video" && dz.files.length > 1) {
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: '<?php echo $term['youshoulduploadfile']; ?>',
                            type: 'error'
                        });
                        return;
                    }

                    dz.processQueue();

                    dz.options.params.row_id = $('#row_id').val();
                    dz.options.params.category_id = $('#select_category_id').val();
                    dz.options.params.lesson_title = $('#input_lesson_title').val();
                    dz.options.params.lesson_code = $('#input_lesson_code').val();
                    dz.options.params.lesson_type = $('#select_lesson_type').val();
                    dz.options.params.lesson_content = content;
                    var rst = dz.processFiles(dz.files);
                }
            }
		});

		var file_upload_cnt = 0;
        dz.on('complete', function (file, res) {
            var total_cnt  = dz.files.length ;
            file_upload_cnt ++;

            if(file_upload_cnt == total_cnt){
                new PNotify({
                    title: '<?php echo $term['success']; ?>',
                    text: '<?php echo $term['succesfullyadded']; ?>',

                    type: 'success'
                });

                setTimeout(function(){
                    window.location.href = "<?php echo base_url('admin/lesson');?>";
                } , 1500);
            }

        });

    });
</script>
