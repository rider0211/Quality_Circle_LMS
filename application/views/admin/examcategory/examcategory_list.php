<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["categorymanagement"]?></h2>
	
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url(); ?>home">
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li><span><?=$term["exam"]?></span></li>

				<li><span><?=$term["category"]?></span></li>
			</ol>

		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">	
						<a href="<?php echo base_url(); ?>admin/examcategory/create" class="btn btn-default"><i class="fas fa-plus"></i> <?=$term[newcategory]?></a>
					</div>

					<h2 class="card-title"><?=$term["categorylist"]?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-striped table-hover mb-0" id="datatable_examcategory" >
					</table>
				</div>
				<?php echo form_open('admin/examcategory/create', array("id"=>"frm_category")); ?>
					<input type="hidden" name="row_id" id="row_id">
				</form>
			</section>
		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>
	var $table = $('#datatable_examcategory');

	function deleteCategory(id) {
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
                url: 'examcategory/delete',
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

	function changeCategory(id) {
		$frm_category = $('#frm_category');
		$('#row_id').val(id);
		$frm_category.submit();
	}

	function inactiveCategory(id) {
		$.ajax({
            url: 'examcategory/inactive',
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

	function activeCategory(id) {
		$.ajax({
            url: 'examcategory/active',
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
				"url": "examcategory/getlist",
				"data": '',		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            "columnDefs": [ {
                "targets": [3],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData == '1'){
                        $(td).html('<a href="javascript:inactiveCategory('+rowData['id']+')"><span class="badge badge-success"><?=$term["active"]?></span></a>');
                    } else {
                        $(td).html('<a href="javascript:activeCategory('+rowData['id']+')"><span class="badge badge-dark"><?=$term["inactive"]?></span></a>');
                    }
                }
            }, {
                "targets": [2],
                "createdCell": function (td, cellData, rowData, row, col) {
                	if(cellData.length > 100) {
                	    $(td).html(cellData.substring(0,100)+"...");
                	    $(td).attr('title', cellData);
                	}
                	else
                		$(td).html(cellData);
                }
            }, {
				"targets": [5],
				"createdCell": function (td, cellData, rowData, row, col) {
					$(td).html('<a href="javascript:changeCategory('+cellData+')"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteCategory('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
					//$(td).addClass('actions-hover actions-fade');								
				}
			} ],     
            "columns": [
				{ "title": "<?=$term["categoryname"]?>", "data": "exam_category_name", "class": "text-left", "width":200, "visible": true },
				{ "title": "<?=$term[categorycode]?>", "data": "exam_category_code", "class": "text-left", "width":"100", "visible": true },
				{ "title": "<?=$term["description"]?>", "data": "description", "class": "text-left", "width":"*", "visible": true },
				{ "title": "<?=$term["status"]?>", "data": "status", "class": "text-left", "width":100 },
				{ "title": "<?=$term["regdate"]?>", "data": "created_at", "class": "text-left", "width":150 },
				{ "title": "<?=$term["action"]?>", "data": "id", "class": "text-center", "width":"60" },
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