<style>
    .control-label{
        font-size: 16px !important;
        padding-bottom: 25px;
    }
    .radioBox {
        padding-top: 0px !important;
    }
    html .wizard-progress.wizard-progress-lg ul li a, html.dark .wizard-progress.wizard-progress-lg ul li a {
        font-size: 15px;
    }
    .radioBox{
        float: left;
    }
    .input-form{
        line-height: 22px !important;
        float: left;
    }
    .control-label{
        font-weight: bold !important;
    }
    .highlight-input{
        margin-bottom: 10px;
    }
</style>


<style type="text/css">
    .wowbook-container-full{
        position:relative!important;
    }
    body, html, .wowbook-container{
        background: white!important;
    }
    .logo img{
        height: 40px;
    }
</style>


<style>
    iframe{
     
        min-height: 30rem;
    }
</style>

<section role="main" class="content-body">
    <header class="page-header">
        <h2><?=$term["course"]?></h2>

        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo base_url(); ?>home">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
            </ol>

        </div>
    </header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                    </div>
                    <h2 class="card-title"><?=$term["courseinfo"]?></h2>
                </header>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <section class="card form-wizard" id="w4">
                                <div class="card-body">
                                    <div class="wizard-progress wizard-progress-lg hidden">
                                        <div class="steps-progress">
                                            <div class="progress-indicator"></div>
                                        </div>
                                        <ul class="nav wizard-steps">

                                            <li id="li_id2" class="nav-item">
                                                <a class="nav-link" href="#w4-content" data-toggle="tab"><span>2</span><?=$term['coursecontent']?></a>
                                            </li>

                                        </ul>
                                    </div>
                                    <form id="form_course" name="form_course" method="post" class="form-horizontal p-3" novalidate="novalidate" enctype="multipart/form-data">
                                        <div class="tab-content">
                                            <input type="hidden" name="id" id="id" value="<?=$course_data['id']?>">

                                            <input type="hidden" name="state_now" id="state_now" value="">
                                            <input type="hidden" name="page_id" id="page_id" value="">
                                            <input type="hidden" name="chapter_id" id="chapter_id" value="">
                                            <input type="hidden" name="page_view_opt" id="page_view_opt" value="">
                                            <div id="w4-content" class="tab-pane">
                                                <div class="form-group row">
                                                    <div class="col-sm-11"></div>
                                                    <a class="col-sm-1 btn btn-primary modal-with-form" href="<?=base_url()?>instructor/live/preview_course/<?=$course_id?>">Preview</a>
                                                </div>
                                                <div class="form-group row border" style="padding: 10px">
                                                    <div class="col-sm-2">
                                                        <div class="list-group">
                                                            <a href="javascript:void(0);" onclick="btnCreateChapter()" class="btn btn-primary modal-with-form">New Session</a></br>
                                                            <a href="javascript:void(0);" onclick="btnCreatePage()" class="btn btn-info modal-with-form">New Page</a> </br>
                                                            <a href="#modalFormCreateExam" class="create-exam btn btn-warning modal-with-form">New Exam</a></br>
                                                            <a href="#modalFormCreateQuiz" class="create-quiz btn modal-with-form" style="background-color: #ff6628; color: white">New Quiz</a>

                                                        </div>
                                                        <div id="modalFormCreateExam" class="modal-block modal-block-primary mfp-hide">
                                                            <section class="card">
                                                                <header class="card-header">
                                                                    <h2 class="card-title">Exam Edit</h2>
                                                                </header>
                                                                <div class="card-body">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 control-label text-lg-right pt-2">Exam Page Title</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" id="exam_page_title" name="exam_page_title" class="form-control">
                                                                        </div>
                                                                        <label class="col-sm-3 control-label text-lg-right pt-2">Exam</label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" id="exam_id" name="exam_id">
                                                                                <?php foreach ($exam_data as $data) {
                                                                                    //$str_selected = $data['id']==$exam_id?'selected':'';
                                                                                    print '<option value="'.$data['id'].'" >'.$data['title'].'</option>';
                                                                                } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <footer class="card-footer">
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-right">
                                                                            <button class="btn btn-primary modal-create-confirm"><?=$term["create"]?></button>
                                                                            <button class="btn btn-default modal-create-dismiss"><?=$term["cancel"]?></button>
                                                                        </div>
                                                                    </div>
                                                                </footer>
                                                            </section>
                                                        </div>
                                                        <div id="modalFormCreateQuiz" class="modal-block modal-block-primary mfp-hide">
                                                            <section class="card">
                                                                <header class="card-header">
                                                                    <h2 class="card-title">Quiz Edit</h2>
                                                                </header>
                                                                <div class="card-body">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 control-label text-lg-right pt-2">Quiz Page Title</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" id="quiz_page_title" name="quiz_page_title" class="form-control">
                                                                        </div>
                                                                        <label class="col-sm-3 control-label text-lg-right pt-2">Quiz</label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" id="quiz_id" name="quiz_id">
                                                                                <?php foreach ($quiz_data as $data) {
                                                                                    //$str_selected = $data['id']==$exam_id?'selected':'';
                                                                                    print '<option value="'.$data['id'].'" >'.$data['title'].'</option>';
                                                                                } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <footer class="card-footer">
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-right">
                                                                            <button class="btn btn-primary modal-create-quiz"><?=$term["create"]?></button>
                                                                            <button class="btn btn-default modal-create-dismiss"><?=$term["cancel"]?></button>
                                                                        </div>
                                                                    </div>
                                                                </footer>
                                                            </section>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <h3 style="text-align: center">Course</h3>
                                                        <div class="all_cp_page">
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" id="getscid" value="0">
                                                <input type="hidden" id="getspid" value="0">
                                                <input type="hidden" id="setscid" value="0">
                                                <input type="hidden" id="setspid" value="0">
                                            </div>
                                            <div id="w4-content-new-page" class="tab-pane">
                                                <div class="form-group row">
                                                    <div class="col-sm-5"></div>
                                                    <a class="col-sm-1 btn btn-primary modal-with-form" href="javascript:void(0)" onclick="viewList()">View List</a>
                                                    <div class="col-sm-1"></div>
                                                    <a class="col-sm-1 btn btn-primary modal-with-form" href="<?=base_url()?>/instructor/live/preview_course/<?=$course_id?>">Preview</a>
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-1">
                                                        <div class="btn-group flex-wrap" >
                                                            <button type="button" style="margin: 0px !important;" class="mb-1 mt-1 mr-1 btn btn-default dropdown-toggle" data-toggle="dropdown">Add New <span class="caret"></span></button>
                                                            <div class="dropdown-menu" role="menu" >
                                                                <a class="dropdown-item text-1" href="javascript:void(0)" onclick="btnCreateChapter()">Session</a>
                                                                <a class="dropdown-item text-1" href="javascript:void(0)" onclick="btnCreatePageWithID(1)" id="chng_id">Page</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                                    <a class="col-sm-1 btn btn-primary modal-with-form" href="javascript:void(0)" onclick="save_now()">Save</a>
                                                </div>
                                                <div class="form-group row border" style="padding: 10px">
                                                    <div class="col-sm-3" style="margin-top:2%; border-color: #212529;">

                                                        <div class="list-group allchapter">
                                                            <div class="col-sm-12">
                                                                <input type="checkbox" id="cptitle_btn" value="1">
                                                                <span class="cptitile">Session Title</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-9 ch_detail">
                                                        <div class="form-group page_v" >
                                                            <input class="form-control incl ctitle ptitle" type="text" value="" id="text_from_title" name="text_from_title" placeholder="Page Title" data-id="0" onblur="save_chapter(this.id)" required>

                                                            <button type="button" id="library_btn" class="mb-1 mt-1 mr-1 btn btn-primary" onclick="library_modal()"><i class="fa fa-plus-square"></i> Insert Library File</button>
                                                            <button type="button" style="text-align: right" id="show_library_btn" class="mb-1 mt-1 mr-1 btn btn-primary" onclick="show_library_btn_func()">X</button>
                                                            <div class="col-sm-12" id="div_container"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="set_pre_title">
                                                <input type="hidden" id="session_p" value="">
                                                <input type="hidden" id="cp_id" value="0">
                                                <input type="hidden" id="p_id" value="0">
                                                <input type="hidden" id="session_c" value="">
                                                <input type="hidden" id="txt_detail_id" value="0">
                                                <input type="hidden" id="new_chap" value="<?php if(isset($new_chapters) && $new_chapters >= 1){ echo $new_chapters; }else{ echo 0;}?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">

                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>



    <!-- end: page -->
