<section role="main" class="content-body">
	<header class="page-header">
		<h2><?php echo $term['trainingassignmanagement']; ?></h2>

		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url(); ?>fasi/home">
						<i class="fas fa-home"></i>
					</a>
				</li>

				<li><span><?php echo $term['trainings']; ?></span></li>

				<li><span><?php echo $term['assign']; ?></span></li>

			</ol>

		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">
						<a class="btn btn-default" href="<?php echo base_url(); ?>fasi/trainingassign/create" id="btn_company_add"><i class="fa fa-plus"></i> <?php echo $term['newassign']; ?> </a>
					</div>
					<h2 class="card-title"><?php echo $term['assign']; ?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover mb-0" id="datatable_company_assign" >
					</table>
				</div>
			</section>
		</div>
		<form id="form_company_assign" action="<?php echo base_url(); ?>fasi/trainingassign/create" method="POST">
			<input type="hidden" name="company_row_id" id="company_row_id">
		</form>
	</div>
	
	<!-- end: page -->
</section>

<script>
	var $company_table = $('#datatable_company_assign');


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
                	$company_table.DataTable().ajax.reload('', false);	
				},
				error: function(){
					new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
						type: 'error'
					});		
				}
			});	
		});		
	}


	function changeAssign(id) {
		$frm_company = $('#form_company_assign');
		$('#company_row_id').val(id);
		$frm_company.submit();
	}


jQuery(document).ready(function() { 	
	
	$company_table.dataTable({
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
			{ "title": "<?php echo $term['userrole']; ?>", "data": "user_type", "class": "text-center", "width":60 },
			{ "title": "<?php echo $term['companyname']; ?>", "data": "company_name", "class": "text-center", "width":100, "visible": true },
			{ "title": "<?php echo $term['name']; ?>", "data": "name", "class": "text-center", "width":100 },
			{ "title": "<?php echo $term['trainingcategory']; ?>", "data": "category_name", "class": "text-left", "width":"100" },
			{ "title": "<?php echo $term['trainingname']; ?>", "data": "training_title", "class": "text-left", "width":"*" },
			{ "title": "<?php echo $term['startdate']; ?>", "data": "start_date", "class": "text-left", "width":"100" },
			{ "title": "<?php echo $term['repeatdays']; ?>", "data": "repeat_days", "class": "text-left", "width":"100" },
			{ "title": "<?php echo $term['assigneremail']; ?>", "data": "parent_email", "class": "text-left", "width":"150" },
			{ "title": "<?php echo $term['action']; ?>", "data": "id", "class": "text-center", "width":"80" },
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