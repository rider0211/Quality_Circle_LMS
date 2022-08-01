<section role="main" class="content-body">
    <header class="page-header">
        <h2><?php echo $term['companymanagement']; ?></h2>

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
                        <!--  -->
                        <a class="modal-with-form export-excel" href="<?= base_url()?>fasi/company/export/Employee">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-export"><i class="fa fa-download"></i><?php echo $term['exportexcel']; ?></button>
                        </a>
                        <!--<a class="modal-with-form import-excel" href="#modalFormImport">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-import"><i class="fa fa-upload"></i>Import Excel</button>
                        </a>
                        <a class="modal-with-form add-user" href="<?/*= base_url()*/?>fasi/company/add_view">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"><i class="fa fa-plus"></i>Add Company</button>
                        </a>
						-->
                        <!-- Modal Form -->


                        <div id="modalFormImport" class="modal-block modal-block-primary mfp-hide">
                            <form id="excel-import-form" action="" method="POST" novalidate="novalidate">
                                <section class="card">
                                    <header class="card-header">
                                        <h2 class="card-title"><?php echo $term['importexcel']; ?></h2>
                                    </header>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-md-12 text-center">
                                                <a  href="<?= base_url()?>all/user/down_temp/Company" >
                                                    <?php echo $term['downloadtemplate']; ?>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label text-lg-right pt-2"><?php echo $term['fileimport']; ?></label>
                                            <div class="col-sm-9">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="input-append">
                                                        <div class="uneditable-input">
                                                            <i class="fas fa-file fileupload-exists"></i>
                                                            <span class="fileupload-preview"></span>
                                                        </div>
                                                        <span class="btn btn-default btn-file">
                                                            <span class="fileupload-exists"><?php echo $term['change']; ?></span>
                                                        <span class="fileupload-new"><?php echo $term['selectfile']; ?></span>
                                                        <input type="file" name="upload_excel" id="upload_excel"/>
                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?php echo $term['remove']; ?></a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <footer class="card-footer">
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-primary modal-import-confirm"><?php echo $term['importexcel']; ?></button>
                                                <button class="btn btn-default modal-import-dismiss"><?php echo $term['cancel']; ?></button>
                                            </div>
                                        </div>
                                    </footer>
                                </section>
                            </form>
                        </div>

                    </div>

                    <h2 class="card-title"><?php echo $term['companylist']; ?></h2>
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

    $('.modal-import-confirm').click(function (e) {
        e.preventDefault();
        var formData = new FormData($('#excel-import-form')[0]);
        //import-form
        $.ajax({
            url: $('#base_url').val()+'all/user/import/FASI',
            type: 'POST',
            data: formData,
            processData:false,
            contentType: false,
            success: function (data, status, xhr) {

                $table.DataTable().ajax.reload('', false);
                $.magnificPopup.close();

                var text = data.success_count + ' of ' + (data.success_count + data.failed_count) + ' data imported.';
                if (data.failed_count > 0)
                    text += '<br>' + data.failed_count + ' datas failed because of email-duplication or else';

                new PNotify({
                    title: 'Success',
                    text: text,
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

    $('.import-excel').magnificPopup({
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
                url: $('#base_url').val()+'fasi/company/delete',
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
                "url": $('#base_url').val()+"fasi/company/view",
                "data": {type: 'Company'},
                "dataSrc": "data",
                "dataType": "json",
                "cache":    false,
            },
            "columnDefs": [ {
                "targets": [4],
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).html('<img class="img-fluid" src="<?=base_url()?>'+cellData+'" width="28" height="28"></a>');

                }
            }, {
                "targets": [5],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData == '1'){
                        $(td).html('<span class="badge badge-success"><?php echo $term['active']; ?></span>');
                    } else {
                        $(td).html('<span class="badge badge-warning"><?php echo $term['inactive']; ?></span>');
                    }

                }
            }, {
                "targets": [6],
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).html('<a href="<?= base_url()?>fasi/company/add_view/'+cellData+'"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteCategory('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
                }
            }],
            "columns": [
                { "title": "<?php echo $term['id']; ?>", "data": "id", "class": "text-left", "width":"*" },
                { "title": "<?php echo $term['name']; ?>", "data": "name", "class": "text-left", "width":"*" },
                { "title": "<?php echo $term['email']; ?>", "data": "email", "class": "text-left", "width":"*" },
                { "title": "<?php echo $term['fasi']; ?>", "data": "fasi", "class": "text-left", "width":"*" },
                { "title": "<?php echo $term['picture']; ?>", "data": "logo_image", "class": "text-center", "width":110 },
                { "title": "<?php echo $term['status']; ?>", "data": "active", "class": "text-center", "width":50 },
                { "title": "<?php echo $term['action']; ?>", "data": "id", "class": "text-center", "width":80 },
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