</section>
<div id="library_modal" class="modal fade">
    <div class="modal-dialog" style = "width: 70%;max-width: 70%;">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h3 class="modal-title"><?=$term["library"]?></h3>
            </div>
            <form id="exam_title_form" class="form-horizontal">
                <div class="modal-body">
                    <div class="col-lg-12" style="display: flex;">
                        <table class="table table-responsive-md table-hover mb-0" id="datatable" >
                        </table>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<form id="form_library_insert" action="<?=base_url()?>instructor/live/insert_library" method="post" target="blank_iframe">
    <input type="hidden" id="course_id" name="course_id" value="<?=$course_id?>">
    <input type="hidden" id="select_id" name="chapter_id" value="0">
    <input type="hidden" id="library_id" name="library_id" value="0">
</form>
<form>
    <input type="hidden" id="lid" value="0">
</form>
<iframe name="blank_iframe" id="blank_iframe" style="display: none;">

</iframe>

<script>


    var oTable;
    function library_modal(){
        oTable.api().ajax.url(oTable.fnSettings().sAjaxSource).load();
        $("#library_modal").modal();
        oTable.api().ajax.url(oTable.fnSettings().sAjaxSource).load();
    }

    var base_url = "<?php echo base_url()?>";
    var first_id = '<?php echo $libraries[0]->id;?>';
    var active_id = <?=$active_id?>;
    var chapter_id = 0;
    var create_type = "chapter"
    if (active_id == 0){
        $('#up_library'+first_id).prop('checked','checked');
    }
    else{
        $('#up_library'+active_id).prop('checked','checked');
    }
    var $table = $('#datatable_instructor');
    var $user_table = $('#datatable_user');
    var instructors = '<?=$course_data['instructors']?>';
    var enroll_users = '<?=$course_data['enroll_users']?>';
    var tab_id = 1;

    tab_id = <?=$tab_active_id?>;

    if (tab_id == 1){
        $("#li_id1").addClass("active");
        $("#w4-setting").addClass("active show");
    }
    else if (tab_id == 2){
        $("#li_id2").addClass("active");
        $("#w4-content").addClass("active show");
        $("#state_now").val('');
    }
    else{
        $("#li_id3").addClass("active");
        $("#w4-profile").addClass("active show");
    }

    function add_highlight(){
        $("#highlight_div").append('<input type="text" class="form-control highlight-input" name="highlight[]">');
    }

    (function ($) {
        change_usertable();
        var active_next = $("ul.pager li.next");
        active_next.on('click', function (ev) {
            ev.preventDefault()
            var formData = new FormData($('#form_course')[0]);
            var class_name_setting = $("#w4-setting")[0].className;
            var class_name_content = $("#w4-content")[0].className;
            var class_name_profile = $("#w4-profile")[0].className;

            if (class_name_setting.indexOf("active") > 0){   ////////////////////////////Setting////////////////////////////
                $.ajax({
                    url: $('#base_url').val()+'instructor/live/save_course_setting',
                    type: 'POST',
                    data: formData,
                    processData:false,
                    contentType: false,
                    success: function (data, status, xhr) {
                        $('#id').val(data);
                        $('#course_id').val(data);
                        new PNotify({
                            title: '<?php echo $term['success']; ?>',
                            text: '<?php echo 'Successfully Save Setting'; ?>',
                            type: 'success'
                        });
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

            if (class_name_content.indexOf("active") > 0){    ////////////////////////////Content////////////////////////////
                <?php if($course_data['img_path'] == null) echo "$('.fileinput-remove-button').click();";?>

            }

            if (class_name_profile.indexOf("active") > 0){   ////////////////////////////Profile////////////////////////////
                $.ajax({
                    url: $('#base_url').val()+'instructor/live/save_course_profile',
                    type: 'POST',
                    data: formData,
                    processData:false,
                    contentType: false,
                    success: function (data, status, xhr) {
                        new PNotify({
                            title: '<?php echo $term['success']; ?>',
                            text: '<?php echo 'Successfully Save Profile'; ?>',
                            type: 'success'
                        });
                    },
                    error: function(){
                        $("#sendBtn").trigger('loading-overlay:hide');
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                            type: 'error'
                        });
                    }
                });
            }

        });
        var $w4finish = $('#w4').find('ul.pager li.finish'),
            $w4validator = $("#w4 form").validate({
                highlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                success: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                    $(element).remove();
                },
                errorPlacement: function (error, element) {
                    element.parent().append(error);
                }
            });

        $w4finish.on('click', function (ev) {
            ev.preventDefault();
            $("#form_course").attr("action", "<?=base_url()?>instructor/live/save_course_profile");
            $("#form_course").submit();
        });


        $('#w4').bootstrapWizard({
            tabClass: 'wizard-steps',
            nextSelector: 'ul.pager li.next',
            previousSelector: 'ul.pager li.previous',
            firstSelector: null,
            lastSelector: null,
            onNext: function (tab, navigation, index, newindex) {
                var validated = $('#w4 form').valid();
                if (!validated) {
                    $w4validator.focusInvalid();
                    return false;
                }
            },
            onTabClick: function (tab, navigation, index, newindex) {
                if (newindex == index + 1) {
                    return this.onNext(tab, navigation, index, newindex);
                } else if (newindex > index + 1) {
                    return false;
                } else {
                    return true;
                }
            },
            onTabChange: function (tab, navigation, index, newindex) {
                var $total = navigation.find('li').length - 1;
                $w4finish[newindex != $total ? 'addClass' : 'removeClass']('hidden');
                $('#w4').find(this.nextSelector)[newindex == $total ? 'addClass' : 'removeClass']('hidden');
            },
            onTabShow: function (tab, navigation, index) {
                var $total = navigation.find('li').length - 1;
                var $current = index;
                var $percent = Math.floor(( $current / $total ) * 100);

                navigation.find('li').removeClass('active');
                navigation.find('li').eq($current).addClass('active');

                $('#w4').find('.progress-indicator').css({'width': $percent + '%'});
                tab.prevAll().addClass('completed');
                tab.nextAll().removeClass('completed');
            }
        });


    }).apply(this, [jQuery]);

    jQuery(document).ready(function() {

        $('[data-plugin-selectTwo]').each(function() {
            var $this = $( this ),
                opts = {};

            var pluginOptions = $this.data('plugin-options');
            if (pluginOptions)
                opts = pluginOptions;

            $this.themePluginSelect2(opts);
        });

        CKEDITOR.on( 'instanceReady', function( ev ) {
            editor = ev.editor;
        });

    });

    $(function() {
        // Modal template
        var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
            '  <div class="modal-content">\n' +
            '    <div class="modal-header">\n' +
            '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
            '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
            '    </div>\n' +
            '    <div class="modal-body">\n' +
            '      <div class="floating-buttons btn-group"></div>\n' +
            '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>\n';

        // Buttons inside zoom modal
        var previewZoomButtonClasses = {
            toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
            fullscreen: 'btn btn-default btn-icon btn-xs',
            borderless: 'btn btn-default btn-icon btn-xs',
            close: 'btn btn-default btn-icon btn-xs'
        };

        // Icons inside zoom modal classes
        var previewZoomButtonIcons = {
            prev: '<i class="icon-arrow-left32"></i>',
            next: '<i class="icon-arrow-right32"></i>',
            toggleheader: '<i class="icon-menu-open"></i>',
            fullscreen: '<i class="icon-screen-full"></i>',
            borderless: '<i class="icon-alignment-unalign"></i>',
            close: '<i class="icon-cross3"></i>'
        };

        // File actions
        var fileActionSettings = {
            zoomClass: 'btn btn-link btn-xs btn-icon',
            zoomIcon: '<i class="icon-zoomin3"></i>',
            dragClass: 'btn btn-link btn-xs btn-icon',
            dragIcon: '<i class="icon-three-bars"></i>',
            removeClass: 'btn btn-link btn-icon btn-xs',
            removeIcon: '<i class="icon-trash"></i>',
            indicatorNew: '<i class="icon-file-plus text-slate"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
        };
        $('.file-input').fileinput({
            browseLabel: 'Browse',
            browseIcon: '<i class="icon-file-plus"></i>',
            uploadIcon: '<i class="icon-file-upload2"></i>',
            removeIcon: '<i class="icon-cross3"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialCaption: "No file selected",
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons,
            fileActionSettings: fileActionSettings
        });
        $(".file-input-overwrite").fileinput({
            browseLabel: 'Browse',
            browseIcon: '<i class="icon-file-plus"></i>',
            uploadIcon: '<i class="icon-file-upload2"></i>',
            removeIcon: '<i class="icon-cross3"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialPreview: [
                "<?php if($course_data['img_path'] != null) echo base_url().$course_data['img_path']; else echo'';?>"
            ],
            initialPreviewConfig: [
                {caption: "<?php if($course_data['img_path'] != null) echo base_url().$course_data['img_path']?>; else echo'';", key: 1, showDrag: false}
            ],
            initialPreviewAsData: true,
            overwriteInitial: true,
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons,
            fileActionSettings: fileActionSettings
        });

    });

    function change_usertable(){
        var status = $("#show_user3").prop("checked");
        if (status == true){
            $("#user_table").css("display","block");
        }else{
            $("#user_table").css("display","none");
        }
    }

