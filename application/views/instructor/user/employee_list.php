<section role="main" class="content-body">
    <header class="page-header">
        <h2><?php echo $term['employeemanagement']; ?></h2>

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
                        <a class="modal-with-form export-excel" id="anchor_export" href="<?= base_url()?>fasi/user/export/Employee">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-export"><i class="fa fa-download"></i><?php echo $term['exportexcel']; ?></button>
                        </a>
                        <a class="modal-with-form import-excel" href="#modalFormImport">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-import"><i class="fa fa-upload"></i><?php echo $term['importexcel']; ?></button>
                        </a>
                        <a class="modal-with-form add-user" href="<?= base_url()?>fasi/user/add_view/employee">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"><i class="fa fa-plus"></i><?php echo $term['adduser']; ?></button>
                        </a>

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
                                                <a  href="<?= base_url()?>all/user/down_temp/Employee" >
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

                    <h2 class="card-title"><?php echo $term['employeelist']; ?></h2>
                </header>
                <div class="card-body">
                    <div class="row" style="margin-bottom: 15px; text-align: right;">
                        <div class="col-lg-2">

                        </div>

                        <div class="col-lg-2">
                            <select class="form-control" id="filter_company">
                                <option value="0" selected><?php echo $term['selectcompany']; ?></option>
                                <?php
                                foreach ($company as $c) {
                                    echo "<option value='".$c['id']."'>".$c['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-lg-2">
                            <select class="form-control" id="filter_exam">
                                <option value="0" selected><?php echo $term['selectexam']; ?></option>
                                <?php
                                foreach ($exam as $e) {
                                    echo "<option value='".$e['id']."'>".$e['exam_title']."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-lg-4">
                            <div class="input-daterange input-group" data-plugin-datepicker>
                                <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </span>
                                <input type="text" class="form-control" id="filter_start" disabled>
                                <span class="input-group-text border-left-0 border-right-0 rounded-0"><?php echo $term['to']; ?></span>
                                <input type="text" class="form-control" id="filter_end" disabled>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <button type="button" class="btn btn-primary" onclick="filterTable();" style="width: 100%;"><?php echo $term['filtertable']; ?></button>
                        </div>
                    </div>

                    <table class="table table-responsive-md table-hover mb-0" id="datatable" ></table>
                </div>
            </section>
        </div>
    </div>

    <!-- end: page -->
</section>

<script>
    var $table = $('#datatable');


    jQuery(document).ready(function() {
        $('[data-plugin-ios-switch]').each(function() {
            var $this = $( this );

            $this.themePluginIOS7Switch();
        });

        $('[data-plugin-datepicker]').each(function() {
            var $this = $( this );

            $this.themePluginDatePicker();
        });
    });



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
                    url: $('#base_url').val()+'fasi/user/add',
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
            } else {
                $.ajax({
                    url: $('#base_url').val()+'fasi/user/change',
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


    $('.modal-import-confirm').click(function (e) {
        e.preventDefault();
        var formData = new FormData($('#excel-import-form')[0]);
        //import-form
        $.ajax({
            url: $('#base_url').val()+'all/user/import/Employee',
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
                url: $('#base_url').val()+'fasi/user/delete',
                type: 'POST',
                data: {id:id},
                success: function (data, status, xhr) {
                    if(data == "error"){
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: '<?php echo $term['youcantdeletethisitem']; ?>',
                            type: 'danger'
                        });
                    }
                    else {
                        if (status == "success") {
                            $table.DataTable().ajax.reload('', false);
                        } else {
                            new PNotify({
                                title: '<?php echo $term['error']; ?>',
                                text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                                type: 'danger'
                            });
                        }
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

    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var valCompany = false, valExam = false;

            var companyId = $('#filter_company').val();
            if (companyId == 0 || companyId == data[8])
                valCompany = true;

            var examId = $('#filter_exam').val();
            if (examId == 0)
                valExam = true;
            else {
                var start = $('#filter_start').val();
                var arr = start.split('/');
                if (arr.length > 1) {
                    start = arr[2] + '-' + arr[0] + '-' + arr[1];
                }

                var end = $('#filter_end').val();
                arr = end.split('/');
                if (arr.length > 1) {
                    end = arr[2] + '-' + arr[0] + '-' + arr[1];
                }

                var exams = JSON.parse(data[9]);
                var pass = false;
                for (var i = 0; i < exams.length; i++) {
                    if (exams[i].id == examId) {
                        if (start < exams[i].start_date)
                            pass = true;
                        if (end != '' && exams[i].start_date > end)
                            pass = false;
                        break;
                    }
                }
                valExam = pass;
            }

            return valCompany && valExam;
        }
    );

    function filterTable() {
        $table.DataTable().draw();
    }

    jQuery(document).ready(function() {

        $('#anchor_export').on('click', function (e) {
            e.preventDefault();

            var link = $(this).attr('href');
            var companyId = $('#filter_company').val();
            var examId = $('#filter_exam').val();
            var start = $('#filter_start').val();
            var arr = start.split('/');
            if (arr.length > 1) {
                start = arr[2] + '-' + arr[0] + '-' + arr[1];
            }

            var end = $('#filter_end').val();
            arr = end.split('/');
            if (arr.length > 1) {
                end = arr[2] + '-' + arr[0] + '-' + arr[1];
            }

            link += "?company=" + companyId + "&exam=" + examId + "&start=" + start + "&end=" + end;
            location.href = link;
        });

        $('#filter_exam').on('change', function (e) {
            if ($(this).val() == '0') {
                $('#filter_start').attr("disabled", "disabled");
                $('#filter_end').attr("disabled", "disabled");
            } else {
                $('#filter_start').removeAttr("disabled");
                $('#filter_end').removeAttr("disabled");
            }
        });

        $table.dataTable({
            "ordering": true,
            "info": true,
            "searching": true,

            "ajax": {
                "type": "POST",
                "async": true,
                "url": $('#base_url').val()+"fasi/user/view",
                "data": {type: 'Employee'},
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
                "targets": [6],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData == '1'){
                        $(td).html('<span class="badge badge-success">Active</span>');
                    } else {
                        $(td).html('<span class="badge badge-warning">Inactive</span>');
                    }

                }
            }, {
                "targets": [7],
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).html('<a href="<?= base_url()?>fasi/user/add_view/employee/'+cellData+'"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteCategory('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
                }
            }, {
                "targets": [ 8 ],
                "visible": false,
                "searchable": true
            }, {
                "targets": [ 9 ],
                "visible": false,
                "searchable": true
            }],
            "columns": [
                { "title": "<?php echo $term['companyname']; ?>", "data": "company_name", "class": "text-left", "width":100 },
                { "title": "<?php echo $term['firstname']; ?>", "data": "first_name", "class": "text-left", "width":80 },
                { "title": "<?php echo $term['lastname']; ?>", "data": "last_name", "class": "text-left", "width":80 },
                { "title": "<?php echo $term['email']; ?>", "data": "email", "class": "text-left", "width":"*" },
                { "title": "<?php echo $term['picture']; ?>", "data": "picture", "class": "text-center", "width":110 },
                { "title": "<?php echo $term['groups']; ?>", "data": "user_type", "class": "text-center", "width":50 },
                { "title": "<?php echo $term['status']; ?>", "data": "is_active", "class": "text-center", "width":50 },
                { "title": "<?php echo $term['action']; ?>", "data": "id", "class": "text-center", "width":80 },
                { "title": "<?php echo $term['company_id']; ?>", "data": "company_id" },
                { "title": "<?php echo $term['examstart']; ?>", "data": "exam" }
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
