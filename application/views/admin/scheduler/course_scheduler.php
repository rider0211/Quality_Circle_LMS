<section role="main" class="content-body">
    <header class="page-header">
        <h2>Scheduler Course</h2>

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

                      

                    </div>

                    <h2 class="card-title">Scheduler Course</h2>
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
 
     jQuery(document).ready(function() {

        $table.dataTable({
            "ordering": true,
            "info": true,
            "searching": true,

            "ajax": {
                "type": "POST",
                "async": true,
                "url":$('#base_url').val() +"admin/user/view",
                "data": null,
                "dataSrc": "data",
                "dataType": "json",
                "cache":    false,
            },
            "columnDefs": [{
                "targets": [1],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(!rowData['picture'] ){
                        $(td).html("<img style='height:50px;' src='<?=base_url('assets/img/default_profile.png')?>'>");
                    }
                    else {
                        $(td).html("<img style='height:50px;' src='<?=base_url()?>" + rowData['picture'] + "'>");
                    }
                }
            }, {
                "targets": [6],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData == '1'){
                        $(td).html('<a href="javascript:inactiveUser('+rowData['id']+')"><span class="badge badge-success"><?=$term["yes"]?></span></a>');
                    } else {
                        $(td).html('<a href="javascript:activeUser('+rowData['id']+')"><span class="badge badge-dark"><?=$term["no"]?></span></a>');
                    }

                }
            }, {
                "targets": [7],
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).html('<a href="<?=base_url()?>admin/user/add_view/'+cellData+'"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteUser('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
                }
            }],
            "columns": [
                { "title": "#", "data": "no", "class": "center", "width":20 },
                { "title": "<?=$term["avatar"]?>", "data": "picture", "class": "text-left", "width":100 },
                { "title": "<?=$term["firstname"]?>", "data": "first_name", "class": "text-left", "width":100 },
                { "title": "<?=$term["lastname"]?>", "data": "last_name", "class": "text-left", "width":100},
                { "title": "<?=$term["email"]?>", "data": "email", "class": "text-left", "width":100 },
                { "title": "<?=$term["role"]?>", "data": "user_type", "class": "text-center", "width":110 },
                { "title": "<?=$term["active"]?>", "data": "active", "class": "text-center", "width":50 },
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
            dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
            bProcessing: true,
        });

    });
   

</script>