</script>

<script>

    add_new_chap = add_new_detail = '';

    $('.create-exam').magnificPopup({
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

    $('.create-quiz').magnificPopup({
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

    $('.modal-create-confirm').click(function (e) {
        e.preventDefault();
        if($('.modal-create-confirm').html().indexOf('<?=$term["create"]?>') >= 0){
            $.ajax({
                url: $('#base_url').val()+'instructor/live/save_exam_page',
                type: 'POST',
                data: {'chapter_id':$('#chapter_id').val(),
                    'course_id':$('#course_id').val(),
                    'exam_id':$('#exam_id').val(),
                    'exam_page_title':$('#exam_page_title').val()
                },
                success: function (data, status, xhr) {
                    new PNotify({
                        title: '<?php echo $term['success']; ?>',
                        text: '<?php echo 'Successfully Save Exam'; ?>',
                        type: 'success'
                    });
                    $.magnificPopup.close();
                    viewList();
                },
                error: function(){
                    $("#sendBtn").trigger('loading-overlay:hide');
                    new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                        type: 'error'
                    });
                }
            });
        }else{
            $.ajax({
                url: $('#base_url').val()+'instructor/live/update_exam_page',
                type: 'POST',
                data: {'page_id':$('#page_id').val(),
                    'exam_id':$('#exam_id').val(),
                    'exam_page_title':$('#exam_page_title').val()
                },
                success: function (data, status, xhr) {
                    new PNotify({
                        title: '<?php echo $term['success']; ?>',
                        text: '<?php echo 'Successfully Save Exam'; ?>',
                        type: 'success'
                    });
                    $.magnificPopup.close();
                    viewList();
                },
                error: function(){
                    $("#sendBtn").trigger('loading-overlay:hide');
                    new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                        type: 'error'
                    });
                }
            });
        }


    })

    $('.modal-create-quiz').click(function (e) {
        e.preventDefault();
        if($('.modal-create-quiz').html().indexOf('<?=$term["create"]?>') >= 0)
        {
            $.ajax({
                url: $('#base_url').val()+'instructor/live/save_quiz_page',
                type: 'POST',
                data: {'chapter_id':$('#chapter_id').val(),
                    'course_id':$('#course_id').val(),
                    'quiz_id':$('#quiz_id').val(),
                    'quiz_page_title':$('#quiz_page_title').val()
                },
                success: function (data, status, xhr) {
                    new PNotify({
                        title: '<?php echo $term['success']; ?>',
                        text: '<?php echo 'Successfully Save Quiz'; ?>',
                        type: 'success'
                    });
                    $.magnificPopup.close();
                    viewList();
                },
                error: function(){
                    $("#sendBtn").trigger('loading-overlay:hide');
                    new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                        type: 'error'
                    });
                }
            });
        }
        else
        {
            $.ajax({
                url: $('#base_url').val()+'instructor/live/update_quiz_page',
                type: 'POST',
                data: {'page_id':$('#page_id').val(),
                    'quiz_id':$('#quiz_id').val(),
                    'quiz_page_title':$('#quiz_page_title').val()
                },
                success: function (data, status, xhr) {
                    new PNotify({
                        title: '<?php echo $term['success']; ?>',
                        text: '<?php echo 'Successfully Save Quiz'; ?>',
                        type: 'success'
                    });
                    $.magnificPopup.close();
                    viewList();
                },
                error: function(){
                    $("#sendBtn").trigger('loading-overlay:hide');
                    new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                        type: 'error'
                    });
                }
            });
        }


    })

    $('.modal-create-dismiss').click(function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    })

    function first_select(){
        pid = $('.st_test_0').first().attr('id');
        $('#'+pid).click();
    }

    $( document ).ready(function() {

        delete_self_page();
        delete_self();

        $('#session_p').val($('#page_id').val());
        $('#session_c').val($('#chapter_id').val());
        formData = "activity=view_chapter_and_page&course_id="+$('#course_id').val();
        view_function(formData, 'view_chapter_and_page', 'all_cp_page');



        $('#text_from_title').on('click', function(){
            pre_title = $('#text_from_title').val();
            $('#set_pre_title').val(pre_title);
        });

        $('.sidemenuhead').on('click', function(){
            formData = "activity=view_chapter";
            view_function(formData, 'view_chapter_page', 'allchapter');
        });

        $('.sidemenuhead').on('click', function(){

            formData = "activity=view_chapter";
            view_function(formData, 'view_chapter', 'allchapter');
        });

    });


    function view_function(formData, functionName, className){

        if(functionName == 'view_chapter_and_page'){
            var url = "<?php echo base_url() ?>instructor/live/"+functionName;
            $.ajax({
                url: url,
                type: 'POST',
                data: {'course_id':$('#course_id').val()},
                success: function(data){
                    loaderStop();
                    $('.'+className).html(data);
                    mysortable();
                    addblackchapter();
                }
            });
        }

        if(functionName == 'view_chapter'){
            var url = "<?php echo base_url() ?>instructor/live/"+functionName;
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(data){
                    loaderStop();
                    $('.'+className).html(data);
                    cid = $('#chapter_id').val();
                    chapter_id = cid;
                    if(cid > 0){
                        $('#'+cid).click();
                    }else{
                        sid = $('input:radio').last().attr('id');
                        $('#'+sid).click();
                    }
                }
            });
        }

        if(functionName == 'view_chapter_page'){
            var url = "<?php echo base_url() ?>instructor/live/"+functionName;
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(data){
                    loaderStop();
                    $('.'+className).html(data);
                    first_select();
                    pid = $('#page_id').val();
                    chapter_id = pid;
                    if(pid > 0){

                        $('#'+pid).click();
                        //$('#page_id').val(0);
                        //clearSeesion = $('#page_id');
                    }
                }
            });
        }

        if(functionName == 'view_exam_page'){
            var url = "<?php echo base_url() ?>instructor/live/"+functionName;
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(data){
                    loaderStop();
                    $('#exam_page_title').val(data.title);
                    for(var i = 0;i < document.getElementById("exam_id").length;i++){
                        if(document.getElementById("exam_id").options[i].value == data.exam_id ){
                            document.getElementById("exam_id").selectedIndex = i;
                        }
                    }
                    $('.modal-create-confirm').html('Update');
                    $('.create-exam').click();
                }
            });
        }

        if(functionName == 'view_quiz_page'){
            var url = "<?php echo base_url() ?>instructor/live/"+functionName;
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(data){
                    loaderStop();
                    $('#quiz_page_title').val(data.title);
                    for(var i = 0;i < document.getElementById("quiz_id").length;i++){
                        if(document.getElementById("quiz_id").options[i].value == data.quiz_id ){
                            document.getElementById("quiz_id").selectedIndex = i;
                        }
                    }
                    $('.modal-create-quiz').html('Update');
                    $('.create-quiz').click();
                }
            });
        }

        if(functionName == 'view_only_chapter_page'){
            var url = "<?php echo base_url() ?>instructor/live/"+functionName;
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(data){
                    $('.'+className).html(data);
                    pid = $('#page_id').val();
                    chapter_id = pid;
                    if(pid > 0){
                        $('#'+pid).click();
                        //$('#page_id').val(0);

                    }

                }
            });
        }

        if (functionName == 'view_only_chapter_page1'){
            var url = "<?php echo base_url() ?>instructor/live/"+functionName;
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(data){
                    $('.'+className).html(data);

                    cid = $('#chapter_id').val();
                    if(cid > 0){
                        $('#chbtn_'+cid).click();
                        //$('#chapter_id').val(0);

                    }
                }
            });
        }

    }

    function single_view_function(formData, functionName, className){
        var url = "<?php echo base_url() ?>instructor/live/"+functionName;
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType : 'json',
            success: function(data) {
                loaderStop();
                $('#text_from_title').val(data.title);
                $('#text_from_title').attr('data-id', data.chapter_id);
                $('#txt_detail_id').val(data.chapter_id);
                $('#chapter_id').val(data.chapter_id);

                chapter_id = data.chapter_id;

//                CKEDITOR.instances['editor1'].setData(data.description);
            }
        });
    }

    function btnCreateChapter(){
        create_type = "chapter";
        $.ajax({
            url: "<?php echo base_url() ?>instructor/live/create_temp_chapter",
            type: 'POST',
            data: {'course_id':$('#course_id').val()},
            dataType : 'json',
            success: function(data){
                //  console.log(data);
                if(data.status == "success"){
                    $('#library_btn').removeClass('hidden');
                    $("#div_container").addClass('hidden');
                    $("#show_library_btn").addClass('hidden');
                    //location.reload();
                    if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
                    $("#w4-content-new-page").addClass("active show");
                    $("#state_now").val('chapter');
                    chaps = $('#new_chap').val();
                    if(chaps){
                        add_new_chap = 'Chapter ';
                        add_new_detail = '';
                    }
                    formData = "activity=view_chapter&add_new_chap="+add_new_chap+"&course_id="+$('#course_id').val();
                    view_function(formData, 'view_chapter', 'allchapter');
                }else{
                    new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                        type: 'error'
                    });
                }
            }
        });
    }

    function btnCreatePage(){
        create_type = "page";
        $.ajax({
            url: '<?php echo base_url() ?>instructor/live/create_temp_page',
            type: 'POST',
            data: {'course_id':$('#course_id').val()},
            dataType : 'json',
            success: function(data){
                // console.log(data);
                if(data.status == "success"){
                    $('#library_btn').removeClass('hidden');
                    $("#div_container").addClass('hidden');
                    $("#show_library_btn").addClass('hidden');

                    if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
                    $("#w4-content-new-page").addClass("active show");
                    $("#state_now").val('page');
                    formData = "activity=view_chapter&course_id="+$('#course_id').val();
                    view_function(formData, 'view_chapter_page', 'allchapter');
                }else{
                    new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                        type: 'error'
                    });
                }
            }
        });

    }

    function btnCreatePageWithID(){
        loaderStart();

        $.ajax({
            url: '<?php echo base_url() ?>instructor/live/create_temp_page_id',
            type: 'POST',
            data: {'parent':$('#chapter_id').val(), 'course_id':$('#course_id').val()},
            dataType : 'json',
            success: function(data){
                loaderStop();
                $("#state_now").val('page');
                if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
                $("#w4-content-new-page").addClass("active show");
                formData = "activity=view_chapter&course_id="+$('#course_id').val();
                view_function(formData, 'view_chapter_page', 'allchapter');

            }
        });

    }

    function btnEditChapter(){

        if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
        $("#w4-content-new-page").addClass("active show");

        $("#state_now").val('chapter');

        chaps = $('#new_chap').val();
        if(chaps){
            add_new_chap = 'Chapter ';
            add_new_detail = '';
        }
        formData = "activity=view_chapter&add_new_chap="+add_new_chap+"&course_id="+$('#course_id').val();
        view_function(formData, 'view_chapter', 'allchapter');

    }

    function btnEditpage(){

        if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
        $("#w4-content-new-page").addClass("active show");
        $("#state_now").val('page');
        formData = "activity=view_chapter&course_id="+$('#course_id').val()
        view_function(formData, 'view_chapter_page', 'allchapter');
    }

    function btnEditexampage(){

        if($("#w4-content-new-page").hasClass("active show")) $("#w4-content").removeClass("active show");
        $("#w4-content").addClass("active show");
        $("#state_now").val('');
        formData = "activity=view_chapter&course_id="+$('#course_id').val()+"&page_id="+$('#page_id').val();
        view_function(formData, 'view_exam_page', 'allchapter');
    }

    function btnEditquizpage(){

        if($("#w4-content-new-page").hasClass("active show")) $("#w4-content").removeClass("active show");
        $("#w4-content").addClass("active show");
        $("#state_now").val('');
        formData = "activity=view_chapter&course_id="+$('#course_id').val()+"&page_id="+$('#page_id').val();
        view_function(formData, 'view_quiz_page', 'allchapter');
    }

    function loaderStart(){
        jQuery("#status").fadeIn();
        jQuery("#preloader").fadeIn();
    }

    function loaderStop(){
        jQuery("#status").fadeOut();
        jQuery("#preloader").delay(1000).fadeOut("slow");
    }

    mysortable();
    function mysortable(){
        $(function() {
            var oldList, newList, item;
            $('.my-sortable').sortable({
                start: function(event, ui) {
                    item = ui.item;
                    newList = oldList = ui.item.parent().parent();
                    ui.item.startPos = ui.item.index();
                },
                stop: function(event, ui) {

                    var chap_id = ui.item.attr('data-cid');
                    var start_pos = ui.item.startPos;
                    var new_pos = ui.item.index();
                    updateChapterPostion(chap_id,start_pos,new_pos);
                },
                change: function(event, ui) {
                    if(ui.sender) newList = ui.placeholder.parent().parent();
                },
                connectWith: ".my-sortable"
            }).disableSelection();
        });

        $(function() {
            var oldList, newList, item;
            $('.my-sortable1').sortable({
                start: function(event, ui) {
                    item = ui.item;
                    newList = oldList = ui.item.parent().parent();
                    ui.item.startPos = ui.item.index();

                    cpList = ui.item.parent().parent().index();
                    ui.item.startpos1 = ui.item.parent().parent().index();
                    //   console.log(ui.item.startpos1);
                },
                stop: function(event, ui) {

                    var newpos1 = ui.item.parent().parent().index();
                    var startpos1 = ui.item.startpos1;
                    var chapid = ui.item.attr('data-cid');
                    var pageid = ui.item.attr('data-id');
                    var startpos = ui.item.startPos;
                    var newpos = ui.item.index();
                    //	console.log(startpos1 +' ==  '+newpos1);
                    if(newpos1 == startpos1){
                        updatePagePostion(pageid,chapid,startpos,newpos);
                    }else{

                        var newchapid = ui.item.parent().parent().attr('data-cid');
                        updatePageOtherChapterPostion(pageid,chapid,newchapid,startpos,newpos);

                    }

                },
                change: function(event, ui) {
                    if(ui.sender) newList = ui.placeholder.parent().parent();
                },
                connectWith: ".my-sortable1"
            }).disableSelection();
        });

        //onhover
        $( ".items" ).hover(
            function() {

                $( this ).prepend( $( '<span style=" width: 20%; float:right; margin-right:-250px; border: 1px solid;margin: auto;padding: 0px 5px 8px 3px; background: #fbfbfb;border-color: #d7d7d7; float:right; margin-left:20px">'+
                    ' <a href="javascript:void(0)" onclick="editFun(this);" style="font-size:10px"><img src="<?php echo base_url()?>assets/img/edit.png" style="width:12%"> Edit Page</a>'+
                    ' <a href="javascript:void(0)" onclick="removeFun(this);" style="font-size:10px"><img src="<?php echo base_url()?>assets/img/garbage.png" style="width:12%">Delete Page</a>'+
                    '</span>' ) );
            }, function() {
                $( this ).find( "span:last" ).remove();
            }
        );

    }

    function editFun(elm){
        loaderStart();
        var pageid = $(elm).closest('li').attr("data-id");
        var chapid = $(elm).closest('li').attr("data-cid");
        if(pageid !='' && pageid > 0)  {

            $('#page_id').val(pageid);
            chapter_id = pageid;

            $.ajax({
                url: $('#base_url').val()+'instructor/live/check_exam_page',
                type: 'POST',
                data: {'page_id':pageid},
                success: function (data, status, xhr) {
                    if(data == '1'){
                        btnEditexampage();
                    }else if(data == '2'){
                        btnEditquizpage();
                    }else{
                        btnEditpage();
                    }
                },
            });


        }else{

            $('#chapter_id').val(chapid);
            chapter_id = chapid;
            btnEditChapter();
        }
    }

    function removeFun(elm){
        loaderStart();
        var pageid = $(elm).closest('li').attr("data-id");
        var chapid = $(elm).closest('li').attr("data-cid");
        if(pageid !='' && pageid > 0)  {
            formData = "activity=remove_page&pid="+pageid+'&cid='+chapid+"&course_id="+$('#course_id').val();
            save_function(formData, 'remove_page', 'ptitle');
        }else{
            formData = "activity=remove_chapter&cid="+chapid+"&course_id="+$('#course_id').val();
            save_function(formData, 'remove_chapter', 'ptitle');
        }
    }

    function copyFun(elm){
        //loaderStart();
        var pageid = $(elm).closest('li').attr("data-id");
        var chapid = $(elm).closest('li').attr("data-cid");
        if(pageid !='' && pageid > 0)  {
            formData = "activity=copied_page&pid="+pageid+"&course_id="+$('#course_id').val();

            save_function(formData, 'copied_page', 'ptitle');
        }else{
            formData = "activity=copied_chapter&cid="+chapid+"&course_id="+$('#course_id').val();

            save_function(formData, 'copied_chapter', 'ptitle');
        }
    }

    function previewFun(elm) {
        var pageid = $(elm).closest('li').attr("data-id");
        var chapid = $(elm).closest('li').attr("data-cid");
        if(pageid !='' && pageid > 0)  {
            $('#page_id').val(pageid);
            chapter_id = pageid;
            btnCreateChapter();
        }else{
            $('#chapter_id').val(chapid);
            chapter_id = chapid;
            btnCreateChapter();
        }
    }

    function view_Pages() {
        if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
        $("#w4-content-new-page").addClass("active show");
        $("#state_now").val('page');
        formData = "activity=view_chapter&course_id="+$('#course_id').val();
        view_function(formData, 'view_only_chapter_page', 'allchapter');
    }

    function view_Chapters(){
        if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
        $("#w4-content-new-page").addClass("active show");
        $("#state_now").val('chapter');
        formData = "activity=view_chapter&course_id="+$('#course_id').val();
        view_function(formData, 'view_only_chapter_page1', 'allchapter');
    }

    function new_page(cid, pid = 0){
        $('input').removeClass('active');
        $('.cptitle_btn').attr('type', 'radio');
        $('.cpPage_btn').attr('type', 'radio');
        $('.cptitle_btn').prop('checked', false);

        $('.cpPage_btn').prop('checked', false);

        $('.page_v').show();
        $('#chbtn_'+cid). prop("checked", true);
        $('#text_from_title').attr('data-id', pid);
        $('#text_from_title').val('Page Title');
//        CKEDITOR.instances['editor1'].setData('Add txt here...');
        //$("#chng_id").attr('onclick','btnCreatePage('+cid+')');
        $('#cp_id').val(cid);
        $('#p_id').val(0);
    }

    function new_page_view(cid, pid = 0){
        $('input').removeClass('active');
        $('.cptitle_btn').attr('type', 'radio');
        $('.cpPage_btn').attr('type', 'radio');
        //$('.cptitle_btn').prop('checked', false);
        $('.cpPage_btn').prop('checked', false);
        //$('.cpPage_btn').prop('checked', false);

        $('.page_v').show();
        $('#chbtn_'+cid). prop("checked", true);
        $('#text_from_title').attr('data-id', pid);
        $('#text_from_title').val('Page Title');
        $('#chapter_id').val(cid);
        chapter_id = cid;

        $('#chbtn_'+cid).addClass('active');
//        CKEDITOR.instances['editor1'].setData('Add txt here...');
        //$("#chng_id").attr('onclick','btnCreatePage('+cid+')');
        $('#cp_id').val(cid);
        $('#p_id').val(0);
    }

    function new_chapter(id){
        btn_func(id);
        var chapter_title = $('#added_'+id).attr('data-title');
        var chapter_detail = $('#added_'+id).attr('data-detail');

        $('#text_from_title').val(chapter_title);
        $('#text_from_title').attr('data-id', id);
        if(chapter_detail){
//            CKEDITOR.instances['editor1'].setData(chapter_detail);
        }

    }

    function show_library_btn_func() {
        $('#library_btn').removeClass('hidden');
        $("#div_container").addClass('hidden');
        $("#show_library_btn").addClass('hidden');
    }

    function page_view(id){
        //chapter_id = id;
        $("#lid").val(0);
        oTable.api().ajax.url(oTable.fnSettings().sAjaxSource).load();
        $('input').removeClass('active');

        $('.cptitle_btn').attr('type', 'radio');
        $('.cpPage_btn').attr('type', 'radio');

        $('.cptitle_btn').prop('checked', false);

        //$('.cptitle_btn').prop('checked', false);
        //$('.cpPage_btn').prop('checked', false);
        $('.page_v').show();
        $('#page_id').val(id);
        $('#p_id').val(id);
        pageTitle = $('#'+id).attr('data-title');
        cid = $('#'+id).attr('data-cid');
        $('#'+id).addClass('active');
        pageDetail = $('#'+id).attr('data-detail');
        $('#text_from_title').attr('data-id', id);
        $('#text_from_title').val(pageTitle);
        $('#chapter_id').val(cid);
        chapter_id = cid;
        $('#cp_id').val(cid);

        create_type = "page";


//        CKEDITOR.instances['editor1'].setData(pageDetail);
        library_id = $('#'+id).attr('data-library');
        var html_container = "<div class='whitePanel'><div class='book_container'><div id='book'></div></div></div>";

        $.ajax({
            url: '<?php echo base_url() ?>instructor/library/getPathById',
            type: 'POST',
            data: {'id': library_id},
            success: function (data, status, xhr) {
                if(data != "" && data != null){
                    $("#div_container").html(html_container);
                    $('#library_btn').addClass('hidden');
                    $("#div_container").removeClass('hidden');
                    $("#show_library_btn").removeClass('hidden');
                    if (data.indexOf(".pdf") > 0){
                        $("#div_container").html("<iframe style='width: 100%' id='course_container' src = "+'<?php echo base_url()?>instructor/flipbook/view_book/'+library_id+"></iframe>");
                    }else{
                        $("#div_container").html("<iframe style='width: 100%' id='course_container' src = "+'<?php echo base_url()?>'+data+"></iframe>");
                    }
                }else{
                    $('#library_btn').removeClass('hidden');
                    $("#div_container").addClass('hidden');
                    $("#show_library_btn").addClass('hidden');
                }

            },

        });


    }

    function chapter_view(cid){

        create_type = "chapter";
        chapter_id = cid;
        $("#lid").val(0);
        oTable.api().ajax.url(oTable.fnSettings().sAjaxSource).load();
        btn_func(cid);
        loaderStart();
        formData = "activity=select_chapter&cid="+cid+"&course_id="+$('#course_id').val();
        single_view_function(formData, 'single_view_chapter', 'ch_detail');
        //$("#chng_id").attr('onclick','btnCreatePage('+cid+')');
        library_id = $('#'+cid).attr('data-library');
        var html_container = "<div class='whitePanel'><div class='book_container'><div id='book'></div></div></div>";

        $.ajax({
            url: '<?php echo base_url() ?>instructor/library/getPathById',
            type: 'POST',
            data: {'id': library_id},
            success: function (data, status, xhr) {
                if(data != "" && data != null){
                    $("#div_container").html(html_container);
                    $('#library_btn').addClass('hidden');
                    $("#div_container").removeClass('hidden');
                    $("#show_library_btn").removeClass('hidden');
                    if (data.indexOf(".pdf") > 0){
                        $("#div_container").html("<iframe style='width: 100%' id='course_container' src = "+'<?php echo base_url()?>instructor/flipbook/view_book/'+library_id+"></iframe>");
                    }else{
                        $("#div_container").html("<iframe style='width: 100%' id='course_container' src = "+'<?php echo base_url()?>'+data+"></iframe>");
                    }
                }else{
                    $('#library_btn').removeClass('hidden');
                    $("#div_container").addClass('hidden');
                    $("#show_library_btn").addClass('hidden');
                }

            },

        });
    }

    function page_view_demo_page(id){
        $('#p_id').val(id);
        pageTitle = $('#'+id).attr('data-title');
        cid = $('#'+id).attr('data-cid');
        $('#chbtn_'+cid). prop("checked", true);

        pageDetail = $('#'+id).attr('data-detail');

        $('#text_from_title').attr('data-id', id);
        $('#text_from_title').val(pageTitle);
        $('#cp_id').val(cid);
        $('#txt_form_detail').html(pageDetail);


    }

    function page_view_demo_chpater(id){
        $('input').removeClass('active');

        $('.cptitle_btn').attr('type', 'radio');
        $('.cpPage_btn').attr('type', 'radio');
        $('.cptitle_btn').prop('checked', false);
        $('.cpPage_btn').prop('checked', false);

        $('#'+id).addClass('active');

        ctitle = $('#'+id).attr('data-title');
        cdetail = $('#'+id).attr('data-detail');

        $('#text_from_title').val(ctitle);
        $('#txt_from_detail').html(cdetail);

    }

    function updatePagePostion(pageid,chapid,startpos,newpos){
        //loaderStart();
        formData = "activity=page_moved&pid="+pageid+'&cid='+chapid+'&startpos='+startpos+'&newpos='+newpos+"&course_id="+$('#course_id').val();
        save_function(formData, 'page_moved', 'ptitle');
    }

    function updateChapterPostion(chapid,startpos,newpos){
        //	loaderStart();
        formData = 'activity=chapter_moved&cid='+chapid+'&startpos='+startpos+'&newpos='+newpos+"&course_id="+$('#course_id').val();
        save_function(formData, 'chapter_moved', 'ptitle');
    }

    function updatePageOtherChapterPostion(pageid,chapid,newchapid,startpos,newpos){
        //	loaderStart();
        formData = "activity=page_moved&pid="+pageid+'&cid='+chapid+'&startpos='+startpos+'&newpos='+newpos+'&newcid='+newchapid+"&course_id="+$('#course_id').val();
        save_function(formData, 'page_chapter_moved', 'ptitle');

    }

    function remove_chapter(cid){
        loaderStart();
        formData = "activity=remove_chapter&cid="+cid+"&course_id="+$('#course_id').val();
        save_function(formData, 'remove_chapter', 'ptitle');
    }

    function remove_page(pid, cid){
        loaderStart();
        formData = "activity=remove_page&pid="+pid+'&cid='+cid+"&course_id="+$('#course_id').val();
        save_function(formData, 'remove_page', 'ptitle');
    }

    function save_function(formData, functionName, className){

        if($('#state_now').val() == 'page'){
            var url = "<?php echo base_url() ?>instructor/live/"+functionName;
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType : 'json',
                success: function(data){
                    loaderStop();
                    if(data.status == "success"){
                        // $('.'+className).html(data.response);
                        formData = "activity=view_chapter&course_id="+$('#course_id').val();;
                        view_function(formData, 'view_chapter_page', 'allchapter');

                    }else{
                        //console.log(data.msg);
                    }
                }

            });

        }
        if($('#state_now').val() == 'chapter'){
            var url = "<?php echo base_url() ?>instructor/live/"+functionName;
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType : 'json',
                success: function(data){
                    loaderStop();
                    if(data.status == "success"){
                        //$('.'+className).html(data.response);
                        formData = "activity=view_chapter&course_id="+$('#course_id').val();;
                        view_function(formData, 'view_chapter', 'allchapter');
                    }else{
                        console.log(data.msg);
                    }
                }
            });
        }
        if($('#state_now').val() == ''){
            if($("li").hasClass("box_area2")){
                $('.box_area2').removeClass('box_area1');
                $('.box_area2').html('');
            }
            var url = "<?php echo base_url() ?>instructor/live/"+functionName;
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType : 'json',
                success: function(data){
                    loaderStop();
                    if(data.status == "success"){
                        formData = "activity=view_chapter_and_page&course_id="+$('#course_id').val();
                        view_function(formData, 'view_chapter_and_page', 'all_cp_page');
                    }else{
                    }
                }
            });
        }

    }

    function delete_self(){
        $.ajax({
            url: '<?php echo base_url() ?>instructor/live/delete_self',
            type: 'POST',
            data: {'create_chapter':'chapter', 'course_id':$('#course_id').val()},
            dataType : 'json',
            success: function(data){
                if(data.success === "true"){
                    new PNotify({
                        title: '<?php echo $term['success']; ?>',
                        text: '<?php echo $term['succesfullyadded']; ?>',
                        type: 'success'
                    });
                }else{
                    new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: 'There is some error.',
                        type: 'failed'
                    });
                }
            }
        });
    }

    function delete_self_page(){
        $.ajax({
            url: '<?php echo base_url() ?>instructor/live/delete_self_page',
            type: 'POST',
            data: {'create_chapter':'chapter','course_id':$('#course_id').val()},
            dataType : 'json',
            success: function(data){
                if(data.success === "true"){
                    new PNotify({
                        title: '<?php echo $term['success']; ?>',
                        text: '<?php echo $term['succesfullyadded']; ?>',
                        type: 'success'
                    });
                }else{
                }
                new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: 'There is some error.',
                    type: 'failed'
                });
            }
        });
    }

    function save_page(id){
        loaderStart();
        pageTitle = $('#'+id).val();
        pid = $('#'+id).attr('data-id');
        cid = $('#cp_id').val();
        formData = "activity=add_page&page_title="+pageTitle+"&cid="+cid+"&pid="+pid+"&course_id="+$('#course_id').val();
        save_function(formData, 'save_page', 'ptitle');
    }

    function save_chapter(id){
        loaderStart();
        chapter = $('#'+id).val();
        cid = $('#'+id).attr('data-id');
        pre_title = $('#set_pre_title').val();

        formData = "activity=add_chapter&title="+chapter+"&cid="+cid+"&pre_title="+pre_title+"&course_id="+$('#course_id').val();
        save_function(formData, 'save_chapter', 'ctitle');
    }

    function save_now(){
        loaderStart();

        var url = "<?php echo base_url() ?>instructor/live/update_chapter_detail";
        $.ajax({
            url: url,
            type: 'POST',
            data: {'course_id':$('#course_id').val()},
            dataType : 'json',
            success: function(data){
                new PNotify({
                    title: '<?php echo $term['success']; ?>',
                    text: '<?php echo $term['succesfullyadded']; ?>',
                    type: 'success'
                });
                page_updated();
            }
        });
    }

    function addblackchapter(){
        formData = "activity=page_available&course_id="+$('#course_id').val();
        var url = "<?php echo base_url() ?>instructor/live/page_available";
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType : 'json',
            success: function(data){
                console.log(data);
                if(data.status == 'success'){
                    if($("li").hasClass("box_area2")){
                        $('.box_area2').addClass('box_area1');
                        $('.box_area2').html('<p style="margin-top: 22px;"> <img src="<?php echo base_url() ?>assets/img/arrow_left.png" style="height:24px;width:24px;">Click or drag &amp; drop a page type from the left menu to add pages</p>');
                    }
                }else{
                    $('.box_area2').removeClass('box_area1');
                    $('.box_area2').html('');
                }
            }
        });
    }

    function viewList() {
        window.location.href= '<?php echo base_url() ?>instructor/live/edit_course_tab/'+$("#course_id").val()+'/2';
    }

    function btn_func(id){
        $('input').removeClass('active');
        $('.cptitle_btn').attr('type', 'radio');
        $('.cpPage_btn').attr('type', 'radio');

        //$('.cptitle_btn').prop('checked', false);
        //$('.cpPage_btn').prop('checked', false);
        $('#'+id).addClass('active');
    }

    function page_updated(){
        formData = "activity=update_chapterpage_detail&course_id="+$('#course_id').val();
        var url = "<?php echo base_url() ?>instructor/live/update_page_detail";
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType : 'json',
            success: function(data){
                loaderStop();
                new PNotify({
                    title: '<?php echo $term['success']; ?>',
                    text: '<?php echo $term['succesfullyadded']; ?>',
                    type: 'success'
                });
                viewList();
            }
        });
    }

    function library_reload(id){
        $("#lid").val(id);
        oTable.api().ajax.url(oTable.fnSettings().sAjaxSource).load();
    }

    function library_insert(id){
        if ($("#chapter_id").val() == 0 && $("#chapter_id").val() == "" && $("#page_id").val() == 0 && $("#page_id").val() == ""){
            swal({
                text: "At first you have to add a chapter or page!",
                icon: "warning"
            });
            return;
        }else{
            $("#library_id").val(id);
            if (create_type == "chapter"){
                $("#select_id").val($("#chapter_id").val());
            }else{
                $("#select_id").val($("#page_id").val());
            }
            var library_form_data = new FormData($("#form_library_insert")[0]);
            $.ajax({
                url:  '<?=base_url()?>instructor/live/insert_library',
                type: 'POST',
                data: library_form_data,
                processData:false,
                contentType: false,
                success: function(data){
                    if(data.success === "true"){
                        new PNotify({
                            title: '<?php echo $term['success']; ?>',
                            text: '<?php echo $term['succesfullyadded']; ?>',
                            type: 'success'
                        });

                    }else{
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: 'There is some error.',
                            type: 'failed'
                        });
                    }

                }
            });
            $("#library_modal").modal("hide");
            save_now();
        }
    }

    jQuery(document).ready(function() {

        // Generate content for a column
        var table = $('#datatable').DataTable({
            "bServerSide": true,
            "bProcessing": true,

            "aoColumns": [
                {
                    "sTitle" : "#", "mData": "","sWidth": 30,
                    mRender: function (data, type, row, pos) {
                        var info = table.page.info();
                        return Number(info.page) * Number(info.length) + Number(pos.row) + 1;
                    }
                },
                { "sTitle" : "<?=$term["name"]?>", "mData": "", "sWidth": 200,
                    mRender: function (data, type, row) {
                        if(row.file_type == 'DIRECTORY'){
                            return '<a onclick="library_reload('+row.id+')">'+row.name+'</a>';
                        } else {
                            return '<a>'+row.name+'</a>';
                        }
                    }
                },
                { "sTitle" : "<?=$term["filetype"]?>", "mData": "file_type", "sWidth": 200 },
                { "sTitle" : "<?=$term["date"]?>", "mData": "reg_date", "sWidth": 200 },
                {
                    "sTitle" : "Actions", "mData": "", "sWidth": 300,
                    mRender: function (data, type, row) {
                        if(row.file_type == 'DIRECTORY'){
                            return '';
                        } else {
                            return '<a onclick="library_insert('+row.id+')" class="btn btn-default"><?=$term["add"]?></a>';
                        }
                    }
                }
            ],
            "fnServerParams": function (aoData) {
                aoData.push({"name": "parent_id", "value": $("#lid").val()});
                return aoData;
            },
            "fnServerData": function (sSource, aoData, fnCallback){
                $.ajax({
                    "dataType": "json",
                    "type": "POST",
                    "url": sSource,
                    "data": aoData,
                    "success": fnCallback
                });
            },
            "bAutoWidth": true,
            "sAjaxSource": "<?=base_url()?>instructor/library/view",
            "sAjaxDataProp": "data",
            scrollX: true,
            scrollCollapse: true,
            "order": [
                [1, "asc"]
            ],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ideferLoading": 1,
            "bDeferRender": true,

            initComplete: function () {
                oTable = this;
            }
        });
    });

</script>