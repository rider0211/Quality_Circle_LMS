<link href="<?=site_url()?>/assets/css/demo.css?v=3" rel="stylesheet" />
<link href="<?=site_url()?>/assets/css/email-editor.bundle.min.css?<?php echo rand(10,1000)?>" rel="stylesheet" />
<link href="<?=site_url()?>/assets/css/colorpicker.css" rel="stylesheet" />

<link href="<?=site_url()?>/assets/css/editor-color.css" rel="stylesheet" />
<link rel="stylesheet" href="<?=site_url()?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
<link href="<?=site_url()?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<style>
.mce-content-body{
    margin-left: 0px !important;
    height: auto !important;
    min-height: 500px !important;
    max-height: 3500px !important;
}
.left-menu-container{
    position: relative;
    height: 900px;
    z-index: 1;
}
.editor-container .content .content-wrapper{
    position: relative;
    width: 100%;
    z-index: 1;
    margin-top: -75px;
}
.modal-header .close{
    top: 0;
    padding: 0;
    margin: 0;
    color: black;
    right: 0;
}
.popup_images .upload-images{
    display: none;
}
.popup_images .btn-upload{
    display: none;
}

.element-boxs .col-sm-6{
    float:left
}
.element-boxs .col-sm-6 .row{
    display: block;
}


</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2><?=$term["createmanual"]?></h2>
        <div class="right-wrapper"></div>

        <div class="card-actions" style="margin-top: 7px !important; top:initial">
            <a class="btn btn-primary modal-with-form" href="javascript:export_btn()" >Export
            </a>
            <input type="hidden" name="parent_id" id="parent_id" value="<?php echo $parent_id?>">
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <a class="btn btn-primary modal-with-form" href="<?=base_url()?>instructor/library" ><?=$term["librarylist"]?>
            </a>

            <a class="modal-with-form create-manual" href="#modalFormCreateManual" hidden>
                <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"> <i class="fa fa-plus"></i> <?=$term["createmanual"]?></button>
            </a>
            <div id="modalFormCreateManual" class="modal-block modal-block-primary mfp-hide">
                <form id="create-manual-form" action="" method="POST" novalidate="novalidate">
                    <section class="card">
                        <header class="card-header">
                            <h2 class="card-title"><?=$term["createmanual"]?></h2>
                        </header>
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["manualname"]?></label>
                                <div class="col-sm-9">
                                    <input type="text" id="new_manual" name="new_manual" class="form-control" value="<?=$manual_name?>">
                                </div>

                            </div>

                        </div>
                        <footer class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary modal-create-confirm"><?=$term["create"]?></button>
                                    <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </footer>
                    </section>
                </form>
            </div>
        </div>
    </header>    
    <div class="row">
        <div class="elements-db" style="display:none">
        	<div class="tab-elements element-tab active">
        		<ul class="elements-accordion">
        			<?php echo $_outputHtml ?>
        		</ul>
        	</div>
        </div>



        <div class="editor" style="width:100%;">

        </div>
        <div id="previewModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Preview</h4>
                </div>
                <div class="modal-body">
                <div class="">
                  <label for="">URL : </label> <span class="preview_url"></span>
                </div>
                  <iframe id="previewModalFrame" width="100%" height="400px"></iframe>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
        </div>
        <div id="demp"></div>
    </div>
</section>
<script src="<?=site_url()?>/assets/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=site_url()?>/assets/vendor/jquery-nicescroll/dist/jquery.nicescroll.min.js"></script>

<!--for ace editor  -->
<script src="<?=site_url()?>/assets/js/ace.js" type="text/javascript"></script>
<script src="<?=site_url()?>/assets/js/theme-monokai.js" type="text/javascript"></script>

<!--for tinymce  -->
<script src="<?=site_url()?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="<?=site_url()?>/assets/vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="<?=site_url()?>/assets/js/colorpicker.js"></script>
<script src="<?=site_url()?>/assets/js/email-editor-plugin.js?<?php echo rand(10,1000)?>"></script>
<!--for bootstrap-tour  -->
<script src="<?=site_url()?>/assets/vendor/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<style type="text/css">
    .colorpicker div{
        position: absolute!important;
    }
