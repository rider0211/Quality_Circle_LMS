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

                        <a class="modal-with-form add-user" href="javascript:add_user()">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"> <i class="fa fa-plus"></i> <?=$term["adduser"]?></button>
                        </a>
                        
                        <a class="modal-with-form add-user" href="<?=base_url('admin/exports/export_users')?>">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-success" id="btn-add">Export to CSV</button>
                        </a>
                        
                        <button type="button" class="mb-1 mt-0 mr-1 btn btn-warning" id="upload_csv">Import CSV</button>
                        
                        <a class="modal-with-form add-user" href="<?php echo base_url(); ?>assets/users_upload_csv.csv">
                        	<button type="button" class="mb-1 mt-0 mr-1 btn btn-primary" id="">Download Sample CSV</button>
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

<!-- Modal -->
<div class="modal fade" id="uploadCsvModal">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="post" enctype="multipart/form-data" action="<?=base_url('admin/exports/import_users')?>" id="uploadfile">
                <div class="modal-header">
                    <h5 class="modal-title response">Import CSV</h5>
                </div>
                <div class="modal-body">            	
                    <input type="file" id="file" name="file" accept=".csv" />                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="location.href=location.href">Close</button>
                    <button type="button" name="import" class="btn btn-primary" id="frmCSVImport">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">	
	$(document).ready(function(){
		$("#frmCSVImport").on("click", function(){
			$(".response").html("Import CSV").css('color','black');
			var fileType = ".csv";
			var ext = $('#file').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['csv']) == -1){
				$(".response").html("Invalid File. Upload only : <b>" + fileType + "</b> Files.").css('color','red');
				return false;
			}
			$('#uploadfile').submit();
		});
	});

	$('#upload_csv').on('click',function(){
		$(".response").html("Import CSV").css('color','black');
		$('#uploadCsvModal').modal('show');
	});
	
    var $table = $('#datatable');

    function inactiveUser(id) {
        $.ajax({
            url: $('#base_url').val()+'admin/user/inactive',
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
            url: $('#base_url').val()+'admin/user/active',
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
                url: $('#base_url').val()+'admin/user/delete',
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
            },{
                "targets": [5],
                "createdCell": function (td, cellData, rowData, row, col) {
					if($.isNumeric(rowData['phone']) && $.isNumeric(rowData['country_code'])){
						$(td).html('+'+rowData['country_code']+'-'+rowData['phone']);
					}
                }
            }, {
                "targets": [7],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData == '1'){
                        $(td).html('<a href="javascript:inactiveUser('+rowData['id']+')"><span class="badge badge-success"><?=$term["yes"]?></span></a>');
                    } else {
                        $(td).html('<a href="javascript:activeUser('+rowData['id']+')"><span class="badge badge-dark"><?=$term["no"]?></span></a>');
                    }

                }
            }, {
                "targets": [8],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData == '1'){
                        $(td).html('<span class="badge badge-success"><?=$term["yes"]?></span>');
                    } else {
                        $(td).html('<span class="badge badge-dark"><?=$term["no"]?></span>');
                    }

                }
            }, {
                "targets": [9],
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
				{ "title": "<?=$term["phone"]?>", "data": "phone", "class": "text-left", "width":100 },
                { "title": "<?=$term["role"]?>", "data": "user_type", "class": "text-center", "width":110 },
                { "title": "<?=$term["active"]?>", "data": "is_active", "class": "text-center", "width":50 },
                { "title": "<?=$term["paymentstatus"]?>", "data": "payment_status", "class": "text-center", "width":50 },
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
	
	function add_user(){
		  var url = "<?= base_url()?>admin/user/check_add_view";
		  $.ajax({
			  url: url,
			  type: 'POST',
			  processData:false,
			  contentType: false,
			  success: function (data, status, xhr) {
				if(data.success){
					location.href="<?= base_url()?>admin/user/add_view";
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

</script>
