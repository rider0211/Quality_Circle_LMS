<style>
    .directory-td{
        background-color: #d3dbe6;
    }
    .file-td{
        background-color: #d6bb6d;
    }
</style>


<section role="main" class="content-body">
    <header class="page-header">
        <h2><?=$term["librarymanagement"]?></h2>

<div class="right-wrapper">
</div>
</header>

<input type="hidden" id="base_url" value="<?= base_url()?>">
<!-- start: page -->
<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header">
                <h2 class="card-title"><?=$term["librarylist"]?></h2>
            </header>
            <div class="card-body">
                <div class="">
                    <?php if($parent_id  == 0) {?>
                        <a class="create-directory" style="display: none;" href="#modalFormCreateDirectory"></a>
                        <a class="upload-file" style="display: none;" href="#modalFormUploadFile"  data-loading-overlay="" data-loading-overlay-options="{ 'startShowing': false }"></a>
                        <a class="create-manual" style="display: none;" href="#modalFormCreateManual"></a>
                        <a class="modal-with-form" href="javascript:check_add('create-directory')">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"> <i class="fa fa-plus"></i> <?=$term["createdirectory"]?></button>
                        </a>
                        <a class="modal-with-form insert-directory" href="">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" > <i class="fa fa-plus"></i> <?=$term["insertdirectory"]?></button>
                        </a>
                        <a class="modal-with-form copy-directory" href="">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" > <i class="fa fa-plus"></i> Copy File to Directory</button>
                        </a>
                        <a class="modal-with-form" href="javascript:check_add('upload-file')" data-loading-overlay="" data-loading-overlay-options="{ 'startShowing': false }">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"> <i class="fa fa-plus"></i> <?=$term["uploadfile"]?></button>
                        </a>
                        <a class="modal-with-form" href="javascript:check_add('create-manual')">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"> <i class="fa fa-plus"></i> <?=$term["createmanual"]?></button>
                        </a>
                        <a class="btn btn-primary modal-with-form merge-doc mb-1 mt-0 mr-1" href="" data-loading-overlay="" data-loading-overlay-options="{ 'startShowing': false }">
                            <?=$term["mergedoc"]?>
                        </a>
                        <a class="btn btn-primary modal-with-form assign-user mb-1 mt-0 mr-1" href="" >
                            Assign User
                        </a>
                    <?php }else{?>



                        <a class="modal-with-form " href="<?= base_url()?>admin/library">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default"> <i class="fa fa-table"></i> <?=$term["library"]?></button>
                        </a>
                        <a class="modal-with-form upload-file" href="#modalFormUploadFile">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"> <i class="fa fa-plus"></i> <?=$term["uploadfile"]?></button>
                        </a>
                        <a class="modal-with-form" href="<?= base_url()?>admin/library/create_manual_dir/<?php echo $parent_id?>">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add1"> <i class="fa fa-plus"></i> <?=$term["createmanual"]?></button>
                        </a>
                        <a class="btn btn-primary modal-with-form merge-doc mb-1 mt-0 mr-1" href="" data-loading-overlay="" data-loading-overlay-options="{ 'startShowing': false }">
                            <?=$term["mergedoc"]?>
                        </a>
                        <a class="btn btn-primary modal-with-form assign-user mb-1 mt-0 mr-1" href="" >
                            Assign User
                        </a>
                    <?php }?>

                    <div id="modalFormCreateManual" class="modal-block modal-block-primary mfp-hide">
                        <section class="card">
                            <header class="card-header">
                                <h2 class="card-title">Choose Type</h2>
                            </header>
                            <footer class="card-footer">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a class="modal-with-form" href="<?= base_url()?>admin/library/create_manual">
                                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"> <i class="fa fa-plus"></i>Create By Original Editor</button>
                                        </a>
                                        <a class="modal-with-form" href="<?= base_url()?>admin/library/create_contract">
                                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"> <i class="fa fa-plus"></i>Create By Ckeditor</button>
                                        </a>
                                        <button class="btn btn-default modal-dismiss" onclick="$('#modalFormCreateManual').magnificPopup('close');"><?=$term["cancel"]?></button>
                                    </div>
                                </div>
                            </footer>
                        </section>
                    </div>

                    <div id="modalFormCreateDirectory" class="modal-block modal-block-primary mfp-hide">
                        <form id="create-directory-form" action="" method="POST" novalidate="novalidate">
                            <section class="card">
                                <header class="card-header">
                                    <h2 class="card-title"><?=$term["createdirectory"]?></h2>
                                </header>
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["directoryname"]?></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="new_directory" name="new_directory" class="form-control">
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
                        </form>
                    </div>

                    <div id="modalFormUploadFile" class="modal-block modal-block-primary mfp-hide">
                        <form id="upload-file-form" action="" method="POST" novalidate="novalidate">
                            <input type="hidden" id="parent_id" name="parent_id" value="<?= $parent_id?>">
                            <section class="card">
                                <header class="card-header">
                                    <h2 class="card-title"><?=$term["uploadfile"]?></h2>
                                </header>
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["name"]?></label>
                                        <div class="col-sm-9">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="input-append">
                                                    <div class="uneditable-input">
                                                        <i class="fas fa-file fileupload-exists"></i>
                                                        <span class="fileupload-preview"></span>
                                                    </div>
                                                    <span class="btn btn-default btn-file">
                                                            <span class="fileupload-exists"><?=$term["change"]?></span>
                                                        <span class="fileupload-new"><?=$term["selectfile"]?></span>
                                                        <input type="file" name="upload_file" id="upload_file"/>
                                                        </span>
                                                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?=$term["remove"]?></a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <footer class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button class="btn btn-primary modal-upload-confirm"><?=$term["upload"]?></button>
                                            <button class="btn btn-default modal-upload-dismiss"><?=$term["cancel"]?></button>
                                        </div>
                                    </div>
                                </footer>
                            </section>
                        </form>
                    </div>

                    <a class="modal-with-form rename" href="#modalFormRename" hidden>
                        <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"> <i class="fa fa-plus"></i> <?=$term["rename"]?></button>
                    </a>

                    <div id="modalFormRename" class="modal-block modal-block-primary mfp-hide">
                        <form id="rename-form" action="" method="POST" novalidate="novalidate">
                            <input type="hidden" id="id" name="id" class="form-control">
                            <section class="card">
                                <header class="card-header">
                                    <h2 class="card-title"><?=$term["rename"]?></h2>
                                </header>
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["name"]?></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="name" name="name" class="form-control">
                                        </div>

                                    </div>

                                </div>
                                <footer class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button class="btn btn-primary modal-rename-confirm"><?=$term["rename"]?></button>
                                            <button class="btn btn-default modal-create-dismiss"><?=$term["cancel"]?></button>
                                        </div>
                                    </div>
                                </footer>
                            </section>
                        </form>
                    </div>

                    <a class="modal-with-form watermark" href="#modalFormWatermark" hidden>
                        <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-watermark"> <i class="fa fa-plus"></i> <?=$term["watermark"]?></button>
                    </a>

                    <div id="modalFormWatermark" class="modal-block modal-block-primary mfp-hide">
                    <div id="LoadingOverlayApi" style="background-color: #FFF; " data-loading-overlay>
                        <form id="watermark-form" action="" method="POST" novalidate="novalidate">
                            <input type="hidden" id="url" name="url" class="form-control">
                            <input type="hidden" id="html_url" name="html_url" class="form-control">
                            <input type="hidden" id="library_type" name="library_type" class="form-control">
                            <input type="hidden" id="pdf_id" name="pdf_id" class="form-control">
                            <section class="card">
                                <header class="card-header">
                                    <h2 class="card-title"><?=$term["watermark"]?></h2>
                                </header>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["name"]?></label>
                                        <div class="col-sm-9">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="input-append">
                                                    <div class="uneditable-input">
                                                        <i class="fas fa-file fileupload-exists"></i>
                                                        <span class="fileupload-preview"></span>
                                                    </div>
                                                    <span class="btn btn-default btn-file">
                                                            <span class="fileupload-exists"><?=$term["change"]?></span>
                                                        <span class="fileupload-new"><?=$term["selectfile"]?></span>
                                                        <input type="file" name="upload_watermark_file" id="upload_watermark_file" required/>
                                                        </span>
                                                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?=$term["remove"]?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label text-lg-right pt-2">Header Text: </label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="header_text" id="header_text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label text-lg-right">Header Align: </label>
                                       
                                        <div class="col-lg-8">
                                        <div class="radio-custom radio-primary">                                  
                                             
                                                <input type="radio" name="header_align" value="L" class="styled">
                                                 <label class="radio-inline radio-right">Left
                                              </label>
                                          </div>
                                          <div class="radio-custom radio-primary">
                                          
                                            <input type="radio" name="header_align" value="C" class="styled">
                                            <label class="radio-inline radio-right">Center
                                          </label>
                                          </div>
                                          <div class="radio-custom radio-primary">
                                          
                                            <input type="radio" name="header_align" value="R" class="styled">
                                            <label class="radio-inline radio-right">Right
                                          </label>
                                          </div>
                                          <div class="radio-custom radio-primary">
                                          
                                            <input type="radio" name="header_align" value="H" id="header_hide" class="styled" checked="checked">
                                            <label class="radio-inline radio-right">Hide
                                          </label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label text-lg-right pt-2">Footer Text: </label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" id="footer_text" name="footer_text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label text-lg-right">Footer Align: </label>
                                       
                                        <div class="col-lg-8">
                                        <div class="radio-custom radio-primary">                                  
                                             
                                                <input type="radio" name="footer_align" value="L" class="styled">
                                                 <label class="radio-inline radio-right">Left
                                              </label>
                                          </div>
                                          <div class="radio-custom radio-primary">
                                          
                                            <input type="radio" name="footer_align" value="C" class="styled">
                                            <label class="radio-inline radio-right">Center
                                          </label>
                                          </div>
                                          <div class="radio-custom radio-primary">
                                          
                                            <input type="radio" name="footer_align" value="R" class="styled">
                                            <label class="radio-inline radio-right">Right
                                          </label>
                                          </div>
                                          <div class="radio-custom radio-primary">
                                          
                                            <input type="radio" name="footer_align" id="footer_hide" value="H" class="styled" checked="checked">
                                            <label class="radio-inline radio-right">Hide
                                          </label>
                                          </div>
                                        </div>
                                    </div>                       

                                </div>
                                <footer class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button class="btn btn-primary modal-watermark-confirm"><?=$term["watermark"]?></button>
                                            <button class="btn btn-default modal-create-dismiss"><?=$term["cancel"]?></button>
                                        </div>
                                    </div>
                                </footer>
                            </section>
                        </form>
                    </div>
                    </div>

                    <a class="modal-with-form merge" href="#modalFormMerge" hidden>
                        <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-merge"> <i class="fa fa-plus"></i> <?=$term["rename"]?></button>
                    </a>

                    <div id="modalFormMerge" class="modal-block modal-block-primary mfp-hide">
                        <form id="merge-form" action="" method="POST" novalidate="novalidate">
                            <section class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <input type="hidden" id="merge_num" name="merge_num">
                                        <label class="col-sm-3 control-label text-lg-right pt-2">Merge Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="merge_name" name="merge_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-1 control-label pt-2"></label>
                                        <label class="col-sm-7 control-label pt-2">Merge List</label>
                                        <label class="col-sm-4 control-label pt-2">Order Num</label>
                                    </div>
                                    <div class="form-group" id="merge-list">

                                    </div>

                                </div>
                                <footer class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button class="btn btn-primary merge-form-confirm">Merge</button>
                                            <button class="btn btn-default modal-create-dismiss">Cancel</button>
                                        </div>
                                    </div>
                                </footer>
                            </section>
                        </form>
                    </div>

                </div>
                <table class="table table-responsive-md table-hover mb-0" id="datatable" data-loading-overlay>
                </table>
            </div>
        </section>
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="userModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <form id = "assign_users" action="<?=base_url()?>admin/library/assign_user" method="POST" novalidate="novalidate">
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Users</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="file_id" name = "file_id">
                    <table class="table table-responsive-md table-striped table-bordered mb-0" id="datatable_user" >
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" >Add</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
          
        </div>
    </div>

