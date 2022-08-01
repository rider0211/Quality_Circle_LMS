<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["topicmanagement"]?></h2>
	
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url(); ?>admin/home">
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li><span><?=$term["trainings"]?></span></li>

				<li><span><?=$term["topic"]?></span></li>
			</ol>

		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">	
						<a href="<?php echo base_url(); ?>admin/topic/create" class="btn btn-default"><i class="fas fa-plus"></i> <?=$term[newtopic]?> </a>
					</div>

					<h2 class="card-title"><?=$term["topiclist"]?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover mb-0" id="datatable-topic" >
					</table>
				</div>
			</section>
		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>
	var $table = $('#datatable-topic');

	function deleteTopic(id) {
		
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
                url: 'topic/delete/'+id,
                type: 'GET',
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

	function inactiveTopic(id) {
		$.ajax({
            url: 'topic/inactive',
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

	function activeTopic(id) {
		$.ajax({
            url: 'topic/active',
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

	jQuery(document).ready(function() { 
		
		$table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
                "type": "POST",
                "async": true,
				"url": "topic/getlist",
				"data": '',		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            "columnDefs": [ {
                "targets": [2],
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).html('<span data-plugin-lightbox data-plugin-options=\'{ "type":"image" }\' title="">' +
                        '<img class="img-fluid" src="<?=base_url()?>'+'assets/uploads/topic/'+rowData['id']+'_'+cellData+'" width="32" height="32">' +
                        '</span>');
                }
            }, {
                "targets": [6],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData == '1') {
                        $(td).html('<a href="javascript:inactiveTopic('+rowData['id']+')"><span class="badge badge-success"><?=$term["active"]?></span></a>');
                    } else {
                        $(td).html('<a href="javascript:activeTopic('+rowData['id']+')"><span class="badge badge-dark"><?=$term["inactive"]?></span></a>');
                    }
                }
            }, {
				"targets": [7],
				"createdCell": function (td, cellData, rowData, row, col) {
					$(td).html('<a href="<?php echo base_url();?>admin/topic/edit/'+cellData+'"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteTopic('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
					//$(td).addClass('actions-hover actions-fade');					
				}
			} ],     
            "columns": [
				{ "title": "<?=$term["categoryname"]?>", "data": "category_name", "class": "text-left", "width":100 },
				{ "title": "<?=$term["topictitle"]?>", "data": "training_title", "class": "text-left", "width":"*" },
				{ "title": "<?=$term["image"]?>", "data": "image", "class": "text-center", "width":50},
				{ "title": "<?=$term["timemin"]?>", "data": "training_timer", "class": "text-right", "width":100},
				{ "title": "<?=$term[cost] ?>(€)", "data": "price", "class": "text-right", "width":70},
				{ "title": "<?=$term["lessoncount"]?>", "data": "lesson_count", "class": "text-right", "width":80},
				{ "title": "<?=$term["status"]?>", "data": "status", "class": "text-center", "width":80 },
				{ "title": "<?=$term["active"]?>", "data": "id", "class": "text-center", "width":80 },
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