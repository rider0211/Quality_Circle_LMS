<section role="main" class="content-body">
    <header class="page-header">
        <h2><?=$term["usermanagement"]?></h2>

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

                        <a class="modal-with-form add-user" href="<?= base_url()?>superadmin/user/add_view">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"> <i class="fa fa-plus"></i> <?=$term["adduser"]?></button>
                        </a>

                    </div>

                    <h2 class="card-title"><?=$term["userlist"]?></h2>
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
            url: $('#base_url').val()+'superadmin/user/inactive',
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
            url: $('#base_url').val()+'superadmin/user/active',
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

    function deleteUser(id) {

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
                url: $('#base_url').val()+'superadmin/user/delete',
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

    jQuery(document).ready(function(){
        $table.dataTable({
            "ordering": true,
            "info": true,
            "searching": true,

            "ajax": {
                "type": "POST",
                "async": true,
                "url":$('#base_url').val() +"superadmin/user/getdata",
                "data": null,
                "dataSrc": "data",
                "dataType": "json",
                "cache":    false,
            },
            "columnDefs": [{
                "targets": [1],
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).html(rowData['first_name']+rowData['last_name']);
                }
            }, {
                "targets": [5],
                "createdCell": function (td, cellData, rowData, row, col) {
					if($.isNumeric(rowData['phone']) && $.isNumeric(rowData['country_code'])){
						$(td).html('+'+rowData['country_code']+'-'+rowData['phone']);
					}
                }
            },{
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
                    $(td).html('<a href="<?=base_url()?>superadmin/user/add_view/'+cellData+'"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteUser('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
                }
            }],
            "columns": [
                { "title": "#", "data": "no", "class": "center", "width":20 },
                { "title": "<?=$term["username"]?>", "data": "id", "class": "text-left", "width":"*" },
                { "title": "<?=$term["role"]?>", "data": "role", "class": "text-left", "width":200 },
				{ "title": "<?=$term["company"]?>", "data": "company_name", "class": "text-left", "width":300 },				
                { "title": "<?=$term["email"]?>", "data": "email", "class": "text-left", "width":300 },	
				{ "title": "<?=$term["phone"]?>", "data": "phone", "class": "text-left", "width":100 },			                
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
