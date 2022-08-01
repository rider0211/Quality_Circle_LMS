<section role="main" class="content-body">
	<header class="page-header">
		<h2><?php echo $term['examassignmanagement']; ?></h2>
	
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">	
						<a href="<?php echo base_url(); ?>fasi/examassign/create" class="btn btn-default"><i class="fas fa-plus"></i> <?php echo $term['create']; ?> </a>
					</div>

					<h2 class="card-title"><?php echo $term['examassignlist']; ?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-striped table-hover mb-0" id="datatable_examassign" >
					</table>
				</div>
				<?php echo form_open('fasi/examassign/create', array("id"=>"frm_assign")); ?>
					<input type="hidden" name="company_row_id" id="company_row_id">
				</form>
			</section>
		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>
	var $table = $('#datatable_examassign');

	function deleteAssign(id) {
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
                url: '<?php echo base_url();?>all/examassign/delete_assign',
                type: 'POST',
                data: {'id': id},
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
		/*.on('pnotify.cancel', function(){
			//console.log("cancel");
		});
		*/
	}

	function changeAssign(id) {
		$frm_assign = $('#frm_assign');
		$('#company_row_id').val(id);
		$frm_assign.submit();
	}

	jQuery(document).ready(function() { 
		
		$table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
                "type": "POST",
                "async": true,
				//"url": "examassign/getlist",
				url: "<?php echo base_url();?>all/examassign/getlist",
				"data": '',		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            "columnDefs": [ {
				"targets": [7],
				"createdCell": function (td, cellData, rowData, row, col) {
					$(td).html('<a href="javascript:changeAssign(\''+cellData+'\')"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteAssign(\''+cellData+'\')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
					//$(td).addClass('actions-hover actions-fade');								
				}
			} ],     
            "columns": [
            	{ "title": "<?php echo $term['userrole']; ?>", "data": "user_type", "class": "text-center", "width":100, "visible": true },
				{ "title": "<?php echo $term['companyname']; ?>", "data": "company_name", "class": "text-center", "width":100, "visible": true },
				{ "title": "<?php echo $term['name']; ?>", "data": "name", "class": "text-center", "width":"100", "visible": true },
				{ "title": "<?php echo $term['examcategory']; ?>", "data": "exam_category_name", "class": "text-left", "width":"*", "visible": true },
				{ "title": "<?php echo $term['examtitle']; ?>", "data": "exam_title", "class": "text-left", "width":"*", "visible": true },
				{ "title": "<?php echo $term['startdate']; ?>", "data": "start_date", "class": "text-left", "width":150 },
				{ "title": "<?php echo $term['assigneremail']; ?>", "data": "parent_email", "class": "text-left", "width":150 },
				{ "title": "<?php echo $term['action']; ?>", "data": "id", "class": "text-center", "width":"60" },
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