</style>
<script>
    $(function(){
        if(!$("html").hasClass("sidebar-left-collapsed"))
        {
            $("html").addClass("sidebar-left-collapsed");
            $("html").removeClass("sidebar-left-opened");
        }

    });

    jQuery(document).ready(function() {
        <?php if ($content != ""):?>
        $('.content-main .sortable-row-content').html('<?=str_replace("'","",$content)?>');
        <?php endif;?>
    });

    var content_html = '';
    $('.create-manual').magnificPopup({
        type: 'inline',
        preloader: false,
        modal: true,
        // When elemened is focused, some mobile browsers in some cases zoom in
        // It looks not nice, so we disable it:
        callbacks: {
            beforeOpen: function() {

            }
        }
    });

    function  export_btn() {
        var arr=[];
        var count=0;
        var _html = '';
        $('.content-main .sortable-row-content').each(function (i,item) {
            _dataId=$(this).attr('data-id');
            _html+=$(this).html();
            arr[i]={id:_dataId,content:_html};
            if (_dataId!==undefined) {
                count++;
            }
        });

        content_html = _html;
        $('.create-manual').click();
    }

    $('.btn-close').click(function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    });


    $('.modal-create-confirm').click(function (e) {
        e.preventDefault();
        if($('#new_manual').val() == ''){
            new PNotify({
                title: 'Failed',
                text: 'Select Insert File.',
                type: 'danger'
            });
            return;
        }
        $.magnificPopup.close();

        var arr=[];
        var count=0;
        $('.content-main .sortable-row-content').each(function (i,item) {
            _dataId=$(this).attr('data-id');
            _html=$(this).html();
            arr[i]={id:_dataId,content:_html};
            if (_dataId!==undefined) {
                count++;
            }
        });
//        if (count==0) {
//            alert('Please add email blocks from the left menu, otherwise you cannot save');
//            return false;
//        }
        $.ajax({
            url: '<?=site_url()?>/instructor/library/create_pdf',
            type: 'POST',
            data: {
                html: content_html,
                id: $('#id').val(),
                parent_id: $('#parent_id').val(),
                name: $('#new_manual').val()
            },
            dataType: 'json',
            success: function(data) {
                if (data.failed_count == 0) {
                    window.location.href = data.url;
                }else{
                    new PNotify({
                        title: 'Failed',
                        text: 'Can not Export.',
                        type: 'danger'
                    });
                }
            },
            error: function() {
                new PNotify({
                    title: 'Failed',
                    text: 'Can not Export.',
                    type: 'danger'
                });
            }
        });
    });

    var _is_demo = true;

    function loadImages() {

    }

    var _templateListItems;

    var  _emailBuilder=  $('.editor').emailBuilder({
    	//new features begin

    	showMobileView: false,
    	onTemplateDeleteButtonClick:function (e,dataId,parent) {
    		/*$.ajax({
    				url: 'delete_template.php',
    				type: 'POST',
    				data: {
    						templateId: dataId
    				},
    				dataType: 'json',
    				success: function(data) {
    							parent.remove();
    				},
    				error: function() {}
    		});*/
    	},
    	//new features end

        lang: 'en',
		elementsHTML: $('.elements-db').html(),
        langJsonUrl: '<?=base_url()?>/assets/email_template/lang-1.json',
        loading_color1: 'red',
        loading_color2: 'green',
        showLoading: true,
        image_upload_url: '<?=site_url()?>instructor/library/upload_library_image',

        blankPageHtmlUrl: '<?=base_url()?>/assets/email_template/template-blank-page.html',
        loadPageHtmlUrl: '<?=base_url()?>/assets/email_template/template-load-page.html',

        //left menu
        showElementsTab: true,
        showPropertyTab: true,
        showCollapseMenu: true,
        showBlankPageButton: true,
        showCollapseMenuinBottom: true,

        //setting items
        showSettingsBar: true,
        showSettingsPreview: false,
        showSettingsExport: false,
		showSettingsImport: false,
        showSettingsSendMail: false,
        showSettingsSave: false,
        showSettingsLoadTemplate: false,

        //show context menu
        showContextMenu: true,
        showContextMenu_FontFamily: true,
        showContextMenu_FontSize: true,
        showContextMenu_Bold: true,
        showContextMenu_Italic: true,
        showContextMenu_Underline: true,
        showContextMenu_Strikethrough: true,
        showContextMenu_Hyperlink: true,

        //show or hide elements actions
        showRowMoveButton: true,
        showRowRemoveButton: true,
        showRowDuplicateButton: true,
        showRowCodeEditorButton: true,
        onSettingsExportButtonClick: function(e, getHtml) {
            content_html = getHtml;
            $('.create-manual').click();
            //e.preventDefault();
        },
        onPopupSaveButtonClick: function() {
            var arr=[];
            var count=0;
            $('.content-main .sortable-row-content').each(function (i,item) {
                _dataId=$(this).attr('data-id');
                _html=$(this).html();
                arr[i]={id:_dataId,content:_html};
                if (_dataId!==undefined) {
                    count++;
                }
            });
            if (count==0) {
                alert('Please add email blocks from the left menu, otherwise you cannot save');
                return false;
            }
                            //
            $.ajax({
                url: 'save_template',
                type: 'POST',
                //dataType: 'json',
                data: {
                    name: $('.template-name').val(),
                                            bg_color: $('.content-wrapper').css('background-color'),
                                            contentArr:arr
                },
                success: function(data) {
                    //  console.log(data);
                    if (data === 'ok') {
                        $('#popup_save_template').modal('hide');
                    } else {
                        $('.input-error').text('Problem in server');
                    }
                },
                error: function(error) {
                    $('.input-error').text('Internal error');
                }
            });
        },
        onBeforeChangeImageClick: function(e) {
            console.log('onBeforeChangeImageClick html');
            loadImages();
        },
        //when u press load template button, u should show the list of templates
        onBeforeSettingsLoadTemplateButtonClick: function(e) {

            $('.template-list').html('<div style="text-align:center">Loading...</div>');

            $.ajax({
                url: 'load_templates.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.code == 0) {
                        _templateItems = '';
                        _templateListItems = data.files;
                        for (var i = 0; i < data.files.length; i++) {
                            _templateItems += '<div class="template-item" data-id="' + data.files[i].id + '">' +
                                                                        '<div class="template-item-delete" data-id="' + data.files[i].id + '">' +
                                                                        '<i class="fa fa-trash-o"></i>' +
                                                                        '</div>' +
                                '<div class="template-item-icon">' +
                                '<i class="fa fa-file-text-o"></i>' +
                                '</div>' +
                                '<div class="template-item-name">' +
                                    data.files[i].name +
                                '</div>' +
                                '</div>';
                        }
                        $('.template-list').html(_templateItems);
                    } else if (data.code == 1) {
                        $('.template-list').html('<div style="text-align:center">No items</div>');
                    }
                },
                error: function() {}
            });
        },
        //if u select an item of template list and press load button, u should get the html content of that template
        onBeforePopupSelectTemplateButtonClick: function(dataId) {
			$.ajax({
					url: 'get_template_blocks.php',
					type: 'POST',
					//dataType: 'json',
					data: {
							id: dataId
					},
					success: function(data) {
						data=JSON.parse(data);
						$('.content-wrapper .email-editor-elements-sortable').html('');
						for (var i = 0; i < data.blocks.length; i++) {
							_content='';
							_content += '<div class="sortable-row">' +
											'<div class="sortable-row-container">' +
											' <div class="sortable-row-actions">';

							_content += '<div class="row-move row-action">' +
													'<i class="fa fa-arrows-alt"></i>' +
													'</div>';


							_content += '<div class="row-remove row-action">' +
									'<i class="fa fa-remove"></i>' +
									'</div>';


							_content += '<div class="row-duplicate row-action">' +
									'<i class="fa fa-files-o"></i>' +
									'</div>';


							_content += '<div class="row-code row-action">' +
									'<i class="fa fa-code"></i>' +
									'</div>';

							_content += '</div>' +

							'<div class="sortable-row-content" data-id='+	data.blocks[i].block_id+' data-types='+	data.blocks[i].property+'  data-last-type='+	data.blocks[i].property.split(',')[0]+'  >' +
								data.blocks[i].content+
							'</div></div></div>';
							$('.content-wrapper .email-editor-elements-sortable').append(_content);

						}
						$('.content-wrapper').css('background-color',data.template.bg_color);

					},
					error: function(error) {
						$('.input-error').text('Internal error');
					}
			});
        }
    });

    _emailBuilder.setAfterLoad(function(e) {
		_emailBuilder.makeSortable();
		$('.elements-db').remove();

		setTimeout(function(){
			_emailBuilder.makeSortable();
			_emailBuilder.makeRowElements();
		},1000);

        <?php if ($content != ""):?>
        $('.content-main .sortable-row-content').html('<?=str_replace("'","",$content)?>');
        <?php endif;?>
    });

    $('body').on('scroll',function() {
        var top = ($('.editor-container').offset().top*-1+130)+'px';
        console.log(top);
        $(".editor .left-menu-container").css("top",top);
        $(".main-footer").css("top", top);
    });
</script>
