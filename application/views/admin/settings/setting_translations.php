<section role="main" class="content-body">
	<header class="page-header">
		<h2>Translations Settings</h2>
        <div class="right-wrapper">
        </div>
	</header>

	<!-- start: page -->
	<div class="row">
		<?php $this->load->view('admin/settings/settings_sidebar');?>
		<div class="inner-body">	
			<div class="row">
				<div class="col-lg-12">
					<section class="card">
						<header class="card-header">
							<div class="card-actions col-lg-4">
								<div class="">
									<!--<select data-plugin-selectTwo class="form-control populate" id="select_lang">
									</select>-->
								</div>
							</div>
							<h2 class="card-title">Translations Settings</h2>
						</header>
						<div class="card-body">
							<table class="table table-responsive-md table-striped table-hover mb-0" id="datatable_language" >
							</table>
							<!--<table class="table table-bordered table-striped mb-0" id="datatable-default">
								<thead>
									<tr>
										<th>Icon</th>
										<th>Language</th>
										<th>Progress</th>
										<th>Done</th>
										<th>Total</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td ></td>
										<td></td>
										<td></td>
									</tr>									
								</tbody>
							</table>-->
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
		$("#select_lang").themePluginSelect2({
			allowClear: true,
			placeholder: "Select",
			minimumInputLength: 0,
			ajax: {
				"type": "POST",
				url: "<?php echo base_url();?>admin/settings/get_trans_seletable_lang_list",
				dataType: 'json',
				results: function (data) {
					return data;
				}
			}
		});

		$table.dataTable({
			"ordering": false,
			"info": true,
			"searching": true,

			"ajax": {
				"type": "POST",
				"async": true,
				//"url": "examassign/getlist",
				url: "<?php echo base_url();?>admin/settings/get_trans_selected_lang_list",
				"data": '',
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
			},

			"columnDefs": [
			{
				"targets": [0],
				"createdCell": function (td, cellData, rowData, row, col) {
					$(td).html('<img class="img-fluid" src="' + cellData+'" width="28" height="28"></a>');
				}
			},
			{
				"targets": [2],
				"createdCell": function (td, cellData, rowData, row, col) {

					var percent = parseInt(cellData/rowData['term_count']*100);
					var pclass = 'success';
					if (percent < 10) pclass = 'danger';
					else if (percent < 50) pclass = 'warning';
					else if (percent < 80) pclass = 'primary';
					$(td).html('<div class="progress progress-sm progress-half-rounded m-0 mt-1 light"><div class="progress-bar progress-bar-' + pclass + '" role="progressbar" aria-valuenow="'+percent+'" aria-valuemin="0" aria-valuemax="100" style="width: '+percent+'%;">'+percent+'%</div></div>');

				}
			},
			{
				"targets": [5],
				"createdCell": function (td, cellData, rowData, row, col) {
					$(td).html(
							(rowData['active_flag'] == 0 ?
							'<a data-rel="tooltip" title="Activate"   class="btn btn-xs btn-default" href="javascript:activate(' + cellData + ', 1)">'
						  : '<a data-rel="tooltip" title="Deactivate" class="btn btn-xs btn-success" href="javascript:activate(' + cellData + ', 0)">'
							)
							+
									'<i class="fa fa-eye"></i>' +
								'</a><span class="w-20"></span>' +
								'<a data-rel="tooltip" title="Edit" class="btn btn-xs btn-info" href="<?php echo base_url(); ?>admin/settings/trans_term_view/' + rowData['id'] + '">' +
									'<i class="fa fa-edit"></i>' +
								'</a><span class="w-20"></span>');

					//$(td).html('<a data-rel="tooltip" data-original-title="Edit" class="btn btn-xs btn-info" href="javascript:edit(\''+cellData+'\')"><i class="fa fa-edit"></i></a><span class="w-20"></span>');
					//$(td).addClass('actions-hover actions-fade');
				}
			} ],
			"columns": [
				{ "title": "Icon", "data": "image", "class": "text-center", "width":100, "visible": true },
				{ "title": "Language", "data": "lang_name", "class": "text-center", "width":200, "visible": true },
				{ "title": "Progress", "data": "done_count", "class": "text-center", "width":"100", "visible": true },
				{ "title": "Done", "data": "done_count", "class": "text-center", "width":"100", "visible": true },
				{ "title": "Total", "data": "term_count", "class": "text-center", "width":"*", "visible": true },
				{ "title": "Action", "data": "id", "class": "text-center", "width":"100" },
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

	});

	function activate(id, newvalue){
		$.post({
			url: "<?php echo base_url();?>admin/settings/update_trans_activate",
			data:{
				'id' : id,
				'value' : newvalue,
			},
			success:function(){
				new PNotify({
					title: 'Response Status',
					text: 'Translation Updated Successfully',
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

		$table.DataTable().ajax.reload();
	}
</script>