<!-- end: page -->
</section>

<script>

     var enroll_users = '';
    $('#datatable_user').dataTable({

        "ordering": true,
        "info": true,
        "searching": true,

        "ajax": {
            "type": "POST",
            "async": true,
            "url": "<?=base_url()?>instructor/live/getuser",
            "data": 'search_user:',
            "dataSrc": "data",
            "dataType": "json",
            "cache":    false,
        },
        "columnDefs": [{
            "targets": [0],
            "createdCell": function (td, cellData, rowData, row, col) {
                if (enroll_users.indexOf(cellData) > 0){
                    $(td).html('<input type="checkBox" name="user[]" checked value="'+rowData.id+'">');
                }else{
                    $(td).html('<input type="checkBox" name="user[]" value="'+rowData.id+'">');
                }
            }
        } ],
        "columns": [
            { "title": "", "data": "id", "class": "text-left", "width":10 },
            { "title": "#", "data": "no", "class": "center", "width":50 },
            { "title": "<?=$term["name"]?>", "data": "fullname", "class": "text-left", "width":200 }
        ],

        "scrollY": false,
        "scrollX": true,
        "scrollCollapse": false,
        "jQueryUI": true,

        "paging": false,
        "pagingType": "full_numbers",
        "pageLength": 10, // default record count per page

        dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
        bProcessing: true,
    });

    $('.assign-user').click(function (e) {
        e.preventDefault();
        var selected = $table.DataTable().column(0).checkboxes.selected();

        var data = $table.DataTable().data(); 

        var num_dir = 0;
        var dir_id = 0;
        var file_ids = new Array();
        var file_id = new Array();

        $.each(selected, function(index, rowId){
            if(data[rowId-1].file_type === 'DIRECTORY'){
                num_dir++;
                dir_id = data[rowId-1].id;
                file_id.push(data[rowId-1].id);
            }else if(data[rowId-1].file_type === 'pdf'){
                num_dir++;
                dir_id = data[rowId-1].id;
                file_id.push(data[rowId-1].id);
            }else if(data[rowId-1].file_type === 'JPG'){
                num_dir++;
                dir_id = data[rowId-1].id;
                file_id.push(data[rowId-1].id);
            }
            else{
                file_ids.push(data[rowId-1].id);
                file_id.push(data[rowId-1].id);
            }

        });
        if(num_dir !== 1){
            new PNotify({
                title: 'Failed',
                text: 'Select Only One Directory and File.',
                type: 'danger'
            });
            return;
        }else{
            $('.file_id').val(file_id);
            $('#userModal').modal('show'); 
        }
    });

    var $table = $('#datatable');

    $('.create-directory').magnificPopup({
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


    $('.rename').magnificPopup({
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

    $('.watermark').magnificPopup({
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


    $('.merge').magnificPopup({
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

    $('.upload-file').magnificPopup({
        type: 'inline',
        preloader: false,
        modal: true,

        // When elemened is focused, some mobile browsers in some cases zoom in
        // It looks not nice, so we disable it:
        callbacks: {
            beforeOpen: function() {
                $('.fileupload-exists').click();
            }
        }
    });


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

    $('.modal-create-confirm').click(function (e) {
        e.preventDefault();
        var formData = new FormData($('#create-directory-form')[0]);
        if ($('#new_directory').val() == '') {
            alert('Insert Directory name');
            return;
        }
        //import-form
        $.ajax({
            url: $('#base_url').val()+'admin/library/createDirectory',
            type: 'POST',
            data: formData,
            processData:false,
            contentType: false,
            success: function (data, status, xhr) {
                alert(data.success);
                if(data.success){
                    new PNotify({
                        title: 'Success',
                        text: data.msg,
                        type: 'success'
                    });
                    $table.DataTable().ajax.reload('', false);
                    $.magnificPopup.close();
                }else{
                    new PNotify({
                        title: 'Failed',
                        text: data.msg,
                        type: 'error'
                    });
                }
            },
            error: function(){

                new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                    type: 'error'
                });
                $.magnificPopup.close();
            }
        });

    });

    $('.insert-directory').click(function (e) {
        e.preventDefault();

        var selected = $table.DataTable().column(0).checkboxes.selected();

        var data = $table.DataTable().data();

        var num_dir = 0;
        var dir_id = 0;
        var file_ids = new Array();

        $.each(selected, function(index, rowId){
            if(data[rowId-1].file_type === 'DIRECTORY'){
                num_dir++;
                dir_id = data[rowId-1].id;
            }else{
                file_ids.push(data[rowId-1].id);
            }

        });

        if(num_dir !== 1){
            new PNotify({
                title: 'Failed',
                text: 'Select Only One Directory and File.',
                type: 'danger'
            });
            return;
        }

        $.ajax({
            url: $('#base_url').val()+'admin/library/insert_doc',
            type: 'POST',
            data: {'id1': dir_id, 'id2':file_ids},
            success: function (data, status, xhr) {
                $table.DataTable().ajax.reload('', false);
                new PNotify({
                    title: 'Success',
                    text: 'Success Insert.',
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

    });

    $('.copy-directory').click(function (e) {
        e.preventDefault();
        var selected = $table.DataTable().column(0).checkboxes.selected();

        var data = $table.DataTable().data();

        var num_dir = 0;
        var dir_id = 0;
        var file_ids = new Array();

        $.each(selected, function(index, rowId){
            if(data[rowId-1].file_type === 'DIRECTORY'){
                num_dir++;
                dir_id = data[rowId-1].id;
            }else{
                file_ids.push(data[rowId-1].id);
            }

        });
        if(num_dir !== 1){
            new PNotify({
                title: 'Failed',
                text: 'Select Only One Directory and File.',
                type: 'danger'
            });
            return;
        }
          $.ajax({
          url: "<?= base_url()?>admin/library/check_add_view",
          type: 'POST',
          processData:false,
          contentType: false,
          success: function (data, status, xhr) {
            if(data.success){
                    $.ajax({
                    url: $('#base_url').val()+'admin/library/copy_doc',
                    type: 'POST',
                    data: {'id1': dir_id, 'id2':file_ids},
                    success: function (data, status, xhr) {
                        $table.DataTable().ajax.reload('', false);
                        new PNotify({
                            title: 'Success',
                            text: 'Success Insert.',
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
            }else{
              swal({
                text: data.msg,
                icon:"warning",
              }).then((willDelete) => {
                    if (willDelete) {
                      location.href="<?php echo base_url('pricing')?>";
                    }
                  });
            }
          },
          error: function(){
           swal({
                text: "Add Error",
                icon:"warning",
            })
          }
        });








    });

    $('.merge-doc').click(function (e) {
        e.preventDefault();
        var selected = $table.DataTable().column(0).checkboxes.selected();

        var data = $table.DataTable().data();

        var num_dir = 0;
        var num_file = 0;
        var ids = [];
        var names = [];

        $.each(selected, function(index, rowId){
            if(data[rowId-1].name.indexOf('.pdf') == -1){
                new PNotify({
                    title: 'warning',
                    text: 'Select Only Pdf file.',
                    type: 'danger'
                });
            }else{
                ids.push(data[rowId-1].id);
                names.push(data[rowId-1].name);
            }

        });

        if(ids.length == 0){
            new PNotify({
                title: 'warning',
                text: 'Select Pdf files.',
                type: 'danger'
            });
        }
        else{


            var merge_html = "";
            for (var i = 0; i < ids.length; i++){
                merge_html+="<div class=\"form-group row\"><label class=\"col-sm-1 control-label pt-2\"></label>" +
                    "<label class=\"col-sm-7 control-label pt-2\">"+names[i]+"</label>" +
                    "<input type=\"hidden\" name=\"merge_ids[]\" value=\""+ ids[i] +"\">" +
                    "<input type=\"text\" name=\"merge_order[]\" class=\"col-sm-2 form-control pt-2\">" +
                    "<label class=\"col-sm-1 control-label pt-2\"></label></div>"
            }
            $("#merge-list").html(merge_html);

            $("#btn-merge").click();
        }


    });

    $('.merge-form-confirm').click(function (e) {
        e.preventDefault();
        $(".merge-doc").trigger('loading-overlay:show');
        var formData = new FormData($('#merge-form')[0]);
        $.ajax({
            url: $('#base_url').val()+'admin/library/merge_doc',
            type: 'POST',
            data: formData,
            processData:false,
            contentType: false,
            success: function (data, status, xhr) {
                $(".merge-doc").trigger('loading-overlay:hide');
                $.magnificPopup.close();
                $table.DataTable().ajax.reload('', false);
                new PNotify({
                    title: 'Success',
                    text: 'Success Merge.',
                    type: 'success'
                });

            },
            error: function(){
                $(".merge-doc").trigger('loading-overlay:hide');
                $.magnificPopup.close();
                new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                    type: 'error'
                });
            }
        });
    });

    $('.modal-upload-confirm').click(function (e) {
        e.preventDefault();
        $(".upload-file").trigger('loading-overlay:show');
        var formData = new FormData($('#upload-file-form')[0]);
        if($('#upload-file-form')[0][2].value === ""){
            alert('Insert upload file');
            return;
        }
        //import-form
        $.ajax({
            url: $('#base_url').val()+'admin/library/upload',
            type: 'POST',
            data: formData,
            processData:false,
            contentType: false,
            success: function (data, status, xhr) {
                $(".upload-file").trigger('loading-overlay:hide');
                $table.DataTable().ajax.reload('', false);
                $.magnificPopup.close();


                new PNotify({
                    title: 'Success',
                    text: 'Upload',
                    type: 'success'
                });

            },
            error: function(){
                $(".upload-file").trigger('loading-overlay:hide');
                new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                    type: 'error'
                });
                $.magnificPopup.close();
            }
        });

    });

    $('.modal-rename-confirm').click(function (e) {
        e.preventDefault();
        var formData = new FormData($('#rename-form')[0]);
        //import-form
        $.ajax({
            url: $('#base_url').val()+'admin/library/rename',
            type: 'POST',
            data: formData,
            processData:false,
            contentType: false,
            success: function (data, status, xhr) {

                $table.DataTable().ajax.reload('', false);
                $.magnificPopup.close();

                new PNotify({
                    title: 'Success',
                    text: 'Rename',
                    type: 'success'
                });

            },
            error: function(){

                new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                    type: 'error'
                });
                $.magnificPopup.close();
            }
        });
    });

    $('.modal-watermark-confirm').click(function (e) {
        e.preventDefault();
        var formData = new FormData($('#watermark-form')[0]);
        
        if($('#upload_watermark_file').val()==""){

            new PNotify({
                    title: 'Required Error!',
                    text: 'File is required!',
                    type: 'error'
                });

        }else if($('#header_text').val()==""&&!$('#header_hide').prop('checked')){

            new PNotify({
                    title: 'Required Error!',
                    text: 'Header text is required!',
                    type: 'error'
                });

        }else if($('#footer_text').val()==""&&!$('#footer_hide').prop('checked')){

            new PNotify({
                    title: 'Required Error!',
                    text: 'Footer text is required!',
                    type: 'error'
                });

        }else{
           
           var $el = $('#LoadingOverlayApi');           
           $el.trigger('loading-overlay:show');
           $(".modal-watermark-confirm").prop('disabled',true);


           
           $.ajax({
                url: $('#base_url').val()+'admin/library/watermark',
                //url:"",
                type: 'POST',
                data: formData,
                processData:false,
                contentType: false,
                success: function (data, status, xhr) {

                    $table.DataTable().ajax.reload('', false);
                    $.magnificPopup.close();

                    new PNotify({
                        title: 'Success',
                        text: 'Watermark',
                        type: 'success'
                    });

                    $el.trigger('loading-overlay:hide');    
                    $(".modal-watermark-confirm").prop('disabled',false); 
                    $(".modal-create-dismiss").prop('disabled',true);

                    $('#modalFormWatermark .fileupload-exists').click()
                    $('#header_text').val("");
                    $('#footer_text').val("");
            },
                error: function(){
                    $el.trigger('loading-overlay:hide');     
                    $(".modal-watermark-confirm").prop('disabled',false);
                    //$(".modal-create-dismiss").prop('disabled',true);

                    new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                        type: 'error'
                    });

                    $('#modalFormWatermark .fileupload-exists').click()
                    $('#header_text').val("");
                    $('#footer_text').val("");

                    $.magnificPopup.close();
                }
            }); 
        }
        
    });

    function unsetShopping(id) {
        $.ajax({
            url: $('#base_url').val()+'admin/library/unsetShopping',
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

    function rename(id, name) {
        $('#id').val(id);
        $('#name').val(name);
        $('.rename').click();
    }

    function watermark(url,type,html_path,id) {
        //alert(html_path);
        $('#pdf_id').val(id);
        $('#url').val(url);   
        
        if(html_path==null||html_path==""){
            $('#library_type').val('pdf');   
        }else{
            $('#library_type').val(type);   
            $('#html_url').val(html_path);   
        }    
        $('.watermark').click();
    }

    function setShopping(id) {
        $.ajax({
            url: $('#base_url').val()+'admin/library/setShopping',
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

    function deleteLibrary(id) {
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
                url: $('#base_url').val()+'admin/library/delete',
                type: 'POST',
                data: {id:id},
                success: function (data, status, xhr) {
                    if(status == "success") {
                        $table.DataTable().ajax.reload('', false);
                    } else {
                        new PNotify({
                            title: 'Fail!',
                            text: status,
                            type: 'danger'
                        });
                    }
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
    

    jQuery(document).ready(function() { 

        var $el = $('#LoadingOverlayApi');
        $el.trigger('loading-overlay:hide');     
        //$el.trigger('loading-overlay:show');

        $("body").loadingOverlay({
            "startShowing": true
        });

        $table.dataTable({
            "ordering": true,
            "info": true,
            "searching": true,

            "ajax": {
                "type": "POST",
                "async": true,
                "url":$('#base_url').val() +"admin/library/view",
                "data": {parent_id:$('#parent_id').val()},
                "dataSrc": "data",
                "dataType": "json",
                "cache":    false
            },
            "columnDefs": [{
                'targets': [0],
                'checkboxes': {
                    'selectRow': true
                },
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(rowData['file_type'] == 'DIRECTORY'){
                        $(td).addClass('directory-td');
                        $(td).append('<input type="hidden" name="users[]"  value="'+rowData['id']+'">');
                    }else{
                       $(td).append('<input type="hidden" name="users[]"  value="'+rowData['id']+'">'); 
                    }
                }
            },
                {
                "targets": [1],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(rowData['file_type'] == 'DIRECTORY'){
                        $(td).addClass('directory-td');
                    }
                }
                },
                {
                "targets": [2],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(rowData['name']){
                        if(rowData['file_type'] == 'DIRECTORY'){
                            $(td).html('<a href="<?= base_url()?>admin/library/library_view/'+rowData['id']+'">'+cellData+'</a>');
                        } else if(rowData['name'].indexOf('.pdf') >= 0){
                            $(td).html('<a target="blank" href="<?= base_url()?>admin/flipbook/view_book/'+rowData['id']+'">'+cellData+'</a>');
                        } else {
                            $(td).html('<a target="blank" href="'+rowData['file_path']+'">'+cellData+'</a>');
                        }

                        if(rowData['file_type'] == 'DIRECTORY'){
                            $(td).addClass('directory-td');
                        }
                    }
                }
            },{
                "targets": [3],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(rowData['file_type'] == 'DIRECTORY'){
                        $(td).addClass('directory-td');
                    }
                }
            },{
                "targets": [4],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(rowData['file_type'] == 'DIRECTORY'){
                        $(td).addClass('directory-td');
                    }
                }
            },{
                "targets": [5],
                "createdCell": function (td, cellData, rowData, row, col) {

                    if(cellData == '1'){
                        $(td).html('<a href="javascript:inactivePermission('+rowData['id']+')"><span class="badge badge-success"><?=$term["yes"]?></span></a>');
                    } else {
                        $(td).html('<a href="javascript:activePermission('+rowData['id']+')"><span class="badge badge-dark"><?=$term["no"]?></span></a>');
                    }


                }
            },{
                "targets": [6],
                "createdCell": function (td, cellData, rowData, row, col) {

                    if(rowData['file_type'] != 'DIRECTORY'){
                        if( cellData == '1'){
                            $(td).html('<a href="javascript:unsetShopping('+rowData['id']+')"><span class="badge badge-success"><?=$term["yes"]?></span></a>');

                        } else {
                            $(td).html('<a href="<?= base_url()?>admin/library/setShopping/'+rowData['id']+'"><span class="badge badge-dark"><?=$term["no"]?></span></a>');
                        }

                    }else{
                        $(td).html('');
                    }
                    if(rowData['file_type'] == 'DIRECTORY'){
                        $(td).addClass('directory-td');
                    }


                }
            }, {
                "targets": [7],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(rowData['file_type'] == 'manual'){
                        if(rowData['manual_type'] == 0){
                            $(td).html('<a href="<?=base_url()?>admin/library/create_manual/'+cellData+'"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteLibrary('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a><span class="w-20"></span>'+'<a href="javascript:watermark(\''+rowData['file_url']+'\','+'\''+rowData['file_type']+'\','+'\''+rowData['manual_html_path']+'\','+rowData['id']+')" class="watermark-row"><i class="fa fa-bookmark"></i></a><span class="w-20"></span>');
                        }else{
                            $(td).html('<a href="<?=base_url()?>admin/library/create_contract/'+cellData+'"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteLibrary('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a><span class="w-20"></span>'+'<a href="javascript:watermark(\''+rowData['file_url']+'\','+'\''+rowData['file_type']+'\','+'\''+rowData['manual_html_path']+'\','+rowData['id']+')" class="watermark-row"><i class="fa fa-bookmark"></i></a><span class="w-20"></span>');

                        }

                    }else if(rowData['file_type'] == 'pdf'){
                        $(td).html('<a href="javascript:rename('+rowData['id']+', \''+rowData['name']+'\')"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteLibrary('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a><span class="w-20"></span>'+'<a href="javascript:watermark(\''+rowData['file_url']+'\','+'\''+rowData['file_type']+'\','+'\''+rowData['manual_html_path']+'\','+rowData['id']+')" class="watermark-row"><i class="fa fa-bookmark"></i></a><span class="w-20"></span>');
                    }else{
                        $(td).html('<a href="javascript:rename('+rowData['id']+', \''+rowData['name']+'\')"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteLibrary('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
                    }
                    if(rowData['file_type'] == 'DIRECTORY'){
                        $(td).addClass('directory-td');
                    }
                }

            }],
            "columns": [
                { "title": "Select", "data": "no", "class": "text-left", "width": 20 },
                { "title": "#", "data": "no", "class": "center", "width":20 },
                { "title": "<?=$term["name"]?>", "data": "name", "class": "text-left", "width":"*" },
                { "title": "<?=$term["filetype"]?>", "data": "file_type", "class": "text-left", "width":80},
                { "title": "<?=$term["date"]?>", "data": "reg_date", "class": "text-center", "width":110 },
                { "title": "Print Permission", "data": "print_permission", "class": "text-center", "width":50 },
                { "title": "<?=$term["shopping"]?>", "data": "is_shopping", "class": "text-center", "width":50 },
                { "title": "<?=$term["action"]?>", "data": "id", "class": "text-center", "width":80 },
                
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
            sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
            bProcessing: true
        });


    });
    function check_add(modal_name){
          var url = "<?= base_url()?>admin/library/check_add_view";
          $.ajax({
          url: url,
          type: 'POST',
          processData:false,
          contentType: false,
          success: function (data, status, xhr) {
            if(data.success){
                  $('.'+modal_name).click();
            }else{
              swal({
                text: data.msg,
                icon:"warning",
              }).then((willDelete) => {
                    if (willDelete) {
                      location.href="<?php echo base_url('pricing')?>";
                    }
                  });
            }
          },
          error: function(){
           swal({
                text: "Add Error",
                icon:"warning",
            })
          }
        });
    }

    function inactivePermission(id) {
        $.ajax({
            url: $('#base_url').val()+'admin/library/inactive',
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

    function activePermission(id) {
        $.ajax({
            url: $('#base_url').val()+'admin/library/active',
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

</script>