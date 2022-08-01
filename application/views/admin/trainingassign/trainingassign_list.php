<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["assign"]?></h2>
			
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<div class="tabs">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link" href="#fasi_tab" data-toggle="tab"><i class="fas fa-star"></i> <?=$term["assignlist"]?></a>
					</li>					
				</ul>
				<div class="tab-content">
					<div id="fasi_tab" class="tab-pane active">
						<section class="card">
							<header class="card-header">
								<div class="card-actions">
									<a class="btn btn-default" href="<?php echo base_url(); ?>admin/trainingassign/create" id="btn_fasi_add"><i class="fa fa-plus"></i> <?=term["newassign"]?> </a>
								</div>
								<h2 class="card-title"><?=$term["assignlist"]?></h2>
							</header>
							<div class="card-body">
								<table class="table table-responsive-md table-hover mb-0" id="datatable_fasi_assign" >
								</table>
								<form id="form_fasi_assign" action="<?php echo base_url(); ?>admin/trainingassign/create" method="POST">
									<input type="hidden" name="fasi_row_id" id="fasi_row_id">
								</form>
							</div>
						</section>	
					</div>					
				</div>
			</div>
		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>
	var $fasi_table = $('#datatable_fasi_assign');

	function deleteAssign(id) {
		(new PNotify({
            title: "<?php echo $term['confirmation']; ?>",
            text: "<?php echo $term['areyousuretodelete']; ?>",
			type: 'primary',
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
                url: '<?php echo base_url();?>all/trainingassign/delete_assign',
                type: 'POST',
                data: {'id': id},
                success: function (data, status, xhr) {	
                	$fasi_table.DataTable().ajax.reload('', false);	
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

	function changeAssign(id) {
		$frm_fasi = $('#form_fasi_assign');
		$('#fasi_row_id').val(id);
		$frm_fasi.submit();
	}

	


jQuery(document).ready(function() { 	
		
	$fasi_table.dataTable({
		"ordering": true,
		"info": true,
		"searching": true,

		"ajax": {
            "type": "POST",
            "async": true,
			//"url": "trainingassign/getlist",
			url: "<?php echo base_url();?>all/trainingassign/getlist",
			"data": '',		
			"dataSrc": "data",
			"dataType": "json",
			"cache":    false,
        },
        
        "columnDefs": [ {

        }, {
			"targets": [8],
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html('<a href="javascript:changeAssign(\''+cellData+'\')"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteAssign(\''+cellData+'\')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
				//$(td).addClass('actions-hover actions-fade');					
			}
		}],     
        "columns": [
			{ "title": "<?=$term["userrole"]?>", "data": "user_type", "class": "text-center", "width":60 },
			{ "title": "<?=$term["companyname"]?>", "data": "company_name", "class": "text-center", "width":100 },
			{ "title": "<?=$term["name"]?>", "data": "name", "class": "text-center", "width":200 },
			{ "title": "<?=$term["trainingcategory"]?>", "data": "category_name", "class": "text-left", "width":"100" },
			{ "title": "<?=$term["trainingtitle"]?>", "data": "training_title", "class": "text-left", "width":"*" },
			{ "title": "<?=$term["startdate"]?>", "data": "start_date", "class": "text-left", "width":"100" },
			{ "title": "<?=$term["repeatdays"]?>", "data": "repeat_days", "class": "text-left", "width":"100" },
			{ "title": "<?=$term["assigneremail"]?>", "data": "parent_email", "class": "text-left", "width":"150" },
			{ "title": "<?=$term["action"]?>", "data": "id", "class": "text-center", "width":"80" },
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