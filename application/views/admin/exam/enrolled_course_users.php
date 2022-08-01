<style>
	.ui-pnotify-container {
		height: 130px;
	}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Enrolled Course History </h2>
	
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url(); ?>home">
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li><span><?=$term["exam"]?></span></li>

				<li><span><?=$term["examlist"]?></span></li>
			</ol>

		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
                	<?php if($schedule_date != ''){ ?>
					<h2 class="card-title">Course Schedule Date: &nbsp;<?php echo $schedule_date; ?></h2>
                    <?php }else{ ?>
                    <h2 class="card-title">Enrolled Course History</h2>
                    <?php } ?>
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

<script>
	var $table = $('#datatable_examlist');

	jQuery(document).ready(function() { 
		var courseid = '<?php echo $courseid ?>';
		var timeid = '<?php echo $timeid ?>';
		$table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
                "type": "POST",
                "async": true,
				"url": "<?= base_url()?>admin/examhistory/course_enrolled_users/"+courseid+"/"+timeid,
				"data": '',		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            "columnDefs": [{
				"targets": [5],
				"createdCell": function (td, cellData, rowData, row, col) {  
						$(td).html('<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteEnrollments('+cellData+')">Delete</a>');
                    }
                }],
				
	        "columns": [
				{ "title": "#", "data": "serial", "class": "text-left", "width":50 },
				{ "title": "Full Name", "data": "full_name", "class": "text-left", "width":200 },
				{ "title": "Course Title", "data": "course_title", "class": "text-left", "width":200 }, 
				{ "title": "Email", "data": "email", "class": "text-left", "width":200},
				{ "title": "Created", "data": "created", "class": "text-left", "width":200 },
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
	});
	
	function deleteEnrollments(id) {
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
                url: '<?= base_url()?>admin/examhistory/deleteEnrollments/',
                type: 'POST',
                data: {'id': id},
                success: function (data, status, xhr) {
					window.location.href = "";
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
</script>