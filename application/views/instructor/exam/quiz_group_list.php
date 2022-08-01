<style>
    .ui-pnotify-container {
        height: 130px;
    }
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Quiz Group Management</h2>

        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo base_url(); ?>home">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span><?=$term["exam"]?></span></li>

                <li><span>Quiz Group List</span></li>
            </ol>

        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="javascript:showCreateDlg()" class="btn btn-default"><i class="fas fa-plus"></i>&nbsp;New Quiz Group</a>
                    </div>

                    <h2 class="card-title">Quiz Group List</h2>
                </header>
                <div class="card-body">
                    <table class="table table-responsive-md table-striped table-hover mb-0" id="datatable_examlist" >
                    </table>
                </div>
            </section>
        </div>
    </div>

    <!-- end: page -->
</section>
<div id="Type_Modal" class="modal fade">
    <div class="modal-dialog" style = "max-width: 700px !important; width: 700px">
        <div class="modal-content">
            <form id="form_quiz_group" name="form_quiz_group" action="<?=base_url()?>instructor/exam/save_quiz_group" method="post" novalidate="novalidate" enctype="multipart/form-data">
                <div class="modal-header bg-default">
                    <h4 class="modal-title">Quiz Group</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="row_id" id="row_id">
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-lg-right pt-2">Quiz Group Title</label>
                        <div class="col-sm-9">
                            <input type="text" id="quiz_group_title" name="quiz_group_title" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-sm-12 ">
                        <table class="table table-responsive-md table-striped table-bordered mb-0" id="datatable_quiz" >
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="save_quiz_group()">Save</button>
                    <button type="button" class="btn btn-default cancelForm" >Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var $table = $('#datatable_examlist');
    var $quiz_table = $("#datatable_quiz");
    var quiz_ids = new Array();

    jQuery(document).ready(function() {

        $table.dataTable({
            "ordering": true,
            "info": true,
            "searching": true,

            "ajax": {
                "type": "POST",
                "async": true,
                "url": "<?php echo base_url()?>instructor/exam/getQuizGroupList",
                "data": '',
                "dataSrc": "data",
                "dataType": "json",
                "cache":    false,
            },
            "columnDefs": [
                {
                    "targets": [3],
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).html('<a class="btn btn-default"  href="javascript:changeExam('+cellData+')">Edit</a><span class="w-20"></span><a class="btn btn-default" href="javascript:deleteExam('+cellData+')">Delete</a>');
                    }
                } ],
            "columns": [
                { "title": "#", "data": "no", "class": "center", "width":20 },
                { "title": "Title", "data": "title", "class": "text-left"},
                { "title": "Quiz_num", "data": "quiz_num", "class": "text-left", "width":50 },
                { "title": "<?=$term["action"]?>", "data": "id", "class": "text-left", "width":200 },
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

        $quiz_table.dataTable({
            "ordering": true,
            "info": true,
            "searching": true,

            "ajax": {
                "type": "POST",
                "async": true,
                "url": "<?php echo base_url()?>instructor/exam/getQuizList",
                "data": '',
                "dataSrc": "data",
                "dataType": "json",
                "cache":    false,
            },
            "columnDefs": [{
                "targets": [0],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if (quiz_ids.indexOf(cellData) > 0){
                        $(td).html('<input type="checkBox" name="quiz_ids[]" checked required value="'+rowData.id+'">');
                    }else{
                        $(td).html('<input type="checkBox" name="quiz_ids[]" required value="'+rowData.id+'">');
                    }
                }
            } ],
            "columns": [
                { "title": "", "data": "id", "class": "text-left", "width":'50px' },
                { "title": "#", "data": "no", "class": "center", "width":'50px' },
                { "title": "Quiz Code", "data": "quiz_code", "class": "center", "width":'200px' },
                { "title": "Name", "data": "ques_title", "class": "text-left", "width":'500px' }
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
            "pageLength": 5, // default record count per page

            dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
            bProcessing: true
        });

    });

    function deleteExam(id) {
        (new PNotify({
            title: "<?php echo $term['confirmation']; ?>",
            text: "<?php echo $term['areyousuretodelete']; ?>",
            type: 'custom',
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
                'dir1': 'up',
                'dir2': 'right',
                'modal':true
            }
        })).get().on('pnotify.confirm', function(){
            $.ajax({
                url: '<?=base_url()?>instructor/exam/quiz_group_delete',
                type: 'POST',
                data: {'id': id},
                success: function (data, status, xhr) {
                    $quiz_table.DataTable().ajax.reload();
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

    function showCreateDlg() {
        $("#row_id").val('');
        $("#quiz_group_title").val('');
        quiz_ids = [""];

        $("#Type_Modal").modal("show");


        $quiz_table.DataTable().ajax.reload();
        $quiz_table.DataTable().ajax.reload();
        $quiz_table.DataTable().ajax.reload();
        $quiz_table.DataTable().ajax.reload();
        $quiz_table.DataTable().ajax.reload();


    }

    function save_quiz_group() {
        $("#Type_Modal").modal("hide");
        $("#form_quiz_group").submit();
    }

    function changeExam(id) {
        $("#Type_Modal").modal("show");
        $("#row_id").val(id);
        $.ajax({
            url: '<?php echo base_url()?>instructor/exam/getQuizIds',
            type: 'POST',
            data: {'id': id},
            success: function (data, status, xhr) { 
                quiz_ids = JSON.parse(data.quiz_ids); 
                for(var i = 0; i<quiz_ids.length; i++){  
                    $("#datatable_quiz").find("input[type=checkbox][value='"+quiz_ids[i]+"']").attr("checked", true);
                }
                $("#quiz_group_title").val(data.title);
                $("#form_quiz_group")[0].reset();
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

    $("body").on('click', '.cancelForm', function () {
        $('input:checkbox').removeAttr('checked');
        $("#form_quiz_group form").trigger('reset');
        $("#Type_Modal").modal("hide");
    });



</script>