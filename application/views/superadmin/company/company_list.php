<section role="main" class="content-body">
    <header class="page-header">
        <h2><?=$term["companymanagement"]?></h2>

        <div class="right-wrapper">

        </div>
    </header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">

                        <a class="modal-with-form add-user" href="<?= base_url()?>superadmin/company/edit_view">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"><i class="fa fa-plus"></i><?=$term["addcompany"]?></button>
                        </a>

                        <!-- Modal Form -->
                        <div id="modalFormExport" class="modal-block modal-block-primary mfp-hide">
                            <form id="excel-export-form" action="" method="POST" novalidate="novalidate">
                                <section class="card">
                                    <header class="card-header">
                                        <h2 class="card-title"><?=$term["exportexcel"]?></h2>
                                    </header>
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term[fileexport]?></label>
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
                                                        <input type="file" />
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
                                                <button class="btn btn-primary modal-export-confirm"><?=$term["export"]?></button>
                                                <button class="btn btn-default modal-export-dismiss"><?=$term["cancel"]?></button>
                                            </div>
                                        </div>
                                    </footer>
                                </section>
                            </form>
                        </div>

                        <div id="modalFormImport" class="modal-block modal-block-primary mfp-hide">
                            <form id="excel-import-form" action="" method="POST" novalidate="novalidate">
                                <section class="card">
                                    <header class="card-header">
                                        <h2 class="card-title"><?=$term["importexcel"]?></h2>
                                    </header>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-md-12 text-center">
                                                <a  href="<?= base_url()?>all/user/down_temp/Company" >
                                                    <?=$term["downloadtemplate"]?>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["fileimport"]?></label>
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
                                                            <input type="file" name="upload_excel" id="upload_excel"/>
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
                                                <button class="btn btn-primary modal-import-confirm"><?=$term["import"]?></button>
                                                <button class="btn btn-default modal-import-dismiss"><?=$term["cancel"]?></button>
                                            </div>
                                        </div>
                                    </footer>
                                </section>
                            </form>
                        </div>

                    </div>

                    <h2 class="card-title">Company List</h2>
                </header>
                <div class="card-body">
                    <table class="table table-responsive-md table-hover mb-0" id="datatable" >
                    </table>
                </div>
            </section>
        </div>
    </div>

    <!-- end: page -->
</section>

<script>
    var $table = $('#datatable');


    function inactiveUser(id) {
        $.ajax({
            url: $('#base_url').val()+'superadmin/company/inactive',
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

    function activeUser(id) {
        $.ajax({
            url: $('#base_url').val()+'superadmin/company/active',
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

    function deleteCategory(id) {

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
                url: $('#base_url').val()+'superadmin/company/delete',
                type: 'POST',
                data: {id:id},
                success: function (data, status, xhr) {
                    if(status == "success") {
                        $table.DataTable().ajax.reload('', false);
                    } else {
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: '<?php echo $term['youcantdeletethisitem']; ?>',
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

        $table.dataTable({
            "ordering": true,
            "info": true,
            "searching": true,

            "ajax": {
                "type": "POST",
                "async": true,
                "url": $('#base_url').val()+"superadmin/company/getData",
                "data": null,
                "dataSrc": "data",
                "dataType": "json",
                "cache":    false,
            },
            "columnDefs": [ {
                "targets": [3],
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).html('<img class="img-fluid" src="<?=base_url()?>'+cellData+'" width="28" height="28"></a>');

                }
            }, {
                "targets": [5],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData == '1'){
                        $(td).html('<a href="javascript:inactiveUser('+rowData['id']+')"><span class="badge badge-success"><?=$term["yes"]?></span></a>');
                    } else {
                        $(td).html('<a href="javascript:activeUser('+rowData['id']+')"><span class="badge badge-dark"><?=$term["no"]?></span></a>');
                    }

                }
            }, {
                "targets": [6],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData == '1'){
                        $(td).html('<span class="badge badge-success"><?=$term["yes"]?></span>');
                    } else {
                        $(td).html('<span class="badge badge-dark"><?=$term["no"]?></span>');
                    }

                }
            }, {
                "targets": [7],
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).html('<a href="<?= base_url()?>superadmin/company/edit_view/'+cellData+'"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteCategory('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
                }
            }],
            "columns": [
                { "title": "No", "data": "no", "class": "text-left", "width":"*" },
                { "title": "<?=$term["name"]?>", "data": "name", "class": "text-left", "width":"*" },
				{ "title": "Url", "data": "url", "class": "text-left", "width":"*" },
                { "title": "<?=$term["picture"]?>", "data": "logo_path", "class": "text-center", "width":110 },
                { "title": "<?=$term["discount"]?>(%)", "data": "discount", "class": "text-center", "width":50 },
                { "title": "<?=$term["status"]?>", "data": "active", "class": "text-center", "width":50 },
                { "title": "<?=$term["enrollstatus"]?>", "data": "status", "class": "text-center", "width":50 },
                { "title": "<?=$term["action"]?>", "data": "id", "class": "text-center", "width":80 }
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
