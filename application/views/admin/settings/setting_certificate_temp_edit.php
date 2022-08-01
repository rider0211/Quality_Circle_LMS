<link href="<?=site_url()?>/assets/css/demo.css?v=3" rel="stylesheet" />
<link href="<?=site_url()?>/assets/css/email-editor.bundle.min.css?<?php echo rand(10,1000)?>" rel="stylesheet" />
<link href="<?=site_url()?>/assets/css/colorpicker.css" rel="stylesheet" />

<link href="<?=site_url()?>/assets/css/editor-color.css" rel="stylesheet" />
<link rel="stylesheet" href="<?=site_url()?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
<link href="<?=site_url()?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<script type="text/javascript">
  
</script>
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
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Certificate template settings</h2>

        <div class="right-wrapper">

        </div>
	</header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
	<!-- start: page -->
	<div class="row">
		<div class="card-body">
			<div class="col-lg-12">

                <form id="add-form" action="" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                    <section class="card">
                        <header class="card-header">
                            <div class="card-actions">
                                <a class="btn btn-primary modal-with-form" href="javascript:save_btn()" >Save</a>
                                <a class="btn btn-default" href="<?= base_url()?>admin/settings/certificate"><i class="fas fa-table"></i> Certificate List</a>
                            </div>
                            <h2 class="card-title">Admin Add Form</h2>
                            
                        </header>
                        <div class="card-body">
                            <input type="hidden" name="id" id="id" value="<?php print $id?>">

                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-2">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php print $title ?>" id="title" name="title" class="form-control">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
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
                                <div class="col-md-12">
                                    <strong>Template Tags</strong>
                                    <ul>
                                        <li>{COMPANY NAME}</li>
                                        <li>{PARTICIPANT NAME}</li>
                                        <li>{COURSE NAME}</li>
                                        <li>{DATE}</li>
                                        <li>{LOCATION}</li>
                                        <li>{NUMBER}</li>
                                        <li>{USER NAME}</li>
                                        <li>{EXAM DATE}</li>
                                        <li>{EXAM TITLE}</li>
                                        <li>{EXAM SCORE}</li>
                                        
                                        <li>{SIGNATURE}</li>
                                        <li>{NAME}</li>
                                        <li>{TITLE}</li>
                                        <li>{LOGO_COMPANY}</li>
                                        <li>{LOGO_COURSE ACCERDITATION COMPANY}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                </div>
                            </div>
                        </footer>
                    </section>
                </form>
			</div>
		</div>
	</div>
	
	<!-- end: page -->
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
    $(document).on('click', '.modal-add-confirm', function (e) {
        e.preventDefault();
        var frm = $('#add-form');
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

        if(frm.valid()) {


            var formData = new FormData($('#add-form')[0]);
            if($('#add-form .modal-add-confirm').html() == 'Add') {
                $.ajax({
                    url: $('#base_url').val()+'admin/settings/certificateadd',
                    type: 'POST',
                    data: formData,
                    processData:false,
                    contentType: false,
                    success: function (data, status, xhr) {

                        new PNotify({
                            title: '<?php echo $term['success']; ?>',
                            text: '<?php echo $term['succesfullyadded']; ?>',
                            type: 'success'
                        });

                        document.location = '<?php echo base_url();?>admin/settings/certificate'; 
                    },
                    error: function(){
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                            type: 'error'
                        });
                    }
                });
            } else {
                $.ajax({
                    url: $('#base_url').val()+'admin/settings/certificatechange',
                    type: 'POST',
                    data: formData,
                    processData:false,
                    contentType: false,
                    success: function (data, status, xhr) {

                        new PNotify({
                            title: '<?php echo $term['success']; ?>',
                            text: '<?php echo $term['succesfullyupdated']; ?>',
                            type: 'success'
                        });
                        $.magnificPopup.close();
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

        }

    });
    $(function(){
        if(!$("html").hasClass("sidebar-left-collapsed"))
        {
            $("html").addClass("sidebar-left-collapsed");
            $("html").removeClass("sidebar-left-opened");
        }
        $('.template-list').html('<div style="text-align:center">Loading...</div>');
        <?php if ($content != ""):?>
        $('.content-wrapper .email-editor-elements-sortable').html('<?=str_replace("'","",$content)?>');
        <?php endif;?>
//        $('.setting-item.save-template').on('click',function(e){
//            e.preventDefault();
//            $.ajax({
//                url: '<?//=site_url()?>//admin/settings/certificateadd',
//                type: 'POST',
//                //dataType: 'json',
//                data: {
//                    id: $('#id').val(),
//                    title: $('#title').val(),
//                    content:$('.content-wrapper .email-editor-elements-sortable').html()
//                },
//                success: function(data) {
//                    $('#id').val(data);
//                    //  console.log(data);
//                    new PNotify({
//                        title: '<?php //echo $term['success']; ?>//',
//                        text: '<?php //echo $term['successfullysaved']; ?>//',
//                        type: 'success'
//                    });
//                    if (data === 'ok') {
//                        $('#popup_save_template').modal('hide');
//                    } else {
//                        $('.input-error').text('Problem in server');
//                    }
//                },
//                error: function(error) {
//                    $('.input-error').text('Internal error');
//                }
//            });
//        });
    });
    var _is_demo = true;
    function  save_btn() {
        if ($('#title').val() == ""){
            new PNotify({
                title: 'Failed',
                text: 'You have to input the title.',
                type: 'warning'
            });
            return;
        }
        $.ajax({
            url: '<?=site_url()?>admin/settings/certificateadd',
            type: 'POST',
            //dataType: 'json',
            data: {
                id: $('#id').val(),
                title: $('#title').val(),
                content:$('.content-wrapper .email-editor-elements-sortable').html()
            },
            success: function(data) {
                $('#id').val(data);
                //  console.log(data);
                new PNotify({
                    title: '<?php echo $term['success']; ?>',
                    text: '<?php echo $term['successfullysaved']; ?>',
                    type: 'success'
                });
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
    }
    function loadImages() {
        /*$.ajax({
         url: 'get-files.php',
         type: 'GET',
         dataType: 'json',
         success: function(data) {
         if (data.code == 0) {
         _output = '';
         for (var k in data.files) {
         if (typeof data.files[k] !== 'function') {
         _output += "<div class='col-sm-3'>" +
         "<img class='upload-image-item' src='" + data.directory + data.files[k] + "' alt='" + data.files[k] + "' data-url='" + data.directory + data.files[k] + "'>" +
         "</div>";
         }
         }
         $('.upload-images').html(_output);
         }
         },
         error: function() {}
         });*/
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
        langJsonUrl: '<?=base_url()?>assets/email_template/lang-1.json',
        loading_color1: 'red',
        loading_color2: 'green',
        showLoading: true,
        image_upload_url: '<?=site_url()?>admin/library/upload_library_image',

        blankPageHtmlUrl: '<?=base_url()?>assets/email_template/template-blank-page.html',
        loadPageHtmlUrl: '<?=base_url()?>assets/email_template/template-load-page.html',

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
        },
        onBeforeChangeImageClick: function(e) {
            console.log('onBeforeChangeImageClick html');
            loadImages();
        },
        //when u press load template button, u should show the list of templates
        onBeforeSettingsLoadTemplateButtonClick: function(e) {



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
            <?php if ($content != ""):?>
            $('.content-wrapper .email-editor-elements-sortable').html('<?=str_replace("'","",$content)?>');
            <?php endif;?>
        },1000);
    });


</script>
