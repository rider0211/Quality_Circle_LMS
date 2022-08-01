<section role="main" class="content-body">
	<header class="page-header">
		<h2>Evening Work & Management</h2>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">
						<a class="btn btn-default" href="<?php echo base_url();?>admin/eveningwrkexcercise/create" id="btn_add"><i class="fa fa-plus"></i> <?=$term["addnew"]?></a>
					</div>
					<h2 class="card-title">Evening Work List</h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover mb-0" id="datatable_eveningwrk" >
					</table>
					<form id="form_excercise" action="<?php echo base_url(); ?>admin/eveningwrkexcercise/create" method="POST">
						<input type="hidden" name="row_id" id="row_id">
					</form>
				</div>
			</section>
		</div>
	</div>

	<!-- end: page -->
</section>

<script>
	var $table = $('#datatable_eveningwrk');

	function changeContent(id) {
		$frm_category = $('#form_excercise');
		$('#row_id').val(id);
		$frm_category.submit();
	}

	function deleteExcercise(id){	
	
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
                url: 'eveningwrkexcercise/delete/'+id,
                type: 'POST',
                success: function (data, status, xhr) {	
                	$table.DataTable().ajax.reload('', false);	
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
				"url": "<?php echo base_url()?>admin/eveningwrkexcercise/getlist",
				"data": '',		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            
            "columnDefs": [ {
				"targets": [4],
				"createdCell": function (td, cellData, rowData, row, col) {
					console.log(rowData);
					if(cellData == 'false'){
						$(td).html('');
					}else{
						$(td).html('<a href="javascript:changeContent('+cellData+')"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteExcercise('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');	
					}
				}
			}],
            "columns": [
                { "title": "<?=$term["no"]?>", "data": "no", "class": "text-left", "width":"80" },
				{ "title": "Student", "data": "student_id", "class": "text-left", "width":150, "visible": true },
				{ "title": "Status", "data": "status", "class": "text-left", "width":80, "visible": true },
				{ "title": "Created At", "data": "cr_date", "class": "text-left", "width":80, "visible": true },
				{ "title": "<?=$term["action"]?>", "data": "id", "class": "text-left", "width":"80" },
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
