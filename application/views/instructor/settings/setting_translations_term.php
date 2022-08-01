<section role="main" class="content-body">
	<header class="page-header">
		<h2>Translations Settings</h2>
        <div class="right-wrapper">
        </div>
	</header>

	<!-- start: page -->
	<div class="row">
		<?php $this->load->view('instructor/settings/settings_sidebar');?>
		<div class="inner-body">	
			<div class="row">
				<div class="col-lg-12">
					<section class="card">
						<header class="card-header">
							<div class="card-actions">
								<button class="btn btn-primary" id="save_term">Save Translation</button>
							</div>
							<h2 class="card-title">Translations Settings</h2>
						</header>

						<div class="card-body">
							<table class="table table-responsive-md table-striped table-hover mb-0" id="datatable_language" >
							</table>
						</div>

					</section>
				</div>
			</div>
		</div>
	</div>
	
	<!-- end: page -->
</section>

<!--<script src="<?php /*echo base_url(); */?>assets/js/examples.datatables.default.js"></script>
<script src="<?php /*echo base_url(); */?>js/examples.datatables.row.with.details.js"></script>
<script src="<?php /*echo base_url(); */?>js/examples.datatables.tabletools.js"></script>-->

<script>

	var $table = $('#datatable_language');

	jQuery(document).ready(function() {

		$table.dataTable({
			"ordering": false,
			"info": true,
			"searching": true,

			"ajax": {
				"type": "POST",
				"async": true,
				url: "<?php echo base_url();?>instructor/settings/get_trans_term_list/<?=$lang_id?>",
				"data": '',
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
			},

			"columnDefs": [
				{
					"targets": [1],
					"createdCell": function (td, cellData, rowData, row, col) {
						$(td).html('<input type="text" class="form-control trans_term_input" data-id="' + rowData.id + '" data-change="false" value="' + cellData + '" onkeypress="javascript:change(event)">');
					}
				}
			],
			"columns": [
				{ "title": "English", "data": "english", "class": "text-left", "width":"50%", "visible": true },
				{ "title": "<?=$lang_name?>", "data": "<?=$field_name?>", "class": "text-left", "width":"50%", "visible": true },
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
			"pageLength": 10, // default record count per page

			dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			bProcessing: true,
		});

		$('#save_term').click(function(){
			var change_iterms = $('#datatable_language input');
			if (change_iterms.length == 0){
				new PNotify({
					title: 'Warning!',
					text: 'Nodata',
					type: 'warning'
				});
				return;
			}
			var values = [];

			change_iterms.each(function() {
				var id = $(this).attr('data-id');
				var content = $(this).val();
				var field = '<?=$field_name?>';

				values[values.length] = {
					id: id,
					content: content,
				};
			});

			var value = JSON.stringify(values);

			$.post({
				url: "<?php echo base_url();?>instructor/settings/update_trans_term",
				data:{
					'value' : value,
					'field' : '<?=$field_name?>',
				},
				success:function(){
					new PNotify({
						title: 'Success!',
						text: 'Successfully updated',
						type: 'success'
					});
				},
				error:function(){
					new PNotify({
						title: 'Error!',
						text: 'Update Fail! Retry!',
						type: 'error'
					});
				}
			});
		});
	});

	function change(event){
		if (event.which == 13 || event.keyCode == 13) $('#save_term').click();
	}

</script>